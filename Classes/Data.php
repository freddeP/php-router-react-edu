<?php

class Data{


    public static function getAllData($url = 'quotes.json'){
        return json_decode(file_get_contents($url));
    }

    public static function saveToFile($q, $url){

        $data = (array) self::getAllData($url);
        $data[$q->id]=$q;
        file_put_contents($url, json_encode($data, JSON_PRETTY_PRINT));

    }
    public static function removeFromFile($id, $url="quotes.json"){
        $data = (array) self::getAllData($url);
        unset($data[$id]);
        file_put_contents($url, json_encode($data, JSON_PRETTY_PRINT));
    }

}