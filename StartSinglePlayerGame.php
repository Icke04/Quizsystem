<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Play - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/startGame.css" />
    </head>

    <body>

        <div class="flex-container">
            <div class="startGameDiv">
                <div class="text">Hier wird ein Singleplayer-Spiel gestartet!</div>
                <div class="text">Bitte ein Modul auswählen und Start drücken!</div>
            
                <div id="startForm">
                    <form method="post" action="./Controller/PostGameRoom.php">
                        <input type="hidden" name="IsSingleplayer" value=1 />
                        <select name="IdModule">
                            <option value=0>...</option>
                            <?php include_once("/xampp/htdocs/OnlineQuiz/Controller/GetModulesSelect.php"); ?>
                        </select>
                        <input type="submit" value="Start" />
                    </form>
                </div>
                <div id="cancelForm">
                    <form method="post" action="./index.php">
                        <input type="submit" value="zurück" />
                    </form>
                </div>
            </div>
        </div>

    </body>

</html>