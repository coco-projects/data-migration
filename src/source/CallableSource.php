<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use Coco\dataMigration\abstracts\DataSource;
    use loophp\collection\Collection;

class CallableSource extends DataSource
{
    protected ?Collection $collection = null;

    //https://loophp-collection.readthedocs.io/en/latest/pages/api.html
    public function __construct($source)
    {
        $this->collection = Collection::fromCallable($source);
    }

    public function getCollection(): ?Collection
    {
        return $this->collection;
    }

    public function setCollection(?Collection $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getIterator(): iterable
    {
        return $this->getCollection();
    }
}
