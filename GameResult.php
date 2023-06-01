<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Play - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/index.css" />
        <link rel="stylesheet" href="/style/gameResult.css" />
    </head>

    <body>

        <div class="flex-container">

            <?php
                include_once("./Controller/GetGamePoints.php");
            ?>

            <form action="./index.php">
                <input type="submit" value="Exit" />
            </form>

        </div>

    </body>

</html>

<script src="/js/jquery.min.js"></script>
<script src="/js/gameResult.js?v=1"></script>