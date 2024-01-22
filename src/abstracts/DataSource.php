<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\abstracts;

abstract class DataSource
{
    public $convertCallback;
    public $initCallback;

    abstract public function getIterator(): iterable;

    public function setConvertCallback(callable $convertCallback): static
    {
        $this->convertCallback = $convertCallback;

        return $this;
    }

    public function setInitCallback(callable $initCallback): static
    {
        $this->initCallback = $initCallback;

        return $this;
    }

    public function doInsert($callback): void
    {
        $this->init();

        foreach ($this->getIterator() as $k => $data) {
            if (is_callable($this->convertCallback)) {
                $data = call_user_func_array($this->convertCallback, [$data]);
            }

            if (is_array($data)) {
                call_user_func_array($callback, [$data]);
            }
        }
    }

    public function doBatchInsert($callback, $chunk = 10): void
    {
        $this->init();

        $chunks = [];

        foreach ($this->getIterator() as $k => $data) {
            if (is_callable($this->convertCallback)) {
                $data = call_user_func_array($this->convertCallback, [$data]);
            }

            if (is_array($data)) {
                $chunks[] = $data;
            }

            if (count($chunks) == $chunk) {
                call_user_func_array($callback, [$chunks]);
                $chunks = [];
            }
        }

        if (count($chunks)) {
            call_user_func_array($callback, [$chunks]);
        }
    }

    private function init(): static
    {
        if (is_callable($this->initCallback)) {
            call_user_func_array($this->initCallback, [$this]);
        }

        return $this;
    }
}
