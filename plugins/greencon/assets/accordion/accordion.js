"use strict";
var gcaccordion = document.getElementsByClassName('gc-accordion');
for (let i = 0; i < gcaccordion.length; i++) {
    let accordionNode = gcaccordion[i];
    accordionNode.addEventListener('click', function (ev) {
        if (!ev.target.matches('.gc-accordion-item__heading')) return;
        else{
            if(ev.target.parentNode.parentNode.classList.contains('gcopen')){
                if(ev.target.parentNode.parentNode.parentNode.classList.contains('togglelogic')){
                    const items = accordionNode.getElementsByClassName('gc-accordion-item');
                    for (let i = 0; i < items.length; i++) {
                        items[i].classList.replace("gcopen", "gcclose");
                    }
                }else{
                    ev.target.parentNode.parentNode.classList.replace("gcopen", "gcclose");
                }

            }else{
                if(ev.target.parentNode.parentNode.parentNode.classList.contains('togglelogic')){
                    const items = accordionNode.getElementsByClassName('gc-accordion-item');
                    for (let i = 0; i < items.length; i++) {
                        items[i].classList.replace("gcopen", "gcclose");
                    }
                }
                ev.target.parentNode.parentNode.classList.replace("gcclose", "gcopen");
                ev.target.parentNode.nextSibling.classList.add('stuckMoveDownOpacity');
            }
        }		
    }, false);
}
