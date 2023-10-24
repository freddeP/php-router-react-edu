<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require_once("Classes/Check.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotes Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="client.js" defer></script>
</head>
<body>
    <h1>Quotes Page...</h1>

    <h2>
        <?php
            if(Check::get(['error'])) echo $_GET['error'];
        ?>
    </h2>
    <header>
        <nav>
            <a href="./">HOME</a> | 
            <a href="./?view=register.html">REGISTER</a> |
            <a href="./?view=login.html">LOGIN</a> | 
            <a href="./?view=createQuote.html">CREATE QUOTE</a>
        </nav>
    </header>

    <?php

        if(isset($_GET['view'])){
            include("Views/".$_GET['view']);
        }

    ?>

    <div class="quotes">
        <pre>

        </pre>
    </div>
</body>
</html>