<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\abstracts;

abstract class Target
{
    public $initCallback;

    public function setInitCallback(callable $initCallback): static
    {
        $this->initCallback = $initCallback;

        return $this;
    }

    public function init(): static
    {
        if (is_callable($this->initCallback)) {
            call_user_func_array($this->initCallback, [$this]);
        }

        return $this;
    }

    public function insert($data): void
    {
        $this->insertData($data);
    }

    public function batchInsert($data): void
    {
        $this->batchInsertData($data);
    }

    abstract protected function insertData($data): void;

    abstract protected function batchInsertData($data): void;
}
