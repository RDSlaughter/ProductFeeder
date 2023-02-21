<?php

class XmlFeeder implements Feeder {
    public function getFeed($productData) {
        $xml = new SimpleXMLElement('<products/>');

        foreach ($productData as $product) {
            $productXml = $xml->addChild('product');
            $productXml->addChild('id', $product['id']);
            $productXml->addChild('name', $product['name']);
            $productXml->addChild('price', $product['price']);
            $productXml->addChild('category', $product['category']);
        }

        return $xml->asXML();
    }
    public function getType() {
        return "xml";
    }
}

?>