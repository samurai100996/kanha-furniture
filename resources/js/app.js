import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Alpine.js plugins
Alpine.plugin(intersect);

window.Alpine = Alpine;
window.Swiper = Swiper;

// Initialize Swiper
window.initSwiper = function() {
    return {
        init() {
            new Swiper(this.$el, {
                modules: [Navigation, Pagination, Autoplay],
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    }
}

// Search functionality
window.searchData = function() {
    return {
        query: '',
        results: [],
        showResults: false,
        loading: false,
        
        async search() {
            if (this.query.length < 2) {
                this.results = [];
                this.showResults = false;
                return;
            }
            
            this.loading = true;
            
            try {
                const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                this.results = data.products || [];
                this.showResults = true;
            } catch (error) {
                console.error('Search error:', error);
            } finally {
                this.loading = false;
            }
        },
        
        hideResults() {
            setTimeout(() => {
                this.showResults = false;
            }, 200);
        }
    }
}

// Modal functionality
window.modalData = function() {
    return {
        isOpen: false,
        
        open() {
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        close() {
            this.isOpen = false;
            document.body.style.overflow = 'auto';
        }
    }
}

Alpine.start();
