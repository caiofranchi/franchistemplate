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

    };

    GENERAL.onWindowResize = function(e) {

        numWindowHeight = $(window).height();
        numWindowWidth = $(window).width();

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


