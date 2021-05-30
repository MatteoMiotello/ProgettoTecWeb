<?php
$IdUtente = null;
if(isset($_GET['id_utente']))
    $IdUtente = $_GET['id_utente'];
else ; //errore da gestire

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/UserBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Pagina utente');


/**
 * Si eseguono controlli per verificare che effettivamente l'utente sia loggato e sia un amministratore
 */
// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/error.html';
$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute("user");
if(!Access::isAuthenticated()) {
    $handler->setOperationError("Non sei loggato, esegui il login!");
    $handler->render();
    return;
}

$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/user_page_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$IdUtente = $_GET['user'];

    $userModel = User::getUserById($IdUtente);
    $numberOfArticles = User::getNumberOfWrittenArticles($IdUtente);
    $givenLikes = User::getNumberOfGivenLikes($IdUtente);
    $receivedLikes = User::getNumberOfLikesReceived($IdUtente);
    if($userModel) {
        $userPage = (new UserBuilder)
        ->setUserName($userModel->getName())
        ->setUserSurname($userModel->getSurname())
        ->setUserEmail($userModel->getEmail())
        ->setUserImg($userModel->getImg())
        ->setNumberOfWrittenArticles($numberOfArticles['count(*)'])
        ->setGivenLikes($givenLikes['SUM(voto.up)'])
        ->setReceivedLikes($receivedLikes)
        ->setUserAdminOption($userModel->isAdmin())
        ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/personalUserInfo.phtml'));
    } else {
        // messaggio che dice che non ci sono articoli del db
        $userPage = "<div>nessun utente presente</div>";
    }

$handler->setParam("<personalUserInfo />",$userPage);
$handler->render();
