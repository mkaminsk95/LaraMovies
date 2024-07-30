import Glide from '@glidejs/glide';
import "@glidejs/glide/dist/css/glide.core.min.css";
import "@glidejs/glide/dist/css/glide.theme.min.css";

document.addEventListener('DOMContentLoaded', () => {
    const carouselElements = document.querySelectorAll('.glide');

    carouselElements.forEach((carouselElement) => {

        let perViewExtraSmall = 3 , perViewSmall = 4.7, perViewMedium = 5.6, perViewLarge = 8.4;

        if (carouselElement) {
            const settings = JSON.parse(carouselElement.getAttribute('data-carousel-settings'));
            if (settings) {
                perViewExtraSmall = settings.perViewExtraSmall != null ? settings.perViewExtraSmall : perViewExtraSmall;
                perViewSmall = settings.perViewSmall != null ? settings.perViewSmall : perViewSmall;
                perViewMedium = settings.perViewMedium != null ? settings.perViewMedium : perViewMedium;
                perViewLarge = settings.perViewLarge != null ? settings.perViewLarge : perViewLarge;
            }
        }

        const glide = new Glide(carouselElement, {
            type: 'slider',
            startAt: 0,
            perView: perViewLarge,
            bound: true,
            gap: 30,
            breakpoints: {
                640: {
                    perView: perViewExtraSmall,
                    gap: 15
                },
                768: {
                    perView: perViewSmall,
                    gap: 20
                },
                1024: {
                    perView: perViewMedium,
                    gap: 20
                }
            }
        });
        glide.mount();

        window.dispatchEvent(new Event('glidemounted'));
    });
});
