

;(function ($) {
$(document).ready(
    function () {
        // mobile menu
        $('#tdt-mobilenav-btn').mobilenav({style:'from-left'});
        // search button
        $('#search-form-btn').on('click', function(e){
            var btn = $(this),
                wrapper = $('.header-search-form-wrap');

            if(wrapper.hasClass('shown')) {
                wrapper.removeClass('shown').hide();
            } else {
                wrapper.addClass('shown').show().css({
                    top: (btn.offset().top + btn.height()) + 'px'
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


