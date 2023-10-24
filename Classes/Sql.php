<?php


class Sql{



    private static  $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $db = "quote_page";


    private static function connect(){
            // Create connection
            $conn = new mysqli(
            self::$servername, 
            self::$username, 
            self::$password,
            self::$db);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            //echo "Connected successfully";
            return $conn;
            

    }


    public static function getAllQuotes(){

        $conn = self::connect();

        $result = $conn->query("SELECT * FROM quotes");

        $quotes = [];
        while($row = $result->fetch_assoc()){
            $quotes[] = $row;
        }
        $conn->close();
        return $quotes;


    }


    public static function create($q){

        $query = "INSERT INTO quotes (title, author) VALUES ('$q->title', '$q->author')";

        $conn = self::connect();

        $conn->query($query);

        $conn->close();



    }

}


