document.addEventListener("DOMContentLoaded",()=>{let e=0,t=0,s=setInterval(function(){$("body").css("overflow",t+"hidden"),$(".loading-page .counter h1").html(t+"%"),$(".loading-page .counter hr").css("width",t+"%"),t++,101==++e&&(clearInterval(s),$(".loading-page").addClass("close"),$(".loading-page").css("opacity","0"),$("body").css("overflow",t+"visible"),setTimeout(function(){$(".loading-page").fadeOut()},500))},25);const o=document.querySelector("body");!function(){new Swiper(".stories-content",{slidesPerView:1,autoHeight:!1,wathOverflow:!0,slidesPerGroup:1,centeredSlides:!0,loop:!1,breakpoints:{320:{slidesPerView:1,spaceBetween:0},576:{slidesPerView:2,spaceBetween:60},768:{slidesPerView:3},1000:{slidesPerView:4,spaceBetween:80}},thumbs:{swiper:{el:".stories-preview",slidesPerView:4}}});const e=document.querySelectorAll(".stories-content__child");let t=[];e.forEach((e,s)=>{e.swiper||(t[s]=new Swiper(e,{slidesPerView:1,allowTouchMove:!1,effect:"fade",loop:!1,autoplay:{delay:5e3},navigation:{nextEl:".stories-content__button-next",prevEl:".stories-content__button-prev"},pagination:{el:".stories-content__pagination"}}))});const s=document.querySelector(".stories-modal");document.querySelector(".stories__close"),document.querySelectorAll(".stories-preview__item").forEach(e=>{e.addEventListener("click",()=>{s.classList.add("active"),setTimeout(function(){document.querySelectorAll(".stories-content__button-prev"),document.querySelectorAll(".stories-content__button-next")},100)})})}();const i=document.querySelector(".site__header");window.onscroll=function(e){window.scrollY>200?i.classList.add("fixed"):i.classList.remove("fixed")};const n=document.getElementById("header-nav"),c=document.querySelectorAll(".burger");c.forEach(e=>{e.addEventListener("click",()=>{e.classList.contains("burger--active")?(c.forEach(e=>{e.classList.remove("burger--active")}),n.classList.remove("open"),o.classList.remove("hidden")):(c.forEach(e=>{e.classList.add("burger--active")}),n.classList.add("open"),o.classList.add("hidden"))})}),function(){const e=document.querySelectorAll(".dentistry__tab-more"),t=document.querySelectorAll(".dentistry__path");e.forEach(e=>{e.addEventListener("click",()=>{t.forEach(t=>{t.classList.remove("active"),e.closest(".dentistry__path").classList.add("active")})})}),t.forEach(e=>{e.addEventListener("mouseover",()=>{t.forEach(e=>{e.classList.remove("active")}),e.classList.add("active")}),e.addEventListener("touchstart",()=>{t.forEach(e=>{e.classList.remove("active")}),e.classList.add("active")})})}(),function(){const e=document.querySelector(".site-header__search-button"),t=document.querySelector(".site-header__search");e.addEventListener("click",()=>{t.classList.contains("active")?t.classList.remove("active"):t.classList.add("active")}),window.innerWidth<1e3?t.classList.add("active"):t.classList.remove("active"),window.addEventListener("resize",()=>{window.innerWidth<1e3?t.classList.add("active"):t.classList.remove("active")}),window.addEventListener("resize",()=>{if(window.innerWidth<1e3){let e=document.getElementById("header-nav");e.insertBefore(t,e.children[1])}else{let e=document.getElementById("header-top");!function(e,t){t.parentNode.insertBefore(e,t.nextSibling)}(t,e.lastElementChild)}}),window.innerWidth<1e3&&n.insertBefore(t,n.children[1])}();let r=document.querySelectorAll(".modal"),a=document.querySelectorAll(".button-form");document.querySelectorAll(".closePopup").forEach(e=>{e.addEventListener("click",function(){r.forEach(e=>{e.style.display="none"})})}),a.forEach(e=>{e.addEventListener("click",function(){r.forEach(t=>{t.dataset.form==e.dataset.form&&(t.style.display="block")})})}),r.forEach(e=>{window.onclick=function(t){t.target==e&&(e.style.display="none")}})});