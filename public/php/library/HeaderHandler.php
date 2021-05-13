<?php


class HeaderHandler {
    /**
     * Costruisce i link dell'header
     *
     * @param $currentLink
     * @return string
     * @throws Exception
     */
    public static function getHeaderLinks( $currentLink ) {
        $params = [
            'home' => [
                '<li><a href="index.html">Home</a></li>',
                'Home',
            ],
            'cat' => [
                '<li><a href="cat.html">Categorie</a></li>',
                'Categorie',
            ],
            'form_articolo' => [
                '<li><a href="form_articolo.html">Scrivi il tuo articolo</a></li>',
                'Scrivi il tuo articolo',
            ],
            'login' => [
                '<li><a href="login.html">Accedi</a></li>',
                'Accedi',
            ],
        ];

        echo $currentLink;

        if (!key_exists($currentLink, $params)) {
            throw new Exception('La pagina non esiste');
        }

        $params[$currentLink] = [
            '<li id="currentItem"><span lang="en" id="currentLink">' . $params[$currentLink][1] . '</span></li>',
            $params[$currentLink][1],
        ];

        $links = '';

        foreach ($params as $param) {
            $links .= $param[0];
        }

        return $links;
    } 
}