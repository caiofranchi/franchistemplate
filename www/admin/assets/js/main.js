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
        if($('#fileupload').fileupload) $('#fileupload').fileupload({
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 5000000, // 5 MB,
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.progress .progress-bar').html(progress+"%");
                $('.progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            },
            add: function (e, data) {
                $('.progress').show();
                data.submit();

                $($('#fileupload').data('preview')).hide();
                $('.progress .progress-bar').html("0%");
                $('.progress .progress-bar').css(
                    'width',
                    '0%'
                );
            },
            done: function (e, data) {
                $('.progress').fadeOut();
                $($('#fileupload').data('preview')).show();
                $($('#fileupload').data('preview')).attr('src',data.result.files[0].thumbnailUrl);
//                $.each(data.result.files, function (index, file) {
//                    $('<p/>').text(file.name).appendTo(document.body);
//                });
//
//                data.context.text('Upload finished.');
            }
        });

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

        //confirm modals
        $('#confirm-modal').on('show.bs.modal', function(e) {
            var refButton = $(e.relatedTarget);

            $(this).find('.modal-header').html(refButton.data('title'));
            $(this).find('.modal-body').html(refButton.data('text'));
            //link to execute
            $(this).find('.danger').attr('href', refButton.data('href'));
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

//String UTILS
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
