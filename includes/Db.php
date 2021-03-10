<?php
abstract class Db
{
    private $instance;
    public function __construct()
    {
    }
    private function Connect()
    {
        if (!isset($this->instance)) {
            try {
                $this->instance = new PDO("mysql:host=localhost;dbname=test", 'root', '');
            } catch (PDOException $e) {
                throw new PDOException($e);
            }
        }
        return $this->instance;
    }
    protected function Query($sql)
    {
        return $this->Connect()->prepare($sql);
    }
}
