<?php

namespace Controllers;


use Models\Invoice;
use Models\UserModel;

class AppController
{

    private Invoice $invoiceModel;
    private UserModel $userModel;


    public function __construct()
    {
        $this->invoiceModel = new Invoice();
        $this->userModel = new UserModel();
    }

    /**
     * login call
     * @return void
     */

    public function createInvoice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $montantFacture = 0;
            $details = $_POST["details"];
            $client = $_POST["client"];
            foreach ($details as $detail) {
                $montantFacture += (double)$detail["pu"] * (double)$detail["qte"];
            }

            $clientID = $this->invoiceModel->createCostumer([
                "phone"=>$client["phone"],
                "nom"=>$client["nom"],
            ]);

            $data = [
                "clientID"=> $clientID ?? null,
                "montant"=> $montantFacture,
                "devise" => "USD",
                "details"=> $details,
            ];

            $lastInsertedId = $this->invoiceModel->createFacture($data);
            if(isset($lastInsertedId)){
                $invoiceDatas = $this->invoiceModel->printFacture($lastInsertedId);
                if(isset($invoiceDatas)){
                    $_SESSION["invoiceDatas"] = $invoiceDatas;
                    redirect("/pressingapp/print_invoice");
                }
                else{
                    setFlashMessage(type: "warning", message: "Echec de l'impression de la facture");
                    redirect("/pressingapp/invoice");
                }
            }
            else{
                setFlashMessage(type: "warning", message: "Echec de la création de la facture !");
                redirect("/pressingapp/invoice");
            }
        }
    }


    public function reporting(){
        $factures = $this->invoiceModel->getAllFactures();
        renderView("dashboard", ["factures"=> $factures]);
    }
    public function manageUsers(){
        $users = $this->userModel->getAllUsers();
        renderView("users", ["users"=> $users]);
    }

    public function singlePrint(){
        $factureID = $_GET["id"];
        $invoiceDatas = $this->invoiceModel->printFacture($factureID);
        if(isset($invoiceDatas)){
            $_SESSION["invoiceDatas"] = $invoiceDatas;
            redirect("/pressingapp/print_invoice");
        }
    }
 

}
