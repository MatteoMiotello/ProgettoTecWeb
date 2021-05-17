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
                '<li><a href="/index.php" tabindex="0" lang="en">Home</a></li>',
                'Home',
            ],
            'cat' => [
                '<li><a href="/pages/categorie.php" tabindex="0">Categorie</a></li>',
                'Categorie',
            ],
            'form_articolo' => [
                '<li><a href="form_articolo.html" tabindex="0">Scrivi il tuo articolo</a></li>',
                'Scrivi il tuo articolo',
            ],
        ];

        if (key_exists($currentLink, $params)) {
          if ($currentLink=='home'){
            $params[$currentLink] = [
                '<li class="currentItem"><div class="currentLink" lang="en">' . $params[$currentLink][1] . '</div></li>',
                $params[$currentLink][1],
          }
          else {
            $params[$currentLink] = [
                '<li class="currentItem"><div class="currentLink">' . $params[$currentLink][1] . '</div></li>',
                $params[$currentLink][1],
            ];
          }
        }

        $links = '';

        foreach ($params as $param) {
            $links .= $param[0];
        }

        return $links;
    }

    /* funzione div utente */
}
