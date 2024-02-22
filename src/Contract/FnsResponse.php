<?php

namespace Supasta\FnsService\Contract;


abstract class FnsResponse
{
    protected $data = [];

    protected function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    protected function isEmpty(): bool
    {
        return empty($this->data);
    }

    public function __get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getStatus(): int
    {
        return (int)$this->STATUS ?? 200;
    }

    public function getError(): ?object
    {
        return $this->ERRORS;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getInn()
    {
        return $this->inn;
    }
}
