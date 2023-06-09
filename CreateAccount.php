<?php 
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckStudent.php");
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckTutor.php");
?>

<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/anlage.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>
        
        <div class="flex-container">
            <div class="flex-container-form">
                <p>Account erstellen</p>
                <form method="post" action="./Controller/PostAccount.php">
                    <input type="text" class="inputText" name="Username" placeholder="Username" />
                    <input type="text" class="inputText" name="Email" placeholder="E-Mail" />
                    <input type="password" class="inputText" name="Password" placeholder="Password" />
                    <select class="select" name="IdRole">
                        <option value="">...</option>
                        <option value="3">Student</option>
                        <option value="2">Tutor</option>
                        <option value="1">Admin</option>
                    </select>
                    <input type="submit" class="inputSubmit" value="speichern" />
                </form>
            </div>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>