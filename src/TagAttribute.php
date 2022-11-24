<?php
namespace Claudye\Socialsharer;

class TagAttribute{
    /**
     * Attribut name
     *
     * @var string
     */
    protected $name = '' ;
    /**
     * Attribut generated
     *
     * @var string
     */
    protected $attribute  = '';
    /**
     * Attribut value
     *
     * @var string
     */
    protected $value  = '';
    /**
     * Generate social html tag
     *
     * @param string $name attribute name
     * @param string|array|string[] $values attribute values
     * @return self
     */
    public function __construct(string $name, $values)
    {
        $this->name = $name ;
        $this->value = $values ;
    }

    private function setAttribute(){
        if (is_array($this->value)) {
            $this->value = implode(' ',$this->value);
        }
        $this->attribute = sprintf('%s="%s"', $this->name, $this->value) ;

    }

    public function __toString()
    {
        $this->setAttribute();
        return $this->attribute;
    }
}
