<?php
/**to create this you may type this cammand
php artisan make:notification WelcomeNotification
*/
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    // php artisan queue:table
    // to generate a notication logs
    // in env EDIT QUEUE_CONNECTION=database
    // php artisan queue:list to monitor the sending emails


    /**
     * Create a new notification instance.
     */
    public $post;
    public function __construct($post)
    {
        //
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line($this->post['title'])
                    ->action('Notification Action', url('/'. $this->post['slug']))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
