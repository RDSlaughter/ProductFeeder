<?php

require_once "classes/Platform.php";

$options = getopt("p:f:");
$platformName = ucfirst(strtolower($options['p'])) ?? "Google";
$productFileName = $options['f'] ?? "data/products.json";

$productData = json_decode(file_get_contents($productFileName), true);
$platform = new Platform($platformName);
$feeder = $platform->generateFeeder();
$fileExtension = $feeder->getType();
$productFeed = $feeder->getFeed($productData);

$output = "./response/" . $platformName . "." . $fileExtension;
file_put_contents($output, $productFeed);
echo "\n" . $productFeed . "\nYola kaydedildi: " . $output;