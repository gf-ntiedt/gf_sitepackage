/*!
 * GF Sitepackage v1.0.0 (https://www.gedankenfolger.de/)
 * Copyright 2017-2023 Niels Tiedt
 * Licensed under the GPL-2.0-or-later license
 */

function smoothscroll(){
    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    if (currentScroll > 0) {
        window.requestAnimationFrame(smoothscroll);
        window.scrollTo (0,currentScroll - (currentScroll/8));
    }
};

/* Nav-Section */
(new IntersectionObserver(function(e,o){
    if (e[0].intersectionRatio > 0){
        document.documentElement.removeAttribute('class');
        /* to top */
        document.getElementById('to-top').classList.remove('show');
    } else {
        document.documentElement.setAttribute('class','attached');
        /* to top */
        document.getElementById('to-top').classList.add('show');
    };
})).observe(document.querySelector('#trigger'));

/* to top */
const totop = document.getElementById("to-top");
totop.addEventListener("click", (event) => {
    smoothscroll();
});