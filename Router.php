<?php

class Router{

    public static $routes = ['get'=>[], 'post'=>[]];

    public static function get($path, $callback){
        self::$routes['get'][$path] = $callback;
    }
    public static function post($path, $callback){
        self::$routes['post'][$path] = $callback;
    }

    public static function show(){
        echo "<pre>";
        var_dump(self::$routes);
        echo "</pre>";
    }

    public static function listen(){
/*         echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>"; */
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        //echo $method;
        $path = $_SERVER['REQUEST_URI'];
        $path = str_replace("/php-router2023","",$path);
        $path = explode("?",$path);
        $path = $path[0];
   

        if(!isset(self::$routes[$method][$path]))
        {
            echo "404, no route";
            return ;
        }

        if(is_callable(self::$routes[$method][$path])){
            call_user_func(self::$routes[$method][$path]);
           return;
        }

        if(is_file(self::$routes[$method][$path])){
            include(self::$routes[$method][$path]);
            return;
        }

        echo "No file, no Callback";

  

       

    }


}