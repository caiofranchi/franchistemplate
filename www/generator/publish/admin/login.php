<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 31/07/14
 * Time: 17:47
 */
require_once "inc/header.php"

?>
    <!--        LOGIN-->
    <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
<?php

require_once "inc/footer.php"

?>