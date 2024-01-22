<?php

    require '../vendor/autoload.php';

    use Coco\JsonParser\JsonParser;
    use League\Csv\Reader;
    use League\Csv\Statement;
    use loophp\collection\Collection;

    $source = 'data/test.json';

//    $parser = new JsonParser($source);
    $parser = JsonParser::parse($source);

    /*
        foreach ($parser as $key => $value)
        {
            print_r($value);
            echo PHP_EOL;
        }
    */

    $collection = Collection::fromIterable($parser);


    foreach ($collection->reverse() as $key => $value)
    {
        print_r($value);
        echo PHP_EOL;
    }

//    print_r($collection->all());

