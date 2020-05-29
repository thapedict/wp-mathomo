

;(function ($) {
$(document).ready(
    function () {
        // mobile menu
        $('#tdt-mobilenav-btn').mobilenav({style:'from-left'});
        // search button
        $('header .search-form-btn').on('click', function(e){
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
            }
        });
        // mini cart
        var cartWrapper =  $('.header-mini-cart-wrap');
        $('header .mini-cart-btn').on('click', function(e){
            var btn = $(this);

            if(cartWrapper.hasClass('shown')) {
                cartWrapper.addClass('not-shown').removeClass('shown');
            } else {
                cartWrapper.addClass('shown').removeClass('not-shown');
            }
        });
        cartWrapper.children('#close').on('click', function(e){
            cartWrapper.addClass('not-shown').removeClass('shown');
        });
    }
);
})(jQuery);


