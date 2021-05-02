<?php

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
    private $Content;

    /**
     * Contiene tutti i parametri da sostituire
     *
     * @var array
     */
    private $Params;


    /**
     * TemplateHandler constructor.
     */
    public function __construct() {

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
//        $this->setParam( '<main-content/>', $this->Content );
        $this->setParam( '<main-footer/>', $this->getFooterHtml() );

        $html = $this->replaceParams( $this->getCommonHtml() );
        echo $html;
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

        $this->Params[ $tag ] = $var;

        return $this;
    }

}