<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🛍️ New Order Received! - Order #' . $this->order->order_number)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A new order has been placed on your store.')
            ->line('**Order Details:**')
            ->line('- Order Number: ' . $this->order->order_number)
            ->line('- Customer: ' . $this->order->full_name ?? $this->order->user->name)
            ->line('- Total Amount: $' . number_format($this->order->total_amount, 2))
            ->line('- Items Count: ' . $this->order->items->count())
            ->action('View Order', route('admin.orders.show', $this->order))
            ->line('Please process this order as soon as possible.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'customer_name' => $this->order->full_name ?? $this->order->user->name,
            'total_amount' => $this->order->total_amount,
            'status' => $this->order->status,
            'message' => 'New order #' . $this->order->order_number . ' from ' . ($this->order->full_name ?? $this->order->user->name),
            'icon' => 'fas fa-shopping-cart',
            'color' => 'success'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'customer_name' => $this->order->full_name ?? $this->order->user->name,
            'total_amount' => $this->order->total_amount,
            'message' => 'New order #' . $this->order->order_number . ' received!',
            'time' => now()->diffForHumans()
        ]);
    }
}