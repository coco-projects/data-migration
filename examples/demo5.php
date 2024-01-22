<?php

    require '../vendor/autoload.php';

    use League\Csv\Reader;
    use League\Csv\Statement;

    $file = 'data/test.csv';
    $csv  = Reader::createFromPath($file, 'r');

    $stmt = Statement::create()->offset(5)->limit(5);

    $records = $stmt->process($csv);
    foreach ($records as $record)
    {
        print_r($record);
    }