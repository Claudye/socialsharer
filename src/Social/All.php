<?php
namespace Claudye\Socialsharer\Social;

use Claudye\Socialsharer\AbstractSocialsharer;

class All extends AbstractSocialsharer{
    protected $content = "Share";
    public function share()
    {
        $this->addAttribute('href', $this->url);
        $this->setData();

        $this->addAttribute('data-clsharer-url', $this->data['url']);
        $this->addAttribute('data-clsharer-text', $this->data['text']);
        $this->addAttribute('data-clsharer-title', $this->data['title']);
        $this->addAttribute('data-clsharer-type', 'all');

        $attributes_text = implode(' ', $this->attributes);

        return sprintf("<button %s> %s</button>", $attributes_text, $this->content);
    }
}
