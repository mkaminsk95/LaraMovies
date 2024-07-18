import Glide from '@glidejs/glide';
import "@glidejs/glide/dist/css/glide.core.min.css";
import "@glidejs/glide/dist/css/glide.theme.min.css";


document.addEventListener('DOMContentLoaded', () => {
    new Glide('.glide', {
        type: 'slider',
        startAt: 0,
        perView: 6.4,
        bound: true,
        gap: 30,
        breakpoints: {
            768: {
                perView: 4.7
            },
            1024: {
                perView: 5.6
            }
        }
    }).mount();
});