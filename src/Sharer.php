<?php

namespace Claudye\Socialsharer;

use Exception;
use Claudye\Socialsharer\Social\All;
use Claudye\Socialsharer\Social\Twitter;
use Claudye\Socialsharer\Social\Facebook;
use Claudye\Socialsharer\Social\Whatsapp;

/**
 * @method static Whatsapp whatsapp(string $content, $attributes)
 * @method static Facebook facebook(string $content, $attributes)
 * @method static Twitter twitter(string $content, $attribWutes)
 * @method static All all(string $content, $attributes)
 */
class Sharer
{
    public static $url = '';

    /**
     * The meta tags
     *
     * @var \Claudye\Socialsharer\MetaBuilder
     */
    protected static $metabuilder ;
    /**
     * Liste of socialmedia
     *
     * @var array
     */
    protected static $social = [
        'facebook' => Facebook::class,
        'whatsapp' => Whatsapp::class,
        'twitter' => Twitter::class,
        'all' => All::class
    ];
    /**
     * Liste of social sharer
     *
     * @var \Claudye\Socialsharer\AbstractSocialsharer[]
     */
    protected static $sharers = [];

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$social)) {
            throw new Exception(
                sprintf("The social network %s is not configured or not supported", $name),
                1
            );
        }

        return self::$sharers[$name] = (new self::$social[$name](...$arguments))
            ->url(self::$url);
    }

    private static function hasSocial(string $name)
    {
        return array_key_exists($name, self::$sharers);
    }

    /**
     *
     * @param string $social Name of the social network
     * @return \Claudye\Socialsharer\AbstractSocialsharer|null
     */
    public static function share(string $name)
    {
        if (self::hasSocial($name)) {
            return self::$sharers[$name] ;
        }
        throw new Exception(
            sprintf("The social network %s is not configured or not supported", $name),
            1
        );
    }

    /**
     * Set meta tags
     *
     * @param string $porperty
     * @param string $content
     * @return MetaBuilder
     */
    public static function meta($porperty, $content){
        if (!(self::$metabuilder instanceof MetaBuilder)) {
            self::$metabuilder = new MetaBuilder();
        }

        return self::$metabuilder->meta($porperty, $content);
    }

    public static function url(string $url){
        self::$url = $url ;
        return self::meta('og:url',self::$url);
    }

    /**
     * Create meta and retunr it
     *
     * @return string
     */
    public static function createMeta(){
        if (self::$metabuilder) {
            return self::$metabuilder->generate();
        }
        return null;
    }
    /**
     * Return the meta builder instance
     *
     * @return \Claudye\Socialsharer\MetaBuilder|null
     */
    public static function getMetaBuilder(){
        return static::$metabuilder ;
    }

    public static function scripts(){
       if (is_file($file =__DIR__.'/../scripts/footer.html')) {
            return file_get_contents($file);
       }
       throw new Exception("The file $file does not exists", 1);

    }
}
