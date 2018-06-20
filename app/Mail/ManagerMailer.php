<?php
declare (strict_types = 1);

namespace App\Mail;

use App\Models\Message;
use Illuminate\{
    Bus\Queueable,
    Mail\Mailable,
    Queue\SerializesModels
};

/**
 * Class ManagerMailer
 * @package App\Mail
 */
class ManagerMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Message
     */
    public $userMessage;

    /**
     * ManagerMailer constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->userMessage = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.manager-notification');
    }
}
