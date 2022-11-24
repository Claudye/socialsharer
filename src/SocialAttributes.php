<?php
namespace Claudye\Socialsharer;
class SocialAttributes{
    /**
     *
     *
     * @var string[]
     */
    protected $attributes = [] ;

    protected $string_attrs = '' ;

    public function push(SocialAttribute $socialAttribute){
        $this->attributes [] = (string) $socialAttribute ;
    }

    public function __toString()
    {
        return implode(' ',$this->attributes);
    }
}
