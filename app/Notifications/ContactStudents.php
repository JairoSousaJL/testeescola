<?php

namespace App\Notifications;

use App\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactStudents extends Notification implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    protected $st;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Student $student)
    {
        $this->st = $student;
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
        $url = 'https://laravel.com/docs/8.x';
        
        return (new MailMessage)
                ->greeting('Olá '.$this->st->name_student)
                    ->line('Seja BEM-VINDO, sua matrícula foi realizada com sucesso.')
                    ->action('Confirmar Dados', $url);
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
