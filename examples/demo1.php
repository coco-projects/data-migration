<?php

    require '../vendor/autoload.php';

    use Bcremer\LineReader\LineReader;
    use JsonCollectionParser\Parser;
    use loophp\collection\Collection;

    $collection = Collection::fromCallable(function() {
        return range(1, 10);
    });

    print_r($collection->all());
