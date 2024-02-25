<?php

namespace FnsService\Contracts;


interface Localization
{
    public function setLocalization(string $language): self;
    public function localize(array $array): array;
}
