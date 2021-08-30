<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \Exception;
use App\Interfaces\MailInterface;

class BaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private MailInterface $mailInterface)
    {
    }

    /**
     * @return BaseMail
     * @throws Exception
     */
    public function build(): BaseMail
    {
        $template = $this->mailInterface->getTemplate();
        if (!view()->exists($template)) {
            throw new Exception(__('exceptions.php.template_no_found'));
        }

        $mail = $this->view($template, [
            'data' => $this->mailInterface->getBody()
        ])
            ->subject($this->mailInterface->getSubject())
            ->from($this->mailInterface->getFrom()['address'], $this->mailInterface->getFrom()['name']);

//        if ($this->mailInterface->getAttachments()) {
//            $mail->attachments = $this->mailInterface->getAttachments();
//        }

        return $mail;
    }
}
