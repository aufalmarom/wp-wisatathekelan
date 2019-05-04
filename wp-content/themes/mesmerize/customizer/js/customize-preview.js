function liveUpdate(setting, callback) {
    var cb = function (value) {
        value.bind(callback);
    };
    var _setting = setting;
    wp.customize(_setting, cb);

    if (parent.CP_Customizer) {
        var _prefixedSetting = parent.CP_Customizer.slugPrefix() + "_" + setting;
        wp.customize(_prefixedSetting, cb);
    }
}

(function ($) {
    wp.customize('full_height_header', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.header-homepage').css('min-height', "100vh");
            } else {
                $('.header-homepage').css('min-height', "");
            }
        });
    });

    wp.customize('header_show_overlay', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.header-homepage').addClass('color-overlay');
            } else {
                $('.header-homepage').removeClass('color-overlay');
            }
        });
    });
    wp.customize('header_sticked_background', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.homepage.navigation-bar.fixto-fixed').css('background-color', newval);
            }
            var transparent = JSON.parse(wp.customize('header_nav_transparent').get());
            if (!transparent) {
                $('.homepage.navigation-bar').css('background-color', newval);
            }
        });
    });
    wp.customize('header_nav_transparent', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.homepage.navigation-bar').removeClass('coloured-nav');
            } else {
                $('.homepage.navigation-bar').css('background-color', '');
                $('.homepage.navigation-bar').addClass('coloured-nav');
            }
        });
    });
    wp.customize('inner_header_sticked_background', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.navigation-bar:not(.homepage).fixto-fixed').css('background-color', newval);
            }

            var transparent = JSON.parse(wp.customize('inner_header_nav_transparent').get());
            if (!transparent) {
                $('.navigation-bar:not(.homepage)').css('background-color', newval);
            }
        });
    });
    wp.customize('inner_header_nav_transparent', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.navigation-bar:not(.homepage)').removeClass('coloured-nav');
            } else {
                $('.navigation-bar:not(.homepage)').addClass('coloured-nav');
            }
        });
    });
    wp.customize('inner_header_show_overlay', function (value) {
        value.bind(function (newval) {
            if (newval) {
                $('.header').addClass('color-overlay');
            } else {
                $('.header').removeClass('color-overlay');
            }
        });
    });

    wp.customize('header_gradient', function (value) {
        value.bind(function (newval, oldval) {
            $('.header-homepage').removeClass(oldval);
            $('.header-homepage').addClass(newval);
        });
    });

    wp.customize('inner_header_gradient', function (value) {
        value.bind(function (newval, oldval) {
            $('.header').removeClass(oldval);
            $('.header').addClass(newval);
        });
    });


    wp.customize('header_text_box_text_vertical_align', function (value) {
        value.bind(function (newVal, oldVal) {
            $('.header-hero-content-v-align').removeClass(oldVal).addClass(newVal);
        });
    });

    wp.customize('header_media_box_vertical_align', function (value) {
        value.bind(function (newVal, oldVal) {
            $('.header-hero-media-v-align').removeClass(oldVal).addClass(newVal);
        });
    });

    wp.customize('header_text_box_text_align', function (value) {
        value.bind(function (newVal, oldVal) {
            $('.mesmerize-front-page  .header-content .align-holder').removeClass(oldVal).addClass(newVal);
        });
    });

    function updateMobileBgImagePosition() {
        var position = wp.customize('header_bg_position_mobile').get(),
            positionParts = position.split(' '),
            offset = wp.customize('header_bg_position_mobile_offset').get(),
            styleHolder = jQuery('[data-name="custom-mobile-image-position"]');

        if (styleHolder.length == 0) {
            styleHolder = jQuery('<style data-name="custom-mobile-image-position"></style>');
            styleHolder.appendTo('head');
        }


        position = position + " " + offset + "px";

        styleHolder.text("" +
            "@media screen and (max-width: 767px) {\n" +
            "   .header-homepage {\n" +
            "       background-position: " + position + ";\n" +
            "   }\n" +
            "}\n");
    }

    wp.customize('header_bg_position_mobile', function (value) {
        value.bind(updateMobileBgImagePosition);
    });

    wp.customize('header_bg_position_mobile_offset', function (value) {
        value.bind(updateMobileBgImagePosition);
    })

    // media frame //
    wp.customize('header_content_frame_offset_left', function (value) {
        value.bind(function (left) {
            var top = wp.customize('header_content_frame_offset_top').get();
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css({
                'transform': 'translate(' + left + '%,' + top + '%)'
            });
        });
    });


    wp.customize('header_content_frame_offset_top', function (value) {
        value.bind(function (top) {
            var left = wp.customize('header_content_frame_offset_left').get();
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css({
                'transform': 'translate(' + left + '%,' + top + '%)'
            });
        });
    });

    wp.customize('header_content_frame_width', function (value) {
        value.bind(function (width) {
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css({
                'width': width + '%'
            });
        });
    });


    wp.customize('header_content_frame_height', function (value) {
        value.bind(function (height) {
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css({
                'height': height + '%'
            });
        });
    });

    wp.customize('header_content_frame_thickness', function (value) {
        value.bind(function (thickness) {
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css({
                'border-width': thickness + 'px'
            });
        });
    });

    wp.customize('header_content_frame_show_over_image', function (value) {
        value.bind(function (value) {
            var zIndex = value ? "1" : "-1";
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css('z-index', zIndex);
        });
    });

    wp.customize('header_content_frame_shadow', function (value) {
        value.bind(function (value) {
            var shadow = "shadow-medium";
            var frame = $('.mesmerize-front-page  .header-description .overlay-box-offset');
            if (value) {
                frame.addClass(shadow);
            } else {
                frame.removeClass(shadow);
            }
        });
    });


    wp.customize('header_content_frame_color', function (value) {
        value.bind(function (color) {
            var type = wp.customize('header_content_frame_type').get();
            var property = type + "-color";
            $('.mesmerize-front-page  .header-description .overlay-box-offset').css(property, color);
        });
    });

    function updateTopBarInfo(area, index) {
        return function (value) {
            value.bind(function (html) {
               var id = 'header_top_bar_'+ area +'_info_field_' +  index + '_icon';
               $("[data-focus-control="+id+"]").find('span').html(html);
            });
        }
    }

    var areas = ['area-left', 'area-right'];
    for (var i = 0; i < areas.length; i++) {
        for (var j = 0; j < 3; j++) {
            wp.customize('header_top_bar_'+ areas[i] +'_info_field_' +  j + '_text', updateTopBarInfo(areas[i], j));
        }
    }
   

})(jQuery);

(function ($) {
    function getGradientValue(setting) {
        var getValue = parent.CP_Customizer ? parent.CP_Customizer.utils.getValue : parent.Mesmerize.Utils.getValue;
        var control = parent.wp.customize.control(setting);
        var gradient = getValue(control);
        var colors = gradient.colors;
        var angle = gradient.angle;
        angle = parseFloat(angle);
        return parent.Mesmerize.Utils.getGradientString(colors, angle);
    }

    function recalculateHeaderOverlayGradient() {
        $('.header-homepage .background-overlay').css("background-image", getGradientValue('header_overlay_gradient_colors'));
    }

    function recalculateInnerHeaderOverlayGradient() {
        $('.header .background-overlay').css("background-image", getGradientValue('inner_header_overlay_gradient_colors'));
    }

    liveUpdate('header_overlay_gradient_colors', recalculateHeaderOverlayGradient);
    liveUpdate('inner_header_overlay_gradient_colors', recalculateInnerHeaderOverlayGradient);
})(jQuery);
