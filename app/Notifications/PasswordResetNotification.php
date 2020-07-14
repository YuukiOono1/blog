<?php

namespace App\Notifications;

use App\Mail\Testmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    public $token;
    public $mail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token, Testmail $mail)
    {
        $this->token = $token;
        $this->mail = $mail;
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
        return $this->mail
            ->from(config('mail.from.address'), config('mail.from.name')) // 送信元のメールアドレス
            ->to($notifiable->email) // 送信先のメールアドレス
            ->subject('パスワード再設定') // メールのタイトル
            ->text('emails.password_reset') // テンプレート（平文）
            ->with([    // 渡すデータ
                'url' => route('password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->email,
                ]),
                'count' => config('auth.passwords.users.expire'),
            ]);
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
