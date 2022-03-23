function gcInitTabs(elem){
    "use strict";
    //addEventListener on mouse click

    document.addEventListener('DOMContentLoaded', function() {
        var tabsobj = document.getElementsByClassName('gcp-tabs');
        for (let i = 0; i < tabsobj.length; i++) {    
            let tabsobjnode = tabsobj[i];
            if(tabsobjnode.classList.contains('tabswiper')){
                tabsobjnode.classList.add('gcswiper-container-' + i);
                let autoplayenable = tabsobjnode.getAttribute("data-autoplay");
                let autoplaytime = parseInt(tabsobjnode.getAttribute("data-autoplaytime"))*1000;
                let autoplayobj = (autoplayenable ==='true') ? {delay: autoplaytime,disableOnInteraction: true} : false;
                window['swiper'+i] = new Swiper( '.gcswiper-container-' + i + ' .t-panel-container', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    grabCursor: true,
                    speed: 700,
                    on: {
                        slideChange: function (swiper) {
                            let btns = tabsobjnode.querySelectorAll('.t-btn');
                            findActivetabElementAndRemoveIt(btns);
                            btns[swiper.activeIndex].classList.add('active');
                        }
                    },
                    autoplay: autoplayobj,
                }); 
            }
        }

        var tabsbuttons = document.getElementsByClassName('t-btn');
        for (let i = 0; i < tabsbuttons.length; i++) {
            tabsbuttons[i].addEventListener('click', function (e) {
                let targetnode = e.currentTarget;
                if(!targetnode.classList.contains('active')){
                    let tabnode = targetnode.closest(elem);
                    let btns = tabnode.querySelectorAll('.t-btn');
                    let panels = tabnode.querySelectorAll('.t-panel');
                    findActivetabElementAndRemoveIt(btns);
                    findActivetabElementAndRemoveIt(panels);
         
                    targetnode.classList.add('active');  
                    var nodes = Array.prototype.slice.call( targetnode.parentNode.children );   
                    let index = nodes.indexOf( targetnode);         
                    var panel = panels[index];
                    if(tabnode.classList.contains('tabswiper')){
                        tabnode.querySelector('.t-panel-container').swiper.slideTo(index, 500, false);
                    }else{
                        panel.classList.add('active');
                    }
                    
                }
            });
        }

    });



}
 
//if option true remove active class from added element
function findActivetabElementAndRemoveIt(nodeList){
    "use strict";
    Array.prototype.forEach.call(nodeList, function (e) {
        e.classList.remove('active');
    });
}

gcInitTabs('.gcp-tabs');