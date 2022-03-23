"use strict";
(function () {
    document.onreadystatechange = function () {
        if (document.readyState === 'interactive') {
            superblockslider('.superblockslider');
        }
    };
    var superblockslider = function (superblocksliderSlides) {
        var superblocksliderSlider = document.querySelectorAll(superblocksliderSlides);
        superblocksliderSlider.forEach(function (slider, index) {
            var settings = {
                initialActiveSlide: slider.getAttribute('data-initial-active-slide') ? parseInt(slider.getAttribute('data-initial-active-slide')) : 0,
                loopSlide: slider.getAttribute('data-loop-slide') ? false : true,
                autoplay: slider.getAttribute('data-autoplay') ? false : true,
                autoplayInterval: slider.getAttribute('data-autoplay-interval') ? slider.getAttribute('data-autoplay-interval') : '1.5s',
                slideNavigation: slider.getAttribute('data-slide-navigation') ? slider.getAttribute('data-slide-navigation') : 'dots',
                hoverPause: slider.getAttribute('data-hover-pause') ? false : true,
                transitionEffect: slider.getAttribute('data-transition-effect') ? slider.getAttribute('data-transition-effect') : 'slide',
                transitionDuration: slider.getAttribute('data-transition-duration') ? slider.getAttribute('data-transition-duration') : '.6s',
                animation: slider.getAttribute('data-animation') ? slider.getAttribute('data-animation') : 'cubic-bezier(0.46, 0.03, 0.52, 0.96)',
                transitionSpeed: slider.getAttribute('data-transition-speed') ? slider.getAttribute('data-transition-speed') : '.6s',
                arrowNavigation: slider.getAttribute('data-arrow-navigation') ? false : true,
            };
            var currentSlideIndex = settings.initialActiveSlide;
            var currentSlideId = settings.initialActiveSlide;
            var animating = false;
            var el_superblockslider__track = slider.querySelector('.superblockslider__track');
            var el_superblockslider__slides = slider.querySelectorAll('.superblockslider__slide');
            var el_superblockslider__button__previous = slider.querySelector('.superblockslider__button__previous');
            var el_superblockslider__button__next = slider.querySelector('.superblockslider__button__next');
            el_superblockslider__track.addEventListener('transitionstart', transitionStart);
            el_superblockslider__track.addEventListener('transitionend', transitionEnd);
            var offsetPercent = 100 / el_superblockslider__slides.length;
            var translateXOffset = currentSlideIndex * offsetPercent;
            var translateX = "translateX(-" + translateXOffset + "%)";
            var sliderPositionY = slider.getBoundingClientRect().y;
            var windowScrollPositionY = window.pageYOffset;
            var sliderFromTopY = sliderPositionY + windowScrollPositionY;
            var windowHeight = window.innerHeight;
            var sliderPositionYdifferencePercentage = (sliderFromTopY / windowHeight) * 100;
            var parallaxSlides = slider.querySelectorAll('.superblockslider__slide[data-parallax="true"]');
            var lastKnownScrollPosition = 0;
            if (parallaxSlides) {
                parallaxInit();
                window.addEventListener('scroll', function (event) {
                    lastKnownScrollPosition = window.scrollY - window.innerHeight;
                    parallaxSlides.forEach(function (parallaxSlide, index) {
                        window.requestAnimationFrame(function () {
                            var el_slide_bg = parallaxSlide.querySelectorAll('.superblockslider__slide__bg')[0];
                            var parallaxSpeed = parallaxSlide.getAttribute('data-parallax-speed') ? parseInt(parallaxSlide.getAttribute('data-parallax-speed')) / 100 : 0;
                            parallax(el_slide_bg, lastKnownScrollPosition, parallaxSpeed);
                        });
                    });
                });
                window.addEventListener('resize', parallaxInit);
            }
            function parallaxInit() {
                lastKnownScrollPosition = window.scrollY - window.innerHeight;
                parallaxSlides.forEach(function (slide, index) {
                    window.requestAnimationFrame(function () {
                        var parallaxSpeed = slide.getAttribute('data-parallax-speed') ? parseInt(slide.getAttribute('data-parallax-speed')) / 100 : 0;
                        sliderPositionY = slider.getBoundingClientRect().y;
                        windowScrollPositionY = window.pageYOffset + 200;
                        sliderFromTopY = sliderPositionY + windowScrollPositionY;
                        windowHeight = window.innerHeight;
                        sliderPositionYdifferencePercentage = (sliderFromTopY / windowHeight) * 100;
                        var el_slide_bg = slide.querySelectorAll('.superblockslider__slide__bg')[0];
                        var el_slide_bg_img = el_slide_bg.querySelectorAll('img')[0];
                        el_slide_bg_img.style.height = 100 + (parallaxSpeed * 100) + sliderPositionYdifferencePercentage + "%";
                        parallax(el_slide_bg, lastKnownScrollPosition, parallaxSpeed);
                    });
                });
            }
            function parallax(element, positionY, speed) {
                element.style.transform = "translateY(" + (positionY) * speed + "px)";
            }
            var autoplayTime;
            var autoplayInterval;
            var autopayToggle;
            if (settings.autoplay == true) {
                if (settings.autoplayInterval.indexOf('ms') > 0) {
                    autoplayInterval = parseInt(settings.autoplayInterval.split('ms')[0]);
                    autopayToggle = autoplayInterval;
                }
                else {
                    var seconds = Number(settings.autoplayInterval.split('s')[0]);
                    autoplayInterval = seconds * 1000;
                    autopayToggle = autoplayInterval;
                }
                if (typeof autoplayInterval === 'number') {
                    window.requestAnimationFrame(autoplayTimerFrame);
                    if (settings.hoverPause == true) {
                        slider.addEventListener('mouseover', function (event) {
                            autopayToggle = 'pause';
                        });
                        slider.addEventListener('mouseout', function (event) {
                            autopayToggle = autoplayInterval;
                        });
                    }
                }
            }
            function autoplayTimerFrame(timestamp) {
                if (autoplayTime === undefined)
                    autoplayTime = timestamp;
                if (autopayToggle === 'pause')
                    autoplayTime = timestamp;
                var elapsed = timestamp - autoplayTime;
                window.requestAnimationFrame(autoplayTimerFrame);
                if (elapsed >= autopayToggle) {
                    autoplayTime = timestamp;
                    nextSlide();
                }
            }
            var el_superblockslider__buttons = slider.querySelectorAll('.superblockslider__button');
            if (settings.slideNavigation != 'none') {
                el_superblockslider__buttons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        if (!animating) {
                            var buttonIdValue = parseInt(button.getAttribute('data-button-id'));
                            animateTrackToSlideId(buttonIdValue);
                        }
                    });
                });
            }
            function animateTrackToSlideId(slideId) {
                if (!animating) {
                    if (currentSlideId != slideId) {
                        el_superblockslider__slides = slider.querySelectorAll('.superblockslider__slide');
                        var slideIndex_1 = slideId;
                        if (settings.loopSlide == false) {
                        }
                        else if (settings.transitionEffect == 'slide' && settings.loopSlide == true) {
                            if (currentSlideIndex === 0 && el_superblockslider__slides.length > 2) {
                                el_superblockslider__track.style.transition = 'none';
                                var lastSide = el_superblockslider__slides[el_superblockslider__slides.length - 1];
                                el_superblockslider__track.prepend(lastSide);
                                currentSlideIndex = 1;
                                var trackOffset = currentSlideIndex * offsetPercent;
                                translateX = "translateX(-" + trackOffset + "%)";
                                el_superblockslider__track.style.transform = translateX;
                            }
                            else if (currentSlideIndex === el_superblockslider__slides.length - 1) {
                                el_superblockslider__track.style.transition = 'none';
                                currentSlideIndex = el_superblockslider__slides.length - 2;
                                var trackOffset = currentSlideIndex * offsetPercent;
                                translateX = "translateX(-" + trackOffset + "%)";
                                el_superblockslider__track.style.transform = translateX;
                                var firstSlide = el_superblockslider__slides[0];
                                el_superblockslider__track.append(firstSlide);
                            }
                            var slideMatch = slider.querySelectorAll("[data-slide-index=\"" + slideId + "\"]");
                            if (slideMatch[0] && slideMatch[0].parentNode) {
                                var slideMatch_parent_children = slideMatch[0].parentNode.children;
                                var closeSlide = Array.from(slideMatch_parent_children).indexOf(slideMatch[0]);
                                slideIndex_1 = closeSlide;
                            }
                        }
                        setTimeout(function () {
                            animate(slideId, slideIndex_1);
                        }, 100);
                    }
                }
            }
            function animate(slideId, slideIndex) {
                if (settings.transitionEffect == 'slide') {
                    el_superblockslider__track.style.transition = "all " + settings.transitionDuration + " " + settings.animation;
                    var trackOffset = slideIndex * offsetPercent;
                    translateX = "translateX(-" + trackOffset + "%)";
                    el_superblockslider__track.style.transform = translateX;
                    currentSlideIndex = slideIndex;
                    currentSlideId = slideId;
                }
                else if (settings.transitionEffect == 'fade') {
                    currentSlideIndex = slideIndex;
                    currentSlideId = slideId;
                    transitionEnd();
                }
            }
            function transitionStart() {
                animating = true;
            }
            function transitionEnd() {
                slider.querySelector('.superblockslider__slide--active').classList.remove('superblockslider__slide--active');
                slider.querySelector("[data-slide-index=\"" + currentSlideId + "\"]").classList.add('superblockslider__slide--active');
                if (settings.slideNavigation != 'none') {
                    slider.querySelector('.superblockslider__button--active').classList.remove('superblockslider__button--active');
                    el_superblockslider__buttons[currentSlideId].classList.add('superblockslider__button--active');
                }
                if (settings.transitionEffect == 'slide') {
                    el_superblockslider__track.style.transition = "all " + settings.transitionDuration + " " + settings.animation;
                }
                animating = false;
            }
            if (el_superblockslider__button__previous && el_superblockslider__button__next) {
                el_superblockslider__button__previous.addEventListener('click', prevSlide);
                el_superblockslider__button__next.addEventListener('click', nextSlide);
            }
            function prevSlide() {
                var prevSlideId = currentSlideId - 1;
                if (prevSlideId < 0) {
                    prevSlideId = el_superblockslider__slides.length - 1;
                }
                animateTrackToSlideId(prevSlideId);
            }
            function nextSlide() {
                var nextSlideId = currentSlideId + 1;
                if (nextSlideId > el_superblockslider__slides.length - 1) {
                    nextSlideId = 0;
                }
                animateTrackToSlideId(nextSlideId);
            }
        });
    };
})();
//# sourceMappingURL=superblockslider.js.map