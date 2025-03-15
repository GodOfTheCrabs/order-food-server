import 'bootstrap/dist/css/bootstrap.min.css';

import 'bootstrap';

import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.min.js';

let menuItems = document.querySelectorAll('.menu-item:not(#hide-menu)');
let btnHideMenu = document.querySelector('#hide-menu');
let menu = document.querySelector('.menu')

document.addEventListener('DOMContentLoaded', function () {
    const currentUrl = new URL(window.location.href);
    const currentPath = currentUrl.origin + currentUrl.pathname; 
    
    

    menuItems.forEach(menuItem => {
        const menuItemUrl = new URL(menuItem.href);
        const menuItemPath = menuItemUrl.origin + menuItemUrl.pathname;
        if (menuItemPath === currentPath) {
            menuItem.classList.add('active');
        } else {
            menuItem.classList.remove('active');
        }

       
        menuItem.addEventListener('click', function () {
            menuItems.forEach(item => item.classList.remove('active')); 
            this.classList.add('active');
        });
    });
});


btnHideMenu.addEventListener('click', function () {
    if(window.getComputedStyle(document.querySelector('.toggle-icon')).transform == 'matrix(1, 0, 0, 1, 0, 0)') {
        document.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
    } else {
        document.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
    }

    if(!menu.classList.contains('hide-menu-animation')) {
        menu.classList.remove('show-menu-animation')
        menu.classList.add('hide-menu-animation')
    } else {
        menu.classList.remove('hide-menu-animation')
        menu.classList.add('show-menu-animation')
    }
});


