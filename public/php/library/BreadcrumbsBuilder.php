<?php

require_once __DIR__ . '/AbstractBuilder.php';

class BreadcrumbsBuilder extends AbstractBuilder {
    private $current;


    /**
     * BreadcrumbsBuilder constructor.
     * @param $current
     */
    public function __construct($current) {
        $this->current = $current;
        $this->Params['<links/>'] = '';
    }


    /**
     * @param $link
     * @param $title
     * @return $this
     */
    public function addLink($link, $title) {
        $this->Params['<links/>'] .= "<a lang=\"en\" href=$link>$title</a> / ";

        return $this;
    }


    public function build($html) {
        $this->Params['<links/>'] .= $this->current;

        return parent::build($html);
    }
}
