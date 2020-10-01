<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TutorialSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var App\Models\User $user
     */
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
            ->subject( __('Thank you for submitting the tutorial on Majrra'))
            ->greeting(__('Hello') . " {$this->user->profile->name}!")
            ->line( __('We have recieved your submission. We will review the tutorial and get back to you when it\'s published.' ) . '<br>' )
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
