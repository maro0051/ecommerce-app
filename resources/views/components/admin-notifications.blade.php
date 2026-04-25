<div x-data="notificationSystem()" x-init="init()" class="relative">
    <!-- Notification Bell Icon -->
    <button @click="toggleNotifications" 
            class="relative text-gray-300 hover:text-accent transition-colors duration-300">
        <i class="fas fa-bell text-xl"></i>
        
        <!-- Unread Badge -->
        <span x-show="unreadCount > 0" 
              x-text="unreadCount"
              class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
        </span>
    </button>
    
    <!-- Notifications Dropdown -->
    <div x-show="isOpen" 
         @click.away="isOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="absolute right-0 mt-2 w-80 sm:w-96 glass-card rounded-lg shadow-xl z-50 max-h-96 overflow-y-auto"
         style="display: none;">
        
        <div class="p-3 border-b border-primary-light/30 sticky top-0 glass-card">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold gradient-text">Notifications</h3>
                <button @click="markAllAsRead" 
                        x-show="unreadCount > 0"
                        class="text-xs text-accent hover:text-accent-light">
                    Mark all as read
                </button>
            </div>
        </div>
        
        <div x-show="loading" class="p-8 text-center">
            <i class="fas fa-spinner fa-spin text-accent text-2xl"></i>
            <p class="text-gray-400 mt-2">Loading notifications...</p>
        </div>
        
        <div x-show="!loading && notifications.length === 0" class="p-8 text-center">
            <i class="fas fa-bell-slash text-4xl text-gray-600 mb-2"></i>
            <p class="text-gray-400">No notifications yet</p>
        </div>
        
        <template x-for="notification in notifications" :key="notification.id">
            <div @click="markAsRead(notification)" 
                 class="notification-item p-3 border-b border-primary-light/20 hover:bg-primary-light/10 cursor-pointer transition-all"
                 :class="{'bg-primary-light/5': !notification.read_at}">
                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-accent"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm" x-text="notification.data.message"></p>
                        <p class="text-xs text-gray-400 mt-1" x-text="notification.time_ago"></p>
                        <div class="mt-2">
                            <a :href="'/admin/orders/' + notification.data.order_id" 
                               class="text-xs text-accent hover:text-accent-light">
                                View Order →
                            </a>
                        </div>
                    </div>
                    <div x-show="!notification.read_at" class="w-2 h-2 bg-accent rounded-full"></div>
                </div>
            </div>
        </template>
    </div>
    
    <!-- Toast Container for Real-time Notifications -->
    <div class="fixed bottom-4 right-4 z-50 space-y-2" id="toast-container"></div>
</div>

<script>
function notificationSystem() {
    return {
        isOpen: false,
        notifications: [],
        unreadCount: 0,
        loading: true,
        echo: null,
        
        init() {
            this.loadNotifications();
            this.listenForNewOrders();
            this.startPolling();
        },
        
        toggleNotifications() {
            this.isOpen = !this.isOpen;
            if (this.isOpen && this.unreadCount > 0) {
                // Don't auto-mark as read, let user click
            }
        },
        
        async loadNotifications() {
            this.loading = true;
            try {
                const response = await fetch('/admin/notifications');
                const data = await response.json();
                this.notifications = data.notifications;
                this.unreadCount = data.unread_count;
            } catch (error) {
                console.error('Error loading notifications:', error);
            } finally {
                this.loading = false;
            }
        },
        
        async markAsRead(notification) {
            if (!notification.read_at) {
                try {
                    await fetch(`/admin/notifications/${notification.id}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    
                    notification.read_at = new Date().toISOString();
                    this.unreadCount = Math.max(0, this.unreadCount - 1);
                    this.showToast('Notification marked as read', 'info');
                } catch (error) {
                    console.error('Error marking notification as read:', error);
                }
            }
            
            // Redirect to order page
            window.location.href = `/admin/orders/${notification.data.order_id}`;
        },
        
        async markAllAsRead() {
            try {
                await fetch('/admin/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                this.notifications.forEach(n => n.read_at = new Date().toISOString());
                this.unreadCount = 0;
                this.showToast('All notifications marked as read', 'success');
            } catch (error) {
                console.error('Error marking all as read:', error);
            }
        },
        
        listenForNewOrders() {
            // Polling fallback (every 30 seconds)
            setInterval(() => {
                this.checkForNewOrders();
            }, 30000);
        },
        
        async checkForNewOrders() {
            try {
                const response = await fetch('/admin/notifications/check-new');
                const data = await response.json();
                
                if (data.has_new) {
                    this.loadNotifications();
                    this.showToast(data.message, 'success');
                    this.playNotificationSound();
                }
            } catch (error) {
                console.error('Error checking new orders:', error);
            }
        },
        
        startPolling() {
            // Real-time updates using Laravel Echo (if configured)
            if (typeof Echo !== 'undefined') {
                Echo.channel('orders')
                    .listen('NewOrderNotification', (e) => {
                        this.loadNotifications();
                        this.showToast(e.order.message, 'success');
                        this.playNotificationSound();
                    });
            }
        },
        
        showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `transform transition-all duration-300 translate-x-full`;
            toast.innerHTML = `
                <div class="glass-card p-4 rounded-lg shadow-xl min-w-[300px] animate-slide-in">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            ${type === 'success' ? '<i class="fas fa-check-circle text-green-400 text-xl"></i>' : '<i class="fas fa-info-circle text-accent text-xl"></i>'}
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">${type === 'success' ? 'New Order!' : 'Notification'}</p>
                            <p class="text-sm text-gray-300">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            
            document.getElementById('toast-container').appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            }, 100);
            
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        },
        
        playNotificationSound() {
            // Play notification sound (optional)
            try {
                const audio = new Audio('/sounds/notification.mp3');
                audio.play().catch(e => console.log('Audio play failed:', e));
            } catch (error) {
                console.log('Sound not supported');
            }
        }
    };
}
</script>

<style>
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
}

.notification-item {
    transition: all 0.2s ease;
}

.notification-item:hover {
    transform: translateX(5px);
}
</style>