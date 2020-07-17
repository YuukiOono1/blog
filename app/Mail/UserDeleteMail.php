<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDeleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->subject('退会手続き完了のお知らせ') // メールのタイトル
            ->text('emails.user_delete') // テンプレート（平文）
            ->with([
                'register_url' => route('register'), // 会員登録のURL
            ]);
    }
}
