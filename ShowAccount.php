<!Doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/table.css" />
    </head>

    <body>
        
        <?php include_once("navbar.php"); ?>

        <div class="flex-container">
            <table>
                <thead>
                    <tr>
                        <td>Username</td>
                        <td>E-Mail</td>
                        <td>Password</td>
                        <td>Role</td>
                        <td class="btn"></td>
                        <td class="btn"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once("./Controller/GetAccounts.php");
                    ?>
                </tbody>
            </table>
        </div>

        <?php include_once("footer.php"); ?>

    </body>

</html>