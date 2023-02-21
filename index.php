<?php

require_once "classes/Platform.php";

$options = getopt("p:f:");
$platformName = ucfirst(strtolower($options['p'])) ?? "Google";
$productFileName = $options['f'] ?? "data/products.json";

$productData = json_decode(file_get_contents($productFileName), true);

switch ($platformName) {
    case 'Google':
        $feedManager = new FeedManager(new JsonFeeder());
        break;
    case 'Facebook':
        $feedManager = new FeedManager(new CsvFeeder());
        break;
    case 'Twitter':
        $feedManager = new FeedManager(new XmlFeeder());
        break;
    default:
        die("Platform bulunamadı: $platformName!");
}

$platform = new Platform($platformName);

$feeder = $platform->generateFeeder();

$fileExtension = $feeder->getType();

$productFeed = $feeder->getFeed($productData);

$output = "./response/".$platformName.".".$fileExtension;

file_put_contents($output, $productFeed);

echo "\n".$productFeed."\nYola kaydedildi: ".$output;

//$productData = json_decode(file_get_contents('data/products.json'), true);

/*
$feedManager = new FeedManager(new CsvFeeder());
$csvFeed = $feedManager->getFeeder()->getFeed($productData);
header("Content-type: text/csv");
echo $csvFeed;
*/


/*
$feedManager = new FeedManager(new XmlFeeder());
$xmlFeed = $feedManager->getFeeder()->getFeed($productData);
header('Content-Type: text/xml');
echo $xmlFeed;
*/

/*
//$feedManager = new FeedManager(new JsonFeeder());
$feedManager = new FeedManager("JsonFeeder");
$jsonFeed = $feedManager->getFeeder()->getFeed($productData);
header('Content-Type: application/json; charset=utf-8');
echo $jsonFeed;

*/
