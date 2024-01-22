<?php

    require '../vendor/autoload.php';

    use Bcremer\LineReader\LineReader;
    use JsonCollectionParser\Parser;
    use loophp\collection\Collection;

    $collection = Collection::fromString('abcdefg');
    print_r($collection->all());
