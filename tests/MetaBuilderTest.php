<?php

use Claudye\Socialsharer\Meta;
use PHPUnit\Framework\TestCase;
use Claudye\Socialsharer\MetaBuilder;

class MetaBuilderTest extends TestCase{

    public function test_meta_generate()
    {
        $meta = new Meta('og:title','Hello world');
        return $this->assertEquals(
            '<meta property="og:title" content="Hello world"/>',
            $meta->toString()
        );
    }
    public function test_multiple_tags(){

        $metabuilde = new MetaBuilder();
        $metabuilde->meta('og:title','Hello world');
        $metabuilde->meta('og:image','image-source');
        $meta_tag = $metabuilde->generate();

        return $this->assertEquals(
            '<meta property="og:title" content="Hello world"/><meta property="og:image" content="image-source"/>',
            $meta_tag
        );
    }

    public function test_meta_getting(){
        $metabuilde = new MetaBuilder();
        $metabuilde->meta('og:title','Hello world');
        $metabuilde->meta('og:image','image-source');
        $meta = $metabuilde->getMeta('og:title');
        return $this->assertInstanceOf(
            Meta::class,
            $meta
        );
    }
}
