<?php

class XmlFeeder implements Feeder {
    
    public function getFeed($productData) {
        $xml = new SimpleXMLElement('<products/>');

        foreach ($productData as $product) {
            $productXml = $xml->addChild('product');
            foreach($product as $key => $value){
            $productXml->addChild($key, $product[$key]);
            }
        }

        return $xml->asXML();
    }
    public function getType() {
        return "xml";
    }
}
