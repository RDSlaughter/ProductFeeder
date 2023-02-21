<?php

require_once 'FeedManager.php';

class Platform extends FeedManager {
    private $platform ;

    public function __construct($platform) {
        $this->platform = $platform;
    }

    public function generateFeeder() {
        switch ($this->platform) {
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
                die("Platform bulunamadı: $this->platform!");
        }
        return $feedManager->getFeeder();
    }
}