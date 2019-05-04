/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	var BeClients = __webpack_require__(1),
	    BeImageSlider = __webpack_require__(5),
	    BeTestimonils = __webpack_require__(7),
	    BeContentSlider = __webpack_require__(9),
	    BeIconCard = __webpack_require__(11),
	    BeProcess = __webpack_require__(12),
	    BeServices = __webpack_require__(14),
	    BeSkills = __webpack_require__(16),
	    BeSkill = __webpack_require__(17),
	    BeSpecialHeading1 = __webpack_require__(18),
	    BeSpecialHeading2 = __webpack_require__(19),
	    BeSpecialHeading3 = __webpack_require__(20),
	    BeSpecialHeading4 = __webpack_require__(21),
	    BeSpecialHeading5 = __webpack_require__(22),
	    BeSpecialHeading6 = __webpack_require__(23),
	    BeSpecialSubTitle = __webpack_require__(24),
	    BeMenuCard = __webpack_require__(25),
	    BeTabs = __webpack_require__(26),
	    BeAccordion = __webpack_require__(30),
	    BeAnimateIconsStyle1 = __webpack_require__(32),
	    BeAnimateIconsStyle2 = __webpack_require__(34),
	    BeTeam = __webpack_require__(36),
	    BeSVGIcon = __webpack_require__(37),
	    BeAnimatedLink = __webpack_require__(38);
	tatsuConfig.clients = BeClients;
	tatsuConfig.flex_slider = BeImageSlider;
	tatsuConfig.testimonials = BeTestimonils;
	tatsuConfig.content_slides = BeContentSlider;
	tatsuConfig.icon_card = BeIconCard;
	tatsuConfig.process_style1 = BeProcess;
	tatsuConfig.services = BeServices;
	tatsuConfig.skills = BeSkills;
	tatsuConfig.special_heading = BeSpecialHeading1;
	tatsuConfig.special_heading2 = BeSpecialHeading2;
	tatsuConfig.special_heading3 = BeSpecialHeading3;
	tatsuConfig.special_heading4 = BeSpecialHeading4;
	tatsuConfig.special_heading5 = BeSpecialHeading5;
	tatsuConfig.be_special_heading6 = BeSpecialHeading6;
	tatsuConfig.special_sub_title = BeSpecialSubTitle;
	tatsuConfig.skill = BeSkill;
	tatsuConfig.menu_card = BeMenuCard;
	tatsuConfig.tabs = BeTabs;
	tatsuConfig.accordion = BeAccordion;
	tatsuConfig.animate_icons_style1 = BeAnimateIconsStyle1;
	tatsuConfig.animate_icons_style2 = BeAnimateIconsStyle2;
	tatsuConfig.team = BeTeam;
	tatsuConfig.oshine_svg_icon = BeSVGIcon;
	tatsuConfig.oshine_animated_link = BeAnimatedLink;

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    findDOMNode = ReactDOM.findDOMNode,
	    parseValue = __webpack_require__(3),
	    Client = __webpack_require__(4);
	var Clients = React.createClass({
		displayName: 'Clients',


		getInitialState: function () {

			return {
				trigger: false
			};
		},

		componentWillReceiveProps: function (nextProps) {

			if (!Immutable.is(this.props.module, nextProps.module)) {
				var height = jQuery(findDOMNode(this)).outerHeight();
				jQuery(findDOMNode(this)).css({ 'opacity': '0', 'height': height, 'overflow': 'hidden' });
				setTimeout(function () {
					var data = {
						type: 'jstrigger',
						moduleName: 'clients',
						shouldUpdate: true
					},
					    jsonData = JSON.stringify(data);
					document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
					setTimeout(function () {
						this.setState({
							trigger: true
						});
					}.bind(this), 0);
				}.bind(this), 0);
			}
		},

		componentDidMount: function (nextProps, nextState) {

			var data = {
				type: 'jstrigger',
				moduleName: 'clients',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		shouldComponentUpdate: function (nextProps, nextState) {

			if (nextState.trigger) {
				return true;
			} else {
				return false;
			}
		},

		componentDidUpdate: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'clients',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		render: function () {

			var clients = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = clients.get('atts'),
			    children = clients.get('inner'),
			    slideShow,
			    slideShowSpeed;
			if (!isEmpty(atts)) {
				slideShow = atts.get('slide_show');
				slideShowSpeed = parseValue(clients.get('name'), 'slide_show_speed', atts.get('slide_show_speed'), moduleOptions);
				if (!isEmpty(slideShow)) {
					slideShow = '1';
				} else {
					slideShow = '0';
				}
				if ('string' === typeof slideShowSpeed && !isNaN(slideShowSpeed.replace(/\D+/, '')) && '' != slideShowSpeed.replace(/\D+/, '')) {
					slideShowSpeed = slideShowSpeed.replace(/\D+/, '');
				} else {
					slideShowSpeed = '2000';
				}
			}
			return React.createElement(
				'div',
				{ className: 'carousel-wrap clearfix' },
				React.createElement(
					'ul',
					{ className: 'be-owl-carousel client-carousel-module', 'data-slide-show': slideShow, 'data-slide-show-speed': slideShowSpeed },
					children.map(function (client) {
						return React.createElement(Client, { key: client.get('id'), moduleOptions: moduleOptions, module: client });
					})
				)
			);
		}

	});
	module.exports = Clients;

/***/ }),
/* 2 */
/***/ (function(module, exports) {

	module.exports = function isEmpty(mixed_var) {

		if (_.isUndefined(mixed_var) || '0' === mixed_var || '' === mixed_var || 0 === mixed_var || _.isEmpty(mixed_var) || 'none' === mixed_var || false === mixed_var) {
			return true;
		}

		return false;
	};

/***/ }),
/* 3 */
/***/ (function(module, exports) {

	module.exports = function (moduleName, attName, value, moduleOptions) {

	    var attsFromModuleOptions = moduleOptions.getIn([moduleName, 'atts']),
	        attributeMap = Immutable.Map(),
	        options,
	        unit;
	    if ('string' === typeof value) {
	        if (Immutable.List.isList(attsFromModuleOptions)) {
	            attsFromModuleOptions.every(function (att) {
	                if (attName === att.get('att_name')) {
	                    attributeMap = att;
	                    return false;
	                } else {
	                    return true;
	                }
	            });
	            options = attributeMap.get('options');
	            if ('undefined' != typeof options && Immutable.Map.isMap(options)) {
	                unit = options.get('unit');
	                if ('string' === typeof unit && '' != unit) {
	                    if (-1 == value.indexOf(unit)) {
	                        value = value + unit;
	                    }
	                }
	            } else {
	                console.log('options is undefined!');
	            }
	        } else {
	            console.log('module options not found for', moduleName);
	        }
	    } else {
	        console.log('value is not a string, check module options of', moduleName);
	        value = '';
	    }

	    return value;
	};

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var Client = React.createClass({
		displayName: 'Client',


		getImageGreyScale: function (defaultImageStyle, hoverImageStyle) {

			var imageGradient = '';
			if (!isEmpty(defaultImageStyle) && !isEmpty(hoverImageStyle)) {
				if ('black_white' === defaultImageStyle) {
					if ('black_white' === hoverImageStyle) {
						imageGradient = 'bw_to_bw';
					} else {
						imageGradient = 'bw_to_c';
					}
				} else {
					if ('black_white' === hoverImageStyle) {
						imageGradient = 'c_to_bw';
					} else {
						imageGradient = 'c_to_c';
					}
				}
			}
			return imageGradient;
		},

		render: function () {

			var client = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = client.get('atts'),
			    image,
			    link,
			    newTab,
			    imageGradient;
			if (!isEmpty(atts)) {
				image = atts.get('image');
				link = atts.get('link');
				newTab = atts.get('new_tab');
				defaultImageStyle = atts.get('default_image_style');
				hoverImageStyle = atts.get('hover_image_style');
				if (isEmpty(image)) {
					image = '';
				}
				if (isEmpty(newTab)) {
					newTab = '0';
				}
				if ('undefined' === typeof link || '' === link) {
					link = '#';
				}
				imageGradient = this.getImageGreyScale(defaultImageStyle, hoverImageStyle);
			}
			if ('' != image) {
				return React.createElement(
					'li',
					{ className: "carousel-item client-carousel-item " + imageGradient },
					React.createElement(
						'a',
						{ target: '0' != newTab ? '_blank' : null, href: link },
						React.createElement('img', { src: image, alt: '' })
					)
				);
			} else {
				return null;
			}
		}

	});
	module.exports = Client;

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    ImageSlide = __webpack_require__(6),
	    findDOMNode = ReactDOM.findDOMNode,
	    parseValue = __webpack_require__(3);
	var ImageSlider = React.createClass({
		displayName: 'ImageSlider',


		getInitialState: function () {

			return {
				trigger: false
			};
		},

		componentWillReceiveProps: function (nextProps) {

			if (!Immutable.is(this.props.module, nextProps.module)) {
				var height = jQuery(findDOMNode(this)).outerHeight();
				jQuery(findDOMNode(this)).css({ 'opacity': '0', 'height': height, 'overflow': 'hidden' });
				setTimeout(function () {
					var data = {
						type: 'jstrigger',
						moduleName: 'flex_slider',
						shouldUpdate: true
					},
					    jsonData = JSON.stringify(data);
					document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
					setTimeout(function () {
						this.setState({
							trigger: true
						});
					}.bind(this), 0);
				}.bind(this), 0);
			}
		},

		shouldComponentUpdate: function (nextProps, nextState) {

			if (nextState.trigger) {
				return true;
			} else {
				return false;
			}
		},

		componentDidUpdate: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'flex_slider',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		componentDidMount: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'flex_slider',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		render: function () {

			var imageSlider = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    children = imageSlider.get('inner'),
			    atts = imageSlider.get('atts'),
			    slideShow,
			    slideShowSpeed;

			if (!isEmpty(atts)) {
				slideShowSpeed = parseValue(imageSlider.get('name'), 'slide_show_speed', atts.get('slide_show_speed'), moduleOptions);
				slideShow = atts.get('slide_show');
				if ('yes' === slideShow || '1' === slideShow) {
					slideShow = '1';
				} else {
					slideShow = '0';
				}
				if ('string' === typeof slideShowSpeed && !isNaN(slideShowSpeed.replace(/\D+/, '')) && '' != slideShowSpeed.replace(/\D+/, '')) {
					slideShowSpeed = slideShowSpeed.replace(/\D+/, '');
				} else {
					slideShowSpeed = '2000';
				}
			}
			return React.createElement(
				'div',
				{ className: 'be_image_slider style1-arrow' },
				React.createElement(
					'div',
					{ className: 'image_slider_module slides', 'data-animation': 'fade', 'data-slide-show': slideShow, 'data-slide-show-speed': slideShowSpeed },
					children.map(function (image) {
						return React.createElement(ImageSlide, { key: image.get('id'), module: image, moduleOptions: moduleOptions });
					})
				)
			);
		}

	});
	module.exports = ImageSlider;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var ImageSlide = React.createClass({
		displayName: 'ImageSlide',


		parseUrl: function (url) {

			var anchor = document.createElement('a'),
			    hostName;
			anchor.href = url;
			hostName = anchor.host;
			if (-1 < hostName.indexOf('youtube') || -1 < hostName.indexOf('youtu.be')) {
				return 'youtube';
			} else if (-1 < hostName.indexOf('vimeo')) {
				return 'vimeo';
			} else {
				return '';
			}
		},

		render: function () {

			var imageSlide = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = imageSlide.get('atts'),
			    image,
			    pattern,
			    output,
			    video = '';
			if (!isEmpty(atts)) {
				image = atts.get('image');
				video = atts.get('video');
				if ('undefined' != typeof video && '' != video) {
					if ('youtube' === this.parseUrl(video)) {
						pattern = /(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i;
						videoId = video.match(pattern)[1];
						output = React.createElement('iframe', { width: '940', height: '450', src: "https://www.youtube.com/embed/" + videoId, allowFullScreen: true });
					} else if ('vimeo' === this.parseUrl(video)) {
						pattern = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
						videoId = video.match(pattern)[3];
						output = React.createElement('iframe', { src: "https://player.vimeo.com/video/" + videoId, width: '500', height: '281', allowFullScreen: true });
					} else {
						video = '';
					}
				}
				if (!isEmpty(image) && ('' === video || 'undefined' === typeof video)) {
					output = React.createElement('img', { src: image, alt: '' });
				}
			}
			return React.createElement(
				'div',
				{ className: 'be_image_slide' },
				output
			);
		}

	});
	module.exports = ImageSlide;

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    findDOMNode = ReactDOM.findDOMNode,
	    Testimonial = __webpack_require__(8),
	    parseValue = __webpack_require__(3);
	var Testimonials = React.createClass({
		displayName: 'Testimonials',


		getInitialState: function () {

			return {
				trigger: false
			};
		},

		componentWillReceiveProps: function (nextProps) {

			var currentNode = jQuery(findDOMNode(this));
			if (!Immutable.is(this.props.module, nextProps.module)) {
				var height = jQuery(findDOMNode(this)).outerHeight();
				currentNode.css({ 'opacity': '0', 'height': height, 'overflow': 'hidden' });
				setTimeout(function () {
					var data = {
						type: 'jstrigger',
						moduleName: 'testimonials',
						shouldUpdate: true
					},
					    jsonData = JSON.stringify(data);
					document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
					setTimeout(function () {
						this.setState({
							trigger: true
						});
					}.bind(this), 0);
				}.bind(this), 0);
			}
		},

		shouldComponentUpdate: function (nextProps, nextState) {

			if (nextState.trigger) {
				return true;
			} else {
				return false;
			}
		},

		componentDidUpdate: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'testimonials',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		componentDidMount: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'testimonials',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
		},

		render: function () {

			var testimonials = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = testimonials.get('atts'),
			    children = testimonials.get('inner') || Immutable.List(),
			    authorRoleFont = '',
			    testimonialFontSize = '',
			    slideAnimationType = '',
			    alignment = '',
			    slideShowSpeed = '',
			    slideShow = '',
			    pagination = '',
			    animate = '',
			    animationType = '';
			if (!isEmpty(atts)) {
				testimonialFontSize = parseValue(testimonials.get('name'), 'testimonial_font_size', atts.get('testimonial_font_size'), moduleOptions);
				authorRoleFont = atts.get('author_role_font');
				slideAnimationType = atts.get('slide_animation_type');
				slideShowSpeed = atts.get('slide_show_speed');
				slideShow = atts.get('slide_show');
				pagination = atts.get('pagination');
				alignment = atts.get('alignment'), animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				if ('string' === typeof testimonialFontSize && '' != testimonialFontSize.replace(/\D+/, '') && !isNaN(testimonialFontSize.replace(/\D+/, ''))) {
					testimonialFontSize = testimonialFontSize;
				} else {
					testimonialFontSize = null;
				}
			}
			return React.createElement(
				'div',
				{ className: "testimonials_wrap " + (!isEmpty(animate) ? 'be-animate' : ''), 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: 'testimonials-slides' },
					React.createElement(
						'div',
						{ className: "clearfix testimonial_module slides " + alignment + "-content", 'data-slide-show': !isEmpty(slideShow) ? '1' : '0', 'data-slide-show-speed': !isEmpty(slideShowSpeed) ? slideShowSpeed : null, 'data-slide-animation-type': !isEmpty(slideAnimationType) ? slideAnimationType : null, 'data-pagination': !isEmpty(pagination) ? '1' : '0' },
						children.map(function (testimonial) {
							return React.createElement(Testimonial, { key: testimonial.get('id'), fontSize: testimonialFontSize, roleFont: authorRoleFont, module: testimonial, moduleOptions: moduleOptions });
						})
					)
				)
			);
		}

	});
	module.exports = Testimonials;

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var Testimonial = React.createClass({
		displayName: "Testimonial",


		getAuthorImage: function (authorImage) {

			if (!isEmpty(authorImage)) {
				return React.createElement(
					"div",
					{ className: "testimonial-author-img" },
					React.createElement("img", { src: authorImage, alt: "" })
				);
			} else {
				return null;
			}
		},

		getAuthor: function (atts) {

			var author = atts.get('author'),
			    authorColor = atts.get('author_color');
			if ('undefined' != typeof author) {
				return React.createElement(
					"h6",
					{ className: "testimonial-author", style: { color: !isEmpty(authorColor) ? authorColor : null } },
					author
				);
			} else {
				return null;
			}
		},

		getAuthorRole: function (atts) {

			var authorRole = atts.get('author_role'),
			    authorRoleFont = this.props.roleFont,
			    authorRoleClass = 'testimonial-author-role ',
			    authorRoleColor = atts.get('author_role_color');
			if ('undefined' != typeof authorRole) {
				if (!isEmpty(authorRoleFont)) {
					if ('h6' === authorRoleFont) {
						authorRoleClass = authorRoleClass + 'h6-font';
					} else if ('special' === authorRoleFont) {
						authorRoleClass = authorRoleClass + 'special-subtitle ';
					} else {
						authorRoleClass = authorRoleClass + '';
					}
				}
				return React.createElement(
					"div",
					{ className: authorRoleClass, style: { color: !isEmpty(authorRoleColor) ? authorRoleColor : null } },
					authorRole
				);
			} else {
				return null;
			}
		},

		render: function () {

			var testimonial = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = testimonial.get('atts'),
			    fontSize = this.props.fontSize,
			    content = '',
			    authorImage = '',
			    quoteColor = '';
			if (!isEmpty(atts)) {
				quoteColor = atts.get('quote_color');
				content = atts.get('content');
				authorImage = atts.get('author_image');
			}
			return React.createElement(
				"div",
				{ className: "testimonial_slide slide clearfix be-testimonial-" + testimonial.get('id') },
				React.createElement(
					"div",
					{ className: "testimonial_slide_inner" },
					React.createElement("i", { className: "font-icon icon-quote", style: { color: !isEmpty(quoteColor) ? quoteColor : null } }),
					React.createElement("p", { className: "testimonial-content", dangerouslySetInnerHTML: { __html: content }, style: { fontSize: 'undefined' != typeof fontSize ? fontSize : null } }),
					React.createElement(
						"div",
						{ className: "testimonial-author-info-wrap clearfix" },
						this.getAuthorImage(authorImage),
						React.createElement(
							"div",
							{ className: "testimonial-author-info" },
							[this.getAuthor(atts), this.getAuthorRole(atts)]
						)
					)
				)
			);
		}

	});
	module.exports = Testimonial;

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    findDOMNode = ReactDOM.findDOMNode,
	    ContentSlide = __webpack_require__(10),
	    parseValue = __webpack_require__(3);
	var ContentSlider = React.createClass({
		displayName: 'ContentSlider',


		getInitialState: function () {

			return {
				trigger: false
			};
		},

		componentWillReceiveProps: function (nextProps) {

			if (!Immutable.is(this.props.module, nextProps.module)) {
				var height = jQuery(findDOMNode(this)).outerHeight();
				jQuery(findDOMNode(this)).css({ 'opacity': '0', 'height': height, 'overflow': 'hidden' });
				setTimeout(function () {
					var data = {
						type: 'jstrigger',
						moduleName: 'content_slides',
						shouldUpdate: true
					},
					    jsonData = JSON.stringify(data);
					document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
					setTimeout(function () {
						this.setState({
							trigger: true
						});
					}.bind(this), 0);
				}.bind(this), 0);
			}
		},

		shouldComponentUpdate: function (nextProps, nextState) {

			if (nextState.trigger) {
				return true;
			} else {
				return false;
			}
		},

		componentDidMount: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'content_slides',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
		},

		componentDidUpdate: function () {

			var data = {
				type: 'jstrigger',
				moduleName: 'content_slides',
				shouldUpdate: false
			},
			    jsonData = JSON.stringify(data);
			document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
			this.setState({
				trigger: false
			});
		},

		render: function () {

			var contentSlider = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    children = contentSlider.get('inner'),
			    atts = contentSlider.get('atts'),
			    slideAnimationType = 'slide',
			    slideShow,
			    slideShowSpeed,
			    animate,
			    animationType,
			    contentMaxWidth,
			    moduleName = contentSlider.get('name'),
			    bulletsColor;
			if (!isEmpty(atts)) {
				slideShow = atts.get('slide_show');
				slideShowSpeed = parseValue(moduleName, 'slide_show_speed', atts.get('slide_show_speed'), moduleOptions);
				animate = atts.get('animate');
				bulletsColor = atts.get('bullets_color');
				contentMaxWidth = parseValue(moduleName, 'content_max_width', atts.get('content_max_width'), moduleOptions);
				if (!isEmpty(slideShow)) {
					slideShow = '1';
				} else {
					slideShow = '0';
				}
				if ('string' === typeof slideShowSpeed && '' != slideShowSpeed.replace(/\D+/, '') && !isNaN(slideShowSpeed.replace(/\D+/, ''))) {
					slideShowSpeed = slideShowSpeed.replace(/\D+/, '');
				} else {
					slideShowSpeed = '1000';
				}
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				if (isEmpty(bulletsColor)) {
					bulletsColor = '#20cbd4';
				}
				if ('string' === typeof contentMaxWidth && '' != contentMaxWidth.replace(/\D+/, '') && !isNaN(contentMaxWidth.replace(/\D+/, ''))) {
					contentMaxWidth = contentMaxWidth;
				} else {
					contentMaxWidth = '100%';
				}
			}
			return React.createElement(
				'div',
				{ className: "oshine-module content-slide-wrap " + (!isEmpty(animate) ? 'be-animate' : ''), 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: 'content-slider clearfix' },
					React.createElement(
						'ul',
						{ className: 'clearfix slides content_slider_module clearfix', 'data-slide-show': slideShow, 'data-slide-show-speed': slideShowSpeed, 'data-slide-animation-type': 'slide' },
						children.map(function (slide) {
							return React.createElement(ContentSlide, { key: slide.get('id'), maxWidth: contentMaxWidth, module: slide, moduleOptions: moduleOptions });
						})
					)
				)
			);
		}

	});
	module.exports = ContentSlider;

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var ContentSlide = React.createClass({
		displayName: 'ContentSlide',


		render: function () {

			var contentSlide = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = contentSlide.get('atts'),
			    maxWidth = this.props.maxWidth || '100',
			    content;
			if (!isEmpty(atts)) {
				content = atts.get('content');
				if ('undefined' != typeof content) {
					content = content;
				} else {
					content = '';
				}
			}
			return React.createElement(
				'li',
				{ className: 'content_slide slide clearfix' },
				React.createElement(
					'div',
					{ className: 'content_slide_inner', style: { width: maxWidth } },
					React.createElement('div', { className: 'content-slide-content', dangerouslySetInnerHTML: { __html: content } })
				)
			);
		}

	});
	module.exports = ContentSlide;

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var IconCard = React.createClass({
		displayName: 'IconCard',


		getCaptionTag: function (atts) {

			var captionTag = 'div',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont) && 'body' != captionFont && 'special' != captionFont) {
				captionTag = captionFont;
			}
			return captionTag;
		},

		getCaptionClass: function (atts) {

			var captionClass = '',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont)) {
				if ('body' === captionFont) {
					captionClass = captionClass + 'body-font';
				} else if ('special' === captionFont) {
					captionClass = captionClass + 'special-subtitle';
				}
			}
			return captionClass;
		},

		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module be_icon_card_wrap ',
			    size = atts.get('size'),
			    animate = atts.get('animate'),
			    style = atts.get('style');
			if (!isEmpty(size)) {
				wrapperClass = wrapperClass + size + ' ';
			}
			if (!isEmpty(style)) {
				wrapperClass = wrapperClass + style + ' ';
			}
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			return wrapperClass;
		},

		getIconStyle: function (atts) {

			var iconStyle = {},
			    bgColor = atts.get('icon_bg'),
			    borderColor = atts.get('icon_border_color'),
			    style = atts.get('style'),
			    color = atts.get('icon_color');
			if (!isEmpty(bgColor) && 'circled' === style) {
				iconStyle.backgroundColor = bgColor;
			}
			if (!isEmpty(borderColor)) {
				iconStyle.border = '1px solid ' + borderColor;
			} else {
				iconStyle.border = '0';
			}
			if (!isEmpty(color)) {
				iconStyle.color = color;
			}
			return iconStyle;
		},

		render: function () {

			var iconCard = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = iconCard.get('atts'),
			    iconStyle = {},
			    wrapperClass = '',
			    title = '',
			    TitleTag = 'h4',
			    titleColor = '',
			    icon = '',
			    CaptionTag = 'div',
			    captionClass = '',
			    animate = '',
			    caption = '',
			    animationType = '',
			    captionColor = '';
			if (!isEmpty(atts)) {
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				title = atts.get('title');
				iconStyle = this.getIconStyle(atts);
				TitleTag = atts.get('title_font');
				titleColor = atts.get('title_color');
				caption = atts.get('caption');
				CaptionTag = this.getCaptionTag(atts);
				captionColor = atts.get('caption_color');
				captionClass = this.getCaptionClass(atts);
				wrapperClass = this.getWrapperClass(atts);
				icon = atts.get('icon');
			}
			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement('i', { className: "font-icon " + icon, style: iconStyle }),
				React.createElement(
					'div',
					{ className: 'title-with-icon-card' },
					['undefined' != typeof title ? React.createElement(
						TitleTag,
						{ style: { color: !isEmpty(titleColor) ? titleColor : null } },
						' ',
						title,
						' '
					) : null, 'undefined' != typeof caption ? React.createElement(
						CaptionTag,
						{ className: captionClass, style: { color: !isEmpty(captionColor) ? captionColor : null } },
						' ',
						caption,
						' '
					) : null]
				)
			);
		}

	});
	module.exports = IconCard;

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	ProcessColumn = __webpack_require__(13);
	var Process = React.createClass({
		displayName: 'Process',


		getDividerHeight: function (iconSize, name, moduleOptions) {

			var dividerHeight = 0,
			    iconSize = parseValue(name, 'icon_size', iconSize, moduleOptions),
			    unit = '';
			if ('string' === typeof iconSize && '' != iconSize.replace(/\D+/, '') && !isNaN(iconSize.replace(/\D+/, ''))) {
				unit = iconSize.replace(/\d+/, '');
				dividerHeight = Number(iconSize.replace(/\D+/, '')) / 2;
			}
			return dividerHeight.toString() + unit;
		},

		render: function () {

			var process = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = process.get('atts'),
			    children = process.get('inner'),
			    outputArray = [],
			    borderColor = '';
			if (!isEmpty(atts)) {
				borderColor = atts.get('border_color');
			}
			children.forEach(function (processCol) {

				var dividerHeight = this.getDividerHeight(processCol.getIn(['atts', 'icon_size']), processCol.get('name'), moduleOptions);
				outputArray.push(React.createElement(ProcessColumn, { parentId: process.get('id'), borderColor: borderColor, dividerHeight: dividerHeight, key: processCol.get('id'), module: processCol, moduleOptions: moduleOptions }));
			}.bind(this));
			return React.createElement(
				'div',
				{ className: 'oshine-module process-style1', 'data-col': '1' },
				outputArray
			);
		}

	});
	module.exports = Process;

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	var ProcessColumn = React.createClass({
		displayName: 'ProcessColumn',


		getIconStyle: function (atts, processColumn, moduleOptions) {

			var iconStyle = {},
			    iconSize = parseValue(processColumn.get('name'), 'icon_size', atts.get('icon_size'), moduleOptions),
			    iconColor = atts.get('icon_color');
			if ('string' === typeof iconSize && '' != iconSize.replace(/\D+/, '') && !isNaN(iconSize.replace(/\D+/, ''))) {
				iconStyle.fontSize = iconSize;
			}
			if (!isEmpty(iconColor)) {
				iconStyle.color = iconColor;
			}
			return iconStyle;
		},

		render: function () {

			var processColumn = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = processColumn.get('atts'),
			    animate = '',
			    top = this.props.dividerHeight,
			    borderColor = this.props.borderColor,
			    icon = '',
			    content = '',
			    animationType = '',
			    iconStyle = {};

			if (!isEmpty(atts)) {
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				icon = atts.get('icon'), iconStyle = this.getIconStyle(atts, processColumn, moduleOptions);
				content = atts.get('content');
			}
			return React.createElement(
				'div',
				{ className: "process-col 0 align-center " + (!isEmpty(animate) ? 'be-animate' : ''), 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement('i', { className: "font-icon " + icon, style: iconStyle }),
				React.createElement('div', { dangerouslySetInnerHTML: { __html: content }, className: 'process-info' }),
				React.createElement('div', { className: 'process-sep', style: { top: top, background: !isEmpty(borderColor) ? borderColor : null } })
			);
		}

	});
	module.exports = ProcessColumn;

/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

	var Service = __webpack_require__(15),
	    isEmpty = __webpack_require__(2);
	var Services = React.createClass({
		displayName: 'Services',


		render: function () {

			var services = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = services.get('atts'),
			    children = services.get('inner') || Immutable.List(),
			    lineColor = '';
			if (!isEmpty(atts)) {
				lineColor = atts.get('line_color');
			}
			return React.createElement(
				'div',
				{ className: 'oshine-module services-outer-wrap' },
				React.createElement(
					'ul',
					{ className: 'be-services' },
					children.map(function (service) {

						return React.createElement(Service, { key: service.get('id'), module: service, moduleOptions: moduleOptions });
					})
				),
				React.createElement('span', { className: 'timeline', style: { background: !isEmpty(lineColor) ? lineColor : null } })
			);
		}

	});
	module.exports = Services;

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var Service = React.createClass({
		displayName: 'Service',


		getIconStyle: function (atts) {

			var iconStyle = {},
			    bgColor = atts.get('icon_bg_color'),
			    color = atts.get('icon_color');
			if (!isEmpty(bgColor)) {
				iconStyle.backgroundColor = bgColor;
			}
			if (!isEmpty(color)) {
				iconStyle.color = color;
			}
			return iconStyle;
		},

		render: function () {

			var service = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = service.get('atts'),
			    bgColor = '',
			    color = '',
			    hoverBgColor = '',
			    content = '',
			    hoverColor = '',
			    contentColor = '',
			    iconStyle = {},
			    icon = '',
			    size = '';
			if (!isEmpty(atts)) {
				icon = atts.get('icon');
				size = atts.get('icon_size');
				color = atts.get('icon_color');
				bgColor = atts.get('icon_bg_color');
				hoverBgColor = atts.get('icon_hover_bg_color');
				hoverColor = atts.get('icon_hover_color');
				content = atts.get('content');
				iconClass = 'font-icon ';
				if (!isEmpty(size)) {
					iconClass = iconClass + 'icon-size-' + size + ' ';
				}
				if (!isEmpty(icon)) {
					iconClass = iconClass + icon;
				}
				iconStyle = this.getIconStyle(atts);
				contentColor = atts.get('content_bg_color');
			}
			return React.createElement(
				'li',
				{ className: 'oshine-module be-service' },
				React.createElement(
					'div',
					{ className: 'service-wrap', 'data-color': !isEmpty(color) ? color : 'transparent', 'data-hover-color': !isEmpty(hoverColor) ? hoverColor : null, 'data-bg-color': !isEmpty(bgColor) ? bgColor : 'transparent', 'data-hover-bg-color': !isEmpty(hoverBgColor) ? hoverBgColor : null },
					React.createElement('i', { className: iconClass, style: iconStyle }),
					React.createElement('div', { className: 'service-content', style: { backgroundColor: !isEmpty(contentColor) ? contentColor : null }, dangerouslySetInnerHTML: { __html: content } })
				)
			);
		}

	});
	module.exports = Service;

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    Skill = __webpack_require__(17),
	    parseValue = __webpack_require__(3);
	var Skills = React.createClass({
	    displayName: 'Skills',


	    render: function () {

	        var skills = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = skills.get('atts'),
	            children = skills.get('inner') || Immutable.List(),
	            direction = 'horizontal',
	            skillsStyle = {},
	            height = '';
	        if (!isEmpty(atts)) {
	            direction = atts.get('direction');
	            height = parseValue(skills.get('name'), 'height', atts.get('height'), moduleOptions);
	            if (isEmpty(direction)) {
	                direction = 'horizontal';
	            }
	            if ('string' === typeof height && '' != height.replace(/\D+/, '') && !isNaN(height.replace(/\D+/, ''))) {
	                height = height;
	            } else {
	                height = '400px';
	            }
	            if ('vertical' === direction) {
	                skillsStyle.height = height;
	            }
	        }
	        return React.createElement(
	            'div',
	            { className: "oshine-module skill_container be-shortcode skill-" + direction, style: skillsStyle },
	            React.createElement(
	                'div',
	                { className: 'skill clearfix' },
	                children.map(function (skill) {

	                    return React.createElement(Skill, { key: skill.get('id'), height: height, module: skill, moduleOptions: moduleOptions, skillsStyle: skillsStyle, direction: direction });
	                })
	            )
	        );
	    }

	});
	module.exports = Skills;

/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	var Skill = React.createClass({
	    displayName: 'Skill',


	    render: function () {

	        var skill = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = skill.get('atts'),
	            direction = this.props.direction,
	            height = this.props.height,
	            title = '',
	            fillColor = '',
	            value = '',
	            bgColor = '',
	            barStyle = {},
	            titleColor = '';
	        if (!isEmpty(atts)) {
	            title = atts.get('title');
	            fillColor = atts.get('fill_color');
	            value = parseValue(skill.get('name'), 'value', atts.get('value'), moduleOptions);
	            if ('string' === typeof value && '' != value.replace(/\D+/, '') && !isNaN(value.replace(/\D+/, ''))) {
	                value = value;
	            } else {
	                value = '100%';
	            }
	            bgColor = atts.get('bg_color');
	            if (!isEmpty(bgColor)) {
	                barStyle.backgroundColor = bgColor;
	            }
	            if ('undefined' != typeof direction && 'vertical' === direction) {
	                barStyle.height = height;
	            }
	            titleColor = atts.get('title_color');
	        }
	        return 'horizontal' === direction ? React.createElement(
	            'div',
	            { className: 'oshine-module skill-wrap' },
	            React.createElement(
	                'span',
	                { className: 'skill_name', style: { color: !isEmpty(titleColor) ? titleColor : null } },
	                title
	            ),
	            React.createElement(
	                'div',
	                { className: 'skill-bar', style: barStyle },
	                React.createElement('span', { className: 'be-skill expand alt-bg alt-bg-text-color', 'data-skill-value': value, style: { background: !isEmpty(fillColor) ? fillColor : null } })
	            )
	        ) : React.createElement(
	            'div',
	            { className: 'oshine-module skill-wrap' },
	            React.createElement(
	                'div',
	                { className: 'skill-bar', style: barStyle },
	                React.createElement('span', { className: 'be-skill expand alt-bg alt-bg-text-color', 'data-skill-value': value, style: { background: !isEmpty(fillColor) ? fillColor : null } })
	            ),
	            React.createElement(
	                'span',
	                { className: 'skill_name', style: { color: !isEmpty(titleColor) ? titleColor : null } },
	                title
	            )
	        );
	    }

	});
	module.exports = Skill;

/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	var SpecialHeadingStyle1 = React.createClass({
		displayName: 'SpecialHeadingStyle1',


		getSeparatorStyle: function (atts, specialHeading, moduleOptions) {

			var separatorStyle = {},
			    separatorColor = atts.get('separator_color'),
			    separatorWidth = parseValue(specialHeading.get('name'), 'separator_width', atts.get('separator_width'), moduleOptions),
			    separatorThickness = parseValue(specialHeading.get('name'), 'separator_thickness', atts.get('separator_thickness'), moduleOptions);
			if (!isEmpty(separatorColor)) {
				separatorStyle.background = separatorColor;
				separatorStyle.color = separatorColor;
				separatorStyle.borderColor = separatorColor;
			}
			if ('string' === typeof separatorWidth && '' != separatorWidth.replace(/\D+/, '') && !isNaN(separatorWidth.replace(/\D+/, ''))) {
				separatorStyle.width = separatorWidth;
			} else {
				separatorStyle.width = '0px';
			}
			if ('string' === typeof separatorThickness && '' != separatorThickness.replace(/\D+/, '') && !isNaN(separatorThickness.replace(/\D+/, ''))) {
				separatorStyle.height = separatorThickness;
			} else {
				separatorStyle.height = '0px';
			}
			return separatorStyle;
		},

		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-heading-wrap style1 ',
			    animate = atts.get('animate'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			return wrapperClass;
		},

		getSeparatorWithIcon: function (atts, specialHeading, moduleOptions) {

			var separatorStyle = this.getSeparatorStyle(atts, specialHeading, moduleOptions),
			    icon,
			    iconStyle = {},
			    iconColor,
			    separatorIconStyle = atts.get('separator_style'),
			    disableSeparator = atts.get('disable_separator');
			if (isEmpty(disableSeparator)) {
				if (!isEmpty(separatorIconStyle)) {
					icon = atts.get('icon_name');
					iconColor = atts.get('icon_color');
					if ('oshine_diamond' === icon && !isEmpty(iconColor)) {
						iconStyle.background = iconColor;
					} else if (!isEmpty(iconColor)) {
						iconStyle.color = iconColor;
					}
					separatorStyle.width = separatorStyle.width.replace(/\D+/, '') / 2 + separatorStyle.width.replace(/\d+/, '');
					return React.createElement(
						'div',
						{ className: 'sep-with-icon-wrap margin-bottom' },
						React.createElement('span', { className: 'sep-with-icon', style: separatorStyle }),
						React.createElement('i', { className: "sep-icon font-icon " + icon, style: iconStyle }),
						React.createElement('span', { className: 'sep-with-icon', style: separatorStyle })
					);
				} else {
					return React.createElement(
						'div',
						{ className: 'sep-with-icon-wrap margin-bottom' },
						React.createElement('hr', { className: 'separator margin-bottom', style: separatorStyle })
					);
				}
			}
		},

		render: function () {

			var specialHeading = this.props.module,
			    atts = specialHeading.get('atts'),
			    moduleOptions = this.props.moduleOptions,
			    animate = '',
			    animationType = '',
			    alignment = '',
			    titleContent = '',
			    addSubTitleSpecialFont = '',
			    subTitleContent = '',
			    TitleTag = 'h3',
			    separatorPosition = '',
			    outputArray = [],
			    subTitleClass = '',
			    wrapperClass = '';
			if (!isEmpty(atts)) {
				wrapperClass = this.getWrapperClass(atts);
				titleColor = atts.get('title_color');
				titleContent = atts.get('title_content');
				alignment = atts.get('title_align') || '';
				subTitleContent = atts.get('content');
				TitleTag = atts.get('h_tag');
				addSubTitleSpecialFont = atts.get('subtitle_spl_font');
				separatorPosition = atts.get('separator_pos');
				if (!isEmpty(addSubTitleSpecialFont)) {
					subTitleClass = 'special-subtitle ';
				}
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				if ('' === TitleTag || 'undefined' === typeof TitleTag) {
					TitleTag = 'h3';
				}
			}
			if ('undefined' != typeof titleContent) {
				outputArray.push(React.createElement(
					TitleTag,
					{ className: 'special-h-tag', style: { color: !isEmpty(titleColor) ? titleColor : null } },
					' ',
					titleContent,
					' '
				));
			}
			if (isEmpty(separatorPosition)) {
				if ('undefined' != typeof subTitleContent) {
					outputArray.push(React.createElement('div', { className: "sub-title margin-bottom " + subTitleClass, dangerouslySetInnerHTML: { __html: subTitleContent } }));
				}
				outputArray.push(this.getSeparatorWithIcon(atts, specialHeading, moduleOptions));
			} else {
				outputArray.push(this.getSeparatorWithIcon(atts, specialHeading, moduleOptions));
				if ('undefined' != typeof subTitleContent) {
					outputArray.push(React.createElement('div', { className: "sub-title margin-bottom " + subTitleClass, dangerouslySetInnerHTML: { __html: subTitleContent } }));
				}
			}
			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: "special-heading align-" + alignment },
					outputArray
				)
			);
		}

	});
	module.exports = SpecialHeadingStyle1;

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

	var parseValue = __webpack_require__(3),
	    isEmpty = __webpack_require__(2);

	var SpecialHeadingStyle2 = React.createClass({
		displayName: 'SpecialHeadingStyle2',


		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-heading-wrap style2 ',
			    animate = atts.get('animate'),
			    alignment = atts.get('title_alignment'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			if (!isEmpty(alignment)) {
				wrapperClass = wrapperClass + 'align-' + alignment + ' ';
			}
			return wrapperClass;
		},

		getHeadingStyle: function (atts, specialHeading, moduleOptions) {

			var headingStyle = {},
			    borderWidth = parseValue(specialHeading.get('name'), 'border_thickness', atts.get('border_thickness'), moduleOptions),
			    borderColor = atts.get('border_color'),
			    padding = atts.get('padding');
			if ('string' === typeof borderWidth && '' != borderWidth.replace(/\D+/, '') && !isNaN(borderWidth.replace(/\D+/, ''))) {
				headingStyle.borderWidth = borderWidth;
				headingStyle.borderStyle = 'solid';
				if (!isEmpty(borderColor)) {
					headingStyle.borderColor = borderColor;
				} else {
					headingStyle.borderColor = 'transparent';
				}
			} else {
				headingStyle.border = '0';
			}
			if (!isEmpty(padding)) {
				headingStyle.padding = padding;
			}
			return headingStyle;
		},

		render: function () {

			var specialHeading = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = specialHeading.get('atts'),
			    wrapperClass = '',
			    headingStyle = {},
			    TitleTag = 'h3',
			    animate = '',
			    animationType = '',
			    titleContent = '',
			    titleColor = '';
			if (!isEmpty(atts)) {
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				wrapperClass = this.getWrapperClass(atts);
				headingStyle = this.getHeadingStyle(atts, specialHeading, moduleOptions);
				titleContent = atts.get('title_content');
				titleColor = atts.get('title_color');
				TitleTag = atts.get('h_tag');
				if ('undefined' === TitleTag || '' === TitleTag) {
					TitleTag = 'h3';
				}
			}

			// console.log( titleStyle );

			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: 'special-heading', style: headingStyle },
					React.createElement(
						TitleTag,
						{ className: 'special-h-tag', style: { color: !isEmpty(titleColor) ? titleColor : null } },
						titleContent
					)
				)
			);
		}
	});

	module.exports = SpecialHeadingStyle2;

/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	var SpecialHeadingStyle3 = React.createClass({
		displayName: 'SpecialHeadingStyle3',


		getTopCaptionClass: function (atts) {

			var topCaptionClass = 'caption ',
			    topCaptionFont = atts.get('top_caption_font');
			if (!isEmpty(topCaptionFont)) {
				if ('body' === topCaptionFont) {
					topCaptionClass = topCaptionClass + 'body-font';
				} else if ('special' === topCaptionFont) {
					topCaptionClass = topCaptionClass + 'special-subtitle';
				}
			}
			return topCaptionClass;
		},

		getBottomCaptionClass: function (atts) {

			var bottomCaptionClass = 'caption ',
			    bottomCaptionFont = atts.get('bottom_caption_font');
			if (!isEmpty(bottomCaptionFont)) {
				if ('body' === bottomCaptionFont) {
					bottomCaptionClass = bottomCaptionClass + 'body-font';
				} else if ('special' === bottomCaptionFont) {
					bottomCaptionClass = bottomCaptionClass + 'special-subtitle';
				}
			}
			return bottomCaptionClass;
		},

		getTopCaptionStyle: function (atts, specialHeading, moduleOptions) {

			var topCaptionStyle = {},
			    fontColor = atts.get('top_caption_color'),
			    fontSize = parseValue(specialHeading.get('name'), 'top_caption_size', atts.get('top_caption_size'), moduleOptions);
			if (!isEmpty(fontColor)) {
				topCaptionStyle.color = fontColor;
			}
			if ('string' === typeof fontSize && '' != fontSize.replace(/\D+/, '') && !isNaN(fontSize.replace(/\D+/, ''))) {
				topCaptionStyle.fontSize = fontSize;
			}
			return topCaptionStyle;
		},

		getBottomCaptionStyle: function (atts, specialHeading, moduleOptions) {

			var bottomCaptionStyle = {},
			    fontColor = atts.get('bottom_caption_color'),
			    fontSize = parseValue(specialHeading.get('name'), 'bottom_caption_size', atts.get('bottom_caption_size'), moduleOptions);
			if (!isEmpty(fontColor)) {
				bottomCaptionStyle.color = fontColor;
			}
			if (!isEmpty(fontSize)) {
				bottomCaptionStyle.fontSize = fontSize;
			}
			return bottomCaptionStyle;
		},

		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-heading-wrap style3 ',
			    animate = atts.get('animate'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			return wrapperClass;
		},

		render: function () {

			var specialHeading = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = specialHeading.get('atts'),
			    topCaptionClass = '',
			    bottomCaptionClass = '',
			    topCaptionStyle = {},
			    bottomCaptionStyle = {},
			    topCaption = '',
			    topCaptionSeparatorColor = '',
			    bottomCaption = '',
			    bottomCaptionSeparatorColor = '',
			    titleColor = '',
			    titleContent = '',
			    wrapperClass = '',
			    animate = '',
			    CustomTag = 'h3',
			    animationType;
			if (!isEmpty(atts)) {
				topCaptionClass = this.getTopCaptionClass(atts);
				bottomCaptionClass = this.getBottomCaptionClass(atts);
				topCaptionStyle = this.getTopCaptionStyle(atts, specialHeading, moduleOptions);
				bottomCaptionStyle = this.getBottomCaptionStyle(atts, specialHeading, moduleOptions);
				wrapperClass = this.getWrapperClass(atts);
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				topCaption = atts.get('sub_title1');
				bottomCaption = atts.get('sub_title2');
				topCaptionSeparatorColor = atts.get('top_caption_separator_color');
				bottomCaptionSeparatorColor = atts.get('bottom_caption_separator_color');
				CustomTag = atts.get('h_tag');
				titleColor = atts.get('title_color');
				titleContent = atts.get('title_content');
				if ('undefined' === typeof CustomTag || '' === CustomTag) {
					CustomTag = 'h3';
				}
			}

			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': animate ? animationType : null },
				'string' == typeof topCaption && '' != topCaption ? React.createElement(
					'div',
					{ className: 'caption-wrap' },
					React.createElement(
						'h6',
						{ style: topCaptionStyle, className: topCaptionClass },
						topCaption,
						React.createElement('span', { className: 'caption-inner', style: { background: topCaptionSeparatorColor ? topCaptionSeparatorColor : null } })
					)
				) : null,
				React.createElement(
					'div',
					{ className: 'special-heading align-center' },
					React.createElement(
						CustomTag,
						{ className: 'special-h-tag', style: { color: titleColor ? titleColor : null } },
						titleContent
					)
				),
				'string' == typeof bottomCaption && '' != bottomCaption ? React.createElement(
					'div',
					{ className: 'caption-wrap' },
					React.createElement(
						'h6',
						{ style: bottomCaptionStyle, className: bottomCaptionClass },
						bottomCaption,
						React.createElement('span', { className: 'caption-inner', style: { background: bottomCaptionSeparatorColor ? bottomCaptionSeparatorColor : null } })
					)
				) : null
			);
		}

	});
	module.exports = SpecialHeadingStyle3;

/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var SpecialHeadingStyle4 = React.createClass({
		displayName: 'SpecialHeadingStyle4',


		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-heading-wrap style4 ',
			    animate = atts.get('animate'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			return wrapperClass;
		},

		getCaptionTag: function (atts) {

			var captionTag = 'div',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont) && 'body' != captionFont && 'special' != captionFont) {
				captionTag = captionFont;
			}
			return captionTag;
		},

		getCaptionClass: function (atts) {

			var captionClass = 'caption ',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont)) {
				if ('body' === captionFont) {
					captionClass = captionClass + 'body-font';
				} else if ('special' === captionFont) {
					captionClass = captionClass + 'special-subtitle';
				}
			}
			return captionClass;
		},

		render: function () {

			var specialHeading = this.props.module,
			    atts = specialHeading.get('atts'),
			    moduleOptions = this.props.moduleOptions,
			    wrapperClass = '',
			    CaptionTag = 'div',
			    TitleTag = 'h3',
			    captionClass = '',
			    dividerStyle = 'both',
			    animate = '',
			    animationType = '',
			    captionColor = '',
			    dividerColor = '',
			    captionContent = '',
			    titleContent = '',
			    titleColor = '';
			if (!isEmpty(atts)) {
				wrapperClass = this.getWrapperClass(atts);
				CaptionTag = this.getCaptionTag(atts);
				captionClass = this.getCaptionClass(atts);
				titleColor = atts.get('title_color');
				captionColor = atts.get('caption_color');
				dividerColor = atts.get('divider_color');
				titleContent = atts.get('title_content');
				captionContent = atts.get('caption_content');
				dividerStyle = atts.get('divider_style');
				TitleTag = atts.get('h_tag');
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				if ('undefined' === typeof CaptionTag || '' === CaptionTag) {
					CaptionTag = 'h3';
				}
				if ('undefined' === typeof TitleTag || '' === TitleTag) {
					TitleTag = 'h3';
				}
			}
			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': !isEmpty(animate) ? animationType : null },
				['bottom' === dividerStyle ? null : React.createElement('div', { className: 'vertical-divider top', style: { background: !isEmpty(dividerColor) ? dividerColor : null } }), 'undefined' != typeof captionContent && '' != captionContent ? React.createElement(
					CaptionTag,
					{ className: captionClass, style: { color: !isEmpty(captionColor) ? captionColor : null } },
					' ',
					captionContent,
					' '
				) : null, React.createElement(
					'div',
					{ className: 'special-heading ' },
					React.createElement(
						TitleTag,
						{ className: 'special-h-tag', style: { color: !isEmpty(titleColor) ? titleColor : null } },
						' ',
						titleContent,
						' '
					)
				), 'top' === dividerStyle ? null : React.createElement('div', { className: 'vertical-divider bottom', style: { background: !isEmpty(dividerColor) ? dividerColor : null } })]
			);
		}

	});
	module.exports = SpecialHeadingStyle4;

/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var SpecialHeadingStyle5 = React.createClass({
		displayName: 'SpecialHeadingStyle5',


		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-heading-wrap style5 ',
			    animate = atts.get('animate'),
			    titleAlignment = atts.get('title_alignment'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			if (!isEmpty(titleAlignment)) {
				wrapperClass = wrapperClass + 'align-' + titleAlignment + ' ';
			}
			return wrapperClass;
		},

		getCaptionTag: function (atts) {

			var captionTag = 'div',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont) && 'body' != captionFont && 'special' != captionFont) {
				captionTag = captionFont;
			}
			return captionTag;
		},

		getCaptionClass: function (atts) {

			var captionClass = 'caption ',
			    captionFont = atts.get('caption_font');
			if (!isEmpty(captionFont)) {
				if ('body' === captionFont) {
					captionClass = captionClass + 'body-font';
				} else if ('special' === captionFont) {
					captionClass = captionClass + 'special-subtitle';
				}
			}
			return captionClass;
		},

		render: function () {

			var specialHeading = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = specialHeading.get('atts'),
			    CaptionTag = 'div',
			    captionClass = '',
			    TitleTag = 'h3',
			    wrapperClass = '',
			    animate = '',
			    animationType = '',
			    titleColor = '',
			    captionColor = '',
			    titleContent = '',
			    captionContent = '';
			if (!isEmpty(atts)) {
				animate = atts.get('animate');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				wrapperClass = this.getWrapperClass(atts);
				CaptionTag = this.getCaptionTag(atts);
				captionClass = this.getCaptionClass(atts);
				TitleTag = atts.get('h_tag');
				titleContent = atts.get('title_content');
				captionContent = atts.get('caption_content');
				titleColor = atts.get('title_color');
				captionColor = atts.get('caption_color');
				if ('undefined' === typeof CaptionTag || '' === CaptionTag) {
					CaptionTag = 'h3';
				}
				if ('undefined' === typeof TitleTag || '' === TitleTag) {
					TitleTag = 'h3';
				}
			}
			return React.createElement(
				'div',
				{ className: wrapperClass, 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: 'special-heading' },
					React.createElement(
						TitleTag,
						{ className: 'special-h-tag', style: { color: !isEmpty(titleColor) ? titleColor : null } },
						titleContent
					)
				),
				React.createElement(
					'div',
					{ className: 'caption-wrap' },
					React.createElement(
						CaptionTag,
						{ className: captionClass, style: { color: !isEmpty(captionColor) ? captionColor : null } },
						captionContent
					)
				)
			);
		}
	});
	module.exports = SpecialHeadingStyle5;

/***/ }),
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);
	var SpecialHeading6 = React.createClass({
	    displayName: 'SpecialHeading6',


	    render: function () {

	        var specialHeading6 = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = specialHeading6.get('atts'),
	            animate = '',
	            animationType = '',
	            title = '',
	            titleColor = '',
	            titleHoverColor = '',
	            fontSize = '',
	            borderColor = '',
	            margin = '',
	            letterSpacing = '',
	            expandOnHover = false,
	            alignment = 'left',
	            borderStyle = 'style1';
	        if (!isEmpty(atts)) {
	            animate = atts.get('animate');
	            if (!isEmpty(animate)) {
	                animationType = atts.get('animation_type');
	            }
	            title = atts.get('title_content') || '';
	            margin = atts.get('margin') || '0px';
	            titleColor = atts.get('title_color');
	            titleHoverColor = atts.get('title_hover_color');
	            borderColor = atts.get('border_color');
	            fontSize = atts.get('font_size');
	            alignment = atts.get('alignment');
	            borderStyle = atts.get('border_style');
	            expandOnHover = atts.get('expand_border');
	            letterSpacing = atts.get('letter_spacing');
	        }

	        return React.createElement(
	            'div',
	            { className: "oshine-module special-heading-wrap style6 " + (!isEmpty(animate) ? "be-animate " : ""), style: { fontSize: !isEmpty(fontSize) ? fontSize : '14px', textAlign: !isEmpty(alignment) ? alignment : 'left', margin: margin }, 'data-animation': !isEmpty(animate) ? animationType : null },
	            React.createElement(
	                'div',
	                { className: "special-heading-inner-wrap" + (!isEmpty(borderStyle) ? " be-border-" + borderStyle : "") + (!isEmpty(expandOnHover) ? " be-expand" : ""), 'data-hover-title-color': !isEmpty(titleHoverColor) ? titleHoverColor : null, 'data-title-color': !isEmpty(titleColor) ? titleColor : null },
	                React.createElement('div', { className: 'be-border', style: { background: !isEmpty(borderColor) ? borderColor : null } }),
	                React.createElement(
	                    'h6',
	                    { className: 'be-title', style: { color: !isEmpty(titleColor) ? titleColor : null, fontSize: 'inherit', letterSpacing: !isEmpty(letterSpacing) ? letterSpacing : null } },
	                    "string" === typeof title ? title : ""
	                )
	            )
	        );
	    }

	});
	module.exports = SpecialHeading6;

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    parseValue = __webpack_require__(3);
	var SpecialSubTitle = React.createClass({
		displayName: 'SpecialSubTitle',


		getWrapperClass: function (atts) {

			var wrapperClass = 'oshine-module special-subtitle-wrap ',
			    animate = atts.get('animate'),
			    scrollToAnimate = atts.get('scroll_to_animate');
			if (!isEmpty(animate)) {
				wrapperClass = wrapperClass + 'be-animate ';
			}
			if (!isEmpty(scrollToAnimate)) {
				wrapperClass = wrapperClass + 'scrollToFade ';
			}
			return wrapperClass;
		},

		getTitleStyle: function (atts, specialSubTitle, moduleOptions) {

			var titleStyle = {},
			    moduleName = specialSubTitle.get('name'),
			    fontSize = parseValue(moduleName, 'font_size', atts.get('font_size'), moduleOptions),
			    titleColor = atts.get('title_color'),
			    maxWidth = parseValue(moduleName, 'max_width', atts.get('max_width'), moduleOptions);
			if ('string' === typeof fontSize && '' != fontSize.replace(/\D+/, '') && !isNaN(fontSize.replace(/\D+/, ''))) {
				titleStyle.fontSize = fontSize;
			}
			if (!isEmpty(titleColor)) {
				titleStyle.color = titleColor;
			}
			if ('string' === typeof maxWidth && '' != maxWidth.replace(/\D+/, '') && !isNaN(maxWidth.replace(/\D+/, ''))) {
				titleStyle.maxWidth = maxWidth;
			}
			return titleStyle;
		},

		render: function () {

			var specialSubTitle = this.props.module,
			    moduleOptions = this.props.moduleOptions,
			    atts = specialSubTitle.get('atts'),
			    wrapperClass = '',
			    animate = '',
			    animationType = '',
			    titleContent = '',
			    titleStyle = {},
			    bottomMargin = '0',
			    alignment = '';
			if (!isEmpty(atts)) {
				wrapperClass = this.getWrapperClass(atts);
				titleStyle = this.getTitleStyle(atts, specialSubTitle, moduleOptions);
				bottomMargin = parseValue(specialSubTitle.get('name'), 'margin_bottom', atts.get('margin_bottom'), moduleOptions);
				alignment = atts.get('title_alignment');
				animate = atts.get('animate');
				titleContent = atts.get('title_content');
				if (!isEmpty(animate)) {
					animationType = atts.get('animation_type');
				}
				if ('string' === typeof bottomMargin && '' != bottomMargin.replace(/\D+/, '') && !isNaN(bottomMargin.replace(/\D+/, ''))) {
					bottomMargin = bottomMargin;
				} else {
					bottomMargin = null;
				}
			}
			return React.createElement(
				'div',
				{ className: wrapperClass, style: { marginBottom: bottomMargin }, 'data-animation': !isEmpty(animate) ? animationType : null },
				React.createElement(
					'div',
					{ className: "align-" + alignment },
					'undefined' != typeof titleContent ? React.createElement(
						'span',
						{ className: 'special-subtitle', style: titleStyle },
						' ',
						titleContent,
						' '
					) : null
				)
			);
		}

	});
	module.exports = SpecialSubTitle;

/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var MenuCard = React.createClass({
	    displayName: 'MenuCard',


	    render: function () {
	        var menuCard = this.props.module,
	            atts = menuCard.get('atts'),
	            title,
	            ingredients,
	            price,
	            titleColor,
	            ingredientsColor,
	            priceColor,
	            highlight,
	            highlightColor,
	            star,
	            starColor,
	            borderColor,
	            animate,
	            animationType;
	        if (!isEmpty(atts)) {
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = null;
	            }
	            ingredients = atts.get('ingredients');
	            if (isEmpty(ingredients)) {
	                ingredients = null;
	            }
	            price = atts.get('price');
	            if (isEmpty(price)) {
	                price = null;
	            }
	            titleColor = atts.get('title_color');
	            if (isEmpty(titleColor)) {
	                titleColor = null;
	            }
	            ingredientsColor = atts.get('ingredients_color');
	            if (isEmpty(ingredientsColor)) {
	                ingredientsColor = null;
	            }
	            priceColor = atts.get('price_color');
	            if (isEmpty(priceColor)) {
	                priceColor = null;
	            }
	            highlight = atts.get('highlight');
	            if (!isEmpty(highlight)) {
	                highlight = 'highlight-menu-item';
	            } else {
	                highlight = '';
	            }
	            highlightColor = atts.get('highlight_color');
	            if (isEmpty(highlightColor) || 'highlight-menu-item' != highlight) {
	                highlightColor = null;
	            }
	            star = atts.get('star');
	            if (isEmpty(star)) {
	                star = null;
	            }
	            starColor = atts.get('star_color');
	            if (isEmpty(starColor)) {
	                starColor = null;
	            }
	            borderColor = atts.get('border_color');
	            if (isEmpty(borderColor)) {
	                borderColor = null;
	            }
	            animate = atts.get('animate');
	            if (!isEmpty(animate)) {
	                animate = 'be-animate';
	                animationType = atts.get('animation_type');
	                if (isEmpty(animationType)) {
	                    animationType = 'fadeIn';
	                }
	            } else {
	                animate = '';
	            }
	        }
	        return React.createElement(
	            'div',
	            { className: 'menu-card-item oshine-module ' + animate + ' clearfix ' + highlight, 'data-animation': animationType, style: { backgroundColor: highlightColor, borderColor: borderColor } },
	            React.createElement(
	                'div',
	                { className: 'menu-card-item-info' },
	                React.createElement(
	                    'span',
	                    { className: 'h6-font menu-card-title', style: { color: titleColor } },
	                    ' ',
	                    title,
	                    ' '
	                ),
	                React.createElement(
	                    'span',
	                    { className: 'menu-card-ingredients special-subtitle', style: { color: ingredientsColor } },
	                    ' ',
	                    ingredients,
	                    ' '
	                ),
	                React.createElement(
	                    'span',
	                    { className: 'menu-card-item-price', style: { color: priceColor } },
	                    ' ',
	                    price,
	                    ' '
	                ),
	                star ? React.createElement('i', { className: 'icon-icon_star menu-card-item-stared alt-color', style: { color: starColor } }) : null
	            )
	        );
	    }
	});

	module.exports = MenuCard;

/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    jsTrigger = __webpack_require__(27),
	    TabHeader = __webpack_require__(28),
	    TabPane = __webpack_require__(29);

	var Tabs = React.createClass({
	    displayName: 'Tabs',


	    render: function () {
	        var tabsCount = 0,
	            tabs = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = tabs.get('atts'),
	            children = tabs.get('inner') || Immutable.List(),
	            tabsCount = children.size;
	        return React.createElement(
	            'div',
	            { className: 'tabs oshine-module' },
	            React.createElement(
	                'ul',
	                { className: 'clearfix be-tab-header' },
	                children.map(function (tab) {

	                    return React.createElement(TabHeader, { key: tab.get('id'), tabsCount: tabsCount, module: tab, moduleOptions: moduleOptions });
	                })
	            ),
	            children.map(function (tab) {
	                return React.createElement(TabPane, { key: tab.get('id'), tabsCount: tabsCount, module: tab, moduleOptions: moduleOptions });
	            })
	        );
	    }
	});

	module.exports = Tabs;

/***/ }),
/* 27 */
/***/ (function(module, exports) {

	module.exports = function jsTrigger(moduleName, moduleId) {

	        var data = {
	                type: 'jstrigger',
	                moduleName: moduleName,
	                shouldUpdate: true,
	                moduleId: moduleId ? moduleId : ''
	        },
	            jsonData = JSON.stringify(data);
	        document.getElementById('tatsu-preview').contentWindow.postMessage(jsonData, '*');
	};

/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var TabHeader = React.createClass({
	    displayName: 'TabHeader',

	    render: function () {
	        var tabHeader = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            tabsCount = this.props.tabsCount,
	            rand = tabHeader.get('id'),
	            atts = tabHeader.get('atts'),
	            icon,
	            title,
	            titleColor;

	        if (!isEmpty(atts)) {
	            icon = atts.get('icon');
	            if (!isEmpty(icon)) {
	                icon = 'tab-icon ' + icon;
	            } else {
	                icon = '';
	            }
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = '';
	            }
	            titleColor = atts.get('title_color');
	            if (isEmpty(titleColor)) {
	                titleColor = '';
	            }
	        }
	        return React.createElement(
	            'li',
	            null,
	            React.createElement(
	                'a',
	                { className: icon, href: '#fragment-' + tabsCount + '-' + rand, style: { color: titleColor } },
	                title
	            )
	        );
	    }
	});

	module.exports = TabHeader;

/***/ }),
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var TabPane = React.createClass({
	    displayName: 'TabPane',


	    render: function () {
	        var tabPane = this.props.module,
	            tabsCount = this.props.tabsCount,
	            atts = tabPane.get('atts'),
	            id,
	            content;
	        id = tabPane.get('id');
	        if (isEmpty(id)) {
	            id = '';
	        }
	        content = atts.get('content');
	        if (isEmpty(content)) {
	            content = '';
	        }
	        return React.createElement('div', { id: 'fragment-' + tabsCount + '-' + id, dangerouslySetInnerHTML: { __html: content }, className: 'clearfix be-tab-content' });
	    }
	});

	module.exports = TabPane;

/***/ }),
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    jsTrigger = __webpack_require__(27),
	    Toggle = __webpack_require__(31);

	var Accordion = React.createClass({
	    displayName: 'Accordion',


	    render: function () {

	        var accordion = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = accordion.get('atts'),
	            children = accordion.get('inner') || Immutable.List(),
	            toggle = Immutable.List(),
	            collapsed;
	        if (!isEmpty(atts)) {
	            collapsed = atts.get('collapsed');
	            if (isEmpty(collapsed)) {
	                collapsed = 0;
	            }
	        }

	        children.forEach(function (toggleItem) {
	            var atts = toggleItem.get('atts'),
	                content;
	            content = atts.get('content');
	            if (isEmpty(content)) {
	                content = '';
	            }
	            toggle = toggle.push(React.createElement(Toggle, { module: toggleItem, moduleOptions: moduleOptions }));
	            toggle = toggle.push(React.createElement('div', { dangerouslySetInnerHTML: { __html: content } }));
	        });

	        return React.createElement(
	            'div',
	            { className: 'accordion oshine-module', 'data-collapsed': collapsed },
	            toggle
	        );
	    }
	});

	module.exports = Accordion;

/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var Toggle = React.createClass({
	    displayName: 'Toggle',


	    getToggleStyle: function (atts) {

	        var toggleStyle = {},
	            titleColor,
	            titleBgColor;
	        titleColor = atts.get('title_color');
	        if (!isEmpty(titleColor)) {
	            toggleStyle.color = titleColor;
	        }
	        titleBgColor = atts.get('title_bg_color');
	        if (!isEmpty(titleBgColor)) {
	            toggleStyle.backgroundColor = titleBgColor;
	            toggleStyle.padding = '12px';
	        }
	        return toggleStyle;
	    },

	    render: function () {

	        var toggle = this.props.module,
	            atts = toggle.get('atts'),
	            style = 'no-bg',
	            title,
	            titleBgColor,
	            toggleStyle;

	        if (!isEmpty(atts)) {
	            toggleStyle = this.getToggleStyle(atts);
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = '';
	            }
	            titleBgColor = atts.get('title_bg_color');
	            if (!isEmpty(titleBgColor)) {
	                style = 'with-bg';
	            }
	        }
	        return React.createElement(
	            'h3',
	            { className: 'accordion-head ' + style, style: toggleStyle },
	            title
	        );
	    }
	});

	module.exports = Toggle;

/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    jsTrigger = __webpack_require__(27),
	    AnimateIconStyle1 = __webpack_require__(33);

	var AnimateIconsStyle1 = React.createClass({
	    displayName: 'AnimateIconsStyle1',


	    render: function () {

	        var animateIconsStyle1 = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = animateIconsStyle1.get('atts'),
	            children = animateIconsStyle1.get('inner') || Immutable.List(),
	            height,
	            gutter;

	        height = atts.get('height');
	        if (isEmpty(height)) {
	            height = 300;
	        }
	        gutter = atts.get('gutter');
	        if (isEmpty(gutter)) {
	            gutter = 0;
	        }

	        return React.createElement(
	            'div',
	            { className: 'oshine-module display-block' },
	            React.createElement(
	                'div',
	                { className: 'animate-icon-module-style1-wrap-container' },
	                React.createElement(
	                    'div',
	                    { className: 'animate-icon-module-style1-wrap clearfix', style: { height: height }, 'data-gutter-width': gutter },
	                    children.map(function (animateIcon) {
	                        return React.createElement(AnimateIconStyle1, { gutter: gutter, module: animateIcon, moduleOptions: moduleOptions });
	                    })
	                )
	            )
	        );
	    }

	});

	module.exports = AnimateIconsStyle1;

/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var AnimateIconStyle1 = React.createClass({
	    displayName: 'AnimateIconStyle1',


	    render: function () {
	        var animateIconStyle1 = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            beAnimateIconStyle1Gutter = this.props.gutter,
	            atts = animateIconStyle1.get('atts'),
	            icon,
	            title,
	            TitleFont,
	            size,
	            iconColor,
	            linkToUrl,
	            height,
	            bgImage,
	            bgColor,
	            hoverBgColor,
	            bgOverlay,
	            overlayColor,
	            hoverOverlayColor,
	            hoverOverlayOpacity,
	            animateDirection,
	            bgOverlayClass,
	            content,
	            style = {};

	        if (!isEmpty(atts)) {
	            icon = atts.get('icon');
	            if (isEmpty(icon)) {
	                icon = '';
	            }
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = null;
	            }
	            TitleFont = atts.get('title_font');
	            if (isEmpty(TitleFont)) {
	                TitleFont = 'h6';
	            }
	            size = atts.get('size');
	            if (isEmpty(size)) {
	                size = 30;
	            }
	            iconColor = atts.get('icon_color');
	            if (isEmpty(iconColor)) {
	                iconColor = '';
	            }
	            linkToUrl = atts.get('link_to_url');
	            if (isEmpty(linkToUrl)) {
	                linkToUrl = '#';
	            }
	            height = atts.get('height');
	            if (isEmpty(height)) {
	                height = '';
	            }
	            bgImage = atts.get('bg_image');
	            if (isEmpty(bgImage)) {
	                bgImage = '';
	            }
	            bgColor = atts.get('bg_color');
	            if (isEmpty(bgColor)) {
	                bgColor = 'transparent';
	            }
	            hoverBgColor = atts.get('hover_bg_color');
	            if (isEmpty(hoverBgColor)) {
	                hoverBgColor = bgColor;
	            }
	            bgOverlay = atts.get('bg_overlay');
	            if (isEmpty(bgOverlay)) {
	                bgOverlay = 0;
	            }
	            overlayColor = atts.get('overlay_color');
	            if (isEmpty(overlayColor)) {
	                overlayColor = '';
	            }
	            hoverOverlayColor = atts.get('hover_overlay_color');
	            if (isEmpty(hoverOverlayColor)) {
	                hoverOverlayColor = '';
	            }
	            hoverOverlayOpacity = atts.get('hover_overlay_opacity');
	            if (isEmpty(hoverOverlayOpacity)) {
	                hoverOverlayOpacity = '';
	            }
	            animateDirection = atts.get('animate_direction');
	            if (isEmpty(animateDirection)) {
	                animateDirection = 'top';
	            }
	            if (!isEmpty(bgOverlay)) {
	                bgOverlayClass = 'ai-has-overlay';
	            } else {
	                bgOverlayClass = '';
	            }
	            content = atts.get('content');
	            if (isEmpty(content)) {
	                content = '';
	            }
	            style.marginBottom = beAnimateIconStyle1Gutter + 'px';
	            if (!isEmpty(bgImage)) {
	                style.background = 'url(' + bgImage + ')';
	            }
	            style.backgroundColor = bgColor;

	            return React.createElement(
	                'a',
	                { href: linkToUrl, className: 'animate-icon-module-style1 be-bg-cover animate-icon-module ' + bgOverlayClass + ' ' + animateDirection + '-animate', 'data-bg-color': bgColor, 'data-hover-bg-color': hoverBgColor, style: style },
	                React.createElement(
	                    'div',
	                    { className: 'animate-icon-module-normal-content' },
	                    React.createElement(
	                        'div',
	                        { className: 'display-table' },
	                        React.createElement(
	                            'div',
	                            { className: 'display-table-cell vertical-align-middle' },
	                            React.createElement('i', { className: 'font-icon ' + icon, style: { fontSize: size + 'px', color: iconColor } }),
	                            title ? React.createElement(
	                                TitleFont,
	                                { className: 'title_content', style: { color: iconColor } },
	                                ' ',
	                                title
	                            ) : null
	                        )
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'animate-icon-module-hover-content' },
	                    React.createElement(
	                        'div',
	                        { className: 'display-table' },
	                        React.createElement('div', { className: 'display-table-cell vertical-align-middle', dangerouslySetInnerHTML: { __html: content } })
	                    )
	                ),
	                !isEmpty(bgOverlay) && !isEmpty(bgImage) ? React.createElement('div', { className: 'ai-overlay', style: { background: overlayColor }, 'data-bg-color': overlayColor, 'data-hover-bg-color': hoverOverlayColor }) : null
	            );
	        }
	    }

	});

	module.exports = AnimateIconStyle1;

/***/ }),
/* 34 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    jsTrigger = __webpack_require__(27),
	    AnimateIconStyle2 = __webpack_require__(35);

	var AnimateIconsStyle2 = React.createClass({
	    displayName: 'AnimateIconsStyle2',


	    render: function () {

	        var animateIconsStyle2 = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = animateIconsStyle2.get('atts'),
	            children = animateIconsStyle2.get('inner') || Immutable.List();

	        return React.createElement(
	            'div',
	            { className: 'oshine-module animate-icon-module-style2-wrap clearfix' },
	            children.map(function (animateIcon) {
	                return React.createElement(AnimateIconStyle2, { module: animateIcon, moduleOptions: moduleOptions });
	            })
	        );
	    }

	});

	module.exports = AnimateIconsStyle2;

/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var AnimateIconStyle2 = React.createClass({
	    displayName: 'AnimateIconStyle2',


	    render: function () {
	        var animateIconStyle2 = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = animateIconStyle2.get('atts'),
	            icon,
	            size,
	            iconColor,
	            iconColorHoverState,
	            title,
	            Htag,
	            titleColor,
	            titleColorHoverState,
	            bgColor,
	            hoverBgColor,
	            content;

	        if (!isEmpty(atts)) {
	            icon = atts.get('icon');
	            if (isEmpty(icon)) {
	                icon = '';
	            }
	            size = atts.get('size');
	            if (isEmpty(size)) {
	                size = 30;
	            }
	            Htag = atts.get('h_tag');
	            if (isEmpty(Htag)) {
	                Htag = 'h6';
	            }
	            iconColor = atts.get('icon_color');
	            if (isEmpty(iconColor)) {
	                iconColor = 'initial';
	            }
	            iconColorHoverState = atts.get('icon_color_hover_state');
	            if (isEmpty(iconColorHoverState)) {
	                iconColorHoverState = iconColor;
	            }
	            titleColor = atts.get('title_color');
	            if (isEmpty(titleColor)) {
	                titleColor = 'initial';
	            }
	            titleColorHoverState = atts.get('title_color_hover_state');
	            if (isEmpty(titleColorHoverState)) {
	                titleColorHoverState = titleColor;
	            }
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = '';
	            }
	            bgColor = atts.get('bg_color');
	            if (isEmpty(bgColor)) {
	                bgColor = 'transparent';
	            }
	            hoverBgColor = atts.get('hover_bg_color');
	            if (isEmpty(hoverBgColor)) {
	                hoverBgColor = bgColor;
	            }
	            content = atts.get('content');
	            if (isEmpty(content)) {
	                content = '';
	            }
	            return React.createElement(
	                'div',
	                { className: 'animate-icon-module-style2', 'data-bg-color': bgColor, 'data-hover-bg-color': hoverBgColor, 'data-title-color': titleColor, 'data-hover-title-color': titleColorHoverState, 'data-icon-color': iconColor, 'data-hover-icon-color': iconColorHoverState, style: { backgroundColor: bgColor } },
	                React.createElement(
	                    'div',
	                    { className: 'animate-icon-module-style2-inner-wrap' },
	                    React.createElement(
	                        'div',
	                        { className: 'animate-icon-module-style2-normal-content clearfix' },
	                        React.createElement('i', { className: 'animate-icon-icon font-icon ' + icon, style: { fontSize: size + 'px', color: iconColor } }),
	                        title ? React.createElement(
	                            Htag,
	                            { className: 'animate-icon-title', style: { color: titleColor } },
	                            title
	                        ) : null
	                    ),
	                    React.createElement('div', { className: 'animate-icon-module-style2-hover-content clearfix', dangerouslySetInnerHTML: { __html: content } })
	                )
	            );
	        }
	    }

	});

	module.exports = AnimateIconStyle2;

/***/ }),
/* 36 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2);

	var Team = React.createClass({
	    displayName: 'Team',


	    getIcon: function (atts) {
	        'use strict';

	        var facebook,
	            twitter,
	            dribbble,
	            googlePlus,
	            linkedin,
	            youtube,
	            vimeo,
	            email,
	            iconLi = Immutable.List(),
	            iconBgColor,
	            iconColor,
	            iconHoverColor,
	            iconHoverBgColor,
	            smediaIconPosition,
	            overlayColor,
	            titleStyle,
	            thumbOverlayColor,
	            style = {};

	        iconBgColor = atts.get('icon_bg_color');
	        if (isEmpty(iconBgColor)) {
	            iconBgColor = 'transparent';
	        } else {
	            style.backgroundColor = iconBgColor;
	        }
	        iconColor = atts.get('icon_color');
	        if (isEmpty(iconColor)) {
	            iconColor = 'inherit';
	        } else {
	            style.color = iconColor;
	        }
	        iconHoverColor = atts.get('icon_hover_color');
	        if (isEmpty(iconHoverColor)) {
	            iconHoverColor = '';
	        }
	        iconHoverBgColor = atts.get('icon_hover_bg_color');
	        if (isEmpty(iconHoverBgColor)) {
	            iconHoverBgColor = '';
	        }
	        titleStyle = atts.get('title_style');
	        if (isEmpty(titleStyle)) {
	            titleStyle = 'style3';
	        }
	        smediaIconPosition = atts.get('smedia_icon_position');
	        if (isEmpty(smediaIconPosition)) {
	            smediaIconPosition = 'over';
	        }
	        if ('style3' == titleStyle) {
	            smediaIconPosition = 'over';
	        }
	        overlayColor = atts.get('overlay_color');
	        if (isEmpty(overlayColor)) {
	            overlayColor = '';
	            thumbOverlayColor = '';
	        } else {
	            thumbOverlayColor = overlayColor;
	        }
	        facebook = atts.get('facebook');
	        twitter = atts.get('twitter');
	        dribbble = atts.get('dribbble');
	        googlePlus = atts.get('google_plus');
	        linkedin = atts.get('linkedin');
	        youtube = atts.get('youtube');
	        vimeo = atts.get('vimeo');
	        email = atts.get('email');

	        if (!isEmpty(facebook) || !isEmpty(twitter) || !isEmpty(dribbble) || !isEmpty(googlePlus) || !isEmpty(linkedin) || !isEmpty(youtube) || !isEmpty(vimeo) || !isEmpty(email)) {
	            if (!isEmpty(facebook)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: facebook, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-facebook' })
	                    )
	                ));
	            }
	            if (!isEmpty(twitter)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: twitter, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-twitter' })
	                    )
	                ));
	            }
	            if (!isEmpty(googlePlus)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: googlePlus, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-gplus' })
	                    )
	                ));
	            }
	            if (!isEmpty(linkedin)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: linkedin, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-linkedin' })
	                    )
	                ));
	            }
	            if (!isEmpty(youtube)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: youtube, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-youtube' })
	                    )
	                ));
	            }
	            if (!isEmpty(dribbble)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: dribbble, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-dribbble' })
	                    )
	                ));
	            }
	            if (!isEmpty(vimeo)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: vimeo, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-vimeo' })
	                    )
	                ));
	            }
	            if (!isEmpty(email)) {
	                iconLi = iconLi.push(React.createElement(
	                    'li',
	                    { className: 'icon-shortcode' },
	                    React.createElement(
	                        'a',
	                        { href: email, className: 'font-icon tatsu-icon team_icons', target: '_blank', 'data-bg-color': !isEmpty(iconBgColor) ? iconBgColor : 'transparent', 'data-color': !isEmpty(iconColor) ? iconColor : 'inherit', 'data-hover-color': !isEmpty(iconHoverColor) ? iconHoverColor : iconColor, 'data-hover-bg-color': !isEmpty(iconHoverBgColor) ? iconHoverBgColor : iconBgColor, style: style },
	                        React.createElement('i', { className: 'icon-email' })
	                    )
	                ));
	            }
	        }
	        return React.createElement(
	            'ul',
	            { className: 'team-social clearfix ' + smediaIconPosition, style: { background: 'over' == smediaIconPosition && 'style3' != titleStyle ? thumbOverlayColor : null } },
	            iconLi
	        );
	    },

	    render: function () {

	        var team = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = team.get('atts'),
	            title,
	            HTag,
	            description,
	            designation,
	            image,
	            titleColor,
	            descriptionColor,
	            designationColor,
	            hoverStyle,
	            titleStyle,
	            smediaIconPosition,
	            titleAlignmentStatic,
	            defaultImageStyle,
	            hoverImageStyle,
	            imageEffect,
	            overlayColor,
	            animate,
	            animationType,
	            iconDefaultColor,
	            imgGrayscale,
	            icon,
	            thumbOverlayColor;

	        if (!isEmpty(atts)) {
	            title = atts.get('title');
	            if (isEmpty(title)) {
	                title = '';
	            }
	            HTag = atts.get('h_tag');
	            if (isEmpty(HTag)) {
	                HTag = 'H6';
	            }
	            description = atts.get('description');
	            if (isEmpty(description)) {
	                description = '';
	            }
	            designation = atts.get('designation');
	            if (isEmpty(designation)) {
	                designation = '';
	            }
	            image = atts.get('image');
	            if (isEmpty(image)) {
	                image = '';
	            }
	            titleColor = atts.get('title_color');
	            if (isEmpty(titleColor)) {
	                titleColor = null;
	            }
	            descriptionColor = atts.get('description_color');
	            if (isEmpty(descriptionColor)) {
	                descriptionColor = '';
	            }
	            designationColor = atts.get('designation_color');
	            if (isEmpty(designationColor)) {
	                designationColor = '';
	            }
	            hoverStyle = atts.get('hover_style');
	            if (isEmpty(hoverStyle)) {
	                hoverStyle = 'style1-hover';
	            }
	            titleStyle = atts.get('title_style');
	            if (isEmpty(titleStyle)) {
	                titleStyle = 'style3';
	            }
	            smediaIconPosition = atts.get('smedia_icon_position');
	            if (isEmpty(smediaIconPosition)) {
	                smediaIconPosition = 'over';
	            }
	            if ('style3' == titleStyle) {
	                smediaIconPosition = 'over';
	            }
	            titleAlignmentStatic = atts.get('title_alignment_static');
	            if (isEmpty(titleAlignmentStatic) && 'style5' != titleStyle) {
	                titleAlignmentStatic = '';
	            }
	            defaultImageStyle = atts.get('default_image_style');
	            if (isEmpty(defaultImageStyle)) {
	                defaultImageStyle = 'color';
	            }
	            hoverImageStyle = atts.get('hover_image_style');
	            if (isEmpty(hoverImageStyle)) {
	                hoverImageStyle = 'color';
	            }
	            imageEffect = atts.get('image_effect');
	            if (isEmpty(imageEffect)) {
	                imageEffect = 'none';
	            }
	            overlayColor = atts.get('overlay_color');
	            if (isEmpty(overlayColor)) {
	                overlayColor = '';
	                thumbOverlayColor = '';
	            } else {
	                thumbOverlayColor = overlayColor;
	            }
	            animate = atts.get('animate');
	            if (!isEmpty(animate)) {
	                animate = ' be-animate';
	            } else {
	                animate = '';
	            }
	            animationType = atts.get('animation_type');
	            if (isEmpty(animationType)) {
	                animationType = 'fadeIn';
	            }
	            if ('black_white' == defaultImageStyle) {
	                if ('black_white' == hoverImageStyle) {
	                    imgGrayscale = 'bw_to_bw';
	                } else {
	                    imgGrayscale = 'bw_to_c';
	                }
	            } else {
	                if ('black_white' == hoverImageStyle) {
	                    imgGrayscale = 'c_to_bw';
	                } else {
	                    imgGrayscale = 'c_to_c';
	                }
	            }
	            icon = this.getIcon(atts);
	            if ('style5' == titleStyle) {
	                hoverStyle = '';
	            }
	        }

	        return React.createElement(
	            'div',
	            { className: 'team-shortcode-wrap oshine-module ' + animate, 'data-animation': animationType },
	            React.createElement(
	                'div',
	                { className: 'element ' + hoverStyle + ' ' + imgGrayscale + ' ' + titleStyle + '-title' },
	                React.createElement(
	                    'div',
	                    { className: 'element-inner' },
	                    React.createElement(
	                        'div',
	                        { className: 'flip-wrap' },
	                        React.createElement(
	                            'div',
	                            { className: 'flip-img-wrap ' + imageEffect + '-effect' },
	                            React.createElement('img', { src: image, alt: title }),
	                            'over' == smediaIconPosition && 'style3' != titleStyle ? icon : null
	                        )
	                    ),
	                    React.createElement(
	                        'div',
	                        { className: 'thumb-overlay' },
	                        React.createElement(
	                            'div',
	                            { className: 'thumb-bg', style: { background: 'style3' == titleStyle ? thumbOverlayColor : null } },
	                            React.createElement(
	                                'div',
	                                { className: 'display-table' },
	                                React.createElement(
	                                    'div',
	                                    { className: 'display-table-cell vertical-align-middle' },
	                                    React.createElement(
	                                        'div',
	                                        { className: 'team-wrap clearfix', style: { textAlign: titleAlignmentStatic } },
	                                        React.createElement(
	                                            HTag,
	                                            { className: 'team-title', style: { color: titleColor } },
	                                            title
	                                        ),
	                                        React.createElement(
	                                            'p',
	                                            { className: 'designation', style: { color: designationColor } },
	                                            designation
	                                        ),
	                                        React.createElement(
	                                            'p',
	                                            { className: 'team-description', style: { color: descriptionColor } },
	                                            description
	                                        ),
	                                        'below' == smediaIconPosition || 'style3' == titleStyle ? icon : null
	                                    )
	                                )
	                            )
	                        )
	                    )
	                )
	            )
	        );
	    }
	});

	module.exports = Team;

/***/ }),
/* 37 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    findDOMNode = ReactDOM.findDOMNode,
	    jsTrigger = __webpack_require__(27);

	var SvgIcon = React.createClass({
	    displayName: 'SvgIcon',


	    triggerAnimation: false,

	    componentWillReceiveProps: function (nextProps) {

	        var currentAtts = this.props.module.get('atts'),
	            newAtts = nextProps.module.get('atts');
	        if (currentAtts.get('line_animate') != newAtts.get('line_animate') || currentAtts.get('path_animation_type') != newAtts.get('path_animation_type') || currentAtts.get('svg_animation_type') != newAtts.get('svg_animation_type') || currentAtts.get('animation_duration') != newAtts.get('animation_duration') || currentAtts.get('animation_delay') != newAtts.get('animation_delay')) {
	            this.triggerAnimation = true;
	        }
	    },

	    componentDidMount: function () {

	        var atts = this.props.module.get('atts');
	        if (isEmpty(atts.get('alignment'))) {
	            // findDOMNode( this ).parentElement.style.display  = 'inline-block';
	        } else {
	                // findDOMNode( this ).parentElement.style.display  = 'block';
	            }
	    },

	    componentDidUpdate: function () {

	        var atts = this.props.module.get('atts'),
	            animation = atts.get('animate'),
	            moduleName = this.props.module.get('name'),
	            moduleId = this.props.module.get('id'),
	            animationType = atts.get('animation_type');
	        if (isEmpty(atts.get('alignment'))) {
	            findDOMNode(this).parentElement.style.display = 'inline-block';
	        } else {
	            findDOMNode(this).parentElement.style.display = 'block';
	        }
	        if (this.triggerAnimation) {
	            jsTrigger(moduleName, moduleId);
	            this.triggerAnimation = false;
	        } else {
	            var svgElementClassname = this.refs.svgelement;
	            if (svgElementClassname.className.indexOf('svganimated') == -1) {
	                svgElementClassname.className = svgElementClassname.className + ' svganimated';
	            }
	        }
	    },

	    render: function () {

	        var svgIcon = this.props.module,
	            moduleOptions = this.props.moduleOptions,
	            atts = svgIcon.get('atts'),
	            content,
	            size,
	            width,
	            height,
	            color,
	            alignment,
	            lineAnimate,
	            pathAnimationType,
	            svgAnimationType,
	            animationDuration,
	            animationDelay;

	        content = atts.get('content');
	        if (isEmpty(content)) {
	            content = '';
	        }
	        size = atts.get('size');
	        if (isEmpty(size)) {
	            size = 'small';
	        }
	        if ('custom' == size) {
	            width = atts.get('width');
	            if (isEmpty(width)) {
	                width = null;
	            } else {
	                width += 'px';
	            }
	            height = atts.get('height');
	            if (isEmpty(height)) {
	                height = null;
	            } else {
	                height += 'px';
	            }
	        } else {
	            width = null;
	            height = null;
	        }
	        color = atts.get('color');
	        if (isEmpty(color)) {
	            color = null;
	        }
	        alignment = atts.get('alignment');
	        if (isEmpty(alignment)) {
	            alignment = '';
	        }
	        lineAnimate = atts.get('line_animate');
	        if (isEmpty(lineAnimate)) {
	            lineAnimate = '';
	        } else if (lineAnimate == 1) {
	            lineAnimate = 'svg-line-animate ';
	            pathAnimationType = atts.get('path_animation_type');
	            if (isEmpty(pathAnimationType)) {
	                pathAnimationType = null;
	            }
	            svgAnimationType = atts.get('svg_animation_type');
	            if (isEmpty(svgAnimationType)) {
	                svgAnimationType = null;
	            }
	            animationDuration = atts.get('animation_duration');
	            if (isEmpty(animationDuration)) {
	                animationDuration = 0;
	            }
	            animationDelay = atts.get('animation_delay');
	            if (isEmpty(animationDelay)) {
	                animationDelay = 0;
	            }
	        }

	        return React.createElement('div', { ref: 'svgelement', className: 'oshine-svg-icon oshine-module ' + lineAnimate + ' align-' + alignment + ' ' + size, 'data-path-animation': pathAnimationType, 'data-svg-animation': svgAnimationType, 'data-animation-delay': animationDelay, 'data-animation-duration': animationDuration, style: { color: color, width: width, height: height }, dangerouslySetInnerHTML: { __html: content } });
	    }

	});

	module.exports = SvgIcon;

/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

	var isEmpty = __webpack_require__(2),
	    findDOMNode = ReactDOM.findDOMNode;

	var AnimatedLink = React.createClass({
	    displayName: 'AnimatedLink',


	    componentDidMount: function () {

	        var atts = this.props.module.get('atts');
	        if (isEmpty(atts.get('alignment'))) {
	            findDOMNode(this).parentElement.style.display = 'inline-block';
	        } else {
	            findDOMNode(this).parentElement.style.display = 'block';
	        }
	    },

	    componentDidUpdate: function () {

	        var atts = this.props.module.get('atts');
	        if (isEmpty(atts.get('alignment'))) {
	            findDOMNode(this).parentElement.style.display = 'inline-block';
	        } else {
	            findDOMNode(this).parentElement.style.display = 'block';
	        }
	    },

	    render: function () {
	        var animatedLink = this.props.module,
	            atts = animatedLink.get('atts'),
	            linkText,
	            url,
	            fontSize,
	            linkStyle,
	            alignment,
	            color,
	            hoverColor,
	            lineColor,
	            lineHoverColor,
	            animate,
	            animationType,
	            animationDelay;
	        if (!isEmpty(atts)) {
	            linkText = atts.get('link_text');
	            if (isEmpty(linkText)) {
	                linkText = null;
	            }
	            url = atts.get('url');
	            if (isEmpty(url)) {
	                url = null;
	            }
	            fontSize = atts.get('font_size');
	            if (isEmpty(fontSize)) {
	                fontSize = 13;
	            }
	            linkStyle = atts.get('link_style');
	            if (isEmpty(linkStyle)) {
	                linkStyle = 'style1';
	            }
	            alignment = atts.get('alignment');
	            if (isEmpty(alignment)) {
	                alignment = 'none';
	            }
	            color = atts.get('color');
	            if (isEmpty(color)) {
	                color = 'inherit';
	            }
	            hoverColor = atts.get('hover_color');
	            if (isEmpty(hoverColor)) {
	                hoverColor = color;
	            }
	            lineColor = atts.get('line_color');
	            if (isEmpty(lineColor)) {
	                lineColor = color;
	            }
	            lineHoverColor = atts.get('line_hover_color');
	            if (isEmpty(lineHoverColor)) {
	                lineHoverColor = lineColor;
	                if (isEmpty(atts.get('line_color'))) {
	                    lineHoverColor = hoverColor;
	                }
	            }
	            animate = atts.get('animate');
	            if (!isEmpty(animate)) {
	                animate = 'tatsu-animate';
	                animationType = atts.get('animation_type');
	                if (isEmpty(animationType)) {
	                    animationType = 'fadeIn';
	                }
	                animationDelay = atts.get('animation_delay');
	                if (isEmpty(animationDelay)) {
	                    animationDelay = 0;
	                }
	            } else {
	                animate = '';
	            }
	        }
	        return React.createElement(
	            'div',
	            { className: 'oshine-animated-link oshine-module align-' + alignment },
	            React.createElement(
	                'a',
	                { className: 'animated-link-' + linkStyle + ' ' + animate, href: url, style: { color: lineColor, fontSize: fontSize + 'px' }, 'data-animation': animationType, 'data-animation-delay': animationDelay, 'data-line-color': lineColor, 'data-line-hover-color': lineHoverColor },
	                React.createElement(
	                    'span',
	                    { className: 'link-text', style: { color: color }, 'data-color': color, 'data-hover-color': hoverColor },
	                    linkText
	                ),
	                linkStyle == 'style4' || linkStyle == 'style5' ? React.createElement(
	                    'div',
	                    { className: 'next-arrow' },
	                    React.createElement('span', { className: 'arrow-line-one', style: { backgroundColor: lineColor } }),
	                    React.createElement('span', { className: 'arrow-line-two', style: { backgroundColor: lineColor } }),
	                    React.createElement('span', { className: 'arrow-line-three', style: { backgroundColor: lineColor } })
	                ) : null
	            )
	        );
	    }
	});

	module.exports = AnimatedLink;

/***/ })
/******/ ]);