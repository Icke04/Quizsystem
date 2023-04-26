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
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <input type="hidden" id="Username" value="<?php echo $_SESSION['Username']; ?>" />

        <div class="flex-container">
    
        </div>

        <?php include_once("footer.php"); ?>

    </body>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/chatbox.js?v=3"></script>
    <script src="/js/openGames.js?v=8"></script>
    <script src="/js/online.js?v=3"></script>

</html>