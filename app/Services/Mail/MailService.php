<?php

namespace App\Services\Mail;

use App\Interfaces\MailInterface;
use App\Mail\BaseMail;
use Illuminate\Support\Facades\Mail;
use \Exception;

class MailService implements MailInterface
{
    /**
     * @var array $from
     */
    private array $from;

    /**
     * @var string $to
     */
    private string $to;

    /**
     * @var string $subject
     */
    private string $subject;

    /**
     * @var string $template
     */
    private string $template;

    /**
     * @var array $body
     */
    private array $body;

    /**
     * @var array $attachments
     */
    private array $attachments;

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @param array $from
     * @return $this
     */
    public function setFrom(array $from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function setTo(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'emails.'.$this->template;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setBody(array $data): self
    {
        $this->body = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     * @return $this
     */
    public function setAttachments(array $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function send(): bool
    {
        try {
            Mail::to($this->getTo())->send(new BaseMail($this));

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
