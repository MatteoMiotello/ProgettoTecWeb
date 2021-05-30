<?php


class ExceptionHandler {
    /**
     * @var Throwable
     */
    private $Exception;

    /**
     * ExceptionHandler constructor.
     * @param Throwable $Exception
     */
    public function __construct(Throwable $Exception) {
        $this->Exception = $Exception;
    }


}