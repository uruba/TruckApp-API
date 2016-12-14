<?php

namespace App\Interfaces;

abstract class FetcherAbstract {
    protected $url;
    
    public function __construct($url) {
        $this->url = $url;
    }
    
    public abstract function fetch();
}
