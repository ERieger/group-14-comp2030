<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/static/css/normalize.css">
    <link rel="stylesheet" href="../public/static/css/colours.css">
    <link rel="stylesheet" href="../public/static/css/utility.css">
    <link rel="stylesheet" href="../public/static/css/index.css">
    <link rel="stylesheet" href="../public/static/css/admin.css">
    <link rel="stylesheet" href="../public/static/css/login.css">
</head>
<body>
   <div class="container">
        <form action="api/login/login-handler.php" method="post">
            <h1>Employee Login</h1>
        <div class="form-group">
            <label for="">Email id</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="pwd" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn"  value="Login">
        </div>
        </form>
   </div> 
</body>
</html>