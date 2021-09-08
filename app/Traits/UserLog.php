<?php

namespace App\Traits;

use App\Models\Log\Log;

trait UserLog
{
    /**
     * @var int $userId
     */
    private int $userId;

    /**
     * @var string $action
     */
    private string $action;

    /**
     * @var string|null $resourceType
     */
    private string|null $resourceType;

    /**
     * @var int|null $resourceId
     */
    private int|null $resourceId;

    /**
     * @var string $ipAddress
     */
    private string $ipAddress;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResourceType(): ?string
    {
        return $this->resourceType;
    }

    /**
     * @param string|null $resourceType
     * @return $this
     */
    public function setResourceType(?string $resourceType): self
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getResourceId(): ?int
    {
        return $this->resourceId;
    }

    /**
     * @param int|null $resourceId
     * @return $this
     */
    public function setResourceId(?int $resourceId): self
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @return Log
     */
    public function save(): Log
    {
        return Log::create([
            'user_id' => $this->getUserId(),
            'action' => $this->getAction(),
            'resource_id' => $this->getResourceId(),
            'resource_type' => $this->getResourceType(),
            'ip_address' => $this->getIpAddress()
        ]);
    }
}
