<?php
declare(strict_types=1);

namespace FnsService\Contracts;

/**
 * Interface FnsEntity
 * Defines methods for encoding URL and converting entity to array.
 * @package FnsService\Contracts
 */
interface FnsEntity
{
    /**
     * Encode the entity data for URL usage.
     * @return string The URL-encoded entity data
     */
    public function urlEncode(): string;

    /**
     * Convert the entity to an array representation.
     * @return array The entity data as an array
     */
    public function toArray(): array;
}