<?php
//error_reporting(E_ERROR | E_PARSE);
require_once('./dBConnection.php');
require_once('./modello.php');
$dbAccess = new DBAccess();
//$connessioneRiuscita = DBAccess::openDBConnection();
$HOST_DB = "localhost";
$USARNAME = "root";
$PASSWORD = "";
$DATABASE_NAME = "TecWeb";
$connessioneRiuscita = mysqli_connect($HOST_DB, $USARNAME, $PASSWORD, $DATABASE_NAME);

// bisogna fare la parte in cui viene selezionata la categoria, la query in caso di decisione sulla categoria e' gia' predisposta

function printListaArticoli($category,$connessioneRiuscita)
{
    if ($connessioneRiuscita == null) {
        echo "errore";
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
    }
    else {
        echo " sembra ok ";
        $listaArticoli = Articolo::getArticoli($category, $connessioneRiuscita);
        $articlesList = '';
        if ($listaArticoli != null) {
            foreach ($listaArticoli as $articolo) {
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
            }
        } else {
            // messaggio che dice che non ci sono articoli del db
            $articlesList = "<div>nessun articolo presente</div>";
        }
        $paginaHTML = file_get_contents('../articolo.html');
        echo str_replace("<listaArticoli />", $articlesList, $paginaHTML);
    }
}

function printCategorie($dbAccess, $connessioneRiuscita)
{
    if (!$connessioneRiuscita)
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
    else {
        $categorie = $dbAccess->getCategorie();
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


function printUsers(){
    $user = User::getAllUsers();
}

printListaArticoli(null, $connessioneRiuscita);
?>