<?php
require_once("Data.php");
class Auth{

    private static $url = "users.json";
    
    public static function register(){

        if(isset($_POST['email']) && $_POST['email']!=null
        & isset($_POST['password']) && $_POST['password']!=null
        & isset($_POST['name']) && $_POST['name']!=null
        ){
          
            $email = $_POST['email'];
            $name = $_POST['name'];
            // glöm inte att validera senare


            // Om det redan finns en användare med den eposten...
            $user = self::findUser($email);
            if($user){
                echo "User email taken";
                return;
            }
            


            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $id = uniqid(true);
            $user = [
                "id"=>$id,
                "email"=>$email,
                "password"=>$password,
                "name"=>$name,
                "admin"=>false
                ];
            Data::saveToFile((Object)$user, self::$url);
                return true;
        }
        echo false;
    }

    public static function login(){

        if(isset($_POST['email']) && $_POST['email']!=null
        & isset($_POST['password']) && $_POST['password']!=null
        ){
          
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = self::findUser($email);
            if(!$user){
                echo "no user found";
                return;
            }
      
            $check = password_verify($password, $user->password);

            if($check) {
                $_SESSION['loggedIn']= true;
                $_SESSION['user']= $user->email;
                $_SESSION['user-id']= $user->id;
                $_SESSION['admin']= $user->admin;
                $_SESSION['name']= $user->name;

                header("Location:./checksession");
                return;
            }

            echo "wrong password";



        }

        
    }

    public static function findUser($email){

        $allUsers = (array) Data::getAllData(self::$url); 
        $foundUser = false;
        foreach($allUsers as $user){

            if($user->email == $email){
                $foundUser = $user;
                break;
            }
        }

        return $foundUser;

    }



}