<?php
session_start();
$title = 'Tarefa';
require_once('checkLogin.php');
require_once("Header.php");
require_once("./includes/Projeto.php");
require_once("./includes/Tarefa.php");
$projetos = new Projeto();
if (!isset($_SESSION['projeto_id']) && $_SESSION['projeto_id'] > 0) header("location: Projetos.php");
$tarefa = new Tarefa();
$projeto = $projetos->get($_SESSION['projeto_id']);
$tarefa->projeto_id = $_SESSION['projeto_id'];
if (isset($_POST['nova_tarefa'])) {
    $tarefa->titulo = $_POST['titulo'];
    $tarefa->descricao = $_POST['descricao'];
    $tarefa->prioridade = $_POST['prioridade'];
    if ($tarefa->add()) {
        echo '<div class="alert alert-success" role="alert">Nova tarefa cadastrada!</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Erro ao cadastrar nova tarefa!</div>';
    }
}
if (isset($_GET['delete'])) {
    if ($tarefa->delete($_GET['delete'])) {
        echo '<div class="alert alert-success" role="alert">Tarefa deletada!</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Erro ao deletar tarefa!</div>';
    }
}
if (isset($_GET['inicializar'])) {
    if ($tarefa->start($_GET['inicializar'])) {
        echo '<div class="alert alert-success" role="alert">Tarefa iniciada!</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Erro ao iniciar tarefa!</div>';
    }
}
if (isset($_GET['finalizar'])) {
    if ($tarefa->finish($_GET['finalizar'])) {
        echo '<div class="alert alert-success" role="alert">Tarefa finalizada!</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Erro ao finalizar tarefa!</div>';
    }
}
if (isset($_GET['finalizar_projeto'])) {
    if ($projetos->finish($_GET['finalizar_projeto'])) {
        $_SESSION['projeto_id'] = 0;
        header("Refresh:0");
        echo '<div class="alert alert-success" role="alert">Projeto finalizada!</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Erro ao finalizar projeto!</div>';
    }
}
?>
<div class="container">
    <div class="row alert alert-dark" style="margin-top:1rem;">
        <div class="col-md-3">
            <label>Projeto:</label>
            <?php echo $projeto['nome'] ?>
        </div>
        <div class="col-md-3">
            <label>Descrição:</label>
            <?php echo $projeto['descricao'] ?>
        </div>
        <div class="col-md-3">
            <label>Data inicial:</label>
            <?php echo $projeto['data_inicio'] ?>
        </div>
        <div class="col-md-3">
            <a class="btn btn-info" href="?finalizar_projeto=<?php echo $_SESSION['projeto_id']; ?>" style="float:right;">Encerrar</a>
        </div>
    </div>
    <div class="row" style="margin-top:1rem;">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Novo Tarefa
            </button>
        </div>
    </div>
    <?php
    if (!empty($tarefa->getAll())) :
    ?>
        <div class="row" style="margin-top:1rem;">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tilulo</th>
                        <th score="col">Data e hora inicial</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Prioridade</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tarefa->getAll() as $item) :
                        if ($item['data_final'] == '0000-00-00 00:00:00' || $item['data_final'] == '') :
                    ?>
                            <tr>
                                <th scope="row"><?php echo $item['id'] ?></th>
                                <td><?php echo $item['titulo'] ?></td>
                                <td><?php echo $item['data_inicio'] ?></td>
                                <td><?php echo $item['descricao'] ?></td>
                                <td><?php echo $item['prioridade'] ?></td>
                                <td><a href="?delete=<?php echo $item['id'] ?>" class="btn btn-danger">Deletar</a></td>
                                <td>
                                    <?php
                                    if ($item['data_inicio'] == '0000-00-00 00:00:00' || $item['data_inicio'] == '') :
                                        echo "<a class='btn btn-primary' href='?inicializar=" . $item['id'] . "'>Inicializar</a>";
                                    else :
                                        echo "<a class='btn btn-success' href='?finalizar=" . $item['id'] . "'>Finalizar</a>";
                                    endif;
                                    ?>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="col-md-12" style="margin-top:1rem;">
                <div class="alert alert-primary" role="alert">
                    Nenhum projeto encontrado!
                </div>
            </div>
        <?php
    endif;
        ?>
        </div>
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
                        <label>Titulo:</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição:</label>
                        <textarea type="text" name="descricao" class="form-control" row="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Prioridade:</label>
                        <select class="form-control" name="prioridade">
                            <option name="1">Baixa</option>
                            <option name="1">Média</option>
                            <option name="1">Alta</option>
                        </select>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button name="nova_tarefa" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once("Footer.php");
?>