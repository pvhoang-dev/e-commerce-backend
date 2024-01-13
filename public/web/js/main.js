(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    // $(".animsition").animsition({
    //     inClass: 'fade-in',
    //     outClass: 'fade-out',
    //     inDuration: 1500,
    //     outDuration: 800,
    //     linkElement: '.animsition-link',
    //     loading: true,
    //     loadingParentElement: 'html',
    //     loadingClass: 'animsition-loading-1',
    //     loadingInner: '<div class="loader05"></div>',
    //     timeout: false,
    //     timeoutCountdown: 5000,
    //     onLoadEvent: true,
    //     browser: [ 'animation-duration', '-webkit-animation-duration'],
    //     overlay : false,
    //     overlayClass : 'animsition-overlay-slide',
    //     overlayParentElement : 'html',
    //     transition: function(url){ window.location.href = url; }
    // });
    //
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });



})(jQuery);

/*! For license information please see index-182f79bf.8ba94ec3.js.LICENSE.txt */
!function (e, n) {
    "object" == typeof exports && "undefined" != typeof module ? n(exports) : "function" == typeof define && define.amd ? define(["exports"], n) : n((e = "undefined" != typeof globalThis ? globalThis : e || self).xss = {})
}(this, (function (e) {
    "use strict";
    var n = function () {
        return n = Object.assign || function (e) {
            for (var n, t = 1, r = arguments.length; t < r; t++) for (var i in n = arguments[t]) Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i]);
            return e
        }, n.apply(this, arguments)
    };

    function t(e, n, t) {
        if (t || 2 === arguments.length) for (var r, i = 0, a = n.length; i < a; i++) !r && i in n || (r || (r = Array.prototype.slice.call(n, 0, i)), r[i] = n[i]);
        return e.concat(r || Array.prototype.slice.call(n))
    }

    var r = {exports: {}}, i = {}, a = {exports: {}}, o = {};

    function l() {
        return {
            "align-content": !1,
            "align-items": !1,
            "align-self": !1,
            "alignment-adjust": !1,
            "alignment-baseline": !1,
            all: !1,
            "anchor-point": !1,
            animation: !1,
            "animation-delay": !1,
            "animation-direction": !1,
            "animation-duration": !1,
            "animation-fill-mode": !1,
            "animation-iteration-count": !1,
            "animation-name": !1,
            "animation-play-state": !1,
            "animation-timing-function": !1,
            azimuth: !1,
            "backface-visibility": !1,
            background: !0,
            "background-attachment": !0,
            "background-clip": !0,
            "background-color": !0,
            "background-image": !0,
            "background-origin": !0,
            "background-position": !0,
            "background-repeat": !0,
            "background-size": !0,
            "baseline-shift": !1,
            binding: !1,
            bleed: !1,
            "bookmark-label": !1,
            "bookmark-level": !1,
            "bookmark-state": !1,
            border: !0,
            "border-bottom": !0,
            "border-bottom-color": !0,
            "border-bottom-left-radius": !0,
            "border-bottom-right-radius": !0,
            "border-bottom-style": !0,
            "border-bottom-width": !0,
            "border-collapse": !0,
            "border-color": !0,
            "border-image": !0,
            "border-image-outset": !0,
            "border-image-repeat": !0,
            "border-image-slice": !0,
            "border-image-source": !0,
            "border-image-width": !0,
            "border-left": !0,
            "border-left-color": !0,
            "border-left-style": !0,
            "border-left-width": !0,
            "border-radius": !0,
            "border-right": !0,
            "border-right-color": !0,
            "border-right-style": !0,
            "border-right-width": !0,
            "border-spacing": !0,
            "border-style": !0,
            "border-top": !0,
            "border-top-color": !0,
            "border-top-left-radius": !0,
            "border-top-right-radius": !0,
            "border-top-style": !0,
            "border-top-width": !0,
            "border-width": !0,
            bottom: !1,
            "box-decoration-break": !0,
            "box-shadow": !0,
            "box-sizing": !0,
            "box-snap": !0,
            "box-suppress": !0,
            "break-after": !0,
            "break-before": !0,
            "break-inside": !0,
            "caption-side": !1,
            chains: !1,
            clear: !0,
            clip: !1,
            "clip-path": !1,
            "clip-rule": !1,
            color: !0,
            "color-interpolation-filters": !0,
            "column-count": !1,
            "column-fill": !1,
            "column-gap": !1,
            "column-rule": !1,
            "column-rule-color": !1,
            "column-rule-style": !1,
            "column-rule-width": !1,
            "column-span": !1,
            "column-width": !1,
            columns: !1,
            contain: !1,
            content: !1,
            "counter-increment": !1,
            "counter-reset": !1,
            "counter-set": !1,
            crop: !1,
            cue: !1,
            "cue-after": !1,
            "cue-before": !1,
            cursor: !1,
            direction: !1,
            display: !0,
            "display-inside": !0,
            "display-list": !0,
            "display-outside": !0,
            "dominant-baseline": !1,
            elevation: !1,
            "empty-cells": !1,
            filter: !1,
            flex: !1,
            "flex-basis": !1,
            "flex-direction": !1,
            "flex-flow": !1,
            "flex-grow": !1,
            "flex-shrink": !1,
            "flex-wrap": !1,
            float: !1,
            "float-offset": !1,
            "flood-color": !1,
            "flood-opacity": !1,
            "flow-from": !1,
            "flow-into": !1,
            font: !0,
            "font-family": !0,
            "font-feature-settings": !0,
            "font-kerning": !0,
            "font-language-override": !0,
            "font-size": !0,
            "font-size-adjust": !0,
            "font-stretch": !0,
            "font-style": !0,
            "font-synthesis": !0,
            "font-variant": !0,
            "font-variant-alternates": !0,
            "font-variant-caps": !0,
            "font-variant-east-asian": !0,
            "font-variant-ligatures": !0,
            "font-variant-numeric": !0,
            "font-variant-position": !0,
            "font-weight": !0,
            grid: !1,
            "grid-area": !1,
            "grid-auto-columns": !1,
            "grid-auto-flow": !1,
            "grid-auto-rows": !1,
            "grid-column": !1,
            "grid-column-end": !1,
            "grid-column-start": !1,
            "grid-row": !1,
            "grid-row-end": !1,
            "grid-row-start": !1,
            "grid-template": !1,
            "grid-template-areas": !1,
            "grid-template-columns": !1,
            "grid-template-rows": !1,
            "hanging-punctuation": !1,
            height: !0,
            hyphens: !1,
            icon: !1,
            "image-orientation": !1,
            "image-resolution": !1,
            "ime-mode": !1,
            "initial-letters": !1,
            "inline-box-align": !1,
            "justify-content": !1,
            "justify-items": !1,
            "justify-self": !1,
            left: !1,
            "letter-spacing": !0,
            "lighting-color": !0,
            "line-box-contain": !1,
            "line-break": !1,
            "line-grid": !1,
            "line-height": !1,
            "line-snap": !1,
            "line-stacking": !1,
            "line-stacking-ruby": !1,
            "line-stacking-shift": !1,
            "line-stacking-strategy": !1,
            "list-style": !0,
            "list-style-image": !0,
            "list-style-position": !0,
            "list-style-type": !0,
            margin: !0,
            "margin-bottom": !0,
            "margin-left": !0,
            "margin-right": !0,
            "margin-top": !0,
            "marker-offset": !1,
            "marker-side": !1,
            marks: !1,
            mask: !1,
            "mask-box": !1,
            "mask-box-outset": !1,
            "mask-box-repeat": !1,
            "mask-box-slice": !1,
            "mask-box-source": !1,
            "mask-box-width": !1,
            "mask-clip": !1,
            "mask-image": !1,
            "mask-origin": !1,
            "mask-position": !1,
            "mask-repeat": !1,
            "mask-size": !1,
            "mask-source-type": !1,
            "mask-type": !1,
            "max-height": !0,
            "max-lines": !1,
            "max-width": !0,
            "min-height": !0,
            "min-width": !0,
            "move-to": !1,
            "nav-down": !1,
            "nav-index": !1,
            "nav-left": !1,
            "nav-right": !1,
            "nav-up": !1,
            "object-fit": !1,
            "object-position": !1,
            opacity: !1,
            order: !1,
            orphans: !1,
            outline: !1,
            "outline-color": !1,
            "outline-offset": !1,
            "outline-style": !1,
            "outline-width": !1,
            overflow: !1,
            "overflow-wrap": !1,
            "overflow-x": !1,
            "overflow-y": !1,
            padding: !0,
            "padding-bottom": !0,
            "padding-left": !0,
            "padding-right": !0,
            "padding-top": !0,
            page: !1,
            "page-break-after": !1,
            "page-break-before": !1,
            "page-break-inside": !1,
            "page-policy": !1,
            pause: !1,
            "pause-after": !1,
            "pause-before": !1,
            perspective: !1,
            "perspective-origin": !1,
            pitch: !1,
            "pitch-range": !1,
            "play-during": !1,
            position: !1,
            "presentation-level": !1,
            quotes: !1,
            "region-fragment": !1,
            resize: !1,
            rest: !1,
            "rest-after": !1,
            "rest-before": !1,
            richness: !1,
            right: !1,
            rotation: !1,
            "rotation-point": !1,
            "ruby-align": !1,
            "ruby-merge": !1,
            "ruby-position": !1,
            "shape-image-threshold": !1,
            "shape-outside": !1,
            "shape-margin": !1,
            size: !1,
            speak: !1,
            "speak-as": !1,
            "speak-header": !1,
            "speak-numeral": !1,
            "speak-punctuation": !1,
            "speech-rate": !1,
            stress: !1,
            "string-set": !1,
            "tab-size": !1,
            "table-layout": !1,
            "text-align": !0,
            "text-align-last": !0,
            "text-combine-upright": !0,
            "text-decoration": !0,
            "text-decoration-color": !0,
            "text-decoration-line": !0,
            "text-decoration-skip": !0,
            "text-decoration-style": !0,
            "text-emphasis": !0,
            "text-emphasis-color": !0,
            "text-emphasis-position": !0,
            "text-emphasis-style": !0,
            "text-height": !0,
            "text-indent": !0,
            "text-justify": !0,
            "text-orientation": !0,
            "text-overflow": !0,
            "text-shadow": !0,
            "text-space-collapse": !0,
            "text-transform": !0,
            "text-underline-position": !0,
            "text-wrap": !0,
            top: !1,
            transform: !1,
            "transform-origin": !1,
            "transform-style": !1,
            transition: !1,
            "transition-delay": !1,
            "transition-duration": !1,
            "transition-property": !1,
            "transition-timing-function": !1,
            "unicode-bidi": !1,
            "vertical-align": !1,
            visibility: !1,
            "voice-balance": !1,
            "voice-duration": !1,
            "voice-family": !1,
            "voice-pitch": !1,
            "voice-range": !1,
            "voice-rate": !1,
            "voice-stress": !1,
            "voice-volume": !1,
            volume: !1,
            "white-space": !1,
            widows: !1,
            width: !0,
            "will-change": !1,
            "word-break": !0,
            "word-spacing": !0,
            "word-wrap": !0,
            "wrap-flow": !1,
            "wrap-through": !1,
            "writing-mode": !1,
            "z-index": !1
        }
    }

    var u = /javascript\s*\:/gim;
    o.whiteList = {
        "align-content": !1,
        "align-items": !1,
        "align-self": !1,
        "alignment-adjust": !1,
        "alignment-baseline": !1,
        all: !1,
        "anchor-point": !1,
        animation: !1,
        "animation-delay": !1,
        "animation-direction": !1,
        "animation-duration": !1,
        "animation-fill-mode": !1,
        "animation-iteration-count": !1,
        "animation-name": !1,
        "animation-play-state": !1,
        "animation-timing-function": !1,
        azimuth: !1,
        "backface-visibility": !1,
        background: !0,
        "background-attachment": !0,
        "background-clip": !0,
        "background-color": !0,
        "background-image": !0,
        "background-origin": !0,
        "background-position": !0,
        "background-repeat": !0,
        "background-size": !0,
        "baseline-shift": !1,
        binding: !1,
        bleed: !1,
        "bookmark-label": !1,
        "bookmark-level": !1,
        "bookmark-state": !1,
        border: !0,
        "border-bottom": !0,
        "border-bottom-color": !0,
        "border-bottom-left-radius": !0,
        "border-bottom-right-radius": !0,
        "border-bottom-style": !0,
        "border-bottom-width": !0,
        "border-collapse": !0,
        "border-color": !0,
        "border-image": !0,
        "border-image-outset": !0,
        "border-image-repeat": !0,
        "border-image-slice": !0,
        "border-image-source": !0,
        "border-image-width": !0,
        "border-left": !0,
        "border-left-color": !0,
        "border-left-style": !0,
        "border-left-width": !0,
        "border-radius": !0,
        "border-right": !0,
        "border-right-color": !0,
        "border-right-style": !0,
        "border-right-width": !0,
        "border-spacing": !0,
        "border-style": !0,
        "border-top": !0,
        "border-top-color": !0,
        "border-top-left-radius": !0,
        "border-top-right-radius": !0,
        "border-top-style": !0,
        "border-top-width": !0,
        "border-width": !0,
        bottom: !1,
        "box-decoration-break": !0,
        "box-shadow": !0,
        "box-sizing": !0,
        "box-snap": !0,
        "box-suppress": !0,
        "break-after": !0,
        "break-before": !0,
        "break-inside": !0,
        "caption-side": !1,
        chains: !1,
        clear: !0,
        clip: !1,
        "clip-path": !1,
        "clip-rule": !1,
        color: !0,
        "color-interpolation-filters": !0,
        "column-count": !1,
        "column-fill": !1,
        "column-gap": !1,
        "column-rule": !1,
        "column-rule-color": !1,
        "column-rule-style": !1,
        "column-rule-width": !1,
        "column-span": !1,
        "column-width": !1,
        columns: !1,
        contain: !1,
        content: !1,
        "counter-increment": !1,
        "counter-reset": !1,
        "counter-set": !1,
        crop: !1,
        cue: !1,
        "cue-after": !1,
        "cue-before": !1,
        cursor: !1,
        direction: !1,
        display: !0,
        "display-inside": !0,
        "display-list": !0,
        "display-outside": !0,
        "dominant-baseline": !1,
        elevation: !1,
        "empty-cells": !1,
        filter: !1,
        flex: !1,
        "flex-basis": !1,
        "flex-direction": !1,
        "flex-flow": !1,
        "flex-grow": !1,
        "flex-shrink": !1,
        "flex-wrap": !1,
        float: !1,
        "float-offset": !1,
        "flood-color": !1,
        "flood-opacity": !1,
        "flow-from": !1,
        "flow-into": !1,
        font: !0,
        "font-family": !0,
        "font-feature-settings": !0,
        "font-kerning": !0,
        "font-language-override": !0,
        "font-size": !0,
        "font-size-adjust": !0,
        "font-stretch": !0,
        "font-style": !0,
        "font-synthesis": !0,
        "font-variant": !0,
        "font-variant-alternates": !0,
        "font-variant-caps": !0,
        "font-variant-east-asian": !0,
        "font-variant-ligatures": !0,
        "font-variant-numeric": !0,
        "font-variant-position": !0,
        "font-weight": !0,
        grid: !1,
        "grid-area": !1,
        "grid-auto-columns": !1,
        "grid-auto-flow": !1,
        "grid-auto-rows": !1,
        "grid-column": !1,
        "grid-column-end": !1,
        "grid-column-start": !1,
        "grid-row": !1,
        "grid-row-end": !1,
        "grid-row-start": !1,
        "grid-template": !1,
        "grid-template-areas": !1,
        "grid-template-columns": !1,
        "grid-template-rows": !1,
        "hanging-punctuation": !1,
        height: !0,
        hyphens: !1,
        icon: !1,
        "image-orientation": !1,
        "image-resolution": !1,
        "ime-mode": !1,
        "initial-letters": !1,
        "inline-box-align": !1,
        "justify-content": !1,
        "justify-items": !1,
        "justify-self": !1,
        left: !1,
        "letter-spacing": !0,
        "lighting-color": !0,
        "line-box-contain": !1,
        "line-break": !1,
        "line-grid": !1,
        "line-height": !1,
        "line-snap": !1,
        "line-stacking": !1,
        "line-stacking-ruby": !1,
        "line-stacking-shift": !1,
        "line-stacking-strategy": !1,
        "list-style": !0,
        "list-style-image": !0,
        "list-style-position": !0,
        "list-style-type": !0,
        margin: !0,
        "margin-bottom": !0,
        "margin-left": !0,
        "margin-right": !0,
        "margin-top": !0,
        "marker-offset": !1,
        "marker-side": !1,
        marks: !1,
        mask: !1,
        "mask-box": !1,
        "mask-box-outset": !1,
        "mask-box-repeat": !1,
        "mask-box-slice": !1,
        "mask-box-source": !1,
        "mask-box-width": !1,
        "mask-clip": !1,
        "mask-image": !1,
        "mask-origin": !1,
        "mask-position": !1,
        "mask-repeat": !1,
        "mask-size": !1,
        "mask-source-type": !1,
        "mask-type": !1,
        "max-height": !0,
        "max-lines": !1,
        "max-width": !0,
        "min-height": !0,
        "min-width": !0,
        "move-to": !1,
        "nav-down": !1,
        "nav-index": !1,
        "nav-left": !1,
        "nav-right": !1,
        "nav-up": !1,
        "object-fit": !1,
        "object-position": !1,
        opacity: !1,
        order: !1,
        orphans: !1,
        outline: !1,
        "outline-color": !1,
        "outline-offset": !1,
        "outline-style": !1,
        "outline-width": !1,
        overflow: !1,
        "overflow-wrap": !1,
        "overflow-x": !1,
        "overflow-y": !1,
        padding: !0,
        "padding-bottom": !0,
        "padding-left": !0,
        "padding-right": !0,
        "padding-top": !0,
        page: !1,
        "page-break-after": !1,
        "page-break-before": !1,
        "page-break-inside": !1,
        "page-policy": !1,
        pause: !1,
        "pause-after": !1,
        "pause-before": !1,
        perspective: !1,
        "perspective-origin": !1,
        pitch: !1,
        "pitch-range": !1,
        "play-during": !1,
        position: !1,
        "presentation-level": !1,
        quotes: !1,
        "region-fragment": !1,
        resize: !1,
        rest: !1,
        "rest-after": !1,
        "rest-before": !1,
        richness: !1,
        right: !1,
        rotation: !1,
        "rotation-point": !1,
        "ruby-align": !1,
        "ruby-merge": !1,
        "ruby-position": !1,
        "shape-image-threshold": !1,
        "shape-outside": !1,
        "shape-margin": !1,
        size: !1,
        speak: !1,
        "speak-as": !1,
        "speak-header": !1,
        "speak-numeral": !1,
        "speak-punctuation": !1,
        "speech-rate": !1,
        stress: !1,
        "string-set": !1,
        "tab-size": !1,
        "table-layout": !1,
        "text-align": !0,
        "text-align-last": !0,
        "text-combine-upright": !0,
        "text-decoration": !0,
        "text-decoration-color": !0,
        "text-decoration-line": !0,
        "text-decoration-skip": !0,
        "text-decoration-style": !0,
        "text-emphasis": !0,
        "text-emphasis-color": !0,
        "text-emphasis-position": !0,
        "text-emphasis-style": !0,
        "text-height": !0,
        "text-indent": !0,
        "text-justify": !0,
        "text-orientation": !0,
        "text-overflow": !0,
        "text-shadow": !0,
        "text-space-collapse": !0,
        "text-transform": !0,
        "text-underline-position": !0,
        "text-wrap": !0,
        top: !1,
        transform: !1,
        "transform-origin": !1,
        "transform-style": !1,
        transition: !1,
        "transition-delay": !1,
        "transition-duration": !1,
        "transition-property": !1,
        "transition-timing-function": !1,
        "unicode-bidi": !1,
        "vertical-align": !1,
        visibility: !1,
        "voice-balance": !1,
        "voice-duration": !1,
        "voice-family": !1,
        "voice-pitch": !1,
        "voice-range": !1,
        "voice-rate": !1,
        "voice-stress": !1,
        "voice-volume": !1,
        volume: !1,
        "white-space": !1,
        widows: !1,
        width: !0,
        "will-change": !1,
        "word-break": !0,
        "word-spacing": !0,
        "word-wrap": !0,
        "wrap-flow": !1,
        "wrap-through": !1,
        "writing-mode": !1,
        "z-index": !1
    }, o.getDefaultWhiteList = l, o.onAttr = function (e, n, t) {
    }, o.onIgnoreAttr = function (e, n, t) {
    }, o.safeAttrValue = function (e, n) {
        return u.test(n) ? "" : n
    };
    var c = {
        indexOf: function (e, n) {
            var t, r;
            if (Array.prototype.indexOf) return e.indexOf(n);
            for (t = 0, r = e.length; t < r; t++) if (e[t] === n) return t;
            return -1
        }, forEach: function (e, n, t) {
            var r, i;
            if (Array.prototype.forEach) return e.forEach(n, t);
            for (r = 0, i = e.length; r < i; r++) n.call(t, e[r], r, e)
        }, trim: function (e) {
            return String.prototype.trim ? e.trim() : e.replace(/(^\s*)|(\s*$)/g, "")
        }, trimRight: function (e) {
            return String.prototype.trimRight ? e.trimRight() : e.replace(/(\s*$)/g, "")
        }
    }, s = c, d = o, f = function (e, n) {
        ";" !== (e = s.trimRight(e))[e.length - 1] && (e += ";");
        var t = e.length, r = !1, i = 0, a = 0, o = "";

        function l() {
            if (!r) {
                var t = s.trim(e.slice(i, a)), l = t.indexOf(":");
                if (-1 !== l) {
                    var u = s.trim(t.slice(0, l)), c = s.trim(t.slice(l + 1));
                    if (u) {
                        var d = n(i, o.length, u, c, t);
                        d && (o += d + "; ")
                    }
                }
            }
            i = a + 1
        }

        for (; a < t; a++) {
            var u = e[a];
            if ("/" === u && "*" === e[a + 1]) {
                var c = e.indexOf("*/", a + 2);
                if (-1 === c) break;
                i = (a = c + 1) + 1, r = !1
            } else "(" === u ? r = !0 : ")" === u ? r = !1 : ";" === u ? r || l() : "\n" === u && l()
        }
        return s.trim(o)
    };

    function v(e) {
        return null == e
    }

    function p(e) {
        (e = function (e) {
            var n = {};
            for (var t in e) n[t] = e[t];
            return n
        }(e || {})).whiteList = e.whiteList || d.whiteList, e.onAttr = e.onAttr || d.onAttr, e.onIgnoreAttr = e.onIgnoreAttr || d.onIgnoreAttr, e.safeAttrValue = e.safeAttrValue || d.safeAttrValue, this.options = e
    }

    p.prototype.process = function (e) {
        if (!(e = (e = e || "").toString())) return "";
        var n = this.options, t = n.whiteList, r = n.onAttr, i = n.onIgnoreAttr, a = n.safeAttrValue;
        return f(e, (function (e, n, o, l, u) {
            var c = t[o], s = !1;
            if (!0 === c ? s = c : "function" == typeof c ? s = c(l) : c instanceof RegExp && (s = c.test(l)), !0 !== s && (s = !1), l = a(o, l)) {
                var d, f = {position: n, sourcePosition: e, source: u, isWhite: s};
                return s ? v(d = r(o, l, f)) ? o + ":" + l : d : v(d = i(o, l, f)) ? void 0 : d
            }
        }))
    };
    var m = p;
    !function (e, n) {
        var t = o, r = m;
        for (var i in(n = e.exports = function (e, n) {
            return new r(n).process(e)
        }).FilterCSS = r, t) n[i] = t[i];
        "undefined" != typeof window && (window.filterCSS = e.exports)
    }(a, a.exports);
    var h = {
        indexOf: function (e, n) {
            var t, r;
            if (Array.prototype.indexOf) return e.indexOf(n);
            for (t = 0, r = e.length; t < r; t++) if (e[t] === n) return t;
            return -1
        }, forEach: function (e, n, t) {
            var r, i;
            if (Array.prototype.forEach) return e.forEach(n, t);
            for (r = 0, i = e.length; r < i; r++) n.call(t, e[r], r, e)
        }, trim: function (e) {
            return String.prototype.trim ? e.trim() : e.replace(/(^\s*)|(\s*$)/g, "")
        }, spaceIndex: function (e) {
            var n = /\s|\n|\t/.exec(e);
            return n ? n.index : -1
        }
    }, g = a.exports.FilterCSS, b = a.exports.getDefaultWhiteList, w = h;
    var y = new g;

    function _(e) {
        return e.replace(x, "&lt;").replace(k, "&gt;")
    }

    var x = /</g, k = />/g, E = /"/g, C = /&quot;/g, L = /&#([a-zA-Z0-9]*);?/gim, S = /&colon;?/gim,
        T = /&newline;?/gim,
        N = /((j\s*a\s*v\s*a|v\s*b|l\s*i\s*v\s*e)\s*s\s*c\s*r\s*i\s*p\s*t\s*|m\s*o\s*c\s*h\s*a):/gi,
        P = /e\s*x\s*p\s*r\s*e\s*s\s*s\s*i\s*o\s*n\s*\(.*/gi, I = /u\s*r\s*l\s*\(.*/gi;

    function R(e) {
        return e.replace(E, "&quot;")
    }

    function A(e) {
        return e.replace(C, '"')
    }

    function Z(e) {
        return e.replace(L, (function (e, n) {
            return "x" === n[0] || "X" === n[0] ? String.fromCharCode(parseInt(n.substr(1), 16)) : String.fromCharCode(parseInt(n, 10))
        }))
    }

    function D(e) {
        return e.replace(S, ":").replace(T, " ")
    }

    function V(e) {
        for (var n = "", t = 0, r = e.length; t < r; t++) n += e.charCodeAt(t) < 32 ? " " : e.charAt(t);
        return w.trim(n)
    }

    function M(e) {
        return V(e = D(e = Z(e = A(e))))
    }

    function O(e) {
        return _(e = R(e))
    }

    i.whiteList = {
        a: ["target", "href", "title"],
        abbr: ["title"],
        address: [],
        area: ["shape", "coords", "href", "alt"],
        article: [],
        aside: [],
        audio: ["autoplay", "controls", "crossorigin", "loop", "muted", "preload", "src"],
        b: [],
        bdi: ["dir"],
        bdo: ["dir"],
        big: [],
        blockquote: ["cite"],
        br: [],
        caption: [],
        center: [],
        cite: [],
        code: [],
        col: ["align", "valign", "span", "width"],
        colgroup: ["align", "valign", "span", "width"],
        dd: [],
        del: ["datetime"],
        details: ["open"],
        div: [],
        dl: [],
        dt: [],
        em: [],
        figcaption: [],
        figure: [],
        font: ["color", "size", "face"],
        footer: [],
        h1: [],
        h2: [],
        h3: [],
        h4: [],
        h5: [],
        h6: [],
        header: [],
        hr: [],
        i: [],
        img: ["src", "alt", "title", "width", "height"],
        ins: ["datetime"],
        li: [],
        mark: [],
        nav: [],
        ol: [],
        p: [],
        pre: [],
        s: [],
        section: [],
        small: [],
        span: [],
        sub: [],
        summary: [],
        sup: [],
        strong: [],
        strike: [],
        table: ["width", "border", "align", "valign"],
        tbody: ["align", "valign"],
        td: ["width", "rowspan", "colspan", "align", "valign"],
        tfoot: ["align", "valign"],
        th: ["width", "rowspan", "colspan", "align", "valign"],
        thead: ["align", "valign"],
        tr: ["rowspan", "align", "valign"],
        tt: [],
        u: [],
        ul: [],
        video: ["autoplay", "controls", "crossorigin", "loop", "muted", "playsinline", "poster", "preload", "src", "height", "width"]
    }, i.getDefaultWhiteList = function () {
        return {
            a: ["target", "href", "title"],
            abbr: ["title"],
            address: [],
            area: ["shape", "coords", "href", "alt"],
            article: [],
            aside: [],
            audio: ["autoplay", "controls", "crossorigin", "loop", "muted", "preload", "src"],
            b: [],
            bdi: ["dir"],
            bdo: ["dir"],
            big: [],
            blockquote: ["cite"],
            br: [],
            caption: [],
            center: [],
            cite: [],
            code: [],
            col: ["align", "valign", "span", "width"],
            colgroup: ["align", "valign", "span", "width"],
            dd: [],
            del: ["datetime"],
            details: ["open"],
            div: [],
            dl: [],
            dt: [],
            em: [],
            figcaption: [],
            figure: [],
            font: ["color", "size", "face"],
            footer: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            header: [],
            hr: [],
            i: [],
            img: ["src", "alt", "title", "width", "height"],
            ins: ["datetime"],
            li: [],
            mark: [],
            nav: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            section: [],
            small: [],
            span: [],
            sub: [],
            summary: [],
            sup: [],
            strong: [],
            strike: [],
            table: ["width", "border", "align", "valign"],
            tbody: ["align", "valign"],
            td: ["width", "rowspan", "colspan", "align", "valign"],
            tfoot: ["align", "valign"],
            th: ["width", "rowspan", "colspan", "align", "valign"],
            thead: ["align", "valign"],
            tr: ["rowspan", "align", "valign"],
            tt: [],
            u: [],
            ul: [],
            video: ["autoplay", "controls", "crossorigin", "loop", "muted", "playsinline", "poster", "preload", "src", "height", "width"]
        }
    }, i.onTag = function (e, n, t) {
    }, i.onIgnoreTag = function (e, n, t) {
    }, i.onTagAttr = function (e, n, t) {
    }, i.onIgnoreTagAttr = function (e, n, t) {
    }, i.safeAttrValue = function (e, n, t, r) {
        if (t = M(t), "href" === n || "src" === n) {
            if ("#" === (t = w.trim(t))) return "#";
            if ("http://" !== t.substr(0, 7) && "https://" !== t.substr(0, 8) && "mailto:" !== t.substr(0, 7) && "tel:" !== t.substr(0, 4) && "data:image/" !== t.substr(0, 11) && "ftp://" !== t.substr(0, 6) && "./" !== t.substr(0, 2) && "../" !== t.substr(0, 3) && "#" !== t[0] && "/" !== t[0]) return ""
        } else if ("background" === n) {
            if (N.lastIndex = 0, N.test(t)) return ""
        } else if ("style" === n) {
            if (P.lastIndex = 0, P.test(t)) return "";
            if (I.lastIndex = 0, I.test(t) && (N.lastIndex = 0, N.test(t))) return "";
            !1 !== r && (t = (r = r || y).process(t))
        }
        return O(t)
    }, i.escapeHtml = _, i.escapeQuote = R, i.unescapeQuote = A, i.escapeHtmlEntities = Z, i.escapeDangerHtml5Entities = D, i.clearNonPrintableCharacter = V, i.friendlyAttrValue = M, i.escapeAttrValue = O, i.onIgnoreTagStripAll = function () {
        return ""
    }, i.StripTagBody = function (e, n) {
        "function" != typeof n && (n = function () {
        });
        var t = !Array.isArray(e), r = [], i = !1;
        return {
            onIgnoreTag: function (a, o, l) {
                if (function (n) {
                    return !!t || -1 !== w.indexOf(e, n)
                }(a)) {
                    if (l.isClosing) {
                        var u = "[/removed]", c = l.position + 10;
                        return r.push([!1 !== i ? i : l.position, c]), i = !1, u
                    }
                    return i || (i = l.position), "[removed]"
                }
                return n(a, o, l)
            }, remove: function (e) {
                var n = "", t = 0;
                return w.forEach(r, (function (r) {
                    n += e.slice(t, r[0]), t = r[1]
                })), n += e.slice(t)
            }
        }
    }, i.stripCommentTag = function (e) {
        for (var n = "", t = 0; t < e.length;) {
            var r = e.indexOf("\x3c!--", t);
            if (-1 === r) {
                n += e.slice(t);
                break
            }
            n += e.slice(t, r);
            var i = e.indexOf("--\x3e", r);
            if (-1 === i) break;
            t = i + 3
        }
        return n
    }, i.stripBlankChar = function (e) {
        var n = e.split("");
        return (n = n.filter((function (e) {
            var n = e.charCodeAt(0);
            return !(127 === n || n <= 31 && 10 !== n && 13 !== n)
        }))).join("")
    }, i.cssFilter = y, i.getDefaultCSSWhiteList = b;
    var F = {}, z = h;

    function H(e) {
        var n, t = z.spaceIndex(e);
        return n = -1 === t ? e.slice(1, -1) : e.slice(1, t + 1), "/" === (n = z.trim(n).toLowerCase()).slice(0, 1) && (n = n.slice(1)), "/" === n.slice(-1) && (n = n.slice(0, -1)), n
    }

    function j(e) {
        return "</" === e.slice(0, 2)
    }

    var U = /[^a-zA-Z0-9\\_:.-]/gim;

    function W(e, n) {
        for (; n < e.length; n++) {
            var t = e[n];
            if (" " !== t) return "=" === t ? n : -1
        }
    }

    function q(e, n) {
        for (; n < e.length; n++) {
            var t = e[n];
            if (" " !== t) return "'" === t || '"' === t ? n : -1
        }
    }

    function B(e, n) {
        for (; n > 0; n--) {
            var t = e[n];
            if (" " !== t) return "=" === t ? n : -1
        }
    }

    function G(e) {
        return function (e) {
            return '"' === e[0] && '"' === e[e.length - 1] || "'" === e[0] && "'" === e[e.length - 1]
        }(e) ? e.substr(1, e.length - 2) : e
    }

    F.parseTag = function (e, n, t) {
        var r = "", i = 0, a = !1, o = !1, l = 0, u = e.length, c = "", s = "";
        e:for (l = 0; l < u; l++) {
            var d = e.charAt(l);
            if (!1 === a) {
                if ("<" === d) {
                    a = l;
                    continue
                }
            } else if (!1 === o) {
                if ("<" === d) {
                    r += t(e.slice(i, l)), a = l, i = l;
                    continue
                }
                if (">" === d || l === u - 1) {
                    r += t(e.slice(i, a)), c = H(s = e.slice(a, l + 1)), r += n(a, r.length, c, s, j(s)), i = l + 1, a = !1;
                    continue
                }
                if ('"' === d || "'" === d) for (var f = 1, v = e.charAt(l - f); "" === v.trim() || "=" === v;) {
                    if ("=" === v) {
                        o = d;
                        continue e
                    }
                    v = e.charAt(l - ++f)
                }
            } else if (d === o) {
                o = !1;
                continue
            }
        }
        return i < u && (r += t(e.substr(i))), r
    }, F.parseAttr = function (e, n) {
        var t = 0, r = 0, i = [], a = !1, o = e.length;

        function l(e, t) {
            if (!((e = (e = z.trim(e)).replace(U, "").toLowerCase()).length < 1)) {
                var r = n(e, t || "");
                r && i.push(r)
            }
        }

        for (var u = 0; u < o; u++) {
            var c, s = e.charAt(u);
            if (!1 !== a || "=" !== s) if (!1 === a || u !== r) {
                if (/\s|\n|\t/.test(s)) {
                    if (e = e.replace(/\s|\n|\t/g, " "), !1 === a) {
                        if (-1 === (c = W(e, u))) {
                            l(z.trim(e.slice(t, u))), a = !1, t = u + 1;
                            continue
                        }
                        u = c - 1;
                        continue
                    }
                    if (-1 === (c = B(e, u - 1))) {
                        l(a, G(z.trim(e.slice(t, u)))), a = !1, t = u + 1;
                        continue
                    }
                }
            } else {
                if (-1 === (c = e.indexOf(s, u + 1))) break;
                l(a, z.trim(e.slice(r + 1, c))), a = !1, t = (u = c) + 1
            } else a = e.slice(t, u), t = u + 1, r = '"' === e.charAt(t) || "'" === e.charAt(t) ? t : q(e, u + 1)
        }
        return t < e.length && (!1 === a ? l(e.slice(t)) : l(a, G(z.trim(e.slice(t))))), z.trim(i.join(" "))
    };
    var J = a.exports.FilterCSS, X = i, K = F, Y = K.parseTag, Q = K.parseAttr, $ = h;

    function ee(e) {
        return null == e
    }

    function ne(e) {
        (e = function (e) {
            var n = {};
            for (var t in e) n[t] = e[t];
            return n
        }(e || {})).stripIgnoreTag && (e.onIgnoreTag, e.onIgnoreTag = X.onIgnoreTagStripAll), e.whiteList || e.allowList ? e.whiteList = function (e) {
            var n = {};
            for (var t in e) Array.isArray(e[t]) ? n[t.toLowerCase()] = e[t].map((function (e) {
                return e.toLowerCase()
            })) : n[t.toLowerCase()] = e[t];
            return n
        }(e.whiteList || e.allowList) : e.whiteList = X.whiteList, e.onTag = e.onTag || X.onTag, e.onTagAttr = e.onTagAttr || X.onTagAttr, e.onIgnoreTag = e.onIgnoreTag || X.onIgnoreTag, e.onIgnoreTagAttr = e.onIgnoreTagAttr || X.onIgnoreTagAttr, e.safeAttrValue = e.safeAttrValue || X.safeAttrValue, e.escapeHtml = e.escapeHtml || X.escapeHtml, this.options = e, !1 === e.css ? this.cssFilter = !1 : (e.css = e.css || {}, this.cssFilter = new J(e.css))
    }

    ne.prototype.process = function (e) {
        if (!(e = (e = e || "").toString())) return "";
        var n = this.options, t = n.whiteList, r = n.onTag, i = n.onIgnoreTag, a = n.onTagAttr, o = n.onIgnoreTagAttr,
            l = n.safeAttrValue, u = n.escapeHtml, c = this.cssFilter;
        n.stripBlankChar && (e = X.stripBlankChar(e)), n.allowCommentTag || (e = X.stripCommentTag(e));
        var s = !1;
        n.stripIgnoreTagBody && (s = X.StripTagBody(n.stripIgnoreTagBody, i), i = s.onIgnoreTag);
        var d = Y(e, (function (e, n, s, d, f) {
            var v = {sourcePosition: e, position: n, isClosing: f, isWhite: Object.prototype.hasOwnProperty.call(t, s)},
                p = r(s, d, v);
            if (!ee(p)) return p;
            if (v.isWhite) {
                if (v.isClosing) return "</" + s + ">";
                var m = function (e) {
                    var n = $.spaceIndex(e);
                    if (-1 === n) return {html: "", closing: "/" === e[e.length - 2]};
                    var t = "/" === (e = $.trim(e.slice(n + 1, -1)))[e.length - 1];
                    return t && (e = $.trim(e.slice(0, -1))), {html: e, closing: t}
                }(d), h = t[s], g = Q(m.html, (function (e, n) {
                    var t = -1 !== $.indexOf(h, e), r = a(s, e, n, t);
                    return ee(r) ? t ? (n = l(s, e, n, c)) ? e + '="' + n + '"' : e : ee(r = o(s, e, n, t)) ? void 0 : r : r
                }));
                return d = "<" + s, g && (d += " " + g), m.closing && (d += " /"), d + ">"
            }
            return ee(p = i(s, d, v)) ? u(d) : p
        }), u);
        return s && (d = s.remove(d)), d
    };
    var te = ne;

    function re(e) {
        return re = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
            return typeof e
        } : function (e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        }, re(e)
    }

    !function (e, n) {
        var t = i, r = F, a = te;

        function o(e, n) {
            return new a(n).process(e)
        }

        (n = e.exports = o).filterXSS = o, n.FilterXSS = a, function () {
            for (var e in t) n[e] = t[e];
            for (var i in r) n[i] = r[i]
        }(), "undefined" != typeof window && (window.filterXSS = e.exports), "undefined" != typeof self && "undefined" != typeof DedicatedWorkerGlobalScope && self instanceof DedicatedWorkerGlobalScope && (self.filterXSS = e.exports)
    }(r, r.exports);
    var ie, ae = "function" == typeof atob, oe = "function" == typeof btoa, le = "function" == typeof Buffer,
        ue = "function" == typeof TextDecoder ? new TextDecoder : void 0,
        ce = "function" == typeof TextEncoder ? new TextEncoder : void 0,
        se = Array.prototype.slice.call("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="),
        de = (ie = {}, se.forEach((function (e, n) {
            return ie[e] = n
        })), ie), fe = /^(?:[A-Za-z\d+\/]{4})*?(?:[A-Za-z\d+\/]{2}(?:==)?|[A-Za-z\d+\/]{3}=?)?$/,
        ve = String.fromCharCode.bind(String),
        pe = "function" == typeof Uint8Array.from ? Uint8Array.from.bind(Uint8Array) : function (e) {
            return new Uint8Array(Array.prototype.slice.call(e, 0))
        }, me = function (e) {
            return e.replace(/[^A-Za-z0-9\+\/]/g, "")
        }, he = oe ? function (e) {
            return btoa(e)
        } : le ? function (e) {
            return Buffer.from(e, "binary").toString("base64")
        } : function (e) {
            for (var n, t, r, i, a = "", o = e.length % 3, l = 0; l < e.length;) {
                if ((t = e.charCodeAt(l++)) > 255 || (r = e.charCodeAt(l++)) > 255 || (i = e.charCodeAt(l++)) > 255) throw new TypeError("invalid character found");
                a += se[(n = t << 16 | r << 8 | i) >> 18 & 63] + se[n >> 12 & 63] + se[n >> 6 & 63] + se[63 & n]
            }
            return o ? a.slice(0, o - 3) + "===".substring(o) : a
        }, ge = le ? function (e) {
            return Buffer.from(e).toString("base64")
        } : function (e) {
            for (var n = [], t = 0, r = e.length; t < r; t += 4096) n.push(ve.apply(null, e.subarray(t, t + 4096)));
            return he(n.join(""))
        }, be = function (e) {
            if (e.length < 2) return (n = e.charCodeAt(0)) < 128 ? e : n < 2048 ? ve(192 | n >>> 6) + ve(128 | 63 & n) : ve(224 | n >>> 12 & 15) + ve(128 | n >>> 6 & 63) + ve(128 | 63 & n);
            var n = 65536 + 1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320);
            return ve(240 | n >>> 18 & 7) + ve(128 | n >>> 12 & 63) + ve(128 | n >>> 6 & 63) + ve(128 | 63 & n)
        }, we = /[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g, ye = le ? function (e) {
            return Buffer.from(e, "utf8").toString("base64")
        } : ce ? function (e) {
            return ge(ce.encode(e))
        } : function (e) {
            return he(e.replace(we, be))
        }, _e = function (e) {
            return arguments.length > 1 && void 0 !== arguments[1] && arguments[1] ? function (e) {
                return e.replace(/=/g, "").replace(/[+\/]/g, (function (e) {
                    return "+" == e ? "-" : "_"
                }))
            }(ye(e)) : ye(e)
        }, xe = /[\xC0-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF]{2}|[\xF0-\xF7][\x80-\xBF]{3}/g, ke = function (e) {
            switch (e.length) {
                case 4:
                    var n = ((7 & e.charCodeAt(0)) << 18 | (63 & e.charCodeAt(1)) << 12 | (63 & e.charCodeAt(2)) << 6 | 63 & e.charCodeAt(3)) - 65536;
                    return ve(55296 + (n >>> 10)) + ve(56320 + (1023 & n));
                case 3:
                    return ve((15 & e.charCodeAt(0)) << 12 | (63 & e.charCodeAt(1)) << 6 | 63 & e.charCodeAt(2));
                default:
                    return ve((31 & e.charCodeAt(0)) << 6 | 63 & e.charCodeAt(1))
            }
        }, Ee = ae ? function (e) {
            return atob(me(e))
        } : le ? function (e) {
            return Buffer.from(e, "base64").toString("binary")
        } : function (e) {
            if (e = e.replace(/\s+/g, ""), !fe.test(e)) throw new TypeError("malformed base64.");
            e += "==".slice(2 - (3 & e.length));
            for (var n, t, r, i = "", a = 0; a < e.length;) n = de[e.charAt(a++)] << 18 | de[e.charAt(a++)] << 12 | (t = de[e.charAt(a++)]) << 6 | (r = de[e.charAt(a++)]), i += 64 === t ? ve(n >> 16 & 255) : 64 === r ? ve(n >> 16 & 255, n >> 8 & 255) : ve(n >> 16 & 255, n >> 8 & 255, 255 & n);
            return i
        }, Ce = le ? function (e) {
            return pe(Buffer.from(e, "base64"))
        } : function (e) {
            return pe(Ee(e).split("").map((function (e) {
                return e.charCodeAt(0)
            })))
        }, Le = le ? function (e) {
            return Buffer.from(e, "base64").toString("utf8")
        } : ue ? function (e) {
            return ue.decode(Ce(e))
        } : function (e) {
            return Ee(e).replace(xe, ke)
        }, Se = function (e) {
            return Le(function (e) {
                return me(e.replace(/[-_]/g, (function (e) {
                    return "-" == e ? "+" : "/"
                })))
            }(e))
        }, Te = function (e) {
            return e && e.Math == Math && e
        },
        Ne = Te("object" === ("undefined" == typeof globalThis ? "undefined" : re(globalThis)) && globalThis) || Te("object" === ("undefined" == typeof window ? "undefined" : re(window)) && window) || Te("object" === ("undefined" == typeof self ? "undefined" : re(self)) && self) || Te("object" === ("undefined" == typeof global ? "undefined" : re(global)) && global) || Function("return this")(),
        Pe = new (function () {
            function e() {
                var e = this;
                this.batchData = [], this.uniqKeys = new Set, this.timeout = 2e3, this.lock = !1, this.getSlardarBid = function () {
                    var n, t, r = "douyin_web";
                    if (!r.includes("bid")) return r;
                    if (e.config && e.config.bid) return e.config.bid;
                    var i = Ne;
                    if (i && i._xssBid) return i._xssBid;
                    if (i && i.slardar && "function" == typeof i.slardar.config) {
                        var a = (i.slardar.config() || {}).bid;
                        if (a) return a
                    }
                    if (i && i.Slardar && "function" == typeof i.Slardar.config) {
                        var o = (i.Slardar.config() || {}).bid;
                        if (o) return o
                    }
                    return (null === (t = null === (n = null == i ? void 0 : i.Slardar) || void 0 === n ? void 0 : n._baseParams) || void 0 === t ? void 0 : t.bid) || "argus"
                }, this.getConfigRegion = function () {
                    var n;
                    return "cn".includes("region") ? e.config && e.config.region ? e.config.region : ((null === (n = null == Ne ? void 0 : Ne.gfdatav1) || void 0 === n ? void 0 : n.region) || "cn").toLowerCase() : "cn"
                }, this.gerReportUrl = function () {
                    var n = {
                        cn: Se("aHR0cHM6Ly9tb24uemlqaWVhcGkuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9"),
                        boe: Se("aHR0cHM6Ly9tb24uemlqaWVhcGkuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9"),
                        ttp: Se("aHR0cHM6Ly9tb24udXMudGlrdG9rdi5jb20vbW9uaXRvcl9icm93c2VyL2NvbGxlY3QvYmF0Y2gvc2VjdXJpdHkvP2JpZD0="),
                        va: Se("aHR0cHM6Ly9tb24tdmEuYnl0ZW92ZXJzZWEuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9"),
                        maliva: Se("aHR0cHM6Ly9tb24tdmEuYnl0ZW92ZXJzZWEuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9"),
                        sg: Se("aHR0cHM6Ly9tb24tdmEuYnl0ZW92ZXJzZWEuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9"),
                        boei18n: Se("aHR0cHM6Ly9tb24tdmEuYnl0ZW92ZXJzZWEuY29tL21vbml0b3JfYnJvd3Nlci9jb2xsZWN0L2JhdGNoL3NlY3VyaXR5Lz9iaWQ9")
                    }[e.getConfigRegion()];
                    if (n) return n + e.getSlardarBid()
                }
            }

            return e.prototype.setConfig = function (e) {
                this.config = e
            }, e.prototype.upload = function () {
                var e = this, n = this.gerReportUrl();
                !this.lock && n && 0 !== this.batchData.length && (this.lock = !0, setTimeout((function () {
                    var t = e.batchData.slice(0, 100);
                    e.batchData = e.batchData.slice(100), Ne.fetch(n, {
                        method: "post",
                        body: JSON.stringify(t),
                        headers: {"Content-Type": "application/json"}
                    }).catch((function (e) {
                    })), e.lock = !1, e.upload()
                }), this.timeout))
            }, e.prototype.generateKey = function (e) {
                return e.collectKey ? [e.collectMode, e.collectKey].join("___") : ""
            }, e.prototype.push = function (e) {
                this.batchData.push(e), this.upload()
            }, e.prototype.report = function (e) {
                var n = this.generateKey(e);
                if (Ne.fetch && e.collectKey) {
                    var t = "object" === ("undefined" == typeof window ? "undefined" : re(window)) ? window.location.href : "SSR";
                    e.documentUrl = t;
                    var r = {age: Math.floor(Date.now()), type: "xss", url: t, body: e, "user-agent": ""};
                    "enforce" === e.disposition && "SSR" !== t || (r.url = n), "SSR" === t && (r.url = "SSR___".concat(r.url), r.body.ssr = !0), this.push(r)
                }
            }, e
        }()), Ie = function (e) {
            for (var n = 0, t = function (t) {
                Array.isArray(e[t]) ? 0 === e[t].length ? delete e[t] : (e[t] = Array.from(new Set(e[t])), n += e[t].length) : 0 === Object.keys(e[t]).length ? delete e[t] : Object.keys(e[t]).forEach((function (r) {
                    e[t][r] = Array.from(new Set(e[t][r])), n += e[t][r].length
                }))
            }, r = 0, i = Object.keys(e); r < i.length; r++) t(i[r]);
            return {count: n, ret: e}
        };

    function Re(e, n) {
        return Pe.setConfig(n), new r.exports.FilterXSS(n).process(e)
    }

    function Ae(e) {
        var n, t = (n = /\s|\n|\t/.exec(e)) ? n.index : -1;
        if (-1 === t) return {html: "", closing: "/" === e[e.length - 2]};
        var r = "/" === (e = e.slice(t + 1, -1).trim())[e.length - 1];
        return r && (e = e.slice(0, -1).trim()), {html: e, closing: r}
    }

    var Ze = function (e) {
        return -1 === (e = (e = (e = (e = e.replace(/&colon;/gi, ":")).replace(/&tab;/gi, "")).replace(/&newline;/gi, "")).replace(/(\t|\n|\r)/g, "")).indexOf("&#") ? e.trim().toLowerCase() : e.trim().replace(/&#(?:(x)([0-9a-f]+)|([0-9]+));?/gi, (function (e, n, t, r) {
            return String.fromCharCode(n ? parseInt(t, 16) : parseInt(r))
        })).toLowerCase()
    };

    function De(e, n) {
        if (void 0 === e && (e = ""), "string" != typeof e) return !0;
        if ((e = Ze(e)).includes("base64") && !function (e) {
            if ("" === e || "" === e.trim()) return !0;
            try {
                return !e.includes("data:text/html;base64")
            } catch (e) {
                return !0
            }
        }(e)) return n && n("data:text/html;base64"), !1;
        var t = ["expression(", "behavior:", "view-source:"];
        if (t.some((function (n) {
            return -1 !== e.indexOf(n)
        }))) return t.forEach((function (t) {
            -1 !== e.indexOf(t) && n && n(t)
        })), !1;
        var r = ["data:application", "data:javascript", "data:text/html", "data:texthtml"];
        if (r.some((function (n) {
            return -1 !== e.indexOf(n)
        }))) return r.forEach((function (t) {
            -1 !== e.indexOf(t) && n && n(t)
        })), !1;
        if (e.indexOf("javascript:") > 0) return n && n("javascript:"), !1;
        if (/^javascript:/i.test(e)) {
            var i = e.slice(11).replace(/\s/g, "").trim();
            return !!["void", "void(0)", "void0", "false", "undefined", ";"].some((function (e) {
                return e === i
            })) || (n && n("javascript:"), !1)
        }
        return !0
    }

    var Ve = function (e, n) {
        return De(e, n) ? e : "#"
    };

    function Me(e, n, r) {
        if (void 0 === e && (e = ""), void 0 === n && (n = []), "string" != typeof e) return !0;
        if (!De(e = Ze(e))) return !1;
        var i = function (e) {
            var n = e.match(/^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/) || [];
            return {url: n[0], scheme: n[1], slash: n[2], host: n[3], port: n[4], path: n[5], query: n[6], hash: n[7]}
        }(e), a = i.scheme, o = i.host;
        return r ? Boolean(r(e)) : !["http", "https", "file"].includes(a) || ("object" === ("undefined" == typeof window ? "undefined" : re(window)) && window && (n = t(t([], n, !0), [location.host], !1)), n.some((function (e) {
            return !!(e instanceof RegExp && e.test(o)) || e === o
        })))
    }

    var Oe = Me, Fe = Me, ze = {
        a: ["target", "title", "spellcheck", "rel"],
        canvas: [],
        abbr: ["title"],
        address: [],
        area: ["shape", "coords", "alt"],
        article: [],
        aside: [],
        audio: ["autoplay", "controls", "loop", "preload"],
        b: [],
        bdi: ["dir"],
        bdo: ["dir"],
        big: [],
        blockquote: ["cite"],
        br: [],
        caption: [],
        center: [],
        cite: [],
        code: [],
        col: ["align", "valign", "span", "width"],
        colgroup: ["align", "valign", "span", "width"],
        dd: [],
        del: ["datetime"],
        details: ["open"],
        div: ["dir"],
        dl: [],
        dt: [],
        em: [],
        font: ["color", "size", "face"],
        footer: [],
        h1: [],
        h2: [],
        h3: [],
        h4: [],
        h5: [],
        h6: [],
        header: [],
        hr: [],
        i: [],
        img: ["alt", "title", "width", "height", "decoding"],
        ins: ["datetime"],
        li: [],
        mark: [],
        nav: [],
        ol: ["start"],
        p: [],
        pre: [],
        s: [],
        section: [],
        small: [],
        span: [],
        sub: [],
        sup: [],
        delete: [],
        form: [],
        strong: [],
        mask: ["maskunits", "x", "y", "width", "height", "fill"],
        table: ["width", "border", "align", "valign"],
        tbody: ["align", "valign"],
        td: ["width", "rowspan", "colspan", "align", "valign"],
        tfoot: ["align", "valign"],
        th: ["width", "rowspan", "colspan", "align", "valign"],
        thead: ["align", "valign"],
        tr: ["rowspan", "align", "valign"],
        tt: [],
        u: [],
        ul: [],
        wbr: [],
        video: ["autoplay", "controls", "loop", "preload", "height", "width"],
        svg: ["viewBox", "version", "xmlns", "fill", "width", "height", "stroke", "stroke-width", "style"],
        path: ["d", "fill", "opacity", "stroke", "p-id", "fill-rule", "clip-rule", "stroke-width", "stroke-linecap", "stroke-linejoin", "fill-opacity", "mask"],
        rect: ["x", "y", "width", "height", "fill", "stroke", "rx"],
        g: []
    }, He = {
        collect: null, initCollect: function () {
            this.collect = {whiteList: {}, filterProtocol: []}
        }, removeCollect: function () {
            var e = Ie(this.collect), n = e.count, t = e.ret;
            return this.collect = null, {collectKey: 0 === n ? null : JSON.stringify(t), collectMode: "white"}
        }, onIgnoreTagAttr: function (e, n, r) {
            return e && ["href", "src"].indexOf(n) > -1 ? He.domainWhiteList && Array.isArray(He.domainWhiteList) && He.domainWhiteList.length > 0 && !Oe(r, t([], He.domainWhiteList, !0)) ? "" : "".concat(n, '="').concat(Ve(r, (function (e) {
                var n;
                null === (n = He.collect) || void 0 === n || n.filterProtocol.push(e)
            })), '"') : e && (["style", "class", "id"].indexOf(n) > -1 || n.indexOf("data-") > -1) ? "".concat(n, '="').concat(r, '"') : (He.collect.whiteList[e] = He.collect.whiteList[e] || [], void He.collect.whiteList[e].push(n))
        }, onIgnoreTag: function (e, n) {
            if ("style" === e) return n;
            r.exports.parseTag(n, (function (e, n, t, i) {
                var a = Ae(i);
                r.exports.parseAttr(a.html.replace("/", ""), (function (e) {
                    He.collect.whiteList[t] = He.collect.whiteList[t] || [], He.collect.whiteList[t].push(e)
                }))
            }), r.exports.escapeHtml)
        }, whiteList: ze, mergeWhiteList: function (e) {
            for (var n = {}, t = 0, r = Object.keys(ze); t < r.length; t++) n[o = r[t]] = Array.from(ze[o]);
            for (var i = 0, a = Object.keys(e); i < a.length; i++) {
                var o;
                n[o = a[i]] = o in ze ? ze[o].concat(e[o]) : Array.from(e[o])
            }
            return n
        }, setWhiteList: function (e) {
            for (var n = 0, t = Object.keys(e); n < t.length; n++) {
                var r = t[n];
                this.whiteList[r] = r in ze ? ze[r].concat(e[r]) : Array.from(e[r])
            }
        }
    };
    try {
        var je = JSON.parse({}.replace(/'/g, '"')), Ue = "merge";
        Ue.includes("override") && (He.whiteList = je.whiteList), Ue.includes("merge") && He.setWhiteList(je.whiteList)
    } catch (e) {
    }
    var We = {
        blackList: {
            a: ["folder"],
            meta: ["content"],
            iframe: ["srcdoc"],
            input: ["pattern"],
            vmlframe: ["xmlns"]
        },
        blackTags: ["script", "xml", "embed", "isindex", "object", "base", "set", "handler", "animate", "payload", "import"],
        blackAttrs: ["charset", "ns", "namespace", "formaction", "xlink:href", "xmlns:xlink", "handler", "repeat", "repeat-start", "repeat-end"],
        blackAttrRegExps: [/^on/],
        filterList: {param: ["value"], video: ["poster"], form: ["action"]},
        filterAttrs: ["href", "src", "background", "style", "dynsrc", "lowsrc", "content"]
    };
    try {
        var qe = JSON.parse({}.replace(/'/g, '"'));
        qe.blackAttrRegExps && (qe.blackAttrRegExps = qe.blackAttrRegExps.map((function (e) {
            return new RegExp(e.toString().slice(1, e.toString().length - 1))
        })));
        var Be = "merge";
        Be.includes("override") && (We = qe), Be.includes("merge") && (We = function e(n, t) {
            for (var r = {}, i = 0, a = Object.keys(n); i < a.length; i++) {
                var o = a[i];
                Array.isArray(n[o]) ? r[o] = Array.from(n[o]) : r[o] = e({}, n[o])
            }
            for (var l = 0, u = Object.keys(t); l < u.length; l++) (o = u[l]) in n ? Array.isArray(n[o]) ? r[o] = n[o].concat(t[o]) : r[o] = e(n[o], t[o]) : Array.isArray(t[o]) ? r[o] = Array.from(t[o]) : r[o] = e({}, t[o]);
            return r
        }(We, qe))
    } catch (e) {
    }
    var Ge, Je = {
        whiteList: {}, collect: null, initCollect: function () {
            Je.collect = {
                blackList: {},
                blackTags: [],
                blackAttrs: [],
                blackAttrRegExps: [],
                filterAttrs: [],
                filterList: {},
                filterProtocol: []
            }
        }, removeCollect: function () {
            var e = Ie(Je.collect), n = e.count, t = e.ret;
            return Je.collect = null, {collectKey: 0 === n ? null : JSON.stringify(t), collectMode: "black"}
        }, onIgnoreTag: function (e, n) {
            var t;
            if (!We.blackTags.includes(e)) {
                var i = r.exports.parseTag(n, (function (e, n, t, i, a) {
                    if (-1 !== t.indexOf("/")) return r.exports.escapeHtml(i);
                    if (a) return "</".concat(t, ">");
                    var o = Ae(i), l = r.exports.parseAttr(o.html, (function (e, n) {
                        var r, i = 0;
                        if (We.blackList[t] && We.blackList[t].includes(e) && (Je.collect.blackList[t] = Je.collect.blackList[t] || [], Je.collect.blackList[t].push(e), i++), We.blackAttrRegExps.length && We.blackAttrRegExps.some((function (n) {
                            return n.test(e)
                        })) && We.blackAttrRegExps.forEach((function (n) {
                            n.test(e) && (Je.collect.blackAttrRegExps.push("".concat(n.toString(), "->").concat(e)), i++)
                        })), We.blackAttrs.length && We.blackAttrs.includes(e) && (We.blackAttrs.push(e), i++), !i) {
                            if (We.filterList && We.filterList[t] && We.filterList[t].includes(e)) {
                                var a = Ve(n, (function (e) {
                                    var n;
                                    null === (n = Je.collect) || void 0 === n || n.filterProtocol.push(e)
                                }));
                                return a !== n && (Je.collect.filterList[t] = Je.collect.filterList[t] || [], Je.collect.filterList[t].push(e)), n ? "".concat(e, "='").concat(a, "'") : e
                            }
                            return We.filterAttrs && We.filterAttrs.includes(e) ? (a = Ve(n, (function (e) {
                                var n;
                                null === (n = Je.collect) || void 0 === n || n.filterProtocol.push(e)
                            })), a !== n && (null === (r = Je.collect) || void 0 === r || r.filterAttrs.push(e)), n ? "".concat(e, "='").concat(a, "'") : e) : n ? "".concat(e, "='").concat(n, "'") : e
                        }
                    }));
                    return i = "<".concat(t), l && (i += " ".concat(l)), o.closing && (i += " /"), i + ">"
                }), r.exports.escapeHtml);
                return i
            }
            null === (t = Je.collect) || void 0 === t || t.blackTags.push(e)
        }
    }, Xe = function (e) {
        var n = e.reportOnly, t = void 0 === n || n, r = e.block;
        return t && "all" === t ? "report" : r ? "enforce" : t ? "report" : "enforce"
    }, Ke = function (e) {
        return "string" == typeof e ? e.replace(/'/g, '"').replace('=""', "").replace(/\s+/g, "").toLowerCase() : ""
    }, Ye = function (e) {
        return function (t, r, i) {
            if (!t || "string" != typeof t) return t;
            var a = r;
            e === Re && (a = He, i && "black" === i.mode && (a = Je), He.enabled ? a = r : Je.enabled && (a = Je), a.initCollect());
            var o = e(t, a);
            if (Ke(o) === Ke(t)) return t;
            if (!i) return o;
            var l = i.logType, u = Xe(i), c = a.removeCollect();
            return Pe.report(n(n({type: l, disposition: u}, c), {
                sourceText: _e(t),
                filterText: _e(o)
            })), "enforce" === u ? o : t
        }
    }, Qe = Ye(r.exports.filterXSS), $e = Ye(Re), en = (Ge = Ve, function (e, n, t) {
        var r = [], i = Ge(e, (function (e) {
            r.push(e)
        }));
        if (i === e) return e;
        r = Array.from(new Set(r));
        var a = n || t || {};
        if (!a) return i;
        var o = a.logType, l = Xe(t);
        return Pe.report({
            type: o,
            disposition: l,
            collectKey: r.join("___"),
            collectData: JSON.stringify(r),
            collectMode: "black",
            sourceText: _e(e),
            filterText: _e(i)
        }), "enforce" === l ? i : e
    }), nn = Ne._xssProject || {}, tn = Ne.xssNamespace || {}, rn = "3.0.15", an = {
        FilterXSS: r.exports.FilterXSS,
        version: rn,
        filterXSS: Qe,
        _filterXSS: $e,
        filterUrl: en,
        Config: He,
        BlackConfig: Je,
        project: nn,
        setProjectName: function (e) {
            nn[e] = this, Ne._xssProjectName = e
        }
    };
    tn.douyin_web = an, Ne.xssNamespace = tn, Ne.Math && !Ne.Math.xssNamespace && (Ne.Math.xssNamespace = tn), nn[rn] = an, Ne.globalThis = Ne, Ne.getFilterXss = function () {
        return void 0 !== this._xssProjectName ? this._xssProject[this._xssProjectName] : an
    }, Ne.xss = an, Ne.isSafeUrl = Oe, Ne.isSafeDomain = Fe, Ne.isSafeProtocol = De, Ne._xssProject = nn, Ne._xssProjectName && (nn[Ne._xssProjectName] = an);
    var on = an.setProjectName.bind(an);
    e.BlackConfig = Je, e.Config = He, e.FilterXSS = r.exports.FilterXSS, e._filterXSS = $e, e.filterUrl = en, e.filterXSS = Qe, e.isSafeDomain = Fe, e.isSafeProtocol = De, e.isSafeUrl = Oe, e.project = nn, e.setProjectName = on, e.setXssNamespace = function (e) {
        var n = e.appId, t = e.bid, r = e.region, i = e.mode, a = void 0 === i ? "black" : i;
        tn[n] = an;
        var o = null;
        (o = "black" === a ? Je : He).bid = t, o.region = r, o.enabled = !0
    }, e.xssNamespace = tn, Object.defineProperty(e, "__esModule", {value: !0})
})), (self.webpackChunkdouyin_web = self.webpackChunkdouyin_web || []).push([[6629], {
    54817: function (e, n, t) {
        t.d(n, {
            k6: function () {
                return i
            }
        });
        var r = t(14388), i = function () {
            return {
                location: r.m8.location, push: function (e) {
                    r.m8.push(e)
                }, replace: function (e) {
                    r.m8.replace(e)
                }, listen: function (e) {
                    return r.m8.listen(e)
                }, action: r.m8.action
            }
        }
    }, 25991: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "route_id_status_404"
    }, 90745: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "9fbe14bb1d4c7af406feaed69e937377"
    }, 55103: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "943ed2b19b2fd318de7b1b518ee2b99d"
    }, 42207: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "76e0250d1da73c15a48835e643317d95"
    }, 89378: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "1504b9039e896862f1c5dde2ef51497f"
    }, 76871: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "a299a5f32f587be2bcb7e53b7c7b3bd0"
    }, 21828: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "cc03d1291b602605dbc49a94ec461b2c"
    }, 13443: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "deaeeb6675c37f9d29cc3fc6138e2f0e"
    }, 92451: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "5db3a716da0a09d17026ce3ee8ea622f"
    }, 49109: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "48a492c5b87fe38735ba7c3af2fb27f9"
    }, 96410: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "19b897ea53d016b21ed62fbf7ee5cd47"
    }, 54973: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "cba97f6ae7849c3e5426fe0e0cc1151a"
    }, 5820: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "5311ac3a50a980c0245ad661bd2dd882"
    }, 92847: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "863cb3e376aeacfc14699164082d4cc2"
    }, 35133: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "9ce4e57e2d961edc21b884212b8a739a"
    }, 51922: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "91accf38ea060f9a49363b116bfbcd35"
    }, 44124: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "234a8cd88cdf24cd88160469ce35a6a6"
    }, 46616: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "36122c1f39af0623c7bfd1b0d97b3e50"
    }, 11288: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "11edac3663fddad0c08c969810146ccc"
    }, 7593: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "1fbccb70802d212299f2cc81cbf93681"
    }, 80952: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "1249990b4a18dc991d62f4c1f6492ecb"
    }, 26361: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "a811569d037d839434cb019e10037f64"
    }, 88339: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "fe4b2540082757f6a1972668021bd57e"
    }, 49780: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "ca484f86f3379c5e0d09d392994fcd7e"
    }, 51164: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "908a745227b56bacb6d8532c94144eeb"
    }, 42420: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "08214a32f599e3315dd3c503f3bcd5ae"
    }, 61554: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "1977338ef5a6130e46a617ccebecbbf9"
    }, 47150: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "bdf49f98505b07120215daca8377b84b"
    }, 79168: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "ce48284459f63d6d13558833a8afbea7"
    }, 14835: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "7b17906ab67b740197c919be3b8bfea0"
    }, 46868: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "0d41ff35420bb89de9d42bbcdbc79ec0"
    }, 38129: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "809328979cdd42a0c6d512e32a597f2b"
    }, 73163: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "6459dc8e42b0551cc2760234ca3888dc"
    }, 75403: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "c8eb92c9ae38595ef07f4b06f0d0ebb7"
    }, 55554: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "5892835edd28bb5e8e40ed2734543670"
    }, 25176: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "61c304d1ee0242bdbc89c8bbfef79f00"
    }, 46950: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "2839d7ee742bba02fd563b25e3576c64"
    }, 70337: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "7688c3081d8862780d6a7509dc8e3712"
    }, 46412: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "133fe99de3782c40869b768097f2c6c9"
    }, 16666: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "b82dcebed4a3281134278a4576e7e8be"
    }, 84294: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "74931a6b75e09238f154ab1577c994c9"
    }, 72264: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "de003c5145580c24436389498992e4e7"
    }, 47011: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "d079930ec395cbfba0e942a2c81d65f4"
    }, 6990: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "9b191737a614a7c745ae56cbe375fbd1"
    }, 23927: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "f41bac64330ccbe8bf1f220b536f7c3e"
    }, 64859: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "a0ae12a1e012530109fddaecb863cc7d"
    }, 89764: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "e589d829b9e8cf7e38094abcf9c223ed"
    }, 50714: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "b5db0a0e5878a5a56821b44a3c4ad781"
    }, 3163: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "c2fa97635a357db51ef1c2e317d01259"
    }, 59763: function (e, n, t) {
        t.d(n, {
            id: function () {
                return r
            }
        });
        var r = "87b02f146f93b55db2d020775012da15"
    }, 11802: function (e, n, t) {
        var r, i = t(21155), a = t.n(i), o = t(50750), l = t.n(o), u = t(53864), c = function (e) {
            var n, t = {id: "91"};
            return a()(n = l()(e)).call(n, (function (n) {
                t[n] = e[n]()
            })), t
        }, s = [{
            path: "*", component: (r = u.lazy((function () {
                return t.e(9382).then(t.bind(t, 90009))
            })), r.load = function () {
                return t.e(9382).then(t.bind(t, 90009)).then((function (e) {
                    return e
                }))
            }, r.isReactLazy = !0, r), id: t(25991).id, chunks: c({
                chunkName: function () {
                    return "pages-404-tsx"
                }
            })
        }, {
            component: function () {
                var e = u.lazy((function () {
                    return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(4307), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(2631), t.e(3739)]).then(t.bind(t, 7183))
                }));
                return e.load = function () {
                    return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(4307), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(2631), t.e(3739)]).then(t.bind(t, 7183)).then((function (e) {
                        return e
                    }))
                }, e.isReactLazy = !0, e
            }(), index: !0, id: t(59763).id, chunks: c({
                chunkName: function () {
                    return "pages-index-tsx"
                }
            })
        }, {
            path: "about", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(3654).then(t.bind(t, 64049))
                    }));
                    return e.load = function () {
                        return t.e(3654).then(t.bind(t, 64049)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(90745).id, chunks: c({
                    chunkName: function () {
                        return "pages-About-index-tsx"
                    }
                })
            }], id: "94"
        }, {
            path: "asiangames", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6895), t.e(3833), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(5170), t.e(6201), t.e(7251), t.e(5241), t.e(6857)]).then(t.bind(t, 88355))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6895), t.e(3833), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(5170), t.e(6201), t.e(7251), t.e(5241), t.e(6857)]).then(t.bind(t, 88355)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(55103).id, chunks: c({
                    chunkName: function () {
                        return "pages-AsianGames-index-tsx"
                    }
                })
            }], id: "96"
        }, {
            path: "channel", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(6227), t.e(5690), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(5170), t.e(7556), t.e(151), t.e(9804), t.e(4798)]).then(t.bind(t, 30205))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(6227), t.e(5690), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(5170), t.e(7556), t.e(151), t.e(9804), t.e(4798)]).then(t.bind(t, 30205)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(42207).id, chunks: c({
                    chunkName: function () {
                        return "pages-Channel-id-tsx"
                    }
                })
            }, {
                path: "log", component: function () {
                    var e = u.lazy((function () {
                        return t.e(5290).then(t.bind(t, 60144))
                    }));
                    return e.load = function () {
                        return t.e(5290).then(t.bind(t, 60144)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(89378).id, chunks: c({
                    chunkName: function () {
                        return "pages-Channel-log-ts"
                    }
                })
            }], id: "98"
        }, {
            path: "discover", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5690), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(7556), t.e(151), t.e(9804), t.e(6264)]).then(t.bind(t, 16303))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5690), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(7556), t.e(151), t.e(9804), t.e(6264)]).then(t.bind(t, 16303)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(13443).id, chunks: c({
                    chunkName: function () {
                        return "pages-Discover-index-tsx"
                    }
                })
            }], id: "101"
        }, {
            path: "downloadpage", children: [{
                path: ":pageInfo", component: function () {
                    var e = u.lazy((function () {
                        return t.e(6329).then(t.bind(t, 60199))
                    }));
                    return e.load = function () {
                        return t.e(6329).then(t.bind(t, 60199)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(92451).id, chunks: c({
                    chunkName: function () {
                        return "pages-Downloadpage-pageInfo-tsx"
                    }
                })
            }, {
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(6550).then(t.bind(t, 88613))
                    }));
                    return e.load = function () {
                        return t.e(6550).then(t.bind(t, 88613)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(49109).id, chunks: c({
                    chunkName: function () {
                        return "pages-Downloadpage-index-tsx"
                    }
                })
            }], id: "103"
        }, {
            path: "follow", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(222), t.e(9804), t.e(7933), t.e(8476)]).then(t.bind(t, 1432))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(222), t.e(9804), t.e(7933), t.e(8476)]).then(t.bind(t, 1432)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(96410).id, chunks: c({
                    chunkName: function () {
                        return "pages-Follow-index-tsx"
                    }
                })
            }], id: "106"
        }, {
            path: "friend", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(4751), t.e(9804), t.e(7933), t.e(9971)]).then(t.bind(t, 79032))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(4751), t.e(9804), t.e(7933), t.e(9971)]).then(t.bind(t, 79032)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(54973).id, chunks: c({
                    chunkName: function () {
                        return "pages-Friend-index-tsx"
                    }
                })
            }], id: "108"
        }, {
            path: "help", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(1409).then(t.bind(t, 93177))
                    }));
                    return e.load = function () {
                        return t.e(1409).then(t.bind(t, 93177)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(11288).id, chunks: c({
                    chunkName: function () {
                        return "pages-Help-index-tsx"
                    }
                })
            }], id: "110"
        }, {
            path: "hot", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(3867), t.e(151), t.e(3409)]).then(t.bind(t, 37313))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(3867), t.e(151), t.e(3409)]).then(t.bind(t, 37313)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(88339).id, chunks: c({
                    chunkName: function () {
                        return "pages-Hot-index-tsx"
                    }
                })
            }, {
                path: ":id", children: [{
                    path: ":topic", component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(3969)]).then(t.bind(t, 94155))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(3969)]).then(t.bind(t, 94155)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(7593).id, chunks: c({
                        chunkName: function () {
                            return "pages-Hot-id-topic-tsx"
                        }
                    })
                }, {
                    component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(5055)]).then(t.bind(t, 67545))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(5055)]).then(t.bind(t, 67545)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), index: !0, id: t(80952).id, chunks: c({
                        chunkName: function () {
                            return "pages-Hot-id-index-tsx"
                        }
                    })
                }], id: "114"
            }, {
                path: "detail", children: [{
                    path: ":id", component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(597)]).then(t.bind(t, 52161))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(597)]).then(t.bind(t, 52161)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(26361).id, chunks: c({
                        chunkName: function () {
                            return "pages-Hot-detail-id-tsx"
                        }
                    })
                }], id: "117"
            }], id: "112"
        }, {
            path: "htmlmap", children: [{
                path: ":pageInfo", component: function () {
                    var e = u.lazy((function () {
                        return t.e(3637).then(t.bind(t, 19955))
                    }));
                    return e.load = function () {
                        return t.e(3637).then(t.bind(t, 19955)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(49780).id, chunks: c({
                    chunkName: function () {
                        return "pages-Htmlmap-pageInfo-tsx"
                    }
                })
            }], id: "119"
        }, {
            path: "lvdetail", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(4641)]).then(t.bind(t, 63883))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(4641)]).then(t.bind(t, 63883)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(51164).id, chunks: c({
                    chunkName: function () {
                        return "pages-LVDetail-id-tsx"
                    }
                })
            }], id: "121"
        }, {
            path: "light", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(8015)]).then(t.bind(t, 48912))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(8015)]).then(t.bind(t, 48912)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(42420).id, chunks: c({
                    chunkName: function () {
                        return "pages-Light-id-tsx"
                    }
                })
            }], id: "123"
        }, {
            path: "logtrace", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(6643).then(t.bind(t, 27278))
                    }));
                    return e.load = function () {
                        return t.e(6643).then(t.bind(t, 27278)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(61554).id, chunks: c({
                    chunkName: function () {
                        return "pages-LogTrace-index-tsx"
                    }
                })
            }], id: "125"
        }, {
            path: "music", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8310), t.e(151), t.e(2836)]).then(t.bind(t, 40819))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8310), t.e(151), t.e(2836)]).then(t.bind(t, 40819)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(79168).id, chunks: c({
                    chunkName: function () {
                        return "pages-Music-id-tsx"
                    }
                })
            }], id: "127"
        }, {
            path: "musicplaylist", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(7137), t.e(5012), t.e(1607), t.e(6949), t.e(7292), t.e(5628)]).then(t.bind(t, 50074))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(7137), t.e(5012), t.e(1607), t.e(6949), t.e(7292), t.e(5628)]).then(t.bind(t, 50074)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(14835).id, chunks: c({
                    chunkName: function () {
                        return "pages-Musicplaylist-id-tsx"
                    }
                })
            }], id: "129"
        }, {
            path: "note", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(258), t.e(3803), t.e(9046), t.e(151), t.e(5650), t.e(7178)]).then(t.bind(t, 86208))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(258), t.e(3803), t.e(9046), t.e(151), t.e(5650), t.e(7178)]).then(t.bind(t, 86208)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(46868).id, chunks: c({
                    chunkName: function () {
                        return "pages-Note-id-tsx"
                    }
                })
            }], id: "131"
        }, {
            path: "recommend", children: [{
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(4307), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(2631), t.e(5732)]).then(t.bind(t, 61964))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(4307), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(2631), t.e(5732)]).then(t.bind(t, 61964)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(38129).id, chunks: c({
                    chunkName: function () {
                        return "pages-Recommend-index-tsx"
                    }
                })
            }], id: "133"
        }, {
            path: "shipin", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5462), t.e(8203)]).then(t.bind(t, 66976))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5462), t.e(8203)]).then(t.bind(t, 66976)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(73163).id, chunks: c({
                    chunkName: function () {
                        return "pages-Shipin-id-tsx"
                    }
                })
            }, {
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(3343).then(t.bind(t, 50635))
                    }));
                    return e.load = function () {
                        return t.e(3343).then(t.bind(t, 50635)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(55554).id, chunks: c({
                    chunkName: function () {
                        return "pages-Shipin-index-tsx"
                    }
                })
            }, {
                path: "fenlei", children: [{
                    path: ":page", component: function () {
                        var e = u.lazy((function () {
                            return t.e(9753).then(t.bind(t, 82433))
                        }));
                        return e.load = function () {
                            return t.e(9753).then(t.bind(t, 82433)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(75403).id, chunks: c({
                        chunkName: function () {
                            return "pages-Shipin-fenlei-page-tsx"
                        }
                    })
                }], id: "138"
            }], id: "135"
        }, {
            path: "topic", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(3181), t.e(9311)]).then(t.bind(t, 59468))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(3181), t.e(9311)]).then(t.bind(t, 59468)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(25176).id, chunks: c({
                    chunkName: function () {
                        return "pages-Topic-id-tsx"
                    }
                })
            }], id: "140"
        }, {
            path: "user", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(8845), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(9804), t.e(6217)]).then(t.bind(t, 97414))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(8845), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(9804), t.e(6217)]).then(t.bind(t, 97414)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(46950).id, chunks: c({
                    chunkName: function () {
                        return "pages-User-id-tsx"
                    }
                })
            }], id: "142"
        }, {
            path: "vs", children: [{
                path: "playertab", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(9046), t.e(4855), t.e(8511), t.e(618)]).then(t.bind(t, 82039))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(9046), t.e(4855), t.e(8511), t.e(618)]).then(t.bind(t, 82039)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(70337).id, chunks: c({
                    chunkName: function () {
                        return "pages-VS-PlayerTab-tsx"
                    }
                })
            }, {
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(8175)]).then(t.bind(t, 65924))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(8175)]).then(t.bind(t, 65924)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(46412).id, chunks: c({
                    chunkName: function () {
                        return "pages-VS-index-tsx"
                    }
                })
            }, {
                path: "vstab", children: [{
                    component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(9446)]).then(t.bind(t, 31784))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(9446)]).then(t.bind(t, 31784)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), index: !0, id: t(16666).id, chunks: c({
                        chunkName: function () {
                            return "pages-VS-vsTab-index-tsx"
                        }
                    })
                }], id: "147"
            }], id: "144"
        }, {
            path: "video", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(8259)]).then(t.bind(t, 24824))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(8259)]).then(t.bind(t, 24824)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(84294).id, chunks: c({
                    chunkName: function () {
                        return "pages-Video-id-tsx"
                    }
                })
            }], id: "149"
        }, {
            path: "vschannel", children: [{
                path: ":channel", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(4423)]).then(t.bind(t, 91776))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(8511), t.e(4423)]).then(t.bind(t, 91776)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(72264).id, chunks: c({
                    chunkName: function () {
                        return "pages-VsChannel-channel-tsx"
                    }
                })
            }], id: "151"
        }, {
            path: "vsdetail", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(7251), t.e(9314)]).then(t.bind(t, 35043))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(411), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(4855), t.e(7251), t.e(9314)]).then(t.bind(t, 35043)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(47011).id, chunks: c({
                    chunkName: function () {
                        return "pages-VsDetail-id-tsx"
                    }
                })
            }], id: "153"
        }, {
            path: "wallpaper", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(3803), t.e(151), t.e(2063), t.e(9067)]).then(t.bind(t, 79008))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(3803), t.e(151), t.e(2063), t.e(9067)]).then(t.bind(t, 79008)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(6990).id, chunks: c({
                    chunkName: function () {
                        return "pages-Wallpaper-id-tsx"
                    }
                })
            }, {
                component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(3803), t.e(151), t.e(2063), t.e(8180)]).then(t.bind(t, 2194))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(3803), t.e(151), t.e(2063), t.e(8180)]).then(t.bind(t, 2194)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(23927).id, chunks: c({
                    chunkName: function () {
                        return "pages-Wallpaper-index-tsx"
                    }
                })
            }], id: "155"
        }, {
            path: "zhuanti", children: [{
                path: ":id", component: function () {
                    var e = u.lazy((function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(3181), t.e(6914)]).then(t.bind(t, 65651))
                    }));
                    return e.load = function () {
                        return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(6201), t.e(9804), t.e(7933), t.e(3181), t.e(6914)]).then(t.bind(t, 65651)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), id: t(64859).id, chunks: c({
                    chunkName: function () {
                        return "pages-ZhuanTi-id-tsx"
                    }
                })
            }, {
                component: function () {
                    var e = u.lazy((function () {
                        return t.e(6194).then(t.bind(t, 8811))
                    }));
                    return e.load = function () {
                        return t.e(6194).then(t.bind(t, 8811)).then((function (e) {
                            return e
                        }))
                    }, e.isReactLazy = !0, e
                }(), index: !0, id: t(3163).id, chunks: c({
                    chunkName: function () {
                        return "pages-ZhuanTi-index-tsx"
                    }
                })
            }, {
                path: "fenlei", children: [{
                    path: ":page", component: function () {
                        var e = u.lazy((function () {
                            return t.e(7823).then(t.bind(t, 78636))
                        }));
                        return e.load = function () {
                            return t.e(7823).then(t.bind(t, 78636)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(50714).id, chunks: c({
                        chunkName: function () {
                            return "pages-ZhuanTi-fenlei-page-tsx"
                        }
                    })
                }, {
                    path: "headfiltrate", children: [{
                        component: function () {
                            var e = u.lazy((function () {
                                return t.e(4879).then(t.bind(t, 12355))
                            }));
                            return e.load = function () {
                                return t.e(4879).then(t.bind(t, 12355)).then((function (e) {
                                    return e
                                }))
                            }, e.isReactLazy = !0, e
                        }(), index: !0, id: t(89764).id, chunks: c({
                            chunkName: function () {
                                return "pages-ZhuanTi-fenlei-HeadFiltrate-index-tsx"
                            }
                        })
                    }], id: "163"
                }], id: "161"
            }], id: "158"
        }, {
            path: "collection", children: [{
                path: ":id", children: [{
                    path: ":episode", component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(7621)]).then(t.bind(t, 77855))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(7621)]).then(t.bind(t, 77855)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(76871).id, chunks: c({
                        chunkName: function () {
                            return "pages-Collection-id-episode-tsx"
                        }
                    })
                }, {
                    component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(1792)]).then(t.bind(t, 11523))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(258), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9046), t.e(8659), t.e(151), t.e(9804), t.e(5650), t.e(5462), t.e(3745), t.e(1792)]).then(t.bind(t, 11523)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), index: !0, id: t(21828).id, chunks: c({
                        chunkName: function () {
                            return "pages-Collection-id-index-tsx"
                        }
                    })
                }], id: "166"
            }], id: "165"
        }, {
            path: "hashtag", children: [{
                path: ":id", children: [{
                    path: ":page", component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(2661)]).then(t.bind(t, 43184))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(2661)]).then(t.bind(t, 43184)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(5820).id, chunks: c({
                        chunkName: function () {
                            return "pages-Hashtag-id-page-tsx"
                        }
                    })
                }, {
                    component: function () {
                        var e = u.lazy((function () {
                            return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(2393)]).then(t.bind(t, 49444))
                        }));
                        return e.load = function () {
                            return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(2393)]).then(t.bind(t, 49444)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), index: !0, id: t(51922).id, chunks: c({
                        chunkName: function () {
                            return "pages-Hashtag-id-index-tsx"
                        }
                    })
                }, {
                    path: "hot", children: [{
                        path: ":page", component: function () {
                            var e = u.lazy((function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5813)]).then(t.bind(t, 3330))
                            }));
                            return e.load = function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5813)]).then(t.bind(t, 3330)).then((function (e) {
                                    return e
                                }))
                            }, e.isReactLazy = !0, e
                        }(), id: t(92847).id, chunks: c({
                            chunkName: function () {
                                return "pages-Hashtag-id-hot-page-tsx"
                            }
                        })
                    }, {
                        component: function () {
                            var e = u.lazy((function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5647)]).then(t.bind(t, 19224))
                            }));
                            return e.load = function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5647)]).then(t.bind(t, 19224)).then((function (e) {
                                    return e
                                }))
                            }, e.isReactLazy = !0, e
                        }(), index: !0, id: t(35133).id, chunks: c({
                            chunkName: function () {
                                return "pages-Hashtag-id-hot-index-tsx"
                            }
                        })
                    }], id: "173"
                }, {
                    path: "new", children: [{
                        path: ":page", component: function () {
                            var e = u.lazy((function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5268)]).then(t.bind(t, 97027))
                            }));
                            return e.load = function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(5268)]).then(t.bind(t, 97027)).then((function (e) {
                                    return e
                                }))
                            }, e.isReactLazy = !0, e
                        }(), id: t(44124).id, chunks: c({
                            chunkName: function () {
                                return "pages-Hashtag-id-new-page-tsx"
                            }
                        })
                    }, {
                        component: function () {
                            var e = u.lazy((function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(1056)]).then(t.bind(t, 91097))
                            }));
                            return e.load = function () {
                                return Promise.all([t.e(6227), t.e(5012), t.e(3803), t.e(5170), t.e(8014), t.e(151), t.e(2445), t.e(1056)]).then(t.bind(t, 91097)).then((function (e) {
                                    return e
                                }))
                            }, e.isReactLazy = !0, e
                        }(), index: !0, id: t(46616).id, chunks: c({
                            chunkName: function () {
                                return "pages-Hashtag-id-new-index-tsx"
                            }
                        })
                    }], id: "176"
                }], id: "170"
            }], id: "169"
        }, {
            path: "mall", children: [{
                path: "item", children: [{
                    path: ":id", component: function () {
                        var e = u.lazy((function () {
                            return t.e(9775).then(t.bind(t, 29609))
                        }));
                        return e.load = function () {
                            return t.e(9775).then(t.bind(t, 29609)).then((function (e) {
                                return e
                            }))
                        }, e.isReactLazy = !0, e
                    }(), id: t(47150).id, chunks: c({
                        chunkName: function () {
                            return "pages-Mall-item-id-tsx"
                        }
                    })
                }], id: "180"
            }], id: "179"
        }];
        n.Z = s
    }, 24986: function (e, n, t) {
        t.r(n), t.d(n, {
            default: function () {
                return kr
            }, render: function () {
                return xr
            }
        });
        var r = t(64408), i = t(67161), a = t(5594), o = t.n(a), l = t(94090), u = t.n(l), c = (t(28481), t(53864)),
            s = t(26286), d = t(13795), f = t(8590), v = t(9729), p = t(28712), m = t(9191), h = t(79126), g = t(5611),
            b = t(91287), w = t(54817), y = t(1067), _ = t(74218), x = t(12338), k = t(71116), E = t(49815),
            C = t(97664), L = t(51059), S = t(40501), T = t(12345), N = t(21292), P = t(87091),
            I = (0, c.createContext)({}), R = t(11227), A = t.n(R), Z = ["prod", "canary", "grayscale"];
        var D = t(32781), V = t(95921), M = t(59676), O = t(50230), F = t(80806), z = t(353), H = t(30673), j = t(8e3),
            U = t.n(j), W = t(34346), q = t.n(W), B = t(34590), G = t(84249), J = t(47888), X = t(47877), K = t(93226),
            Y = function (e) {
                var n, t, i, a, l, s, d, f, v, p = e.currentNumber, m = e.setCurrentNumber, h = e.awemeInfoList,
                    g = e.setAwemeInfoList, b = e.anyInfo, w = e.close, y = (0, c.useRef)({
                        cursor: null != b && null !== (n = b.mixInfo) && void 0 !== n && n.mixId && (null == b || null === (t = b.mixInfo) || void 0 === t ? void 0 : t.currentEpisode) !== (null == b || null === (i = b.mixInfo) || void 0 === i ? void 0 : i.totalEpisode) ? null == b || null === (a = b.mixInfo) || void 0 === a ? void 0 : a.currentEpisode : -1,
                        hasMore: null != b && null !== (l = b.mixInfo) && void 0 !== l && l.mixId && (null == b || null === (s = b.mixInfo) || void 0 === s ? void 0 : s.currentEpisode) !== (null == b || null === (d = b.mixInfo) || void 0 === d ? void 0 : d.totalEpisode) ? 1 : -1,
                        statusCode: -1,
                        lastMixVideoIndex: null != b && null !== (f = b.mixInfo) && void 0 !== f && f.mixId ? 0 : -1
                    }), _ = (0, c.useRef)({
                        isLoadHotData: !1,
                        lastHotVideoIndex: null != b && b.sentenceId || null != b && null !== (v = b.hotList) && void 0 !== v && v.sentenceId ? 0 : -1
                    }), x = (0, c.useRef)(p), k = (0, c.useRef)(!1);
                return (0, c.useEffect)((function () {
                    null != b && b.awemeId ? (g([b]), m(0)) : null != b && b.sentenceId ? (0, r.Z)(o().mark((function e() {
                        var n, t;
                        return o().wrap((function (e) {
                            for (; ;) switch (e.prev = e.next) {
                                case 0:
                                    return k.current = !0, e.next = 3, (0, G.h$)({
                                        sentenceId: null == b ? void 0 : b.sentenceId,
                                        hotWord: null == b ? void 0 : b.word,
                                        count: 20
                                    });
                                case 3:
                                    t = e.sent, k.current = !1, _.current.isLoadHotData = !0, _.current.lastHotVideoIndex = (null == t || null === (n = t.awemeList) || void 0 === n ? void 0 : n.length) - 1, g(null == t ? void 0 : t.awemeList), m(0);
                                case 9:
                                case"end":
                                    return e.stop()
                            }
                        }), e)
                    })))() : (0, r.Z)(o().mark((function e() {
                        var n;
                        return o().wrap((function (e) {
                            for (; ;) switch (e.prev = e.next) {
                                case 0:
                                    return k.current = !0, e.next = 3, (0, J.m_)({awemeId: b});
                                case 3:
                                    n = e.sent, k.current = !1, 0 !== (null == n ? void 0 : n.statusCode) ? (w(), B.F.info("\u5206\u4eab\u7684\u89c6\u9891\u4e0d\u5b58\u5728")) : (g([null == n ? void 0 : n.detail]), m(0));
                                case 6:
                                case"end":
                                    return e.stop()
                            }
                        }), e)
                    })))()
                }), []), (0, c.useEffect)((function () {
                    -1 !== x.current && -1 !== p && p > x.current && (p > y.current.lastMixVideoIndex && x.current === y.current.lastMixVideoIndex || p > _.current.lastHotVideoIndex && x.current === _.current.lastHotVideoIndex) && B.F.info("\u6682\u65e0\u66f4\u591a".concat(-1 !== y.current.lastMixVideoIndex ? "\u5408\u96c6" : "\u70ed\u70b9", ", \u5df2\u4e3a\u4f60\u64ad\u653e\u63a8\u8350\u89c6\u9891")), x.current = p
                }), [p]), (0, c.useEffect)((function () {
                    Math.abs(Number(null == h ? void 0 : h.length) - p) < 5 && -1 !== p && !k.current && (0, r.Z)(o().mark((function e() {
                        var n, t, r, i, a, l, c, s, d, f, v, b, w, x;
                        return o().wrap((function (e) {
                            for (; ;) switch (e.prev = e.next) {
                                case 0:
                                    if (null === (n = h[p]) || void 0 === n || !n.mixInfo || 1 !== (null === (t = y.current) || void 0 === t ? void 0 : t.hasMore)) {
                                        e.next = 10;
                                        break
                                    }
                                    return k.current = !0, e.next = 4, (0, X.Lz)({
                                        mixId: null === (r = h[p]) || void 0 === r || null === (i = r.mixInfo) || void 0 === i ? void 0 : i.mixId,
                                        cursor: null === (a = y.current) || void 0 === a ? void 0 : a.cursor,
                                        count: 20
                                    });
                                case 4:
                                    c = e.sent, k.current = !1, y.current = {
                                        cursor: null == c ? void 0 : c.cursor,
                                        hasMore: null == c ? void 0 : c.hasMore,
                                        statusCode: null == c ? void 0 : c.statusCode,
                                        lastMixVideoIndex: (null == h ? void 0 : h.length) + (null == c || null === (l = c.data) || void 0 === l ? void 0 : l.length) - 1
                                    }, g((function (e) {
                                        var n;
                                        return u()(n = []).call(n, (0, H.Z)(e), (0, H.Z)((null == c ? void 0 : c.data) || []))
                                    })), e.next = 26;
                                    break;
                                case 10:
                                    if (-1 === _.current.lastHotVideoIndex || _.current.isLoadHotData) {
                                        e.next = 19;
                                        break
                                    }
                                    return k.current = !0, e.next = 14, (0, G.h$)({
                                        sentenceId: null === (s = h[p]) || void 0 === s || null === (d = s.hotList) || void 0 === d ? void 0 : d.sentenceId,
                                        hotWord: null === (f = h[p]) || void 0 === f || null === (v = f.hotList) || void 0 === v ? void 0 : v.title,
                                        count: 20
                                    });
                                case 14:
                                    b = e.sent, k.current = !1, g((function (e) {
                                        var n, t,
                                            r = null == b || null === (n = b.awemeList) || void 0 === n ? void 0 : U()(n).call(n, (function (n) {
                                                var t;
                                                return (null == n ? void 0 : n.awemeId) !== (null === (t = e[0]) || void 0 === t ? void 0 : t.awemeId)
                                            }));
                                        return _.current.isLoadHotData = !0, _.current.lastHotVideoIndex = (null == r ? void 0 : r.length) + e.length - 1, u()(t = []).call(t, (0, H.Z)(e), (0, H.Z)(r || []))
                                    })), e.next = 26;
                                    break;
                                case 19:
                                    return k.current = !0, e.next = 22, (0, K.b)({
                                        awemeId: null === (w = h[p]) || void 0 === w ? void 0 : w.awemeId,
                                        count: 20,
                                        filterGids: q()(h).call(h, (function (e) {
                                            return null == e ? void 0 : e.awemeId
                                        })).join(",") || ""
                                    });
                                case 22:
                                    x = e.sent, k.current = !1, g((function (e) {
                                        var n;
                                        return u()(n = []).call(n, (0, H.Z)(e), (0, H.Z)((null == x ? void 0 : x.awemeList) || []))
                                    })), -1 === p && m(0);
                                case 26:
                                case"end":
                                    return e.stop()
                            }
                        }), e)
                    })))()
                }), [h, p]), null
            }, Q = (0, M.default)((function () {
                return Promise.all([t.e(6245), t.e(7137), t.e(1556), t.e(69), t.e(7712), t.e(5012), t.e(3803), t.e(1607), t.e(6949), t.e(2934), t.e(2447), t.e(7292), t.e(9804), t.e(8930)]).then(t.bind(t, 55281))
            }), {ssr: !1}), $ = function (e) {
                var n, t = e.videoDetail, r = e.userInfo, i = e.dispatch, a = e.abtest, o = (0, c.useState)(!1),
                    l = (0, D.Z)(o, 2), u = l[0], s = l[1], d = (0, V.s0)();
                (0, c.useEffect)((function () {
                    s(Boolean(t));
                    var e = function () {
                        (0, F.t_)(null === z.SessionStorageKeys || void 0 === z.SessionStorageKeys ? void 0 : z.SessionStorageKeys.BackURl, location.pathname)
                    };
                    return window.addEventListener("beforeunload", e), function () {
                        window.removeEventListener("beforeunload", e)
                    }
                }), []);
                var f = (0, c.useCallback)((function () {
                    var e;
                    s(!1), d(null !== (e = (0, F.G)(z.SessionStorageKeys.BackURl)) && void 0 !== e ? e : "/discover", {replace: !0})
                }), []);
                return c.createElement(c.Fragment, null, u && t && c.createElement(Q, {
                    anyInfo: t,
                    userContext: {userInfo: r, dispatch: i},
                    abtestData: a,
                    close: f,
                    anyHooks: Y,
                    logParams: {enter_from: "main_page"},
                    customProps: {},
                    originAwemeInfo: t,
                    shortCutFilteredList: [null === (n = O.getShortcut().dislike) || void 0 === n ? void 0 : n.key]
                }))
            }, ee = c.memo($), ne = t(43332), te = t.n(ne), re = t(31674), ie = t.n(re), ae = t(67330), oe = t(59858),
            le = t(86028), ue = t(56920), ce = t(84093), se = t(68315), de = t(76445), fe = t(97876), ve = t(73596),
            pe = (0, M.default)((function () {
                return Promise.all([t.e(9066), t.e(5978), t.e(7104), t.e(5012), t.e(5170), t.e(6201), t.e(5538), t.e(1064), t.e(2190), t.e(6065)]).then(t.bind(t, 59319))
            }), {ssr: !1}), me = function () {
                var e = (0, c.useState)(!1), n = (0, D.Z)(e, 2), t = n[0], r = n[1], i = (0, c.useState)(undefined),
                    a = (0, D.Z)(i, 2), o = a[0], l = a[1], u = (0, oe.j)(), s = (0, le.S)().userInfo,
                    d = (0, c.useRef)({}), f = c.useMemo((function () {
                        return (null == u ? void 0 : u.liveModalFullplayer) === ue.if.DynamicBg || (null == u ? void 0 : u.liveModalFullplayer) === ue.if.EntranceStrengthen || (null == u ? void 0 : u.liveModalFullplayer) === ue.if.WithoutAction || (null == u ? void 0 : u.liveModalFullplayer) === ue.if.Normal
                    }), [null == u ? void 0 : u.liveModalFullplayer]), v = c.useCallback((function () {
                        var e = new (te())(location.href);
                        e.searchParams.delete("webRid"), history.replaceState(history.state, "", e.href)
                    }), []);
                c.useEffect((function () {
                    if (f) {
                        var e = ae.parseUrl(location.href).query;
                        if (null != e && e.webRid) {
                            var n, t, i = {enter_method: "browser"},
                                a = JSON.parse(null !== (n = localStorage.getItem("liveModalTeaLogParams")) && void 0 !== n ? n : "{}");
                            if ((null == a ? void 0 : a.webRid) === (null == e ? void 0 : e.webRid)) i = JSON.parse(null !== (t = null == a ? void 0 : a.params) && void 0 !== t ? t : "{}");
                            localStorage.removeItem("liveModalTeaLogParams");
                            var o = "";
                            switch (new (te())(location.href).pathname) {
                                case"/follow/":
                                case"/follow":
                                case"/user/self/":
                                case"/user/self":
                                    o = "follow";
                                    break;
                                case"/":
                                    o = "recommend"
                            }
                            o && ((0, de.o)({
                                pauseCustomShortcut: !0,
                                pauseGlobalShortcut: !0,
                                pausePlayControlShortcut: !0
                            }, "live-ui/LiveModal"), r(!0), l({
                                type: o,
                                data: {webRid: e.webRid},
                                enterMethod: ve.a.VIDEO_HEAD,
                                enterType: "query",
                                teaLogParams: i
                            }))
                        }
                    }
                }), [f]);
                var p = c.useCallback((function () {
                    var e, n = ae.parseUrl(location.href).query;
                    localStorage.setItem("liveModalTeaLogParams", ie()({
                        webRid: null == n ? void 0 : n.webRid,
                        params: null !== (e = sessionStorage.getItem("route_params")) && void 0 !== e ? e : ""
                    }))
                }), []);
                c.useEffect((function () {
                    var e = null, n = fe.listen(fe.EVENT.liveModalShow, (function (n) {
                        var t, i, a, o, u, c, s, f;
                        null === (t = window.player) || void 0 === t || null === (i = t.exitFullscreen) || void 0 === i || i.call(t), r(!0), l(n), (0, de.o)({
                            pauseCustomShortcut: !0,
                            pauseGlobalShortcut: !0,
                            pausePlayControlShortcut: !0
                        }, "live-ui/LiveModal"), d.current = {
                            ad_log_extra: null == n || null === (a = n.teaLogParams) || void 0 === a ? void 0 : a.ad_log_extra,
                            live_ad_creative_id: null == n || null === (o = n.teaLogParams) || void 0 === o ? void 0 : o.live_ad_creative_id,
                            live_ad_id: null == n || null === (u = n.teaLogParams) || void 0 === u ? void 0 : u.live_ad_id,
                            cid: null == n || null === (c = n.teaLogParams) || void 0 === c ? void 0 : c.cid,
                            ad_type: null == n || null === (s = n.teaLogParams) || void 0 === s ? void 0 : s.ad_type,
                            if_qianchuan_ad: null == n || null === (f = n.teaLogParams) || void 0 === f ? void 0 : f.if_qianchuan_ad
                        }, e = fe.listen(fe.EVENT.liveModalClose, (function () {
                            var e, n, t, i;
                            null === (e = window.__LIVE_PLAYER__) || void 0 === e || null === (n = e.getPlayer) || void 0 === n || null === (t = n.call(e)) || void 0 === t || null === (i = t.play) || void 0 === i || i.call(t), r(!1), l(undefined), (0, de.m)("live-ui/LiveModal"), v()
                        }))
                    }));
                    window.addEventListener("beforeunload", p);
                    var t = fe.listen(fe.EVENT.liveModalPreload, (function () {
                        pe.preload()
                    }));
                    return fe.emit(fe.EVENT.videoPause), function () {
                        var r;
                        window.removeEventListener("beforeunload", p), null == n || n(), null === (r = e) || void 0 === r || r(), null == t || t()
                    }
                }), []), c.useEffect((function () {
                    var e, n, r, i;
                    if (t) return window.__STORE__ = {
                        userStore: {
                            odin: null === (e = window.__EDEN_SSR_PREFETCHED_DATA__) || void 0 === e || null === (n = e.app) || void 0 === n ? void 0 : n.odin,
                            userInfo: {id_str: null == s || null === (r = s.info) || void 0 === r ? void 0 : r.uid}
                        }
                    }, (0, ce.oG)(null == s || null === (i = s.info) || void 0 === i ? void 0 : i.uid), function () {
                        var e, n;
                        null === (e = window) || void 0 === e || null === (n = e.LiveSlardar) || void 0 === n || n.call(e, "destory"), window.LiveSlardar = null
                    }
                }), [t]), c.useEffect((function () {
                    var e;
                    t ? (0, se.RT)(null !== (e = null == o ? void 0 : o.teaLogParams) && void 0 !== e ? e : {}) : (0, se.lj)()
                }), [t, o]);
                var m = c.useCallback((function () {
                    l(undefined), r(!1), (0, de.m)("live-ui/LiveModal"), fe.emit(fe.EVENT.liveModalClose), v()
                }), [l, r, v]);
                return t ? c.createElement(pe, {closeLiveModal: m, liveModalData: o, adTeaParams: d.current}) : null
            }, he = (0, c.memo)(me), ge = t(92177), be = t(34452);
        var we = t(78384), ye = function () {
            var e = (0, g.DT)(), n = (0, we.fV)(), t = (0, g.FJ)().awemePcClient;
            return {isClient: e, osInfo: n, clientVersion: null != t ? t : ""}
        };
        var _e = t(43088), xe = t(94739), ke = t(79587), Ee = t(87488).I, Ce = t(54029), Le = ke.Context;

        function Se(e) {
            var n = e.defaultUserInfo, t = e.odin, r = Ee(ke, n), i = (0, D.Z)(r, 2), a = i[0], o = i[1],
                l = (0, c.useMemo)((function () {
                    return {dispatch: o, userInfo: a}
                }), [a, o]), u = null == a ? void 0 : a.isLogin, s = a.statusCode,
                d = 1 === (null == t ? void 0 : t.user_is_auth);
            return (0, c.useLayoutEffect)((function () {
                var e = s === _e.ERROR_CODE.ERROR_USER_FORBIDDEN,
                    n = d && 8 === s && !1 === (null == a ? void 0 : a.isLogin);
                n && Ce.Z.sendLog("loginStateLoss"), (e || n) && (0, xe.kS)(""), u === undefined && o({type: "updateUserInfo"});
                var t = (0, xe.no)((function () {
                    o({type: "updateUserInfo"})
                }));
                return function () {
                    t()
                }
            }), [u, s, d]), {userCtx: l, Context: Le}
        }

        var Te = t(54343), Ne = t.n(Te), Pe = t(76335), Ie = t(17809), Re = t(9053), Ae = function () {
            var e = (0, r.Z)(o().mark((function e(n) {
                var t, r, i, a, l, u, c, s = arguments;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return a = s.length > 1 && s[1] !== undefined ? s[1] : 0, l = (null === (t = (0, k.Es)()) || void 0 === t ? void 0 : t.user_unique_id) || "", e.next = 4, (0, Re.$$)(l, n, a);
                        case 4:
                            u = e.sent, (c = (0, k.Es)()).globalwid = u.globalwid, c.globaluid = null !== (r = u.globaluid) && void 0 !== r ? r : c.globaluid, c.globaluType = null !== (i = u.globaluType) && void 0 !== i ? i : c.globaluType, (0, k.hj)(c), (0, d.Rq)();
                        case 11:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n) {
                return e.apply(this, arguments)
            }
        }(), Ze = function () {
            var e = (0, r.Z)(o().mark((function e(n) {
                var t, r, i;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (n) {
                                e.next = 2;
                                break
                            }
                            return e.abrupt("return", null);
                        case 2:
                            return (0, d.Rq)(), t = 2, e.next = 6, Pe.h.getVar({
                                name: "fingerprint_online",
                                defaultValue: ue.ko.NoFingerPrint
                            });
                        case 6:
                            return r = e.sent, i = r === ue.ko.Online ? 1 : 0, e.abrupt("return", Ne()((function () {
                                Ae(t, i)
                            }), 6e5));
                        case 9:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n) {
                return e.apply(this, arguments)
            }
        }();
        var De = t(51113), Ve = t(34547);
        var Me = t(93935), Oe = t.n(Me), Fe = t(50750), ze = t.n(Fe), He = t(7943), je = t.n(He), Ue = t(25337),
            We = t(24869), qe = t(68374), Be = t(28640), Ge = t(31226);

        function Je() {
            return (Je = (0, r.Z)(o().mark((function e() {
                var n, r, i, a, l, u, c, s;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return e.next = 2, t.e(2934).then(t.bind(t, 92934));
                        case 2:
                            return l = e.sent, u = l.default, e.next = 6, Pe.h.getAllVars({timeOutDuration: 5e3});
                        case 6:
                            c = e.sent, s = null === (n = ze()(c)) || void 0 === n || null === (r = q()(n)) || void 0 === r || null === (i = r.call(n, (function (e) {
                                var n;
                                return null == c || null === (n = c[e]) || void 0 === n ? void 0 : n.vid
                            }))) || void 0 === i || null === (a = U()(i).call(i, (function (e) {
                                return !je()(e).call(e, "900")
                            }))) || void 0 === a ? void 0 : a.join(","), u.setABSdkVersion(s);
                        case 9:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))).apply(this, arguments)
        }

        function Xe() {
            return (Xe = (0, r.Z)(o().mark((function e(n) {
                var t, r;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return e.next = 2, (0, Ue.l$)(Oe()(u()(t = []).call(t, (0, H.Z)(Ue.Kl), (0, H.Z)(Ue.Y6), (0, H.Z)(Ge.f)), (function (e) {
                                return e.key
                            })));
                        case 2:
                            r = e.sent, (0, c.startTransition)((function () {
                                n((function (e) {
                                    var n = (0, qe.a)(e || {}, r);
                                    return n && (n.__isLoaded = !0), k.Le.setConfig(k.gI.AbtestData, n), n
                                }))
                            }));
                        case 4:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))).apply(this, arguments)
        }

        function Ke(e) {
            var n = e.abTestData, t = (0, c.useState)((function () {
                return k.Le.setConfig(k.gI.AbtestData, n), n
            })), r = (0, D.Z)(t, 2), i = r[0], a = r[1];
            return (0, c.useEffect)((function () {
                !function (e) {
                    Xe.apply(this, arguments)
                }(a)
            }), []), (0, We.O)(!0, (function () {
                (0, Be.K)((function () {
                    !function () {
                        Je.apply(this, arguments)
                    }()
                }))
            })), {abtest: i}
        }

        var Ye = t(54805), Qe = t(8761), $e = t(91072), en = t(94556), nn = t(48419), tn = t(19006), rn = t(12139),
            an = t(32309), on = t(33389), ln = t(32226), un = t(72603), cn = t(55956), sn = en.g9;
        var dn = t(85845);
        var fn = t(46230);
        var vn = t(85792), pn = t.n(vn), mn = t(28131), hn = t(3400);
        var gn = t(77007), bn = t(56402), wn = t.n(bn), yn = t(56462), _n = t(51365);
        var xn = t(5277);
        var kn = t(30906), En = t(68493), Cn = t.n(En), Ln = t(14392), Sn = t(77547), Tn = t(51613);

        function Nn(e) {
            return Pn.apply(this, arguments)
        }

        function Pn() {
            return (Pn = (0, r.Z)(o().mark((function e(n) {
                var t, r, i, a, l;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (t = (0, p.p)() ? null === (i = (0, ae.parse)(null == n || null === (a = n.request) || void 0 === a ? void 0 : a.search)) || void 0 === i ? void 0 : i.modal_id : null === (r = (0, ae.parse)(location.search)) || void 0 === r ? void 0 : r.modal_id) {
                                e.next = 3;
                                break
                            }
                            return e.abrupt("return", null);
                        case 3:
                            return e.next = 5, (0, Tn.m_)({awemeId: t}, n);
                        case 5:
                            return l = e.sent, e.abrupt("return", null == l ? void 0 : l.detail);
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))).apply(this, arguments)
        }

        var In = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (!(0, p.p)()) {
                                    e.next = 4;
                                    break
                                }
                                t = n.layoutCsrInitialData, e.next = 10;
                                break;
                            case 4:
                                return e.next = 6, (0, T.Ob)();
                            case 6:
                                if (e.t0 = e.sent, e.t0) {
                                    e.next = 9;
                                    break
                                }
                                e.t0 = undefined;
                            case 9:
                                t = e.t0;
                            case 10:
                                return t = t || undefined, e.abrupt("return", t);
                            case 12:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), Rn = t(3857), An = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t, r, i, a, l, u, c, s, d, f, v, m;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                return l = n.ctx, n.ctxData, u = (0, g.ij)(l), c = (0, g.DT)(l), s = (0, we.fV)(l), d = (0, g._Q)(l), f = (0, Rn.a)((0, p.p)() ? l : undefined), v = (0, p.p)() ? l.request.path : null === (t = window) || void 0 === t || null === (r = t.location) || void 0 === r ? void 0 : r.pathname, m = (null == l || null === (i = l.request) || void 0 === i || null === (a = i.header) || void 0 === a ? void 0 : a["x-aweme-clientversion"]) || (0, g.FJ)(l).awemePcClient, e.abrupt("return", {
                                    ua: u,
                                    isClient: c,
                                    osInfo: s,
                                    isSpider: d,
                                    pathname: v,
                                    redirectFrom: f,
                                    clientVersion: m
                                });
                            case 9:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), Zn = function (e) {
                var n, t, r = {};
                null != e && null !== (n = e.userAgent) && void 0 !== n && n.isIE || (null != e && e.abFormatData ? r = null == e ? void 0 : e.abFormatData : (r = (0, Ue.hA)(u()(t = []).call(t, (0, H.Z)(Ue.Kl), (0, H.Z)(Ge.R)), null == e ? void 0 : e.allAbParams), e.abFormatData = r));
                return e.allAbParams = undefined, (0, kn.Z)((0, kn.Z)({}, r), e.backendAbTest)
            }, Dn = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t, r, i, a, l, u, c, s;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (t = n.ctx, r = n.isNotGetUserInfo, !(i = n.isSpider)) {
                                    e.next = 3;
                                    break
                                }
                                return e.abrupt("return", {isLogin: !1, statusCode: 8, isSpider: !0});
                            case 3:
                                if (!r) {
                                    e.next = 7;
                                    break
                                }
                                e.t0 = {}, e.next = 10;
                                break;
                            case 7:
                                return e.next = 9, (0, Re.UQ)(t);
                            case 9:
                                e.t0 = e.sent;
                            case 10:
                                return a = e.t0, u = (l = a || {}).statusCode, c = l.user, s = {}, s = r ? {
                                    isLogin: undefined,
                                    statusCode: -1,
                                    isSpider: i
                                } : 0 === u && null != c && c.uid ? {
                                    isLogin: !0,
                                    info: c,
                                    statusCode: u,
                                    isSpider: i
                                } : {isLogin: !1, statusCode: u || -1, isSpider: i}, e.abrupt("return", s);
                            case 15:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), Vn = function (e, n) {
                return "fulfilled" === e.status ? e.value : n
            }, Mn = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t, r, i, a, l, u, c, s, d, f;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (l = n.ctx, u = n.isSpider, c = {statusCode: -1}, !(0, p.p)() || !u || (0, Ln.mf)(l)) {
                                    e.next = 7;
                                    break
                                }
                                return s = (0, Ln.Ow)(l), d = s.entityId, f = s.entityType, e.next = 6, (0, Sn.Ws)(l, d, f);
                            case 6:
                                c = e.sent;
                            case 7:
                                return e.abrupt("return", {
                                    data: 0 === (null === (t = c) || void 0 === t ? void 0 : t.statusCode) ? null === (r = c) || void 0 === r ? void 0 : r.data : [],
                                    showPos: null === (i = c) || void 0 === i ? void 0 : i.showPos,
                                    statusCode: null === (a = c) || void 0 === a ? void 0 : a.statusCode
                                });
                            case 8:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), On = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t, r, i, a, l, u, c;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (l = n.ctx, u = n.isSpider, c = {statusCode: -1}, !(0, p.p)() || !u) {
                                    e.next = 6;
                                    break
                                }
                                return e.next = 5, (0, Sn.F8)({}, l);
                            case 5:
                                c = e.sent;
                            case 6:
                                return e.abrupt("return", 0 === (null === (t = c) || void 0 === t ? void 0 : t.statusCode) ? [{
                                    links: null === (r = c) || void 0 === r || null === (i = r.data) || void 0 === i || null === (a = q()(i)) || void 0 === a ? void 0 : a.call(i, (function (e) {
                                        return {url: e.url, anchor: e.keyword}
                                    }))
                                }] : []);
                            case 7:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), Fn = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                return e.abrupt("return", !1);
                            case 1:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), zn = function () {
                var e = (0, r.Z)(o().mark((function e(n) {
                    var t, r, i, a, l, c, s, d, f, v, p, m, h, b, w, y, _, x, k, E, C, L, S, T, N, P;
                    return o().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (null == (i = n.ctx) || !i.isDevBackCsrByError) {
                                    e.next = 3;
                                    break
                                }
                                throw new Error("###############Back to web csr##########");
                            case 3:
                                return a = (0, g.DT)(), e.next = 6, In(i);
                            case 6:
                                if (e.t0 = e.sent, e.t0) {
                                    e.next = 9;
                                    break
                                }
                                e.t0 = {};
                            case 9:
                                return l = e.t0, c = Zn(l), e.next = 13, An({ctx: i, ctxData: l});
                            case 13:
                                return s = e.sent, d = s.isSpider, f = d || a, e.next = 18, Cn().allSettled([Dn({
                                    ctx: i,
                                    isSpider: d,
                                    isNotGetUserInfo: f
                                }), Mn({isSpider: d, ctx: i}), On({isSpider: d, ctx: i}), Nn(i), Fn({
                                    ctx: i,
                                    isSpider: d
                                })]);
                            case 18:
                                return v = e.sent, p = (0, D.Z)(v, 5), m = p[0], h = p[1], b = p[2], w = p[3], y = p[4], _ = Vn(m, {
                                    isLogin: undefined,
                                    statusCode: -1,
                                    isSpider: d
                                }), x = Vn(h, []), k = Vn(b, []), E = Vn(w, null), C = {
                                    data: u()(t = (null == x ? void 0 : x.data) || []).call(t, k),
                                    showPos: null == x ? void 0 : x.showPos,
                                    statusCode: null == x ? void 0 : x.statusCode
                                }, L = {
                                    2: {pageFirstFrameLoadStart: {header: 100}, pageFirstFrameLoaded: {}},
                                    4: {pageFirstFrameLoadStart: {}, pageFirstFrameLoaded: {header: 100}},
                                    default: {}
                                }, S = Number(null == i ? void 0 : i.cookies.get("device_web_cpu_core")), T = L[S] ? L[S] : L.default, N = Vn(y, !1), P = (0, kn.Z)((0, kn.Z)((0, kn.Z)({}, s), l), {}, {
                                    abTestData: c,
                                    user: _,
                                    innerLink: C,
                                    videoDetail: E,
                                    lazyLoadConfig: T,
                                    isOptTextHtmlRatio: N,
                                    isMainland: null === (r = null == i ? void 0 : i.isMainland) || void 0 === r || r,
                                    country: null == i ? void 0 : i.country
                                }), e.abrupt("return", P);
                            case 36:
                            case"end":
                                return e.stop()
                        }
                    }), e)
                })));
                return function (n) {
                    return e.apply(this, arguments)
                }
            }(), Hn = t(65146), jn = t(56442), Un = t.n(jn), Wn = t(42953), qn = t.n(Wn), Bn = t(79705), Gn = t.n(Bn),
            Jn = t(33639), Xn = t(44564), Kn = t(8939), Yn = t(67675), Qn = t(50799), $n = t(71443), et = t(8372),
            nt = t(523), tt = (0, c.memo)((function (e) {
                var n = e.abTestData, t = void 0 === n ? {} : n, r = e.current, i = e.onReload, a = e.customProps,
                    o = e.className, l = e.needGrayscale, u = e.errorRefresh, s = e.isSpider, d = e.tccConfig,
                    f = e.isMainland, v = (0, c.useState)(r), p = (0, D.Z)(v, 2), m = p[0], h = p[1], g = (0, V.s0)(),
                    b = ke.Context, w = (0, c.useContext)(b) || {}, y = w.userInfo, _ = w.dispatch;
                (0, c.useEffect)((function () {
                    h(r)
                }), [r]);
                var x = (0, c.useCallback)((function (e, n) {
                    if ("discover" === e) switch (n) {
                        case"enter":
                            nt.qy.enter();
                            break;
                        case"leave":
                            nt.qy.leave();
                            break;
                        case"click":
                            nt.qy.click()
                    }
                }), [t]);
                return c.createElement($n.o, {
                    isSpider: s,
                    userInfo: y,
                    abTestData: t,
                    activeClickable: !0,
                    onChange: function (e, n) {
                        var a, o;
                        (_ && _({type: "updateUserInfo"}), e !== Qn.NavigationMenuItemVal.AsianGame && e === r) ? (n.preventDefault(), fe.emit(fe.EVENT.refreshPage), null == i || null === (o = i.current) || void 0 === o || o.call(i), window.scrollTo(0, 0)) : Qn.CHANNEL_REF[e].route && (n.preventDefault(), g({
                            pathname: Qn.CHANNEL_REF[e].route,
                            search: (0, ae.stringify)((0, kn.Z)((0, kn.Z)({}, (0, et.U)()), Qn.CHANNEL_REF[e].params || {}))
                        }), null == u || u(Qn.CHANNEL_REF[e].href));
                        A()(a = [ue.m_.Cache, ue.m_.CacheToNextVideo]).call(a, null == t ? void 0 : t.recommendCache) && Qn.NavigationMenuItemVal.Self === e && (n.preventDefault(), g({
                            pathname: Qn.CHANNEL_REF[e].href,
                            search: (0, ae.stringify)((0, kn.Z)((0, kn.Z)({}, (0, et.U)()), Qn.CHANNEL_REF[e].params || {}))
                        }), null == u || u(Qn.CHANNEL_REF[e].href)), h(e)
                    },
                    current: m,
                    customProps: a,
                    className: o,
                    needGrayscale: l,
                    tccConfig: d,
                    isMainland: f,
                    onLinkAction: x
                })
            })), rt = tt, it = t(82573), at = t(28873), ot = "CgAB9miy", lt = "XEOjX_mR", ut = "KYtgzo9m", ct = "UKp0VfC1",
            st = "cfByEviA", dt = "YrZ3gHwD", ft = "QN3kdxZK", vt = "GrbT2xUn", pt = "qlkbkha_";

        function mt() {
            var e = (0, c.useRef)(null), n = (0, c.useState)({offset: {y: 0}}), t = (0, D.Z)(n, 2), r = t[0], i = t[1];
            return (0, c.useEffect)((function () {
                var n = e.current || document, t = function (n) {
                    requestAnimationFrame((function () {
                        !function (n) {
                            var t = n.target, r = (null == t ? void 0 : t.scrollTop) || 0;
                            e.current || (r = window.scrollY), i({offset: {y: r}})
                        }(n)
                    }))
                };
                return n && (null == n || n.addEventListener("scroll", t)), function () {
                    null == n || n.removeEventListener("scroll", t)
                }
            }), [e.current]), [e, r]
        }

        function ht(e) {
            var n = e.isVsTab, t = e.isVsChannel, r = e.isHorizontalLayout, i = e.abtest, a = e.currentPath,
                o = e.nowPathName, l = e.isClient, u = e.userInfo, s = e.osInfo, d = e.children, f = e.redirectFrom,
                v = e.headerLoginPopupStatus, m = e.needGrayscale, h = e.isSpider, g = e.tccConfig, b = e.isMainland,
                w = mt(), y = (0, D.Z)(w, 2), _ = y[0], x = y[1].offset, E = (0, c.useRef)(x),
                C = (0, c.useState)((function () {
                    var e = (k.Le.getConfig(k.gI.VsBanner) || {}).isReady;
                    return void 0 === e || e
                })), L = (0, D.Z)(C, 2), S = L[0], T = L[1], N = (0, c.useMemo)((function () {
                    return x.y < 60 && S
                }), [S, x]), P = mt(), I = (0, D.Z)(P, 2)[1].offset;
            E.current = x;
            var R = (0, c.useMemo)((function () {
                return I.y < 60
            }), [I]);
            (0, c.useEffect)((function () {
                var e = fe.listen(fe.EVENT.vsBannerReady, (function (e) {
                    T(e)
                }));
                return function () {
                    return null == e ? void 0 : e()
                }
            }), []);
            var A = n ? N : R;
            return r ? c.createElement(c.Fragment, null, c.createElement(rt, {
                abTestData: i,
                current: a,
                customProps: {isClient: l, os: s, isLogoFixed: !0},
                className: ut,
                needGrayscale: null == m ? void 0 : m.tab,
                isSpider: h,
                tccConfig: g,
                isMainland: b
            }), c.createElement("div", {
                ref: _,
                className: Gn()(ct, (0, Hn.Z)({}, dt, n || t || (0, p.p)())),
                id: "douyin-right-container"
            }, c.createElement(it.Z, {
                customProps: {
                    pathname: o,
                    isClient: l,
                    os: s,
                    isVsTab: n || t || (0, p.p)(),
                    isVsTabTrans: A || (0, p.p)(),
                    redirectFrom: f,
                    isSpider: h
                }, abTestData: i, userInfo: u, loginPopupStatus: v, onChangeLoginStatus: function () {
                    window.location.reload()
                }, needGrayscale: null == m ? void 0 : m.header
            }), d)) : c.createElement(c.Fragment, null, c.createElement(at.Z, {
                customProps: {
                    pathname: o,
                    isClient: l,
                    os: s,
                    isVsTab: t || (0, p.p)(),
                    isVsTabTrans: R || (0, p.p)()
                }, abTestData: i, userInfo: u, loginPopupStatus: v, onChangeLoginStatus: function () {
                    window.location.reload()
                }, needGrayscale: null == m ? void 0 : m.header
            }), c.createElement("div", {className: Gn()(vt)}, d))
        }

        var gt = c.memo(ht);

        function bt(e) {
            var n = e.nowPathName, t = e.abtest, r = e.isClient, i = e.osInfo, a = e.userInfo,
                o = e.headerLoginPopupStatus, l = e.children, u = e.needGrayscale;
            return c.createElement(c.Fragment, null, c.createElement(at.Z, {
                customProps: {
                    pathname: n,
                    isClient: r,
                    os: i
                }, abTestData: t, userInfo: a, loginPopupStatus: o, onChangeLoginStatus: function () {
                    window.location.reload()
                }, needGrayscale: u
            }), c.createElement("div", {className: Gn()(vt)}, l))
        }

        var wt = c.memo(bt), yt = t(52590), _t = t(3543), xt = t(67289), kt = t(72803), Et = t(40637), Ct = 1e4;
        var Lt = t(76473), St = t.n(Lt), Tt = t(66453), Nt = "YYmifAsy", Pt = "gmnvERwY", It = "whgH7diw",
            Rt = "iipAa2ck", At = "rnDfBknu", Zt = "Qm50jFKV", Dt = "F9Allx_5", Vt = "srwyr03q", Mt = "UKq4fjs9",
            Ot = "O0pNtuMI", Ft = "UStLFBvv", zt = "Kf56At9e", Ht = "g33She8i", jt = "WK_b00g7", Ut = "L4kjlyhQ",
            Wt = "zlfqcIER", qt = "pJc5TfOR", Bt = function (e) {
                var n, t, r = e.customProps, i = e.abTestData, a = null != r ? r : {}, o = a.isClient, l = a.os,
                    u = c.useMemo((function () {
                        return Tt.a.wrapClientOsInfo(o, l)
                    }), [o, l]), s = u.isMac, d = u.isWindows;
                return c.createElement("div", {className: Gn()(Nt, (n = {}, (0, Hn.Z)(n, Ot, !(null != i && i.updateHeader)), (0, Hn.Z)(n, Ft, !(null != i && i.updateHeader || o)), (0, Hn.Z)(n, Ht, !(null != i && i.updateHeader) && o && d), (0, Hn.Z)(n, zt, !(null != i && i.updateHeader) && o && s), (0, Hn.Z)(n, jt, null == i ? void 0 : i.updateHeader), (0, Hn.Z)(n, Ut, (null == i ? void 0 : i.updateHeader) && !o), (0, Hn.Z)(n, qt, (null == i ? void 0 : i.updateHeader) && o && d), (0, Hn.Z)(n, Wt, (null == i ? void 0 : i.updateHeader) && o && s), n))}, c.createElement("div", {className: Pt}, c.createElement("div", {className: It}, c.createElement("div", {className: Rt})), c.createElement("div", {className: At}, q()(t = St()(Array(4))).call(t, (function (e, n) {
                    return c.createElement("div", {
                        key: n,
                        className: Zt
                    }, c.createElement("div", {className: Dt}), c.createElement("div", {className: Mt}))
                })), c.createElement("div", {className: Zt}, c.createElement("div", {className: Vt})))))
            }, Gt = function (e) {
                var n = e.setIsForceRender;
                return (0, c.useEffect)((function () {
                    var e = fe.listen(fe.EVENT.discoverPageLcp, (function () {
                        n(!0), e()
                    }))
                }), []), c.createElement("div", null)
            };

        function Jt(e) {
            var n, r = e.nowPathName, i = e.abtest, a = e.isClient, o = e.osInfo, l = e.userInfo, u = e.children,
                s = e.currentPath, d = e.tccConfig, f = e.landingPage, v = e.redirectFrom, p = e.isNavFixed,
                m = e.headerLoginPopupStatus, h = e.needGrayscale, g = e.lazyLoadConfig, w = e.isSpider,
                y = e.isShowNavigator, _ = e.isMainland, x = function (e) {
                    var n = e.tccConfig, t = (0, c.useState)(!0), r = (0, D.Z)(t, 2), i = r[0], a = r[1],
                        o = (0, c.useMemo)((function () {
                            var e, t, r;
                            return null != n && null !== (e = n.specTheme) && void 0 !== e && e.themeFurtherSwitch ? {backgroundImage: "url(".concat(i ? null == n || null === (t = n.specTheme) || void 0 === t ? void 0 : t.bgDark : null == n || null === (r = n.specTheme) || void 0 === r ? void 0 : r.bgLight, ")")} : {}
                        }), [n, i]);
                    return (0, c.useEffect)((function () {
                        var e = yn.Q.getItem({sKey: z.CookieKeys.Theme}) !== z.ThemeValues.Light;
                        a(e), fe.listen(fe.EVENT.changeTheme, (function (e) {
                            var n = e.theme;
                            return a(n === z.ThemeValues.Dark)
                        }))
                    }), []), {isDark: i, inlineStyle: o}
                }({tccConfig: d}), k = x.inlineStyle, C = 1 === (null == i ? void 0 : i.discoverDiagnosisSencondary),
                L = (0, c.useState)(!1), S = (0, D.Z)(L, 2), N = S[0], P = S[1], R = (0, c.useState)(!1),
                Z = (0, D.Z)(R, 2), V = Z[0], M = Z[1], O = (0, c.useContext)(I), F = O.componentStatus,
                H = O.setComponentStatus, j = O.tabErrorRefresh, U = O.btnErrorRefresh;
            (0, E.Z)("HEADER_HORIXONTALHEADR_CONTAINRER", e);
            var W = /^\/video|shipin|vsdetail|lvdetail\/.*?/.test(r),
                q = /^\/channel\/300203/.test(r) && (null == i ? void 0 : i.NCEE) === ue.gp.LiveAndWaterfall && 0 === (null == d || null === (n = d.NCEE) || void 0 === n ? void 0 : n.offLine),
                B = /^\/asiangames/.test(r), G = q || B, J = p || q || B, X = function (e, n) {
                    for (var t = 0, r = ze()(n || {}); t < r.length; t++) {
                        var i = r[t];
                        if (e in n[i]) return {event: i, delay: n[i][e]}
                    }
                    return {}
                }("header", g), K = X.event, Y = X.delay, Q = (0, c.useState)(!1), $ = (0, D.Z)(Q, 2), ee = $[0], ne = $[1],
                te = (0, c.useCallback)((function (e, n) {
                    var t, r;
                    null !== (t = navigator) && void 0 !== t && t.onLine || null == H || H(!1), _n.oe.event.error({
                        name: _n.Mo.LayoutErrorBoundary,
                        report: {
                            message: e.message,
                            stack: null !== (r = e.stack) && void 0 !== r ? r : "",
                            component_stack: n.toString()
                        }
                    }), Ce.Z.sendLog("layoutErrorBoundary", {enter_from: (0, un.vM)()})
                }), []), re = (0, c.useMemo)((function () {
                    return {isClient: a, os: o, isLogoFixed: p}
                }), [a, o, p]), ie = ["/", "/follow", "/friend"];
            C && ie.push("/discover");
            var ae = A()(ie).call(ie, r), oe = (0, c.useMemo)((function () {
                return K && ae ? function (e) {
                    var n = e.fallback, t = void 0 === n ? c.createElement(c.Fragment, null) : n, r = e.Component,
                        i = void 0 === r ? c.Fragment : r, a = e.waiting, o = void 0 === a ? Ct : a, l = e.disable,
                        u = void 0 !== l && l, s = e.delay, d = e.onTrigger, f = void 0 === d ? function () {
                        } : d, v = e.triggerEvent, p = pn()((function () {
                            fe.emit(v)
                        }), o);
                    return function (e) {
                        var n = (0, c.useState)(u), r = (0, D.Z)(n, 2), a = r[0], o = r[1],
                            l = e.pageFirstFrameLoadedTriggered, d = e.pageFirstFrameLoadStartTriggered,
                            m = e.isForceRender;
                        return (0, c.useEffect)((function () {
                            m && (o(!0), f()), (l && v === fe.EVENT.pageFirstFrameLoaded || d && v === fe.EVENT.pageFirstFrameLoadStart) && (a || (s ? pn()((function () {
                                o(!0), f()
                            }), s) : (o(!0), f())), p && clearTimeout(p))
                        }), [l, d, v, m]), c.createElement(Et.N, {fallback: t}, a ? c.createElement(c.Suspense, {fallback: t}, c.createElement(i, e)) : t)
                    }
                }({
                    fallback: c.createElement(Bt, {customProps: {}, abTestData: i}), Component: c.lazy((function () {
                        return Promise.resolve().then(t.bind(t, 72803))
                    })), delay: Y, triggerEvent: K, onTrigger: function () {
                    }
                }) : kt.default
            }), [ze()(g || {}).length, K, Y, ae, i]);
            return (0, c.useEffect)((function () {
                var e, n;
                return K === fe.EVENT.pageFirstFrameLoaded && (e = fe.listen(fe.EVENT.pageFirstFrameLoaded, (function () {
                    M(!0)
                }))), K === fe.EVENT.pageFirstFrameLoadStart && (n = fe.listen(fe.EVENT.pageFirstFrameLoadStart, (function () {
                    P(!0)
                }))), function () {
                    var t, r;
                    null === (t = e) || void 0 === t || t(), null === (r = n) || void 0 === r || r()
                }
            }), [K]), c.createElement(c.Fragment, null, C && c.createElement(Gt, {setIsForceRender: ne}), y && c.createElement(rt, {
                isSpider: w,
                abTestData: i,
                current: s,
                customProps: re,
                className: ut,
                needGrayscale: null == h ? void 0 : h.tab,
                errorRefresh: j,
                tccConfig: d,
                isMainland: _
            }), c.createElement("div", {
                className: Gn()(ct, st, (0, Hn.Z)({}, ft, W)),
                id: "douyin-right-container",
                style: k
            }, y && c.createElement(c.Fragment, null, c.createElement(yt.L, null), c.createElement(oe, {
                className: Gn()({
                    NCEE: q,
                    asianGame: B
                }),
                customProps: {
                    pathname: r,
                    isFixed: J,
                    isClient: a,
                    os: o,
                    landingPage: f,
                    redirectFrom: v,
                    isVsOrVideo: W,
                    hasScrollTransparent: G,
                    isActivity: B,
                    activityName: B ? "asianGame" : "",
                    isSpider: w
                },
                abTestData: i,
                userInfo: l,
                loginPopupStatus: m,
                onChangeLoginStatus: function () {
                    window.location.reload()
                },
                needGrayscale: null == h ? void 0 : h.header,
                pageFirstFrameLoadedTriggered: V,
                pageFirstFrameLoadStartTriggered: N,
                isForceRender: ee
            })), (null == F || F) && c.createElement(b.SV, {
                Slardar: T.oe,
                onError: te
            }, u), !F && c.createElement(_t.oO, {
                slot: xt.t6.OCCUPATION, secondaryButtonAction: function () {
                    null == U || U()
                }
            })))
        }

        var Xt = c.memo(Jt), Kt = t(92524), Yt = t.n(Kt), Qt = function (e) {
            var n, t, r;
            return "user/self" === (e = (null === (n = e) || void 0 === n ? void 0 : Un()(n).call(n, 1)) || "") ? "user_self" : (Yt()(e).call(e, "channel") > -1 ? null === (t = e) || void 0 === t ? void 0 : qn()(t).call(t, "/", "_") : null === (r = e) || void 0 === r ? void 0 : qn()(r).call(r, "/", "")) || "recommend"
        };

        function $t(e) {
            var n = e.landingPage, t = e.nowPathName, r = (0, c.useMemo)((function () {
                return "recommend" !== n && "/" === t ? n : Qt(t)
            }), []), i = (0, c.useState)(r), a = (0, D.Z)(i, 2), o = a[0], l = a[1], u = (0, V.TH)();
            return (0, c.useEffect)((function () {
                (0, m.vT)();
                var e = Qt(u.pathname || "");
                l(e), k.Le.setConfig(k.gI.BrowserChangePage, e), k.Le.setConfig(k.gI.VideoPlayMethod, "auto")
            }), [u.pathname]), {currentPath: o}
        }

        var er = function (e) {
            return e[e.VSHeader = 0] = "VSHeader", e[e.HorizonHeader = 1] = "HorizonHeader", e[e.NormailHeader = 2] = "NormailHeader", e
        }(er || {});

        function nr(e) {
            var n, t, r = e.nowPathName, i = e.abtest, a = e.isClient, o = e.osInfo, l = e.redirectFrom, u = e.userInfo,
                s = e.landingPage, d = e.tccConfig, f = e.headerLoginPopupStatus, v = e.children, p = e.isSpider,
                m = e.lazyLoadConfig, h = e.isShowNavigator, g = e.isMainland,
                b = $t({landingPage: s, nowPathName: r}).currentPath, w = (0, c.useState)(undefined),
                y = (0, D.Z)(w, 2), _ = y[0], x = y[1], k = (0, c.useMemo)((function () {
                    var e;
                    return {
                        isVsTab: "vs" === b || "/vs" === r,
                        isVsChannel: A()(Yn.xH).call(Yn.xH, b) || A()(Yn.xH).call(Yn.xH, null == r || null === (e = Un()(r).call(r, 1)) || void 0 === e ? void 0 : qn()(e).call(e, "/", "_"))
                    }
                }), [b]), E = k.isVsTab, C = k.isVsChannel, L = (0, Jn.o)(a, p).isHorizontalLayout,
                S = (0, c.useMemo)((function () {
                    return /^video|shipin|user|vschannel|vsdetail|lvdetail|asiangames.*?/.test(b) && L
                }), [b, L]);
            (0, c.useEffect)((function () {
                (0, F.pC)(z.SessionStorageKeys.manualSwitch);
                var e = ((0, we.fV)() || {}).os;
                if (e) {
                    var n = "".concat(e.toLocaleLowerCase(), "-os");
                    x(n)
                }
            }), []);
            var T = function (e, n, t) {
                var r = er.NormailHeader;
                return e || n ? r = er.VSHeader : t && (r = er.HorizonHeader), r
            }(E, C, L), N = (0, Xn.L)(be.m_.HOME, r, null == d ? void 0 : d.pageGrayscale), P = (0, Kn.T)({
                canShow: (null == i ? void 0 : i.updateHeader) === (null === (n = ue.SE) || void 0 === n ? void 0 : n.LinearIcon),
                pathname: r
            }).isShow;
            return c.createElement(c.Fragment, null, c.createElement("div", {
                className: Gn()(_, ot, (t = {}, (0, Hn.Z)(t, lt, S), (0, Hn.Z)(t, "isSafari", (0, xn.G6)()), t)),
                style: {flexDirection: L ? "row" : "column"}
            }, P && c.createElement("div", {className: pt}), T === er.VSHeader ? c.createElement(gt, {
                isVsTab: E,
                isVsChannel: C,
                isHorizontalLayout: L,
                abtest: i,
                currentPath: b,
                nowPathName: r,
                isClient: a,
                userInfo: u,
                osInfo: o,
                redirectFrom: l,
                headerLoginPopupStatus: f,
                needGrayscale: N,
                isSpider: p,
                tccConfig: d,
                isMainland: g
            }, v) : null, T === er.HorizonHeader ? c.createElement(Xt, {
                nowPathName: r,
                abtest: i,
                isClient: a,
                osInfo: o,
                userInfo: u,
                currentPath: b,
                tccConfig: d,
                landingPage: s,
                redirectFrom: l,
                isNavFixed: S,
                headerLoginPopupStatus: f,
                needGrayscale: N,
                lazyLoadConfig: m,
                isSpider: p,
                isShowNavigator: h,
                isMainland: g
            }, v) : null, T === er.NormailHeader ? c.createElement(wt, {
                nowPathName: r,
                abtest: i,
                isClient: a,
                osInfo: o,
                userInfo: u,
                headerLoginPopupStatus: f,
                needGrayscale: null == N ? void 0 : N.header
            }, v) : null))
        }

        var tr = c.memo(nr);

        function rr(e) {
            var n = e.isSpider, t = e.ua;
            return c.createElement(c.Fragment, null, Boolean(n) && c.createElement("div", {
                id: "spider_ua",
                style: {display: "none"}
            }, t))
        }

        var ir = c.memo(rr), ar = (0, M.default)((function () {
            return t.e(6612).then(t.bind(t, 72024))
        }), {
            resolveComponent: function (e) {
                return e.SiderBar
            }, ssr: !1
        }), or = en.p4, lr = (0, c.memo)((function (e) {
            var n = e.abTestData, t = e.version, r = e.nowPathName, i = e.SlardarInstance, a = e.landingPage,
                o = $t({nowPathName: r, landingPage: a}).currentPath, l = (0, c.useState)(!1), u = (0, D.Z)(l, 2),
                s = u[0], d = u[1], f = (0, c.useState)(0), v = (0, D.Z)(f, 2), p = v[0], m = v[1],
                h = (0, c.useMemo)((function () {
                    if (/^topic.*?/.test(o)) return {bottom: "72px"}
                }), [o]);
            return (0, We.O)(!0, (function () {
                (0, Be.K)((function () {
                    d(!r.match(new RegExp(or)))
                }))
            })), (0, c.useEffect)((function () {
                fe.listen(fe.EVENT.showUpIconScrollY, (function (e) {
                    m(e)
                }))
            }), []), s ? c.createElement(ar, {
                showUpIconScrollY: p,
                abTestData: n,
                version: t,
                nowPathName: r,
                SlardarInstance: i,
                wrapStyle: h
            }) : null
        })), ur = t(66077), cr = t(91990), sr = t.n(cr), dr = t(75849), fr = function () {
            (0, dr.C)((function () {
                var e, n, t, r = (0, ur.Q)(document.cookie);
                null != r && r.device_web_cpu_core || (document.cookie = (0, ur.q)("device_web_cpu_core", Number((null === (n = navigator) || void 0 === n ? void 0 : n.hardwareConcurrency) || -1)));
                null != r && r.device_web_memory_size || (document.cookie = (0, ur.q)("device_web_memory_size", Number((null === (t = navigator) || void 0 === t ? void 0 : t.deviceMemory) || -1)));
                if ((null == r || !r.architecture) && null !== (e = navigator) && void 0 !== e && e.userAgent) {
                    var i, a, o, l = sr()(null === (i = navigator) || void 0 === i ? void 0 : i.userAgent);
                    if (null != l && null !== (a = l.cpu) && void 0 !== a && a.architecture) document.cookie = (0, ur.q)("architecture", null == l || null === (o = l.cpu) || void 0 === o ? void 0 : o.architecture)
                }
                document.cookie = (0, ur.q)("webcast_local_quality", localStorage.getItem("webcast_local_quality"), {
                    domain: ".douyin.com",
                    path: "/"
                })
            }))
        }, vr = /asiangames/;

        function pr(e) {
            var n = e.children, t = e.user, i = e.odin, a = e.abTestData, l = void 0 === a ? {} : a,
                u = e.ttwidCreateTime, s = e.tccConfig, h = e.pathname, R = e.isSpider,
                M = void 0 === R ? (0, g._Q)() : R, O = e.isClient, F = e.clientVersion, H = e.ua,
                j = void 0 === H ? (0, g.ij)() : H, U = e.osInfo, W = e.envService, q = e.innerLink, B = e.globalwid,
                G = e.globaluid, J = e.nonce, X = e.videoDetail, K = e.redirectFrom, Y = e.landingPage,
                Q = void 0 === Y ? "recommend" : Y, $ = e.tceCluster, ne = e.lazyLoadConfig, te = e.isOptTextHtmlRatio,
                re = e.isMainland, oe = e.freeAdStatus, le = void 0 === oe ? {status: S.J.NoRight, message: ""} : oe;
            fr();
            var ue = function (e) {
                    var n = e.tccConfig, t = e.pathname, r = void 0 === t ? "" : t, i = (0, V.TH)(),
                        a = (0, c.useMemo)((function () {
                            var e;
                            if (!(0, p.p)()) return null === (e = window) || void 0 === e ? void 0 : e.version
                        }), []);
                    return (0, c.useMemo)((function () {
                        n && be.Cf(n)
                    }), [n]), {nowPathName: (0, p.p)() ? r : i.pathname, version: a}
                }({pathname: h, tccConfig: s}), ce = ue.nowPathName, se = ue.version, de = function (e) {
                    var n = e.isClient, t = e.clientVersion, r = e.osInfo;
                    return (0, c.useMemo)((function () {
                        if (n === undefined || t === undefined || r === undefined) {
                            var e = ye();
                            return {isClient: e.isClient, clientVersion: e.clientVersion, osInfo: e.osInfo}
                        }
                        return {isClient: n, clientVersion: t, osInfo: r}
                    }), [n, t, r])
                }({isClient: O, osInfo: U, clientVersion: F}), ve = de.isClient, pe = de.clientVersion, me = de.osInfo,
                we = Se({defaultUserInfo: t, odin: i}), _e = we.userCtx, xe = we.Context, ke = _e.userInfo,
                Ee = _e.dispatch;
            !function (e) {
                var n = e.ttwidCreateTime, t = e.envService;
                (0, c.useLayoutEffect)((function () {
                    k.Le.setConfig(k.gI.FirstInstallTime, {time: n || 0}), k.Le.setConfig(k.gI.Env, {envService: t})
                }), [n, t])
            }({ttwidCreateTime: u, envService: W}), function (e) {
                var n = e.globalwid, t = e.globaluid, i = e.odin;
                (0, c.useLayoutEffect)((function () {
                    i && (i.globalwid = n, i.globaluid = t, (0, k.hj)(i));
                    var e = null;
                    return (0, r.Z)(o().mark((function t() {
                        return o().wrap((function (t) {
                            for (; ;) switch (t.prev = t.next) {
                                case 0:
                                    return t.next = 2, Ze(n);
                                case 2:
                                    e = t.sent;
                                case 3:
                                case"end":
                                    return t.stop()
                            }
                        }), t)
                    })))(), function () {
                        clearInterval(e)
                    }
                }), [n, t, i]), (0, Ie.Z)()
            }({globalwid: B, globaluid: G, odin: i}), function (e) {
                var n = e.clientVersion, t = e.ttwidCreateTime, r = e.userCtx, i = e.tceCluster, a = r.userInfo,
                    o = null == a ? void 0 : a.info, l = null == o ? void 0 : o.uid, u = null == a ? void 0 : a.isLogin;
                (0, c.useLayoutEffect)((function () {
                    var e, r, a;
                    window.tce_cluster = i, (0, d.$n)({
                        pathname: window.location.pathname,
                        is_client: (0, g.DT)(),
                        client_version: n,
                        first_install_time: t || 0,
                        douyin_pc_seo_page_id: (0, De.P)(window.location.pathname),
                        in_piture_enable: (0, Ve.Kv)(),
                        arch: null !== (e = null === (r = window) || void 0 === r || null === (a = r.TTE_ENV) || void 0 === a ? void 0 : a.arch) && void 0 !== e ? e : "",
                        tce_cluster: i
                    }), (0, d.D$)(l, u)
                }), [n, t, l, u, i])
            }({clientVersion: pe, userCtx: _e, ttwidCreateTime: u, tceCluster: $});
            var Le = (0, C.uy)(), Te = Le.PWAInstallable, Ne = Le.installPWA, Pe = Ke({abTestData: l}).abtest,
                Re = function (e) {
                    var n = e.userCtx, t = e.abTestData, i = e.isSpider, a = void 0 !== i && i, l = n.dispatch,
                        u = n.userInfo, s = null == u ? void 0 : u.isLogin, d = (0, c.useState)(nn.T.Unknown),
                        f = (0, D.Z)(d, 2), v = f[0], p = f[1], m = (0, c.useRef)(!1);
                    (0, c.useEffect)((function () {
                        if (!a) {
                            var e = Qe.kQ(), n = e >= 100 ? -1 : e;
                            cn.i.sendLog("enterColdStart", {
                                enter_from: (0, un.vM)() || "",
                                params_for_special: "uc_login",
                                notify_times: Qe.x8(),
                                notify_limit: n
                            });
                            var t = fe.listen(fe.EVENT.changeMinWindows, (function (e) {
                                var n = e.isMiniWin;
                                m.current = n
                            }));
                            return function () {
                                a || t()
                            }
                        }
                    }), []);
                    var h = (0, Ye.Z)((function () {
                        var e, n;
                        (0, tn.e)(s, t);
                        var i = null === (e = window) || void 0 === e || null === (n = e.location) || void 0 === n ? void 0 : n.pathname;
                        if (null != i && i.match(new RegExp(sn))) i && (0, c.startTransition)((function () {
                            p(nn.T.Off)
                        })); else {
                            m.current || (0, rn.C)(s, t), Qe.wt();
                            var a = function () {
                                var e = (0, r.Z)(o().mark((function e() {
                                    var n, i, a, l, u, d, f, v, h;
                                    return o().wrap((function (e) {
                                        for (; ;) switch (e.prev = e.next) {
                                            case 0:
                                                return e.next = 2, Qe.Z3(["video_detail"], t);
                                            case 2:
                                                if (i = e.sent, a = Number(null === (n = (0, ae.parse)(location.search)) || void 0 === n ? void 0 : n.open_login_ab) || 0, l = 1 === a ? "\u767b\u5f55\u540e\u6296\u97f3\u66f4\u61c2\u4f60" : "\u767b\u5f55\u540e\u514d\u8d39\u7545\u4eab\u9ad8\u6e05\u89c6\u9891", 1 !== a && 2 !== a) {
                                                    e.next = 10;
                                                    break
                                                }
                                                return (0, an.default)({
                                                    success: function () {
                                                        var e = (0, r.Z)(o().mark((function e() {
                                                            var n, t;
                                                            return o().wrap((function (e) {
                                                                for (; ;) switch (e.prev = e.next) {
                                                                    case 0:
                                                                        null === (n = window) || void 0 === n || null === (t = n.location) || void 0 === t || t.reload();
                                                                    case 1:
                                                                    case"end":
                                                                        return e.stop()
                                                                }
                                                            }), e)
                                                        })));
                                                        return function () {
                                                            return e.apply(this, arguments)
                                                        }
                                                    }(),
                                                    next: "https://".concat(null === (u = window) || void 0 === u || null === (d = u.location) || void 0 === d ? void 0 : d.host),
                                                    headerText: l,
                                                    enterMethod: "click_push",
                                                    teaEvtParams: {enter_from: "push"}
                                                }), p(nn.T.Off), e.abrupt("return");
                                            case 10:
                                                if (null == i || !i.shouldShow) {
                                                    e.next = 21;
                                                    break
                                                }
                                                if ((null == i ? void 0 : i.type) !== Qe.i.FULL_LOGIN || m.current) {
                                                    e.next = 16;
                                                    break
                                                }
                                                (0, an.default)({
                                                    success: function () {
                                                        var e = (0, r.Z)(o().mark((function e() {
                                                            var n, t;
                                                            return o().wrap((function (e) {
                                                                for (; ;) switch (e.prev = e.next) {
                                                                    case 0:
                                                                        null === (n = window) || void 0 === n || null === (t = n.location) || void 0 === t || t.reload();
                                                                    case 1:
                                                                    case"end":
                                                                        return e.stop()
                                                                }
                                                            }), e)
                                                        })));
                                                        return function () {
                                                            return e.apply(this, arguments)
                                                        }
                                                    }(),
                                                    next: "https://".concat(null === (f = window) || void 0 === f || null === (v = f.location) || void 0 === v ? void 0 : v.host),
                                                    isCanClose: (null == i || null === (h = i.extra) || void 0 === h ? void 0 : h.intensity) !== Qe.MO.FORCE,
                                                    enterMethod: "cold_start_full",
                                                    isGuide: !0
                                                }), (0, c.startTransition)((function () {
                                                    p(nn.T.Off)
                                                })), e.next = 19;
                                                break;
                                            case 16:
                                                return e.next = 18, null === on.n || void 0 === on.n ? void 0 : on.n.showPerDay(s);
                                            case 18:
                                                (0, c.startTransition)((function () {
                                                    p(nn.T.On)
                                                }));
                                            case 19:
                                                e.next = 22;
                                                break;
                                            case 21:
                                                (0, c.startTransition)((function () {
                                                    p(nn.T.Off)
                                                }));
                                            case 22:
                                            case"end":
                                                return e.stop()
                                        }
                                    }), e)
                                })));
                                return function () {
                                    return e.apply(this, arguments)
                                }
                            }();
                            !1 !== s || m.current ? s !== undefined && (0, c.startTransition)((function () {
                                p(nn.T.Off)
                            })) : a()
                        }
                    }));
                    return (0, c.useEffect)((function () {
                        a || (s ? ((0, ln.oo)(u), (0, $e.h)({
                            onDrop: function () {
                                l({type: "updateUserInfo"})
                            }
                        })) : (0, $e.H)((function () {
                            l({type: "updateUserInfo"})
                        })), s !== undefined && h())
                    }), [s]), {headerLoginPopupStatus: v}
                }({userCtx: _e, abTestData: l, isSpider: M}), Ae = Re.headerLoginPopupStatus;
            !function (e) {
                var n = e.abtest, t = (0, w.k6)();
                (0, c.useEffect)((function () {
                    if (n.__isLoaded) {
                        var e = (0, dn.I)(null == n ? void 0 : n.fps, 1e4), r = t.listen((function () {
                            var t;
                            e(), e = (0, dn.I)(null == n ? void 0 : n.fps), k.Le.setConfig(k.gI.PreloadList, []);
                            var r = null === (t = window) || void 0 === t ? void 0 : t.playerPreloader;
                            null == r || r.removeAll(), null == r || r.removeAllPreloadTask()
                        }));
                        return function () {
                            null == r || r()
                        }
                    }
                }), [n])
            }({abtest: Pe}), function (e) {
                var n = e.abtest;
                (0, c.useEffect)((function () {
                    var e = function (e) {
                        "Tab" !== e.code || window.a11ySwitch || (e.preventDefault(), e.stopPropagation())
                    };
                    return document.addEventListener("keydown", e), function () {
                        document.removeEventListener("keydown", e)
                    }
                }), []), (0, c.useEffect)((function () {
                    n && fn.DJ.setConfig({abtestData: n}, !1)
                }), [n]), (0, c.useEffect)((function () {
                    var e = function (e) {
                        if (null != n && n.changeListCss) {
                            var t = ["ArrowUp", "ArrowRight"], r = ["recommend", "follow", "friend"];
                            A()(t).call(t, e.code) && A()(r).call(r, (0, un.vM)()) && e.preventDefault()
                        }
                    };
                    return document.addEventListener("keydown", e), function () {
                        document.removeEventListener("keydown", e)
                    }
                }), [n]), (0, c.useEffect)((function () {
                    return fn.DJ.register(["close", "help", "search", "miniWin"]), fe.listen(fe.EVENT.changeMinWindows, (function (e) {
                        e.isMiniWin ? fn.DJ.pause(["close", "help", "search"]) : fn.DJ.resume(["close", "help", "search"])
                    })), function () {
                        return fn.DJ.destroy()
                    }
                }), [])
            }({abtest: Pe}), function (e) {
                var n = e.userCtx, t = e.envService, r = void 0 === t ? "" : t, i = n.dispatch;
                (0, c.useLayoutEffect)((function () {
                    A()(Z).call(Z, r) ? window.isProductionEnv = !0 : window.isProductionEnv = !1, window.updateUserInfo = function () {
                        window.isProductionEnv || i({type: "updateUserInfo"})
                    }
                }), [i])
            }({userCtx: _e, envService: W}), function (e) {
                var n = e.userCtx, t = e.notInit, r = n.userInfo, i = (0, c.useRef)(null);
                (0, c.useEffect)((function () {
                    try {
                        var e, n;
                        if (t) return;
                        var a = (0, m.Rs)("modeFrom") === hn.MODE_FROM ? hn.MODE_FROM : "",
                            o = (null === (e = (0, k.Es)()) || void 0 === e ? void 0 : e.user_unique_id) || "", l = "";
                        null != r && r.isLogin && null != r && r.info && (o = r.info.uid, l = r.info.nickname || "");
                        var u = {
                            appKey: f.FEELGOOD_APP_KEY,
                            channel: "cn",
                            userInfo: {
                                user_id: o,
                                user_name: l,
                                style_type: (null === (n = document.documentElement) || void 0 === n ? void 0 : n.getAttribute("update-header")) || "0",
                                mode_from: a,
                                newUserAuthorCard: 0
                            }
                        };
                        i.current || (i.current = pn()((function () {
                            clearTimeout(i.current), (0, mn.V)(u)
                        }), 3e4)), (null == r ? void 0 : r.isLogin) !== undefined && (clearTimeout(i.current), (0, mn.V)(u))
                    } catch (c) {
                    }
                }), [r])
            }({userCtx: _e, notInit: /\/light\//.test(h)}), (0, We.O)(!0, (function () {
                fe.emit(fe.EVENT.initIMNoticeSDK)
            })), (0, c.useEffect)((function () {
                var e, n, t;
                (0, g.DT)() && "serviceWorker" in navigator && (null === (e = navigator) || void 0 === e || null === (n = e.serviceWorker) || void 0 === n || null === (t = n.getRegistrations()) || void 0 === t || t.then((function (e) {
                    var n, t = (0, gn.Z)(e);
                    try {
                        for (t.s(); !(n = t.n()).done;) n.value.unregister()
                    } catch (r) {
                        t.e(r)
                    } finally {
                        t.f()
                    }
                })).catch((function (e) {
                })))
            }), []), (0, c.useEffect)((function () {
                var e = navigator, n = e.cookieEnabled, t = e.onLine, r = void 0 === t || t, i = e.hardwareConcurrency,
                    a = void 0 === i ? 0 : i, o = e.deviceMemory, l = void 0 === o ? 0 : o,
                    u = wn()(navigator, "connection.downlink", ""), c = wn()(navigator, "connection.effectiveType", ""),
                    s = wn()(navigator, "connection.rtt", 0), d = {
                        cookie_enabled: n,
                        screen_width: wn()(screen, "width", 0),
                        screen_height: wn()(screen, "height", 0),
                        browser_online: r,
                        cpu_core_num: a,
                        device_memory: l,
                        downlink: u,
                        effective_type: c,
                        round_trip_time: s
                    };
                try {
                    var f = ie()(d);
                    yn.Q.setItem(z.CookieKeys.StreamRecommendFeedParams, f)
                } catch (v) {
                    _n.oe.event.error({name: _n.Mo.GenRecommendParamsError, report: {errMsg: v.message, cookieInfo: d}})
                }
            }), []);
            var Me, Oe, Fe, ze, He, je, Ue,
                qe = (Me = (0, c.useState)(!0), Oe = (0, D.Z)(Me, 2), Fe = Oe[0], ze = Oe[1], He = (0, c.useCallback)((function () {
                    window.location.reload()
                }), []), je = (0, c.useCallback)((function (e) {
                    e === undefined ? ze((function (e) {
                        return !e
                    })) : ze(e)
                }), []), Ue = (0, c.useCallback)((function (e) {
                    Fe || (e ? window.location.replace(globalThis.xssNamespace.douyin_web.filterUrl(e, null, {
                        logType: "js.window.location",
                        mode: "black",
                        reportOnly: !1
                    })) : window.location.reload())
                }), [Fe]), {btnErrorRefresh: He, componentStatus: Fe, setComponentStatus: je, tabErrorRefresh: Ue});
            (0, c.useEffect)((function () {
                (0, Be.K)((function () {
                    try {
                        var e, n, t, r, i, a, o, l,
                            u = null === (e = (0, v.Cr)("navigation")) || void 0 === e ? void 0 : e[0], c = (0, v.fX)(),
                            s = {
                                enter_from: (0, un.yW)(),
                                worker_start: null == u ? void 0 : u.workerStart,
                                fetch_start: null == u ? void 0 : u.fetchStart,
                                domain_lookup_start: null == u ? void 0 : u.domainLookupStart,
                                domain_lookup_end: null == u ? void 0 : u.domainLookupEnd,
                                request_start: null == u ? void 0 : u.requestStart,
                                response_start: null == u ? void 0 : u.responseStart,
                                response_end: null == u ? void 0 : u.responseEnd,
                                head_start: null == c || null === (n = c.head_start) || void 0 === n ? void 0 : n.startTime,
                                head_end: null == c || null === (t = c.head_end) || void 0 === t ? void 0 : t.startTime,
                                body_start: null == c || null === (r = c.body_start) || void 0 === r ? void 0 : r.startTime,
                                body_end: null == c || null === (i = c.body_end) || void 0 === i ? void 0 : i.startTime,
                                html_domcontentloaded: null == c || null === (a = c.html_domcontentloaded) || void 0 === a ? void 0 : a.startTime,
                                app_enter: null == c || null === (o = c.app_enter) || void 0 === o ? void 0 : o.startTime,
                                app_render: null == c || null === (l = c.app_render) || void 0 === l ? void 0 : l.startTime
                            };
                        cn.i.sendLog("webNavigationTiming", s)
                    } catch (d) {
                    }
                }))
            }), []), (0, L.V)({abtestData: Pe}), (0, c.useEffect)((function () {
                var e, n;
                null === (e = document.documentElement) || void 0 === e || null === (n = e.setAttribute) || void 0 === n || n.call(e, "is-".concat((0, xn.qs)()), "true")
            }), []), (0, c.useEffect)((function () {
                try {
                    var e = document.createElement("canvas"),
                        n = e.getContext("webgl") || e.getContext("experimental-webgl"),
                        t = document.createElement("canvas").getContext("webgl2");
                    Ce.Z.sendLog("webglSupport", {is_webgl1_support: n ? 1 : 0, is_webgl2_support: t ? 1 : 0})
                } catch (r) {
                }
            }), []);
            var Ge = (0, w.k6)();
            k.Le.setConfig(k.gI.History, Ge);
            (0, c.useEffect)((function () {
                !function () {
                    var e = (null == le ? void 0 : le.status) || S.J.NoRight;
                    if (e === S.J.ExpiredNeedTips) {
                        var n = S.b[e];
                        n && x.F.info({
                            text: n,
                            zIndex: 1e4
                        }), e = S.J.ExpiredAlreadyTips, k.Le.setConfig(k.gI.FreeAdStatus, {status: e, message: ""})
                    } else k.Le.setConfig(k.gI.FreeAdStatus, le)
                }()
            }), [le]);
            var Je = (0, c.useMemo)((function () {
                return {innerLink: q, nonce: J, modalVideoDetail: X, tccConfig: s}
            }), [q, X, s]), Xe = (0, c.useMemo)((function () {
                return !M || !te
            }), [M, te]);
            (0, c.useEffect)((function () {
                var e;
                k.Le.setConfig(k.gI.DanmuTimeGap, (null == s || null === (e = s.danmu_time_gap) || void 0 === e ? void 0 : e.time_gap) || 32)
            }), [s]), (0, E.Z)("LAYOUT_INDEX", {
                abtest: Pe,
                userCtx: _e,
                nowPathName: ce,
                version: se,
                globalValue: Je,
                isSpider: M,
                ua: j,
                isClient: ve,
                osInfo: me,
                redirectFrom: K,
                headerLoginPopupStatus: Ae,
                landingPage: Q,
                tccConfig: s,
                videoDetail: X,
                dispatch: Ee
            });
            var en = vr.test(ce);
            return /light\/[0-9]+/.test(ce) ? c.createElement("div", null, n) : c.createElement(C.hn.Provider, {
                value: {
                    PWAInstallable: Te,
                    installPWA: Ne
                }
            }, c.createElement(N.C.Provider, {value: Pe}, c.createElement(xe.Provider, {value: _e}, c.createElement(P.r.Provider, {value: Je}, c.createElement(y.p, null, c.createElement(ge.yL, null, c.createElement(I.Provider, {value: qe}, c.createElement(b.SV, {
                Slardar: T.oe,
                onError: function () {
                    var e;
                    null !== (e = navigator) && void 0 !== e && e.onLine || (0, g.DT)() || window.location.reload()
                }
            }, c.createElement(he, null), c.createElement(ir, {isSpider: M, ua: j}), c.createElement(tr, {
                isSpider: M,
                ua: j,
                nowPathName: ce,
                abtest: Pe,
                isClient: ve,
                osInfo: me,
                redirectFrom: K,
                userInfo: ke,
                landingPage: Q,
                tccConfig: s,
                videoDetail: X,
                dispatch: Ee,
                version: se,
                headerLoginPopupStatus: Ae,
                lazyLoadConfig: ne,
                isShowNavigator: Xe,
                isMainland: re
            }, n), c.createElement(ee, {
                videoDetail: X,
                userInfo: ke,
                dispatch: Ee,
                abtest: Pe
            }), c.createElement(b.SV, null, Xe && c.createElement(lr, {
                abTestData: Pe,
                version: se,
                nowPathName: ce,
                SlardarInstance: T.oe,
                landingPage: Q
            })), !en && c.createElement(_.L, {abTestData: Pe, SlardarInstance: T.oe})))))))))
        }

        pr.getInitialProps = zn;
        var mr, hr = pr, gr = t(4028), br = ["Component"], wr = "test", yr = "unknown";
        wr = "production", yr = null !== (mr = "1.0.3.8493") ? mr : "unknown", (0, v.B1)("app_enter"), (0, T.B7)();
        var _r = function (e) {
            var n = e.Component, t = (0, i.Z)(e, br);
            return c.createElement(hr, t, c.createElement(n, null))
        };
        _r.getInitialProps = zn;
        var xr = function () {
            var e = (0, r.Z)(o().mark((function e(n) {
                var t, r, i, a, l, c, b, w, y, _, x, k, E;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (t = n.renderer, r = n.RootComponent, i = n.container, a = n.callback, (0, v.B1)("app_render"), (0, p.p)()) {
                                e.next = 20;
                                break
                            }
                            if (!(0, T._h)()) {
                                e.next = 5;
                                break
                            }
                            return e.abrupt("return");
                        case 5:
                            (0, m.vT)(), (0, s.m)(), !window.bytedAcrawlerInited && (0, h.W)(), !window.collectEventInited && (0, d.Aq)({
                                app_id: f.APP_ID,
                                channel: "cn",
                                enable_ab_test: !0,
                                ab_channel_domain: "https://www.douyin.com"
                            }), (0, T.TM)(wr, yr), (0, T.A7)(), (0, T.GZ)(), l = (0, T.tN)("landingPage") || "recommend", c = (0, T.tN)("landingQuery") || "", "recommend" !== l && history.replaceState(null, "", u()(b = "/".concat(l)).call(b, c ? "?".concat(c) : "")), (0, T.ly)(), ((0, gr.e9)() || (0, g.DT)()) && (E = (null === (w = window.SSR_RENDER_DATA_DOC || window.SSR_RENDER_DATA) || void 0 === w || null === (y = w.app) || void 0 === y || null === (_ = y.freeAdStatus) || void 0 === _ ? void 0 : _.status) || 0, (0, T.R9)(null === (x = window.SSR_RENDER_DATA_DOC || window.SSR_RENDER_DATA) || void 0 === x || null === (k = x.app) || void 0 === k ? void 0 : k.abTestData, {freeRight: Number(1 === E || 2 === E)})), (0, T.aB)(), window.version = yr, document.cookie = "douyin.com";
                        case 20:
                            t(r, i, a);
                        case 21:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n) {
                return e.apply(this, arguments)
            }
        }(), kr = _r
    }, 523: function (e, n, t) {
        t.d(n, {
            MX: function () {
                return x
            }, qy: function () {
                return k
            }
        });
        var r = t(87130), i = t(19049), a = t(95508), o = t(73316), l = t(6670), u = t(78034), c = t(65146),
            s = t(85792), d = t.n(s), f = t(77007), v = new (t(13795).hD)({
                predictor_stat: {
                    eventName: "predictor_stat",
                    params: {event_type: "", predict_name: "", predict_type: ""}
                }
            }), p = function (e) {
                (0, l.Z)(t, e);
                var n = (0, u.Z)(t);

                function t(e) {
                    var r, a = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 50;
                    return (0, i.Z)(this, t), r = n.call(this, e), (0, c.Z)((0, o.Z)(r), "_type", "hover"), r._delay = a, r
                }

                return (0, a.Z)(t, [{
                    key: "enter", value: function () {
                        var e = this;
                        this._timer = d()((function () {
                            e.predict(), e._timer = undefined
                        }), this._delay)
                    }
                }, {
                    key: "click", value: function () {
                        this.trigger()
                    }
                }, {
                    key: "leave", value: function () {
                        this._timer && clearTimeout(this._timer)
                    }
                }]), t
            }(function () {
                function e(n) {
                    (0, i.Z)(this, e), (0, c.Z)(this, "_eventHub", {predict: [], trigger: []}), this._name = n
                }

                return (0, a.Z)(e, [{
                    key: "_log", value: function (e) {
                        v.sendLog("predictor_stat", {event_type: e, predict_name: this._name, predict_type: this._type})
                    }
                }, {
                    key: "_on", value: function (e, n) {
                        this._eventHub[e].push(n)
                    }
                }, {
                    key: "_emit", value: function (e) {
                        this._log(e);
                        var n, t = (0, f.Z)(this._eventHub[e]);
                        try {
                            for (t.s(); !(n = t.n()).done;) {
                                (0, n.value)()
                            }
                        } catch (r) {
                            t.e(r)
                        } finally {
                            t.f()
                        }
                    }
                }, {
                    key: "predict", value: function () {
                        this._emit("predict")
                    }
                }, {
                    key: "trigger", value: function () {
                        this._emit("trigger")
                    }
                }, {
                    key: "onPredict", value: function (e) {
                        this._on("predict", e)
                    }
                }, {
                    key: "onTrigger", value: function (e) {
                        this._on("trigger", e)
                    }
                }]), e
            }()), m = t(26447), h = t.n(m), g = function () {
                function e(n) {
                    (0, i.Z)(this, e), (0, c.Z)(this, "_expired", 5e3), (0, c.Z)(this, "_startAt", 0), (0, c.Z)(this, "_cachedPromise", undefined), this.method = n
                }

                return (0, a.Z)(e, [{
                    key: "_resetCache", value: function () {
                        this._cachedPromise = undefined, this._startAt = 0
                    }
                }, {
                    key: "request", value: function () {
                        var e = this, n = !(arguments.length > 0 && arguments[0] !== undefined) || arguments[0],
                            t = arguments.length > 1 && arguments[1] !== undefined && arguments[1];
                        if (!n) return this.method();
                        this._cachedPromise && this._startAt && (h()() - this._startAt > this._expired && this._resetCache());
                        return this._cachedPromise ? this._cachedPromise.finally((function () {
                            t && e._resetCache()
                        })) : (this._cachedPromise = this.method(), this._cachedPromise.finally((function () {
                            e._startAt = h()()
                        })))
                    }
                }]), e
            }(), b = t(68493), w = t.n(b), y = t(34346), _ = t.n(y);
        var x = new g((function () {
            return (0, r.w4)({
                moduleId: 3003101,
                referType: 10,
                count: 20,
                seoFlag: 0
            }, e, n, e ? {timeout: 3500} : undefined, e ? {psm: "aweme.api.goFeed", cluster: "external"} : undefined);
            var e, n
        })), k = new p("nav-discover");
        !function (e, n) {
            var t, r = (0, f.Z)(n);
            try {
                for (r.s(); !(t = r.n()).done;) {
                    t.value.onPredict((function () {
                        w().all(_()(e).call(e, (function (e) {
                            return e.request()
                        })))
                    }))
                }
            } catch (i) {
                r.e(i)
            } finally {
                r.f()
            }
        }([x], [k])
    }, 72803: function (e, n, t) {
        t.r(n);
        var r = t(82573);
        n.default = r.Z
    }, 68540: function (e, n, t) {
        t.d(n, {
            gB: function () {
                return I
            }, ZP: function () {
                return Z
            }, Ew: function () {
                return R
            }, sL: function () {
                return A
            }
        });
        var r = t(65146), i = t(32781), a = t(67624), o = t.n(a), l = t(26447), u = t.n(l), c = t(85792), s = t.n(c),
            d = t(34346), f = t.n(d), v = t(53864), p = t(79705), m = t.n(p), h = t(353), g = t(8318), b = t(28712),
            w = t(56462), y = t(21292), _ = "MiecXVmm", x = "yQH6fSw7", k = "WPC30Qlr", E = "Zo1yz8QY", C = "RNsmkkvd",
            L = "adfr96Gm", S = "mmyd1ay5", T = "byN1CjlL", N = "McIlMS7W", P = new (t(13795).hD)({
                videoFilterShow: {eventName: "video_filter_show", params: {}},
                videoFilterClick: {eventName: "video_filter_click", params: {video_mode: ""}}
            }), I = new (o())([[g.Sw.All, "all"], [g.Sw.Landscape, "landscape"]]), R = function (e) {
                if ((0, b.p)()) try {
                    var n = w.Q.getItem({sKey: h.CookieKeys.VideoFilterMemoSelect, ctx: e});
                    return n && n.expireTime > u()() ? n.type : null
                } catch (r) {
                    return null
                }
                var t = w.Q.getItem({sKey: h.CookieKeys.VideoFilterMemoSelect});
                return t && t.expireTime > u()() ? t.type : null
            }, A = function (e) {
                var n = e.swiper, t = (0, v.useRef)(0), r = (0, v.useState)(!0), a = (0, i.Z)(r, 2), o = a[0], l = a[1];
                return (0, v.useEffect)((function () {
                    if (n) {
                        var e = function () {
                            l(!1)
                        };
                        return n.on("slideChange", e), function () {
                            n.off("slideChange", e)
                        }
                    }
                }), [n]), {videoSelectTypeRef: t, isExpand: o, setIsExpand: l}
            }, Z = function (e) {
                var n, t = e.options, a = e.defaultOption, o = e.className, l = e.handleSwitch, u = e.isExpand,
                    c = void 0 === u || u, d = e.onExpandChange, p = e.fixed, h = e.disableMouseLeave,
                    g = (0, v.useState)(), b = (0, i.Z)(g, 2), w = b[0], A = b[1], Z = (0, v.useState)(!1),
                    D = (0, i.Z)(Z, 2), V = D[0], M = D[1], O = (0, v.useState)(!1), F = (0, i.Z)(O, 2), z = F[0], H = F[1],
                    j = ((0, v.useContext)(y.C), (0, v.useRef)(null)), U = (0, v.useMemo)((function () {
                        return p && z ? "active" : c
                    }), [p, z, c]);
                return (0, v.useLayoutEffect)((function () {
                    null === R() && H(!0)
                }), []), (0, v.useEffect)((function () {
                    c || M(!1)
                }), [c]), (0, v.useEffect)((function () {
                    U && P.sendLog("videoFilterShow")
                }), [U]), v.createElement("div", {
                    className: m()(_, o, (n = {}, (0, r.Z)(n, x, Boolean(U)), (0, r.Z)(n, k, !U), n)),
                    onMouseEnter: function () {
                        j.current = s()((function () {
                            null == d || d(!0)
                        }), 300)
                    },
                    onMouseLeave: function () {
                        V || h || null == d || d(!1), clearTimeout(j.current)
                    },
                    onClick: function () {
                        return M(!0)
                    }
                }, v.createElement("div", {className: m()(E, (0, r.Z)({}, C, Boolean(U)))}), v.createElement("ul", {className: m()(L, (0, r.Z)({}, C, !U))}, f()(t).call(t, (function (e) {
                    var n = e.key, t = e.text;
                    return v.createElement("li", {
                        key: n,
                        className: m()(S, (0, r.Z)({}, N, (null != w ? w : a) === n))
                    }, v.createElement("span", {
                        className: T, onClick: function (t) {
                            w !== n ? (A(n), null == l || l(n, e), H(!1), P.sendLog("videoFilterClick", {video_mode: I.get(n) || ""})) : t.stopPropagation()
                        }
                    }, t))
                }))))
            }
    }, 18937: function (e, n, t) {
        t.d(n, {
            R: function () {
                return s
            }
        });
        var r = t(11227), i = t.n(r), a = t(8e3), o = t.n(a), l = t(56920), u = t(8318), c = t(68540),
            s = function (e) {
                var n, t, r, a = e || {}, s = a.videoFilterSelectTypeIn, d = void 0 === s ? (0, c.Ew)() : s,
                    f = a.landscapeStrategy, v = void 0 === f ? l.t7.Default : f, p = a.recommendVideoSelectType,
                    m = void 0 === p ? {} : p, h = a.recRemoveHeader;
                return (void 0 === h ? l.JU.Off : h) === l.JU.On || i()(n = [l.t7.A2, l.t7.A3]).call(n, v) ? u.Sw.Landscape : d === u.Sw.All ? null !== (t = m.all) && void 0 !== t ? t : u.Sw.All : d === u.Sw.Landscape && null !== (r = o()(m)) && void 0 !== r ? r : u.Sw.Landscape
            }
    }, 31226: function (e, n, t) {
        t.d(n, {
            f: function () {
                return i
            }, R: function () {
                return a
            }
        });
        var r = t(56920), i = [{key: "longtask_opt", alias: "longtaskOpt", defaultVal: r.BG.Default}, {
            key: "clarity_map",
            alias: "clarityMap",
            defaultVal: r.u2
        }, {
            key: "recommend_feed_cache_new",
            alias: "recommendFeedCache",
            defaultVal: r.v5.NoCache
        }, {key: "login_container_layer", alias: "loginContainerLayer", defaultVal: r.QE.Out}, {
            key: "home_banner",
            alias: "homeBanner",
            defaultVal: r.Lg.On
        }, {key: "enable_next_slide", alias: "enableNextSlide", defaultVal: r.D_.Off}, {
            key: "push_login_verify",
            alias: "pushLoginVerify",
            defaultVal: 0
        }, {key: "trust_rd_freq", alias: "trustRdFreq", defaultVal: r.sc.V0}, {
            key: "login_free_ad",
            alias: "loginFreeAd",
            defaultVal: r.eV.V0
        }, {key: "pcdn_config", alias: "pcdnConfig", defaultVal: null}, {
            key: "fetch_user_info_csr",
            alias: "fetchUserInfoCsr",
            defaultVal: r.um.Off
        }, {
            key: "permanent_dislike_btn",
            alias: "permanentDislikeBtn",
            defaultVal: r.Ap.Off
        }, {
            key: "has_zhuanti_hover",
            alias: "hasZhuantiHover",
            defaultVal: r.ES.Off
        }, {
            key: "ad_comment_ai_preload_status",
            alias: "adCommentAiPreloadStatus",
            defaultVal: r.aR.Off
        }, {
            key: "comment_ai_preload_status",
            alias: "commentAiPreloadStatus",
            defaultVal: r.wO.Off
        }, {key: "has_user_edit", alias: "hasUserEdit", defaultVal: r.A5.Off}, {
            key: "use_sw_cache",
            alias: "swcache",
            defaultVal: 0
        }, {key: "home_mark", alias: "homeMark", defaultVal: r.HM.Off}, {
            key: "home_inner_feed",
            alias: "homeInnerFeed",
            defaultVal: r.ud.Off
        }, {key: "shit_card_css", alias: "shitCardCss", defaultVal: 0}, {
            key: "waterfall_layout_perf",
            alias: "waterfallLayoutPerf",
            defaultVal: r.UI.Off
        }, {key: "discover_scroll_perf", alias: "discoverScrollPerf", defaultVal: r.R9.Off}, {
            key: "preload_count",
            alias: "preloadCount",
            defaultVal: null
        }, {
            key: "support_download_video",
            alias: "supportDownloadVideo",
            defaultVal: r.WH.Off
        }, {key: "rec_remove_header", alias: "recRemoveHeader", defaultVal: r.JU.Off}, {
            key: "recommend_guidance",
            alias: "recommendGuidance",
            defaultVal: 0
        }], a = [{key: "longtask_opt", alias: "longtaskOpt", defaultVal: r.BG.Default}, {
            key: "recommand_request",
            alias: "recommandRequest",
            defaultVal: 0
        }, {key: "fetch_user_info_csr", alias: "fetchUserInfoCsr", defaultVal: r.um.Off}, {
            key: "recommend_play",
            alias: "recommendPlay",
            defaultVal: r.UL.Off
        }, {
            key: "recommend_feed_cache_new",
            alias: "recommendFeedCache",
            defaultVal: r.v5.NoCache
        }, {
            key: "comment_ai_preload_status",
            alias: "commentAiPreloadStatus",
            defaultVal: r.wO.Off
        }, {
            key: "ad_comment_ai_preload_status",
            alias: "adCommentAiPreloadStatus",
            defaultVal: r.aR.Off
        }, {key: "has_user_edit", alias: "hasUserEdit", defaultVal: r.A5.Off}, {
            key: "home_mark",
            alias: "homeMark",
            defaultVal: r.HM.Off
        }, {key: "home_inner_feed", alias: "homeInnerFeed", defaultVal: r.ud.Off}, {
            key: "use_sw_cache",
            alias: "swcache",
            defaultVal: 0
        }, {key: "preload_count", alias: "preloadCount", defaultVal: null}, {
            key: "support_download_video",
            alias: "supportDownloadVideo",
            defaultVal: r.WH.Off
        }, {key: "rec_remove_header", alias: "recRemoveHeader", defaultVal: r.JU.Off}, {
            key: "recommend_guidance",
            alias: "recommendGuidance",
            defaultVal: 0
        }]
    }, 59030: function (e, n, t) {
        t.d(n, {
            Z: function () {
                return l
            }
        });
        var r = t(53864), i = t(95921), a = t(75422), o = "jB10n9bX", l = function () {
            var e = (0, i.TH)().pathname;
            return (0, i.LX)("/", e) || (0, i.LX)("/recommend", e) || (0, i.LX)("/discover", e) ? r.createElement(a.g, {
                className: o,
                text: "\u52a0\u8f7d\u4e2d"
            }) : null
        }
    }, 54029: function (e, n, t) {
        var r = t(13795);
        n.Z = new r.hD({
            slardar_fp: {eventName: "slardar_fp", params: {metric_duration: "", slardar_pid: ""}},
            slardar_lcp: {eventName: "slardar_lcp", params: {metric_duration: "", slardar_pid: ""}},
            slardar_ttfb: {eventName: "slardar_ttfb", params: {metric_duration: "", slardar_pid: ""}},
            slardar_mpfid: {eventName: "slardar_mpfid", params: {metric_duration: "", slardar_pid: ""}},
            slardar_fid: {eventName: "slardar_fid", params: {metric_duration: "", slardar_pid: ""}},
            slardar_domready: {eventName: "slardar_domready", params: {metric_duration: "", slardar_pid: ""}},
            slardar_response: {eventName: "slardar_response", params: {metric_duration: "", slardar_pid: ""}},
            custom_lcp: {eventName: "custom_lcp", params: {lcp_duration: "", page_name: "", element_type: ""}},
            slardar_longtask: {
                eventName: "slardar_longtask",
                params: {duration: 0, startTime: 0, page_name: "", afterLcp: !0}
            },
            webglSupport: {eventName: "webgl_support", params: {is_webgl1_support: 0, is_webgl2_support: 0}},
            loginStateLoss: {eventName: "login_state_loss", params: {params_for_special: "uc_login"}},
            layoutErrorBoundary: {eventName: "layout_error_boundary", params: {enter_from: ""}}
        })
    }, 92177: function (e, n, t) {
        t.d(n, {
            yL: function () {
                return c
            }, EB: function () {
                return s
            }
        });
        var r = t(32781), i = t(53864), a = t(54805), o = t(5277), l = (0, i.createContext)({
            curPreviewAweme: undefined, setCurPreviewAweme: function () {
            }
        }), u = (0, i.memo)((function (e) {
            return e.children
        })), c = function (e) {
            var n = e.children, t = (0, i.useState)(), a = (0, r.Z)(t, 2), o = a[0], c = a[1];
            return i.createElement(l.Provider, {
                value: {
                    curPreviewAweme: o,
                    setCurPreviewAweme: c
                }
            }, i.createElement(u, null, n))
        }, s = function (e) {
            var n = (0, i.useContext)(l), t = n.setCurPreviewAweme, r = n.curPreviewAweme, u = (0, a.Z)((function () {
                    t(e)
                })), c = (0, a.Z)((function () {
                    t(undefined)
                })),
                s = Boolean(e === r || (null == e ? void 0 : e.awemeId) && e.awemeId === (null == r ? void 0 : r.awemeId));
            return {onVideoImageMouseEnter: u, onVideoImageMouseLeave: c, isPreview: s && !(0, o.vU)(), isHovered: s}
        }
    }, 21292: function (e, n, t) {
        t.d(n, {
            C: function () {
                return r
            }
        });
        var r = t(72176).C
    }, 87091: function (e, n, t) {
        t.d(n, {
            r: function () {
                return r
            }
        });
        var r = (0, t(53864).createContext)({})
    }, 79587: function (e, n, t) {
        t.r(n), t.d(n, {
            Context: function () {
                return i
            }, reducer: function () {
                return a
            }, effect: function () {
                return o
            }, initialData: function () {
                return l
            }
        });
        var r = t(7607), i = r.Context, a = r.reducer, o = r.effect, l = r.initialData
    }, 67675: function (e, n, t) {
        t.d(n, {
            ej: function () {
                return f
            }, xH: function () {
                return p
            }, jg: function () {
                return m
            }, $6: function () {
                return h
            }, QV: function () {
                return g
            }
        });
        var r, i, a, o = t(65146), l = t(34346), u = t.n(l), c = t(50750), s = t.n(c), d = t(36177),
            f = {recommend: 0, vs: 1, tv: 2, movie: 3, anime: 4, documentary: 6},
            v = (f.vs, f.tv, f.movie, f.documentary, "vschannel"), p = u()(r = s()(f)).call(r, (function (e) {
                return "".concat(v, "_").concat(e)
            })), m = (u()(i = s()(f)).call(i, (function (e) {
                return "/".concat(v, "/").concat(e)
            })), {
                recommend: {title: "\u70ed\u95e8\u63a8\u8350", href: "", tags: [], name: "recommend", logName: "hot"},
                vs: {
                    title: "\u7efc\u827a",
                    href: globalThis.xssNamespace.douyin_web.filterUrl("/".concat(v, "/vs"), null, {
                        logType: "js.href/src",
                        mode: "black",
                        reportOnly: !1
                    }),
                    tags: ["\u81ea\u5236\u7efc\u827a\u70ed\u64ad\u4e2d"],
                    name: "vs",
                    logName: "show"
                },
                tv: {
                    title: "\u7535\u89c6\u5267",
                    href: globalThis.xssNamespace.douyin_web.filterUrl("/".concat(v, "/tv"), null, {
                        logType: "js.href/src",
                        mode: "black",
                        reportOnly: !1
                    }),
                    tags: ["\u7ecf\u5178\u5267\u96c6\u968f\u5fc3\u770b"],
                    name: "tv",
                    logName: "tv"
                },
                movie: {
                    title: "\u7535\u5f71",
                    href: globalThis.xssNamespace.douyin_web.filterUrl("/".concat(v, "/movie"), null, {
                        logType: "js.href/src",
                        mode: "black",
                        reportOnly: !1
                    }),
                    tags: ["\u514d\u8d39\u5927\u7247\u770b\u4e0d\u505c"],
                    name: "movie",
                    logName: "movie"
                },
                documentary: {
                    title: "\u7eaa\u5f55\u7247",
                    href: globalThis.xssNamespace.douyin_web.filterUrl("/".concat(v, "/documentary"), null, {
                        logType: "js.href/src",
                        mode: "black",
                        reportOnly: !1
                    }),
                    tags: ["\u8bb0\u5f55\u4e16\u95f4\u4e07\u8c61"],
                    name: "documentary",
                    logName: "documentation"
                },
                anime: {
                    title: "\u52a8\u753b",
                    href: globalThis.xssNamespace.douyin_web.filterUrl("/".concat(v, "/anime"), null, {
                        logType: "js.href/src",
                        mode: "black",
                        reportOnly: !1
                    }),
                    tags: ["\u4e50\u4eab\u7cbe\u5f69\u756a\u5267"],
                    name: "anime",
                    logName: "anime"
                }
            }), h = [m.vs, m.tv, m.movie, m.documentary, m.anime],
            g = (a = {}, (0, o.Z)(a, 0, d.VZ.All), (0, o.Z)(a, 1, d.VZ.Vs), (0, o.Z)(a, 2, d.VZ.TvShow), (0, o.Z)(a, 3, d.VZ.Movie), (0, o.Z)(a, 4, d.VZ.Cartoon), (0, o.Z)(a, 6, d.VZ.Documentary), a)
    }, 47888: function (e, n, t) {
        t.d(n, {
            m_: function () {
                return g
            }
        });
        var r = t(65146), i = t(30906), a = t(64408), o = t(5594), l = t.n(o), u = t(31674), c = t.n(u),
            s = (t(34346), t(22912)), d = t(43088), f = t(51867), v = t(97846), p = s.COMMON_SEARCH_PARAMS;

        function m(e, n) {
            return e || (n ? 0 : d.ERROR_CODE.ERROR_404)
        }

        function h(e) {
            var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {}, t = e.aweme_detail,
                r = e.status_code, i = e.log_pb;
            return {statusCode: m(r, t), detail: t && (0, v.s0)(t, n), logPb: i && c()(i)}
        }

        function g(e) {
            return b.apply(this, arguments)
        }

        function b() {
            return b = (0, a.Z)(l().mark((function e(n) {
                var t, a, o, u, c, s, d, v = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return t = n.awemeId, a = void 0 === t ? "" : t, o = n.cusotmConfig, u = void 0 === o ? {} : o, c = v.length > 1 && v[1] !== undefined ? v[1] : null, e.next = 4, (0, f.g8)("/aweme/v1/web/aweme/detail/", (0, i.Z)((0, i.Z)({}, p), {}, (0, r.Z)({}, "aweme_id", a)), c, (function (e) {
                                return h(e, u)
                            }));
                        case 4:
                            return s = e.sent, d = s.result, e.abrupt("return", d);
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), b.apply(this, arguments)
        }
    }, 84249: function (e, n, t) {
        t.d(n, {
            h$: function () {
                return g
            }, Aj: function () {
                return w
            }, VG: function () {
                return x
            }
        });
        var r = t(65146), i = t(30906), a = t(64408), o = t(5594), l = t.n(o), u = t(31674), c = t.n(u), s = t(34346),
            d = t.n(s), f = t(22912), v = t(97846), p = t(51867), m = f.COMMON_SEARCH_PARAMS;

        function h(e) {
            var n = e.aweme_list, t = void 0 === n ? [] : n, r = e.status_code, i = e.log_pb;
            return {
                statusCode: r,
                hasMore: !0,
                awemeList: (0, v.TN)({awemeList: t || [], logPb: i && c()(i)}),
                logPb: i && c()(i)
            }
        }

        function g(e) {
            return b.apply(this, arguments)
        }

        function b() {
            return b = (0, a.Z)(l().mark((function e(n) {
                var t, r, a, o, u, c, s, d, f, v, g = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return t = n.sentenceId, r = n.hotWord, a = void 0 === r ? "" : r, o = n.offest, u = void 0 === o ? 0 : o, c = n.count, s = void 0 === c ? 1 : c, d = g.length > 1 && g[1] !== undefined ? g[1] : null, e.next = 4, (0, p.g8)("/aweme/v1/web/hot/search/video/list/", (0, i.Z)((0, i.Z)({}, m), {}, {
                                hotword: a,
                                sentence_id: t,
                                offest: u,
                                count: s,
                                entry_name: "pc_web"
                            }), d, h);
                        case 4:
                            return f = e.sent, v = f.result, e.abrupt("return", v);
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), b.apply(this, arguments)
        }

        function w() {
            return y.apply(this, arguments)
        }

        function y() {
            return y = (0, a.Z)(l().mark((function e() {
                var n, t, a, o, u, c, s, d, f, v, g, b, w, y, _, x = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return t = x.length > 0 && x[0] !== undefined ? x[0] : {}, a = t.tagId, o = void 0 === a ? "" : a, u = t.count, c = void 0 === u ? 10 : u, s = t.channelId, d = void 0 === s ? 99 : s, f = t.seoFlag, v = void 0 === f ? 0 : f, g = t.options, b = void 0 === g ? {} : g, w = x.length > 1 && x[1] !== undefined ? x[1] : null, e.next = 4, (0, p.g8)("/aweme/v1/web/channel/hotspot", (0, i.Z)((0, i.Z)({}, m), {}, (n = {}, (0, r.Z)(n, "tag_id", o), (0, r.Z)(n, "count", c), (0, r.Z)(n, "Seo-Flag", v), (0, r.Z)(n, "channel_id", d), n)), w, h, {options: b}, (function (e) {
                                var n;
                                return 0 === e.statusCode && 0 === (null === (n = e.awemeList) || void 0 === n ? void 0 : n.length)
                            }));
                        case 4:
                            return y = e.sent, _ = y.result, e.abrupt("return", _);
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), y.apply(this, arguments)
        }

        function _(e) {
            var n, t = e.data, r = e.status_code, i = e.log_pb, a = t || {}, o = a.word_list, l = void 0 === o ? [] : o,
                u = a.trending_list;
            return {
                logPb: i && c()(i),
                statusCode: r,
                wordList: null == l || null === (n = d()(l)) || void 0 === n ? void 0 : n.call(l, (function (e) {
                    return {
                        awemeInfos: e.aweme_infos,
                        challengeId: e.challenge_id,
                        discussVideoCount: e.discuss_video_count,
                        driftInfo: e.drift_info,
                        eventTime: e.event_time,
                        groupId: e.group_id,
                        hotValue: e.hot_value,
                        hotlistParam: e.hotlist_param,
                        label: e.label,
                        position: e.position,
                        relatedWords: e.related_words,
                        roomCount: e.room_count,
                        sentenceId: e.sentence_id,
                        sentenceTag: e.sentence_tag,
                        videoCount: e.video_count,
                        viewCount: e.view_count,
                        word: e.word,
                        wordCover: e.word_cover,
                        wordSubBoard: e.word_sub_board,
                        wordType: e.word_type
                    }
                })),
                trendingList: d()(u).call(u, (function (e) {
                    return {word: e.word}
                }))
            }
        }

        function x() {
            return k.apply(this, arguments)
        }

        function k() {
            return k = (0, a.Z)(l().mark((function e() {
                var n, t, r, a, o, u = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return n = u.length > 0 && u[0] !== undefined ? u[0] : {}, t = u.length > 1 && u[1] !== undefined ? u[1] : null, r = u.length > 2 ? u[2] : undefined, e.next = 5, (0, p.g8)("/aweme/v1/web/hot/search/list/", (0, i.Z)((0, i.Z)({}, m), {}, {
                                detail_list: 1,
                                source: 6
                            }), t, _, {options: n}, undefined, r);
                        case 5:
                            return a = e.sent, o = a.result, e.abrupt("return", o);
                        case 8:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), k.apply(this, arguments)
        }
    }, 47877: function (e, n, t) {
        t.d(n, {
            Lz: function () {
                return _
            }, HN: function () {
                return k
            }, iv: function () {
                return C
            }
        });
        var r = t(65146), i = t(30906), a = t(64408), o = t(5594), l = t.n(o), u = t(31674), c = t.n(u),
            s = (t(94090), t(21155)), d = t.n(s), f = t(22912), v = t(97846), p = t(72018), m = t(51867), h = f,
            g = h.COMMON_SEARCH_PARAMS, b = h.CHANNEL_PC_WEB;

        function w(e) {
            var n = e.aweme_list, t = e.has_more, r = e.status_code, i = e.cursor, a = e.log_pb;
            return {
                logPb: a && c()(a),
                statusCode: r || 0,
                hasMore: t,
                cursor: i,
                data: (0, v.TN)({logPb: a && c()(a), awemeList: n || []}) || []
            }
        }

        function y(e) {
            var n = e.mix_infos, t = e.has_more, r = e.status_code, i = e.cursor, a = e.total, o = e.log_pb;
            return {statusCode: r, hasMore: t, cursor: i, total: a, logPb: o && c()(o), data: (0, p.NR)(n || [])}
        }

        function _(e) {
            return x.apply(this, arguments)
        }

        function x() {
            return x = (0, a.Z)(l().mark((function e(n) {
                var t, a, o, u, c, s, f, v, p, h = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return a = n.mixId, o = n.cursor, u = n.count, c = void 0 === u ? 12 : u, s = h.length > 1 && h[1] !== undefined ? h[1] : null, e.next = 4, (0, m.g8)("/aweme/v1/web/mix/aweme/", (0, i.Z)((0, i.Z)({}, g), {}, (t = {}, (0, r.Z)(t, "mix_id", a), (0, r.Z)(t, "cursor", Math.max(o, 0)), (0, r.Z)(t, "count", c), t)), s, w, {}, (function (e) {
                                var n;
                                return 0 === e.statusCode && 0 === (null == e || null === (n = e.data) || void 0 === n ? void 0 : n.length)
                            }));
                        case 4:
                            return f = e.sent, null != (v = f.result) && v.data && d()(p = v.data).call(p, (function (e) {
                                e.logPb = v.logPb
                            })), e.abrupt("return", v);
                        case 8:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), x.apply(this, arguments)
        }

        function k(e) {
            return E.apply(this, arguments)
        }

        function E() {
            return E = (0, a.Z)(l().mark((function e(n) {
                var t, a, o, u, c, s, d, f, v, p = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return a = n.uid, o = n.cursor, u = void 0 === o ? 0 : o, c = n.count, s = void 0 === c ? 12 : c, d = p.length > 1 && p[1] !== undefined ? p[1] : null, e.next = 4, (0, m.g8)("/aweme/v1/web/mix/list/", (0, i.Z)((0, i.Z)({}, g), {}, (t = {}, (0, r.Z)(t, "sec_user_id", a), (0, r.Z)(t, "req_from", b), (0, r.Z)(t, "cursor", u), (0, r.Z)(t, "count", s), t)), d, y);
                        case 4:
                            return f = e.sent, v = f.result, e.abrupt("return", v);
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), E.apply(this, arguments)
        }

        function C(e) {
            return L.apply(this, arguments)
        }

        function L() {
            return L = (0, a.Z)(l().mark((function e(n) {
                var t, r, i, a, o, u, c, s, d, f, v, p, m = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return t = n.mixId, r = n.totalEpisode, i = n.currentEpisode, a = n.count, o = m.length > 1 && m[1] !== undefined ? m[1] : null, u = Math.max(Math.min(i - 1, r - a), 0), e.next = 5, _({
                                mixId: t,
                                cursor: u,
                                count: a
                            }, o);
                        case 5:
                            return c = e.sent, s = c.statusCode, d = c.data, f = c.hasMore, v = c.cursor, p = c.logPb, e.abrupt("return", {
                                mixId: t,
                                statusCode: s,
                                data: d,
                                currentEpisode: i,
                                hasMore: f,
                                cursor: 0 === s ? v : u,
                                logPb: p
                            });
                        case 12:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), L.apply(this, arguments)
        }
    }, 93226: function (e, n, t) {
        t.d(n, {
            b: function () {
                return g
            }
        });
        var r = t(65146), i = t(30906), a = t(64408), o = t(5594), l = t.n(o), u = t(31674), c = t.n(u), s = t(21155),
            d = t.n(s), f = t(22912), v = t(97846), p = t(51867), m = f.COMMON_SEARCH_PARAMS;

        function h(e) {
            var n = e.aweme_list, t = void 0 === n ? [] : n, r = e.status_code, i = e.has_more, a = e.log_pb;
            return {
                logPb: a && c()(a),
                statusCode: r,
                hasMore: i,
                awemeList: (0, v.TN)({awemeList: t || [], logPb: a && c()(a)})
            }
        }

        function g(e) {
            return b.apply(this, arguments)
        }

        function b() {
            return b = (0, a.Z)(l().mark((function e(n) {
                var t, a, o, u, c, s, f, v, g, b, w = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return a = n.awemeId, o = void 0 === a ? "" : a, u = n.count, c = void 0 === u ? 6 : u, s = n.filterGids, f = w.length > 1 && w[1] !== undefined ? w[1] : null, e.next = 4, (0, p.g8)("/aweme/v1/web/aweme/related/", (0, i.Z)((0, i.Z)({}, m), {}, (t = {}, (0, r.Z)(t, "aweme_id", o), (0, r.Z)(t, "count", c), (0, r.Z)(t, "filterGids", s), t)), f, h, {});
                        case 4:
                            return v = e.sent, null != (g = v.result) && g.awemeList && d()(b = g.awemeList).call(b, (function (e) {
                                e.logPb = g.logPb
                            })), e.abrupt("return", g);
                        case 8:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), b.apply(this, arguments)
        }
    }, 4028: function (e, n, t) {
        t.d(n, {
            e9: function () {
                return G
            }, Nu: function () {
                return X
            }, NN: function () {
                return ie
            }
        });
        var r = t(65146), i = t(30906), a = t(64408), o = t(5594), l = t.n(o), u = t(8e3), c = t.n(u), s = t(31674),
            d = t.n(s), f = (t(68493), t(85792), t(26447)), v = t.n(f), p = t(94090), m = t.n(p), h = t(56442),
            g = t.n(h), b = t(65981), w = t.n(b), y = t(67330), _ = t(22541), x = t.n(_), k = t(22912), E = t(36177),
            C = t(56920), L = t(34452), S = t(21518), T = t(353), N = t(8318), P = t(87130), I = t(5611), R = t(9191),
            A = t(28712), Z = t(51365), D = t(9729), V = t(71116), M = t(13971), O = t(97846), F = t(70399),
            z = t(51613), H = t(51867), j = k.COMMON_SEARCH_PARAMS, U = 1;

        function W(e) {
            var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {}, t = e.aweme_list,
                r = void 0 === t ? [] : t, i = e.status_code, a = e.log_pb, o = (n || {}).filterLiveInClient,
                l = void 0 !== o && o, u = r;
            return (0, I.DT)() && l && (u = c()(r).call(r, (function (e) {
                return (null == e ? void 0 : e.aweme_type) !== E.ed.LiveCard
            }))), {
                statusCode: i,
                hasMore: !0,
                awemeList: (0, O.TN)({awemeList: u || [], logPb: a && d()(a)}),
                logPb: a && d()(a)
            }
        }

        var q = null, B = function (e) {
            var n = "";
            if (e) {
                var t, r = null == e || null === (t = e.request) || void 0 === t ? void 0 : t.search,
                    i = null == r ? void 0 : r.match(/vid=([0-9]+)?/);
                null != i && i[1] && (n = null == i ? void 0 : i[1])
            } else {
                var a = y.parse((0, R.ht)());
                null != a && a.vid && (n = null == a ? void 0 : a.vid)
            }
            return n
        }, G = function (e) {
            var n, t = "",
                r = e ? null == e || null === (n = e.request) || void 0 === n ? void 0 : n.search : (0, R.ht)(),
                i = y.parse(r);
            return null != i && i.live_insert_type && (t = null == i ? void 0 : i.live_insert_type), t
        }, J = function (e, n) {
            var t, r = "", i = "",
                a = n ? null == n || null === (t = n.request) || void 0 === t ? void 0 : t.search : (0, R.ht)(),
                o = y.parse(a);
            return o.ug_source && o.creative_id && 1 === e && (r = o.ug_source, i = o.creative_id), {
                ug_source: r,
                creative_id: i
            }
        };

        function X(e, n) {
            return K.apply(this, arguments)
        }

        function K() {
            return (K = (0, a.Z)(l().mark((function e(n, t) {
                var a, o, u, c, s, f, v, p, m, h, g, b, w, y, _, x, k, E, C, L, S, T, P, R, Z, D, V, M, O;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return o = n.pullType, u = n.tagId, c = void 0 === u ? "" : u, s = n.count, f = void 0 === s ? 10 : s, v = n.refreshIndex, p = void 0 === v ? 1 : v, m = n.customConfig, h = void 0 === m ? {} : m, g = n.videoTypeSelect, b = void 0 === g ? N.Sw.All : g, w = n.globalwid, y = void 0 === w ? "" : w, _ = n.awemePcRecRawData, x = void 0 === _ ? {} : _, k = n.options, E = void 0 === k ? {} : k, C = n.cancelCb, L = void 0 === C ? {
                                current: function () {
                                }
                            } : C, S = n.preFetch, T = void 0 !== S && S, P = n.minWindow, R = n.launchLiveFilters, Z = n.freeRight, D = void 0 === Z ? 0 : Z, x.is_client = (0, I.DT)(t), V = (0, H.g8)("/aweme/v1/web/tab/feed/", (0, i.Z)((0, i.Z)({}, j), {}, (a = {}, (0, r.Z)(a, "tag_id", c), (0, r.Z)(a, "share_aweme_id", 1 === p ? B(t) : ""), (0, r.Z)(a, "live_insert_type", G()), (0, r.Z)(a, "pc_launch_live_filters", R), (0, r.Z)(a, "count", f), (0, r.Z)(a, "refresh_index", p), (0, r.Z)(a, "video_type_select", b), (0, r.Z)(a, "aweme_pc_rec_raw_data", d()(x)), (0, r.Z)(a, "globalwid", y), (0, r.Z)(a, "pull_type", o), (0, r.Z)(a, "min_window", P ? 1 : 0), (0, r.Z)(a, "free_right", D), a), J(p, t)), t, (function (e) {
                                return W(e, h)
                            }), E, (function (e) {
                                var n;
                                return 0 === e.statusCode && 0 === (null === (n = e.awemeList) || void 0 === n ? void 0 : n.length)
                            }), L), 1 === p && !(0, A.p)() && T && (q = V), e.next = 6, V;
                        case 6:
                            return M = e.sent, O = M.result, e.abrupt("return", O);
                        case 9:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))).apply(this, arguments)
        }

        function Y(e) {
            "function" == typeof Image && e && ((new Image).src = globalThis.xssNamespace.douyin_web.filterUrl(e, null, {
                logType: "js.href/src",
                mode: "black",
                reportOnly: !1
            }))
        }

        var Q = function (e) {
            var n, t, r, i, a, o, l, u;
            null != e && null !== (n = e.awemeList) && void 0 !== n && null !== (t = n[0]) && void 0 !== t && t.awemeId && (0, P.uR)({awemeIds: null == e || null === (l = e.awemeList) || void 0 === l || null === (u = l[0]) || void 0 === u ? void 0 : u.awemeId});
            null != e && null !== (r = e.awemeList) && void 0 !== r && null !== (i = r[0]) && void 0 !== i && null !== (a = i.video) && void 0 !== a && null !== (o = a.coverUrlList) && void 0 !== o && o[0] && Y(e.awemeList[0].video.originCover)
        }, $ = function () {
            var e = (0, a.Z)(l().mark((function e(n) {
                var t, r, i, a, o;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return e.next = 2, (0, z.m_)({awemeId: n});
                        case 2:
                            if (t = e.sent, r = t.statusCode, i = t.detail, a = t.logPb, 0 === r) {
                                e.next = 8;
                                break
                            }
                            return e.abrupt("return");
                        case 8:
                            return i.logPb = a, Q(o = {
                                statusCode: r,
                                hasMore: !0,
                                awemeList: [i],
                                logPb: a
                            }), e.abrupt("return", o);
                        case 12:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n) {
                return e.apply(this, arguments)
            }
        }(), ee = function () {
            var e = (0, a.Z)(l().mark((function e() {
                var n, t, r, i, a, o, u, c, s;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return e.prev = 0, e.next = 3, window.awemeDetailPrefetch;
                        case 3:
                            if (t = e.sent, r = {}, "string" == typeof t) try {
                                r = w().parse(t)
                            } catch (l) {
                                Z.oe.event.error({
                                    name: Z.Mo.AwemeDetailPrefetchFailed,
                                    report: {isSync: !1, message: "Json big parse error", content: t}
                                });
                                try {
                                    r = JSON.parse(t)
                                } catch (d) {
                                    r = {}, Z.oe.event.error({
                                        name: Z.Mo.AwemeDetailPrefetchFailed,
                                        report: {isSync: !1, message: "Json parse error", content: t}
                                    })
                                }
                            }
                            if (r.aweme_list = [r.aweme_detail], i = W(r), Q(i), null != i && i.awemeList && null != i && null !== (n = i.awemeList) && void 0 !== n && n.length) {
                                e.next = 11;
                                break
                            }
                            throw new Error("The fetch tab prefetch awemeList length is zero");
                        case 11:
                            return e.abrupt("return", i);
                        case 14:
                            if (e.prev = 14, e.t0 = e.catch(0), a = localStorage.getItem("RECOMMEND_AWEME_DETAIL_STATUS") || "", o = localStorage.getItem("RECOMMEND_AWEME_DETAIL_LOGID") || "", localStorage.removeItem("RECOMMEND_AWEME_DETAIL_STATUS"), localStorage.removeItem("RECOMMEND_AWEME_DETAIL_LOGID"), u = B(), Z.oe.event.error({
                                name: Z.Mo.AwemeDetailPrefetchFailed,
                                report: {isSync: !1, message: e.t0.message, logId: o, statusCode: a, type: u ? 0 : 1}
                            }), "RISK_CONTROL" !== (null === e.t0 || void 0 === e.t0 ? void 0 : e.t0.message) || !u) {
                                e.next = 28;
                                break
                            }
                            return e.next = 25, $(u);
                        case 25:
                            if (null == (s = e.sent) || null === (c = s.awemeList) || void 0 === c || !c.length) {
                                e.next = 28;
                                break
                            }
                            return e.abrupt("return", s);
                        case 28:
                            return e.abrupt("return", null);
                        case 29:
                        case"end":
                            return e.stop()
                    }
                }), e, null, [[0, 14]])
            })));
            return function () {
                return e.apply(this, arguments)
            }
        }(), ne = function () {
            var e = (0, a.Z)(l().mark((function e() {
                var n, t, r, i, a, o, u, c, s, d, f, v = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return n = v.length > 0 && v[0] !== undefined ? v[0] : {}, e.prev = 1, (0, D.B1)("tabFeedPrefetchStart"), e.next = 5, window.tabFeedPrefetch;
                        case 5:
                            if (u = e.sent, (0, D.B1)("tabFeedPrefetchEnd"), c = {}, "string" == typeof u) try {
                                c = w().parse(u)
                            } catch (l) {
                                Z.oe.event.error({
                                    name: Z.Mo.PrefetchFailed,
                                    report: {isSync: !1, message: "Json big parse error", content: u}
                                });
                                try {
                                    c = JSON.parse(u)
                                } catch (p) {
                                    c = {}, Z.oe.event.error({
                                        name: Z.Mo.PrefetchFailed,
                                        report: {isSync: !1, message: "Json parse error", content: u}
                                    })
                                }
                            }
                            if (null != (s = W(c, n)) && null !== (t = s.awemeList) && void 0 !== t && null !== (r = t[0]) && void 0 !== r && null !== (i = r.video) && void 0 !== i && null !== (a = i.coverUrlList) && void 0 !== a && a[0] && Y(s.awemeList[0].video.originCover), null != s && s.awemeList && null != s && null !== (o = s.awemeList) && void 0 !== o && o.length) {
                                e.next = 14;
                                break
                            }
                            throw new Error("The fetch tab prefetch awemeList length is zero");
                        case 14:
                            return e.abrupt("return", {type: U, result: s});
                        case 17:
                            return e.prev = 17, e.t0 = e.catch(1), d = localStorage.getItem("RECOMMENTFETCHSTATUS") || "", f = localStorage.getItem("RECOMMENTFETCHLOGID") || "", localStorage.removeItem("RECOMMENTFETCHSTATUS"), localStorage.removeItem("RECOMMENTFETCHLOGID"), Z.oe.event.error({
                                name: Z.Mo.PrefetchFailed,
                                report: {isSync: !1, message: e.t0.message, logId: f, statusCode: d}
                            }), e.abrupt("return", null);
                        case 25:
                        case"end":
                            return e.stop()
                    }
                }), e, null, [[1, 17]])
            })));
            return function () {
                return e.apply(this, arguments)
            }
        }();

        function te(e, n, t) {
            if (t !== C.v5.NoCache) {
                var r = (0, F.r)(e);
                if (null != r && r.length) {
                    var i = ((null == r ? void 0 : r[r.length - 1]) || {}).awemeId;
                    if (i) {
                        var a, o, l, u = v()() + 864e5,
                            c = (null === (a = (0, V.Es)()) || void 0 === a ? void 0 : a.user_unique_id) || "";
                        localStorage.setItem(m()(o = "feed_cache_awemeid_".concat(c, "_")).call(o, n), m()(l = "".concat(i, "_")).call(l, u))
                    }
                }
            }
        }

        var re = function () {
            var e = (0, a.Z)(l().mark((function e() {
                var n, t, r, i, a, o = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return n = o.length > 0 && o[0] !== undefined ? o[0] : {}, e.next = 3, L.U2({
                                key: S.TccKey.CommonSetting,
                                defaultValue: S.TCC_DEFAULT_VALUE_MAP.get(S.TccKey.CommonSetting)
                            });
                        case 3:
                            t = e.sent;
                            try {
                                n.customConfig ? n.customConfig.filterLiveInClient = t.clientFilterLiveInRecommend || !1 : n.customConfig = {filterLiveInClient: t.clientFilterLiveInRecommend || !1}
                            } catch (l) {
                            }
                            1 === (null == n ? void 0 : n.refreshIndex) && null != (r = y.parse((0, R.ht)())) && r.live_insert_type && (i = (0, M.$o)(T.LocalStorageKeys.LiveLandingIds), a = x()().format("YYYYMMDD"), (null == i ? void 0 : i.date) === a && (n.launchLiveFilters = null == i ? void 0 : i.ids));
                        case 6:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function () {
                return e.apply(this, arguments)
            }
        }();

        function ie(e) {
            return ae.apply(this, arguments)
        }

        function ae() {
            return ae = (0, a.Z)(l().mark((function e(n) {
                var t, r, i, a, o, u, c, s, d, f, v, p, m, h, b, w, y, _ = arguments;
                return l().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return i = _.length > 1 && _[1] !== undefined ? _[1] : {recommendFeedCache: C.v5.NoCache}, a = i.recommendFeedCache, o = void 0 === a ? C.v5.NoCache : a, u = _.length > 2 && _[2] !== undefined ? _[2] : null, c = n.refreshIndex, s = n.videoTypeSelect, d = !1, e.next = 6, re(n);
                        case 6:
                            if (!window.awemeDetailPrefetch && !window.tabFeedPrefetch) {
                                e.next = 26;
                                break
                            }
                            if (!window.awemeDetailPrefetch) {
                                e.next = 14;
                                break
                            }
                            return e.next = 10, ee();
                        case 10:
                            f = e.sent, window.awemeDetailPrefetch = null, v = f, d = !0;
                        case 14:
                            if (!window.tabFeedPrefetch || f) {
                                e.next = 20;
                                break
                            }
                            return e.next = 17, ne(n.customConfig);
                        case 17:
                            p = e.sent, v = null == p ? void 0 : p.result, window.tabFeedPrefetch = null;
                        case 20:
                            if (v) {
                                e.next = 24;
                                break
                            }
                            return e.next = 23, X(n, u);
                        case 23:
                            v = e.sent;
                        case 24:
                            e.next = 38;
                            break;
                        case 26:
                            if (1 !== c || null === q) {
                                e.next = 35;
                                break
                            }
                            return e.next = 29, q;
                        case 29:
                            m = e.sent, h = m.result, v = h, q = null, e.next = 38;
                            break;
                        case 35:
                            return e.next = 37, X(n, u);
                        case 37:
                            v = e.sent;
                        case 38:
                            return 1 === c && (null === (t = v.awemeList) || void 0 === t ? void 0 : t.length) > 0 && null !== (b = v.awemeList[0]) && void 0 !== b && null !== (w = b.status) && void 0 !== w && w.isDelete && (v.awemeList = g()(y = v.awemeList).call(y, 1)), !d && (null === (r = v.awemeList) || void 0 === r ? void 0 : r.length) > 0 && te(v.awemeList, s, o), e.abrupt("return", v);
                        case 41:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), ae.apply(this, arguments)
        }
    }, 51867: function (e, n, t) {
        t.d(n, {
            q8: function () {
                return p
            }, VX: function () {
                return m
            }, g8: function () {
                return h
            }, yr: function () {
                return b
            }
        });
        var r = t(30906), i = t(64408), a = t(5594), o = t.n(a), l = t(26447), u = t.n(l), c = t(86860), s = t(51365),
            d = t(16437), f = t(72018), v = t(89436), p = "ies.janus.proxy", m = "aweme_pc";

        function h(e, n) {
            return g.apply(this, arguments)
        }

        function g() {
            return g = (0, i.Z)(o().mark((function e(n, t) {
                var i, a, l, c, d, p, m, h, g, b = arguments;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return i = b.length > 2 && b[2] !== undefined ? b[2] : null, a = b.length > 3 ? b[3] : undefined, l = b.length > 4 && b[4] !== undefined ? b[4] : undefined, c = b.length > 5 && b[5] !== undefined ? b[5] : null, d = b.length > 6 && b[6] !== undefined ? b[6] : {
                                current: function () {
                                }
                            }, p = u()(), e.next = 8, (0, v.U)(n, t, i, l, d);
                        case 8:
                            m = e.sent, h = (0, f.RL)(m, a), null != c && c(h) && s.oe.event.error({
                                name: s.Mo.ResponseJudgeError,
                                report: {
                                    req: (0, r.Z)({}, t),
                                    path: n,
                                    logId: null == m || null === (g = m.log_pb) || void 0 === g ? void 0 : g.impr_id
                                }
                            });
                            try {
                                h.consumerTime = u()() - p
                            } catch (o) {
                            }
                            return e.abrupt("return", {json: m, result: h});
                        case 13:
                        case"end":
                            return e.stop()
                    }
                }), e)
            }))), g.apply(this, arguments)
        }

        function b(e) {
            return w.apply(this, arguments)
        }

        function w() {
            return (w = (0, i.Z)(o().mark((function e(n) {
                var t, r, i, a, l, u, s, p;
                return o().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return t = n.url, r = n.body, i = n.options, a = n.baseUrl, l = void 0 === a ? "" : a, u = n.pack, "Object" === (0, d.tQ)(r) && (r = (0, c.stringify)(r)), e.next = 4, (0, v.v)(t, r, i, l);
                        case 4:
                            return s = e.sent, p = (0, f.RL)(s, u), e.abrupt("return", {json: s, result: p});
                        case 7:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))).apply(this, arguments)
        }
    }, 89436: function (e, n, t) {
        t.d(n, {
            U: function () {
                return Y
            }, v: function () {
                return $
            }
        });
        var r = t(64408), i = t(30906), a = t(11350), o = t.n(a), l = t(5594), u = t.n(l), c = t(11227), s = t.n(c),
            d = t(84639), f = t.n(d), v = t(94090), p = t.n(v), m = t(26447), h = t.n(m), g = t(31674), b = t.n(g),
            w = t(77386), y = t.n(w), _ = t(65981), x = t.n(_), k = t(67330), E = t(77102), C = t(22912), L = t(43088),
            S = t(40673), T = t(44180), N = t(18015), P = t(5611), I = t(71116), R = t(22712), A = t(51365),
            Z = t(28712), D = t(16437), V = t(51867), M = t(22541), O = t.n(M), F = t(353), z = [];

        function H(e) {
            var n, t, r, i, a, o;
            try {
                var l,
                    u = window.localStorage.getItem(null == E || null === (l = F) || void 0 === l ? void 0 : l.LOG_TRACE);
                z = u ? JSON.parse(u) : []
            } catch (v) {
            }
            z && z.length >= (null == E || null === (n = F) || void 0 === n ? void 0 : n.LOG_TRACE_COUNT) && z.shift();
            var c = null == e || null === (t = e.data) || void 0 === t || null === (r = t.log_pb) || void 0 === r ? void 0 : r.impr_id,
                s = null == e || null === (i = e.config) || void 0 === i ? void 0 : i.url, d = window.location.href;
            z.push({
                time: O()(h()()).format("YYYY-MM-DD HH:mm:ss"),
                wid: null === (a = (0, I.Es)()) || void 0 === a ? void 0 : a.user_unique_id,
                uid: (0, I.sq)(),
                logId: c,
                url: s,
                visit: d
            });
            var f = "";
            try {
                f = b()(z)
            } catch (v) {
            }
            window.localStorage.setItem(null == E || null === (o = F) || void 0 === o ? void 0 : o.LOG_TRACE, f)
        }

        var j = ["/aweme/v1/web/aweme/post/", "/aweme/v1/web/page/data/", "/aweme/v1/web/channel/hotspot/", "/aweme/v1/web/commerce/challenge/aweme/", "/aweme/v1/web/challenge/aweme/", "/aweme/v1/web/challenge/detail/", "/aweme/v1/web/seo/user/experiment/", "/aweme/v1/web/lvideo/theater/feed/"],
            U = ["/aweme/v1/web/seo/entity/tag", "/aweme/v1/web/seo/related/item/", "/aweme/v1/web/seo/detail/links/"],
            W = function (e) {
                return s()(j).call(j, e) ? 2e3 : s()(U).call(U, e) ? 1200 : 800
            }, q = y().create(), B = (0, P.gn)(), G = B.version_code, J = B.version_name;
        q.interceptors.request.use((function (e) {
            var n, t;
            return e.params || (e.params = {}), e.params.version_code = G, e.params.version_name = J, f()(e.params, (0, i.Z)((0, i.Z)({}, null == E || null === (n = C) || void 0 === n ? void 0 : n.getNavigatorParams()), {}, {webid: (null === (t = (0, I.Es)()) || void 0 === t ? void 0 : t.user_unique_id) || ""})), e
        }), null, {synchronous: !0}), (0, S.U)(q);
        var X = function () {
            var e = (0, r.Z)(u().mark((function e(n, t, r) {
                var a, o, l, c, d, f, v, m, g, b, w, y, _, E, C, L, S, T, N, I, R, A, Z, D, M, O, F, z, H, U, q, B, X,
                    K, Y, Q, $, ee, ne, te, re, ie = arguments;
                return u().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            return N = ie.length > 3 && ie[3] !== undefined ? ie[3] : {}, I = N.options, R = void 0 === I ? {} : I, A = N.psm, Z = void 0 === A ? V.q8 : A, D = N.cluster, M = void 0 === D ? V.VX : D, O = N.origin, void 0 === O ? "" : O, (F = t || {}).pc_client_type = (0, P.ub)(r), z = p()(a = p()(o = p()(l = p()(c = "consul:".concat(Z)).call(c, n, "?")).call(l, k.stringify(F), "&version_code=")).call(o, G, "&version_name=")).call(a, J), H = {
                                "content-type": "*/*",
                                "device-platform": "web",
                                "user-agent": r.request.headers["user-agent"],
                                "x-use-ppe": r.request.headers["x-use-ppe"] || "",
                                "x-use-boe": r.request.headers["x-use-boe"] || "",
                                "x-tt-env": r.request.headers["dy-use-ppe"] || r.request.headers["x-tt-env"] || "",
                                "X-Tlb-Cluster": "internal_lb_core_api",
                                "X-Real-Ip": r.request.headers["x-real-ip"] || "",
                                "Whale-Decision": r.request.headers["whale-decision"],
                                "Whale-Decision-Conf": r.request.headers["whale-decision-conf"],
                                referer: "https://www.douyin.com/".concat((null == r || null === (d = r.request) || void 0 === d ? void 0 : d.path) || ""),
                                cookie: null === (f = r.request.header) || void 0 === f ? void 0 : f.cookie
                            }, U = h()(), q = W(n), e.next = 9, r.fetch(z, (0, i.Z)({
                                method: "GET",
                                handleMethod: n,
                                consul: {cluster: M},
                                timeout: q,
                                cookie: null === (v = r.request.header) || void 0 === v ? void 0 : v.cookie,
                                headers: (0, i.Z)({}, H),
                                ctx: {env: r.request.headers["x-tt-env"], handleMethod: n, logId: r.request.logId}
                            }, R));
                        case 9:
                            return B = e.sent, X = h()(), s()(j).call(j, n) && (null === (K = r.metrics) || void 0 === K || null === (Y = K.emitTimer) || void 0 === Y || Y.call(K, "api.cost_time", X - U, "", {
                                path: n,
                                idc: null === (Q = r.bytedEnv) || void 0 === Q ? void 0 : Q.idc
                            })), e.next = 14, B.text();
                        case 14:
                            return $ = e.sent, ee = x().parse($), ne = null !== (m = null == B || null === (g = B.headers) || void 0 === g || null === (b = g.get) || void 0 === b ? void 0 : b.call(g, "whale-decision-custom")) && void 0 !== m ? m : "", te = null !== (w = null == B || null === (y = B.headers) || void 0 === y || null === (_ = y.get) || void 0 === _ ? void 0 : _.call(y, "whale_cut_token")) && void 0 !== w ? w : "", re = null !== (E = null == B || null === (C = B.headers) || void 0 === C || null === (L = C.get) || void 0 === L ? void 0 : L.call(C, "whale-block-time-select")) && void 0 !== E ? E : "", e.abrupt("return", (0, i.Z)((0, i.Z)({}, ee), {}, {
                                whaleDecisionCustom: (null == B || null === (S = B.headers) || void 0 === S || null === (T = S.get) || void 0 === T ? void 0 : T.call(S, "whale-decision-custom")) || "",
                                whaleInfo: {whaleDecisionCustom: ne, whaleCutToken: te, whaleBlockTimeSelect: re}
                            }));
                        case 20:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n, t, r) {
                return e.apply(this, arguments)
            }
        }(), K = function () {
            var e = (0, r.Z)(u().mark((function e(n, t, r) {
                var a, l, c, d, f, v, p, m, h, g, w, _, k, E, C, L, S, I, Z, D, M, O, F, z, j, U, W, B, G, J, X,
                    K = arguments;
                return u().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (g = K.length > 3 && K[3] !== undefined ? K[3] : {}, w = g.options, _ = void 0 === w ? {} : w, k = g.cancelCb, E = void 0 === k ? {
                                current: function () {
                                }
                            } : k, C = g.psm, void 0 === C ? V.q8 : C, L = g.cluster, void 0 === L ? V.VX : L, S = g.origin, I = void 0 === S ? "" : S, !s()(T.yd).call(T.yd, o()(n, "/"))) {
                                e.next = 4;
                                break
                            }
                            return e.next = 4, (0, T.Fm)();
                        case 4:
                            return (Z = t || {}).pc_client_type = (0, P.ub)(), e.next = 8, q((0, i.Z)({
                                url: n,
                                method: "GET",
                                baseURL: I,
                                params: Z,
                                withCredentials: !0,
                                headers: {"Content-Type": "application/json"},
                                cancelToken: new (y().CancelToken)((function (e) {
                                    E.current = e
                                })),
                                transformResponse: function (e, n) {
                                    if ("string" == typeof e) try {
                                        e = x().parse(e)
                                    } catch (t) {
                                        try {
                                            e = JSON.parse(e)
                                        } catch (r) {
                                            e = {}
                                        }
                                    }
                                    return e
                                }
                            }, _));
                        case 8:
                            return D = e.sent, e.next = 11, (0, N.P)(q, D);
                        case 11:
                            return H(M = e.sent), O = null !== (a = M.data) && void 0 !== a ? a : {}, F = O.status_code, z = O.status_msg, j = O.log_pb, F && (0, R.e)(n, F) && (W = null !== (U = _.metrics) && void 0 !== U ? U : {}, B = (0, i.Z)({
                                status_code: F,
                                status_msg: z,
                                log_id: null == j ? void 0 : j.impr_id,
                                params: b()(Z)
                            }, W), A.oe.event.error({
                                name: A.Mo.ResponseStatusCodeError,
                                report: (0, i.Z)((0, i.Z)({}, B), {}, {path: n})
                            })), G = null !== (l = null == M || null === (c = M.headers) || void 0 === c ? void 0 : c["whale-decision-custom"]) && void 0 !== l ? l : "", J = null !== (d = null == M || null === (f = M.headers) || void 0 === f ? void 0 : f.whale_cut_token) && void 0 !== d ? d : "", X = null !== (v = null == M || null === (p = M.headers) || void 0 === p ? void 0 : p["whale-block-time-select"]) && void 0 !== v ? v : "", e.abrupt("return", (0, i.Z)((0, i.Z)({}, M.data), {}, {
                                whaleDecisionCustom: (null == M || null === (m = M.headers) || void 0 === m || null === (h = m.get) || void 0 === h ? void 0 : h.call(m, "whale-decision-custom")) || "",
                                whaleInfo: {whaleDecisionCustom: G, whaleCutToken: J, whaleBlockTimeSelect: X}
                            }));
                        case 19:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })));
            return function (n, t, r) {
                return e.apply(this, arguments)
            }
        }();

        function Y(e) {
            return Q.apply(this, arguments)
        }

        function Q() {
            return Q = (0, r.Z)(u().mark((function e(n) {
                var t, r, a, o, l, c, s, d, f, v, m, h, g, w, _, x, k, E, C, S, T = arguments;
                return u().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (t = T.length > 1 && T[1] !== undefined ? T[1] : {}, r = T.length > 2 ? T[2] : undefined, a = T.length > 3 && T[3] !== undefined ? T[3] : {}, o = a.options, l = void 0 === o ? {} : o, c = a.psm, s = void 0 === c ? V.q8 : c, d = a.cluster, f = void 0 === d ? V.VX : d, v = a.origin, m = void 0 === v ? "" : v, h = a.errorTags, g = void 0 === h ? {} : h, w = T.length > 4 ? T[4] : undefined, e.prev = 4, !r || !(0, Z.p)()) {
                                e.next = 11;
                                break
                            }
                            return e.next = 8, X(n, t, r, {options: l, psm: s, cluster: f, origin: m});
                        case 8:
                        case 13:
                            return e.abrupt("return", e.sent);
                        case 11:
                            return e.next = 13, K(n, t, r, {
                                options: l,
                                psm: s,
                                cluster: f,
                                origin: m,
                                errorTags: g,
                                cancelCb: w
                            });
                        case 14:
                            e.next = 25;
                            break;
                        case 16:
                            if (e.prev = 16, e.t0 = e.catch(4), r && (0, Z.p)() && (null === (E = r.logger) || void 0 === E || null === (C = E.info) || void 0 === C || C.call(E, "Fetch Error: ", n, null === e.t0 || void 0 === e.t0 ? void 0 : e.t0.stack)), {
                                status: null === e.t0 || void 0 === e.t0 || null === (_ = e.t0.response) || void 0 === _ ? void 0 : _.status,
                                params: b()(t)
                            }, A.oe.event.error({
                                name: A.Mo.ResponseNetError,
                                report: {
                                    req: (0, i.Z)({}, t),
                                    status: null === e.t0 || void 0 === e.t0 || null === (x = e.t0.response) || void 0 === x ? void 0 : x.status,
                                    error: p()(k = "".concat(null === e.t0 || void 0 === e.t0 ? void 0 : e.t0.name, ":")).call(k, null === e.t0 || void 0 === e.t0 ? void 0 : e.t0.message),
                                    path: n
                                }
                            }), !y().isCancel(e.t0)) {
                                e.next = 23;
                                break
                            }
                            return e.abrupt("return", {status_code: -2, status_msg: "\u8bf7\u6c42\u53d6\u6d88"});
                        case 23:
                            return null !== e.t0 && void 0 !== e.t0 && e.t0.response ? S = e.t0.response.status : null !== e.t0 && void 0 !== e.t0 && e.t0.request && (S = L.ERROR_CODE.ERROR_NO_NETWORK), e.abrupt("return", L.genNetError(S));
                        case 25:
                        case"end":
                            return e.stop()
                    }
                }), e, null, [[4, 16]])
            }))), Q.apply(this, arguments)
        }

        function $(e) {
            return ee.apply(this, arguments)
        }

        function ee() {
            return ee = (0, r.Z)(u().mark((function e(n) {
                var t, r, a, l, c, d, f, v, p, m, h, g, b, w, y = arguments;
                return u().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (t = y.length > 1 && y[1] !== undefined ? y[1] : {}, r = y.length > 2 && y[2] !== undefined ? y[2] : {}, a = y.length > 3 && y[3] !== undefined ? y[3] : "", e.prev = 3, !s()(T.yd).call(T.yd, o()(n, "/"))) {
                                e.next = 7;
                                break
                            }
                            return e.next = 7, (0, T.Fm)();
                        case 7:
                            return e.next = 9, q((0, i.Z)({
                                url: n,
                                method: "POST",
                                baseURL: a,
                                data: t,
                                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
                            }, r));
                        case 9:
                            return c = e.sent, e.next = 12, (0, N.P)(q, c);
                        case 12:
                            return d = e.sent, f = null !== (l = d.data) && void 0 !== l ? l : {}, v = f.status_code, p = f.status_msg, m = f.log_pb, v && (0, R.e)(n, v) && (g = null !== (h = r.metrics) && void 0 !== h ? h : {}, b = (0, i.Z)({
                                status_code: v,
                                status_msg: p,
                                log_id: null == m ? void 0 : m.impr_id,
                                body: "Object" === (0, D.tQ)(t) ? k.stringify(t) : t
                            }, g), A.oe.event.error({
                                name: A.Mo.ResponseStatusCodeError,
                                report: (0, i.Z)((0, i.Z)({}, b), {}, {path: n})
                            })), e.abrupt("return", d.data);
                        case 18:
                            return e.prev = 18, e.t0 = e.catch(3), null !== e.t0 && void 0 !== e.t0 && e.t0.response ? w = e.t0.response.status : null !== e.t0 && void 0 !== e.t0 && e.t0.request && (w = L.ERROR_CODE.ERROR_NO_NETWORK), e.abrupt("return", L.genNetError(w));
                        case 22:
                        case"end":
                            return e.stop()
                    }
                }), e, null, [[3, 18]])
            }))), ee.apply(this, arguments)
        }
    }, 72018: function (e, n, t) {
        t.d(n, {
            RL: function () {
                return d
            }, Fm: function () {
                return v
            }, yL: function () {
                return p
            }, NR: function () {
                return h
            }, vg: function () {
                return g
            }
        });
        t(29529), t(32781);
        var r = t(19672), i = t.n(r), a = (t(94090), t(34346)), o = t.n(a),
            l = (t(82766), t(8e3), t(31674), t(65981), t(8590)), u = t(43088), c = (l.APP_ID, u);

        function s(e) {
            return (e || "").replace(/^https?\:/i, "")
        }

        function d(e, n) {
            var t = {statusCode: c.ERROR_CODE.ERROR_UNKNOWN};
            try {
                t = n && n(e)
            } catch (r) {
            }
            return t
        }

        function f() {
            var e = (arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {}).url_list;
            return i()(e) && 0 !== e.length ? s(e[0]) : ""
        }

        function v(e) {
            var n, t, r, i, a;
            return {
                uid: null == e ? void 0 : e.uid,
                secUid: null == e ? void 0 : e.sec_uid,
                nickname: (null == e ? void 0 : e.nickname) || "",
                remarkName: (null == e ? void 0 : e.remark_name) || "",
                avatarUri: f(null == e ? void 0 : e.avatar_thumb),
                followerCount: null == e ? void 0 : e.follower_count,
                totalFavorited: null !== (n = null == e ? void 0 : e.total_favorited_new) && void 0 !== n ? n : null == e ? void 0 : e.total_favorited,
                followStatus: null == e ? void 0 : e.follow_status,
                followerStatus: null == e ? void 0 : e.follower_status,
                enterpriseVerifyReason: null == e ? void 0 : e.enterprise_verify_reason,
                customVerify: null == e ? void 0 : e.custom_verify,
                roomData: null != e && e.room_data ? JSON.parse(e.room_data) : {},
                avatarThumb: {
                    height: (null == e || null === (t = e.avatar_thumb) || void 0 === t ? void 0 : t.height) || 0,
                    width: (null == e || null === (r = e.avatar_thumb) || void 0 === r ? void 0 : r.width) || 0,
                    uri: (null == e || null === (i = e.avatar_thumb) || void 0 === i ? void 0 : i.uri) || "",
                    urlList: (null == e || null === (a = e.avatar_thumb) || void 0 === a ? void 0 : a.url_list) || []
                },
                relationLabel: null == e ? void 0 : e.relation_label
            }
        }

        function p(e) {
            return e && i()(e) ? o()(e).call(e, (function (e) {
                var n = e.start, t = e.end, r = e.type, i = e.sec_uid, a = e.hashtag_id, o = void 0 === a ? "" : a,
                    l = e.hashtag_name, u = void 0 === l ? "" : l, c = e.aweme_id, s = void 0 === c ? "" : c,
                    d = e.user_id, f = void 0 === d ? "" : d, v = e.is_commerce;
                return {
                    start: n,
                    end: t,
                    type: r,
                    secUid: i,
                    hashtagId: o,
                    hashtagName: u,
                    awemeId: s,
                    userId: f,
                    isCommerce: void 0 !== v && v
                }
            })) : []
        }

        function m(e) {
            var n, t, r, i, a, o, l;
            return {
                cover: (null == e || null === (n = e.cover_url) || void 0 === n || null === (t = n.url_list) || void 0 === t ? void 0 : t[0]) || "",
                mixId: null == e ? void 0 : e.mix_id,
                mixName: null == e ? void 0 : e.mix_name,
                status: (null == e || null === (r = e.status) || void 0 === r ? void 0 : r.status) || -1,
                playVV: null == e || null === (i = e.statis) || void 0 === i ? void 0 : i.play_vv,
                collectVV: null == e || null === (a = e.statis) || void 0 === a ? void 0 : a.collect_vv,
                currentEpisode: null == e || null === (o = e.statis) || void 0 === o ? void 0 : o.current_episode,
                totalEpisode: null == e || null === (l = e.statis) || void 0 === l ? void 0 : l.updated_to_episode
            }
        }

        function h(e) {
            return o()(e).call(e, m)
        }

        function g(e) {
            var n, t, r, i, a, o, l;
            return {
                cover: (null == e || null === (n = e.cover_url) || void 0 === n || null === (t = n.url_list) || void 0 === t ? void 0 : t[0]) || "",
                seriesId: null == e ? void 0 : e.series_id,
                seriesName: null == e ? void 0 : e.series_name,
                status: (null == e || null === (r = e.status) || void 0 === r ? void 0 : r.status) || -1,
                playVV: null == e || null === (i = e.stats) || void 0 === i ? void 0 : i.play_vv,
                collectVV: null == e || null === (a = e.stats) || void 0 === a ? void 0 : a.collect_vv,
                currentEpisode: null == e || null === (o = e.stats) || void 0 === o ? void 0 : o.current_episode,
                totalEpisode: null == e || null === (l = e.stats) || void 0 === l ? void 0 : l.updated_to_episode
            }
        }
    }, 12345: function (e, n, t) {
        t.d(n, {
            f5: function () {
                return q
            }, TM: function () {
                return B
            }, oe: function () {
                return G
            }, A7: function () {
                return X
            }, R9: function () {
                return K
            }, tN: function () {
                return Y
            }, _h: function () {
                return Q
            }, Ob: function () {
                return ee
            }, ly: function () {
                return ne
            }, aB: function () {
                return te
            }, GZ: function () {
                return re
            }, B7: function () {
                return ie
            }
        });
        var r, i, a = t(29529), o = t(30673), l = t(64408), u = t(30906), c = t(5594), s = t.n(c), d = t(58144),
            f = t.n(d), v = t(7943), p = t.n(v), m = t(11227), h = t.n(m), g = t(21155), b = t.n(g), w = t(50750),
            y = t.n(w), _ = t(84639), x = t.n(_), k = t(94090), E = t.n(k), C = t(42780), L = t(67330), S = t(68595),
            T = t.n(S), N = t(36381), P = t(34452), I = t(13795), R = t(25337), A = t(89474), Z = t(94139),
            D = t(71116), V = t(72603), M = t(9191), O = t(5611), F = t(4028), z = t(18937), H = t(68540), j = t(31226),
            U = t(54029), W = (0, C.createBrowserClient)(), q = function () {
                var e, n;
                return A.s ? undefined : (null === (e = window) || void 0 === e ? void 0 : e.slardar) || (null === (n = window) || void 0 === n ? void 0 : n.Slardar)
            }, B = function (e, n) {
                var t = W, r = ["grayscale", "ppe_douyin_pc_frontend", "ppe_douyin_pc_neice", "upgrade"];
                return t("init", {
                    bid: "douyin_web",
                    env: e,
                    release: n,
                    plugins: {
                        fmp: !1,
                        tti: !1,
                        blankScreen: {screenshot: !1, threshold: 1.5},
                        pageview: {
                            routeMode: "history", extractPid: function () {
                                var e = ["/user", "/video", "/collection", "/hot", "/vsdetail", "/lvdetail", "/hashtag", "/htmlmap", "/light", "/music", "/note", "/musicplaylist", "/zhuanti", "/topic", "/mall/item", "/wallpaper", "/channel", "/shipin", "/asiangames"],
                                    n = f()(e).call(e, (function (e) {
                                        var n;
                                        return p()(n = location.pathname).call(n, e)
                                    }));
                                return null != n ? n : location.pathname
                            }
                        },
                        action: {types: ["click"]},
                        performance: {longtask: !0},
                        ajax: {ignoreUrls: ["https://mcs.zijieapi.com/list"]}
                    }
                }), t("start"), t("on", "beforeSend", (function (e) {
                    var n, t, i;
                    (e.common.user_id = null === (n = (0, D.Es)()) || void 0 === n ? void 0 : n.user_unique_id, h()(r).call(r, (null === (t = D.Le.getConfig(D.gI.Env)) || void 0 === t ? void 0 : t.envService) || "")) && (e.common.env = null === (i = D.Le.getConfig(D.gI.Env)) || void 0 === i ? void 0 : i.envService);
                    if ("performance" === e.ev_type) {
                        var a, o, l, u, c, s = e.payload.name;
                        if (h()(a = ["ttfb", "fp", "lcp", "mpfid", "fid"]).call(a, s)) if (null === U.Z || void 0 === U.Z || U.Z.sendLog("slardar_".concat(s), {
                            metric_duration: e.payload.value || 0,
                            slardar_pid: (0, V.yW)()
                        }), "lcp" === s) null === U.Z || void 0 === U.Z || U.Z.sendLog("custom_lcp", {
                            lcp_duration: (null === (o = window) || void 0 === o ? void 0 : o.LCPTime) || 0,
                            page_name: (0, V.yW)(),
                            element_type: null !== (l = null === (u = window) || void 0 === u || null === (c = u.LCPEle) || void 0 === c ? void 0 : c.tagName) && void 0 !== l ? l : ""
                        })
                    }
                    if ("blank_screen" === e.ev_type) {
                        var d = L.stringifyUrl({
                            url: e.common.url,
                            query: {ug_source: (0, M.Rs)("ug_source"), referer: document.referrer}
                        });
                        e.common.url = L.pick(d, (function (e, n) {
                            return Boolean(n)
                        }))
                    }
                    if ("performance_longtask" === e.ev_type) {
                        var f = e.payload.longtasks, v = void 0 === f ? [] : f;
                        null == v || b()(v).call(v, (function (e) {
                            var n, t;
                            U.Z.sendLog("slardar_longtask", {
                                duration: null == e ? void 0 : e.duration,
                                startTime: null == e ? void 0 : e.startTime,
                                page_name: (0, V.yW)(),
                                afterLcp: !(null === (n = window) || void 0 === n || !n.markLCP) && (null == e ? void 0 : e.startTime) > (null === (t = window) || void 0 === t ? void 0 : t.markLCP)
                            })
                        }))
                    }
                    return e
                })), window.xss && window.xss.Config && (window.xss.Config.bid = "douyin_web", window.xss.Config.region = "cn"), window.slardar = W, t
            }, G = q(), J = "", X = function () {
                var e, n = null === (e = window) || void 0 === e ? void 0 : e.ssrData, t = {};
                if (null != n && n.done) J = n.globalwid || ""; else {
                    var r = {};
                    try {
                        var i,
                            a = (null === (i = document.getElementById("RENDER_DATA")) || void 0 === i ? void 0 : i.innerText) || "{}";
                        r = JSON.parse(decodeURIComponent(a)) || {}, window.SSR_RENDER_DATA = r
                    } catch (d) {
                        window.SSR_RENDER_DATA = {}
                    }
                    for (var o = 0, l = y()(r); o < l.length; o++) {
                        var u, c = l[o], s = (null === (u = r) || void 0 === u ? void 0 : u[c]) || {};
                        null != s && s.tccConfig && P.Cf(null == s ? void 0 : s.tccConfig), null != s && s.globalwid && (J = null == s ? void 0 : s.globalwid), null != s && s.abTestData && x()(t, null == s ? void 0 : s.abTestData)
                    }
                }
                J && (0, I.QC)({
                    app_id: 353909,
                    channel: "cn",
                    enable_ab_test: !0,
                    ab_channel_domain: "https://www.douyin.com"
                })
            }, K = function (e, n) {
                var t = (0, z.R)({
                    videoFilterSelectTypeIn: (0, H.Ew)(null),
                    landscapeStrategy: null == e ? void 0 : e.landscapeStrategy,
                    recommendVideoSelectType: null == e ? void 0 : e.recommendVideoSelectType,
                    recRemoveHeader: null == e ? void 0 : e.recRemoveHeader
                });
                "recommend" !== (0, V.yW)() || window.awemeDetailPrefetch || window.tabFeedPrefetch || (0, F.NN)((0, u.Z)({
                    refreshIndex: 1,
                    count: 10,
                    tagId: "",
                    videoTypeSelect: t,
                    awemePcRecRawData: {},
                    preFetch: !0,
                    globalwid: J
                }, n))
            }, Y = function (e) {
                var n, t, r,
                    i = (null === (n = window) || void 0 === n ? void 0 : n.SSR_RENDER_DATA) || (null === (t = window) || void 0 === t ? void 0 : t.SSR_RENDER_DATA_DOC);
                if (!i) return null;
                var a = null;
                return b()(r = y()(i)).call(r, (function (n) {
                    var t = i[n];
                    t[e] && (a = t[e])
                })), a
            }, Q = function () {
                var e, n = {};
                try {
                    var t,
                        r = (null === (t = document.getElementById("RENDER_DATA")) || void 0 === t ? void 0 : t.innerText) || "{}";
                    n = JSON.parse(decodeURIComponent(r)) || {}
                } catch (i) {
                }
                return null === (e = n) || void 0 === e ? void 0 : e.isKeywordGroupThree
            }, $ = function () {
                var e = (0, l.Z)(s().mark((function e() {
                    var n, t, r, i, a, l, u, c;
                    return s().wrap((function (e) {
                        for (; ;) switch (e.prev = e.next) {
                            case 0:
                                if (t = null, null === (n = T().user) || void 0 === n || !n.getCsrInitialData) {
                                    e.next = 29;
                                    break
                                }
                                if (!(0, O.DT)()) {
                                    e.next = 14;
                                    break
                                }
                                return e.prev = 3, e.next = 6, T().user.getCsrInitialData();
                            case 6:
                                (r = e.sent) && 0 === (null == r ? void 0 : r.code) && null != r && r.data && (t = r.data), e.next = 14;
                                break;
                            case 11:
                                e.prev = 11, e.t0 = e.catch(3);
                            case 14:
                                if (t) {
                                    e.next = 28;
                                    break
                                }
                                return e.prev = 15, e.next = 18, (0, Z.F)();
                            case 18:
                                i = e.sent, a = i.statusCode, l = i.data, 0 === a && (t = l), e.next = 28;
                                break;
                            case 25:
                                e.prev = 25, e.t1 = e.catch(15);
                            case 28:
                                t && (t.abFormatData = (0, R.hA)(E()(u = []).call(u, (0, o.Z)(R.Kl), (0, o.Z)(j.R)), null === (c = t) || void 0 === c ? void 0 : c.allAbParams), t.allAbParams = undefined);
                            case 29:
                                return e.abrupt("return", t);
                            case 30:
                            case"end":
                                return e.stop()
                        }
                    }), e, null, [[3, 11], [15, 25]])
                })));
                return function () {
                    return e.apply(this, arguments)
                }
            }(), ee = (r = null, i = null, (0, l.Z)(s().mark((function e() {
                return s().wrap((function (e) {
                    for (; ;) switch (e.prev = e.next) {
                        case 0:
                            if (!r) {
                                e.next = 2;
                                break
                            }
                            return e.abrupt("return", r);
                        case 2:
                            if (!i) {
                                e.next = 8;
                                break
                            }
                            return e.next = 5, i;
                        case 5:
                            r = e.sent, e.next = 12;
                            break;
                        case 8:
                            return i = $(), e.next = 11, i;
                        case 11:
                            r = e.sent;
                        case 12:
                            return e.abrupt("return", r);
                        case 13:
                        case"end":
                            return e.stop()
                    }
                }), e)
            })))), ne = function () {
                var e = (0, V.yW)();
                "recommend" !== e && "friend" !== e && "follow" !== e || (D.Le.setConfig(D.gI.MarkFirstEnter, !0), D.Le.setConfig(D.gI.ReportFirstFeedCoverShow, !0))
            }, te = function () {
                var e;
                if (null === (e = Y("abTestData")) || void 0 === e ? void 0 : e.accessibleScript) {
                    var n = document.createElement("script");
                    n.type = "text/javascript", n.src = "https://sf1-cdn-tos.douyinstatic.com/obj/accessibility-task-platform/entrance/a11y_web_init.js", n.id = "a11y-sdk-script", n.crossOrigin = "anonymous", n.nonce = "argus-csp-token", document.body.appendChild(n)
                }
            }, re = function () {
                var e, n,
                    t = (null === (e = Y("backendAbTest")) || void 0 === e ? void 0 : e.swcache) || (null === (n = Y("abFormatData")) || void 0 === n ? void 0 : n.swcache),
                    r = "serviceWorker" in navigator, i = "storage" in navigator && "estimate" in navigator.storage;
                !t && r && window.addEventListener("load", (function () {
                    navigator.serviceWorker.getRegistration().then((function (e) {
                        var n;
                        "https://www.douyin.com/sw-cache.js" === (null == e || null === (n = e.active) || void 0 === n ? void 0 : n.scriptURL) && e.unregister()
                    }))
                })), t && r && i && window.addEventListener("load", (function () {
                    navigator.storage.estimate().then((function (e) {
                        e.quota && e.quota >= 838860800 && navigator.serviceWorker.register("/sw-cache.js").then((function () {
                        })).catch((function () {
                        }))
                    }))
                }))
            }, ie = function () {
                try {
                    ("undefined" == typeof window ? "undefined" : (0, a.Z)(window)) === undefined || window.TextDecoder && window.TextEncoder || (window.TextDecoder = N.TextDecoder, window.TextEncoder = N.TextEncoder)
                } catch (e) {
                }
            }
    }
}, function (e) {
    e.O(0, [6629], (function () {
        [9066, 5978, 7104, 5012, 5170, 6201, 5538, 1064, 2190, 6065].map(e.E)
    }), 5);
    e.O(0, [5997, 5384, 1132, 5368, 1090, 2696, 1293, 3945, 1091, 2178, 2367, 80], (function () {
        return n = 12875, e(e.s = n);
        var n
    }));
    e.O()
}]);

