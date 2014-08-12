/**
 * Created by cfranchi on 11/08/14.
 */


var ADMIN = ADMIN || {};

(function (ADMIN, $, window, document, undefined) {

    'use strict';

    ADMIN.mainURL = '';

    //Responsive
    var numWindowHeight; // = $(window).height();
    var numWindowWidth; // = $(window).width();


    //PRELOAD
    //var preloaderGeral;

    ADMIN.init = function(e){

        //resize method
        $(window).resize(ADMIN.onWindowResize);
        ADMIN.onWindowResize();


        ADMIN.initForms();
    };

    ADMIN.onWindowResize = function(e) {

        numWindowHeight = $(window).height();
        numWindowWidth = $(window).width();

    };

    ADMIN.initForms = function(){

        //validation

        //only numbers

        //form uploads

        //slug generators
        $('.default-form-validation [data-slug-target]').keyup(function(){
            var ref = $(this);
            var target= $(ref.data('slug-target'));
            target.val(StringUtils.convertToSlug(ref.val()));
        });

        //enable basic text field search-forms
        $('.form-searchable').each(function(){
            var currentForm = $(this);

            currentForm.submit(function(e){
                e.preventDefault();
                //
                var urlAction = $(this).attr('action');
                var searchText = encodeURIComponent($(this).find('#search-txt').val());
                window.open(urlAction+searchText,'_self');
            });

        });

        //datapickers
    };

//    ADMIN.render = function(){
//        stage.update();
//
//        requestAnimationFrame(ADMIN.render);
//    };

    $(function () {

        ADMIN.init();

    });

})(ADMIN, jQuery, window, document);

var StringUtils = {};

StringUtils.validateOnlyNumbers = function (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

StringUtils.convertToSlug = function(str) {
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
