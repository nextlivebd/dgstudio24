/*------------------------------------------------------------------------------*/
/*  Home_Page Slider
/*------------------------------------------------------------------------------*/

var revapi1,
    tpj;
jQuery(function() {
    tpj = jQuery;
    if (tpj("#rev_slider_1_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1_1");
    } else {
        revapi1 = tpj("#rev_slider_1_1").show().revolution({
            sliderLayout: "fullwidth",
            visibilityLevels: "1240,1024,778,480",
            gridwidth: "1240,1024,778,480",
            gridheight: "850,701,450,350",
            minHeight: "",
            spinner: "spinner0",
            editorheight: "705,768,450,350",
            responsiveLevels: "1240,1240,778,480",
            disableProgressBar: "on",
            navigation: {
                mouseScrollNavigation: false,
                onHoverStop: false,
                touch: {
                    touchenabled: true
                },
                arrows: {
                    enable: true,
                    style: "custom",
                    hide_onmobile: true,
                    hide_under: 768,
                    hide_onleave: true,
                    left: {

                    },
                    right: {

                    }
                }
            },
            fallbacks: {
                allowHTML5AutoPlayOnAndroid: true
            },
        });
    }

});




var revapi3,
    tpj;
jQuery(function() {
    tpj = jQuery;
    if (tpj("#rev_slider_1_2").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1_2");
    } else {
        revapi3 = tpj("#rev_slider_1_2").show().revolution({
            sliderLayout: "fullwidth",
            visibilityLevels: "1240,1024,778,480",
            gridwidth: "1240,1024,778,480",
            gridheight: "655,570,450,350",
            minHeight: "",
            spinner: "spinner0",
            editorheight: "705,768,450,350",
            responsiveLevels: "1240,1240,778,480",
            disableProgressBar: "on",
            navigation: {
                mouseScrollNavigation: false,
                onHoverStop: false,
                touch: {
                    touchenabled: true
                },
                arrows: {
                    enable: true,
                    style: "custom",
                    hide_onmobile: true,
                    hide_under: 768,
                    hide_onleave: true,
                    left: {

                    },
                    right: {

                    }
                }
            },
            fallbacks: {
                allowHTML5AutoPlayOnAndroid: true
            },
        });
    }

});


/*------------------------------------------------------------------------------*/
/*  Slider Text Layer Width Fix
/*  Prevents text from overlapping the front image on the right side.
/*  Revolution Slider applies inline styles via JavaScript, so we must
/*  also use JavaScript (after RS renders) to enforce max-widths.
/*------------------------------------------------------------------------------*/

jQuery(function($) {

    /**
     * Get max-width limit based on screen size, matching the gridwidth of the slider.
     * The slider grid is 1240px wide; text should take ~55% of the left side.
     */
    function getTextLayerMaxWidth() {
        var w = $(window).width();
        if (w >= 1200) return 650;
        if (w >= 992)  return 500;
        if (w >= 768)  return 400;
        return null; // Mobile: no restriction needed, RS handles visibility
    }

    /**
     * Apply max-width to all slider text layers after RS renders them.
     */
    function fixSliderTextLayers() {
        var maxW = getTextLayerMaxWidth();
        if (!maxW) return;

        var selectors = [
            '.slider-subtitle',
            '.slider-title-1',
            '.slider-title-2',
            '.slider-desc'
        ];

        $.each(selectors, function(i, sel) {
            $(sel).each(function() {
                var $el = $(this);
                // Apply max-width and allow wrapping
                $el.css({
                    'max-width': maxW + 'px',
                    'white-space': 'normal',
                    'word-break': 'break-word',
                    'width': 'auto'
                });
                // Also constrain the parent rs-parallax-wrap (RS positions this absolutely)
                var $wrap = $el.closest('rs-parallax-wrap');
                if ($wrap.length) {
                    $wrap.css({
                        'max-width': maxW + 'px'
                    });
                }
            });
        });
    }

    // Run after window load (RS renders after page load)
    $(window).on('load', function() {
        // Short delay to let RS finish its initial render
        setTimeout(fixSliderTextLayers, 800);
    });

    // Re-apply on window resize
    var resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(fixSliderTextLayers, 300);
    });

    // Also hook into RS slide change events so fix persists between slides
    $(window).on('load', function() {
        setTimeout(function() {
            if (typeof revapi1 !== 'undefined' && revapi1) {
                try {
                    revapi1.bind('revolution.slide.onloaded revolution.slide.onchange revolution.slide.onafter', function() {
                        setTimeout(fixSliderTextLayers, 200);
                    });
                } catch(e) {}
            }
        }, 1200);
    });

});