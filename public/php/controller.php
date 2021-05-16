<?php
//error_reporting(E_ERROR | E_PARSE);
require_once('./dBConnection.php');
require_once('./modello.php');
$dbAccess = new DBAccess();
$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = DBAccess::getConnection();
$HOST_DB = "localhost";
$USARNAME = "root";
$PASSWORD = "password";
$DATABASE_NAME = "tec_web";

// todo bisogna fare la parte in cui viene selezionata la categoria, la query in caso di decisione sulla categoria e' gia' predisposta

function printListaArticoli($limit, $connessioneRiuscita)
{
    if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
    else {
        $rawArticles = Articolo::getArticoli(null, $connessioneRiuscita, null);
        $articlesList = '';
        if ($rawArticles != null) {
            foreach ($rawArticles as $articolo) {
                $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
                $articlesList .= '<article class="articolo" >';
                $articlesList .= '<img src="' . $articolo->getImgPath() . '" class="fotoArticolo"  alt="' . $articolo->getAltImg() . '" />';
                $articlesList .= '<div>';
                $articlesList .= '<h3>' . $articolo->getTitolo() . '</h1>';
                $articlesList .= '<p>' . $articolo->getDescrizione();
                $articlesList .= '<a href="/pages/generic_page_article.php?art_id=' . $articolo->getId() . '" >Continua a leggere</a>';
                $articlesList .=  ' </p>';
                $articlesList .= '</div>';
                $articlesList .= '</article>';
            }
        } else {
            // messaggio che dice che non ci sono articoli del db
            $articlesList = "<div>nessun articolo presente</div>";
        }
    }
    return $articlesList;
}

function printSideNews(string $category) {
    $covidNews = Articolo::getArticoli($category, $connessioneRiuscita, 5);
    $covidNewsList = '';
    if ($covidNews != null) {
        foreach ($covidNews as $articolo) {
            $covidNewsList .= '<li>';
            $covidNewsList .= '<a href="/pages/generic_page_article.php?art_id='.$articolo->getId().'" >'.$articolo->getTitolo().'</a>';
            $covidNewsList .= '</li>';
        }
    } else {
        // messaggio che dice che non ci sono articoli del db
        $covidNewsList = "<div>nessuna news covid presente</div>";
    }
}

// da controllare in base a come hanno gestito la creazione di categorie
function printCategorie($connessioneRiuscita)
{
    if (!$connessioneRiuscita)
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
    else {
        $categorie = Categoria::getCategorie($connessioneRiuscita);
        if ($categorie != null) {
            $listaCategoria = '<ul id="categorie">';
            foreach ($categorie as $singolaCategoria) {
                $listaCategoria .= '<li>' . $singolaCategoria . getNome() . '</li>';
            }
            $listaCategoria = $listaCategoria . "</ul>";
        } else {
            // messaggio che dice che non ci sono categorie del db
            $listaCategoria = "<div>nessuna categoria presente</div>";
        }
        $paginaHTML = file_get_contents('index.html'); // in tutte le pagine deve essere fatto
        echo str_replace("<listaCategorie />", $listaCategoria, $paginaHTML);
    }
}

function printArticoloCompleto($connessioneRiuscita, $id_articolo) {
    if (!$connessioneRiuscita)
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
    else {
        $printArticolo = '';
        $articolo = Articolo::getArticolo($id_articolo, $connessioneRiuscita);
        $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
        $listaCategorie = Categoria::getCategorieArticolo($articolo->getID(), $connessioneRiuscita);
        if($articolo != null) {
            $printArticolo .= '<div class="printArticolo">';
            $printArticolo .= '<div class="upperPrint">';
            $printArticolo .= '<img src="'.$articolo->getImgPath().'" alt="'.$articolo->getAltImg().'">';
            $printArticolo .= '<h1>'.$articolo->getTitolo().'</h1>';
            $printArticolo .= '</div>';
            $printArticolo .= '<p>'.$articolo->getTesto().'</p>';
            $printArticolo .= '</div>';
            $printArticolo .=  '<div class="info_art">';
            $printArticolo .= '<div id="author">';
            if($autore) {
                $printArticolo .= '<img src="'.$autore->getImg().'">';
                $printArticolo .= '<p>'.$autore->getName().'</p>';
                $printArticolo .= '<p>'.$autore->getEmail().'</p>';
            }
            else $printArticolo .= '<p>Autore non presente</p>';
            $printArticolo .= '</div>'; 
            $printArticolo .= '<div id="get_cat">';
            if($listaCategorie) {
                foreach($listaCategorie as $categoria) {
                    $printArticolo .= '<p>'.$categoria->getNome().'</p>';
                }
            }   
            else $printArticolo .= '<p>Categoria non presente</p>';
            $printArticolo .= '</div>';
            $printArticolo .= '</div>';
        }
        else {
            $printArticolo .= "<div>Nessun articolo presente</div>";
        }
        $paginaHTML = file_get_contents('../html/generic_page_articolo.html');
        echo str_replace("<articolo />", $printArticolo, $paginaHTML);
    }
}

function printArticoloPerModifica($connessioneRiuscita, $id_articolo) {
    if (!$connessioneRiuscita)
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
    else {
        $printArticolo = '';
        $articolo = Articolo::getArticolo($id_articolo, $connessioneRiuscita);
        $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
        $listaCategorie = Categoria::getCategorieArticolo($articolo->getID(), $connessioneRiuscita);
        if($articolo != null) {
            $printArticolo .= '<div class="printArticolo">';
            $printArticolo .= '<div class="upperPrint">';
            $printArticolo .= '<label for="titolo" >'.Titolo.'</label>';
            $printArticolo .= '<textarea id="titolo" >'.$articolo->getTitolo().'</textarea>';
            $printArticolo .= '<label for="descrizione" >'.Descrizione.'</label>';
            $printArticolo .= '<textarea id="descrizione" >'.$articolo->getDescrizione().'</textarea>';
            $printArticolo .= '</div>';
            $printArticolo .= '<label for="testo" >'.Testo.'</label>';
            $printArticolo .= '<textarea id="testo" >'.$articolo->getTesto().'</textarea>';
            $printArticolo .= '</div>';
            $printArticolo .=  '<div class="info_art">';
            $printArticolo .= '<div id="author">';
            if($autore) {
                $printArticolo .= '<img src="'.$autore->getImg().'">';
                $printArticolo .= '<p>'.$autore->getName().'</p>';
                $printArticolo .= '<p>'.$autore->getEmail().'</p>';
            }
            else $printArticolo .= '<p>Autore non presente</p>';
            $printArticolo .= '</div>'; 
            $printArticolo .= '<div id="get_cat">';
            if($listaCategorie) {
                foreach($listaCategorie as $categoria) {
                    $printArticolo .= '<p>'.$categoria->getNome().'</p>';
                }
            }   
            else $printArticolo .= '<p>Categoria non presente</p>';
            $printArticolo .= '</div>';
            $printArticolo .= '</div>';
        }
        else {
            $printArticolo .= "<div>Nessun articolo presente</div>";
        }
        $paginaHTML = file_get_contents('../html/generic_page_articolo.html');
        echo str_replace("<articolo />", $printArticolo, $paginaHTML);
    }
}

function printUsers(){
    $user = User::getAllUsers();
}
// print di prova
//printArticoloCompleto($connessioneRiuscita, 156612);
//printListaArticoli(null, $connessioneRiuscita);
printArticoloPerModifica($connessioneRiuscita, 156612);
?>