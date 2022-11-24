<?php

namespace Claudye\Socialsharer;

class Meta
{
    /**
     * Meta porperty
     *
     * @var string
     */
    protected $porperty;

    /**
     * Meta content
     *
     * @var string|int
     */
    protected $content;

    /**
     * Generate meta tag
     *
     * @param string $porperty
     * @param  string|int $content
     */
    public function __construct(string $porperty, $content)
    {
        $this->porperty = $porperty;

        $this->content = $content;
    }
    /**
     * Convert Meta onject to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
    /**
     * Get Meta onject as string
     *
     * @return void
     */
    public function toString()
    {
        return sprintf('<meta property="%s" content="%s"/>', $this->porperty, $this->content);
    }
    /**
     * Check if the meta is named $name
     *
     * @param string $name
     * @return bool
     */
    public function named(string $name){
        return $this->porperty == $name ;
    }
    /**
     * Return a meta content
     *
     * @param string $name
     * @return string|int|null
     */
    public function get(string $name){
        return $this->named($name) ? $this->content : null;
    }
}
