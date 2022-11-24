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

//Crée les metas balises et les renvoyer pour l'affichage dans l'en-tête du site 
//(optionnel) mais très recommandé si les balises tag n'était pas partagées
$headerMeta = Sharer::createMeta();

//Importe nos scripts
$sharerScripts = Sharer::scripts();

# Créer un button partager pour les canaux de partage sms, facebook etc de façon native
$all = Sharer::all('<i fa fa-share></i> Share');

$all->addAttribute('class','btn btn-primary'); //Ajouter des classes pour customiser le button via css ou js

// Crée le button de partage pour whatsapp
$whatsapp = Sharer::whatsapp('Whatsapp');
$whatsapp->addAttribute('class','btn whatsapp-btn');


$facebook = Sharer::facebook();
$facebook->addContent('Partager sur facebook');
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
