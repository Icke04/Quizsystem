<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Question - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/table.css" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <table>
                <thead>
                    <tr>
                        <td>Question</td>
                        <td>CorrectAnswer</td>
                        <td>WrongAnswer1</td>
                        <td>WrongAnswer2</td>
                        <td>WrongAnswer3</td>
                        <td>IsApproved</td>
                        <td>Full Designation</td>
                        <td class="btn"></td>
                        <td class="btn"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once("./Controller/GetQuestions.php");
                    ?>
                </tbody>
            </table>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>