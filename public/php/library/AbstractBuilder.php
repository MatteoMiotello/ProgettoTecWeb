<?php
abstract class AbstractBuilder {
    /**
     * Contiene tutti i parametri da sostituire
     *
     * @var array
     */
    protected $Params;

    public function build($html) {
        foreach ($this->Params as $key => $param) {

            if (strpos($html, $key))
                $html = str_replace($key, $param, $html);

        }

        return $html;
    }
}
