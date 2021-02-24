<?php
//error_reporting(E_ERROR | E_PARSE);
require_once('./dBConnection.php');
require_once('./modello.php');
$dbAccess = new DBAccess();
<<<<<<< HEAD
//$connessioneRiuscita = DBAccess::openDBConnection();
=======
$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = DBAccess::getConnection();
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
$HOST_DB = "localhost";
$USARNAME = "root";
$PASSWORD = "";
$DATABASE_NAME = "TecWeb";
<<<<<<< HEAD
$connessioneRiuscita = mysqli_connect($HOST_DB, $USARNAME, $PASSWORD, $DATABASE_NAME);
=======
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9

// todo bisogna fare la parte in cui viene selezionata la categoria, la query in caso di decisione sulla categoria e' gia' predisposta

function printListaArticoli($category,$connessioneRiuscita)
{
    if ($connessioneRiuscita == null) {
<<<<<<< HEAD
        echo "errore";
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
    }
    else {
        echo " sembra ok ";
=======
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
    }
    else {
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
        $listaArticoli = Articolo::getArticoli($category, $connessioneRiuscita);
        $articlesList = '';
        if ($listaArticoli != null) {
            foreach ($listaArticoli as $articolo) {
<<<<<<< HEAD
              $autore = Articolo::getAutoreArticolo($articolo->getID(), $connessioneRiuscita);
                $articlesList .= '<article>';
                $articlesList .= '<h1>' . $articolo->getTitolo() . '</h1>';
                $articlesList .= '<img src="images/' . $articolo->getImgPath() . '"alt="'. $articolo->getAltImg() .'" />';
                $articlesList .= '<p>'. $articolo->getDescrizione(). '</p>';
                $articlesList .= '<footer>';
                $articlesList .= '</footer>';
                $articlesList .= '</article>';
                /*
                $articlesList .= '<img src="images/' . $autore->getImgPath() . '"alt="" />';
                $articlesList .= '<p>'. $autore->getSurname() . ' ' . $autore->getName() . ' ' . $autore->getMail() . '</p>';
                $articlesList .= '</footer>';
                $articlesList .= '</article>';*/
=======
              $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
                $articlesList .= '<article class="articolo" >';
                $articlesList .= '<img src="'.$articolo->getImgPath().'" class="fotoArticolo"  alt="'. $articolo->getAltImg() .'" />';
                $articlesList .= '<div>';
                $articlesList .= '<h3>' . $articolo->getTitolo() . '</h1>';
                $articlesList .= '<p>' . $articolo->getDescrizione();
                $articlesList .= ' <a href="generic_page_articolo.html/?art_id={id}">Continua a leggere</a>';
                $articlesList .=  ' </p>';
                $articlesList .= '</div>';
                $articlesList .= '</article>';
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
            }
        } else {
            // messaggio che dice che non ci sono articoli del db
            $articlesList = "<div>nessun articolo presente</div>";
        }
<<<<<<< HEAD
        $paginaHTML = file_get_contents('../articolo.html');
=======
        $paginaHTML = file_get_contents('../html/index.html');
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
        echo str_replace("<listaArticoli />", $articlesList, $paginaHTML);
    }
}

<<<<<<< HEAD
function printCategorie($dbAccess, $connessioneRiuscita)
=======
// da controllare in base a come hanno gestito la creazione di categorie
function printCategorie($connessioneRiuscita)
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
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
<<<<<<< HEAD

printListaArticoli(null, $connessioneRiuscita);
=======
// print di prova
//printArticoloCompleto($connessioneRiuscita, 156612);
//printListaArticoli(null, $connessioneRiuscita);
printArticoloPerModifica($connessioneRiuscita, 156612);
>>>>>>> 26bc7cc368fa1740a77c0f850933b04691a5acd9
?>