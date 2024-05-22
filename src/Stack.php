<?php

namespace Achinon\ToolSet;

class Stack
{
    private array $stack = [];
    private int $pointer = -1;

    public function pop()
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Cannot pop from an empty stack.');
        }

        $this->pointer--;

        return array_pop($this->stack);
    }

    public function isEmpty(): bool
    {
        return $this->pointer < 0;
    }

    public function count(): int
    {
        return $this->pointer + 1;
    }

    public function push($element): self
    {
        $this->stack[++$this->pointer] = $element;
        return $this;
    }

    /** reverse = true -> beginning of array is on top of the stack */
    public static function createFromArray(array $a, bool $reverse = false): self
    {
        if (empty($a)) {
            throw new \InvalidArgumentException('Input array cannot be empty.');
        }

        $stack = new static();
        $a = $reverse ? array_reverse($a) : $a;
        foreach ($a as $v) {
            $stack->push($v);
        }
        return $stack;
    }

    public function flip(): self
    {
        $flippedStack = new static();

        while (!$this->isEmpty()) {
            $flippedStack->push($this->pop());
        }

        return $flippedStack;
    }
}
