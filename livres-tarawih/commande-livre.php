<?php
require '../admin/database_tarawih.php';
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    //Load Composer's autoloader
    require '../vendor/autoload.php';
    $nomclientErreur = $prenomclientErreur = $emailclientErreur =  $indicatifParticulier1Erreur = $telephoneclientErreur = $adresse1clientErreur = $villeclientErreur = $codepostalclientErreur = $paysclientErreur = $quantiteparticulierclientErreur = 
    $nomClient = $prenomClient = $emailClient = $indicatifParticulier1 = $telephoneClient  = $adresse1Client = $adresse2Client = $villeClient = $codepostalClient = $paysClient = $quantiteparticulierClient = $quantiteproClient = ""; 

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
        if($estValide)
        {
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
            header("Location: confirmation-commande-livre");
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
<script src="https://cdn.by.wonderpush.com/sdk/1.1/wonderpush-loader.min.js" async></script>
    <script>
    window.WonderPush = window.WonderPush || [];
    WonderPush.push(["init", {
        webKey: "a4eb9f863260138a027d6bb893163db7f6bdd5cff6282c36bf1183e9a99b9a36",
    }]);
    </script>
    <!-- Meta Head -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Commande Livre Tarawih</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="../style-livre-tarawih.css">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGFBG9D"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!------------------------start HEADER------------------------------->
<section id="header">
    <a href="../../accueil"><img src="../logo-256.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
        <li><a href="../../accueil">Accueil</a></li>
            <li class="active"><a href="../../livres-priere-tarawih">Livres</a><i></i></li>
            <li><a href="../../articles-priere-tarawih">Articles</a><i></i></li>
            <li><a href="../../faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li><a href="#contact">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<!------------------------END HEADER------------------------------->
    <div id="pagedulivre" style='background-image: url("<?php echo 'img-livre/' . $livres_tarawih['image_principale'];?>")'  class="container-fluid">
    <h1>Commande Livre Tarawih</h1>
        <p class="sub3">Télécharge-le ou Commande-le !</p>
    </div>
    <section id="ajouterlivreclient">   
        <form class="form-ajouterlivreclient" role="form" action="commande-livre.php" method="post">
            <div class="form-groupeajouterlivreclient">
                <label for="nom">Nom</label>
                <input class="form-livreclient" id="nom" name="nom" placeholder="Entrer le nom" value="<?php echo $nomClient ; ?>" type="text">
                <span class="aide-enligne"><?php echo $nomclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="prenom">Prenom</label>
                <input class="form-livreclient" id="prenom" name="prenom" placeholder="Entrer le prénom" value="<?php echo $prenomClient ; ?>" type="text">
                <span class="aide-enligne"><?php echo $prenomclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="email">Email</label>
                <input class="form-livreclient" id="email" name="emailclient" placeholder="Entrer l'email" value="<?php echo $emailClient ; ?>" type="email">
                <span class="aide-enligne"><?php echo $emailclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="indicatif1">Indicatif Pays +</span>
                <input class="form-livreclient" type="number" id="indicatif1" name="indicatif1" value="<?php echo $indicatifParticulier1 ;?>" required>
                <label for="telephone">Telephone</label>
                <input class="form-livreclient" id="telephone" name="telephone" placeholder="(XXXXXXXXX)" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?php echo $telephoneClient ; ?>" type="tel">
                <span class="aide-enligne"><?php echo $telephoneclientErreur ; ?></span>
                <small>Ne pas mettre le 0 de votre téléphone : L'indicatif téléphonique de votre pays remplacera le 0.</small>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="adresse1">Adresse 1</label>
                <input class="form-livreclient" id="adresse1" name="adresse1" placeholder="Entrer l'adresse" value="<?php echo $adresse1Client ; ?>" type="text">
                <span class="aide-enligne"><?php echo $adresse1clientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="adresse2" id="adresse2">Complément d'adresse (facultatif)</label>
                <input class="form-livreclient" name="adresse2" id="adresse2" placeholder="Entrer le complément d'adresse" value="<?php echo $adresse2Client ;?>" type="text"></input>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="codepostal" id="codepostal">Code Postal</label>
                <input class="form-livreclient" name="codepostal" id="codepostal" placeholder="Entrer le code postal" value="<?php echo $codepostalClient ;?>" type="number"></input>
                <span class="aide-enligne"><?php echo $codepostalclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="ville" id="ville">Ville</label>
                <input class="form-livreclient" name="ville" id="ville" placeholder="Entrer la ville" value="<?php echo $villeClient ;?>" type="text"></input>
                <span class="aide-enligne"><?php echo $villeclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="pays" id="pays">Pays</label>
                <input class="form-livreclient" name="pays" id="pays" placeholder="Entrer le pays" value="<?php echo $paysClient ;?>" type="text"></input>
                <span class="aide-enligne"><?php echo $paysclientErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivreclient">
                <label for="quantiteparticulier">Quantité Livre (Particulier)</label>
                <select class="form-livreclient" name="quantiteparticulier" id="quantiteparticulier">
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
            <div class="form-groupeajouterlivreclient">
                <label for="quantitepro" hidden>Quantité Livre (Professionnel)</label>
                <select type="hidden" class="form-livreclient" name="quantitepro" id="quantitepro">
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
                <button type="submit" class="submit-livre">JE COMMANDE</button>
            </div>
        </form>
            

    </section>

    <!-------------------- FOOTER --------------------------->
    <footer class="section-p1">
        <div id="contact" class="col">
            <a><img class="logo" src="../logo-256.png" class="logo" alt=""></a>
            <h4>Contactez-Nous</h4>
            <p><strong>Adresse : </strong>Paris</p>
            <p><strong>Téléphone : </strong>07 86 72 24 68</p>
            <p><strong>Mail : </strong>tarawih12@yahoo.com</p>
            <p><strong>Horaires : </strong>9h00 - 18h00 du Lundi au Vendredi</p>
        </div>
        <div class="follow">
            <h4>Suivez-nous, c'est par ici !</h4>
            <div class="icon">
                <a href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.youtube.com/c/MaamarMetmatiOfficiel12" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/maamarmetmati/?hl=fr" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/OfficielMaamar" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://t.me/maamarmetmati" target="_blank"><i class="fab fa-telegram"></i></a>
                <a href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank"><i class="fab fa-fab fa-whatsapp"></i></a>
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
            <p>Copyright @2023 <i id="common" class="fab fa-creative-commons"></i> - Tarawih.com - Créé par عبد الرحمن</p>
            <i class="fab fa-fab fa-html5"></i>
            <i class="fab fa-fab fa-css3-alt"></i>
            <i class="fab fa-fab fa-js"></i>
            <i class="fab fa-fab fa-php"></i>
        </div>
    </footer>
</body>

</html>

