import './bootstrap';
import Alpine from 'alpinejs';
import.meta.glob([
    '../assets/**',
]);

window.Alpine = Alpine;

Alpine.start();
