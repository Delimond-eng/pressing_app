<?php
namespace Models;

use \PDO;
use \PDOException;

class Model
{
    private $dbname = "pressing_db";
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $pdo;

    // constructeur d'initialisation
    public function __construct(){
        $dsn="mysql:host={$this->host};dbname={$this->dbname};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo=new PDO($dsn,$this->username,$this->password,$options);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    /**
     * function pour  executer une requete query de PDO
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    protected function executeQuery(string $sql, array $params=[]): bool|array
    {
        $statement = $this->pdo->prepare($sql);
        $statement -> execute($params);
        return $statement->fetchAll();
    }

    /**
     * function pour  executer une requete de mise à jour des donnnées
     * @param string $sql
     * @param array $params
     * @return bool
     */
    protected function executeDatas(string $sql, array $params=[]): bool
    {
        $statement = $this->pdo->prepare($sql);
        return $statement->execute($params);
    }

    /**
     * Rend un id d'un enregistrement courant
     * @return string|false
    */
    protected function lastInsertId(): string|false
    {
        return  $this->pdo->lastInsertId();
    }
}


