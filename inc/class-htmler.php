<?php
/**
 * HTMLER: The HTML HELPER for safe html output
 *
 *  @package Mathomo
 *  @version 1.2.0
 */

/**
 *  WordPress specific html formatter and outputter
 */
class HTMLER {

    /**
     *  Safetly wraps content with tag and escapes everything
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     *
     *  @return string  html string
     */
    public static function wrap( $tag, $content, array $attr = array() ) {
        $attr = static::attr( $attr );

        return sprintf( '<%1$s%2$s>%3$s</%1$s>', $tag, $attr, esc_html( $content ) );
    }

    /**
     *  Wraps content with tag. Content not escaped
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     *
     *  @return string  html string
     */
    public static function wrap_raw( $tag, $content, array $attr = array() ) {
        $attr = static::attr( $attr );

        return sprintf( '<%1$s%2$s>%3$s</%1$s>', $tag, $attr, $content );
    }

    /**
     *  cleans up attributes
     *
     *  @param  array   $attr   array containing attributes.
     *
     *  @return string  $attr   safe attributes string
     */
    public static function attr( array $attr ) {
        if ( $attr ) {
            array_walk( $attr, 'esc_attr' );

            $_attr = array();

            foreach ( $attr as $k => $v ) {
                $_attr[] = preg_replace( '#[^\w-]*#', '', $k ) . '="' . $v . '"';
            }

            $attr = ' ' . implode( ' ', $_attr );
        } else {
            $attr = '';
        }

        return $attr;
    }

    /**
     *  Prints out wrapped content
     *
     *  @see HTMLER::wrap
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     */
    public static function wrap_e( $tag, $content, array $attr = array() ) {
        echo static::wrap( $tag, $content, $attr );
    }

    /**
     *  Prints out unsafe wrapped content
     *
     *  @see HTMLER::wrap_raw
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     */
    public static function wrap_raw_e( $tag, $content, array $attr = array() ) {
        echo static::wrap_raw( $tag, $content, $attr );
    }

    /**
     *  Safetly wraps content with tag and escapes (using wp_kses) everything
     * 
     * @since 1.2.0
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     *
     *  @return string  html string
     */
    public static function kses( $tag, $content, array $attr = array() ) {
        $attr = static::attr( $attr );
        
        return sprintf( '<%1$s%2$s>%3$s</%1$s>', $tag, $attr,  wp_kses( $content, 'post' ) );
    }

    /**
     *  Prints out unsafe wrapped content
     *
     *  @since 1.2.0
     *
     *  @param  string  $tag        the tag to wrap the content with.
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     */
    public static function kses_e( $tag, $content, array $attr = array() ) {
        echo static::kses( $tag, $content, $attr );
    }

    /**
     *  Handling of common HTML tags without expicitly declaring them
     * 
     *      Since 1.2.0: can now catch 'kses' calls. e.g. div_kses_e
     *
     *  @param string $function_name the cunction being called.
     *  @param array $arguments the args passed to the function.
     *
     *  @throws Exception If trying to call invalid tag hooks.
     *
     *  @return string|void string of function doesn't print
     */
    public static function __callStatic( $function_name, $arguments ) {
        $class = get_called_class();

        // validate tag? Let's assume it's a div
        // expecting: div, div_e, div_raw, div_raw_e
        if ( preg_match( '#^(?<tag>[a-z]+|h[1-6])$#', $function_name ) ) {
            $arguments = array_merge( array( $function_name ), $arguments );

            if ( static::valid_tag( $function_name ) ) {
                return call_user_func_array( array( $class, 'wrap' ), $arguments );
            } elseif ( static::valid_nct( $function_name ) ) {
                return call_user_func_array( array( $class, 'nct' ), $arguments );
            } else {
                throw new Exception( 'Invalid Tag: ' . $function_name );
            }
        } elseif ( preg_match( '#^(?<tag>[a-z]+|h[1-6])_e$#', $function_name, $match ) ) {
            $arguments = array_merge( array( $match[ 'tag' ] ), $arguments );

            if ( static::valid_tag( $match[ 'tag' ] ) ) {
                call_user_func_array( array( $class, 'wrap_e' ), $arguments );
            } elseif ( static::valid_nct( $match[ 'tag' ] ) ) {
                call_user_func_array( array( $class, 'nct_e' ), $arguments );
            } else {
                throw new Exception( 'Invalid Tag: ' . $function_name );
            }
        } elseif ( preg_match( '#^(?<tag>[a-z]+|h[1-6])_raw$#', $function_name, $match ) ) {
            if ( static::valid_tag( $match[ 'tag' ] ) ) {
                $arguments = array_merge( array( $match[ 'tag' ] ), $arguments );

                return call_user_func_array( array( $class, 'wrap_raw' ), $arguments );
            }
        } elseif ( preg_match( '#^(?<tag>[a-z]+|h[1-6])_raw_e$#', $function_name, $match ) ) {
            if ( static::valid_tag( $match[ 'tag' ] ) ) {
                $arguments = array_merge( array( $match[ 'tag' ] ), $arguments );

                call_user_func_array( array( $class, 'wrap_raw_e' ), $arguments );
            }
        } elseif ( preg_match( '#^(?<tag>[a-z]+|h[1-6])_kses$#', $function_name, $match ) ) {
            if ( static::valid_tag( $match[ 'tag' ] ) ) {
                $arguments = array_merge( array( $match[ 'tag' ] ), $arguments );

                return call_user_func_array( array( $class, 'kses' ), $arguments );
            }
        } elseif ( preg_match( '#^(?<tag>[a-z]+|h[1-6])_kses_e$#', $function_name, $match ) ) {
            if ( static::valid_tag( $match[ 'tag' ] ) ) {
                $arguments = array_merge( array( $match[ 'tag' ] ), $arguments );

                call_user_func_array( array( $class, 'kses_e' ), $arguments );
            }
        } else {
            throw new Exception( "Invalid static function call: HTMLER::{$function_name}" );
        }
    }

    /**
     *  Allowing only a set of html tags
     *
     *  @param string $tag the name of the tag.
     *
     *  @return bool    true if valid
     */
    public static function valid_tag( $tag ) {
        $tags = array(
            'a', 'b', 'i', 'small', 'span', 'label', 'button',          // Inline
            'sub', 'sup',
            'p', 'blockquote', 'div', 'header', 'footer', 'article',    // Block
            'address', 'section', 'fieldset',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',                         // Headings
            'ul', 'ol', 'li', 'dl', 'dt', 'dd',                         // Lists
            'table', 'th', 'tr', 'td',                                   // Table
        );

        return in_array( $tag, $tags );
    }

    /**
     *  Handling non-closing HTML tags
     *
     *  @param string $tag tag name.
     *  @param array $attr a list of attributes.
     *
     *  @return string formatted HTML
     */
    public static function nct( $tag, array $attr ) {
        $attr = static::attr( $attr );

        return sprintf( '<%1$s%2$s />', $tag, $attr );
    }

    /**
     *  Printing of non-closing tags
     *
     *  @param string $tag the tag.
     *  @param array $attr the list of attributes.
     */
    public static function nct_e( $tag, array $attr ) {
        echo static::nct( $tag, $attr );
    }

    /**
     *  Validating the non-closing tags
     *
     *  @param string $tag the tag to validate.
     *
     *  @return bool true if tag is valid, false if not
     */
    public static function valid_nct( $tag ) {
        $tags = array( 'img', 'input', 'hr' );

        return in_array( $tag, $tags );
    }

    /**
     * Handles the anchor tag (because we need to escape href properly)
     *
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     *
     *  @return string  html string
     */
    public static function a( $content,  array $attr = array() ) {
        $attr = static::a_attr( $attr );

        return sprintf( '<a%s>%s</a>', $attr, esc_html( $content ) );
    }

    /**
     * Handles the anchor tag (output).
     * 
     * @see this::a
     * 
     *  @param  string  $content    The content.
     *  @param  array   $attr       An array of attributes.
     */
    public static function a_e( $content, array $attr = array() ) {
        echo static::a( $content, $attr );
    }

    /**
     * Handles the escaping of anchor tag attributes
     * 
     * @param array $attr The attributes to escape.
     * 
     * @return string With the escaped attribute string.
     */
    protected static function a_attr( array $attr = array() ) {
        if( ! empty( $attr ) ) {
            $href = '';

            if( isset( $attr[ 'href' ] ) ) {
                $href = sprintf( ' href="%s"', esc_url( $attr[ 'href' ] ) );
                unset( $attr[ 'href' ] );
            }

            return $href . static::attr( $attr );
        }

        return '';
    }

    /**
     * Handles the img tag since src need url escaping
     * 
     *  @param  array   $attr       An array of attributes.
     *
     *  @return string  html string
     */
    public static function img( array $attr ) {
        $src = '';

        if( isset( $attr[ 'src' ] ) ) {
            $src = sprintf( ' src="%s"', esc_url( $attr[ 'src' ] ) );
        }

        $attr = $src . static::attr( $attr );

        return sprintf( '<img%s />', $attr );
    }

    /**
     * Handles the img tag (output)
     * 
     * @see this::img
     * 
     *  @param  array   $attr       An array of attributes.
     */
    public static function img_e( array $attr ) {
        echo static::img( $attr );
    }
}