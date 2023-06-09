<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modul - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/anlage.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <?php include_once("./Controller/EditQuestion.php"); ?>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>