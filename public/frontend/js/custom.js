// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}
getYear();



// Image slide show and next and prev elements
// $(document).ready(function() {
//     $('.carousel').each(function() {
//         const carousel = $(this);
//         const slides = carousel.find('.slide');
//         let slideIndex = 0;

//         function showSlide() {
//             carousel.css('transform', `translateX(-${slideIndex * 100}%)`);
//         }

//         function nextSlide() {
//             slideIndex = (slideIndex + 1) % slides.length;
//             showSlide();
//         }

//         function prevSlide() {
//             slideIndex = (slideIndex - 1 + slides.length) % slides.length;
//             showSlide();
//         }
        

//         setInterval(nextSlide, 5000); // Automatic slideshow for each carousel
//     });
// });

function nextSlide(imageCount) {
    const carousel = $('.carousel').eq(imageCount);
    const slides = carousel.find('.slide');
    let slideIndex = carousel.data('slideIndex') || 0;

    slideIndex = (slideIndex + 1) % slides.length;
    slides.hide().eq(slideIndex).show();
    carousel.data('slideIndex', slideIndex);
}

function prevSlide(imageCount) {
    const carousel = $('.carousel').eq(imageCount);
    const slides = carousel.find('.slide');
    let slideIndex = carousel.data('slideIndex') || 0;

    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
    slides.hide().eq(slideIndex).show();
    carousel.data('slideIndex', slideIndex);
}



function toggleNav() {
    var overlay = document.getElementById("myNav");
    if (overlay.style.width === "100%") {
        overlay.style.width = "0";
    } else {
        overlay.style.width = "100%";
    }
}
