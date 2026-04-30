document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.mySwiper', {
        direction: 'vertical',
        speed: 800,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'custom-bullet',
            bulletActiveClass: 'active',
        },
    });
});
