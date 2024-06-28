<?php

class AuthController
{
    use Validator;
    public function register()
    {
        view('register');
    }

    public function registerProcess()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirm'],
        ]);

        try {
            $connector = Connect::getInstance();
            $statement = $connector->prepare('INSERT INTO users (name, email, password, age) VALUES (:name, :email, :password, :age)');
            $result = $statement->execute([
                'name' => Request::get('name'),
                'email' => Request::get('email'),
                'password' => password_hash(Request::get('password'), PASSWORD_BCRYPT),
                'age' => Request::get('age', 'int'), //basic is string
            ]);

            if($result) {
                Session::set('success', 'You have been registered');
                Response::redirect('/login');
            } else {
                echo 'Something wrong';
                exit;
            }

        } catch (PDOException $e) {
            echo "Something went wrong";
            echo $e->getMessage();
            exit;
        }
    }

    public function login() {
        view('login');
    }

    public function auth() {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = Request::get('email');
        $password = Request::get('password');

        try {
            $connector = Connect::getInstance();
            $statement = $connector->prepare('SELECT `id`, `email`, `password` FROM `users` WHERE `email` = :email AND `deleted_at` IS NULL');
            $statement->execute(['email' => $email]);
            $user = $statement->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($password, $user->password)) {
                $token =md5(time() . '_' . $user->email);
                $connector->exec("INSERT INTO `user_token` (`user_id`, `token`) VALUES ({$user->id}, '$token')");
                setcookie('token-auth', $token, time() + 60 * 60 * 24);
                Response::redirect('/');
            } else {
                Session::set('error', 'Email or password is incorrect');
                Response::redirect(Request::getReferer());//url reference (we are from)
            }


        } catch (PDOException $e) {
            echo "Something went wrong";
            echo $e->getMessage();
            exit;
        }
    }

    public function signOut() {
        Auth::protect(); //to sign out you have to be login

        setcookie('token-auth', '', time() - 3600);
        session_destroy();

        try {
            $userId = Auth::getUser()->id;
            $connector = Connect::getInstance();
            $connector->exec("DELETE FROM `user_token` WHERE `user_id` = {$userId}");
            Response::redirect('/');

        } catch (PDOException $e) {
            echo "Something went wrong";
            echo $e->getMessage();
            exit;
        }
    }
}