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



const selectBoxCat = document.querySelector('#category-select');
const selectBoxState = document.querySelector('#state-select');


// Set the initial value of the select box to the stored value, if any
const storedValueCat = localStorage.getItem('category');
if (storedValueCat) {
    selectBoxCat.value = storedValueCat;
}
const storedValueState = localStorage.getItem('state');
if (storedValueState) {
    selectBoxState.value = storedValueState;
}
// Store the selected value in local storage when an option is selected
selectBoxCat.addEventListener('change', (event) => {
    const selectedValueCat = event.target.value;
    localStorage.setItem('category', selectedValueCat);
});

selectBoxState.addEventListener('change', (event) => {
    const selectedValueState = event.target.value;
    localStorage.setItem('state', selectedValueState);
});