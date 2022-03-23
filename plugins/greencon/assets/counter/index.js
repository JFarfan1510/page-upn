"use strict";
function gccounteranimate(obj, initVal, lastVal, duration) {

    let startTime = null;
    let currentTime = Date.now();

    const step = (currentTime) => {
        if (!startTime) {
            startTime = currentTime;
        }
        const progress = Math.min((currentTime - startTime) / (duration * 1000), 1);
        obj.innerHTML = Math.floor(progress * (lastVal - initVal) + initVal);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
        else {
            window.cancelAnimationFrame(window.requestAnimationFrame(step));
        }
    };
    window.requestAnimationFrame(step);
}

var gccounter = document.getElementsByClassName('gc-counter');
for (let i = 0; i < gccounter.length; i++) {
    let counterobj = gccounter[i];
    let start = parseInt(counterobj.dataset.start);
    let end = parseInt(counterobj.dataset.end);
    let duration = parseFloat(counterobj.dataset.duration);
    gccounteranimate(counterobj, start, end, duration);
}