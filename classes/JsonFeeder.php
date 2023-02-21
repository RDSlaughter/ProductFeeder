<?php

class JsonFeeder implements Feeder {
    public function getFeed($productData) {
        return json_encode($productData,JSON_PRETTY_PRINT);
    }
    public function getType() {
        return "json";
    }
}

?>