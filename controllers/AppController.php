<?php

namespace Controllers;


use Models\Invoice;
use Models\UserModel;
use Models\Config;

class AppController
{

    private Invoice $invoiceModel;

    private Config $configModel;
    private UserModel $userModel;


    public function __construct()
    {
        $this->invoiceModel = new Invoice();
        $this->userModel = new UserModel();
        $this->configModel = new Config();
    }


    public function showInvoice()  {
        $costumers = $this->invoiceModel->getAllCostumers();
        $configs = $this->configModel->getAllDatas();
        renderView("invoice", ["configs"=> $configs, "clients"=>$costumers]);
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

            $clientID = "";

            if(isset($client["id"]) && !empty($client["id"])){
                $clientID = $client["id"];
            }
            else{
                $clientID = $this->invoiceModel->createCostumer([
                    "phone"=>$client["phone"],
                    "nom"=>$client["nom"],
                ]);
            }

            $data = [
                "clientID"=> $clientID ?? null,
                "montant"=> $montantFacture,
                "remise"=>$client["remise"] ?? null,
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

    public function makePayment(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                "amount"=> (double)htmlentities($_POST["amount"]),
                "client_id"=> htmlentities($_POST["client_id"]),
                "facture_id" => htmlentities($_POST["facture_id"]),
            ];
            $latestInsertID = $this->invoiceModel->payeFacture($data);
            if(isset($latestInsertID)){
                setFlashMessage(type: "success", message: "Paiement effectué avec succès !");
                redirect("/pressingapp");
            }
            else{
                setFlashMessage(type: "danger", message: "Echec de traitement de la requête !");
                redirect("/pressingapp");
            }
        }
    }
    public function reportingPayment(){
        $reports = $this->invoiceModel->getAllPaiements();
        renderView("report", ["reports"=> $reports]);
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


    public function config(){ 
        $all = $this->configModel->getAllDatas();
        renderView("settings", ["settings"=> $all]);
    }


    public function createSetting(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                "libelle"=> htmlentities($_POST["libelle"]),
                "pu"=>(double)htmlentities($_POST["pu"]),
                "devise" => htmlentities($_POST["devise"]),
            ];

            $latestInsertID = $this->configModel->createConfig($data);
            if(isset($latestInsertID)){
                setFlashMessage(type: "success", message: "Configuration rubrique effectuée !");
                redirect("/pressingapp/config_manage");
            }
            else{
                setFlashMessage(type: "danger", message: "Echec de traitement de la requête !");
                redirect("/pressingapp/config_manage");
            }
        }
    }

    public function deleteSetting(){
        $id = $_GET["id"];
        if(isset($id)){
            $this->configModel->deleteConfig($id);
        }
        redirect("/pressingapp/config_manage");
    }
 

}
