<?php
require_once('Crud.php');
require_once('Db.php');
class Usuario extends Db implements Crud
{
    private $email;
    private $password;
    private $token;
    private $table = 'usuarios';
    public function __construct()
    {
    }

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
        $result = $this->Query("SELECT * FROM $this->table");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get($id): array
    {
        $result = $this->Query("SELECT * FROM $this->table WHERE `id` = :id");
        $result->execute(array(':id' => $id));
        return $result->fetch();
    }
    public function checkUser()
    {
        $result = $this->Query("SELECT * FROM $this->table WHERE email = :email");
        $result->execute(array(':email' => $this->email));
        return $result->rowCount();
    }    
    public function getUserByEmail() : array
    {
        $result = $this->Query("SELECT id,password FROM $this->table WHERE email = :email");
        $result->execute(array(':email' => $this->email));
        return $result->fetch();
    }
    public function add(): bool
    {
        $result = $this->Query("INSERT INTO $this->table (`email`,`password`) VALUES (:email,:password)");
        return $result->execute(array(':email' => $this->email, ':password' => $this->password));
    }
    public function delete($id): bool
    {
        $result = $this->Query("DELETE FROM $this->table WHERE id = :id");
        return $result->execute(array(':id' => $id));
    }
}
