<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('./includes/Usuario.php');
$usuario = new Usuario();
if (isset($_POST['submit'])) {
    $usuario->email = $_POST['email'];
    $usuario->password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if ($usuario->password != $confirm_password) {
        echo '<div class="alert alert-warning" role="alert">Senhas são diferente!</div>';
    } else {
        if (!$usuario->checkUser()) {
            if ($usuario->add()) {
                echo '<div class="alert alert-success" role="alert">Novo usuário cadastrado!</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">Erro ao cadastrar usuário!</div>';
        }
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Nova conta</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/site.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <form class="form" name="form" method="post">
        <img class="logo-radius" src="./assets/imgs/Dashboard.jpg" />
        <input type="email" name="email" placeholder="Your e-mail" />
        <input type="password" name="password" placeholder="Your password" />
        <input type="password" name="confirm_password" placeholder="Confirm password" />
        <button name="submit" class="button-1" style="margin-top:20px;">Nova conta</button><br />
    </form>
</body>

</html>