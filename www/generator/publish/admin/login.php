<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 31/07/14
 * Time: 17:47
 */
require_once "inc/header.php";
require_once "../app/models/admins.php";
require_once "../../inc/PassHash.php";



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = $_REQUEST["email"];
    $senha = $_REQUEST["password"];

    //cookie session store

    $app->add(new \Slim\Middleware\SessionCookie(array(
        'expires' => '30 minutes',
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => false,
        'name' => 'USER_ID',
        'secret' => 'CHANGE_ME',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC
    )));


    if(!empty($email) && !empty($senha)){

//        var_dump(\Admins::all());

        $user = \Admins::where('email',$email)->first();

        if(count($user)==1) {
            //user exists

            if (PassHash::check_password($user->password,$senha)) {

                // User password is correct
                $_SESSION['USER_ID'] = $user->id;
                $_SESSION['USER_NAME'] = $user->name;


                $app->flash('success', 'Welcome');
//                $app->redirect('index.php');
            } else {

                // user password is incorrect
                $_SESSION['USER_ID'] = '';
                $_SESSION['USER_NAME'] = '';

                $app->flash('error', 'Cannot login');
            }

        } else {
            //user not exists
            $app->flash('error', 'Cannot login');
        }

    } else {
        $app->flash('error', 'Email and password are required to login');
    }
}


?>
    <!--        LOGIN-->
    <form class="form-signin" role="form" method="post">
        <h1 class="logo">YOUR LOGO</h1>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input id="email" name="email" type="email" class="form-control" placeholder="Email" required autofocus>
        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input id="remember" name="remember" type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br/>
        <?php require_once 'inc/messages.php' ?>
    </form>

<?php require_once "inc/footer.php"; ?>