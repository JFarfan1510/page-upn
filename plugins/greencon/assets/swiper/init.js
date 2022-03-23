"use strict";
var gcswiperinits = document.getElementsByClassName('gcp-swiper-init');
for (let i = 0; i < gcswiperinits.length; i++) {
    let swiperobj = gcswiperinits[i];
    let slidesPerView = parseInt(swiperobj.dataset.slidesperview);
    let slidesPerViewM = parseInt(swiperobj.dataset.slidesperviewm);
    let slidesPerViewT = parseInt(swiperobj.dataset.slidesperviewt);
    let spaceBetween = parseInt(swiperobj.dataset.spacebetween);
    let spaceBetweenM = parseInt(swiperobj.dataset.spacebetweenm);
    let spaceBetweenT = parseInt(swiperobj.dataset.spacebetweent);
    let speed = parseInt(swiperobj.dataset.speed);
    let loop = JSON.parse(swiperobj.dataset.loop);
    let autoheight = JSON.parse(swiperobj.dataset.autoheight);
    let grabCursor = JSON.parse(swiperobj.dataset.grabcursor);
    let freemode = JSON.parse(swiperobj.dataset.freemode);
    let vertical = JSON.parse(swiperobj.dataset.vertical);
    let centered = JSON.parse(swiperobj.dataset.centered);
    let autoplay = JSON.parse(swiperobj.dataset.autoplay);
    let autodelay = parseInt(swiperobj.dataset.autodelay);
    let effect = swiperobj.dataset.effect;
    let coverflowrotate = parseInt(swiperobj.dataset.coverflowrotate);
    let coverflowdepth= parseInt(swiperobj.dataset.coverflowdepth);
    let coverflowshadow = JSON.parse(swiperobj.dataset.coverflowshadow);
    let customparams = (swiperobj.dataset.customparams) ? JSON.parse(swiperobj.dataset.customparams) : '';

    const swiper = new Swiper(
        swiperobj.querySelector('.swiper'),
        {
            spaceBetween : spaceBetween,
            slidesPerView : slidesPerView,
            speed : speed,
            loop : loop,
            autoHeight: autoheight,
            direction: (vertical) ? "vertical" : "horizontal",
            grabCursor : grabCursor,
            freeMode: freemode,
            centeredSlides: centered,
            autoplay: autoplay ? { delay: autodelay } : false,
            effect: (effect == 'coverflow' || effect == 'creative' || effect == 'cards') ? effect : null,
            coverflowEffect: (effect == 'coverflow') ? {
                rotate: coverflowrotate,
                slideShadows: coverflowshadow,
                depth: coverflowdepth,
            } : null,
            creativeEffect: (effect == 'creative') ? {
                prev: {
                    translate: [customparams.prev.translateX, customparams.prev.translateY, customparams.prev.translateZ],
                    rotate: [customparams.prev.rotateX, customparams.prev.rotateY, customparams.prev.rotateZ],
                    opacity: customparams.prev.opacity,
                    scale: customparams.prev.scale,
                    shadow: customparams.prev.shadow,
                    origin: customparams.prev.origin,
                },
                next: {
                    translate: [customparams.next.translateX, customparams.next.translateY, customparams.next.translateZ],
                    rotate: [customparams.next.rotateX, customparams.next.rotateY, customparams.next.rotateZ],
                    opacity: customparams.next.opacity,
                    scale: customparams.next.scale,
                    shadow: customparams.next.shadow,
                    origin: customparams.next.origin,
                },
                perspective: true
            } : null,
            breakpoints: {
                320: {
                    slidesPerView: slidesPerViewM ? slidesPerViewM : slidesPerView,
                    spaceBetween: spaceBetweenM ? spaceBetweenM : spaceBetween
                },
                768: {
                    slidesPerView: slidesPerViewT ? slidesPerViewT : slidesPerView,
                    spaceBetween: spaceBetweenT ? spaceBetweenT : spaceBetween
                },
                1024: {
                    spaceBetween,
                    slidesPerView
                }
            },
            pagination: {
                el: swiperobj.querySelector('.swiper-pagination'),
                type: 'bullets',
            },

            navigation: { nextEl: swiperobj.querySelector('.swiper-button-next'), prevEl: swiperobj.querySelector('.swiper-button-prev') },

            scrollbar: {
                el: swiperobj.querySelector('.swiper-scrollbar'),
                draggable: true,
            },
        }
    );

}