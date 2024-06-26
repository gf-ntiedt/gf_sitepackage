const NavBarMain = document.getElementById('navbar-nav-main');
const NavItemsLevel2 = NavBarMain.querySelectorAll('div.level-2 ul > li.hassubpages > button');

NavItemsLevel2.forEach((navitem)=>{
    navitem.addEventListener('click', function (e) {
        const target = this.dataset.target;
        const myCollapsible = document.getElementById(target);
        const innerWidth = window.innerWidth;

        if( innerWidth > 992 ){
            VisibleItems = NavBarMain.querySelectorAll('div.collapse.level-3.show');
            VisibleItems.forEach((item)=>{
                item.classList.remove('show');
            })

            if(myCollapsible.classList.contains('show')){
                myCollapsible.classList.remove('show');
            }else{
                myCollapsible.classList.add('show');
            }

            return false;
        }
    })
})
