@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Contact Us</h1>
            <p class="text-gray-400 text-lg max-w-3xl mx-auto">We'd love to hear from you! Get in touch with us anytime.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Contact Info Cards -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Visit Us</h3>
                    <p class="text-gray-400 text-sm">123 E-Commerce Street<br>Digital City, DC 12345<br>United States</p>
                </div>

                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone-alt text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Call Us</h3>
                    <p class="text-gray-400 text-sm">📞 +1 (555) 123-4567</p>
                    <p class="text-gray-400 text-sm">📠 +1 (555) 123-4568</p>
                    <p class="text-gray-400 text-sm">Toll-free: 1-800-555-1234</p>
                </div>

                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Email Us</h3>
                    <p class="text-gray-400 text-sm">sales@ecommercestore.com</p>
                    <p class="text-gray-400 text-sm">support@ecommercestore.com</p>
                    <p class="text-gray-400 text-sm">info@ecommercestore.com</p>
                </div>

                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Business Hours</h3>
                    <div class="space-y-2 text-gray-400 text-sm">
                        <div class="flex justify-between">
                            <span>Monday - Friday:</span>
                            <span>9:00 AM - 8:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Saturday:</span>
                            <span>10:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sunday:</span>
                            <span>Closed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="glass-card p-8">
                    <h2 class="text-2xl font-bold gradient-text mb-6">Send Us a Message</h2>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-user mr-2 text-accent"></i>Full Name
                                </label>
                                <input type="text" name="name" placeholder="John Doe" class="w-full input-glow" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    <i class="fas fa-envelope mr-2 text-accent"></i>Email Address
                                </label>
                                <input type="email" name="email" placeholder="hello@example.com" class="w-full input-glow" required>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-tag mr-2 text-accent"></i>Subject
                            </label>
                            <input type="text" name="subject" placeholder="What is this regarding?" class="w-full input-glow" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-comment mr-2 text-accent"></i>Message
                            </label>
                            <textarea name="message" rows="6" placeholder="Please provide details about your inquiry..." class="w-full input-glow" required></textarea>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <input type="checkbox" required class="w-4 h-4 rounded border-primary-light/30">
                            <span class="text-sm text-gray-400">I agree to the <a href="#" class="text-accent">Privacy Policy</a></span>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full md:w-auto">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Map Section -->
                <div class="glass-card p-2 mt-6 overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316bb2cbdf%3A0x6cb3e66a0b8f4e8!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1644262078695!5m2!1sen!2sus" 
                        width="100%" 
                        height="300" 
                        style="border:0; border-radius: 12px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="mt-12 text-center">
            <h3 class="text-xl font-bold gradient-text mb-4">Connect With Us</h3>
            <div class="flex justify-center gap-6">
                <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-accent/20 transition-all hover:scale-110">
                    <i class="fab fa-facebook-f text-accent text-xl"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-accent/20 transition-all hover:scale-110">
                    <i class="fab fa-twitter text-accent text-xl"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-accent/20 transition-all hover:scale-110">
                    <i class="fab fa-instagram text-accent text-xl"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-accent/20 transition-all hover:scale-110">
                    <i class="fab fa-linkedin-in text-accent text-xl"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-accent/20 transition-all hover:scale-110">
                    <i class="fab fa-youtube text-accent text-xl"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection