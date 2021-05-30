<?php
set_exception_handler( function ( $exception ) {
    ( new Ex )
} )

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';

$connessione = DBAccess::openDBConnection();
Access::create();
$author = Access::getUser();
( new DotEnv() )->load();

/**
 * controllo se la form e' gia' stata compilata, in tal caso emetto un messaggio di avvenuta operazione con relativo esito
 */
if (isset($_POST['titolo_art']) && isset($_POST['descr_art']) && isset($_POST['testo_art']) && isset($_POST['alt']) && $author) {
    $file = $_FILES['img'];
    /* salvo l'immagine con uniqid  */
    if ( isset( $file ) ) {
        if ($file['size'] > 640000) {
            throw new Exception('File is too large');
        }
        $fileName = uniqid();
        $destDir = $_SERVER['DOCUMENT_ROOT'] . getenv( 'ARTICLE_IMAGES_DIR' );
        $extension = pathinfo($file['name'])['extension'];
        $fileNameFull = sprintf("%s.%s", $fileName, $extension);
        $destPath = sprintf("%s%s.%s", $destDir, $fileName, $extension);

        if (!copy($file['tmp_name'], $destPath)) {
            throw new Exception('Errore nel salvataggio del file');
        }

        // provo a caricare l'articolo nel db
        $articleId = Articolo::getMaxId() + 1;
        $newArticle = new Articolo($articleId, $_POST['titolo_art'], $_POST['descr_art'], $_POST['testo_art'], $author->getId(), date('Y-m-d G:i:s'), '0', '0', $fileNameFull, $_POST['alt'], 1);

        $result = Articolo::loadNewArticle($newArticle);

        // se sono state settate categorie per l'articolo allora le carico nel db
        if (isset($_POST['category'])) {
            $selectedCat = array();
            foreach ($_POST['category'] as $cat) {
                $res = Categoria::loadNewCategoryForArticle($cat, $articleId);
            }
        }

        // controllo che l'operazione sia andata a buon fine
        if ($result) {
            header('Location: /pages/modify_article_admin.php?success=true&art_id=' . $newArticle->getId());
        } else {
            throw new Exception('non é stato possibile salvare il file');
        }
    }
}