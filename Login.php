<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once('./includes/Usuario.php');
if (isset($_POST['submit'])) {
	$usuario = new Usuario();
	$usuario->email = $_POST['email'];
	if ($usuario->checkUser()) {
		if ($usuario->getUserByEmail()['password'] == md5($_POST['password'])) {
			$_SESSION['usuario_id'] = $usuario->getUserByEmail($_POST['email'])['id'];
			header("location: Index.php");
		}
	} else {
		echo '<div class="alert alert-warning" role="alert">Erro ao realizar login!</div>';
	}
}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Login System</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/site.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="./assets/js/jquery-3.6.0.min.js"></script>
	<script>
		$(function() {
			if (localStorage.getItem("user") !== null) {
				getLocalStorage();
			}
			function setLocalStorage(user, pass) {
				localStorage.setItem('user', user);
				localStorage.setItem('pass', pass);
			}
			function getLocalStorage() {
				$('#email').val(localStorage.getItem("user"));
				$('#password').val(localStorage.getItem("pass"));
			}

			function removeLocalStorage() {
				localStorage.clear();
			}

			$('#form-login').on('submit', function() {
				let user = $('#email').val();
				let pass = $('#password').val();
				if ((user.length > 0) && (pass.length > 0)) {
					setLocalStorage(user, pass);
				}
			});
		});
	</script>
</head>

<body>
	<form class="form" id="form-login" name="form" method="post">
		<img class="logo-radius" src="./assets/imgs/Dashboard.jpg" />
		<input type="email" name="email" id="email" placeholder="Your e-mail" />
		<input type="password" name="password" id="password" placeholder="Your password" />
		<button name="submit" class="button-1" style="margin-top:20px;">Sign in</button><br />
		<a href="Registro.php">Criar nova conta</a>
	</form>
</body>

</html>