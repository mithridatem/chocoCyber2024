<?php
    require_once './env.php';
    //import de l'autoloader des classes
    require_once './vendor/autoload.php';
    use App\Utils\Utilitaire;
    use App\Controller\HomeController;
    use App\Controller\UtilisateurController;
    $homeController = new HomeController();
    $utilisateurController = new UtilisateurController();
    //utilisation de session_start(pour gérer la connexion au serveur)
    session_start();
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test si l'url posséde une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //routeur connecté
    if(isset($_SESSION["connected"])){
        switch ($path) {
            case '/chocoCyber2024/':
                $homeController->getHome();
                break;
            case '/chocoCyber2024/utilisateur/add':
                $homeController->getHome();
                break;
            case '/chocoCyber2024/utilisateur/connexion':
                $homeController->getHome();
                break;
            case '/chocoCyber2024/utilisateur/deconnexion':
                $utilisateurController->deconnexionUtilisateur();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
    //routeur déconnecté
    else{
        switch ($path) {
            case '/chocoCyber2024/':
                $homeController->getHome();
                break;
            case '/chocoCyber2024/utilisateur/add':
                $utilisateurController->addUtilisateur();
                break;
            case '/chocoCyber2024/utilisateur/connexion':
                $utilisateurController->connexionUtilisateur();
                break;
            case '/chocoCyber2024/utilisateur/deconnexion':
                $homeController->getHome();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
