(function(){
    var libs = [
        "https://code.jquery.com/jquery-3.6.0.min.js",
        "https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js",
        "https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js",
        "https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metisMenu.min.js",
        "https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js",
        "https://cdn.jsdelivr.net/npm/@yaireo/tagify@3.23.0/dist/tagify.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.2.0/jquery.countdown.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js",
        "https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js",
        "https://cdn.jsdelivr.net/gh/fooplugins/FooTable@3.1.6/compiled/footable.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jssocials/1.5.0/jssocials.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"
    ];
    var i = 0;
    function loadScript() {
        if (i >= libs.length) return;
        var script = document.createElement('script');
        script.src = libs[i];
        script.onload = function() {
            i++;
            loadScript();
        };
        script.onerror = function() {
            i++;
            loadScript();
        };
        document.head.appendChild(script);
    }
    loadScript();
})();
