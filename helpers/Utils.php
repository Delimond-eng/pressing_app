<?php

/**
 * permet les rendues des view
 * @param string $view path de view
 * @param Array $data variables que l'on renvoit à la view
 */

function renderView(string $view,$data=[]){
    extract($data);// permet d'utiliser data comme variable dans nos views
    require __DIR__ . "/../views/templates/layouts/home/app-content.php";
    require __DIR__."/../views/pages/public/$view.php";
    require __DIR__ . "/../views/templates/layouts/home/app-end.php";;
}
function renderPrinting(string $view,$data=[]){
    extract($data);// permet d'utiliser data comme variable dans nos views
    require __DIR__."/../views/pages/public/$view.php";
}

function renderAuth(){
    require __DIR__."/../views/pages/auth/login.php";
}



/*
* permet la rediction des pages
 */
function redirect ($url){
    header("Location: $url");
    exit;
}


/**
 * Permet de creer un message flash stocké au niveau de la session avec $_SESSION
 * @param string $type type de message(primary, success, danger pour les erreurs)
 * @param string $message message à envoyer à la view !
 */
function setFlashMessage($type,$message){
    $_SESSION["flash-message"]=[
        "type"=>$type,
        "message"=>$message
    ];
}


/**
 * Permet d'afficher le message flash stocké dans la session via le code HTML
 * example : <div> <?php displayFlashMessage() ?> </div> dans l'endroit d'affichage du message
 */

function displayFlashMessage(){
    if(isset($_SESSION["flash-message"])){
        $flash = $_SESSION["flash-message"];
        unset($_SESSION["flash-message"]);
        echo "<div class='alert alert-light-{$flash['type']} light alert-dismissible fade show text-dark border-left-wrapper mb-3' role='alert'><i class='fa-solid fa-circle-info'> </i>
                      <p class='mb-0'>{$flash['message']}</p>
                      <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}


/**
 * Permet de verifier la session d'un utilisateur
 * Si connecté renvoi True sinon False
 * En fonction de la session de l'utilisateur
 * @return bool
 */
function isLoggedIn(){
    return isset($_SESSION['user_id']);
}


/**
 * Permet de verifier une valeur stockée dans la session
 * Si existe, retourne la session dont la clé est determinée sinon retourne "undefined"
 * @return mixed
 */
function getSession($name)
{
    if (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }else{
        return "undefined";
    }
}


/**
 * Permet  à valider les données envoyées via un formulaire en
 * méthode POST. Elle vérifie si des champs spécifiques sont présents et non vides.
 * @return mixed
 */


function validatePostData(array $keys): array {
    $errors = [];

    foreach ($keys as $key) {
        if (!isset($_POST[$key]) || empty(trim($_POST[$key]))) {
            $errors[] = "$key est requis.";
        }
    }

    return $errors;
}


function jsonResponse(array $value)
{
    header('Content-Type: application/json');
    echo json_encode($value,JSON_PRETTY_PRINT);
    exit;
}

