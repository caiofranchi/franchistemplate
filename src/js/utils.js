/**
 * User: cfranchi
 * Date: 04/11/13
 * Time: 17:19
 */
var BrowserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
        this.version = this.searchVersion(navigator.userAgent)
            || this.searchVersion(navigator.appVersion)
            || "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS";
    },
    searchString: function (data) {
        for (var i=0;i<data.length;i++) {
            var dataString = data[i].string;
            var dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].identity;
            if (dataString) {
                if (dataString.indexOf(data[i].subString) != -1)
                    return data[i].identity;
            }
            else if (dataProp)
                return data[i].identity;
        }
    },
    searchVersion: function (dataString) {
        var index = dataString.indexOf(this.versionSearchString);
        if (index == -1) return;
        return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
    },
    dataBrowser: [
        {
            string: navigator.userAgent,
            subString: "Chrome",
            identity: "Chrome"
        },
        {
            string: navigator.userAgent,
            subString: "CriOS",
            identity: "Chrome"
        },
        {   string: navigator.userAgent,
            subString: "OmniWeb",
            versionSearch: "OmniWeb/",
            identity: "OmniWeb"
        },
        {
            string: navigator.vendor,
            subString: "Apple",
            identity: "Safari",
            versionSearch: "Version"
        },
        {
            prop: window.opera,
            identity: "Opera"
        },
        {
            string: navigator.vendor,
            subString: "iCab",
            identity: "iCab"
        },
        {
            string: navigator.vendor,
            subString: "KDE",
            identity: "Konqueror"
        },
        {
            string: navigator.userAgent,
            subString: "Firefox",
            identity: "Firefox"
        },
        {
            string: navigator.vendor,
            subString: "Camino",
            identity: "Camino"
        },
        {   // for newer Netscapes (6+)
            string: navigator.userAgent,
            subString: "Netscape",
            identity: "Netscape"
        },
        {
            string: navigator.userAgent,
            subString: "MSIE",
            identity: "Explorer",
            versionSearch: "MSIE"
        },
        {
            string: navigator.userAgent,
            subString: "Gecko",
            identity: "Mozilla",
            versionSearch: "rv"
        },
        {     // for older Netscapes (4-)
            string: navigator.userAgent,
            subString: "Mozilla",
            identity: "Netscape",
            versionSearch: "Mozilla"
        }
    ],
    dataOS : [
        {
            string: navigator.platform,
            subString: "Win",
            identity: "Windows"
        },
        {
            string: navigator.platform,
            subString: "Mac",
            identity: "Mac"
        },
        {
            string: navigator.userAgent,
            subString: "iPhone",
            identity: "iPhone/iPod"
        },
        {
            string: navigator.platform,
            subString: "Linux",
            identity: "Linux"
        }
    ]

};

BrowserDetect.init();
$('html').addClass( BrowserDetect.browser );

// Mobile Tablet helpers
var isMobile = false;
var isTablet = false;
var userAgent = navigator.userAgent;

if ( (userAgent.indexOf('iPhone') !== -1) || (userAgent.indexOf('Android') !== -1 && userAgent.indexOf('Mobile') !== -1 ))  {
    $('html').addClass('mobile');
    isMobile = true;
} else if (userAgent.indexOf('iPad') !== -1 || userAgent.indexOf('Android') !== -1) {
    $('html').addClass('tablet');
    isTablet = true;
}

if ( userAgent.indexOf('Android') !== -1 )
    $('html').addClass('android');

// Portrait or Landscape
function getScreenOrientationBySize(){
    return ($(window).width() > $(window).height())? 90 : 0;
}

$(window).bind("resize", onOrientationChange);

function onOrientationChange(e) {
    screenOrientation = getScreenOrientationBySize();
    //
    if (screenOrientation === 90)
        $('html').addClass('landscape').removeClass('portrait');
    else
        $('html').addClass('portrait').removeClass('landscape');
};

onOrientationChange();

function setHash(pString) {
    window.location.hash = pString;
};

function getCleanHash(){
    return window.location.hash.replace('#','');
};


// BASIC POLYFILLS

var lastTime = 0;
var vendors = ['ms', 'moz', 'webkit', 'o'];
for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
        || window[vendors[x]+'CancelRequestAnimationFrame'];
}

if (!window.requestAnimationFrame)
    window.requestAnimationFrame = function(callback, element) {
        var currTime = new Date().getTime();
        var timeToCall = Math.max(0, 16 - (currTime - lastTime));
        var id = window.setTimeout(function() { callback(currTime + timeToCall); },
            timeToCall);
        lastTime = currTime + timeToCall;
        return id;
    };

if (!window.cancelAnimationFrame)
    window.cancelAnimationFrame = function(id) {
        clearTimeout(id);
    };

/* TRACKING */

Tracker = {

    init: function() {
        $('[data-track-type]').click(function(e){
            if($(this).target=='_self' && $(this).href.indexOf('http')!==-1){
                e.preventDefault();
                //
                setTimeout(function(){

                },300);
            }
            Tracker.pushState($(this).data('track-type'),$(this).data('track-act'), $(this).data('track-cat'));
        });
    },

    pushState: function(_type, _act, _cat, _label) {

        if (_type === "view")
        {
//            _gaq.push(['_trackPageview', _act]);
                ga('send', 'pageview',_act);
        }
        else
        {
//            _gaq.push(['_trackEvent', cat, _act, opt_label, opt_value, opt_noninteraction]);
            ga('send', 'event', cat, _act, opt_label,opt_value);
        }
    }

};

function gaTrackPageview(e) {
    console.log('pageview: '+e);
    return ga("send", "pageview", e)
};
function gaTrackEvent(e, t, n) {
    console.log('event: '+ e+t+n);
    return ga("send", "trackEvent", e, t, n)
};

function enableGAEvent() {
    return $(".bt-ga-event").on("click", onClickDispatchGAEvent)
};

function onClickDispatchGAEvent(e) {
    var t, n, r;
    n = $(this).attr("data-ga-category");
    t = $(this).attr("data-ga-action");
    r = $(this).attr("data-ga-label");
    return gaTrackEvent(n, t, r);
};

function removeTagsFromString(html)
{
    return html.replace(/<(?:.|\n)*?>/gm, '');
}

function shareURLonFacebook(pURL) {
    var t, n, url, i, s, u;
    url = "http://www.facebook.com/sharer.php?u="+encodeURIComponent(pURL);
    u = 600;
    t = 400;
    s = $(window).height() / 2 - t / 2;
    n = $(window).width() / 2 - u / 2;
    window.open(url, "popFacebook", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width=" + u + ", height=" + t + ", top=" + s + ", left=" + n)
};

function shareOnFacebook(pURLToShare,pTitle,pURLImage,pDescription){
    var t, n, url, i, s, u;
    url = "http://www.facebook.com/sharer.php?s=100&p[url]=" + pURLToShare+"&p[images][0]="+pURLImage+"&p[title]="+pTitle+"&p[summary]="+encodeURIComponent(pDescription);
    u = 600;
    t = 400;
    s = $(window).height() / 2 - t / 2;
    n = $(window).width() / 2 - u / 2;
    window.open(url, "popFacebook", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width=" + u + ", height=" + t + ", top=" + s + ", left=" + n)
}

function shareOnTwitter(pURL,pText){
    var t, n, r, i, s, u;
    i = "https://twitter.com/intent/tweet?url=" + pURL + "&source=tweetbutton&text=" + encodeURIComponent(pText);
    u = 600;
    n = 400;
    s = $(window).height() / 2 - n / 2;
    r = $(window).width() / 2 - u / 2;
    return window.open(i, "popTwitter", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width=" + u + ", height=" + n + ", top=" + s + ", left=" + r)
}

function getViewportScale() {
    this.viewportScale = undefined;

    // Get viewport width
    var viewportWidth = document.documentElement.clientWidth;

    // Abort. Screen width is greater than the viewport width (not fullscreen).
    if(screen.width > viewportWidth) {
//        console.log('Aborted viewport scale measurement. Screen width > viewport width. Returning default 1');
        return 1;

    }

    // Get the orientation corrected screen width
    this.updateOrientation();
    this.screenWidth = screen.width;

    if(this.orientation === 'portrait') {
        // Take smaller of the two dimensions
        if(screen.width > screen.height) this.screenWidth = screen.height;

    }
    else {
        // Take larger of the two dimensions
        if(screen.width < screen.height) this.screenWidth = screen.height;

    }

    // Calculate viewport scale
    this.viewportScale = this.screenWidth / window.innerWidth;
    return this.viewportScale;

};


// Update viewport orientation
//-----------------------------
function updateOrientation () {
    this.orientation = window.orientation;

    if(this.orientation === undefined) {
        // No JavaScript orientation support. Work it out.
        if(document.documentElement.clientWidth > document.documentElement.clientHeight) this.orientation = 'landscape';
        else this.orientation = 'portrait';

    }
    else if(this.orientation === 0 || this.orientation === 180) this.orientation = 'portrait';
    else this.orientation = 'landscape'; // Assumed default, most laptop and PC screens.

};

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/array/shuffle [v1.0]
function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

/**
 * Returns a random number between min and max
 */
function getRandomArbitary (min, max) {
    return Math.random() * (max - min) + min;
}

/**
 * Returns a random integer between min and max
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}