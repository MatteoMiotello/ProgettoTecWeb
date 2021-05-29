<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';

$connessione = DBAccess::openDBConnection();
$handler = new TemplateHandler();
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/registrati_nuovo.html';
$handler->setContent(file_get_contents($filePath));

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
} else $handler->setNoOperation();
$handler->setPageTitle('Registrazione');
/*$handler->setBreadcrumb( 'Articoli della categoria: ' . $CategoryName )
    ->addLink( '/index.php', 'Home' )
    ->addLink( '/pages/categorie.php', 'Categorie' );*/
$handler->setKeywords("registrazione, registrati, utente, profilo");
$handler->setDescription("In questa sezione potrai registrare il tuo profilo utente.");
$handler->setAuthors("Andrea, Giosuè, Tommaso, Matteo");

const male = '/img/male_icon.png';
const famale = '/img/female_icon.png';
const genderfluid = '/img/genderfluid_icon.png';

// se tutti i campi della form sono stati compilati allora si puo' procedere a caricarli
if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pic_sel']) && $connessione) {
    $newUser = null;
    try {
        // setto l'immagine profilo dell'utente in base alla scelta
        $img = null;
        switch ($_POST['pic_sel']) {
            case "male":
                $img = male;
                break;
            case "female":
                $img = famale;
                break;
            case "genderfluid":
                $img = genderfluid;
                break;
            default:
                $img = genderfluid;
                break;
        }

        $newUser = new User(null, CheckValues::sanitize($_POST['nome']), CheckValues::sanitize($_POST['cognome']), CheckValues::sanitize($_POST['email']),  md5(CheckValues::sanitize($_POST['password'])), 'usr', $img);

        if (User::loadNewUser($newUser)) {
            $handler->setOperationDone("Registrazione riuscita! Scrivi e commenta in libertà!");
        } else $handler->setOperationError("La mail inserita è già presente all'interno del database, registrati usandone un'altra!");
    } catch (Exception $e) {
        $handler->setOperationError("La compilazione dei campi dati non è avvenuta correttamente, riprovare!");
    }
}

$handler->render();
