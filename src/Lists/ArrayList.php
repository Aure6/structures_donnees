<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void {
        /* $this->elements[] = $element; */
        if(empty($this->elements)){
            //array_push($this->elements, $element);
            $this->elements[0]=$element;
        } elseif (gettype($this->elements[0]) === gettype($element)) {
            array_push($this->elements, $element);
        } else {
            throw new \InvalidArgumentException("it should return an error if adding an element of a different type");
        }
    }

    public function get(int $index): mixed {
        if (array_key_exists($index,$this->elements)){
            return $this->elements[$index];
        } else {
            throw new \OutOfBoundsException("Index '$index' is out of bounds.");
        }
    }

    public function set(int $index, mixed $element): void {
        if ($index < count($this->elements)) {
            //$this->elements[$index] = $element;
            array_splice($this->elements, $index, 0, $element);
        } else {
            //it should throw exception when set index not found
            throw new \InvalidArgumentException('Element cannot be null');
            //throw new \InvalidArgumentException('Index already exists');
        }

        /* if (!is_null($element)) {
            throw new \InvalidArgumentException('Element cannot be null');
        } */
        
    }

    public function clear(): void {
        $this->elements = [];
    }

    public function includes(mixed $element): bool {
        if (in_array($element, $this->elements)) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty(): bool {
        // TODO: vérifier que c'est un tableau et après utiliser empty
        return empty($this->elements);
    }

    public function indexOf(mixed $element): int {
        if (in_array($element, $this->elements)){
            return array_search($element, $this->elements);
        } else {
            throw new \InvalidArgumentException('Index of element not found');
        }
    }

    public function remove(int $index): void {
        if (array_key_exists($index, $this->elements)){
            array_splice($this->elements, $index, 1);
            //unset($this->elements[$index]);
        } else {
            throw new \InvalidArgumentException('Index not found');
        }
    }

    public function size(): int {
        return count($this->elements);
    }

    public function toArray(): array {
        return $this->elements;
    }
}
