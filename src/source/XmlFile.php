<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use Coco\dataMigration\abstracts\DataSource;
    use Coco\xmlReader\XmlReader;
    use loophp\collection\Collection;

class XmlFile extends DataSource
{
    protected ?Collection $collection = null;

    //    https://packagist.org/packages/coco-project/xml-reader
    public function __construct($source)
    {
        $xmlStream = fopen($source, 'r');

        $reader = XmlReader::openStream($xmlStream, 2);

        $this->collection = Collection::fromIterable($reader->process());
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
