<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <link rel="stylesheet" href="../public/static/css/admin.css">
    <link rel="stylesheet" href="../public/static/css/login.css">
</head>
<div class="navbar">
            <img src="../public/static/images/logo.png" alt="COMPANY LOGO" class="logo">
            <p>Log In</p>
</div>
<body>

        <div class="login">
            <h2 class="head">Choose the Login Method</h2>
            <form action="../public/static/html/swipelogin.html" method="get" id="swipe-login">
            <input class="swipe" type="submit" value="Swipecard">
            
            </form> <br>
            <form action="../public/static/html/weblogin.html" method="get" id="webapp-login">
            <input type="submit" value="Web-App">
            </form>
        </div>
    
</body>
</html>