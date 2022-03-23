"use strict";

var contenttoggler = document.getElementsByClassName('gc-tgl-trigger');
for (let i = 0; i < contenttoggler.length; i++) {
    let togglerobj= contenttoggler[i];
    togglerobj.addEventListener('click', function (ev) {
        togglerobj.parentNode.classList.toggle('gc-toggler-open');
    });
}