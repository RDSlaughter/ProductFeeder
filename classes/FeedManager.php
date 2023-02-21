<?php

require_once 'Feeder.php';
require_once 'CsvFeeder.php';
require_once 'XmlFeeder.php';
require_once 'JsonFeeder.php';

class FeedManager {

    private $feederClass;

    public function __construct($feederClass) {
        $this->feederClass = $feederClass;
    }

    public function getFeeder() {
        $reflector = new ReflectionClass($this->feederClass);
        return $reflector->newInstance();
    }
}
