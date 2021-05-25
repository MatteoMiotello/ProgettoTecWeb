<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';

$connessioneRiuscita = DBAccess::openDBConnection();
$handler = new TemplateHandler();
$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/registrati_nuovo.html';
$handler->setContent(file_get_contents($filePath));

// TODO: manca la parte in cui vengono raccolti valori 
const male = '../img/male_icon.png';
const famale = '../img/female_icon.png';
const genderfluid = '../img/genderfluid_icon.png';

// se tutti i campi della form sono stati compilati allora si puo' procedere a caricarli
if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pic_sel']) && $connessioneRiuscita) {
    $newUser = null;
    try{
        // setto l'immagine profilo dell'utente in base alla scelta
        switch($_POST['pic_sel']) {
            case "male":
                $_POST['pic_sel'] = male;
             case "female":
                $_POST['pic_sel'] = famale;
            case "genderfluid":
                $_POST['pic_sel'] = genderfluid;
            default:
                $_POST['pic_sel'] = genderfluid;
        }

        $newUser = new User(null, $_POST['nome'], $_POST['cognome'], $_POST['email'],  $_POST['password'],'usr', $_POST['pic_sel']);

        if(User::loadNewUser($newUser)) {
            $handler->setOperationDone("Registrazione riuscita! Scrivi e commenta in libertà!");
        }
        else $handler->setOperationError("I dati inseriti sono corretti ma il Database ha semesso di funzionare! Riprova più tardi!");
    }
    catch(Exception $e) {
        $handler->setOperationError("La compilazione dei campi dati non è avvenuta correttamente, riprovare!");
    }
}

$handler->setPageTitle('Registrati');
/*$handler->setBreadcrumb( 'Articoli della categoria: ' . $CategoryName )
    ->addLink( '/index.php', 'Home' )
    ->addLink( '/pages/categorie.php', 'Categorie' );*/

if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
else {
}

$handler->render();
