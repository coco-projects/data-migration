<?php

    use Coco\dataMigration\SourceFactory;

    require '../vendor/autoload.php';

    $source = 'data/test.json';

    $source = new \Coco\dataMigration\source\Json($source);
    $target = new \Coco\dataMigration\target\Mysql('webuploader', 'files6');

    $source->setInitCallback(function(\Coco\dataMigration\source\Json $source) {
        $c = $source->getCollection()->reverse();
        $source->setCollection($c);
    });

    $target->setInitCallback(function(\Coco\dataMigration\target\Mysql $source) {
        $createTable = <<<AAA
CREATE TABLE if not exists `files6` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件原名',
  `age` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `region` varchar(255) NOT NULL DEFAULT '' COMMENT '最大的文件id',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4

AAA;

        $source->getDbConnect()->execute($createTable);
        $source->getDbConnect()->execute('truncate files6');
    });

    $source->setConvertCallback(function($data) {
        $data['name'] = '==' . $data['name'];
        $data['time'] = time();

        return $data;
    });

    $factory = SourceFactory::initSource($source, $target);
    $factory->setOnProgress(function($data, SourceFactory $factory) {
        $source = $factory->getSource();
        $target = $factory->getTarget();

        print_r($data);
        echo PHP_EOL;
    });

//    $factory->testInsert();

    $factory->doBatchInsert(2);
    //        $factory->doInsert();


