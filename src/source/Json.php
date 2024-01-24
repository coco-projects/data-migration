<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use Coco\JsonParser\JsonParser;
    use loophp\collection\Collection;
    use Coco\dataMigration\abstracts\DataSource;

class Json extends DataSource
{
    protected ?Collection $collection = null;

    //    https://packagist.org/packages/coco-project/json-parser
    public function __construct($source, $pointer = null)
    {
        $parser = JsonParser::parse($source);

        if ($pointer) {
            $parser = $parser->pointer($pointer);
        }

        $this->collection = Collection::fromIterable($parser);
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
