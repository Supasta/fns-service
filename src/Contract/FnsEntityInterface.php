<?php

namespace Supasta\FnsService\Contract;

interface FnsEntityInterface
{
    public function urlEncode(): string;

    public function toArray(): array;
}
