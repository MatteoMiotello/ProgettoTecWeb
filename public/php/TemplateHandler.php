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
     * TemplateHandler constructor.
     */
    public function __construct() {

    }

    /**
     * @param $title
     * @return $this
     */
    public function setPageTitle( $title ): self {
        $this->PageTitle = $title;

        return $this;
    }

    /**
     * Renderizza la pagina
     */
    public function render() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/common.html';

        if ( !file_exists( $filePath ) ) {
            throw new Exception( 'file non esistente' );
        }

        $html = file_get_contents($filePath );
        $html = str_replace( '<title-content/>', "<h1>$this->PageTitle</h1>", $html );

        echo $html;
    }
}