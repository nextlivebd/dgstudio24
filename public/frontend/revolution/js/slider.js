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
/*  Slider Stack Layout Fix
/*  Groups absolute text layers into a single flex column layout dynamically.
/*  This prevents vertical overlaps when text wraps, while fully preserving
/*  the default entry/exit animations.
/*------------------------------------------------------------------------------*/

jQuery(function($) {

    function groupSliderTextLayers() {
        $('rs-slide').each(function() {
            var $slide = $(this);
            
            // Check if group wrapper already exists for this slide
            if ($slide.find('.slider-text-group').length) {
                return;
            }

            // Find the wrappers of all elements
            var $subtitle = $slide.find('.slider-subtitle').closest('rs-layer-wrap, rs-parallax-wrap');
            var $title1 = $slide.find('.slider-title-1').closest('rs-layer-wrap, rs-parallax-wrap');
            var $title2 = $slide.find('.slider-title-2').closest('rs-layer-wrap, rs-parallax-wrap');
            var $desc = $slide.find('.slider-desc').closest('rs-layer-wrap, rs-parallax-wrap');
            
            // Buttons
            var $btn1 = $slide.find('.contactus-btn3').closest('rs-layer-wrap, rs-parallax-wrap');
            var $btn2 = $slide.find('.details-btn').closest('rs-layer-wrap, rs-parallax-wrap');

            // We need at least one text element to build a group
            if ($title1.length || $title2.length) {
                var $group = $('<div class="slider-text-group"></div>');
                
                // Determine insertion point
                var $first = $subtitle.length ? $subtitle : ($title1.length ? $title1 : $title2);
                $first.before($group);

                // Safely move the elements into the group to make them stack in vertical relative flow
                if ($subtitle.length) $group.append($subtitle);
                if ($title1.length) $group.append($title1);
                if ($title2.length) $group.append($title2);
                if ($desc.length) $group.append($desc);

                // Group buttons horizontally inside a custom row
                if ($btn1.length || $btn2.length) {
                    var $btnRow = $('<div class="slider-btns-row"></div>');
                    if ($btn2.length) $btnRow.append($btn2);
                    if ($btn1.length) $btnRow.append($btn1);
                    $group.append($btnRow);
                }
            }
        });
    }

    // Run as early as possible on load
    $(window).on('load', function() {
        groupSliderTextLayers();
        // Fallback delay to ensure elements are fully processed
        setTimeout(groupSliderTextLayers, 600);
    });

    // Also run whenever slide is initialized
    if (typeof revapi1 !== 'undefined' && revapi1) {
        try {
            revapi1.bind('revolution.slide.onloaded revolution.slide.onchange', function() {
                groupSliderTextLayers();
            });
        } catch(e) {}
    }
});