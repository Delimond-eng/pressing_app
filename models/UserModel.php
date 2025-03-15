<?php

namespace Models;

class UserModel extends Model
{

    /**
     * Permet de creer un nouveau utilisateur dans le systeme
     * @param array $data
     * @return string|null $id
    */
    public function createUser(array $data): string|null
    {
        try {
            $sql = "INSERT INTO users (username,pwd, role) 
            VALUES (:uname, :pwd, :role)";
            $params = [
                ":uname" => $data["username"],
                ":role" => $data["role"]
            ];
            $params[":pwd"] = password_hash($data["password"], PASSWORD_BCRYPT);
            $this->executeDatas($sql, $params);
            return $this->lastInsertId();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * verifie l'utilisateur par email
     * @param $email
     * @return null
     */
    public function findByName($name){
        $users = $this->executeQuery("SELECT * FROM users WHERE username = :uname",
        [
            ":uname"=>$name
        ]);

        if(!empty($users)){
            return $users[0];
        }
        else{
            return null;
        }
    }


    /**
     * La connexion de l'utilisateur
     * @param array $data
     * @return mixed
     */
    public function loginUser(array $data): mixed
    {
        $user= $this->findByName($data["username"]); 
        $verifyPassword = password_verify($data["password"],$user["pwd"]);
        
        if($user && $verifyPassword){
            $_SESSION["user"] = $user;
            return $user;
        }else{
            return null;
        }
    }

    public function getAllUsers(){
        return $this->executeQuery("SELECT * FROM users ORDER BY username ASC");
    }
}