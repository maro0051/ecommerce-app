@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">About Our Store</h1>
            <p class="text-gray-400 text-lg max-w-3xl mx-auto">Learn more about who we are and what makes us unique</p>
        </div>

        <!-- Main Content -->
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <div class="glass-card p-2 rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=400&fit=crop" 
                         alt="About us" 
                         class="w-full h-96 object-cover rounded-xl">
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold gradient-text mb-4">Our Story</h2>
                <p class="text-gray-300 mb-4 leading-relaxed">
                    Founded in 2024, we started with a simple mission: to provide high-quality products 
                    at affordable prices while delivering exceptional customer service.
                </p>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    What began as a small online store has grown into a trusted destination for thousands 
                    of customers. We carefully curate our product selection, ensuring only the best items 
                    make it to our virtual shelves.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Premium quality products</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Secure and fast delivery</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>100% customer satisfaction guaranteed</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Eco-friendly packaging materials</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="glass-card p-6 text-center">
                <div class="w-20 h-20 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullseye text-3xl text-accent"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Our Mission</h3>
                <p class="text-gray-400">To provide the best online shopping experience through quality products, competitive pricing, and outstanding customer service.</p>
            </div>
            <div class="glass-card p-6 text-center">
                <div class="w-20 h-20 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-3xl text-accent"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Our Vision</h3>
                <p class="text-gray-400">To become the most trusted and preferred online shopping destination worldwide.</p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold gradient-text text-center mb-8">Our Core Values</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-heart text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Customer First</h3>
                    <p class="text-gray-400 text-sm">Our customers are at the heart of everything we do.</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-star text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Quality Assurance</h3>
                    <p class="text-gray-400 text-sm">We never compromise on product quality.</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-leaf text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Sustainability</h3>
                    <p class="text-gray-400 text-sm">Committed to eco-friendly practices.</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-handshake text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Integrity</h3>
                    <p class="text-gray-400 text-sm">Honest and transparent business practices.</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-lightbulb text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Innovation</h3>
                    <p class="text-gray-400 text-sm">Constantly improving and evolving.</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <i class="fas fa-users text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="text-lg font-semibold mb-2">Community</h3>
                    <p class="text-gray-400 text-sm">Building a strong customer community.</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div>
            <h2 class="text-3xl font-bold gradient-text text-center mb-8">Meet Our Team</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto mb-4 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-circle text-6xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold">John Smith</h3>
                    <p class="text-accent text-sm mb-2">CEO & Founder</p>
                    <p class="text-gray-400 text-sm">15+ years of experience in e-commerce</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-circle text-6xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Sarah Johnson</h3>
                    <p class="text-accent text-sm mb-2">Operations Manager</p>
                    <p class="text-gray-400 text-sm">Expert in supply chain management</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-circle text-6xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Michael Chen</h3>
                    <p class="text-accent text-sm mb-2">Customer Support Lead</p>
                    <p class="text-gray-400 text-sm">Dedicated to customer satisfaction</p>
                </div>
                <div class="glass-card p-6 text-center group hover:-translate-y-2 transition-all">
                    <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto mb-4 flex items-center justify-center group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-circle text-6xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold">Emily Davis</h3>
                    <p class="text-accent text-sm mb-2">Marketing Director</p>
                    <p class="text-gray-400 text-sm">Creative marketing strategist</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection