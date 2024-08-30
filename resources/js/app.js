import './bootstrap';
import Alpine from 'alpinejs';
import './theme-manager';
import.meta.glob([
    '../assets/**',
]);

window.Alpine = Alpine;

Alpine.start();
