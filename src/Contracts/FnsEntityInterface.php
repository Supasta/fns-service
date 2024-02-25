<?php

namespace FnsService\Contracts;

interface FnsEntity
{
    public function urlEncode(): string;

    public function toArray(): array;
}
