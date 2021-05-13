<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/library/Access.php';
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
     * TemplateHandler constructor.
     */
    public function __construct() {
        $this->Access = Access::create();
    }

    /**
     * Ritorna l'html dell'header
     *
     * @return false|string
     * @throws Exception
     */
    private function getHeaderHtml() {
        $footerPath =  $_SERVER['DOCUMENT_ROOT'] . '/php/components/header.html';

        if ( !file_exists( $footerPath ) ) {
            throw new Exception( 'header not found' );
        }

        return file_get_contents( $footerPath );
    }


    /**
     * Ritorna l'html del footer
     *
     * @return false|string
     * @throws Exception
     */
    private function getFooterHtml() {
        $footerPath =  $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.html';

        if ( !file_exists( $footerPath ) ) {
            throw new Exception( 'footer not found' );
        }

        return file_get_contents( $footerPath );
    }

    /**
     * Ritorna l'html della pagina
     *
     * @return false|string
     * @throws Exception
     */
    private function getCommonHtml() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/common.html';

        if ( !file_exists( $filePath ) ) {
            throw new Exception( 'file non esistente' );
        }

        return file_get_contents($filePath );
    }


    /**
     * Effettua il replace di tutti i parametri di un html
     *
     * @param $html
     * @return string|string[]
     */
    private function replaceParams( $html ) {
        foreach ( $this->Params as $key => $param) {
          
            if ( !strpos( $html, $key ) ) {
                throw new Exception( "Parameter $key not found" );
            }

            $html = str_replace( $key, $param, $html );
        }

        return $html;
    }


    /**
     * @param $title
     * @return $this
     */
    public function setPageTitle( $title ): self {
        $this->PageTitle = "<title>$title</title>";

        return $this;
    }

    /**
     * @throws Exception
     */
    public function render() {
        $this->setParam( '<common-title/>', $this->PageTitle );
        $this->setParam( '<main-header/>', $this->getHeaderHtml() );
        $this->setParam( '<main-content/>', $this->Content );
        $this->setParam( '<main-footer/>', $this->getFooterHtml() );
        $this->setParam( '<main-js/>', $this->JsFooter );
        $html = $this->getCommonHtml();
        $html = $this->replaceParams( $html );
        echo $html;
    }

    /**
     * Setta il contenuto della pagina
     *
     * @param string $html
     */
    public function setContent( string $html ) {
        $this->Content = $html;
    }


    /**
     * Setta uno script js alla fine del file
     *
     * @param string $js puó essere codice oppure un path di un file
     * @param bool $isFile se é un path di un file deve essere true
     * @return self
     */
    public function setJsFooter( string $js, bool $isFile = false ): self {
        if ( !$isFile ) {
            $this->JsFooter = "<script> $js </script>";
            return $this;
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . $js;

        if ( !file_exists( $filePath ) ) {
            throw new Exception( 'file non esistente' );
        }

        $this->JsFooter = "<script src='$filePath'></script>";
        return $this;
    }


    /**
     * Inserisce un parametro da sostituire
     *
     * @param string $tag
     * @param string $var
     * @return $this
     */
    public function setParam( string $tag, string $var ) {
        if ( !isset( $this->Params ) ) {
            $this->Params = [];
        }

        $this->Params = [$tag => $var]+$this->Params;
        return $this;
    }
}