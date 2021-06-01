<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/Articolo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/Categoria.php';

$connessione = DBAccess::openDBConnection();
Access::create();
$author = Access::getUser();
(new DotEnv())->load();

/**
 * controllo se la form e' gia' stata compilata, in tal caso emetto un messaggio di avvenuta operazione con relativo esito
 */
if (isset($_POST['titolo_art']) && isset($_POST['descr_art']) && isset($_POST['testo_art']) && $author) {
    $file = $_FILES['img'];

    $fileNameFull = null;
    if (!empty($file['name']) and !empty($file['tmp_name']) and !empty($file['size'])) {
        /* salvo l'immagine con uniqid  */
        if (isset($file)) {
            print($file['size']);
            if ($file['size'] > 150000) {
                throw new Exception('File is too large');
            }

            $fileName = uniqid();
            $destDir = $_SERVER['DOCUMENT_ROOT'] . getenv('ARTICLE_IMAGES_DIR');
            $extension = pathinfo($file['name'])['extension'];
            $fileNameFull = sprintf("%s.%s", $fileName, $extension);
            $destPath = sprintf("%s%s.%s", $destDir, $fileName, $extension);

            if (!copy($file['tmp_name'], $destPath)) {
                throw new Exception('Errore nel salvataggio del file');
            }
        }
    }

    // provo a caricare l'articolo nel db
    $articleId = Articolo::getMaxId() + 1;

    $newArticle = new Articolo($articleId, $_POST['titolo_art'], $_POST['descr_art'], $_POST['testo_art'], $author->getId(), date('Y-m-d G:i:s'), '0', '0', "/assets/article_images/".$fileNameFull, $_POST['alt'], 1);

    if (isset($_GET['art_id'])) {
        $art = Articolo::getArticolo($_GET['art_id']);

        if ($art) {
            $art->setTitle( $_POST['titolo_art'] );
            $art->setDescription( $_POST['descr_art'] );
            $art->setContent( $_POST['testo_art'] );
            $art->setImgPath( $fileNameFull ? $fileNameFull : $art->getImgPath() );
            $art->setAltImg( $_POST['alt'] ? $_POST['alt'] : $art->getAltImg() );

            $result = Articolo::updateArticolo($art);

        } else {
            $result = false;
        }

        $id = $art->getID();

    } else {
        $result = Articolo::loadNewArticle($newArticle);
        $id = $newArticle->getID();
    }


    // se sono state settate categorie per l'articolo allora le carico nel db
    if (isset($_POST['category'])) {
        foreach ($_POST['category'] as $cat) {
            $res = Categoria::loadNewCategoryForArticle($cat, $id);
        }
    }

    // controllo che l'operazione sia andata a buon fine
    if ($result) {
        header('Location: /pages/gestione_art.php?success=true');
    } else {
        header('Location: /pages/gestione_art.php?success=false');
    }
}
