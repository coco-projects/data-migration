<?php

    use Coco\dataMigration\SourceFactory;

    require '../vendor/autoload.php';

    $source = function() {
        return range(1, 20);
    };

    $source = new \Coco\dataMigration\source\CallableSource($source);
    $target = new \Coco\dataMigration\target\Mysql('webuploader', 'files6');

    $source->setInitCallback(function(\Coco\dataMigration\source\CallableSource $source) {
        $c = $source->getCollection()->reverse();
        $source->setCollection($c);
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


