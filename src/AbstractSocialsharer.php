<?php

namespace Claudye\Socialsharer;

use Claudye\Socialsharer\TagAttribute;
/**
 * Base social sharer class
 *
 * @author Fassinou Claude <dev.claudy@gmail.com>
 *
 * @license MIT
 *
 * @copyright 2022 Socialsharer
 */
abstract class AbstractSocialsharer
{
    /**
     * The url for sharing
     *
     * @var string
     */
    protected $url = '#' ;

    /**
     * Base data for sharing
     *
     * @var array
     */
    protected $data = ['title'=>'','text'=>'', 'url'=>'#'] ;
    /**
     * Html tag
     *
     * @var string
     */
    protected $tag;

    /**
     * Add attributes lists
     *
     * @var \Claudye\Socialsharer\TagAttribute[]
     */
    protected $attributes = [];

    /**
     * The content, icon, or text
     *
     * @var string
     */
    protected $content = "";

    /**
     * Add somme attributes to facebook tag link
     *
     * @param string $name
     * @param string|array $value
     * @return $this
     */
    public function addAttribute(string $name, $value)
    {
        $this->attributes[] = (string) (new TagAttribute($name, $value));
        return $this;
    }

    /**
     * Button for share
     *
     * @return string
     */
    abstract public function share();

    /**
     * Add social content
     *
     * @param string $content
     * @return $this
     */
    public function addContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set html tag attributes
     *
     * @param array|TagAttribute $attributes
     */
    protected function setAttributes($attributes)
    {
        if ($attributes instanceof TagAttribute) {
            $this->attributes[] = (string) $attributes;
        }

        if (is_array($attributes) && count($attributes) > 1) {
            foreach ($attributes as $name => $value) {
                $this->addAttribute($name, $value);
            }
        }
    }

    /**
     * Initiate a facebook Sharer
     *
     * @param string|null $content
     * @param array|TagAttribute $attributes attriubutes ['class'=>'my-class'] or TagAttribute instance
     */
    public function __construct($content = null, $attributes = null)
    {
        $this->content = $content ?? $this->content;
        if ($attributes) {
            $this->setAttributes($attributes);
        }
    }
    /**
     * Display the social content
     *
     * @return string
     */
    public function display(){
        return $this->share();
    }

    /**
     * Set the url that will be shared
     *
     * @param string $url
     * @return $this
     */
    public function url(string $url)
    {
        $this->url = $url ;
        $this->data['url'] = $url ;
        return $this;
    }

    /**
     * Get a meta
     *
     * @param string $porperty
     * @return \Claudye\Socialsharer\Meta|false
     */
    public function getMeta(string $porperty){
        $metabuilder = Sharer::getMetaBuilder() ;

        if ($metabuilder) {
            return $metabuilder->getMeta($porperty);
        }

        return false ;
    }

    protected function setData(){
        $title_meta = $this->getMeta('og:title');
        if ($title_meta) {
            $this->data['title'] = $title_meta->get('og:title');
        }

        $description_meta = $this->getMeta('og:description');
        if ($title_meta) {
            $this->data['text'] = $description_meta->get('og:description');
        }

        $url_meta = $this->getMeta('og:url');
        if ($url_meta) {
            $this->data['url'] = $url_meta->get('og:url');
        }
    }
    /**
     * Convert $thi to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->display();
    }
    /**
     * Set the title specifically for this social sharer
     *
     * @param string $title
     * @return $this
     */
    public function title(string $title){
        $this->data['title'] = $title ;
        return $this ;
    }
     /**
     * Set the description specifically for this social sharer
     *
     * @param string $description
     * @return $this
     */
    public function description($description=null){
        if ($description) {
            $this->data['text'] = $description ;
        }
        return $this;
    }
}
