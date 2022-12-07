<?php
use Claudye\Socialsharer\Sharer;
require __DIR__.'/vendor/autoload.php';

$title = 'Social Sharer';

$description = 'PHP package for generating social share links';

$image = 'screenshot.png';
$metabuilder = Sharer::url('hello-world.php');
/**
 * Instanciate meta tags
 */
$metabuilder->title($title); // Create <meta name="og:title" content="The title content">
$metabuilder->description($description); // Create <meta name="og:description" content="The description content">
$metabuilder->image($image); // // Create <meta name="og:image" content="the-image-scr.extension">

$metabuilder->meta('og:type', "Website"); // Create <meta name="og:type" content="Website">

//Create meta tags and return them for display in the site header
//(optional) but highly recommended if tag tags were not shared
$headerMeta = Sharer::createMeta();

//Importe nos scripts
$sharerScripts = Sharer::scripts();

# Create a share button for sms, facebook etc sharing channels natively
$all = Sharer::all('<i fa fa-share></i> Share');

$all->addAttribute('class','btn btn-primary'); //Add classes to customize the button via css or js

// Create the share button for whatsapp
$whatsapp = Sharer::whatsapp('Whatsapp');
$whatsapp->addAttribute('class','btn whatsapp-btn');


$facebook = Sharer::facebook();
$facebook->addContent('Share onfacebook');
$facebook->addAttribute('class','btn btn-primary');
?>


<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php echo $headerMeta ?>

    <title>Socia sharer</title>
  </head>
  <body>

    <?php echo $all->share() ?>
    <?php echo $whatsapp->share() ?>
    <?php echo $facebook->share() ?>
    <?php echo $sharerScripts ?>
  </body>
</html>
