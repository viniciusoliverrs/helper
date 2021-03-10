<?php
require_once('checkLogin.php');
$title = 'Index';
require_once("Header.php");
require_once("./includes/Projeto.php");
$projeto = new Projeto();
if (isset($_POST['salvar'])) {
    $projeto->nome = $_POST['nome'];
    $projeto->descricao = $_POST['descricao'];
    $projeto->add();
}
if (isset($_POST['projeto'])) {
    $_SESSION['projeto_id'] = $_POST['projeto'];
    header('location: Tarefa.php');
}
?>
<!--<div id="overlay">
    <div class="d-flex justify-content-center">
        <div class="loader"></div>
    </div>
</div>-->
<div class="container">
    <div class="row" style="margin-top:1rem;">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Novo Projeto
            </button>
        </div>
    </div>
    <form method="post">
        <div class="row" style="margin-top:1rem;">
            <div class="col-md-12">
                <?php
                if (!empty($projeto->getAll())) :
                ?>
                    <select class="form-control" name="projeto" onchange="this.form.submit()">
                        <option>Selecione o projeto aqui</option>
                        <?php
                        foreach ($projeto->getAll() as $item) :
                            if (empty($item['data_final'])) :
                        ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['nome']; ?></option>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </select>

                <?php else : ?>
                    <div class="alert alert-primary" role="alert">
                        Nenhum projeto encontrado!
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
</div>
</form>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Novo Projeto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button name="salvar" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once("Footer.php");
?>