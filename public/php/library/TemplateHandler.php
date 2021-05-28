<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/HeaderHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/BreadcrumbsBuilder.php';

/**
 * Class TemplateHandler controlla la composizione della pagina
 */
class TemplateHandler {
    /**
     * @var string
     */
    private $PageTitle;

    /**
     * @var string
     */
    private $Content = '';

    /**
     * Aggiunge uno script Javascript
     *
     * @var string
     */
    private $JsFooter = '';

    /**
     * Contiene tutti i parametri da sostituire
     *
     * @var array
     */
    private $Params;

    /**
     * @var Access
     */
    private $Access;

    /**
     * @var string
     */
    private $CurrentRoute;


    private $Breadcrumb;


    /**
     * TemplateHandler constructor.
     */
    public function __construct() {
        $this->Access = Access::create();
        $this->onInitialize();
    }


    /**
     * Funzione che si esegue in costruzione
     *
     * @throws Exception
     */
    protected function onInitialize() {
        $this->setParam('<main-header/>', $this->getHeaderHtml());
        $this->setParam('<main-footer/>', $this->getFooterHtml());
    }


    /**
     * Ritorna l'html dell'header
     *
     * @return false|string
     * @throws Exception
     */
    private function getHeaderHtml() {
        $footerPath = $_SERVER['DOCUMENT_ROOT'] . '/php/components/header.html';

        if (!file_exists($footerPath)) {
            throw new Exception('header not found');
        }

        return file_get_contents($footerPath);
    }

    /**
    *Sceglie il contenitore utente da mostrare
    *
    *@throws Exception
    */
    private function getUserCont() {
        if(Access::isAuthenticated()){
          $uCont = $_SERVER['DOCUMENT_ROOT'] . '/php/components/userContainer.phtml';
        }
        else{
          $uCont = $_SERVER['DOCUMENT_ROOT'] . '/php/components/visitorContainer.phtml';
        }
        return file_get_contents($uCont);
    }


    /**
     * @throws Exception
     */
    public function setHeaderParams() {
        $links = HeaderHandler::getHeaderLinks($this->CurrentRoute);
        $user = HeaderHandler::getUserInfo($this->CurrentRoute);

        $this->setParam('<nav-link/>', $links);
        $this->setParam( '<userCont/>', $user );

    }


    /**
     * Ritorna l'html del footer
     *
     * @return false|string
     * @throws Exception
     */
    private function getFooterHtml() {
        $footerPath = $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.html';

        if (!file_exists($footerPath)) {
            throw new Exception('footer not found');
        }

        return file_get_contents($footerPath);
    }


    /**
     * Ritorna l'html della pagina
     *
     * @return false|string
     * @throws Exception
     */
    private function getCommonHtml() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/common.html';

        if (!file_exists($filePath)) {
            throw new Exception('file non esistente');
        }

        return file_get_contents($filePath);
    }


    /**
     * Effettua il replace di tutti i parametri di un html
     *
     * @param $html
     * @return string|string[]
     */
    private function replaceParams($html) {
        foreach ($this->Params as $key => $param) {

            if (strpos($html, $key))
                $html = str_replace($key, $param, $html);
        }

        return $html;
    }


    /**
     * @param $title
     * @return $this
     */
    public function setPageTitle($title): self {
        $this->PageTitle = "<title>$title</title>";
        $this->setParam('<common-title/>', $this->PageTitle);

        return $this;
    }


    /**
     * @param $breadcrumb
     * @return $this
     */
    public function setBreadcrumb($breadcrumb) {
        $this->Breadcrumb = new BreadcrumbsBuilder($breadcrumb);

        return $this;
    }


    /**
     * @param $route
     * @param $title
     */
    public function addLink($route, $title) {
        if (!isset($this->Breadcrumb)) {
            throw new Exception('breadcrumb is not initialized');
        }

        $this->Breadcrumb->addLink($route, $title);

        return $this;
    }


    /**
     * Renderizza la pagina
     *
     * @throws Exception
     */
    public function render() {
        $html = $this->getCommonHtml();
        $this->setHeaderParams();


        if ( !isset($this->Breadcrumb) ) {
            $this->setParam('<main-breadcrumb/>', '');
        } else {
            $breadcrumbs = $this->Breadcrumb->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/php/components/breadcrumbs.phtml"));
            $this->setParam('<main-breadcrumb/>', $breadcrumbs);
        }

        $html = $this->replaceParams($html);
        echo $html;
    }


    /**
     * Setta il contenuto della pagina
     *
     * @param string $html
     */
    public function setContent(string $html) {
        $this->Content = $html;
        $this->setParam('<main-content/>', $this->Content);

        return $this;
    }


    /**
     * Setta uno script js alla fine del file
     *
     * @param string $js puó essere codice oppure un path di un file
     * @param bool $isFile se é un path di un file deve essere true
     * @return self
     */
    public function setJsFooter(string $js, bool $isFile = false): self {
        if (!$isFile) {
            $this->JsFooter = "<script> $js </script>";
            return $this;
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . $js;

        if (!file_exists($filePath)) {
            throw new Exception('file non esistente');
        }

        $this->JsFooter = "<script src='$filePath'></script>";
        $this->setParam('<main-js/>', $this->JsFooter);

        return $this;
    }


    /**
     * Inserisce un parametro da sostituire
     *
     * @param string $tag
     * @param string $var
     * @return $this
     */
    public function setParam(string $tag, string $var) {
        if (!isset($this->Params)) {
            $this->Params = [];
        }

        $this->Params[$tag] = $var;
        return $this;
    }


    /**
     * Imposta la pagina attuale
     *
     * @param $currentRoute
     * @return $this
     */
    public function setCurrentRoute($currentRoute) {
        $this->CurrentRoute = $currentRoute;
        return $this;
    }

    /**
     * Imposta un messaggio di errore
     * @param $string
    */
    public function setOperationError($string) {
        $component = str_replace('{{messge}}', $string, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/operationError.phtml'));
        $this->setParam('<operationResult />', $component );
    }

    /**
     * Imposta un messaggio di errore
     * @param $string
    */
    public function setOperationDone($string) {
        $component = str_replace('{{messge}}', $string, file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/operationDone.phtml'));
        $this->setParam('<operationResult />', $component );
    }

    /**
     * Toglie il tag <operationResul />
     */
    public function setNoOperation() {
        $this->setParam('<operationResult />', "" );
    }
}
