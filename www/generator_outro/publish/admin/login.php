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
    $password = $_REQUEST["password"];
    $remember = isset($_REQUEST["remember"]) ? $_REQUEST["remember"] : false;


    if(!empty($email) && !empty($password)){

        $user = \Admins::where('email',$email)->first();

        if(count($user)==1) {
            //user exists

            if (PassHash::check_password($user->password,$password)) {

                // User password is correct
                if($remember==='true') {
                    $app->setCookie('USER_ID',$user->id);
                    $app->setCookie('USER_NAME',$user->name);
                } else {
                    $_SESSION['USER_ID'] = $user->id;
                    $_SESSION['USER_NAME'] = $user->name;
                }

                $app->flashNow('success', 'Welcome');

                //Redirect user to dashboard
                $app->redirect('dashboard');
            } else {

                $app->flashNow('error', 'Cannot login');
            }

        } else {
            //user not exists
            $app->flashNow('error', 'Cannot login');
        }

    } else {
        $app->flashNow('error', 'Email and password are required to login');
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
                <input id="remember" name="remember" type="checkbox" value="true"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br/>
        <?php require_once 'inc/messages.php' ?>
    </form>

<?php require_once "inc/footer.php"; ?>