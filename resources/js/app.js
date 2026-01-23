import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

// Add navigate polyfill for Livewire compatibility
Alpine.navigate = Alpine.navigate || function() { 
    console.warn('Alpine.navigate is not available'); 
};

window.Alpine = Alpine;

Alpine.start();
