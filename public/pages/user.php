<?php
$IdUtente = null;
if (isset($_GET['id_utente']))
    $IdUtente = $_GET['id_utente'];
else ; //errore da gestire

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/models/CheckValues.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/UserBuilder.php';

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
$handler->setNoOperation();
$handler->setCurrentRoute("user");

$access = Access::create();
if (!Access::isAuthenticated()) {
    $handler->setOperationError("Non sei loggato, esegui il login!");
    $handler->render();
    return;
}
$IdUtente = $_GET['user'];
$userModel = User::getUserById($IdUtente);

if($userModel==null){ $handler->setOperationError("Non esiste alcun utente con questo id"); $handler->render(); return; }

if (!$access->isAdministrator() && Access::getUser()->getId() != $userModel->getId()) {
    $handler->setOperationError('Non sei autorizzato ad accedere a questa pagina');
    $handler->render();
    return;
}
$errorContent = file_get_contents($filePath);
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/user_page_nuovo.html';

$handler->setContent($errorContent . file_get_contents($filePath));
$handler->setParam('{{ user_id }}', $IdUtente);

$numberOfArticles = User::getNumberOfWrittenArticles($IdUtente);
$givenLikes = User::getNumberOfGivenLikes($IdUtente);
$receivedLikes = User::getNumberOfLikesReceived($IdUtente);
if ($userModel) {
    $userPage = (new UserBuilder)
        ->setUserName($userModel->getName())
        ->setUserSurname($userModel->getSurname())
        ->setUserEmail($userModel->getEmail())
        ->setUserImg($userModel->getImg())
        ->setNumberOfWrittenArticles($numberOfArticles['count(*)'])
        ->setGivenLikes($givenLikes['SUM(voto.up)'])
        ->setReceivedLikes($receivedLikes)
        ->setUserAdminOption($userModel->isAdmin())
        ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/personalUserInfo.phtml'));
} else {
    $userPage = "<div>nessun utente presente</div>";
}

$handler->setParam("<personalUserInfo />", $userPage);


if (!empty($_POST)) {
    $userId = $_GET['user'];
    $handler->setNoOperation();
    $user = User::getUserById($userId);

    if (!isset($_POST['current'])) {
        $handler->setOperationError('password corrente non inserita');
        $handler->render();
        return;
    }

    if (!(md5($_POST['current']) == $user->getPassword())) {
        $handler->setOperationError('password non valida');
        $handler->render();
        return;
    }

    if ($_POST['new'] != $_POST['rep']) {
        $handler->setOperationError('le due password non coincidono');
        $handler->render();
        return;
    }

    $newPass = md5(CheckValues::sanitize($_POST['new']));

    $user->setPassword($newPass);

    if ($user->save()) {
        $handler->setOperationDone('salvataggio avvenuto con successo');
    } else {
        $handler->setOperationError('le due password non coincidono');
        $handler->render();
        return;
    }
}


$handler->render();
