<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TutorialPublished extends Notification
{
    use Queueable;

    /** @var App\Models\User $user */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject( __('Your submitted tutorial has been published') )
                    ->greeting(__('Hello') . " {$this->user->profile->name}!")
                    ->line( __('We have published the tutorial you have submitted to majrra. You can review your published tutorials using the button below:') )
                    ->action( __('My Published Tutorials'), url('/@'. $this->user->username))
                    ->line( __('Thank you for using majrra and sharing the knowlegde!') )
                    ->salutation( __('Regards,') . '<br>' . __('Majrra Team') );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
