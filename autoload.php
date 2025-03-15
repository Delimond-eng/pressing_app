<?php

// Définir un autoloader pour charger les classes
spl_autoload_register(function ($class) {
    // Définir les chemins des répertoires
    $baseDir = __DIR__ . '/';

    // Vérifier si la classe appartient à un dossier spécifique
    $prefixes = [
        'Controllers\\' => 'controllers/',
        'Models\\' => 'models/',
        'Views\\' => 'views/pages/', // Si tu veux charger des pages dynamiques
        'Helpers\\' => 'helpers/'
    ];

    // Parcours des préfixes et vérifie la classe
    foreach ($prefixes as $prefix => $dir) {
        if (strpos($class, $prefix) === 0) {
            // Calculer le chemin du fichier
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . $dir . str_replace('\\', '/', $relativeClass) . '.php';

            // Si le fichier existe, inclure la classe
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});