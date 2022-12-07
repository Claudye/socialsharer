
  

### Introduction

PHP package to share links on social networks in a simple and fast way.

### Installation
- First you need to have [composer](https://getcomposer.org/download/) installed
- Go to the root of your project
- Open your terminal and type `composer require claudye/socialsharer:dev-master` to install the sharer
If no error appears, it means you have successfully installed the **Socialsharer**

### Use

Include composer class autoload file where you want to use socialsharer or anywhere composer can load our classes.


Ex: (To be adapted according to your case)
    require __DIR__.'/vendor/autoload.php';

#### Create meta tag
Start using Socialsharer 

    use Claudye\Socialsharer\Sharer;
    $metabuilder = Sharer::url($url); // $url the url you want share


This url method return an instance of `\Claudye\Socialsharer\MetaBuilder;` you can append others methods as :

    $metabuilder->title($title); //$title the title you want share
    $metabuilder->description($description) // $description that you want share
    $metabuilder->meta($porperty, $content)


The `\Claudye\Socialsharer\MetaBuilder` class let you to build your meta tag dynamically with the `meta($porperty, $content)` method

The first argument `$porperty` is the name of the meta, the second argument `$content` is the meta tag content

Ex:

    $metabuilder = new MetaBuilder();
    $metabuilder->meta('og:image','image.png') // let you to create a html tag like this :  
    <meta name="og:image" content="image.png">

 
You can create many tag by calling this meta as you want

#### Create social sharer link

Once you have created the meta tags, you can freely create your social media sharing links (SMS, Facebook, Whatsapp, etc.)

The most important button is the global share button. With it, your users can easily share your links on all natively supported platforms

##### Create the global button

    $all = Sharer::all();

With this you instantiate a button creation

Tripycally this method returns an instance of `Claudye\Socialsharer\All` which allows you to build your button as you wish. You can modify its content or add an hhtml attribute to customize its appearance as you wish:

    $all->addContent('Share on social media');
    $add->addAttribute('class','btn my-btn-class');
    $add->addAttribute('id','my-btn-id');

That's all, now you can display your share button by these ways:

    echo $all->display();
    echo $all ;

You can create the button and at the same time add the html attributes like this

`Sharer::all('content', ['class'=>'your-class', 'id'=>'btn-id'])` without calling the `addContent()` and `addAttribute()` methods

#### Supported networks

For the moment although the all method can allow you to share via SMS, copy and paste, Facebook, Share on Twitter etc, Linkedin, ... we also have other specific methods such: `facebook()`, `whatsapp()` which can allow you to share on these networks easily. These methods accept the same arguments as the method. `Sharer::all()`

`Sharer::facebook('icon Facebook')`, allows you to generate the share link on facebook

`Sharer::whatsapp('icon, Whatsapp)`, allows you to share on whatsapp with several people
  

#### Enabling Sharing

After creating the links, two more steps are required or one is essential.

For link sharing to be functional, we must import our script and place it before the end of the body tag of your page to be shared.
  

    $scriptsOfSharer = Sharer::scripts();
    echo $scriptsOfSharer or echo Sharer::scripts();

For social networks and robots to display the title, description and image of your page directly on their networks, you must display the meta tags that you have just created in the header of your page.

    $metaTags = Sharer::createMeta();
    echo $metaTags ou echo Sharer::createMeta();

### Example


    <?php
    
    use Claudye\Socialsharer\Sharer;
    
    require __DIR__.'/vendor/autoload.php';
    
    $title = 'Social Sharer';
    
    $description = 'PHP package for generating social share links';
    
    $image = 'screenshot.png';
    
    $metabuilder = Sharer::url('hello-world.php');
    
    // Create <meta name="og:title" content="The title content">
    
    $metabuilder->title($title);
    
    // Create <meta name="og:description" content="The description content">
    
    $metabuilder->description($description);
    
    // Create <meta name="og:image" content="the-image-scr.extension">
    
    $metabuilder->image($image);
    
    $metabuilder->meta('og:type', "Website"); // Create <meta name="og:type" content="Website">
    
    //Create meta tags and return them for display in the site header
    
    //(optional) but very recommended if the og tags were not already in the header of the site
    
    $headerMeta = Sharer::createMeta();
    
    //Import our scripts
    
    $sharerScripts = Sharer::scripts();
    
    //Create a share button for sms, facebook etc sharing channels natively
    
    $all = Sharer::all('<i fa fa-share></i> Share');
    
    //Add classes to customize the button via css or js
    
    $all->addAttribute('class','btn btn-primary');
    
    echo $all ;
### Note
    Attention, for the share button on all channels to work, you must at least add the description via the
 `Sharer::description($description)`, or via `$all->description($description)` or via the html description tag.
    You can also check your browser console to see if there is an error