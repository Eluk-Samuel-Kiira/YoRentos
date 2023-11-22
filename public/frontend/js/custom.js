// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}
getYear();


$(document).ready(function() {
    const carousel = $('.carousel');
    const slides = $('.slide');
    let slideIndex = 0;

    function showSlide() {
        carousel.css('transform', `translateX(-${slideIndex * 100}%)`);
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide();
    }

    function prevSlide() {
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlide();
    }

    $('.next').click(nextSlide);

    $('.prev').click(prevSlide);

    // Function to automatically change slide every 4 seconds
    setInterval(nextSlide, 5000);
});


function toggleNav() {
    var overlay = document.getElementById("myNav");
    if (overlay.style.width === "100%") {
        overlay.style.width = "0";
    } else {
        overlay.style.width = "100%";
    }
}
