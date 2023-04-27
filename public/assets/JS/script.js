// first function for the swiper of the images of the homepage
var swiper = new Swiper(".home-slider", {
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
    ,includedLanguages: 'ar,fr,en,es'}, 'google_translate_element');
}


// second function of the swiper for the posts 
var swiper = new Swiper(".slide-content", {
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

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});


// coloring the hearts of like
const hearts = document.querySelectorAll('.fa-heart');
hearts.forEach(heart => {
    heart.addEventListener("click", () => {
    if (heart.style.color === 'red') {
      heart.style.color = ''; // Set the color property of the style object to an empty string to remove the inline style
    } else {
      heart.style.color = 'red'; // Set the color property of the style object to 'red' if it's not already red
    }
    });
});