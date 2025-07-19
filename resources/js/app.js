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
                const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
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

// Wishlist functionality
window.addEventListener('DOMContentLoaded', function() {
    // Initialize wishlist from localStorage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    
    // Update wishlist icons on page load
    updateWishlistIcons();
    
    // Add click listeners to wishlist buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.wishlist-btn')) {
            e.preventDefault();
            const button = e.target.closest('.wishlist-btn');
            const productId = button.getAttribute('data-product-id');
            toggleWishlist(productId, button);
        }
    });
    
    function toggleWishlist(productId, button) {
        const icon = button.querySelector('.wishlist-icon');
        
        if (wishlist.includes(productId)) {
            // Remove from wishlist
            wishlist = wishlist.filter(id => id !== productId);
            icon.setAttribute('fill', 'none');
            icon.classList.remove('text-red-500');
            icon.classList.add('text-gray-400');
        } else {
            // Add to wishlist
            wishlist.push(productId);
            icon.setAttribute('fill', 'currentColor');
            icon.classList.remove('text-gray-400');
            icon.classList.add('text-red-500');
        }
        
        // Save to localStorage
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        
        // Add animation effect
        button.classList.add('animate-pulse');
        setTimeout(() => button.classList.remove('animate-pulse'), 300);
    }
    
    function updateWishlistIcons() {
        document.querySelectorAll('.wishlist-btn').forEach(button => {
            const productId = button.getAttribute('data-product-id');
            const icon = button.querySelector('.wishlist-icon');
            
            if (wishlist.includes(productId)) {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-red-500');
            }
        });
    }
});

Alpine.start();
