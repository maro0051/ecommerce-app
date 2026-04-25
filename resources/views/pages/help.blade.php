@extends('layouts.app')

@section('title', 'Help Center')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">How Can We Help?</h1>
            <p class="text-gray-400 text-lg max-w-3xl mx-auto">Find answers to common questions and get the support you need</p>
        </div>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       id="faqSearch" 
                       placeholder="Search for answers..." 
                       class="w-full input-glow pl-12">
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <a href="#shopping" class="glass-card p-6 text-center hover:-translate-y-2 transition-all group">
                <i class="fas fa-shopping-bag text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-semibold">Shopping</h3>
                <p class="text-sm text-gray-400">Orders, products, recommendations</p>
            </a>
            <a href="#payments" class="glass-card p-6 text-center hover:-translate-y-2 transition-all group">
                <i class="fas fa-credit-card text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-semibold">Payments</h3>
                <p class="text-sm text-gray-400">Billing, refunds, promotions</p>
            </a>
            <a href="#shipping" class="glass-card p-6 text-center hover:-translate-y-2 transition-all group">
                <i class="fas fa-truck text-3xl text-accent mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-semibold">Shipping</h3>
                <p class="text-sm text-gray-400">Delivery, tracking, returns</p>
            </a>
        </div>

        <!-- Shopping FAQs -->
        <div id="shopping" class="mb-12 scroll-mt-20">
            <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center gap-2">
                <i class="fas fa-shopping-bag text-accent"></i>
                Shopping
            </h2>
            <div class="space-y-4">
                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How do I place an order?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Simply browse our products, select the items you want, add them to your cart, and proceed to checkout. You'll need to provide shipping information and choose a payment method to complete your order.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">Can I modify or cancel my order?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Orders can be modified or canceled within 1 hour of placement. Please contact our customer support immediately if you need to make changes.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How do I track my order?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Once your order ships, you'll receive a tracking number via email. You can also track your order from your account dashboard under "My Orders".</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">What payment methods do you accept?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">We accept Credit/Debit Cards (Visa, MasterCard, American Express), PayPal, Cash on Delivery, and Bank Transfers.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment FAQs -->
        <div id="payments" class="mb-12 scroll-mt-20">
            <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center gap-2">
                <i class="fas fa-credit-card text-accent"></i>
                Payments
            </h2>
            <div class="space-y-4">
                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">Is it safe to use my credit card?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Yes! We use industry-standard SSL encryption to protect your payment information. We never store your full credit card details on our servers.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How does Cash on Delivery work?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">With Cash on Delivery, you pay the exact amount in cash to the delivery person when your order arrives. No online payment required.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How do I get a refund?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Refunds are processed within 5-7 business days after we receive and inspect your returned item. The refund will be credited to your original payment method.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping FAQs -->
        <div id="shipping" class="mb-12 scroll-mt-20">
            <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center gap-2">
                <i class="fas fa-truck text-accent"></i>
                Shipping & Delivery
            </h2>
            <div class="space-y-4">
                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How long does shipping take?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Standard shipping takes 3-5 business days. Express shipping (1-2 business days) is available at checkout for an additional fee.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">Do you ship internationally?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Currently, we ship to the United States, Canada, United Kingdom, and Australia. International shipping takes 7-14 business days.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">What is your return policy?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">We offer a 30-day return policy for unused items in original packaging. Free returns on defective products. Contact support to initiate a return.</p>
                    </div>
                </div>

                <div class="glass-card p-6 faq-item">
                    <button class="faq-question w-full text-left flex justify-between items-center">
                        <span class="text-lg font-semibold">How much does shipping cost?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer mt-3 hidden">
                        <p class="text-gray-400">Free shipping on all orders over $50. For orders under $50, shipping is $5.99 for standard delivery.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Still Need Help -->
        <div class="glass-card p-8 text-center mt-12">
            <i class="fas fa-headset text-5xl text-accent mb-4"></i>
            <h3 class="text-2xl font-bold mb-3">Still Need Help?</h3>
            <p class="text-gray-400 mb-6">Our customer support team is available 24/7 to assist you</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-primary">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Support
                </a>
                <a href="tel:+15551234567" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-all">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Call Us Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // FAQ Accordion Functionality
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const faqItem = button.closest('.faq-item');
            const answer = faqItem.querySelector('.faq-answer');
            const icon = button.querySelector('.fa-chevron-down');
            
            // Close other open FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem && item.querySelector('.faq-answer').classList.contains('show')) {
                    item.querySelector('.faq-answer').classList.remove('show');
                    item.querySelector('.faq-answer').classList.add('hidden');
                    item.querySelector('.fa-chevron-down').style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                answer.classList.add('show');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.remove('show');
                answer.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });
    
    // Search functionality
    document.getElementById('faqSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question span').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endsection