/*!
 * jQuery Toggle Click - v1.0.0 - 2020-11-18
 * Copyright DesignThemes
 */
(function( jQuery, window, undefined ) {
    // "use strict";

    var oldToggle = jQuery.fn.toggleClick;

    jQuery.fn.toggleClick = function( fn, fn2 ) {

        // Don't mess with animation or css toggles
        if ( !jQuery.isFunction( fn ) || !jQuery.isFunction( fn2 ) ) {
            return oldToggle.apply( this, arguments );
        }        
    
        // Save reference to arguments for access in closure
        var args = arguments,
            guid = fn.guid || jQuery.guid++,
            i = 0,
            toggler = function( event ) {
                // Figure out which function to execute
                var lastToggle = ( jQuery._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
                jQuery._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
    
                // Make sure that clicks stop
                event.preventDefault();
    
                // and execute the function
                return args[ lastToggle ].apply( this, arguments ) || false;
            };
    
        // link all the functions, so any of them can unbind this click handler
        toggler.guid = guid;
        while ( i < args.length ) {
            args[ i++ ].guid = guid;
        }
    
        return this.click( toggler );
    };

})( jQuery, window );