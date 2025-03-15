<?php
namespace Models;


class Invoice extends Model {
    public function createFacture($data) {
        try {
            $sql = "INSERT INTO factures (montant,devise, client_id, user_id) 
            VALUES (:montant, :devise, :clientID, :userID)";
            $params = [
                ":montant" => $data["montant"],
                ":devise" => $data["devise"],
                ":clientID" => $data["clientID"],
                ":userID" => $_SESSION["user"]["id"],
            ];
            $this->executeDatas($sql, $params);

            $facID = $this->lastInsertId();

            if (isset($facID)) {
                $details = $data["details"];
                foreach ($details as $d) {
                    $d["factureID"] = $facID;
                   $this->addFactureDetails($d);
                }
            }
            return $facID;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
    public function addFactureDetails($data) {
        try {
            $sql = "INSERT INTO facture_details (libelle,pu,qte, facture_id, user_id) 
            VALUES (:libelle, :pu,:qte, :factureID,:userID)";
            $params = [
                ":libelle" => $data["libelle"],
                ":pu" => $data["pu"],
                ":qte" => $data["qte"],
                ":factureID" => $data["factureID"],
                ":userID" => $_SESSION["user"]["id"],
            ];
            $this->executeDatas($sql, $params);
            return $this->lastInsertId();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
    public function createCostumer($data) {
        try {
            $sql = "INSERT INTO clients(full_name,phone, user_id) 
            VALUES (:nom, :phone, :userID)";
            $params = [
                ":nom" => $data["nom"],
                ":phone" => $data["phone"],
                ":userID" => $_SESSION["user"]["id"],
            ];
            $this->executeDatas($sql, $params);
            return $this->lastInsertId();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function printFacture($id){
        $factures = $this->executeQuery("SELECT * FROM factures WHERE facture_id=:id", [":id"=> $id]);
        if(isset($factures)){
            $factureDetails = $this->executeQuery("SELECT * FROM facture_details WHERE facture_id = :id", [":id"=> $id]);
            $clients = $this->executeQuery("SELECT * FROM clients WHERE id=:clientID", [":clientID"=> $factures[0]["client_id"]]);
            $users = $this->executeQuery("SELECT * FROM users WHERE id=:uuid", [":uuid"=> $factures[0]["user_id"]]);
            return [
                "facture"=> $factures[0],
                "details"=> $factureDetails,
                "client"=> $clients[0],
                "user"=> $users[0],
            ];
        }
        else{
            return [];
        }
    }

    public function getAllFactures(){
        $sql = "SELECT * FROM factures INNER JOIN clients ON factures.client_id = clients.id INNER JOIN users ON factures.user_id = users.id ORDER BY facture_id DESC";
        return $this->executeQuery($sql);
    }
}