<?php

namespace App\Interfaces;

/**
 * @package App\Interfaces
 */
interface MailInterface
{
    /**
     * @param string $to
     * @return $this
     */
    public function setTo(string $to): self;

    /**
     * @param array $from
     * @return $this
     */
    public function setFrom(array $from): self;

    /**
     * @param array $attachments
     * @return $this
     */
    public function setAttachments(array $attachments): self;

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template): self;

    /**
     * @param array $data
     * @return $this
     */
    public function setBody(array $data): self;

    /**
     * @return string
     */
    public function getTo(): string;

    /**
     * @return array
     */
    public function getFrom(): array;

    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @return string
     */
    public function getTemplate(): string;

    /**
     * @return array
     */
    public function getBody(): array;

    /**
     * @return array
     */
    public function getAttachments(): array;

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): self;

    public function send();
}
