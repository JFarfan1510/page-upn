"use strict";!function(){document.onreadystatechange=function(){"interactive"===document.readyState&&t(".superblockslider")};var t=function(t){document.querySelectorAll(t).forEach(function(n,t){var r={initialActiveSlide:n.getAttribute("data-initial-active-slide")?parseInt(n.getAttribute("data-initial-active-slide")):0,loopSlide:!n.getAttribute("data-loop-slide"),autoplay:!n.getAttribute("data-autoplay"),autoplayInterval:n.getAttribute("data-autoplay-interval")?n.getAttribute("data-autoplay-interval"):"1.5s",slideNavigation:n.getAttribute("data-slide-navigation")?n.getAttribute("data-slide-navigation"):"dots",hoverPause:!n.getAttribute("data-hover-pause"),transitionEffect:n.getAttribute("data-transition-effect")?n.getAttribute("data-transition-effect"):"slide",transitionDuration:n.getAttribute("data-transition-duration")?n.getAttribute("data-transition-duration"):".6s",animation:n.getAttribute("data-animation")?n.getAttribute("data-animation"):"cubic-bezier(0.46, 0.03, 0.52, 0.96)",transitionSpeed:n.getAttribute("data-transition-speed")?n.getAttribute("data-transition-speed"):".6s",arrowNavigation:!n.getAttribute("data-arrow-navigation")},o=r.initialActiveSlide,l=r.initialActiveSlide,s=!1,d=n.querySelector(".superblockslider__track"),u=n.querySelectorAll(".superblockslider__slide"),e=n.querySelector(".superblockslider__button__previous"),i=n.querySelector(".superblockslider__button__next");d.addEventListener("transitionstart",function(){s=!0}),d.addEventListener("transitionend",L);var a,c,p,v,f,b=100/u.length,g="translateX(-"+o*b+"%)",A=n.getBoundingClientRect().y,y=window.pageYOffset,_=A+y,m=window.innerHeight,w=n.querySelectorAll('.superblockslider__slide[data-parallax="true"]'),S=0;function h(){S=window.scrollY-window.innerHeight,w.forEach(function(i,t){window.requestAnimationFrame(function(){var t=i.getAttribute("data-parallax-speed")?parseInt(i.getAttribute("data-parallax-speed"))/100:0;A=n.getBoundingClientRect().y,y=window.pageYOffset+200,_=A+y,m=window.innerHeight,a=_/m*100;var e=i.querySelectorAll(".superblockslider__slide__bg")[0];e.querySelectorAll("img")[0].style.height=100+100*t+a+"%",k(e,S,t)})})}function k(t,e,i){t.style.transform="translateY("+e*i+"px)"}w&&(h(),window.addEventListener("scroll",function(t){S=window.scrollY-window.innerHeight,w.forEach(function(i,t){window.requestAnimationFrame(function(){var t=i.querySelectorAll(".superblockslider__slide__bg")[0],e=i.getAttribute("data-parallax-speed")?parseInt(i.getAttribute("data-parallax-speed"))/100:0;k(t,S,e)})})}),window.addEventListener("resize",h)),1==r.autoplay&&(f=0<r.autoplayInterval.indexOf("ms")?v=parseInt(r.autoplayInterval.split("ms")[0]):(p=Number(r.autoplayInterval.split("s")[0]),v=1e3*p),"number"==typeof v&&(window.requestAnimationFrame(function t(e){void 0===c&&(c=e);"pause"===f&&(c=e);var i=e-c;window.requestAnimationFrame(t);f<=i&&(c=e,x())}),1==r.hoverPause&&(n.addEventListener("mouseover",function(t){f="pause"}),n.addEventListener("mouseout",function(t){f=v}))));var q=n.querySelectorAll(".superblockslider__button");function E(i){var t,e,a;s||l!=i&&(u=n.querySelectorAll(".superblockslider__slide"),a=i,0==r.loopSlide||"slide"==r.transitionEffect&&1==r.loopSlide&&(0===o&&2<u.length?(d.style.transition="none",t=u[u.length-1],d.prepend(t),g="translateX(-"+(o=1)*b+"%)",d.style.transform=g):o===u.length-1&&(d.style.transition="none",o=u.length-2,g="translateX(-"+o*b+"%)",d.style.transform=g,e=u[0],d.append(e)),(t=n.querySelectorAll('[data-slide-index="'+i+'"]'))[0]&&t[0].parentNode&&(e=t[0].parentNode.children,a=Array.from(e).indexOf(t[0]))),setTimeout(function(){var t,e;t=i,e=a,"slide"==r.transitionEffect?(d.style.transition="all "+r.transitionDuration+" "+r.animation,g="translateX(-"+e*b+"%)",d.style.transform=g,o=e,l=t):"fade"==r.transitionEffect&&(o=e,l=t,L())},100))}function L(){n.querySelector(".superblockslider__slide--active").classList.remove("superblockslider__slide--active"),n.querySelector('[data-slide-index="'+l+'"]').classList.add("superblockslider__slide--active"),"none"!=r.slideNavigation&&(n.querySelector(".superblockslider__button--active").classList.remove("superblockslider__button--active"),q[l].classList.add("superblockslider__button--active")),"slide"==r.transitionEffect&&(d.style.transition="all "+r.transitionDuration+" "+r.animation),s=!1}function x(){var t=l+1;E(t=t>u.length-1?0:t)}"none"!=r.slideNavigation&&q.forEach(function(t){t.addEventListener("click",function(){s||E(parseInt(t.getAttribute("data-button-id")))})}),e&&i&&(e.addEventListener("click",function(){var t=l-1;t<0&&(t=u.length-1);E(t)}),i.addEventListener("click",x))})}}();