<?php

    use Coco\dataMigration\SourceFactory;

    require '../vendor/autoload.php';

    $source = 'data/test.csv';

    $source = new \Coco\dataMigration\source\CsvFile($source);
    $target = new \Coco\dataMigration\target\Mysql('webuploader', 'files6');

    $source->setInitCallback(function(\Coco\dataMigration\source\CsvFile $source) {
        $st = $source->getStmt()->offset(5)->limit(2);

        $source->setStmt($st);
    });

    $source->setConvertCallback(function($data) {
        return ["name" => $data];
    });

    $factory = SourceFactory::initSource($source, $target);
    $factory->setOnProgress(function($data, SourceFactory $factory) {
        $source = $factory->getSource();
        $target = $factory->getTarget();

        print_r($data);
        echo PHP_EOL;
    });

    $factory->testInsert();
    //    $factory->testBatchInsert(2);


