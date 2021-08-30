<?php

namespace App\Interfaces;

interface LogInterface
{
    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * @param string $action
     * @return self
     */
    public function setAction(string $action): self;

    /**
     * @param string $message
     * @return self
     */
    public function setMessage(string $message): self;

    /**
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * @param int $userId
     * @return self
     */
    public function setUserId(int $userId): self;

    /**
     * @return int|null
     */
    public function getUserId(): ?int;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string|null
     */
    public function getMessage(): ?string;

    /**
     * @return string|null
     */
    public function getCode(): ?string;
}
