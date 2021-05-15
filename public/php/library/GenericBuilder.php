<?php


abstract class GenericBuilder {
    protected $Params = [];


    public final function buildCompoent() {

    }

    abstract function getTemplatePath() : string;

    abstract function setParams() : array;
}