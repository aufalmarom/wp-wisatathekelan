/*!
 * sticky sections v0.1
 * https://bitbucket.org/ram_brandexponents/snapped-sections
 * @license MIT licensed
 * 
 * Copyright (C) 20l18 - A project by Ram Subramanian
 */
(function( root, window, document, factory, undefined ) {
    if ( 'function' == typeof define  && define.amd) {
        define( function($) {
          return factory( window, document, undefined );
        } );
    } else if ( 'object' == typeof exports) {
        module.exports = factory( window, document, undefined );
    } else {
        window.stickySections = factory( window, document, undefined );
    }
})( this, window, document, function( window, document, undefined ) {

    //keeping centeral set of classnames and its corresponding selectors
    var stickyWrapper = 'sticky-sections-wrap',
        stickyWrapperSelector = '.' + stickyWrapper,
        enabled = 'sticky-enabled',
        enabledSelector = '.' + enabled,
        destroyed = 'sticky-destroyed',
        destroyedSelector = '.' + destroyed,
        responsive = 'sticky-sections-responsive',
        responsiveSelector = '.' + responsive,
        active = 'sticky-current-active',
        dotsNavigation = 'sticky-dots-navigation',
        dotsNavigationSelector = '#' + dotsNavigation,
        activeDot = 'sticky-dot-active',
        activeDotSelector = '.' + activeDot,
        singleDot = 'sticky-nav-dot',
        singleDotSelector = '.' + singleDot,
        activeSelector = '.' + active,
        noTransition = 'sticky-disable-animation',
        noTransitionSelector = '.' + noTransition,
        autoHeight = 'sticky-auto-height',
        autoHeightSelector = '.' + autoHeight,
        overflowSection = 'sticky-overflow',
        overflowSectionSelector = '.' + overflowSection,
        transComplete = 'sticky-visible',
        transCompleteSelector = '.' + transComplete,
        overlay = 'sticky-overlay',
        overlaySelector = '.' + overlay,
        section = 'sticky-section',
        sectionSelector = '.' + section;

    //globals
    var options,
        isTouchDevice = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|playbook|silk|BlackBerry|BB10|Windows Phone|Tizen|Bada|webOS|IEMobile|Opera Mini)/),
        isTouch = (('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints)),
        windowHeight = getWindowHeight(),
        windowWidth = getWindowWidth(),
        isResizing,
        canScroll = true,
        scrollings = [],
        currentActive = null,
        overlayEle = null,
        scrollingRange,
        prevTime = Date.now(),
        footerParent = null,
        footerHeight = 0,        
        scrollTimeout = null,
        didScroll = false,
        container,
        footerVisible = false,
        fullScreenHeight = windowHeight,
        body = __get( 'body' ),
        html = __get( 'html' );
    function initialize( element, customOptions, callback ) {
        var defaultOptions = {
            autoScroll : true,
            scrollAfterLastSection : null,
            navigationPosition : 'right',
            fixedParent : null,
            navigationColor : '',
            overlay : false,
            scrollCallback : null,
            fullScreenOffset : null,
            footer : '',
            scrollingSpeed : 3000,
            easingcss3 : 'ease',
            activeIndex : -1,
            afterLoad : null,
            dots : false
        };
        options = extend( defaultOptions, customOptions );
        container = __get( element );
        if( "[object HTMLCollection]" == getObjectType( container ) ) {
            container = container[0];
        }
        setUp( callback );
    }

    function setUp( callback ) {
        var stickySections = container.children;
        if( null == container ) {
            triggerError( 'You need a valid HTML element to initialize sticky sections', 'error' );
            return;
        }else {
            removeClass( html, destroyed );
            setFullScreenHeight();
            prepareDOM( stickySections );
            addMouseWheelHandler();
            addResizeHandler();
            addScrollHandler();
            setActive( stickySections );
            if( 960 >= windowWidth ) {
                setResponsive();
            }
            addClass( html, enabled );
            if( isFunction( callback ) ) { 
                callback.call( container, currentActive, getNodeIndex( currentActive ) );
            }
        }
    }

    function initFooter() {
        if( '' != options.footer ) {
            var selectorArray = options.footer,
                wrapper = document.createElement( 'div' );
            wrapper.setAttribute( 'class', 'sticky-footer-wrap' );
            selectorArray.forEach( function( selector ) {

                var element = __get( selector );
                if( null != element ) {
                    footerParent = element.parentElement;
                    footerParent.removeChild( element );
                    wrapper.appendChild( element );
                }

            } );
            if( 0 < wrapper.children.length ) {
                if( null != overlayEle ) {
                    addAdjacentSibling( overlayEle, wrapper, 'beforebegin' );
                }else {
                    container.appendChild( wrapper );
                }
                setFooterHeight();
            }
        }
    }

    function resetFooter() {
       // debugger;
        if( '' != options.footer ) {
            var fixedFooter = __get( '.sticky-footer-wrap' );
            if( null != fixedFooter ) {
                fixedFooter.parentElement.removeChild( fixedFooter );
                if( 0 < fixedFooter.children.length ) {
                    footerParent.appendChild( fixedFooter.children[0] );
                    if( 0 < fixedFooter.children.length ) {
                        footerParent.appendChild( fixedFooter.children[0] );                            
                    }
                }
                footerHeight = 0;
            }
        }
    }

    function setFooterHeight() {
        var footerEle = __get( '.sticky-footer-wrap' );
        if( null != footerEle ) {
            footerHeight = footerEle.offsetHeight;
        }
    }

    function setActive( stickySections ) {
        var activeSection = null;
        if( -1 == options.activeIndex && !hasClass( stickySections, active, false ) ) {
            activeSection = stickySections[0];
        }else if( !isNaN( Number( options.activeIndex ) ) && -1 < Number( options.activeIndex ) ) {
            if( options.activeIndex < stickySections.length ) {
                activeSection = stickySections[ options.activeIndex ];
            }else{
                activeSection = stickySections[0];
            }
        }else {
            activeSection = getElementWithActiveClass();
        }
        updateActive( activeSection, 'down' );
        if( hasClass( currentActive, overflowSection ) ) {
            enableScrollCallback( true );
        }
    }

    function silentMoveTo( targetIndex ) {
        if( targetIndex != getNodeIndex( currentActive ) ) {
            moveTo( targetIndex, true );
        }
    }

    //https://gist.github.com/andjosh/6764939
    function animateScrollTo( element, to, duration ) {
        var start = element.scrollTop,
            change = to - start,
            currentTime = 0,
            increment = 20,
            easeInOutQuad = function(t, b, c, d) {
                t /= d/2;
                if (t < 1) {
                    return c/2*t*t + b;
                }
                t--;
                return -c/2 * (t*(t-2) - 1) + b;                
            },
            animateScroll = function(){        
                currentTime += increment;
                var val = easeInOutQuad(currentTime, start, change, duration);
                element.scrollTop = val;
                if(currentTime < duration) {
                    setTimeout(animateScroll, increment);
                }
            };
        animateScroll();
    }

    function moveTo( targetIndex, disableAnimation ) {
        var sourceIndex = getNodeIndex( currentActive ),
            normalizedScrollingSpeed = null != disableAnimation ? 0 : options.scrollingSpeed/( Math.abs( targetIndex - sourceIndex ) ),
            node = currentActive,
            loopCount = 0;
        if( 0 <= targetIndex && targetIndex < ( options.overlay ? container.children.length - 1 : container.children.length ) && sourceIndex != targetIndex ) {
            if( options.autoScroll && canScroll ) {
                canScroll = false;
                while( sourceIndex != targetIndex ) {
                    setTimeout( function( sIndex ) {
                        if( targetIndex < sIndex ) {
                            if( hasClass( currentActive, overflowSection ) || footerVisible ) {
                                transformSection( node, 0, null == disableAnimation ? true : false );
                                if( footerVisible ) {
                                    footerVisible = false;
                                }
                            }
                            node = node.previousElementSibling;
                            if( targetIndex == sIndex - 1 ) {
                                updateActive( node, 'up' );
                                setTimeout( function() {
                                    transformSection( node, 0, null == disableAnimation ? true : false );
                                    setTimeout( function() {
                                        newSectionLoaded( currentActive );
                                        if( hasClass( currentActive, overflowSection ) ) {
                                            enableScrollCallback( true );
                                        }else if( null != scrollTimeout ) {
                                            enableScrollCallback( false );
                                        }
                                    }, options.scrollingSpeed );
                                }, 50 );
                            }else{                                
                                transformSection( node, 0, null == disableAnimation ? true : false );
                            }
                        }else {
                            transformSection( node, -1 * getOffsetOrScreenHeight( node ), null == disableAnimation ? true : false );
                            node = node.nextElementSibling;
                            if( targetIndex == sIndex + 1 ) {
                                setTimeout( function() {
                                    updateActive( node, 'down' );
                                    newSectionLoaded( currentActive );
                                    if( hasClass( currentActive, overflowSection ) ) {
                                        enableScrollCallback( true );
                                    }else if( null != scrollTimeout ) {
                                        enableScrollCallback( false );
                                    }
                                }, null == disableAnimation ? options.scrollingSpeed : 0 );
                            }
                        }
                    }.bind( null, sourceIndex ), loopCount * normalizedScrollingSpeed );
                    sourceIndex = targetIndex < sourceIndex ? sourceIndex - 1 : sourceIndex + 1;
                    loopCount += 1;
                }
            }else {
                disableAnimation ? scrollTo( 0, getDistanceFromContainer( container.children[ targetIndex ] ) ) : animateScrollTo( getScrollElement(), getDistanceFromContainer( container.children[ targetIndex ] ), options.scrollingSpeed );
            }
        }else {
            triggerError( "You are already in the target section", "warn" );   
        }
    }

    function getDistanceFromContainer( node ) {
        var distance = 0;
        while( ( node = node.previousElementSibling ) ) {
            distance += getOffsetOrScreenHeight( node );
        }
        return distance;
    }

    function destroy() {
        if( !hasClass( html, destroyed ) ) {
            removeClass( html, enabled );
            
        }
    }

    function updateFullScreenHeight() {
        setFullScreenHeight();
        setContainerHeight();
        if( null != currentActive ) {
            setScrollingRange( currentActive );
        }
        reLayout();
        
    }

    function resizeHandler( event ) {
        if( 960 >= getWindowWidth() && 960 < windowWidth ) {
            setResponsive();
        }else if( 960 >= windowWidth && getWindowWidth() > 960 ) {
            resetResponsive();
        }else if( 960 < getWindowWidth() ) {
            updateFullScreenHeight();
            setFooterHeight();
        }
        windowWidth = getWindowWidth();   
    } 

    function setResponsive() {
        if( !hasClass( body, responsive ) ) {
            var stickySections = container.children;
            //reset globals
            currentActive = null;
            removeClass( stickySections, active );
            if( null != scrollTimeout ) {
                didScroll = false;
                clearInterval( scrollTimeout );
            }

            //reset Footer
            resetFooter();

            //reset styles
            resetCss( container, 'height' );
            resetCss( stickySections, [ 'height', 'transform', 'transition' ] );
            if( !options.autoScroll ) {
                resetCss( body, [ 'height', 'overflow' ] );
            }

            //removeHandlers
            removeEventHandler( document, scrollHandler, 'scroll' );
            removeEventHandler( document, mouseWheelHandler, [ 'mousewheel', 'wheel', 'DOMMouseScroll', 'onmousewheel' ] );

            //finally add class
            addClass( body, responsive );          
        }
    }

    function resetResponsive() {
        if( hasClass( body, responsive ) ) {
            var stickySections = container.children;
            setFullScreenHeight();
            setContainerHeight();
            [].forEach.call( stickySections, function( stickySection, index ) {
                if( !hasClass( stickySection, overflowSection ) && !hasClass( stickySection, overlay ) ) {
                    setCss( stickySection, 'height', '100%' );
                }
            } );
            initFooter();
            addMouseWheelHandler();
            addScrollHandler();
            setActive( stickySections );
            if( !options.autoScroll ) {
                setTimeout( function() {
                    addBodyHeight();                    
                }, 50);
            }
            removeClass( body, responsive );
        }
    }

    function addResizeHandler() {
        addEventHandler( window, debounce( resizeHandler, 200 ), 'resize' );
    }

    function setScrollingRange( node ) {
        scrollingRange = {
            min : 0,
            max : 0
        };
        scrollingRange.min = getDistanceFromContainer( node );
        scrollingRange.max = scrollingRange.min + ( hasClass( currentActive, overflowSection ) ? currentActive.offsetHeight : fullScreenHeight );
    }

    function getElementWithActiveClass( stickySections ) {
        if( 0 < stickySections.length ) {
            var activeSection = __get( sectionSelector + ' active' );
            if( null == activeSection ) {
                return null;
            }
            return activeSection;
        }
    }

    function prepareDOM( stickySections ) {
        var sectionCount = stickySections.length,
            fixedParent = null;
        if( 0 == sectionCount ) {
            triggerError( 'Element on which you initialized sticky doesn\'t have any children. Kindly add some children to make them sticky', 'warning' );
            return;
        }
        addClass( container, stickyWrapper );
        if( !options.autoScroll ) {
            if( options.fixedParent ) {
                fixedParent = __get(  options.fixedParent );
            }else {
                fixedParent = container;
            }
            addClass( fixedParent, 'sticky-normal-scroll' );
        }else {
            addClass( container, 'sticky-auto-scroll' );
        }
        setContainerHeight();
        addClass( stickySections, section );
        createLayout( stickySections );
        addOverlay( stickySections );
        addDots( stickySections );
    }

    function setContainerHeight() {
        css( container, {
            height : fullScreenHeight + 'px'
        } );
    }

    function addDots( stickySection ) {
        if( options.dots ) {
            var div = document.createElement('div');
            div.setAttribute('id', dotsNavigation);
            var divUl = document.createElement('ul');
            div.appendChild(divUl);
            document.body.appendChild(div);
            nav = __get(dotsNavigationSelector);
            addClass(nav, options.navigationPosition);    

            var li = '';    
            for( var i = 0; i < __getAll( sectionSelector ).length; i++ ) {
                li = li + '<li class = "sticky-nav-dot"><span></span></li>';
            }        
            divUl.innerHTML = divUl.innerHTML + li;
            if( options.navigationColor ) {
                setCss( __getAll( singleDotSelector + ' span' ) , 'background', options.navigationColor);
            }
            for( var i = 0; i < divUl.children.length; i++ ) {
                addEventHandler( divUl.children[ i ], function( event ) {
                    removeClass( divUl.children, activeDot );
                    addClass( event.currentTarget, activeDot );
                    stickySections.moveTo( getNodeIndex( event.currentTarget ) );
                }, 'click' );
            }
        }
    }

    function updateNavDots( element ) {
        if( options.dots && null != element ) {
            var elementIndex = getNodeIndex( element ),
                navDots = __getAll( singleDotSelector );
            removeClass( navDots, activeDot );
            addClass( navDots[ elementIndex ], activeDot );
        }
    }

    function addOverlay( stickySections ) {
        if( options.overlay ) {
            var overlayElement = document.createElement( 'div' );
            addClass( overlayElement, overlay );
            setCss( overlayElement, 'z-index', stickySections.length - 1 );
            overlayEle = overlayElement;
            addAdjacentSibling( container, overlayElement, 'beforeend' );
        }
    }

    function setFullScreenHeight() {
        fullScreenHeight = getWindowHeight() - getHeightFromSelectors( options.fullScreenOffset );
    }

    function getHeightFromSelectors( selectorArray ) {
        var totalHeight = 0;
        if( null != selectorArray ) {
            if( '[object Array]' == getObjectType( selectorArray ) && 0 < selectorArray.length ) {
                selectorArray.forEach( function( selector ) {
                    var curElement = __get( selector );
                    if( null != curElement ) {
                        totalHeight = totalHeight + curElement.offsetHeight;
                    }
                } );
            }
        }
        return totalHeight;
    }

    function createLayout( stickySections ) {
        var childrenCount = stickySections.length;
        [].forEach.call( stickySections, function( stickySection, index ) {
            if( !hasClass( stickySection, 'tatsu-fullscreen' ) ) {
                if( fullScreenHeight < stickySection.offsetHeight ) {
                    addClass( stickySection, overflowSection );
                }else {
                    setCss( stickySection, 'height', '100%' );
                }
            }
            setCss( stickySection, 'z-index', childrenCount - index );
        } );
        initFooter();
        if( !options.autoScroll ) {
            addBodyHeight();
        }
    }

    function reLayout() {
        var stickySections = container.children,
            node = currentActive;
        [].forEach.call( stickySections, function( stickySection, index ) {
            if( !hasClass( stickySection, overlay ) && !hasClass( stickySection, 'sticky-footer-wrap' ) ) {
                if( !hasClass( stickySection, 'tatsu-fullscreen' ) ) {
                    resetCss( stickySection, 'height', '' );
                    if( fullScreenHeight < stickySection.offsetHeight ) {
                        addClass( stickySection, overflowSection );
                    }else {
                        setCss( stickySection, 'height', '100%' );
                    }                    
                }
            }
        } );
        if( !options.autoScroll ) {
            while( node  ) {
                if( node == currentActive ) {
                    transformSection( node, getYMovement( getScrollTop() ), false );
                }else {
                    transformSection( node, -1 * getOffsetOrScreenHeight( node ), false );
                }
                node = node.previousElementSibling;
            }
            addBodyHeight();
        }else {
            while( node = node.previousElementSibling ) {
                transformSection( node, -1 * getOffsetOrScreenHeight( node ), false );
            }
        }
    }
    
    function addBodyHeight() {
        var totalHeight = 0,
            stickySections = container.children;
        [].forEach.call( stickySections, function( curSection ) {
            if( !hasClass( curSection, overlay ) ) {
                totalHeight = totalHeight + curSection.offsetHeight;
            }
        } );
        options.fullScreenOffset.forEach( function( selector ) {
            var ele = __get( selector );
            if( null != ele && 'wpadminbar' != ele.id ) {
                totalHeight = totalHeight + ele.offsetHeight;
            }
        } );
        css( body, {
            overflow : 'auto',
            height : totalHeight + 'px'
        } );
    }

    function triggerError( message, type ) {
        if( 'string' == typeof message && 'string' == typeof type && '' != message && -1 < [ 'error', 'warn' ].indexOf( type ) ) {
            console[ type ]( message );
        }
    }

    function mouseWheelHandler( event ) {
        var curTime = Date.now(),
            timeDiff = curTime - prevTime,
            event = window.event || event,
            averageEnd,
            averageMedium,
            isAccelerating = false,
            value = event.wheelDelta || ( -1 * event.detail ),
            delta = Math.max( -1, Math.min( 1, value ) );
        prevTime = curTime;
        if( 149 < scrollings.length ) {
            scrollings.shift();
        }
        scrollings.push( Math.abs( value ) );
        if( 200 < timeDiff ) {
            scrollings = [];
        }
        if( canScroll ) {
            averageEnd = getAverage( scrollings, 5 );
            averageMedium = getAverage( scrollings, 70 );
            isAccelerating = averageEnd >= averageMedium;
            if( isAccelerating || hasClass( currentActive, overflowSection ) ) {
                if( 1 == delta ) {
                    moveSectionUp();
                }else if( -1 == delta ) {
                    moveSectionDown();
                }
            }
        }
    }

    function getTranslateY( node ) {
        var transform = getComputedStyle( node ).transform,
            transformArray = transform.split( "," );
        if( null != transformArray[5] ) {
            return Math.abs( parseInt( transformArray[5] ) );
        }
        return 0;
    }

    function moveSectionDown() {
        if( hasClass( currentActive, overflowSection ) ) {
            var currentTransformedValue = getTranslateY( currentActive );
            if( fullScreenHeight < ( currentActive.offsetHeight - ( currentTransformedValue + 50 ) ) ) {
                if( null != scrollTimeout && !didScroll ) {
                    didScroll = true;
                }
                transformSection( currentActive, -1 * ( currentTransformedValue + 50 ), false );
            }else {
                nextSection();
            }
        }else {
            nextSection();
        }
    }

    function moveSectionUp() {
        if( hasClass( currentActive, overflowSection ) && !footerVisible ) {
            //can do this with scrollingRange
            var currentTransformedValue = getTranslateY( currentActive );
            if( 0 <= ( currentTransformedValue - 50 ) ) {
                if( null != scrollTimeout && !didScroll ) {
                    didScroll = true;
                }
                transformSection( currentActive, 50 > ( currentTransformedValue - 50 ) ? 0 : -1 * ( currentTransformedValue - 50 ), false );
            }else {
                previousSection();
            }
        }else {
            previousSection();
        }
    }

    function enableScrollCallback( enable ) {
        if( enable ) {
            if( null == scrollTimeout ) {
                scrollTimeout = setInterval( function() {
                    if( didScroll ) {
                        didScroll = false;
                        options.scrollCallback.call( currentActive, getNodeIndex( currentActive ) );
                    }
                }, 150 );
            }
        }else if( null != scrollTimeout ) {
            clearInterval( scrollTimeout );
            scrollTimeout = null;
            if( didScroll ) {
                 didScroll = false;
            }
        }
    }

    function moveSectionBasedOnScrollTop( scrollTop ) {
        if( 0 <= scrollTop ) {
            if( scrollTop >= scrollingRange.max ) {
                while( scrollTop >= scrollingRange.max ) {
                    transformSection( currentActive, getYMovement( scrollTop ), false );
                    updateActive( currentActive.nextElementSibling, 'down' );
                    newSectionLoaded( currentActive );
                    if( hasClass( currentActive, overflowSection ) ) {
                        enableScrollCallback( true );
                    }else if( null != scrollTimeout ) {
                        enableScrollCallback( false );
                    }
                }
                transformSection( currentActive, getYMovement( scrollTop ), false );
            }else if( scrollTop < scrollingRange.min ) {
                while( scrollingRange.min > scrollTop ) {
                    transformSection( currentActive, getYMovement( scrollTop ), false );
                    if( hasClass( currentActive.nextElementSibling, 'sticky-footer-wrap' ) && footerVisible ) {
                        footerVisible = false;
                    }
                    updateActive( currentActive.previousElementSibling, 'up' );     
                    newSectionLoaded( currentActive );   
                    if( hasClass( currentActive, overflowSection ) ) {
                        enableScrollCallback( true );
                    }else if( null != scrollTimeout ) {
                        enableScrollCallback( false );
                    }            
                }
                transformSection( currentActive, getYMovement( scrollTop ), false );
            }else {
                if( null != scrollTimeout && !didScroll ) {
                    didScroll = true;
                }
                if( hasClass( currentActive.nextElementSibling, 'sticky-footer-wrap' ) && !footerVisible ) {
                    footerVisible = true;
                }
                transformSection( currentActive, getYMovement( scrollTop ), false );
            }
        }
    }

    function scrollHandler( event ) {
        moveSectionBasedOnScrollTop( getScrollTop() );
    }

    function getYMovement( scrollTop ) {
        if( scrollTop >= scrollingRange.max ) {
            return -1 * ( hasClass( currentActive, overflowSection ) ? currentActive.offsetHeight : fullScreenHeight ) ;
        }else if( scrollTop <= scrollingRange.min ) {
            return 0;
        }else {
            return -1 * ( scrollTop - scrollingRange.min );
        }
    }

    function updateOverlay( element, opacity ) {
        if( options.overlay ) {
            var curzIndex = Number( getCss( element, 'z-index' ) );
            if( !isNaN( curzIndex ) ) {
                css( overlayEle, {
                    'z-index' : curzIndex - 1,
                    'opacity' : opacity,
                    'transition' : 'none'
                } );
            }
        }
    }

    function updateActive( element, direction ) {
        if( null != element && element != currentActive ) {
            removeClass( currentActive, active );
            addClass( element, active );
            currentActive = element;
            updateNavDots( currentActive );
            updateOverlay( currentActive, 'down' == direction ? 1 : 0 );
            setScrollingRange( element );
        }
    }

    function newSectionLoaded( loadedSection ) {
        isFunction( options.afterLoad ) && options.afterLoad.call( loadedSection, getNodeIndex( loadedSection ) );
        canScroll = true;
    }

    function transformSection( element, yMovement, animated, varyingSpeed ) {
        if( animated ) {
            addAnimation( element, varyingSpeed );
        }else {
            removeAnimation( element );
        }
        setTransforms( element, yMovement );
        setOpacity( element, Math.abs( yMovement ) );
    }

    function setOpacity( element, yMovement ) {
        if( options.overlay ) {
            if( options.autoScroll ) {
                if( hasClass( element, overflowSection ) ) {
                    if( yMovement > ( element.offsetHeight - fullScreenHeight ) || yMovement == ( element.offsetHeight - fullScreenHeight ) ) {
                        css( overlayEle, {
                            transition : 'opacity ' + options.scrollingSpeed + 'ms ease',
                            opacity : yMovement > ( element.offsetHeight - fullScreenHeight ) ? 0 : 1   
                        } );    
                    }
                }else {
                    css( overlayEle, {
                        'transition' : 'opacity ' + options.scrollingSpeed + 'ms ease',
                        opacity : 0 == yMovement ? 1 : 0
                    });
                }
            }else {
                if( hasClass( element, overflowSection ) ) { 
                    if( yMovement > ( element.offsetHeight - fullScreenHeight ) ) {
                        setCss( overlayEle, 'opacity', 1 - ( ( yMovement - ( element.offsetHeight - fullScreenHeight ) )/( footerVisible ? footerHeight : fullScreenHeight ) ) );
                    }
                }else {
                    setCss( overlayEle, 'opacity', 1 - ( yMovement/( footerVisible ? footerHeight : fullScreenHeight ) ) );
                }
            }
        }
    }

    function nextSection() {
        if( null != currentActive.nextElementSibling && !hasClass( currentActive.nextElementSibling, overlay ) ) {
            if( options.autoScroll ) {
                if( canScroll ) {
                    if( hasClass( currentActive.nextElementSibling, 'sticky-footer-wrap' ) ) {
                        if( !footerVisible ) {
                            canScroll = false;
                            transformSection( currentActive, -1 * ( hasClass( currentActive, overflowSection ) ? ( ( currentActive.offsetHeight%fullScreenHeight )  + footerHeight ) : footerHeight ), true );
                            setTimeout( function() {
                                canScroll = true;
                                footerVisible = true;
                            }, options.scrollingSpeed );
                        }
                    }else {
                        canScroll = false;
                        transformSection( currentActive, -1 * getOffsetOrScreenHeight( currentActive ), true );
                        setTimeout( function( activeSection ) {
                            updateActive( currentActive.nextElementSibling, 'down' );
                            newSectionLoaded( currentActive );
                            if( hasClass( currentActive, overflowSection ) ) {
                                enableScrollCallback( true );
                            }else if( null != scrollTimeout ) {
                                enableScrollCallback( false );
                            }
                        }.bind( null, currentActive ), options.scrollingSpeed );
                    }
                }else {
                    triggerError( 'nextSection : Transition to a section is in progress, please call again once its complete', 'warn' );
                }
            }else {
                scrollTo( 0, scrollingRange.max );
            }
        }
    }

    function previousSection() {
        if( null != currentActive.previousElementSibling ) {
            if( options.autoScroll ) {
                if( canScroll ) {
                    if( hasClass( currentActive.nextElementSibling, 'sticky-footer-wrap' ) && footerVisible ) {
                        canScroll = false;
                        transformSection( currentActive, -1 * (hasClass( currentActive, overflowSection ) ? ( currentActive.offsetHeight - fullScreenHeight ) : 0 ), true );
                        setTimeout( function() {
                            footerVisible = false;
                            canScroll = true;
                        }, options.scrollingSpeed )
                    }else {
                        canScroll = false;
                        updateActive( currentActive.previousElementSibling, 'up' );
                        setTimeout( function() {
                            transformSection( currentActive, hasClass( currentActive, overflowSection ) ? ( -1 * (currentActive.offsetHeight - fullScreenHeight ) ) : 0, true );
                            setTimeout( function( activeSection ) {
                                newSectionLoaded( activeSection );
                                if( hasClass( currentActive, overflowSection ) ) {
                                    enableScrollCallback( true )
                                }else if( null != scrollTimeout ) {
                                    enableScrollCallback( false );
                                }
                            }.bind( null, currentActive ), options.scrollingSpeed );        
                        }, 50 );
                    }
                }else {
                    triggerError( 'previousSection : Transition to a section is in progress, please call again once its complete', 'warn' );                    
                }
            }else {
                scrollTo( 0, scrollingRange.min - getOffsetOrScreenHeight( currentActive.previousElementSibling ) );
            }
        }
    }

    function addMouseWheelHandler() {
       if( options.autoScroll ) {
            addEventHandler( document, mouseWheelHandler, [ 'mousewheel', 'wheel', 'DOMMouseScroll', 'onmousewheel' ] );
       }
    }

    function addScrollHandler() {
        if( !options.autoScroll ) {
            addEventHandler( document, scrollHandler, "scroll" )
        }
    }

    /**
    * Gets the average of the last `number` elements of the given array.
    */
    function getAverage(elements, number){
        var sum = 0,
            lastElements = elements.slice(Math.max(elements.length - number, 1));
        for(var i = 0; i < lastElements.length; i++){
            sum = sum + lastElements[i];
        }
        return Math.ceil(sum/number);
    }

    function addAnimation( element, varyingSpeed ) {
        var transition = 'all ' + ( null != varyingSpeed ? varyingSpeed : options.scrollingSpeed ) + 'ms ' + options.easingcss3;
        if( null == element ) { 
            return;
        }
        removeClass( element, noTransition );
        css(element, {
            '-webkit-transition': transition,
            'transition': transition
        });
    }

    function removeAnimation( element ) {
        addClass( element, noTransition );
    }


    /* --------------- Javascript helpers  ---------------*/

    /**
    * Replacement of jQuery extend method.
    */
    function extend(defaultOptions, options){
        //creating the object if it doesnt exist
        if(typeof(options) !== 'object'){
            options = {};
        }
        for(var key in options){
            if(defaultOptions.hasOwnProperty(key)){
                defaultOptions[key] = options[key];
            }
        }
        return defaultOptions;
    }

    function getById(element){
        return document.getElementById(element);
    }

    function getByTag(element){
        return document.getElementsByTagName(element)[0];
    }

    function css( el, props ) {
        var key,
            objType = getObjectType( el );
        if( "[object NodeList]" == objType || "[object HTMLCollection]" == objType ) {
            [].forEach.call( el, function( ele ) {
                for ( key in props ) {
                    if ( props.hasOwnProperty(key) ) {
                        if ( key !== null ) {
                            el.style[key] = props[key];
                        }
                    }
                }                
            } );
        }else {
            for ( key in props ) {
                if ( props.hasOwnProperty(key) ) {
                    if ( key !== null ) {
                        el.style[key] = props[key];
                    }
                }
            }
        }
    }

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    function getOffsetOrScreenHeight( node ) {
        return hasClass( node, overflowSection ) ? node.offsetHeight : fullScreenHeight;
    }

    function setCss(element, style, value){
        var objType = getObjectType( element );
        if( "[object NodeList]" == objType || "[object HTMLCollection]" == objType ) {
            [].forEach.call( element, function( ele ) {
                ele.style[ style ] = value;
            } );
        }else {
            element.style[style] = value;
        }
    }

    function resetCss( element, style ) {
        // if( style == 'height' ) {
        //     debugger;
        // }
        var objType = getObjectType( element ),
            styleType = getObjectType( style );
        if( "[object NodeList]" == objType || "[object HTMLCollection]" == objType ) {
            [].forEach.call( element, function( ele ) {
                if( '[object Array]' == styleType ) {
                    style.forEach( function( curStyle ) {
                        ele.style[ curStyle ] = "";
                    } );
                }else {
                    ele.style[ style ] = "";
                }
            } );
        }else {
            if( '[object Array]' == styleType ) {
                style.forEach( function( curStyle ) {
                    element.style[ curStyle ] = "";
                } );
            }else {
                
                element.style[ style ] = "";
            }
        }        
    }

    function getCss( element, att ) {
        if( null != element ) {
            return getComputedStyle( element ).getPropertyValue( att );
        }
    }

    function setTransforms(element, yMovement, varyingSpeed){
        var translate3d = 'translate3d(0px, ' + yMovement + 'px, 0px)';
        css(element, {
            '-webkit-transform': translate3d,
            '-moz-transform': translate3d,
            '-ms-transform': translate3d,
            'transform': translate3d 
        });
    }

    function __get(selector, context){
        context = context || document;
        return context.querySelector(selector);
    }

    function __getAll(selector, context){
        context = context || document;
        return context.querySelectorAll(selector);
    }

    function getNodeIndex(node) {
        var index = 0;
        while ( node && (node = node.previousElementSibling) ) {
            index++;
        }
        return index;
    }

    //http://jaketrent.com/post/addremove-classes-raw-javascript/
    function hasClass(ele,cls,every) {
        var objType = getObjectType( ele ); 
        if( "[object NodeList]" == objType || "[object HTMLCollection]" == objType || "[object Array]" == objType ) {
            if( every ) {
                return [].every.call( ele, function( curEle ) {
                    return curEle.classList.contains( cls );
                } );      
            }else {
                return [].some.call( ele, function( curEle ) {
                    return curEle.classList.contains( cls );
                } )
            }
        }else{
            return ele.classList.contains( cls );
        }
    }

    function removeClass(element, className) {
        var objType = getObjectType( element );
        if( "[object NodeList]" == objType || "[object HTMLCollection]" == objType || "[object Array]" == objType ) {
            [].forEach.call( element, function( ele ) {
                if( ele && hasClass( ele, className ) ) {
                    ele.classList.remove( className );
                }
            } );
        }else if (element && hasClass(element,className)) {
            element.classList.remove( className );
        }
    }

    function addClass(element, className) {
        var objType = getObjectType( element );
        if( "[object HTMLCollection]" == objType || "[object NodeList]" == objType || "[object Array]" == objType ) {
            [].forEach.call( element, function( ele ) {
                if (ele && !hasClass(ele,className)) {
                    ele.classList.add( className );
                }
            } );
        }else if (element && !hasClass(element,className)) {
            element.classList.add( className );
        }
    }

    //http://stackoverflow.com/questions/22100853/dom-pure-javascript-solution-to-jquery-closest-implementation
    function closest(el, fn) {
        return el && (
            fn(el) ? el : closest(el.parentNode, fn)
        );
    }

    function getWindowWidth(){
        return  'innerWidth' in window ? window.innerWidth : document.documentElement.offsetWidth;
    }

    function getWindowHeight(){
        return  'innerHeight' in window ? window.innerHeight : document.documentElement.offsetHeight;
    }   

    //http://stackoverflow.com/questions/842336/is-there-a-way-to-select-sibling-nodes
    //Gets siblings
    function getAllSiblings( element ) {
        return getChildren( element.parentNode.firstChild, element );
    }
    
    function getChildren( element, skipMe ){
        var siblings = [];
        for ( ; element ; element = element.nextSiblingElement ) {
            if( element != skipMe ) {
                siblings.push( element ); 
            }
        }
        return siblings;
    };
    
    function addAdjacentSibling( targetElement, newElement, position ) {
        if( -1 == [ 'afterbegin', 'beforebegin', 'afterend', 'beforeend' ].indexOf( position ) || null == targetElement || null == newElement ) {
            return false;
        }
        return targetElement.insertAdjacentElement( position, newElement );
    }

    function addEventHandler( element, handler, eventsArray ) {
        if( "[object Array]" == getObjectType( eventsArray ) ) {
            eventsArray.forEach( function( event ) {
                element.addEventListener( event, handler );
            } );
        }else {
            element.addEventListener( eventsArray, handler );
        }
    }

    function removeEventHandler( element, handler, eventsArray ) {
        if( "[object Array]" == getObjectType( eventsArray ) ) {
            eventsArray.forEach( function( event ) {
                element.removeEventListener( event, handler );
            } );
        }else {
            element.removeEventListener( eventsArray, handler );
        }        
    }

    function isFunction( func ) {
        return func && "[object Function]" == getObjectType( func );
    }

    function getObjectType( obj ) {
        var dummyObj = {};
        return dummyObj.toString.call( obj );
    }

    function getScrollElement() {
        if( 0 < document.body.scrollTop ) {
            return document.body;
        }else {
            return document.documentElement;
        }
    }

    function getScrollTop() {
        return document.body.scrollTop || document.documentElement.scrollTop;
    }

    function getCurrentActive() {
        return currentActive;
    }

    /* --------------- END Javascript helpers  ---------------*/

    return {
        initialize : initialize,
        previousSection : previousSection,
        nextSection : nextSection,
        moveTo : moveTo,
        getCurrentActive : getCurrentActive,
        updateLayout : updateFullScreenHeight
    }
    
});