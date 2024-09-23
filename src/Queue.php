<?php

namespace Achinon\ToolSet;

class Queue
{
    private array $stack = [];
    private int $l = 0;
    private int $p = 0;

    public function enqueue($element): self
    {
        $this->setAtStack($this->p++, $element); ;
        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->p === $this->l;
    }

    public function dequeue()
    {
        if($this->isEmpty())
            return false;
        return $this->getStack()[$this->l++];
    }

    public function purge()
    {
        $this->l = $this->p = 0;
    }

    public function peek()
    {
        return $this->getStack()[$this->l];
    }

    protected function setAtStack(int $index, $element)
    {
        $this->stack[$index] = $element;
    }

    protected function getStack(): array
    {
        return $this->stack;
    }
}