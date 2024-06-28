<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container{
            margin-top: 8%;
            width: 400px;
            border: ridge 1.5px white;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        body {
            background: #0000FF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0000FF, #FFA500);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0000FF, #FFA500); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Registration Form</h2>
    <form action="/register" method="post">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input class="form-control" type="text" name="name">
            <?php showError('name');?>
        </div>
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input class="form-control" type="email" name="email">
            <?php showError('email');?>
        </div>
        <div class="form-group">
            <label for="age">Your Age:</label>
            <input class="form-control" type="number" name="age" min="1" max="120" step="1">
            <?php showError('age');?>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password">
            <?php showError('password');?>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirm Password:</label>
            <input class="form-control" type="password" name="password_confirm">
        </div>

        <input class="btn btn-primary" type="submit" value="Register">
    </form>
</div>
</body>
</html>