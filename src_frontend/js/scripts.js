var GENERAL = GENERAL || {};

(function (GENERAL, $, window, document, undefined) {

    'use strict';

    GENERAL.mainURL = '';

    //Responsive
    var numWindowHeight; // = $(window).height();
    var numWindowWidth; // = $(window).width();


    //PRELOAD
    //var preloaderGeral;

    GENERAL.init = function(e){

      //resize method
      $(window).resize(GENERAL.onWindowResize);
      GENERAL.onWindowResize();


        GENERAL.initForms();a
    };

    GENERAL.onWindowResize = function(e) {

        numWindowHeight = $(window).height();
        numWindowWidth = $(window).width();

    };

    GENERAL.initForms = function(){
        $(':data(slug-target)').keypress(function(){
            var ref = $(this);
            var target= $(ref.data('slug-target'));

            target.val(convertToSlug(ref.val()));
        });
    };

//    GENERAL.render = function(){
//        stage.update();
//
//        requestAnimationFrame(GENERAL.render);
//    };


    $(function () {

        GENERAL.init();

    });

})(GENERAL, jQuery, window, document);



function validateOnlyNumbers(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function convertToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

    return str;
};
