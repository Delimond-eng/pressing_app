<?php
namespace Models;


class Config extends Model{

    public function getAllDatas(){
        $datas = $this->executeQuery("SELECT * FROM products ORDER BY prod_id DESC");
        return $datas;
    }


    public function createConfig($data){
        $sql = "INSERT INTO products(prod_libelle,prod_pu,prod_devise) VALUES(:libelle, :pu,:devise)";
        $params = [
            ":libelle"=> $data["libelle"],
            ":pu"=> $data["pu"],
            ":devise"=> $data["devise"],
        ];
        $this->executeQuery($sql, $params);
        return $this->lastInsertId();
    }

    public function deleteConfig($id){
        $sql = "DELETE FROM products WHERE prod_id=:id";
        $params = [
            ":id"=> $id
        ];
        $this->executeDatas($sql, $params);
        return $this->lastInsertId();
    }
}