<?php

$id_articolo = null;

if (isset($_GET['art_id']))
    $id_articolo = $_GET['art_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/CategoryBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/ArticleBuilder.php';

$connessioneRiuscita = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Form Articolo');
$handler->setBreadcrumb('Scrivi un articolo');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/form_articolo_admin_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('form_articolo');

if (!$connessioneRiuscita && !$id_articolo)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
    $articolo = Articolo::getArticolo($id_articolo);
    $autore = User::getArticleAuthor($articolo->getID());
    $categorieArticolo = Categoria::getCategorieArticolo($articolo->getID());
    $categorie = Categoria::getCategorie();
    $articleContent = (new ArticleBuilder)
        ->setTitle($articolo->getTitle())
        ->setDescription($articolo->getDescription())
        ->setContent($articolo->getContent())
        ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/formArticleContent.phtml'));
    if ($categorie) {
        $listaCategoria = '';
        foreach ($categorie as $singolaCategoria) {
            $value = (new CategoryBuilder)
                ->setName($singolaCategoria->getNome());

            if ($categorieArticolo) {
                foreach ($categorieArticolo as $cat) {
                    if ($singolaCategoria->getNome() == $cat->getNome())
                        $value->setActive();
                }
            }

            $listaCategoria .= $value->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/chooseCategoryFormArticle.phtml'));
        }
    } else {
        // messaggio che dice che non ci sono categorie del db
        $listaCategoria = "<div>nessuna categoria presente</div>";
    }

    $handler->setParam("<formArticleContent />", $articleContent);
    $handler->setParam("<listaCategorie />", $listaCategoria);
    $handler->render();
}
