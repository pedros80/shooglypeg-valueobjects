<?php

declare(strict_types=1);

namespace ShooglyPeg\Domain;

use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use ShooglyPeg\Domain\Exceptions\InvalidTypeForCollection;

abstract class TypedCollection implements Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @var array
     */
    protected array $items;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!is_a($item, $this->type)) {
                throw InvalidTypeForCollection::fromClass($this->type);
            }
        }

        $this->items = $items;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items());
    }

    /**
     * @return array
     */
    protected function items(): array
    {
        return $this->items;
    }

    /**
     * @param Closure $fn
     * @return array
     */
    public function map(Closure $fn): array
    {
        return array_values(array_map(function ($item) use ($fn) {
            return $fn($item);
        }, $this->items));
    }

    /**
     * @param Closure $fn
     * @return array
     */
    public function filter(Closure $fn): array
    {
        return array_values(array_filter($this->items, $fn));
    }

    /**
     * @param Closure $fn
     * @return mixed
     */
    public function find(Closure $fn)
    {
        return $this->filter($fn)[0];
    }

    /**
     * @param Closure $fn
     * @return array
     */
    public function reduce(Closure $fn): array
    {
        return array_reduce($this->items, $fn);
    }
}
