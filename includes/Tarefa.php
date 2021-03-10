<?php
require_once('Db.php');
require_once('Crud.php');
class Tarefa extends Db implements Crud
{
    private $titulo;
    private $descricao;
    private $prioridade;
    private $table = 'tarefas';
    private $projeto_id;

    public function __set($atrib, $value)
    {
        $this->$atrib = $value;
    }
    public function __get($atrib)
    {
        return $this->$atrib;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM $this->table WHERE `projeto_id` = :projeto_id";
        $result = $this->Query($sql);
        $result->execute([':projeto_id' => $this->projeto_id]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add(): bool
    {
        $result = $this->Query("INSERT INTO $this->table (`titulo`,`descricao`,`prioridade`,`projeto_id`) VALUES (:titulo,:descricao,:prioridade,:projeto_id)");
        return $result->execute(array(':titulo' => $this->titulo, ':descricao' => $this->descricao, ':prioridade' => $this->prioridade, ':projeto_id' => $this->projeto_id));
    }
    public function get($id): array
    {
        $result = $this->Query("SELECT * FROM $this->table WHERE `id` = :id");
        $result->execute(array(':id' => $id));
        return $result->fetch();
    }
    public function delete($id): bool
    {
        $result = $this->Query("DELETE FROM $this->table WHERE id = :id");
        return $result->execute(array(':id' => $id));
    }
    public function start($id): bool
    {
        $result = $this->Query("UPDATE $this->table SET `data_inicio` = :data_inicial WHERE `id` = :id AND `projeto_id` = :projeto_id");
        return $result->execute(array(':data_inicial' => date('Y-m-d H:i:s'), ':id' => $id, ':projeto_id' => $this->projeto_id));
    }
    public function finish($id): bool
    {
        $result = $this->Query("UPDATE $this->table SET `data_final` = :data_final WHERE `id` = :id AND `projeto_id` = :projeto_id");
        return $result->execute(array(':data_final' => date("Y-m-d H:i:s"), ':id' => $id, ':projeto_id' => $this->projeto_id));
    }
}
