<?php
namespace Claudye\Socialsharer;
/**
 * Generate social meta tags
 */
class MetaBuilder{
    /**
     * Meta tag list
     *
     * @var array
     */
    protected $metas = [];

    /**
     * Add new meta
     *
     * @param string $porperty
     * @param string|int $content
     * @return $this
     */
    public function meta(string $porperty, $content){
       $this->metas [] = new Meta($porperty, $content);
       return $this ;
    }

    public function title(string $title){
        return $this->meta('og:title', $title);
    }

    public function description(string $description){
        return $this->meta('og:description', $description);
    }

    public function image(string $image_src){
        return $this->meta('og:image', $image_src);
    }
    /**
     * Generate meta tag as string
     *
     * @return string
     */
    public function generate(){
        return implode('',$this->metas);
    }
    /**
     * Return a meta
     *
     * @param string $name
     * @return Meta|false
     */
    public function getMeta(string $name){
        $resultsOfMetas = array_filter($this->metas, function(Meta $meta) use($name) {
            return $meta->named($name) ;
        });
        return end($resultsOfMetas);
    }
}
