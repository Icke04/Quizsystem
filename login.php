<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <title>Login - Onlinequiz</title>
        <link rel="stylesheet" href="/style/layout.css" />
        <link rel="stylesheet" href="/style/login.css" />
    </head>

    <body>
        <div class="flex-container">
            <form method="post" action="./Controller/LoginController.php">
                <h3>Login</h3>
                <input type="text" name="Username" placeholder="Username" />
                <input type="password" name="Password" placeholder="Password" />
                <input type="submit" value="Login" />
            </form>
        </div>
    </body>

</html>