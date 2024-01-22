<?php

    require '../vendor/autoload.php';

    use Bcremer\LineReader\LineReader;
    use loophp\collection\Collection;

//    $lineGenerator = LineReader::readLines('data/test.txt');

    $lineGenerator = LineReader::readLinesBackwards('data/test.txt');
    $lineGenerator = new \LimitIterator($lineGenerator, 0, 5);

    $collection = Collection::fromIterable($lineGenerator);
    print_r($collection->all());
