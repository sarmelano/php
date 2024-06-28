<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            height: 97dvh;
            background: linear-gradient(135deg, #ff6f61, #ffbc67);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
        }

        .signIn-form {
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: #333;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .input-group input {
            width: 95%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s;
        }

        .input-group input:focus {
            border: 1px solid #ff6f61;
            outline: none;
        }

        .button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            background: #ff6f61;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .button:hover {
            background: #ff3e2d;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php if($message = getMessage('success')) {
        echo '<div style="color: green; text-align: center">'. $message .'</div>';
    } ?>
    <?php if($message = getMessage('error')) {
        echo '<div style="color: red; text-align: center">'. $message .'</div>';
    } ?>
    <div class="signIn-form">

        <h2>Sign In</h2>
        <form action="/login" method="post">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email">
                     <?php showError('email');?>
                 </div>
                <div class="input-group">
                     <label for="password">Password</label>
                     <input type="password" name="password">
                     <?php showError('password');?>
                 </div>
                <input class="button" type="submit" value="Login">
         </form>
    </div>
</div>

</body>
</html>