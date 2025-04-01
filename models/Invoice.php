<?php

namespace Models;


class Invoice extends Model
{
    public function createFacture($data)
    {
        try {
            $sql = "INSERT INTO factures (montant,remise,client_id, user_id) 
            VALUES (:montant,:remise, :clientID, :userID)";
            $params = [
                ":montant" => $data["montant"],
                ":remise" => $data["remise"],
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
    public function addFactureDetails($data)
    {
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
    public function createCostumer($data)
    {
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

    public function getAllCostumers()
    {
        $sql = "SELECT * FROM clients ORDER BY full_name ASC";
        return $this->executeQuery($sql);
    }

    public function printFacture($id)
    {
        $factures = $this->executeQuery("SELECT * FROM factures WHERE facture_id=:id", [":id" => $id]);
        if (isset($factures)) {
            $factureDetails = $this->executeQuery("SELECT * FROM facture_details WHERE facture_id = :id", [":id" => $id]);
            $clients = $this->executeQuery("SELECT * FROM clients WHERE id=:clientID", [":clientID" => $factures[0]["client_id"]]);
            $users = $this->executeQuery("SELECT * FROM users WHERE id=:uuid", [":uuid" => $factures[0]["user_id"]]);
            return [
                "facture" => $factures[0],
                "details" => $factureDetails,
                "client" => $clients[0],
                "user" => $users[0],
            ];
        } else {
            return [];
        }
    }

    public function getAllFactures()
    {
        $sql = "SELECT * FROM factures INNER JOIN clients ON factures.client_id = clients.id INNER JOIN users ON factures.user_id = users.id ORDER BY facture_id DESC";
        return $this->executeQuery($sql);
    }

    public function payeFacture($data)
    {
        $factures = $this->executeQuery("SELECT * FROM factures WHERE facture_id = :id", [":id" => $data["facture_id"]]);
        $sql = "INSERT INTO paiements(facture_id, client_id, paie_amount, due_amount, user_id) VALUES(:facId, :clientId,:amount, :due, :uuid)";
        $params = [
            ":facId" => $data["facture_id"],
            ":clientId" => $data["client_id"],
            ":amount" => $data["amount"],
            ":due" => $factures[0]["montant"],
            ":uuid" => $_SESSION["user"]["id"]
        ];
        $this->executeDatas($sql, $params);
        $paiementId = $this->lastInsertId();
        $lastPaieMontant = $factures[0]["montant_paie"];
        $calculatePaie = $lastPaieMontant + (float)$data["amount"];
        $this->executeDatas("UPDATE factures SET montant_paie = :pay_amount WHERE facture_id = :id", [
            ":pay_amount" => $calculatePaie,
            ":id" => $data["facture_id"],
        ]);

        return $paiementId;
    }

    public function getAllPaiements()
    {
        $sql = "SELECT 
    f.facture_id,
    f.*, 
    c.*, 
    u.*, 
    SUM(p.paie_amount) AS total_paiement,
    MAX(p.paie_date) AS date_paie
FROM Paiements AS p 
INNER JOIN factures AS f ON p.facture_id = f.facture_id 
INNER JOIN clients AS c ON p.client_id = c.id 
INNER JOIN users AS u ON p.user_id = u.id 
GROUP BY f.facture_id, c.id, u.id
ORDER BY f.facture_id DESC";
        $allDatas = $this->executeQuery($sql);
        return $allDatas;
    }
}
