<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Controllers\UserController;
use Controllers\AppController;


//$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$basePath = dirname($_SERVER["SCRIPT_NAME"]); ; // Mets ici le bon dossier
$uri = str_replace($basePath, "", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));


/**
 * Vérifie si l'utilisateur est connecté
 */
function isAuthenticated(): bool {
    return isset($_SESSION["user"]);
}

if (isAuthenticated()) {
    match ($uri) {
        "/" => (new AppController())->reporting(),
        "/reporting" => (new AppController())->reportingPayment(),
        "/invoice" => (new AppController())->showInvoice(),
        "/order_invoice" => (new AppController())->makePayment(),
        "/create_invoice" => (new AppController())->createInvoice(),
        "/delete_invoice" => (new AppController())->deleteFac(),
        "/print_invoice" => renderPrinting("printing"),
        "/users_manage" => (new AppController())->manageUsers(),
        "/create_user" => (new UserController())->registerUser(),
        "/single_print" => (new AppController())->singlePrint(),
        "/config_manage" => (new AppController())->config(),
        "/config_create" => (new AppController())->createSetting(),
        "/config_delete" => (new AppController())->deleteSetting(),
        "/logout" => (new UserController())->signOut(),
        default => http_response_code(404) && exit("Erreur 404"),
    };
} else {
    match ($uri) {
        "/" => redirect("/pressingapp/login") && exit(),
        "/sign_in" => (new UserController())->login(),
        "/login" => renderAuth(),
        default => http_response_code(404) && exit("Erreur 404"),
    };
}
?>
