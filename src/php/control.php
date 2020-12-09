<?php 
require_once "dbConnection.php";

$dbAccess = new DBAccess();
$connessioneRiuscita = $dbAccess->openDBConnection();

// bisogna fare la parte in cui viene selezionata la categoria, la query in caso di decisione sulla categoria e' gia' predisposta
function printListaArticoli($category, $dbAccess, $connessioneRiuscita) {
    if(!$connessioneRiuscita)
        die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
    else {
        $listaArticoli = $dbAccess->getArticoli($category);
        if($listaArticoli !=null) {
            $definitionListArticoli = '<dl id="articles">';
            foreach($listaArticoli as $articolo) {
                $definitionListArticoli .= '<dt>'. $articolo.getTitolo() . '</dt>';
                $definitionListArticoli .= '<dd>';
                $definitionListArticoli .= '<img src="images/' . $articolo.getImgPath() . '"alt="" />';
                $definitionListArticoli .= $articolo.getTesto();
                $definitionListArticoli .= '</dd>';
            }
            $definitionListArticoli = $definitionListArticoli. "</dl>";
        }
        else {
            // messaggio che dice che non ci sono articoli del db
            $definitionListArticoli = "<div>nessun articolo presente</div>";
        }
        $paginaHTML = file_get_contents('index.html');
        echo str_replace("<listaArticoli />", $definitionListArticoli, $paginaHTML);
    }
}
function printCategorie($dbAccess, $connessioneRiuscita) {
    if(!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
else {
    $categorie = $dbAccess->getCategorie();
    if($categorie !=null) {
        $listaCategoria = '<ul id="categorie">';
        foreach($categorie as $singolaCategoria) {
            $listaCategoria .= '<li>'. $singolaCategoria.getNome() . '</li>';
        }
        $listaCategoria = $listaCategoria. "</ul>";
    }
    else {
        // messaggio che dice che non ci sono categorie del db
        $listaCategoria = "<div>nessuna categoria presente</div>";
    }
    $paginaHTML = file_get_contents('index.html'); // in tutte le pagine deve essere fatto
    echo str_replace("<listaCategorie />", $listaCategoria, $paginaHTML);
}
} 
?>