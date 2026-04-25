<footer class="bg-primary-dark/50 border-t border-primary-light/30 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold gradient-text mb-4">E-Commerce Store</h3>
                <p class="text-gray-400 text-sm">Premium quality products at best prices. Fast shipping & 24/7 support.</p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-accent"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-accent"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-accent"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-accent"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-accent">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-accent">Contact</a></li>
                    <li><a href="{{ route('help') }}" class="hover:text-accent">Help Center</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-accent">FAQ</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Policies</h3>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('privacy') }}" class="hover:text-accent">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-accent">Terms & Conditions</a></li>
                    <li><a href="{{ route('shipping') }}" class="hover:text-accent">Shipping Info</a></li>
                    <li><a href="{{ route('returns') }}" class="hover:text-accent">Returns Policy</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><i class="fas fa-map-marker-alt mr-2 text-accent"></i> 123 E-Commerce Street</li>
                    <li><i class="fas fa-phone mr-2 text-accent"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope mr-2 text-accent"></i> support@ecommercestore.com</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-primary-light/30 mt-8 pt-8 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} E-Commerce Store. All rights reserved.</p>
        </div>
    </div>
</footer>