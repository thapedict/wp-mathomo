/**
 * jQuery ScrollToTop
 * Version: 1.0.0
 * Author: Thapelo Moeti
 * License: GNU General Public License v2 or later
 */
 
;(function ( $, window, document, undefined ) { 
// no jQuery
if($ === undefined ) {
    return;
}
    
// activate
$(document).ready(
    function () {

        var SCROLLTOTOP = function () {
            var BTN, // will store the clickable button
        
            /**
             * Scrolls window to top
             */
            top = function () {
                $(window).scrollTop(0);
            },
        
            /**
             * Scroll event handler
             */
            scroll = function () {
                var wh = $(window).height(), // window height
                bh = $('body').height(), // body height
                s = $(window).scrollTop(); // current scroll

                // don't show on small pages
                if(bh < (wh * 2)) {
                    return;
                }

                // show after 1st fold
                if(s >= wh) {
                    BTN.addClass('shown');
                } else {
                    BTN.removeClass('shown');
                }
            },
        
            /**
             * Initialize event
             */
            init = function () {            
                // add the button
                $('body').append('<a id="scroll-to-top"><svg id="stt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z"/></svg></a>');
                // reference
                BTN = $('#scroll-to-top');            
                // events
                $(window).on('scroll', scroll);
                BTN.on('click', top);
                // run first instance
                scroll();
            };
        
            // initialize
            init();
        };

        new SCROLLTOTOP();
    }
);

})(jQuery, window, document);
