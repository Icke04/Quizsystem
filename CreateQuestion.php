<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Frage - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/anlage.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <div class="flex-container-form">
                <p>Frage erstellen</p>
                <form method="post" action="./Controller/PostQuestion.php">
                    <input type="text" class="inputText" name="Question" placeholder="Frage" />
                    <input type="text" class="inputText" name="CorrectAnswer" placeholder="Richtige Antwort" />
                    <input type="text" class="inputText" name="WrongAnswer1" placeholder="Falsche Antwort" />
                    <input type="text" class="inputText" name="WrongAnswer2" placeholder="Falsche Antwort" />
                    <input type="text" class="inputText" name="WrongAnswer3" placeholder="Falsche Antwort" />
                    
                    <select class="select" name="IdModule">
                        <option value=0 selected>...</option>
                        <?php include_once("./Controller/GetModulesSelect.php"); ?>
                    </select>
                    
                    <input type="submit" class="inputSubmit" value="erstellen" />
                </form>
            </div>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>