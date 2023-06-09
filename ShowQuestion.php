<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Frage - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/table.css" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <table>
                <thead>
                    <tr>
                        <td>Frage</td>
                        <td>Richtige Antwort</td>
                        <td>Falsche Antwort</td>
                        <td>Falsche Antwort</td>
                        <td>Falsche Antwort</td>
                        <td>freigegeben</td>
                        <td>Modul</td>
                        <td class="btn">bearbeiten</td>
                        <td class="btn">löschen</td>
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