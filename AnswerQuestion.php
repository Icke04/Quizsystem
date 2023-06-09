<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Spielen - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/index.css" />
        <link rel="stylesheet" href="/style/answerQuestions.css?=v1" />
    </head>

    <body>

        <div class="flex-container">
            
            <?php include_once("./Controller/GetGameQuestions.php"); ?>

        </div>

    </body>

</html>

<script src="./js/jquery.min.js"></script>
<script src="./js/answerQuestion.js"></script>