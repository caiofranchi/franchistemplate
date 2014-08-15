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
        // Initialize the jQuery File Upload widget:
//        $('#fileupload').fileupload({
//            // Uncomment the following to send cross-domain cookies:
//            //xhrFields: {withCredentials: true},
//            url: global.mainURL+'portfolio/upload/'
//        });

        $('#fileupload').fileupload({
            url: global.mainUrl+'assets/uploads/',
            processQueue: [
                {
                    action: 'loadImage',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resizeImage',
                    maxWidth: 1920,
                    maxHeight: 1200
                },
                {action: 'saveImage'},
                {action: 'duplicateImage'},
                {
                    action: 'resizeImage',
                    maxWidth: 1280,
                    maxHeight: 1024
                },
                {action: 'saveImage'},
                {action: 'duplicateImage'},
                {
                    action: 'resizeImage',
                    maxWidth: 1024,
                    maxHeight: 768
                },
                {action: 'saveImage'}
            ]
        });


//        // Enable iframe cross-domain access via redirect option:
//        $('#fileupload').fileupload(
//            'option',
//            'redirect',
//            window.location.href.replace(
//                /\/[^\/]*$/,
//                '/cors/result.html?%s'
//            )
//        );
//
//        if (window.location.hostname === 'blueimp.github.io') {
//            // Demo settings:
//            $('#fileupload').fileupload('option', {
//                url: '//jquery-file-upload.appspot.com/',
//                // Enable image resizing, except for Android and Opera,
//                // which actually support image resizing, but fail to
//                // send Blob objects via XHR requests:
//                disableImageResize: /Android(?!.*Chrome)|Opera/
//                    .test(window.navigator.userAgent),
//                maxFileSize: 5000000,
//                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
//            });
//            // Upload server status check for browsers with CORS support:
//            if ($.support.cors) {
//                $.ajax({
//                    url: '//jquery-file-upload.appspot.com/',
//                    type: 'HEAD'
//                }).fail(function () {
//                    $('<div class="alert alert-danger"/>')
//                        .text('Upload server currently unavailable - ' +
//                            new Date())
//                        .appendTo('#fileupload');
//                });
//            }
//        } else {
//            // Load existing files:
//            $('#fileupload').addClass('fileupload-processing');
//            $.ajax({
//                // Uncomment the following to send cross-domain cookies:
//                //xhrFields: {withCredentials: true},
//                url: $('#fileupload').fileupload('option', 'url'),
//                dataType: 'json',
//                context: $('#fileupload')[0]
//            }).always(function () {
//                $(this).removeClass('fileupload-processing');
//            }).done(function (result) {
//                $(this).fileupload('option', 'done')
//                    .call(this, $.Event('done'), {result: result});
//            });
//        }

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
