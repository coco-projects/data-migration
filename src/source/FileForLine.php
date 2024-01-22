<?php

    declare(strict_types = 1);

    namespace Coco\dataMigration\source;

    use loophp\collection\Collection;
    use Bcremer\LineReader\LineReader;

class FileForLine extends IterableSource
{
    public function __construct($source)
    {
        $lineGenerator = LineReader::readLines($source);

        parent::__construct($lineGenerator);
    }
}
