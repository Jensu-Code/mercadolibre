import '../theme/css/slick.css';

// JS
import '../theme/js/slick.min';

$(document).ready(function () {
    // ========================= Wishlist Js Start ===================
    $('.product-card__wishlist').on('click', function() {
        $(this).toggleClass('active')
    });
    // ========================= Wishlist Js End ===================

    // ========================= Selling Product Js Start ==============
    $('.selling-product-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1500,
        dots: true,
        pauseOnHover: true,
        arrows: true,
        draggable: true,
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    // ========================= Selling Product Js End ===================


    // ========================= Brand Slider Js Start ==============
    $('.brand-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1500,
        dots: false,
        pauseOnHover: true,
        arrows: false,
        draggable: true,
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            },
        ]
    });
    // ========================= Brand Slider Js End ===================
});
