<?php
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckStudent.php");
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckTutor.php");
?>

<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Module - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/anlage.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <div class="flex-container-form">
                <p>Create Module</p>
                <form method="post" action="./Controller/PostModule.php">
                    <input type="text" class="inputText" name="Abbreviation" placeholder="Abbreviation" />
                    <input type="text" class="inputText" name="FullDesignation" placeholder="FullDesignation" />
                    <input type="submit" class="inputSubmit" value="Submit" />
                </form>
            </div>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>