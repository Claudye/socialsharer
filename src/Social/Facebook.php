<?php

namespace Claudye\Socialsharer\Social;

use Claudye\Socialsharer\AbstractSocialsharer;

class Facebook extends AbstractSocialsharer
{
    /**
     * Set content bu default
     *
     * @var string
     */
    protected $content = "Facebook";

    /**
     * Share on facebook
     *
     * @return string
     */
    public function share()
    {
        $href= sprintf('https://www.facebook.com/sharer/sharer.php?u=%s&amp;src=sdkpreparse',$this->url);
        $this->addAttribute('href', $href);
        $this->addAttribute('data-clsharer', 'facebook');
        $this->addAttribute('target', 'facebook');

        $attributes_text = implode(' ', $this->attributes);

        $a = sprintf("<a %s> %s</a>", $attributes_text, $this->content);

        return sprintf('<span class="fb-share-button" data-href="%s" data-layout="button" data-size="large">  %s</span>', $this->url, $a);
    }
}
