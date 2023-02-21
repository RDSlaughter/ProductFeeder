<?php

class CsvFeeder implements Feeder {
    public function getFeed($productData) {
        $headers = array('id', 'name', 'price', 'category');
        $lines = array();

        foreach ($productData as $product) {
            $lines[] = array(
                $product['id'],
                $product['name'],
                $product['price'],
                $product['category']
            );
        }

        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $headers);

        foreach ($lines as $line) {
            fputcsv($fp, $line);
        }

        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);

        return $csv;
    }
    public function getType() {
        return "csv";
    }
}

?>