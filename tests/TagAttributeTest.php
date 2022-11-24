<?php

use PHPUnit\Framework\TestCase;
use Claudye\Socialsharer\TagAttribute;

class TagAttributeTest extends TestCase{
    public function test_attribute_generate(){
        $attribute = new TagAttribute('class',['my-classname','my-second-class']);

        return $this->assertEquals(
            'class="my-classname my-second-class"',
            (string)$attribute
        );
    }
}
