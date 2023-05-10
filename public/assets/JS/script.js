// first function for the swiper of the images of the homepage
var swiper1 = new Swiper(".home-slider", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 7,
        stretch: 0,
        depth: 100,
        modifier: 2,
        slideShadows: true,
    },
    loop:true,
    autoplay:{
        delay: 1000,
        disableOnInteraction:false,
    }
});

// function of traduction of the website 
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'
    ,includedLanguages: 'ar,fr,en,es,de'}, 'google_translate_element');
}


// second function of the swiper for the posts 
var swiper2 = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    slidesPerView: 3,
    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});
