<?php

    require '../vendor/autoload.php';

    use Bcremer\LineReader\LineReader;
    use JsonCollectionParser\Parser;
    use loophp\collection\Collection;

    $collection = Collection::fromFile('data/test.txt');
    print_r($collection->all());
