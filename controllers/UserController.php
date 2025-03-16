<?php

namespace Controllers;


use Models\UserModel;


class UserController
{

    private UserModel $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * login call
     * @return void
     */

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $data = [
                'username' => $username,
                'password' => $password
            ];
            $user = $this->userModel->loginUser($data);   
            if($user){
                redirect('/pressingapp');
            }
            else{
                setFlashMessage(type: "danger", message: "Email ou mot de passe incorrect");
                redirect('/pressingapp/login');
            }
        }
    }
 


    /**
     * Cree un utilisateur et retourne un JSON
     * @return void
     */
    public function registerUser(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $requiredFields = ["username", "password", "role"]; // On enlève "password"

            $errors = validatePostData($requiredFields);

            if (!empty($errors)) {
                $errorStr = implode(",", $errors);
                setFlashMessage(type: "danger", message: $errorStr);
            } else {
                $username = htmlentities($_POST["username"]);
                $password = htmlentities($_POST["password"]);
                $role = htmlentities($_POST["role"]);
                $data = [
                    "username" => $username,
                    "password" => $password,
                    "role" => $role
                ];
                $response = $this->userModel->createUser($data);
                setFlashMessage(type: "success", message: "Utilisateur créé avec succè !");
                redirect("/pressingapp/users_manage");
            }
        }
    }

  

   /*  fonction pour deconnecter*/
    public function signOut(){
        unset($_SESSION["user"]);
        redirect('/pressingapp/login');
    }
}
