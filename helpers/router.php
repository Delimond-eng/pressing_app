<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Controllers\UserController;
use Controllers\AppController;


$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

/**
 * Vérifie si l'utilisateur est connecté
 */
function isAuthenticated(): bool {
    return isset($_SESSION["user"]);
}

if (isAuthenticated()) {
    match ($uri) {
        "/" => (new AppController())->reporting(),
        "/invoice" => renderView("invoice"),
        "/create_invoice" => (new AppController())->createInvoice(),
        "/print_invoice" => renderPrinting("printing"),
        "/users_manage" => (new AppController())->manageUsers(),
        "/create_user" => (new UserController())->registerUser(),
        "/logout" => (new UserController())->signOut(),
        default => http_response_code(404) && exit("Erreur 404"),
    };
} else {
    match ($uri) {
        "/" => redirect("/login") && exit(),
        "/sign_in" => (new UserController())->login(),
        "/login" => renderAuth(),
        default => http_response_code(404) && exit("Erreur 404"),
    };
}
?>
