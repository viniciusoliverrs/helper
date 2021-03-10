<?php
require_once('Db.php');
require_once('Crud.php');
class Projeto extends Db implements Crud
{
    private $nome;
    private $descricao;
    private $table = 'projetos';
    public function __construct()
    {
    }
    public function __set($atrib,$value)
    {
        $this->$atrib = $value;
    }
    public function __get($atrib){
        return $this->$atrib;
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->Query($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add(): bool
    {
        $result = $this->Query("INSERT INTO $this->table (`nome`,`descricao`,`data_inicio`) VALUES (:nome,:descricao,:data_inicio)");
        return $result->execute(array(':nome' => $this->nome, ':descricao' => $this->descricao,':data_inicio'=> date("Y-m-d H:i:s")));
    }
    public function get($id): array
    {
        $result = $this->Query("SELECT * FROM $this->table WHERE id = :id");
        $result->execute(array(':id' => $id));
        return $result->fetch();
    }
    public function delete($id): bool
    {
        $result = $this->Query("DELETE FROM $this->table WHERE id = :id");
        return $result->execute(array(':id' => $id));
    }
    public function finish($id): bool
    {
        $result = $this->Query("UPDATE $this->table SET `data_final` = :data_final WHERE `id` = :id");
        return $result->execute(array(':data_final' => date("Y-m-d H:i:s"), ':id' => $id));
    }
}
