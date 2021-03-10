<?php
require_once('checkLogin.php');
if (isset($_FILES['fileUpload'])) {
    try {
        $extension = strtolower(substr($_FILES['fileUpload']['name'], -4)); //Pegando extensão
        $name = $_SESSION['usuario_id']. $extension;//Renomeando o arquivo
        $dir = "Uploads/";
        $path = $dir."/".$_SESSION['usuario_id']."/".$name;
        if(file_exists($path)) if(unlink($path)) echo "<script>alert('Foto atualizada!');</script>";
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $path); //Fazer upload
    } catch (Exception $e) {
        echo $e;
    }
}
$title = 'Index';
require_once("Header.php");
?>
    <form class="form" method="post" enctype="multipart/form-data">
        <input type="file" name="fileUpload" />
        <button style="margin-top:20px;" class="btn btn-primary">Enviar</button>
    </form>
<?php
require_once("Footer.php");
?>