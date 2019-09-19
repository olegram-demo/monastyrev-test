<?php

declare(strict_types=1);

use App\Factories\GroupListFactory;
use App\Renders\GroupListHtmlRender;
use App\Renders\Spacer;

require __DIR__.'/../vendor/autoload.php';

try {
    $groupList = GroupListFactory::createFromCsvFiles(
        __DIR__ . '/../data/groups.csv',
        __DIR__ . '/../data/products.csv'
    );
    echo (new GroupListHtmlRender(new Spacer("\t", 1)))->render($groupList);
} catch (Exception $e) {
    echo $e->getMessage();
}
