"use strict";
var gctoplist = document.getElementsByClassName('gc-autolistitem');
for (let i = 0; i < gctoplist.length; i++) {
    let listNode = gctoplist[i];
    listNode.addEventListener('click', function (ev) {
        ev.preventDefault();
        let targetobj = ev.currentTarget;
        let targetid = targetobj.dataset.id;
        let target = document.getElementById(targetid);
        const y = target.getBoundingClientRect().top + window.scrollY - 50;
        window.scroll({
          top: y,
          behavior: 'smooth'
        });		
    }, false);
}