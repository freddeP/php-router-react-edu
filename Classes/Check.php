<?php

class Check{


    public static function get($arr){

        foreach($arr as $val){

            if(!(isset($_GET[$val]) && $_GET[$val] !=null)){
                return false;
                break; 
            }
        }
        return true;
    }
    public static function post($arr){

        foreach($arr as $val){

        
            if(!(isset($_POST[$val]) && $_POST[$val] !=null)){
                return false;
                break;
               
            }
        }
        return true;
    }

    public static function session($arr){

        foreach($arr as $val){

      
            if(!(isset($_SESSION[$val]) && $_SESSION[$val] !=null)){
                return false;
                break;
               
            }
        }
        return true;
    }





}


