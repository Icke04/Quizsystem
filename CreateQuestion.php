<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Question - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/anlage.css?=v1" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <div class="flex-container-form">
                <p>Create Question</p>
                <form method="post" action="./Controller/PostQuestion.php">
                    <input type="text" class="inputText" name="Question" placeholder="Question" />
                    <input type="text" class="inputText" name="CorrectAnswer" placeholder="CorrectAnswer" />
                    <input type="text" class="inputText" name="WrongAnswer1" placeholder="WrongAnswer" />
                    <input type="text" class="inputText" name="WrongAnswer2" placeholder="WrongAnswer" />
                    <input type="text" class="inputText" name="WrongAnswer3" placeholder="WrongAnswer" />
                    
                    <select class="select" name="IdModule">
                        <option value=0 selected>...</option>
                        <?php include_once("./Controller/GetModulesSelect.php"); ?>
                    </select>
                    
                    <input type="submit" class="inputSubmit" value="Submit" />
                </form>
            </div>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>