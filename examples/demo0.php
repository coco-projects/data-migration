<?php

    require '../vendor/autoload.php';

    use Bcremer\LineReader\LineReader;
    use JsonCollectionParser\Parser;
    use loophp\collection\Collection;

    $numbers = [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10,
    ];

    $collection = Collection::fromIterable($numbers);

    // 定义每页显示的数量
    $perPage = 3;

    // 计算总页数
    $totalPages = ceil($collection->count() / $perPage);

    // 获取当前页码（假设当前页为第一页）
    $currentPage = 2;

    // 使用 `slice` 方法进行分页处理
    $pagedNumbers = $collection->slice(($currentPage - 1) * $perPage, $perPage);

    print_r($pagedNumbers->all());

