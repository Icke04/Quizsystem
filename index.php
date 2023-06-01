<?php
    include_once("/xampp/htdocs/OnlineQuiz/Controller/DeleteGameSession.php");
?>

<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Play - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/index.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <input type="hidden" id="Username" value="<?php echo $_SESSION['Username']; ?>" />

        <div class="flex-container">
            
            <div class="column chat" id="LiveChat">
                <div id="messages"></div>
                <div id="messageInput">
                    <textarea id="newMessage" placeholder="Message"></textarea>
                </div>
            </div>

            <div class="column" id="openGameRooms">
                
            </div>

            <div class="column game" id="SinglePlayer">
                <form class="btn top" action="./StartSinglePlayerGame.php">
                    <input class="startGame" type="submit" value="Singleplayer" />
                </form>
                <form class="btn bottom" action="./StartMulitPlayerGame.php">
                    <input class="startGame" type="submit" value="Multiplayer" />
                </form>
            </div>
            
        </div>
    
        </div>

        <?php include_once("footer.php"); ?>

    </body>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/chatbox.js?v=3"></script>
    <script src="/js/openGames.js?v=8"></script>

</html>