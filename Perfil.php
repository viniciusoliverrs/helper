<?php
$title = 'Perfil';
require_once('checkLogin.php');
require_once("Header.php");
require_once('./includes/Usuario.php');
$usuarios = new Usuario();
if (isset($_POST['deletar'])) {
    $usuarios->delete($_SESSION['usuario_id']);
    session_destroy();
}
$usuario = $usuarios->get($_SESSION['usuario_id']);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <label>E-mail:</label>
            <?= $usuario['email'] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="Upload.php" class="btn btn-primary">Alterar foto</a>
        </div>
        <div class="col-md-4">
            <a href="AlterarSenha.php" class="btn btn-primary">Alterar Senha</a>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                Apagar conta
            </button>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <label>Tem certeza que quer apagar sua conta?</label>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Não</button>
                    <button name="deletar" class="btn btn-success">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once("Footer.php");
?>