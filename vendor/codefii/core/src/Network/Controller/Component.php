<?php
namespace Codefii\Controller;
class Component extends \Codefii\Controller\BaseController {
     public function __get( $key )
    {
        return $this->values[ $key ];
    }

    public function __set( $key, $value )
    {
        
        $this->values[ $key ] = $value;
    }
}