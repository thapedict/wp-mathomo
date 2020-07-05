

;(function ($) {
$(document).ready(
    function () {
        // mobile menu
        $('#tdt-mobilenav-btn').mobilenav({style:'from-left'});
        // search button
        $('header .search-form-btn').on('click keyup', function(e){
            // enter to toggle
            // esc to close
            if('keyup'===e.type) {
                if(13!==e.which) {
                    return;
                }
            }

            var btn = $(this),
                _right = 0,
                _bw = $('body').width(),
                wrapper = $('.header-search-form-wrap');

            if(wrapper.hasClass('shown')) {
                wrapper.removeClass('shown').hide();
            } else {
                if(_bw > 500) {
                    _right = _bw - (btn.offset().left + btn.outerWidth()) + 'px';
                }
                wrapper.addClass('shown').show().css({
                    top: (btn.offset().top + btn.height()) + 'px',
                    right: _right
                });

                wrapper.find('input').focus();
            }
        });
        // close search form on esc keyup
        $('.header-search-form-wrap input').on('keyup',function(e){
            if(27!==e.which) {
                return;
            }

            var wrapper = $('.header-search-form-wrap');

            wrapper.removeClass('shown').hide();
            $('header .search-form-btn').focus();
        });
        // mini cart
        var cartWrapper =  $('.header-mini-cart-wrap');
        $('header .mini-cart-btn').on('click keyup', function(e){
            // accept enter to toggle
            if('keyup'===e.type) {
                if(13!==e.which) {
                    return;
                }
            }

            var btn = $(this);

            if(cartWrapper.hasClass('shown')) {
                cartWrapper.addClass('not-shown').removeClass('shown');
                mainBodyLightbox.hide();
            } else {
                cartWrapper.addClass('shown').removeClass('not-shown');
                mainBodyLightbox.show();
                cartWrapper.children('#close').focus();
            }
        });
        cartWrapper.children('#close').on('click keyup', function(e){
            // accept enter to toggle
            if('keyup'===e.type) {
                if(13!==e.which) {
                    return;
                }
            }

            cartWrapper.addClass('not-shown').removeClass('shown');
            mainBodyLightbox.hide();
        });
        // close on esc keyup
        cartWrapper.on('keyup',function(e){
            if(27!==e.which) {
                return;
            }
            
            cartWrapper.addClass('not-shown').removeClass('shown');
            mainBodyLightbox.hide();
            $('header .mini-cart-btn').focus();
        });

        function add_main_body_lightbox(){
            if($('.main-body-lightbox').length){
                return;
            }

            $('body').append('<div class="main-body-lightbox"></div>');
        }

        add_main_body_lightbox();
        var mainBodyLightbox = $('.main-body-lightbox');
    }
);
})(jQuery);


