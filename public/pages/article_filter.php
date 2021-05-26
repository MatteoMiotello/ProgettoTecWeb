<?php

$CategoryName = '';
if(isset($_GET['cat_name']))
    $CategoryName = $_GET['cat_name'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/PreviewArticleBuilder.php';

$connessioneRiuscita = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Categoria'.$CategoryName);
$handler->setBreadcrumb( 'Articoli della categoria: ' . $CategoryName )
    ->addLink( '/pages/categorie.php', 'Categorie' );

$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/article_filter_nuovo.html';

$handler->setContent(file_get_contents($filePath));

if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
else {
    $rawArticles = Articolo::getArticoli($CategoryName, null);
    $articlesList = '';
    if ($rawArticles != null) {
        foreach ($rawArticles as $articolo) {
            $articlesList .= (new PreviewArticleBuilder)
            ->setID($articolo->getId())
            ->setTitle($articolo->getTitle())
            ->setDescription($articolo->getDescription())
            ->setImgPath($articolo->getImgPath())
            ->setImgAlt($articolo->getAltImg())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/articlePreview.phtml'))
            ;
        }
        } else {
        // messaggio che dice che non ci sono articoli del db
        $articlesList = "<div>nessun articolo presente</div>";
    }
}
$handler->setNoOperation();
$handler->setParam("{{categoryName}}",$CategoryName);
$handler->setParam("<listaArticoli />",$articlesList);
$handler->render(); 

?>

