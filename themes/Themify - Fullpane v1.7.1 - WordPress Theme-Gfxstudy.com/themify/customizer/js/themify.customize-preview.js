/***************************************************************************
 *
 * 	----------------------------------------------------------------------
 * 						DO NOT EDIT THIS FILE
 *	----------------------------------------------------------------------
 *                      Theme Customizer Scripts
 *  				    Copyright (C) Themify
 *
 *	----------------------------------------------------------------------
 *
 ***************************************************************************/

(function ($) {

    'use strict';
    var styles = [];
    // Google Font Loader
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);

    // Convert hexadecimal color to RGB. Receives string and returns object
    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }



    function getColor(values) {
        if (!values.color || 'undefined' === typeof values.color || ('undefined' !== typeof values.transparent && 'transparent' === values.transparent)) {
            return false;
        }
        else {
            var alpha = values.opacity ? values.opacity : 1;
            if (alpha < 1) {
                var rgb = hexToRgb(values.color);
            }
            return alpha < 1 ? 'rgba( ' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + alpha + ' )' : '#' + (values.color);
        }

    }


    // Set dimension by side, like padding or margin.
    function getDimension(side) {
        // Check if auto was set
        if (side.auto && 'auto' === side.auto) {
            return side.auto;
        } else if (side.width) {
            // Dimension Width
            return  side.width + (side.unit && 'px' !== side.unit ? side.unit : 'px');
        }
        return false;
    }

    // Get border properties.
    function getBorder(borderSide) {
        var $color = getColor(borderSide);
        return  borderSide.style && 'none' !== borderSide.style && borderSide.width
                ?
                borderSide.width + 'px ' + borderSide.style + ($color ? ' ' + $color : '') :
                false;
    }

    // Setup general variables
    var api = wp.customize,
            $body = $('body');

    api('header_textcolor', function (value) {
        value.bind(function (newval) {
            $('#header a, .site-title a, .site-description').css('color', newval);
        });
    });

    api('link_color', function (value) {
        value.bind(function (newval) {
            $('a').css('color', newval);
        });
    });

    api('text_color', function (value) {
        value.bind(function (newval) {
            $body.css('color', newval);
        });
    });

    // If the themifyCustomizer object is not defined, exit
    if (!themifyCustomizer) {
        return;
    }

    function getStyleId($selector) {
        return $.trim($selector).replace(/[^a-zA-Z0-9]/ig, '');
    }

    function setStyles($key, $selector, $styles) {
        var $inline = '';
        for (var st in $styles) {
            if ($styles[st]) {
                $inline += st + ':' + $styles[st] + ';';
            }
        }

        if ($inline.length > 0) {
            $('head').append('<style id="' + $key + '">' + $selector + '{' + $inline + '}</style>');
        }

    }
    $(document).on('themify.customizer', function (e, $id, $selector) {
        var $key = 'themify-customizer-css-' + $id;
        if ($('#' + $key).length > 0) {
            $('#' + $key).remove();
        }
        setStyles($key, $selector, styles[$id]);
        if ($id === 'sitelogo' && typeof styles[$id]['color'] !== 'undefined') {
            var $color = styles[$id]['color'];
            $id = $id + 'a';
            if (!styles[$id]) {
                styles[$id] = [];
            }
            styles[$id]['color'] = $color;
            $.event.trigger("themify.customizer", [$id, '#site-logo a']);
        }

    });

    // Setup font family, styles, size and eveything
    function setFont($id, font) {
        var $sides = ['font-family', 'font-weight', 'font-style', 'text-transform', 'text-decoration', 'text-align', 'line-height'];
        if (!styles[$id]) {
            styles[$id] = [];
        }
        _.each($sides, function (side) {
            styles[$id][side] = false;
        });

        if (font) {

            if (font.family) {
                if (font.family.fonttype && 'google' === font.family.fonttype) {
                    WebFont.load({
                        google: {
                            families: [font.family.name]
                        }
                    });
                }
                styles[$id]['font-family'] = font.family.name;
            }

            if (!font.nostyle) {
                if (font.bold) {
                    styles[$id]['font-weight'] = 'bold';
                }

                if (font.italic) {
                    styles[$id]['font-style'] = 'italic';
                }
                else if (font.normal) {
                    styles[$id]['font-style'] = 'normal';
                }

                if (font.linethrough) {
                    styles[$id]['text-decoration'] = 'line-through';
                }
                else if (font.underline) {
                    styles[$id]['text-decoration'] = 'underline';


                } else {
                    styles[$id]['font-weight'] = styles[$id]['font-style'] = 'normal';
                    styles[$id]['text-decoration'] = 'none';
                }

                if (!font.normal) {
                    if (font.bold) {
                        styles[$id]['font-weight'] = 'bold';
                    }

                    if (font.italic) {
                        styles[$id]['font-style'] = 'italic';
                    }

                } else {
                    styles[$id]['font-style'] = 'normal';
                }

                if (font.texttransform) {
                    styles[$id]['text-transform'] = 'notexttransform' !== font.texttransform ? font.texttransform : 'none';
                }

                if (font.align) {
                    styles[$id]['text-align'] = 'noalign' !== font.align ? font.align : false;
                }
                if (font.sizenum > 0) {
                    styles[$id]['font-size'] = font.sizenum + (font.sizeunit ? font.sizeunit : 'px');
                }
                if (font.linenum > 0) {
                    styles[$id]['line-height'] = font.sizenum + (font.lineunit ? font.lineunit : 'px');
                }

            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    // Font Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.fontControls) {
        $.each(themifyCustomizer.fontControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (fontData) {
                    var values = $.parseJSON(fontData),
                            $id = getStyleId(selector);
                    setFont($id, values);
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Font Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Logo Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.logoControls) {
        $.each(themifyCustomizer.logoControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (imageData) {
                    var values = $.parseJSON(imageData),
                            $selector = $(selector),
                            $id = getStyleId(selector);
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    setFont($id, values);
                    if (values.mode && 'none' === values.mode) {
                        styles[$id]['display'] = 'none';
                    } else {
                        styles[$id]['display'] = 'block';

                        var $img = $('img', $selector);
                        if ($img.length > 0) {
                            $img.remove();
                        }
                        if (values.mode && 'image' === values.mode) {
                            $selector.find('span').hide();
                            if ('undefined' !== typeof values.src && values.src) {
                                if ($('a', $selector).length > 0) {
                                    $selector.find('a').prepend('<img src="' + values.src + '" />');
                                    if (values.link) {
                                        $selector.find('a').attr('href', values.link);
                                    }
                                } else {
                                    $selector.prepend('<img src="' + values.src + '" />');
                                }
                                var imgwidth = values.imgwidth ? values.imgwidth : '',
                                        imgheight = values.imgheight ? values.imgheight : '';
                                $selector.find('img').css({
                                    'width': imgwidth,
                                    'height': imgheight
                                });
                            }
                        } else {
                            $selector.find('span').show();
                            if ($('a', $selector).length > 0) {
                                if (values.link) {
                                    $selector.find('a').attr('href', values.link);
                                }
                                styles[$id]['color'] = getColor(values);
                            }

                            $.post(
                                    themifyCustomizer.ajaxurl,
                                    {
                                        'action': 'themify_customizer_get_option',
                                        'option': 'blogname',
                                        'nonce': themifyCustomizer.nonce
                                    },
                            function (data) {
                                if ('notfound' !== data) {
                                    $('#site-logo, #footer-logo').find('span').text(data);
                                }
                            }
                            );
                        }
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);

                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Logo Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Tagline Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.taglineControls) {
        $.each(themifyCustomizer.taglineControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (imageData) {
                    var values = $.parseJSON(imageData),
                            $selector = $(selector),
                            $id = getStyleId(selector);
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    setFont($id, values);
                    if (values.mode && 'none' === values.mode) {

                        styles[$id]['display'] = 'none';

                    } else if ('none' !== values.mode) {

                        styles[$id]['display'] = 'block';
                        var $img = $('img', $selector);
                        if ($img.length > 0) {
                            $img.remove();
                        }
                        if (values.mode && 'image' === values.mode) {
                            $selector.find('span').hide();
                            if ('undefined' !== typeof values.src && values.src) {
                                $selector.prepend('<img src="' + values.src + '" />');
                                var imgwidth = values.imgwidth ? values.imgwidth : '',
                                        imgheight = values.imgheight ? values.imgheight : '';
                                $selector.find('img').css({
                                    'width': imgwidth,
                                    'height': imgheight
                                });
                            }
                        } else {
                            $selector.find('span').show();
                            styles[$id]['color'] = getColor(values);
                            ;
                            $.post(
                                    themifyCustomizer.ajaxurl,
                                    {
                                        'action': 'themify_customizer_get_option',
                                        'option': 'blogdescription',
                                        'nonce': themifyCustomizer.nonce
                                    },
                            function (data) {
                                if ('notfound' != data) {
                                    $selector.find('span').text(data);
                                }
                            }
                            );
                        }
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Tagline Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Background Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.backgroundControls) {
        $.each(themifyCustomizer.backgroundControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (backgroundData) {
                    var values = $.parseJSON(backgroundData),
                            $id = getStyleId(selector),
                            $sides = ['image', 'color', 'repeat', 'size', 'position'];
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    _.each($sides, function (side) {
                        styles[$id]['background-' + side] = false;
                    });

                    if (values && 'noimage' !== values.noimage && 'undefined' !== typeof values.src) {
                        styles[$id]['background-image'] = 'url(' + values.src + ')';
                    }
                    if ('undefined' !== typeof values.style && values.style) {

                        if ('fullcover' === values.style) {
                            styles[$id]['background-size'] = 'cover';
                            styles[$id]['background-repeat'] = 'no-repeat';
                        } else {
                            styles[$id]['background-size'] = 'auto';
                            styles[$id]['background-repeat'] = values.style;
                        }
                    }
                    if ('undefined' !== typeof values.position && values.position) {
                        styles[$id]['background-position'] = values.position;
                    }
                    styles[$id]['background-color'] = getColor(values);
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Background Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Color Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.colorControls) {
        $.each(themifyCustomizer.colorControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (colorData) {
                    var values = $.parseJSON(colorData),
                            $id = getStyleId(selector);
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    styles[$id]['color'] = getColor(values);
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Color Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Image Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.imageControls) {
        $.each(themifyCustomizer.imageControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (imageData) {
                    var values = $.parseJSON(imageData),
                            $selector = $(selector);

                    if (values) {
                        var $img = $('img', $selector);
                        if ($img.length > 0) {
                            $img.remove();
                        }
                        if (values.src) {
                            $($selector).prepend('<img src="' + values.src + '" />');
                        }
                    }
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Image Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Border Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.borderControls) {
        $.each(themifyCustomizer.borderControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (borderData) {
                    var values = $.parseJSON(borderData),
                            $id = getStyleId(selector),
                            $sides = ['border', 'border-color', 'border-top', 'border-left', 'border-bottom', 'border-right', 'border-width', 'border-style'];
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    _.each($sides, function (side) {
                        styles[$id][side] = false;
                    });

                    if (values && 'disabled' !== values.disabled) {
                        if ('same' !== values.same) {
                            _.each(['top', 'left', 'bottom', 'right'], function (side) {
                                if (values[side]) {
                                    styles[$id]['border-' + side] = getBorder(values[side]);
                                }
                            });
                        } else {
                            styles[$id]['border'] = getBorder(values);
                        }
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Border Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Margin Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.marginControls) {
        $.each(themifyCustomizer.marginControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (marginData) {
                    var values = $.parseJSON(marginData),
                            $id = getStyleId(selector),
                            $sides = ['margin', 'margin-top', 'margin-left', 'margin-bottom', 'margin-right'];
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    _.each($sides, function (side) {
                        styles[$id][side] = false;
                    });
                    if (values && 'disabled' !== values.disabled) {
                        if ('same' !== values.same) {
                            _.each(['top', 'left', 'bottom', 'right'], function (side) {
                                if (values[side]) {
                                    styles[$id]['margin-' + side] = getDimension(values[side]);
                                }
                            });
                        } else {
                            styles[$id]['margin'] = getDimension(values);
                        }
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Margin Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Padding Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.paddingControls) {
        $.each(themifyCustomizer.paddingControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (paddingData) {
                    var values = $.parseJSON(paddingData),
                            $id = getStyleId(selector),
                            $sides = ['padding', 'padding-top', 'padding-left', 'padding-bottom', 'padding-right'];
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    _.each($sides, function (side) {
                        styles[$id][side] = false;
                    });
                    if (values && 'disabled' !== values.disabled) {
                        if ('same' !== values.same) {
                            _.each(['top', 'left', 'bottom', 'right'], function (side) {
                                if (values[side]) {
                                    styles[$id]['padding-' + side] = getDimension(values[side]);
                                }
                            });
                        } else {
                            styles[$id]['padding'] = getDimension(values);
                        }
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Padding Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Width Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.widthControls) {
        $.each(themifyCustomizer.widthControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (widthData) {
                    var values = $.parseJSON(widthData),
                            $id = getStyleId(selector);
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    styles[$id]['height'] = getDimension(values);
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Width Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Height Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.heightControls) {
        $.each(themifyCustomizer.heightControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (heightData) {
                    var values = $.parseJSON(heightData),
                            $id = getStyleId(selector);
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    styles[$id]['height'] = getDimension(values);
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Height Control End
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    // Position Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.positionControls) {
        $.each(themifyCustomizer.positionControls, function (index, selector) {
            api(index, function (value) {
                value.bind(function (positionData) {
                    var values = $.parseJSON(positionData),
                            $id = getStyleId(selector),
                            $sides = ['position', 'top', 'left', 'bottom', 'right'];
                    if (!styles[$id]) {
                        styles[$id] = [];
                    }
                    _.each($sides, function (side) {
                        styles[$id][side] = false;
                    });
                    if (values && values.position) {
                        styles[$id]['position'] = values.position;
                        _.each(['top', 'right', 'bottom', 'left'], function (side) {
                            if (values[side]) {
                                styles[$id][side] = getDimension(values[side]);
                            }
                        });
                    }
                    $.event.trigger("themify.customizer", [$id, selector]);
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Position Control End
    ////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////
    // Custom CSS Control Start
    ////////////////////////////////////////////////////////////////////////////
    if (themifyCustomizer.customcssControls) {
        var initialLoad = [];
        $.each(themifyCustomizer.customcssControls, function (index, selector) {
            initialLoad[index] = true;
            api(index, function (value) {
                value.bind(function (customcssData) {
                    var stylesheet = 'themify-customize-customcss',
                            $stylesheet = $('#' + stylesheet);
                    if ($stylesheet.length > 0) {
                        $stylesheet.remove();
                    }
                    if (customcssData) {
                        customcssData = customcssData
                                .replace(/[\n]/g, '')
                                .replace(/[\r]/g, '')
                                .replace(/[\t]/g, '')
                        $('head').append('<style type="text/css" id="' + stylesheet + '">' + customcssData + '</style>');
                    }
                });
            });
        });
    }
    ////////////////////////////////////////////////////////////////////////////
    // Custom CSS Control End
    ////////////////////////////////////////////////////////////////////////////

})(jQuery);