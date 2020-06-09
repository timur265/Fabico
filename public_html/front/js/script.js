'use strict';


// Hamburger  menu

function navBar() {
    let openBtn = document.querySelector('#open'),
        closeBtn = document.querySelector('#close'),
        navMenu = document.querySelector('.nav-menu');

    openBtn.addEventListener('click', () => {
        navMenu.style.display = "block";
    });
    closeBtn.addEventListener('click', () => {
        navMenu.style.display = "none";
    });
}

navBar();


//Animation In Promo Block

(function() {
    var $set1 = $('.promoBlock__field');
    var $set2 = $('.promoBlock__img');
    var $widthWrap = $('.promoBlock__wrapper').outerWidth();
    var $widthSect = $widthWrap / $set1.length;

    $('.promoBlock__hoverFields').on('mouseover', '.promoBlock__field', function() {
        var n = $set1.index(this);
        for (var i = 0; i < $set2.length; i++) {
            if (n == i) {
                $set2.removeClass('promoBlock__img--active');
                $set2[i].classList.add('promoBlock__img--active');
            }
        }
    });
}());


//Check Color on Card Page

(function() {

    var slides = $('.card .card--slider');
    var colorButtons = $('.card .circle-wrapper');
    var firstSlider = $('.card--slider .card-slideshow__bg')[0];
    var sliders = $('.card--slider .card-slideshow__bg');

    $(colorButtons).click(function() {

        $('#colorHex').attr('value', $(this).data('color-hex'));
        $('#colorName').attr('value', $(this).data('color-name'));

        for( var i = 0; i < sliders.length; i++) {
            sliders[i].style.minHeight = firstSlider.style.minHeight;
        }

        for (var i = 0; i < slides.length; i++) {
            if ($(this).attr('data-color') != slides[i].dataset.color) {
                slides[i].style.display = "none";
            } else {
                slides[i].style.display = "block";
            }
        }

    });

}());


// Active filters

(function() {
    var $dropdown = $('.catalogSortDropdown');

    $dropdown.each(function() {
        var $dropdownItem = $(this).find('.catalogSortDropdownItem');

        $dropdownItem.on('click', function() {
            $dropdownItem.each(function() {
                $dropdownItem.removeClass('filter--active');
            });
            this.classList.add('filter--active');
        });
    });

}());


// Check color on catalog page

(function() {

    var card = $('.catalog-card');
    card.each(function() {

        var cardImg = $(this).find('.catalog-card__img img');
        var colorImg = $(this).find('.catalog-card-choice__elem');

        $(colorImg).click(function() {

            for (var i = 0; i < cardImg.length; i++) {
                if ($(this).attr('data-color') != cardImg[i].dataset.color) {
                    cardImg[i].style.display = "none";
                } else {
                    cardImg[i].style.display = "block";
                }
            }
            colorImg.each(function() {
                colorImg.removeClass('catalog-card-choice__elem--active');
            });
            this.classList.add('catalog-card-choice__elem--active');
        });
    });

}());


// Check color on main page

(function() {

    var card = $('.goods-card');
    card.each(function() {

        var cardImg = $(this).find('.goods-card__img img');
        var colorBtn = $(this).find('.goods-card__color');

        $(colorBtn).click(function() {

            for (var i = 0; i < cardImg.length; i++) {
                if ($(this).attr('data-color') != cardImg[i].dataset.color) {
                    cardImg[i].style.display = "none";
                } else {
                    cardImg[i].style.display = "block";
                }
            }

        });
    });

}());


// Displaying popup 'Added to cart'

function showPopup() {
    const cartBtns = document.querySelectorAll('.catalog-card__buy .fa-shopping-cart'),
        popup = document.getElementById('popup');

    cartBtns.forEach(cartBtn => {
        cartBtn.addEventListener('click', () => {
            popup.style.opacity = '1'
            setTimeout( () => {
                popup.style.opacity = "0";
            }, 3000);
        });
    });

}

showPopup();