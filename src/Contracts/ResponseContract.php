<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Contracts;

/**
 * @template TArray of array
 */
interface ResponseContract
{
    /**
     * Returns the array representation of the Response.
     *
     * @return TArray
     */
    public function toArray(): array;
}
