<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration;

    use Coco\dataMigration\abstracts\DataSource;
    use Coco\dataMigration\abstracts\Target;

class SourceFactory
{
    public ?DataSource $source     = null;
    public ?Target     $target     = null;
    public $onProgress = null;

    protected function __construct(DataSource $source, Target $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    public static function initSource(DataSource $source, Target $target): static
    {
        return new static($source, $target);
    }

    /**
     * @return DataSource|null
     */
    public function getSource(): ?DataSource
    {
        return $this->source;
    }

    /**
     * @return Target|null
     */
    public function getTarget(): ?Target
    {
        return $this->target;
    }

    /**
     * @param null $onProgress
     */
    public function setOnProgress($onProgress): static
    {
        $this->onProgress = $onProgress;

        return $this;
    }

    public function testInsert(): void
    {
        $this->target->init();
        $this->source->doInsert(function ($data) {
            if (is_callable($this->onProgress)) {
                call_user_func_array($this->onProgress, [
                    $data,
                    $this,
                ]);
            }
        });
    }

    public function testBatchInsert($chunk = 10): void
    {
        $this->target->init();
        $this->source->doBatchInsert(function ($data) {

            if (is_callable($this->onProgress)) {
                call_user_func_array($this->onProgress, [
                    $data,
                    $this,
                ]);
            }
        }, $chunk);
    }

    public function doInsert(): void
    {
        $this->target->init();
        $this->source->doInsert(function ($data) {
            $this->target->insert($data);
            if (is_callable($this->onProgress)) {
                call_user_func_array($this->onProgress, [
                    $data,
                    $this,
                ]);
            }
        });
    }

    public function doBatchInsert($chunk = 10): void
    {
        $this->target->init();
        $this->source->doBatchInsert(function ($data) {
            $this->target->batchInsert($data);

            if (is_callable($this->onProgress)) {
                call_user_func_array($this->onProgress, [
                    $data,
                    $this,
                ]);
            }
        }, $chunk);
    }
}
