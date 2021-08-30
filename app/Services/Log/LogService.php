<?php

namespace App\Services\Log;

use App\Interfaces\LogInterface;

class LogService implements LogInterface
{
    /**
     * @var array|string[] $type
     */
    public static array $types = [
        'ERROR' => 'ERROR',
        'SUCCESS' => 'SUCCESS'
    ];

    public static array $actions = [
        'REGISTER' => 'REGISTER',
    ];

    /**
     * @var string $action
     */
    private string $action;

    /**
     * @var string $type
     */
    private string $type;

    /**
     * @var string|null $message
     */
    private string|null $message;

    /**
     * @var string|null $code
     */
    private string|null $code;

    /**
     * @var int|null $userId
     */
    private int|null $userId;

    /**
     * @param string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param int $userId
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
