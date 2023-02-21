<?php

class CsvFeeder implements Feeder {
    
    public function getFeed($productData) {

        $headers = array();
        foreach (array_keys($productData[0]) as $key => $value) {
            $headers[] = $value;
        }

        $lines = array();

        foreach ($productData as $product) {
            $line = array();
            foreach ($product as $key => $value) {
                $line[] = $product[$key];
            }
            $lines[] = $line;
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
    public function getType()
    {
        return "csv";
    }
}
