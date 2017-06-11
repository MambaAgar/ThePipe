<?php
/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/10/17
 * Time: 11:26 AM
 */

session_destroy();
session_start();

include_once('config.php');
include_once('elements.php');

if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $query = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
    $query->execute([$_POST['username']]);
    $_SESSION['user'] = $query->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST['password'], $_SESSION['user']['password'])) {
        header('location: new.php');
    } else {
        //TODO Password incorrect
        unset($_SESSION['user']);
        $error = 'Incorrect credentials.  Try again.';
    }
}

elements::header('Login'); ?>
<div class="jumbotron">
    <h1>Login</h1>
    <?php if(isset($error)): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo($error) ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <p>
            <input class="form-control" type="text" name="username" placeholder="Username">
        </p>
        <p>
            <input class="form-control" type="password" name="password" placeholder="Password">
        </p>
        <input class="btn btn-default" type="submit" name="submit" value="Submit"/>
    </form>
</div>
<?php elements::footer() ?>
