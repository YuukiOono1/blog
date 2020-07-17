<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $new_name;
    public $new_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_name, $new_email)
    {
        $this->new_name = $new_name;
        $this->new_email = $new_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name')) // 送信元のメールアドレス
            ->subject('ユーザー情報の編集') // メールのタイトル
            ->text('emails.user_update') // テンプレート（平文)
            ->with([
                'new_name' => $this->new_name,
                'new_email' => $this->new_email,
            ]);
    }
}
