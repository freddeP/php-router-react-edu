<?php
session_set_cookie_params([
    "httponly"=>true,
    "samesite"=>'strict'
]);
session_start();


require_once("Router.php");
require_once("Classes/Data.php");
require_once("Classes/Quote.php");
require_once("Classes/Auth.php");
require_once("Classes/Check.php");
require_once("Classes/Debug.php");
require_once("Classes/Sql.php");


// ROUTES

Router::get("/sql/quotes", function(){


    $s = Sql::getAllQuotes();
    header("Content-Type:application/json");
    echo json_encode($s, JSON_PRETTY_PRINT);
});

Router::get("/connect", function(){

    echo "Trying to create";


    $q = (Object)["title"=>"TESTAR FRÅRN ROUTE", "author"=>"mrP"];
    Sql::create($q);


});




Router::get("/array", function(){


    $arr = [13,115,44,"Hej"];
    Debug::print($arr);
    unset($arr[1]);
    $arr["Kalle_Anka"] = "big number";
    Debug::print($arr);


});




Router::get("/","main.php");

// test-route för att generera create-formulär som skickar med JS fetch
Router::get("/createquote","test.html");

Router::get("/logout", function(){

    if(isset($_SESSION['user'])){
        session_destroy();
        header("Location:./?mes=logged out");
    }

});


Router::get("/session", function(){

    $_SESSION['test'] = "Från /session test funkar";
    var_dump($_SESSION);

});
Router::get("/checksession", function(){

    if(isset($_SESSION['user'])){
        echo "Välkommen ". $_SESSION['name'];
        echo "<hr>";
        var_dump($_SESSION);
    }

});


Router::get("/delete", function(){


 /*    var_dump(Check::get(['id','test','name'])); */
    if(!Check::session(['user'])) {
        header("Location:./?error=authentication required");
        return;
    }

    if(!Check::get(['id'])) {
        header("Location:./?error=no id");
        return;
    }
    $id = $_GET['id'];
    Data::removeFromFile($id);
    header("Location:./");

});

Router::post("/create",function(){


    if(!Check::session(['name'])) {
        //header("Location:./?error=not logged in");
        $return = ["error"=>"authentication required"];
        echo json_encode($return);
        return;
    };

    if(Check::post(['title']))
    {
        $title = $_POST['title'];
        $author = $_SESSION['name'];
        $quote = new Quote($title, $author);
        Data::saveToFile($quote, "quotes.json");
        //Debug::print(Data::getAllData());
        echo json_encode($quote);
        return;
    }

    echo "Nothing created";


});

Router::get("/quotes", function(){
    header("Content-Type:application/json");
    echo json_encode(Data::getAllData());
});






// auth-routes

Router::post("/register", 'Auth::register');
Router::post("/login", 'Auth::login');



Router::listen();


