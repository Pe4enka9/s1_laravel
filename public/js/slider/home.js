document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.mySwiper', {
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'custom-bullet',
            bulletActiveClass: 'active',
        },
    });
});
