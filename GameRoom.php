<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Play - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/gameRoom.css?=v1" />
    </head>

    <body>

        <div class="flex-container">
            <?php
            if(!($_SESSION['IsSingleplayer']))
            {
                ?>
                <p id="opponent">Waiting for Opponent!</p>
                <?php
            }
            ?>
            <form method="post" action="./Controller/StartGame.php">
                <input id="start" type="submit" value="Start" />
                <input id="isSingleplayer" type="hidden" value="<?php echo $_SESSION['IsSingleplayer']; ?>" />
            </form>
            <form method="post" action="./Controller/DeleteGame.php">
                <input id="delete" type="submit" value="Cancel" />
                <input id="isSingleplayer" type="hidden" value="<?php echo $_SESSION['IsSingleplayer']; ?>" />
            </form>
        </div>

    </body>

</html>

<script src="/js/jquery.min.js"></script>
<script src="/js/opponent.js?=v2"></script>