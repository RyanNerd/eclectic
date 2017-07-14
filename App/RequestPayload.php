<?php
declare(strict_types=1);

namespace eclectic\App;

class RequestPayload implements \ArrayAccess, \Countable
{
    protected $id;
    protected $data = [];

    public function setData(array &$data)
    {
        $this->data = &$data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    public function count(): int
    {
        return count($this->data);
    }
}
