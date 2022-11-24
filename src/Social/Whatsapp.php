<?php

namespace Claudye\Socialsharer\Social;

use Claudye\Socialsharer\AbstractSocialsharer;

class Whatsapp extends AbstractSocialsharer
{
    /**
     * Set content bu default
     *
     * @var string
     */
    protected $content = "Whatsapp";

    /**
     * Share on whatsapp
     *
     * @return string
     */
    public function share()
    {
        $this->setData();
        $message = sprintf("%s \n %s \n %s", $this->data['title'], $this->data['text'], $this->data['url']);
        $this->addAttribute('href', sprintf('whatsapp://send?text=%s', $message))
            ->addAttribute('target', '_blank');
        $attributes_text = implode(' ', $this->attributes);

        return sprintf("<a %s> %s</a>", $attributes_text, $this->content);
    }
}
