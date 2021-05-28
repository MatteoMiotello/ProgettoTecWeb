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
                '<li><a href="/index.php" tabindex="0" lang="en"><div>Home</div></a></li>',
                'Home',
            ],
            'cat' => [
                '<li><a href="/pages/categorie.php" tabindex="0"><div>Categorie</div></a></li>',
                'Categorie',
            ],
            'form_articolo' => [
                '<li><a href="/pages/form_article.php" tabindex="0"><div>Scrivi il tuo articolo</div></a></li>',
                'Scrivi il tuo articolo',
            ],
        ];

        if (key_exists($currentLink, $params)) {
          if ($currentLink=='home'){
            $params[$currentLink] = [
                '<li class="currentItem"><div class="currentLink" lang="en">' . $params[$currentLink][1] . '</div></li>',
                $params[$currentLink][1],
            ];
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


    public static function getUserInfo($currentLink) {
        $access = Access::create();

        /*if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'login.php' ) or strpos( $_SERVER[ 'REQUEST_URI' ], 'register.php' ) ) {
            return '';
        }*/

        if ( !$access->isAuthenticated() || !User::getUserById($_SESSION['user_id']) ) {
            if(strpos( $_SERVER[ 'REQUEST_URI' ], 'login.php' )) return '<div class="currentLink"><p>Accedi/Registrati</p></div>';
            return '<a href="/pages/login.php" tabindex="0"><div>Accedi/Registrati</div></a>';
        }
        else{
          $utente = $_SESSION['user_id'];
          $path = User::getUserById($utente)->getImg();
          if(strpos( $_SERVER[ 'REQUEST_URI' ], 'user.php' )){
            $html = "<div class='user_cont hFlex'>
                    <div class='logout_cont vFlex'>
                    <span class='currentLink'>Il mio profilo</span>
                    <a href='/pages/logout.php'>Esci</a></div>
                    </div>
                    <img class='user_img' src=$path alt>";
          }
          else{ $html = "<div class='user_cont hFlex'>
                        <div class='logout_cont vFlex'>
                        <a href='/pages/user.php?user=$utente'>Il mio profilo</a>
                        <a href='/pages/logout.php'>Esci</a></div>
                        </div><img class='user_img' src=$path alt>";
          }
          return $html;
        }
    }
    /* funzione div utente */
}
