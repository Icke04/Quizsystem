<?php
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckStudent.php");
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckTutor.php");
?>

<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modul - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/table.css" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <table>
                <thead>
                    <tr>
                        <td>Abbreviation</td>
                        <td>FullDesignation</td>
                        <td>Tutoren</td>
                        <td class="btn">bearbeiten</td>
                        <td class="btn">löschen</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once("./Controller/GetModules.php");
                    ?>
                </tbody>
            </table>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>

<script src="/js/showModule.js"></script>