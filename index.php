<?php
require 'admin/database_tarawih.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';

$nomclientErreur = $prenomclientErreur = $emailclientErreur =  $indicatifParticulier1Erreur = $telephoneclientErreur = $adresse1clientErreur = $villeclientErreur = $codepostalclientErreur = $paysclientErreur = $quantiteparticulierclientErreur = 
$nomClient = $prenomClient = $emailClient = $indicatifParticulier1 = $telephoneClient  = $adresse1Client = $adresse2Client = $villeClient = $codepostalClient = $paysClient = $quantiteparticulierClient = $quantiteproClient = $recaptchaResponse = ""; 
if (!empty($_POST)) 
{   
    $nomClient                = checkInput($_POST['nom']);
    $prenomClient             = checkInput($_POST['prenom']);
    $emailClient              = checkInput($_POST['emailclient']);
    $indicatifParticulier1    = checkInput($_POST['indicatif1']);
    $telephoneClient          = checkInput($_POST['telephone']);
    $adresse1Client           = checkInput($_POST['adresse1']);
    $adresse2Client           = checkInput($_POST['adresse2']);
    $villeClient              = checkInput($_POST['ville']);
    $codepostalClient         = checkInput($_POST['codepostal']);
    $paysClient               = checkInput($_POST['pays']);
    $quantiteparticulierClient= checkInput($_POST['quantiteparticulier']);
    $quantiteproClient        = checkInput($_POST['quantitepro']);
    $recaptchaResponse        = $_POST['recaptcha-response'];
    $estValide                = true;
    $mailCommande = new PHPMailer(true);

    if(empty($nomClient))
    {
        $nomclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($prenomClient))
    {
        $prenomclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($emailClient))
    {
        $emailclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($indicatifParticulier1))
    {
        $indicatifParticulier1Erreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($telephoneClient))
    {
        $telephoneclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($adresse1Client))
    {
        $adresse1clientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($villeClient))
    {
        $villeclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($codepostalClient))
    {
        $codepostalclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($paysClient))
    {
        $paysclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($quantiteparticulierClient))
    {
        $quantiteparticulierclientErreur = 'Ce champs ne peut être vide';
        $estValide        = false;
    }
    if(empty($recaptchaResponse)){
        header('Location: index.php');
        $estValide        = false;
    } 
    if($estValide && !empty($recaptchaResponse)){
        $db = Database::connect();
        $statement = $db->prepare('INSERT INTO clients_adresses (nom, prenom, email, indicatif, telephone, adresse1, adresse2, ville, codepostal, pays, quantiteparticulier, quantitepro) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->execute(array($nomClient,$prenomClient,$emailClient,$indicatifParticulier1,$telephoneClient,$adresse1Client,$adresse2Client,$villeClient,$codepostalClient,$paysClient,$quantiteparticulierClient, $quantiteproClient));
        try {
            //configuration
            $mailCommande->isSMTP();
            //Configuration du SMTP
            $mailCommande->Host         = '';
            $mailCommande->SMTPAuth     = true;
            $mailCommande->Username     = '';
            $mailCommande->Password     = '';
            $mailCommande->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
            $mailCommande->Port         = ;
            //Charset
            $mailCommande->CharSet = 'utf-8';
            // Expéditeur
            $mailCommande->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
            // Destinataires
            $mailCommande->addAddress($emailClient);     //Add a recipient
            $mailCommande->addBCC('metmati12@hotmail.fr');
            $mailCommande->addCC('contact@laprieredetarawih.com');
            //Contenu
            $mailCommande->isHTML(true);                                  //Set email format to HTML
            $mailCommande->Subject = "$prenomClient Confirmation Commande Tarawih";
            $mailCommande->Body    = "Salam aleykoum <b>$prenomClient</b>!
            Il ne te reste plus qu'à confirmer tes coordonnées <a href='https://tarawih.com/livres-tarawih/details-livre/confirmation-commande-livre'>ici</a>, si ce n'est pas déjà fait !
            Après confirmation, nous traiterons ta demande et t'enverrons un mail pour l'envoi du livre.
            Voici tes informations : <br>
            <ul>
                <li>Nom : $nomClient </li>
                <li>Prénom : $prenomClient </li>
                <li>Mail : $emailClient </li>
                <li>Téléphone : +$indicatifParticulier1 $telephoneClient </li>
                <li>Adresse Complete : $adresse1Client </li>
                <li>$adresse2Client</li>
                <li>Code Postal : $codepostalClient </li>
                <li>Ville : $villeClient </li>
                <li>Pays : $paysClient </li>
            </ul>
            <br>
            En attendant, tu peux lire le livre Tarawih en PDF sur https://tarawih.com<br>
            ";
            $mailCommande->send();
        } catch (Exception $th) {
            echo "Message non envoyé";
        }
        Database::disconnect();
        header("Location: livres-tarawih/details-livre/confirmation-commande-livre");
    }
}

    $mailinfocourrielErreur = $mailInfoCourriel = ""; 

    if (!empty($_POST)) 
    {   
        $mailInfoCourriel         = checkInput($_POST['emailinfo']);
        $estInfoValide            = true;
    
        if(empty($mailInfoCourriel))
        {
            $mailinfocourrielErreur = 'Pour vous inscrire, vous devez rentrer un mail valide';
            $estInfoValide        = false;
        }
        if (!filter_var($mailInfoCourriel, FILTER_VALIDATE_EMAIL)) 
        {
            $mailinfocourrielErreur = "Format de mail invalide. Veuillez rentrer un mail valide";
            $estInfoValide        = false;
        }
        if($estInfoValide)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO infocourriel_mm (email) VALUES (?)');
            $statement->execute(array($mailInfoCourriel));
            Database::disconnect();
            header("Location: confirmation-inscription-newsletter.php");
        }
        
    }
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<!-- Clarity tracking code for https://tarawih.com/ --><script>    (function(c,l,a,r,i,t,y){        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);    })(window, document, "clarity", "script", "kimk427qab");</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TGFBG9D');</script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-19EJM6DTWE"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-19EJM6DTWE');
    </script>

        <!-- Google tag (gtag.js) -->

    <script>
    window.fbAsyncInit = function() {
        FB.init({
        appId      : '498997645456787',
        cookie     : true,
        xfbml      : true,
        version    : 'v15.0'
        });
        
        FB.AppEvents.logPageView();   
        
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '578060586465357');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=578060586465357&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1276286509617166');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1276286509617166&ev=PageView&noscript=1"/></noscript>
<!-- End Meta Pixel Code -->
    <!-- TIKTOK Pixel Code -->
    <script>
    !function (w, d, t) {
    w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};

    ttq.load('CGJADGJC77UECB7PHGPG');
    ttq.page();
    }(window, document, 'ttq');
    </script>
    <!-- END TIKTOK Pixel Code -->
    <!-- Twitter conversion tracking base code -->
    <script>
    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
    a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
    twq('config','okb95');
    </script>
    <!-- End Twitter conversion tracking base code -->
    <!-- Meta Head -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <title>Tarawih : Guide Complet du musulman</title>
    <meta name="description" content="Le site de référence sur le Tarawih, pour comprendre l'essentiel du Tarawih via notre livre GRATUIT la prière de Tarawih, nos articles et nos questions - réponses." />
    <meta name="facebook-domain-verification" content="st8u236704bffrw1xreqtkwvy98hm7" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="Tarawih : Guide Complet du musulman">
    <meta property="og:title" content="Tarawih : Guide Complet du musulman" />
    <meta name="twitter:description" content="Le site de référence sur la prière de Tarawih, pour comprendre l'essentiel du Tarawih via notre livre GRATUIT la prière de Tarawih, nos articles et nos questions - réponses.">
    <meta property="og:description" content="Le site de référence sur la prière de Tarawih, pour comprendre l'essentiel du Tarawih via notre livre GRATUIT la prière de Tarawih, nos articles et nos questions - réponses."/>
    <meta name="twitter:image" content="https://tarawih.com/Tarawih-5-tn.png">
    <meta property="og:image" content="https://tarawih.com/Tarawih-5-tn.png" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.tarawih.com" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <meta name="fragment" content="!">
    <link rel="image_src" href="https://tarawih.com/Tarawih-5-tn.png">
    <link rel="canonical" href="https://tarawih.com/">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

    

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/a9a91de2de471ed1969ec6049/618bc6c8e66fd02d1d18940bf.js");</script>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGFBG9D"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<!------------------------start HEADER------------------------------->
<section id="header">
    <a href="#"><img src="img-tarawih/logo-256.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li class="active"><a href="accueil">Accueil</a></li>
            <li><a href="livres-priere-tarawih">Livres</a><i></i></li>
            <li><a href="articles-priere-tarawih">Articles</a><i></i></li>
            <li><a href="faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li id="contactref"><a href="#contact">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>


<!------------------------END HEADER------------------------------->
<!------------------------start HEADER------------------------------->

    <section id="objetlivre" >
        <div class="pro-container1">
            <a href="#objetlivre"><img src="https://tarawih.com/Tarawih-5-tn.png" alt=""></a>
        </div>
        <div class="pro-container2">
            <h1><strong>TARAWIH</strong><br>Le Guide Complet</h1>
            <h4>de Maamar Metmati</h4>
            <h4>Téléchargez-le ou Commandez-le Maintenant</h4>
            <div class="span-pro">
                <p><span>GRATUITEMENT</span></p>
            </div>
            <a href="La-priere-de-Tarawih.pdf" target="_blank" download="La-priere-de-Tarawih.pdf"><button>TÉLÉCHARGER</button></a>
            <button class="opencommande"  onclick="openFormCommande()">COMMANDER</button>
        </div>
    </section>


    <section id="referencelivre" >
        <div class="referencepro">
            <h3 class="htextar">(250 : مختصر اختلاف العلماء ص) قال مالك : وانا افعل ذلك وما قام رسول الله صلى الله عليه وسلم الا في بيته</h3>
            <h3 >L’imam Malik a dit: « J’agis de même, puisque le prophète صلى الله عليه وسلم n’a veillé que chez lui » (Abrégé du livre: Divergence entre savants. Page : 250)</h3>
            <p class="ptextar">! تزعمون انكم على السنة، الا تعلمون ان الرسول الله صلى الله عليه وسلم قام الا في بيته... ليس كذلك</p>
            <p>Vous prétendez suivre la Sunna, ne savez-vous donc pas que le prophète n’a veillé que chez lui… n’est-ce pas ainsi !</p>
        </div>
    </section>
<!------------------------END HEADER------------------------------->
<!------------------------start RESEAUX------------------------------->
<div id="telechargement" class="container-fluid">
    <h2><a href="#telechargement" style="text-decoration: none"><strong>Tarawih</strong> en PDF GRATUIT</a></h2>
</div>
<section id="telechargementPDF" class="section-p1">
        <div class="fe-box" style="cursor:pointer;">
            <a href="La-priere-de-Tarawih.pdf" target="_blank" download="La-priere-de-Tarawih.pdf" style="color: white; text-decoration : none;"><span style="text-transform:uppercase">Tarawih Prière</span> en Français</a>
        </div>
        <div class="fe-box">
            <a href="The-Tarawih-Prayer.pdf" target="_blank" download="The-Tarawih-Prayer.pdf" style="color: white; text-decoration : none;"><span style="text-transform:uppercase">Tarawih Prayer</span> en Anglais</a>
        </div>
        <div class="fe-box">
            <a href="TERAVİH-Türkçe.pdf" target="_blank" download="TERAVİH-Türkçe.pdf" style="color: white; text-decoration : none;"><span style="text-transform:uppercase">Teravih Namazi</span> en Turc</a>
        </div>
    </section>


<!------------------------END RESEAUX------------------------------->
<!------------------------start RESEAUX------------------------------->
    <section id="reseauxsociaux" class="section-p1">
        <div class="fe-box" style="cursor:pointer;">
            <a href="https://www.youtube.com/c/MaamarMetmatiOfficiel12/?sub_confirmation=1" target="_blank" style="color: white; text-decoration : none;"><h6>YOUTUBE</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank" style="color: white; text-decoration : none;"><h6>FACEBOOK</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://www.instagram.com/maamarmetmati12" target="_blank" style="color: white; text-decoration : none;"><h6>INSTAGRAM</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://twitter.com/OfficielMaamar" target="_blank" style="color: white; text-decoration : none;"><h6>X</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://t.me/metmati12" target="_blank" style="color: white; text-decoration : none;"><h6>TELEGRAM</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://www.tiktok.com/@maamarmetmati" target="_blank" style="color: white; text-decoration : none;"><h6>TIKTOK</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://www.tarawih.eu" target="_blank" style="color: white; text-decoration : none;"><h6>TARAWIH.EU</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://www.tarawih.fr" target="_blank" style="color: white; text-decoration : none;"><h6>TARAWIH.FR</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://maamarmetmati.fr" target="_blank" style="color: white; text-decoration : none;"><h6>MM.fr</h6></a>
        </div>
        <div class="fe-box">
            <a href="https://metmatimaamar.com" target="_blank" style="color: white; text-decoration : none;"><h6>MM.com</h6></a>
        </div>
    </section>


<!------------------------END RESEAUX------------------------------->

<!-------- start POPUP FORM TARAWIH COMMANDE -------->
<div class="commandefr-popup" id="popupcommandeForm">
        <div class="form-popupcommande">
        <form class="form-commandeclient" role="form" action="accueil" method="post">
            <div class="form-groupecommandeclient">
                <label for="nom">Nom</label>
                <input class="form-client" id="nom" name="nom" placeholder="Entrer le nom" value="<?php echo $nomClient ; ?>" type="text">
                <span class="aide-enligne"><?php echo $nomclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="prenom">Prenom</label>
                <input class="form-client" id="prenom" name="prenom" placeholder="Entrer le prénom" value="<?php echo $prenomClient ; ?>" type="text">
                <span class="aide-enligne"><?php echo $prenomclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="email">Email</label>
                <input class="form-client" id="email" name="emailclient" placeholder="Entrer l'email" value="<?php echo $emailClient ; ?>" type="email">
                <span class="aide-enligne"><?php echo $emailclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="indicatif1">Indicatif Pays +</span>
                <input class="form-client" type="number" id="indicatif1" name="indicatif1" value="<?php echo $indicatifParticulier1 ;?>" required>
                <label for="telephone">Telephone</label>
                <input class="form-client" id="telephone" name="telephone" placeholder="Entrer le numero de telephone (XXXXXXXXX)" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?php echo $telephoneClient ; ?>" type="tel">
                <span class="aide-enligne"><?php echo $telephoneclientErreur ; ?></span>
                <small>Ne pas mettre le 0 de votre téléphone : L'indicatif téléphonique de votre pays remplacera le 0.</small>
            </div>
            <div class="form-groupecommandeclient">
                <label for="adresse1">Adresse 1</label>
                <input class="form-client" id="adresse1" name="adresse1" placeholder="Entrer l'adresse" value="<?php echo $adresse1Client ; ?>" type="text">
                <span class="aide-enligne"><?php echo $adresse1clientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="adresse2" id="adresse2">Complément d'adresse (facultatif)</label>
                <input class="form-client" name="adresse2" id="adresse2" placeholder="Entrer le complément d'adresse" value="<?php echo $adresse2Client ;?>" type="text"></input>
            </div>
            <div class="form-groupecommandeclient">
                <label for="codepostal" id="codepostal">Code Postal</label>
                <input class="form-client" name="codepostal" id="codepostal" placeholder="Entrer le code postal" value="<?php echo $codepostalClient ;?>" type="number"></input>
                <span class="aide-enligne"><?php echo $codepostalclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="ville" id="ville">Ville</label>
                <input class="form-client" name="ville" id="ville" placeholder="Entrer la ville" value="<?php echo $villeClient ;?>" type="text"></input>
                <span class="aide-enligne"><?php echo $villeclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="pays" id="pays">Pays</label>
                <input class="form-client" name="pays" id="pays" placeholder="Entrer le pays" value="<?php echo $paysClient ;?>" type="text"></input>
                <span class="aide-enligne"><?php echo $paysclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="quantiteparticulier">Quantité Livre (Particulier)</label>
                <select class="form-client" name="quantiteparticulier" id="quantiteparticulier">
                    <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM quantite_livre_particulier') as $rowptClient)
                        {
                            echo '<option id="quantiteparticulier" value="' . $rowptClient['id'] . '">' . $rowptClient['quantite_particulier'] . '</option>';
                        }
                        Database::disconnect();
                    ?>
                </select>
                <span class="aide-enligne"><?php echo $quantiteparticulierclientErreur ; ?></span>
            </div>
            <div class="form-groupecommandeclient">
                <label for="quantitepro" hidden>Quantité Livre (Professionnel)</label>
                <select type="hidden" class="form-client" name="quantitepro" id="quantitepro">
                <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM quantite_professionnelle') as $rowproClient)
                        {
                            echo '<option id="quantitepro" value="' . $rowproClient['id'] . '">' . $rowproClient['quantite_pro1'] . '</option>';
                        }
                        Database::disconnect();
                    ?>
                </select>
                <span class="aide-enligne"></span>
            </div>
            <div>
                <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
            </div>
            <div>
                <button type="submit" class="submit-commandeclient">PROFITER DE L'OFFRE</button>
            </div>
            <div>
                <button type="button" class="supprimer-commandeclient" onclick="closeFormCommande()">Annuler</button>
            </div>
        </form>
        <script src="https://www.google.com/recaptcha/api.js?render=6Le0fy4pAAAAACnottxxRg-Ne0iPUfb2B_x4FP7w"></script>
        <script>
                grecaptcha.ready(function() {
                grecaptcha.execute('6Le0fy4pAAAAACnottxxRg-Ne0iPUfb2B_x4FP7w', {action: 'accueil'}).then(function(token) {
                    document.getElementById("recaptchaResponse").value = token
                });
                });
        </script>
        </div>
    </div>
<!-------- end POPUP FORM TARAWIH COMMANDE -------->


<!------------------------start LIVRES------------------------------->
<div id="livres" class="container-fluid">
    <h2><a href="#livres" style="text-decoration: none">Le Livre <strong>Tarawih</strong> en plusieurs langues</a></h2>
    <p>Livres Électroniques ou Papiers GRATUITS</p>
</div>
<section id="livrestarawih" href="#livrestarawih">
    <div class="pro-container">
<?php
    
    $db = Database::connect();
    $statement = $db->query('SELECT
    livres_tarawih.id, 
    livres_tarawih.titre, 
    livres_tarawih.auteur,  
    livres_tarawih.langue, 
    livres_tarawih.nombre_de_page, 
    livres_tarawih.image_principale, 
    livres_tarawih.pdf_url, 
    livres_disponible.nom_disponibilite AS disponibilite, 
    livres_downloadable.statut_pdf AS disponibilitepdf,
    livres_tarawih.slug
    FROM livres_tarawih 
    LEFT JOIN livres_disponible ON livres_tarawih.disponibilite = livres_disponible.id
    LEFT JOIN livres_downloadable ON livres_tarawih.disponibilitepdf = livres_downloadable.id
    ORDER BY livres_tarawih.id ASC');
    while ($livres_tarawih = $statement->fetch())
    {
        $slug_livres = 'livres-tarawih/details-livre/' . $livres_tarawih['slug'] . '-' . $livres_tarawih['id'];
        echo    '<div class="pro">';
        echo    '<img src="livres-tarawih/img-livre/' . $livres_tarawih['image_principale'] . '" onclick="lienVersLivre()" alt="le livre ' . $livres_tarawih['titre'] . 'tarawih la prière innovée le ' . $livres_tarawih['langue'] . '">';
        echo    '<div class="des" onclick="lienVersLivre()">';
        echo    '<span>' . $livres_tarawih['langue'] . '</span>';
        echo    '<h5>' . $livres_tarawih['titre'] . '</h5>';
        echo    '<span style="text-transform: capitalize">' . $livres_tarawih['auteur'] . '</span>';
        if($livres_tarawih['disponibilite'] == 'Commander le livre papier')
            echo    '<a href="'. $slug_livres . '"><button class="disponible" >'. $livres_tarawih['disponibilite'] . '</button><a>';
        else
            echo    '<a href="'. $slug_livres . '"><button class="indisponible" >'. $livres_tarawih['disponibilite'] . '</button><a>';
        if($livres_tarawih['disponibilitepdf'] == 'Telecharger le livre PDF')
            echo    '<div><a class="telechargeable" href="' . $livres_tarawih['pdf_url'] . '" style="text-decoration: none;" target="_blank" download="' . $livres_tarawih['pdf_url'] . '">' . $livres_tarawih['disponibilitepdf'] . '</a></div>';
        else 
            echo    '<div><a class="nontelechargeable" href="" style="text-decoration: none;" >' . $livres_tarawih['disponibilitepdf'] . '</a></div>';

        
        echo    '</div></div>';
    }
    Database::disconnect();
?>
    </div>
</section>             
                


<!------------------------END LIVRES------------------------------->
<!------------------------START GUIDES------------------------------->
<div id="guides" class="container-fluid">
    <h2><a href="#guides" style="text-decoration: none">GUIDE <strong>Tarawih</strong> pour le croyant</a></h2>
    <p>Le guide complet sur le Tarawih</p>
</div>

<section id="guides-tarawih" href="#guides-tarawih" class="section-p1">
    <div class="label" role="tablist">
        <a href="#version">
            <div class="sous-titre nav-link active" href="#version" id="tab-version" data-bs-toggle="tab" data-bs-target="#version" role="tab" aria-controls="tab-version" aria-selected="false">
                <h3>Guide n°1 : La prière dite de Tarawih selon la « version officielle ».</h3>
            </div>
        </a>
        <?php
            $db = Database::connect();
            $statement = $db->query('SELECT
            guide_tarawih.id, 
            guide_tarawih.titre, 
            guide_tarawih.textContenu,  
            guide_tarawih.nomId, 
            guide_tarawih.hrefText, 
            guide_tarawih.targetText
            FROM guide_tarawih 
            ORDER BY guide_tarawih.id ASC');
            while ($guide_tarawih = $statement->fetch())
            {
                echo    '<a href="'.$guide_tarawih['hrefText'].'">';
                echo    '<div class="sous-titre nav-link " href="'.$guide_tarawih['hrefText'].'" id="'.$guide_tarawih['nomId'].'" data-bs-toggle="tab" data-bs-target="'.$guide_tarawih['hrefText'].'" role="tab" aria-controls="'.$guide_tarawih['nomId'].'" aria-selected="false">';
                echo    '<h3>'.$guide_tarawih['titre'].'</h3>';
                echo    '</div>';
                echo    '</a>';
            }
            Database::disconnect();
        ?>
    </div>
    <div class="block-row tab-pane fade show active" id="version" role="tabpanel" aria-labelledby="tab-version" tabindex="0">
        <div class="col">
            <h3>Guide n°1 : La prière dite de <strong>Tarawih</strong> selon la « version officielle ».</h3>
            <div>
                <p><span class="red">1-</span><span>Affirmation selon laquelle : </span><span class="red">Le Prophète صلى الله عليه وسلم a, durant le mois de Ramadan, prié quelques jours (trois ou quatre) à la mosquée avec ses compagnons.</span></p>
                <p><span class="red">2-</span><span>Affirmation selon laquelle :</span> Le Prophète a cessé de prier avec ses compagnons parce qu’il a, je cite :</p>
                <blockquote>
                « Craint que cette prière ne devienne une obligation … ».
                </blockquote>
                <p>Par conséquent, je cite :</p>
                <blockquote>
                « Lorsque le Prophète  mourut, les choses étaient ainsi et elles continuèrent de la même manière sous le Califat d’Abou Bakr et ce jusqu’au début du Califat d’Omar ».
                </blockquote>
                <p><span class="red">3-</span>Puisque le Prophète a prié quelques jours avec ses compagnons, les Tarawih sont donc, non seulement, <span class="red">une Sunna</span>, mais davantage, nous dit-on, <span class="red">une Sunna Mouwakadat مؤكدة </span>, c’est-à-dire <span>une Sunna confirmée</span>. C’est pourquoi des « savants » disent que :</p>
                <blockquote>
                « Omar رضي الله عنه n’a fait que réactiver ce que le Prophète avait jadis désactivé  »
                </blockquote>
                <p>ou selon l’expression consacrée :</p>
                <blockquote>« Omar n’a fait que revivifier une Sunna délaissée ».</blockquote>
                <p>En d’autres termes, <span>Omar remettrait en activité des pratiques que le Prophète aurait décidé d’abandonner…</span></p>
                <p><span class="red">4-</span>Durant son Califat, une nuit du mois de Ramadan, Omar ibn Khattab, en passant devant la mosquée du Prophète, constate qu’un certain nombre de compagnons prient chacun de leur côté. L’idée lui vient alors de les réunir sous la direction d’un seul lecteur, en l’occurrence, <span>Obayy ibn Ka’b رضي الله عنه</span>. <span class="red">Ce qui sera le point de départ de ce qu’on appellera la prière de Tarawih</span>. Une prière qui, sur ordre d’Omar, <span class="red">sera imposée</span> à l’ensemble de l’empire musulman. </p>
                <p><span class="red">5-</span>Si il est vrai qu’Omar s’est exclamé ainsi, je cite : <span class="red">نعم البدعة هذه « Quelle bonne innovation »</span> , des « savants  » nous expliquent qu’il s’agit certes d’une innovation, cependant, qu’il faille l’entendre au sens <span class="red">linguistique</span>, c’est-à-dire une chose, en l’occurrence, une prière, qui n’a pas <span class="red">de précédent et en aucun cas une innovation au sens théologique</span>. Puisque nous savons, selon un hadith célèbre, que :</p>
                <blockquote>« toute innovation est un égarement et que tout égarement est dans le feu de l’enfer ».</blockquote>
                <p>Précisons qu’un certain nombre de « savants » conteste qu’Omar soit à l’origine de cette prière. Ils considèrent en effet, que c’est bel et bien le Prophète lui-même qui est à l’origine des Tarawih.</p>
                <p><span class="red">6-</span>On nous affirme qu’à présent, <span>nous pouvons accomplir les Tarawih à la mosquée</span>, puisque le Prophète est mort. Par conséquent, je cite :</p>
                <blockquote>« La crainte du Prophète, que les Tarawih ne deviennent une obligation, n’existe donc plus  ».</blockquote>
                <p>En effet, seul le Prophète ou Allah par l’intermédiaire de son Messager ont le pouvoir de légiférer en ce sens. Il est toutefois intéressant d’observer que si effectivement, comme ils l’affirment, seul Allah ou le Prophète ont le pouvoir de rendre telle ou telle pratique obligatoire, <span class="red">seul Allah et son Messager ont aussi à plus forte raison le pouvoir de légiférer une pratique religieuse, de surcroît une prière</span>. Manifestement, ce second point semble leur avoir… échappés…</p>
                <p><span class="red">7-</span>Des « savants » ajoutent qu’étant donné qu’Omar est un <span>Calife bien guidé</span>, il faut donc le suivre au nom du hadith selon lequel, le Prophète aurait dit, je cite : <blockquote>« De suivre Sa Sunna et la Sunna des Califes bien guidés après lui  ».</blockquote> 
                <p>En d’autres termes, Omar aurait tout comme le Prophète, sa propre Sunna qu’il faille, tout comme celle du Prophète, suivre. Constatons que sur ce sujet, « la Sunna » de Omar l’a emporté sur celle du Prophète, lequel, comme nous le savons et comme le précise l’Imam Malik :</p> <blockquote>« le Prophète n’a veillé que chez lui »</blockquote>.</p>
                <p><span class="red">8-</span>Des « savants » affirment qu’il y a consensus sur la légalité des Tarawih, et que <span class="red">personne parmi les compagnons du Prophète, les Tabiris  et les savants, ne s’est opposé à la pratique des Tarawih</span>. Et que <span>seuls les Chiites, pour des raisons qui n’ont rien de théologiques</span>, n’accomplissent pas les Tarawih. 
</p>
<p>Nous apprenons toutefois qu’il y a divergence sur la question de savoir <span class="red">s’il est préférable de prier les Tarawih à la mosquée ou chez soi</span>, mais aussi sur le nombre de génuflexions à accomplir. Je précise que selon mes lectures, l’avis très majoritaire considère <span class="red">qu'il est préférable de prier à la mosquée</span>. Je pense que ceci s’explique pour au moins deux raisons. Nous savons que l’idéologie religieuse dominante en Arabie saoudite est de tendance Hanbalite, laquelle s’est propagée grâce, entre autres, aux pétrodollars, mais aussi avec la diffusion de « savants » de ce pays. Cette idéologie se caractérise, entre autres, par un suivi aveugle du second Calife de l’Islam. Mais aussi et surtout, les textes évoquant la divergence, voire l’opposition au Tarawih, ont été soigneusement occultés. Notamment et surtout par les adeptes de ce même courant idéologique. 
</p>
<p>Je vous propose, à travers ce livre, d’en découvrir un certain nombre.</p>
<p>On a en effet fait croire au monde musulman qu’il y a consensus sur le fait qu’il faille accomplir les Tarawih à la mosquée, et <span class="red">qu’absolument personne n’a divergé sur ce point</span>, sauf évidemment, les Chiites, lesquels le plus souvent ne sont pas même considérés comme musulmans, notamment par ce même courant idéologique. Enfin, on nous affirme que la haine des Chiites à l’égard d’Omar serait à l’origine du non-respect du « consensus ». </p>
<p>Après vous avoir exposé <span class="red">l’intégralité des explications « officielles »</span> en rapport avec la prière dite de Tarawih, nous allons à présent analyser la véracité et la cohérence de ces propos. </p>
<p>Nous terminerons cet ouvrage par quelques questions adressées aux docteurs de la loi, mais aussi à tous ceux et celles qu’Allah interpelle en ces termes :<span class="red"> اولي الالباب les doués d’intelligence</span>. </p>
            </div>
        </div>
    </div>
    <?php
            $db = Database::connect();
            $statement = $db->query('SELECT
            guide_tarawih.id, 
            guide_tarawih.titre, 
            guide_tarawih.textContenu,  
            guide_tarawih.nomId, 
            guide_tarawih.hrefText, 
            guide_tarawih.targetText
            FROM guide_tarawih 
            ORDER BY guide_tarawih.id ASC');
            while ($guide_tarawih = $statement->fetch())
            {
                echo    '<div class="block-row tab-pane fade show " id="'.$guide_tarawih['targetText'].'" role="tabpanel" aria-labelledby="'.$guide_tarawih['nomId'].'" tabindex="0">';
                echo    '<div class="col">';
                echo    '<h3>'.$guide_tarawih['titre'].'</h3>';
                echo    '<div>'.$guide_tarawih['textContenu'].'</div>';
                echo    '</div>';
                echo    '</div>';
            }
            Database::disconnect();
        ?>
</section>
<!------------------------END GUIDES------------------------------->
<!------------------------START INTRO------------------------------->
<div id="intro" class="container-fluid">
    <h2><a href="#intro" style="text-decoration: none">La pratique du <strong>Tarawih</strong> aujourd'hui</a></h2>
    <p>Comparaison entre jadis et aujourd'hui</p>
</div>
<section id="intro-tarawih" href="intro-tarawih" class="section-p1">
    <div class="block-row">
        <div class="col-intro">
            <h3>Le <strong>Tarawih</strong> sous le califat de Omar ibn al-Khattab</h3>
            <ul>
                <li>Par un ordre donné à toute la péninsule arabique, les gens ne sont pas obligés de faire le Tarawih, mais c'est tout comme.</li>
                <li>Les gens prient jusqu'à l'aube</li>
                <li>Certains d'entre eux s'attachaient par une corde accrochée au toit</li>
                <li>Certains s'appuyaient sur leurs cannes pour tenir debout</li>
                <li>Ils ne savaient pas le nombre de rakaat qu'ils devaient effectué, au point d'aller demander à Aicha (ra), combien de rakaats faisaient le Prophète (saws).</li>
                <li>Prière instituée sans une codification claire, si ce n'est de prier derrière un seul imam dans la mosquée durant les nuits du Ramadan</li>
            </ul>
        </div>
        <div class="col-intro">
            <h3>Le <strong>Tarawih</strong> de nos jours : Ramadan 2024</h3>
            <ul>
                <li>Le Tarawih est devenu une pratique fortement recommandée, sans califat</li>
                <li>Ceux qui ne pratiquent pas le Tarawih, sont mal perçu</li>
                <li>Le Tarawih étant institué par Omar ibn al-Khattab, cette prière a été racollée au Prophète.</li>
                <li>Les gens prient le Tarawih une partie de la nuit</li>
                <li>Ils ne savent toujours pas le nombre de rakaat à effectuer.</li>
                <li>De nombreuses codifications ont été apportées en se référant soi-disant au Prophète</li>
                <li>De nombreux points juridiques ont été purement inventés</li>
            </ul>
        </div>
    </div>
</section>
<!------------------------END INTRO------------------------------->
<!------------------------START PRATIQUE------------------------------->
<div id="pratique" class="container-fluid">
    <h2><a href="#pratique" style="text-decoration: none">Que représente le <strong>Tarawih</strong> aujourd'hui</a></h2>
    <p>Comment est perçu le <strong>Tarawih</strong> par les musulmans du monde ?</p>
</div>
<section id="pratique-tarawih" href="pratique-tarawih" class="section-p1">
    <div class="block-column">
        <div class="col-block">
            <div class="chiffre">
                <h3>1.7 Milliards</h3>
            </div>
            <div class="para">
                <p>de musulmans pratiquent le Tarawih.</p>
            </div>
        </div>
        <div class="col-block droite">
            <div class="chiffre">
                <h3>99%</h3>
            </div>
            <div class="para">
                <p>des musulmans n'ont pas connaissance de la réalité de cette pratique. Tant son origine, que les divergences de point de vue des savants anciens.</p>
            </div>
        </div>
        <div class="col-block">
            <div class="chiffre">
                <h3>9,5%</h3>
            </div>
            <div class="para">
                <p>soit 200 millions de chiites ne pratiquent pas le Tarawih</p>
            </div>
        </div>
        <div class="col-block droite">
            <div class="chiffre">
                <h3>100%</h3>
            </div>
            <div class="para">
                <p>des chiites ne pratiquent pas le Tarawih pour des raisons non-théologiques</p>
            </div>
        </div><div class="col-block">
            <div class="chiffre">
                <h3>0,00001%</h3>
            </div>
            <div class="para">
                <p>des musulmans connaissent la vérité sur le Tarawih de manière théologique. Mais sont austracisés, marginalisés et rendus pour beaucoup comme mécréants.</p>
            </div>
        </div>
        <div class="col-block droite">
            <div class="chiffre">
                <h3>Et Vous ?</h3>
            </div>
            <div class="para">
                <p>Souhaitez-vous faire partie de ceux et celles parmi les frères et soeurs qui connaissent la vérité sur la prière du Tarawih ?</p>
            </div>
        </div>
    </div>
</section>
<!------------------------END PRATIQUE------------------------------->

<!------------------------START CONSEILS------------------------------->
<div id="conseils" class="container-fluid">
    <h2><a href="#conseils" style="text-decoration: none">Conseils <strong>Tarawih</strong> pour le croyant</a></h2>
    <p>Tous ces conseils vont fortifier votre foi</p>
</div>
<section id="conseils-tarawih" href="#conseils-tarawih" class="section-p1">
    <div class="block-row tab-pane fade show active" id="kaaba" role="tabpanel" aria-labelledby="tab-kaaba" tabindex="0">
        <img src="img-tarawih/Moon.png" alt="">
        <div class="col">
            <h3>Conseil n°1 : Prier seul la nuit</h3>
            <p>Dans ta pratique personnelle, se dévouer à Allah en prière la nuit, seul, doit faire partie de ton quotidien pendant et en dehors du Ramadan. Ce fut la pratique instituée par le Prophète Mohamed, ayant enseigné cela tout le long de sa vie de Prophète.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="zakat" role="tabpanel" aria-labelledby="tab-zakat" tabindex="0">
        <img src="img-tarawih/Praying.png" alt="">
        <div class="col">
            <h3>Conseil n°2 : Invoquer Allah en demandant repentance et pardon auprès de Lui</h3>
            <p>Toutes invocations peut être acceptée par le Tout Miséricordieux, en agissant dans les causes de tes invocations</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="priere" role="tabpanel" aria-labelledby="tab-priere" tabindex="0">
        <img src="img-tarawih/Meal.png" alt="">
        <div class="col">
            <h3>Conseil n°3 : Acte de bonté, de bienfaisance envers tes frères et soeurs en Islam.</h3>
            <p>Ces actes nourrissent ton coeur et fortifie ta foi. Ils sont une purification pour toi et un apport pour la sauvegarde de la religion.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="jeune" role="tabpanel" aria-labelledby="tab-jeune" tabindex="0">
        <img src="img-tarawih/Lantern.png" alt="">
        <div class="col">
            <h3>Conseil n°4 : Ne fréquente pas la foule, ne te mêle pas aux gens, mais fréquente des lieux saints</h3>
            <p>La fréquentation des lieux saints peut être ta maison ou celle d'un frère ou d'une soeur. Tout comme un lieu qui s'ouvre à une activité commune dans le but d'élever la religion d'Allah.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="lecture" role="tabpanel" aria-labelledby="tab-lecture" tabindex="0">
        <img src="img-tarawih/Mosque.png" alt="">
        <div class="col">
            <h3>Conseil n°5 : Ne donne pas ton argent à n'importe qui</h3>
            <p>Des associations, des organisations, des projets en tout genre, augmentent de façon considérable. Les cagnottes en ligne et autres demandent de dons augmentent aussi. Il faut que ces associations soient conformes aux lois d'Allah et qu'elles luttent pour la cause principale : élever la religion d'Allah au-dessus de tout gouvernement.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="veille" role="tabpanel" aria-labelledby="tab-veille" tabindex="0">
        <img src="img-tarawih/Praying.png" alt="">
        <div class="col">
            <h3>Conseil n°6 : Ne fréquente pas les mosquées du Diable</h3>
            <p>Elles se repèrent par 2 critères fondamentaux : Elles permettent la domination des mécréants sur les musulmans et permettent le sang des musulmans par leur silence, leurs activités secondaires, lunaires ou futiles, Apolitiques et Laics.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="jeuner" role="tabpanel" aria-labelledby="tab-jeuner" tabindex="0">
        <img src="img-tarawih/Tasbih.png" alt="">
        <div class="col">
            <h3>Conseil n°7 : Focalise-toi sur toi-même et les fondamentaux</h3>
            <p>Tu te focaliseras sur les pratiques des fondamentaux qui ne suscitent pas de doute. Cas de contrainte de non possibilité à appliquer l'un des fondamentaux, tu ne devras surtout pas rester seul et essayer de t'unir avec des frères ou des soeurs en Islam.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="etude" role="tabpanel" aria-labelledby="tab-etude" tabindex="0">
        <img src="img-tarawih/quran-book.png" alt="">
        <div class="col">
            <h3>Conseil n°8 : La nuit, ce n'est pas que la prière et les invocations</h3>
            <p>Assure-toi d'étudier ta religion la nuit, car la nuit est propice pour l'étude.</p>
        </div>
    </div>
    <div class="block-row tab-pane fade" id="education" role="tabpanel" aria-labelledby="tab-education" tabindex="0">
        <img src="img-tarawih/Kaaba.png" alt="">
        <div class="col">
            <h3>Conseil n°9 : Appronfondir ta connaissance</h3>
            <p>Continue à étudier et appronfondir tes connaissances dans la religion pour renforcer ta compréhension.</p>
        </div>
    </div>
    <div class="label" role="tablist">
        <a href="#kaaba">
            <div class="round nav-link active" href="#kaaba" id="tab-kaaba" data-bs-toggle="tab" data-bs-target="#kaaba" role="tab" aria-controls="tab-kaaba" aria-selected="true">
                <img src="img-tarawih/Moon.png" alt="">
            </div>
        </a>
        <a href="#zakat">
            <div class="round nav-link" href="#zakat" id="tab-zakat" data-bs-toggle="tab" data-bs-target="#zakat" role="tab" aria-controls="tab-zakat" aria-selected="false">
                <img src="img-tarawih/Praying.png" alt="">
            </div>
        </a>
        <a href="#priere">
            <div class="round nav-link" href="#priere" id="tab-priere" data-bs-toggle="tab" data-bs-target="#priere" role="tab" aria-controls="tab-priere" aria-selected="false">
                <img src="img-tarawih/Meal.png" alt="">
            </div>
        </a>
        <a href="#jeune">
            <div class="round nav-link" href="#jeune" id="tab-jeune" data-bs-toggle="tab" data-bs-target="#jeune" role="tab" aria-controls="tab-jeune" aria-selected="false">
                <img src="img-tarawih/Lantern.png" alt="">
            </div>
        </a>
        <a href="#lecture">
            <div class="round nav-link" href="#lecture" id="tab-lecture" data-bs-toggle="tab" data-bs-target="#lecture" role="tab" aria-controls="tab-lecture" aria-selected="false">
                <img src="img-tarawih/Mosque.png" alt="">
            </div>
        </a>
        <a href="#veille">
            <div class="round nav-link" href="#veille" id="tab-veille" data-bs-toggle="tab" data-bs-target="#veille" role="tab" aria-controls="tab-veille" aria-selected="false">
                <img src="img-tarawih/Praying.png" alt="">
            </div>
        </a>
        <a href="#jeuner">
            <div class="round nav-link" href="#jeuner" id="tab-jeuner" data-bs-toggle="tab" data-bs-target="#jeuner" role="tab" aria-controls="tab-jeuner" aria-selected="false">
                <img src="img-tarawih/Tasbih.png" alt="">
            </div>
        </a>
        <a href="#etude">
            <div class="round nav-link" href="#etude" id="tab-etude" data-bs-toggle="tab" data-bs-target="#etude" role="tab" aria-controls="tab-etude" aria-selected="false">
                <img src="img-tarawih/quran-book.png" alt="">
            </div>
        </a>
        <a href="#education">
            <div class="round nav-link" href="#education" id="tab-education" data-bs-toggle="tab" data-bs-target="#education" role="tab" aria-controls="tab-education" aria-selected="false">
                <img src="img-tarawih/Kaaba.png" alt="">
            </div>
        </a>
    </div>
</section>
<!------------------------END CONSEILS------------------------------->
<!------------------------START HISTOIRE------------------------------->
<div id="histoire" class="container-fluid">
    <h2><a href="#histoire" style="text-decoration: none">Tarawih : son histoire</a></h2>
    <p>L'histoire du <strong>Tarawih</strong> en quelques mots</p>
</div>
<section id="histoire-tarawih" href="#histoire-tarawih" class="section-p1">
    <div class="block-row">
        <div class="block-column rounded">
            <h3>Le Prophète prie seul</h3>
            <p>L'histoire du <strong>Tarawih</strong> remonte à la fin de la période médinoise. 
                Néanmoins, la pratique de prier et de méditer la parole d'Allah, fut courante tout le long de la vie du prophète Muhammad. D'autant plus significativement, durant la nuit.
                <blockquote>" L'Envoyé d'Allah – qu'Allah prie sur lui et le salue – faisait des prières durant la nuit, dans sa chambre qui avait un mur peu élevé." Hadith rapporté par Boukhari</blockquote>
            </p>
        </div>
        <div class="block-column inversed">
            <h3>Des Compagnons aperçoivent le prophète prier</h3>
            <p>Une nuit, durant le Ramadan, le Prophète priant habituellement dans sa maison ou dans un coin de la mosquée, des compagnons aperçoivent la silhouette du Prophète ou le Prophète selon des variantes. Puis, de leur propre initiative, commence à prier derrière lui.
                <blockquote>En voyant la silhouette du Prophète – qu'Allah prie sur lui et le salue – les gens commencèrent à suivre sa prière</blockquote>
            </p>
        </div>
        <div class="block-column rounded">
            <h3>3 ou 4 nuits passent</h3>
            <p>3 ou 4 nuits passant, les compagnons s'enjoignent de prier derrière le Prophète Muhammad. L'histoire du Tarawih nous apprend que le Prophète n'était pas conscient que des compagnons se mirent à suivre le Prophète dans sa prière. Dès que le Prophète s'aperçut de la présence de compagnons qui suivait sa prière, il s'arrêta de prier et rentra chez lui.
                <blockquote>"cela se répéta deux ou trois nuits" [...] " Un certain nombre de compagnons du prophète ayant suivi sa prière, celui-ci, dès qu’il s’en aperçut resta assis." [...] "resta chez lui et ne sortit pas."</blockquote>
            </p>
        </div>
        <div class="block-column inversed">
            <h3>Le Prophète enseigne aux compagnons ce qu'ils doivent faire</h3>
            <p>La troisième ou quatrième nuit, des compagnons viennent dans la mosquée du Prophète pour prier derrière lui, mais ne le voient pas. Certains décident de tousser de manière à se faire entendre, d'autres élevèrent la voix et jetèrent quelques cailloux sur la porte du Prophète, afin de le faire sortir.
                <blockquote>" Ils élevèrent la voix et frappèrent la porte avec quelques cailloux. L'Envoyé d'Allah – qu'Allah prie sur lui et le salue – sortit les voir en colère et leur dit : Votre insistance (à faire ces prières) me pousse à croire qu'elles deviendraient obligatoires. Priez donc dans vos maisons ! Car la meilleure des prières est celle que l’on fait chez soi, sauf pour ce qui est des prières obligatoires »."</blockquote>
            </p>
        </div>
        <div class="block-column rounded">
            <h3>Le Prophète décède, son enseignement perdure</h3>
            <p>Après cet évènement, les compagnons ne sont plus jamais revenu à la mosquée pour prier derrière le Prophète durant les nuits du Ramadan et en dehors des nuits du Ramadan. Les gens ont continué a prié dans leur maison pendant le restant de la vie du Prophète et pendant le califat d'Abou Bakr.
                <blockquote>"Quand le Prophète mourut les choses étaient dans le même état"</blockquote>
            </p>
        </div>
        <div class="block-column inversed">
            <h3>Sous le califat de Omar ibn al-Khattab, le Tarawih commence</h3>
            <p>Ce n'est qu'au début du Califat de Omar ibn al-Khattab que des compagnons ont initié a prié chacun de leur côté dans la mosquée ou en groupe. Voyant les fidèles agirent ainsi, Omar eut l'idée de regrouper les gens en prière derrière un seul récitateur durant les nuits du Ramadan. Il ordonna à toute la péninsule arabique d'agir ainsi.
                <blockquote>Ibn Chihab dit : « Jusqu’à ce qu’Omar les rassembla derrière Obayy ibn Ka’b, qui guida leur prière durant les veillées du Ramadan. Ce fut-là, la première fois que les gens se rassemblèrent derrière un seul lecteur pendant le Ramadan ».</blockquote>
            </p>
        </div>
        <div class="block-column rounded">
            <h3>Quelques récits sur la pratique du Tarawih</h3>
            <p>Nombreux sont les récits qui nous rapportent les effets de cette pratique :
                <blockquote>« Et c’est lui (Omar) le premier à avoir rassemblé les gens (musulmans) sous la direction d’un seul imam pour accomplir la prière dite de Tarawih durant le mois du Ramadan » « Il adressa des lettres à toutes les villes des possessions musulmanes pour leur ordonner d’agir ainsi ».  </blockquote>
                <blockquote>« Les gens se sont plaints à Omar de la durée des Tarawih. Omar a alors ordonné au lecteur qui préside la prière, de raccourcir la lecture et d’augmenter le nombre de Rakaat. La prière se faisait alors de 23 génuflexions. Cependant, les gens ont continué à se plaindre, il a alors encore raccourci la lecture et a augmenté le nombre de génuflexions. Ainsi, le nombre fut porté à 36 Génuflexions et les choses en sont restées ainsi ». </blockquote>
            </p>
        </div>
        <div class="block-column rounded">
            <h3>Note de l'auteur du livre Tarawih</h3>
            <p>C’est en 2005 que pour la première fois, le livre <i>La prière de </i><strong>Tarawih</strong> a été édité en langue française.<br><br>

Après trois années d’investigations, il fut, en 2008, réédité, augmenté et traduit en Anglais et en Arabe.<br><br>

Douze années d'investigations supplémentaires sont passées, pour que voit le jour du 21 août 2020, la réédition du livre <i>La prière de </i><strong>Tarawih</strong> en langue Française et Turc.<br><br>

Fin 2023 - Début 2024, soit 3 ans plus tard, nous éditons de nouveau le livre <i>La prière de </i><strong>Tarawih</strong> dans une version augmentée et corrigée, en langue Française et Arabe.<br><br>

Cette « aventure » commence un jour de l’année 2005, lorsqu’au cours de mes lectures, je prends connaissance de ce hadith : <i><b>« Dorénavant, ô fidèles, priez dans vos demeures, car la meilleure prière pour un homme est celle qu’il fait chez lui, à moins qu’il ne s’agisse de la prière canonique [1]».</b></i> De par son caractère péremptoire, il m’interpella alors vivement.<br><br>

Je m’interrogeais alors profondément. Quelle théorie théologique, quelle réflexion savantissime, pouvait justifier que nous fassions l’exact contraire ?<br><br>

Ce hadith est-il faux ? Mal traduit ? Abrogé ?<br><br>

Depuis ce jour de 2005 à aujourd’hui et probablement jusqu’à la fin de mes jours, je ne cesserai de tirer sur la ficelle, afin que, si Allah me le permet, je puisse enfin connaitre la vérité.<br><br>

Cette vérité qui a été et j’en suis absolument convaincu, incroyablement bien dissimulée par le plus souvent, ceux qui croient que Omar ibn Khattab رضي الله عنه fait partie de la croyance et parfois bien plus que le prophète lui-même !<br><br>

Je sais que je ne connaîtrai jamais toute la vérité, mais à l’heure d’aujourd’hui, j’en sais suffisamment assez pour affirmer que l'on nous a menti.
<h4>[1] Sahih de l’imam Boukhari et Muslim.</h4>
            </p>
        </div>
    </div>
</section>
<!------------------------END HISTOIRE------------------------------->
<!------------------------START TEMOIGNAGES ET EXPERIENCES------------------------------->
<div id="chiffre" class="container-fluid">
    <h2><a href="#chiffre" style="text-decoration: none">Nos chiffres en toute transparence</a></h2>
    <p>Notre Promotion du livre <strong>Tarawih</strong></p>
</div>
<section id="chiffre-tarawih" class="section-p1">
    <div class="block-row">
        <div class="square-box">
            <img src="img-tarawih/lampe.png" alt="">
            <h3>Plus de <span>20 000</span> Commandes</h3>
            <p>du livre Tarawih dans les pays suivants : Maroc, Algérie, Tunisie, Sénégal, Mali, Mauritanie, Mayotte, Comores, Burkina Faso, Guinée, Ghana, Bénin, Togo, Gabon, Congo, Cameroun, Côte d'Ivoire, Guinée-Bissau, Niger, Nigeria, Madagascar</p>
        </div>
        <div class="square-box">
            <img src="img-tarawih/recitation.png" alt="">
            <h3><span>29 800</span> Livres Distribués</h3>
            <p>en France et en Belgique.</p>
        </div>
        <div class="square-box">
            <img src="img-tarawih/quran-book.png" alt="">
            <h3>Plus de <span>50</span> vidéos au sujet du Tarawih</h3>
            <p><a href="https://metmatimaamar.com" target="_blank">En savoir plus</a> dans la Section <strong>Tarawih</strong></p>
        </div>
    </div>
</section>
<!------------------------END TEMOIGNAGES ET EXPERIENCES------------------------------->
<!------------------------start FAQ------------------------------->
<div id="faq" class="container-fluid">
    <h2><a href="#faq" style="text-decoration: none">FAQ : <strong>Tarawih</strong></a></h2>
    <p>Toutes les réponses aux questions recensées sur le <strong>Tarawih</strong></p>
    <p class="sub1">Vous en aurez hautement besoin !</p>
</div>
<section id="faq-tarawih" class="section-p1">
    <div class="pro-containerfaq">
<?php 

    $db = Database::connect();
    $statement = $db->query('SELECT
    questions_reponses_tarawih.id, 
    questions_reponses_tarawih.question, 
    questions_reponses_tarawih.reponse
    FROM questions_reponses_tarawih
    ORDER BY questions_reponses_tarawih.id asc
    LIMIT 14
    ');
    while ($questions_reponses_tarawih = $statement->fetch())
    {
        if($questions_reponses_tarawih['id'] == '1')
            echo    '<div class="profaq q1">';
        if($questions_reponses_tarawih['id'] == '2')
            echo    '<div class="profaq q2">';
        if($questions_reponses_tarawih['id'] == '3')
            echo    '<div class="profaq q3">';
            
        if ($questions_reponses_tarawih['id'] == '4')
                echo    '<div class="profaq q4">';
            
        if ($questions_reponses_tarawih['id'] == '5')
                echo    '<div class="profaq q5">';
            
        if ($questions_reponses_tarawih['id'] == '6')
                echo    '<div class="profaq q6">';
            
        if ($questions_reponses_tarawih['id'] == '7')
                echo    '<div class="profaq q7">';
            
        if ($questions_reponses_tarawih['id'] == '8')
                echo    '<div class="profaq q8">';
            
        if ($questions_reponses_tarawih['id'] == '9')
                echo    '<div class="profaq q9">';
            
        if ($questions_reponses_tarawih['id'] == '10')
                echo    '<div class="profaq q10">';
            
        if ($questions_reponses_tarawih['id'] == '11')
                echo    '<div class="profaq q11">';
            
        if ($questions_reponses_tarawih['id'] == '12')
                echo    '<div class="profaq q12">';
            
        if ($questions_reponses_tarawih['id'] == '13')
                echo    '<div class="profaq q13"">';
            
        if ($questions_reponses_tarawih['id'] == '14')
                echo    '<div class="profaq q14">';
            
        echo    '<h3>' . $questions_reponses_tarawih['id'] . '</h3>';
        echo    '<div class="des">';
        echo    '<h5>' . $questions_reponses_tarawih['question'] . '</h5><br>';
        echo    '<span>' . substr($questions_reponses_tarawih['reponse'], 0, 75) . ' [...]</span>';
        echo    '<a href="questions-reponses-tarawih/details-questions.php?id=' . $questions_reponses_tarawih['id'] . '"><div class="savoir"><i></i><button>Savoir</button></div></a>';
        echo    '</div></div>';
    }
    Database::disconnect();
?>
    </div>
    <a href="faq-tarawih"><button class="questions">Toutes les quelques autres questions-réponses sur les Tarawih</button></a>
</section>


<!------------------------END FAQ------------------------------->

<!------------------------start ARTICLES------------------------------->
<div id="articles" class="container-fluid">
    <h2><a href="#articles" style="text-decoration: none">Nos articles sur la prière de Tarawih</a></h2>
    <p>Histoire de la prière de <strong>Tarawih</strong> - <br>Réfutations des livres de plusieurs imams sur le <strong>Tarawih</strong> - <br>Réfutations des discours officiels sur la prière de <strong>Tarawih</strong></p>
    <p class="sub2">À Lire et à Partager absolument !</p>
</div>
<section id="articles-tarawih" class="section-p1">
    <div class="pro-container">
    <?php 

        $db = Database::connect();
        $statement = $db->query('SELECT
        articles_tarawih.id,
        articles_tarawih.titre, 
        articles_tarawih.chapo, 
        articles_tarawih.image_principale,
        articles_tarawih.auteur,
        articles_tarawih.slug
        FROM articles_tarawih
        order by articles_tarawih.id desc
        LIMIT 8
        ');
        while ($articles_tarawih = $statement->fetch())
        {
            $slug_articles = "articles-tarawih/details-articles/" . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'];

            
            if($articles_tarawih['id'] == '4')
                echo    '<div class="pro a4" >';
                
            if ($articles_tarawih['id'] == '5')
                echo    '<div class="pro a5" >';
                
            if ($articles_tarawih['id'] == '6')
                echo    '<div class="pro a6" >';
                
            if ($articles_tarawih['id'] == '7')
                echo    '<div class="pro a7" >';
                
            if ($articles_tarawih['id'] == '9')
                echo    '<div class="pro a9" >';
            if ($articles_tarawih['id'] == '10')
            echo    '<div class="pro a10" >';
            if ($articles_tarawih['id'] == '11')
            echo    '<div class="pro a11" >';
            if ($articles_tarawih['id'] == '12')
            echo    '<div class="pro a12" >';
            if ($articles_tarawih['id'] == '13')
            echo    '<div class="pro a13" >';
            if ($articles_tarawih['id'] == '14')
            echo    '<div class="pro a14" >';
            echo    '<div class="bes">';
            echo    '<div class="img-block">';
            echo    '<img class="img-articles-textuel" src="articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] . '" alt="' . $articles_tarawih['titre'] . ' écrit par ' . $articles_tarawih['auteur'] . '"">';
            echo    '</div>';
            echo    '<div class="subdes">';
            echo    '<h5>' . $articles_tarawih['titre'] . '</h5><br>';
            echo    '<span>' . substr($articles_tarawih['chapo'], 0, 190) . ' [...]</span></div></div>';
            echo    '<h4><a href="'. $slug_articles . '" style="color: white; text-decoration : none;">LIRE</a><i></i></h4>';
            echo    '</div>';
        }
        Database::disconnect();
?>
    </div>
</section>


<!------------------------END ARTICLES------------------------------->
<!------------------------start SM BANNIERE------------------------------->

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Contre Offensive édition</h4>
            <h2>Toutes nos vidéos</h2>
            <span>"Allah secourt, ceux qui le secourent"</span>
            <a href="https://maamarmetmati.fr/videos-maamar-metmati" target="_blank"><button>REGARDER</button></a>
        </div>
        <div class="banner-box banner-box2">
            <h4>Contre Offensive édition</h4>
            <h2>Tous nos livres</h2>
            <span>Tous les livres de Maamar Metmati disponibles en téléchargement</span>
            <a href="https://maamarmetmati.fr/livres" target="_blank"><button>VISITER</button></a>
        </div>
    </section>

    <section id="banner-3">
        <div class="banner-box">
            <h2>Notre maison d'édition</h2>
            <button>En savoir plus</button>
        </div>
        <div class="banner-box banner-box2">
            <h2>L'éditeur</h2>
            <button>Maamar Metmati</button>
        </div>
        <div class="banner-box banner-box3">
            <h2>Contactez-nous</h2>
            <a href="#contact"><button>En savoir plus</button></a>
        </div>
    </section>

    <section id="reseaux" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Inscrivez-vous à notre newsletter</h4>
            <p>Tous vos produits <span>GRATUITS.</span></p>
            <a href="https://www.instagram.com/maamarmetmati/?hl=fr"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <div class="form">
            <form class="form-infocourriel" role="form" action="accueil" method="post">
                <input type="email" id="email" name="emailinfo" placeholder="Entrer votre adresse mail" value="<?php echo $mailInfoCourriel ; ?>">
                <button type="submit" class="inscriptioninfocourriel">S'inscrire</button>
                <span class="aide-enligne"><?php echo $mailinfocourrielErreur ; ?></span>
            </form>
        </div>
    </section>
<!------------------------END SM BANNIERE------------------------------->
<!------------------------Start FOOTER------------------------------->

    <footer class="section-p1">
        <div itemscope itemtype="https://schema.org/Organization" id="contact" class="col">
                <span itemprop="url" content="https://tarawih.com"><a href=""><img class="logo" itemprop="logo" src="img-tarawih/logo-256.png" class="logo" alt=""></a></span>
                <p><strong><span itemprop="name">Tarawih</span></strong> | <span itemprop="alternateName">Tarawih Innovation</span></p>

                <h4>Contactez-Nous</h4>
            <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <p><strong><span itemprop="addresseLocality"></span>Adresse : </strong>Paris</p>
            </div>
                <p><strong>Téléphone : </strong><span itemprop="telephone">(+33) 7 86 02 69 24</span></p>
                <p><strong>Mail : </strong><span itemprop="email">tarawih12@yahoo.com</span></p>
                <p><strong>Horaires : </strong>9h00 - 18h00 du Lundi au Vendredi</p>
        </div>
        <div class="follow">
            <h4>Suivez-nous, c'est par ici !</h4>
            <div itemscope itemtype="https://schema.org/Organization" class="icon">
                <a itemprop="sameAs" href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank"><i class="fab fa-facebook"></i></a>
                <a itemprop="sameAs" href="https://www.youtube.com/c/MaamarMetmatiOfficiel12" target="_blank"><i class="fab fa-youtube"></i></a>
                <a itemprop="sameAs" href="https://www.instagram.com/maamarmetmati/?hl=fr" target="_blank"><i class="fab fa-instagram"></i></a>
                <a itemprop="sameAs" href="https://twitter.com/OfficielMaamar" target="_blank"><i class="fab fa-twitter"></i></a>
                <a itemprop="sameAs" href="https://t.me/maamarmetmati" target="_blank"><i class="fab fa-telegram"></i></a>
                <a itemprop="sameAs" href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank"><i class="fab fa-fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="col">
            <h4>À mon propos</h4>
            <a>À propos de l'éditeur : Maamar Metmati</a>
            <a>Nous contacter</a>
        </div>
        <div class="col">
            <h4>Commander le livre Tarawih</h4>
            <a>Comment la commande fonctionne ?</a>
            <a>Tout savoir sur nos livres</a>
            <h4>Nos Vidéos</h4>
            <a href="https://maamarmetmati.fr/videos-maamar-metmati" target="_blank">Pour regarder nos vidéos</a>
            <a href="https://www.youtube.com/c/MaamarMetmatiOfficiel12" target="_blank">Sur Youtube</a>
            <a href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank">Sur Facebook</a>
            <a href="https://t.me/maamarmetmati" target="_blank">Sur Telegram</a>
        </div>
        <div class="copyright">
            <p>Copyright @2024 <i id="common" class="fab fa-creative-commons"></i> - Tarawih.com - Créé par عبد الرحمن</p>
            <i class="fab fa-fab fa-html5"></i>
            <i class="fab fa-fab fa-css3-alt"></i>
            <i class="fab fa-fab fa-js"></i>
            <i class="fab fa-fab fa-php"></i>
        </div>
    </footer>

<!------------------------END FOOTER------------------------------->
<!------------------------END PRODUITS3------------------------------->



<!------------------------SCRIPT FILES------------------------------->
    <script src="script.js"></script>
</body>

</html>
