<?php

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php')) {
    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
}

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require __DIR__.'/vendor/autoload.php';
}

use WebPConvert\WebPConvert;

$source = $_SERVER['DOCUMENT_ROOT'].$_GET['source'];
$destination = $source.'.webp';

$options = [
    'fail-when-fail-fails' => '404',
//    'show-report' => true,
    'serve-image' => [
        'headers' => [
            'vary-accept' => true
        ],
        'cache-control-header' => 'max-age=2'
    ],
    'convert' => [
        'converters' => [
            'vips',
            'imagick',
            'gmagick',
            'gd'
        ]
    ]
];

WebPConvert::serveConverted($source, $destination, $options);
