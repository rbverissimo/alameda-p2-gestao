let prevScrollPos = window.scrollY || window.pageYOffset;
const navBar = document.getElementById('navbar');
const limiteScroll = 50;

window.onscroll = function(){
    const currentScrollPos = window.scrollY || window.pageYOffset;

    if(prevScrollPos > currentScrollPos){
        navBar.style.top = '0';
    } else {
        if(currentScrollPos > limiteScroll){
            navBar.style.top = `-${navBar.offsetHeight}px`;
        }
    }

    prevScrollPos = currentScrollPos;
};

