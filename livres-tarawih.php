<?php
    require 'admin/database_tarawih.php';


    $mailinfocourrielErreur = $mailInfoCourriel = ""; 

    if (!empty($_POST)) 
    {   
        $mailInfoCourriel         = checkInput($_POST['email']);
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
    <!-- Twitter conversion tracking base code -->
    <script>
    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
    a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
    twq('config','okb95');
    </script>
    <!-- End Twitter conversion tracking base code -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <title>Livre Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ | en plusieurs langues</title>
    <meta name="description" content="Commandez et lisez nos livres sur la prière de Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ en plusieurs langues, écrit par Maamar Metmati." />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="Livre Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ | en plusieurs langues">
    <meta property="og:title" content="Livre Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ | en plusieurs langues" />
    <meta name="twitter:description" content="Commandez et lisez nos livres sur la prière de Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ en plusieurs langues, écrit par Maamar Metmati.">
    <meta property="og:description" content="Commandez et lisez nos livres sur la prière de Tarawih ﺍﻟﺘﺮﺍﻭﻳﺢ en plusieurs langues, écrit par Maamar Metmati."/>
    <meta name="twitter:image" content="https://tarawih.com/livres-langues-différentes-tarawih.jpg">
    <meta property="og:image" content="https://tarawih.com/livres-langues-différentes-tarawih.jpg" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.tarawih.com/livres-priere-tarawih" />
    <link rel="image_src" href="https://tarawih.com/livres-langues-différentes-tarawih.jpg">
    <link rel="canonical" href="https://www.tarawih.com/livres-priere-tarawih">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGFBG9D"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<!------------------------start HEADER------------------------------->
<section id="header">
    <a href="accueil"><img src="img-tarawih/logo-256.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a href="accueil">Accueil</a></li>
            <li class="active"><a href="#">Livres</a><i></i></li>
            <li><a href="articles-priere-tarawih">Articles</a><i></i></li>
            <li><a href="faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li><a href="#contact">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<!------------------------END HEADER------------------------------->
<!------------------------start TOUS LES LIVRES TARAWIH ------------------------------->
<div id="pagelivres" class="container-fluid">
    <h1>Le Livre Tarawih en plusieurs langues</h1>
    <p>Livres Électroniques ou Papiers GRATUITS !</p>
</div>

    <section id="pagelivrestarawih">
        
        <div class="pro-container-livrestarawih">
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
            livres_tarawih.slug,
            livres_disponible.nom_disponibilite AS disponibilite, 
            livres_downloadable.statut_pdf AS disponibilitepdf
            FROM livres_tarawih 
            LEFT JOIN livres_disponible ON livres_tarawih.disponibilite = livres_disponible.id
            LEFT JOIN livres_downloadable ON livres_tarawih.disponibilitepdf = livres_downloadable.id
            ORDER BY livres_tarawih.id ASC');
            while ($livres_tarawih = $statement->fetch())
            {
                $slug_livres = 'livres-tarawih/details-livre/' . $livres_tarawih['slug'] . '-' . $livres_tarawih['id'];
                echo    '<div id ="lienverslivre" class="pro-livrestarawih">';
                echo    '<img src="livres-tarawih/img-livre/' . $livres_tarawih['image_principale'] . '" onclick="lienVersLivre()" alt="le livre ' . $livres_tarawih['titre'] . 'tarawih la prière innovée le ' . $livres_tarawih['langue'] . '">';
                echo    '<div class="des-livrestarawih" onclick="lienVersLivre()">';
                echo    '<span style="text-transform:uppercase;">' . $livres_tarawih['langue'] . '</span>';
                echo    '<h5>' . $livres_tarawih['titre'] . '</h5>';
                echo    '<span>' . $livres_tarawih['auteur'] . '</span>';
                if($livres_tarawih['disponibilite'] == 'Commander le livre papier')
                    echo    '<a href="'. $slug_livres . '"><button class="disponible1" >'. $livres_tarawih['disponibilite'] . '</button></a>';
                else
                    echo    '<a href="'. $slug_livres . '"><button class="indisponible1" >'. $livres_tarawih['disponibilite'] . '</button></a>';
                if($livres_tarawih['disponibilitepdf'] == 'Telecharger le livre PDF')
                    echo    '<div><a class="telechargeable1" href="' . $livres_tarawih['pdf_url'] . '" style="text-decoration: none;" target="_blank" download="'.$livres_tarawih['pdf_url'].'">' . $livres_tarawih['disponibilitepdf'] . '</a></div>';
                else 
                    echo    '<div><a class="nontelechargeable1" href="" style="text-decoration: none;" >' . $livres_tarawih['disponibilitepdf'] . '</a></div>';

                echo    '</div></div>';
            }
            Database::disconnect();
        ?>
            </div>
        </section>             

<!------------------------END TOUS LES LIVRES TARAWIH ------------------------------->
<section id="histoire-tarawih" href="#histoire-tarawih" class="section-p1">
    <div class="block-row">
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
        <div class="block-column rounded">
            <h3>Version PDF La prière de <strong>Tarawih</strong></h3>
            <p>Vous pouvez accéder aux livres La prière de <strong>Tarawih</strong> en langue française, arabe, turc et anglaise. Certaines traductions ne sont pas encore disponible, mais ne sauraient tarder d'être publié.<br><br>
        Chaque livre est GRATUIT, disponible en PDF.
            </p>
        </div>
        <div class="block-column rounded">
            <h3>Livre Papier La prière de <strong>Tarawih</strong></h3>
            <p>La version papier du livre La prière de Tarawih est disponible dans un livre unique composé des traductions en langue arabe, turque et anglaise. <br><br>
            Le livre est <b>GRATUIT</b>, ainsi que <u>son expédition. Et cela, à l'international</u> ! <br><br></p>
            <a href="livraison">Pour en savoir plus sur la livraison</a>
        </div>
    </div>
</section>

<!------------------------start RESEAUX SOCIAUX ------------------------------->
<section id="reseauxsociaux" class="section-p1">
    <div class="fe-box" style="cursor:pointer;">
        <h6><a href="https://www.youtube.com/c/MaamarMetmatiOfficiel12/?sub_confirmation=1" target="_blank" style="color: white; text-decoration : none;">YOUTUBE</a></h6>
    </div>
    <div class="fe-box">
        <h6><a href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank" style="color: white; text-decoration : none;">FACEBOOK</a></h6>
    </div>
    <div class="fe-box">
        <h6><a href="https://www.instagram.com/maamarmetmati12" target="_blank" style="color: white; text-decoration : none;">INSTAGRAM</a></h6>
    </div>
    <div class="fe-box">
        <h6><a href="https://www.tarawih.eu" target="_blank" style="color: white; text-decoration : none;">TARAWIH.EU</a></h6>
    </div>
    <div class="fe-box">
        <h6><a href="https://www.tarawih.fr" target="_blank" style="color: white; text-decoration : none;">TARAWIH.FR</a></h6>
    </div>
    <div class="fe-box">
        <h6><a href="https://maamarmetmati.fr" target="_blank" style="color: white; text-decoration : none;">MM.fr</a></h6>
    </div>
</section>

<!------------------------END RESEAUX SOCIAUX ------------------------------->
<!------------------------start SM BANNER------------------------------->

    <section id="banner-3-livres">
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
            <button>En savoir plus</button>
        </div>
    </section>

    <section id="reseaux" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Inscrivez-vous à ma newsletter</h4>
            <p>Tous vos produits <span>GRATUITS.</span></p>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <div class="form">
            <form class="form-infocourriel" role="form" action="accueil" method="post">
                <input type="email" id="email" name="email" placeholder="Entrer votre adresse mail" value="<?php echo $mailInfoCourriel ; ?>">
                <button type="submit" class="inscriptioninfocourriel">S'inscrire</button>
                <span class="aide-enligne"><?php echo $mailinfocourrielErreur ; ?></span>
            </form>
        </div>
    </section>
<!------------------------END SM BANNER------------------------------->
<!------------------------Start FOOTER------------------------------->

<footer class="section-p1">
        <div id="contact" class="col">
            <a href="#"><img class="logo" src="img-tarawih/logo-256.png" class="logo" alt=""></a>
            <h4>Contactez-Nous</h4>
            <p><strong>Adresse : </strong>Paris</p>
            <p><strong>Téléphone : </strong>07 86 02 69 24</p>
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


<!------------------------END FOOTER------------------------------->


<!------------------------SCRIPT FILES------------------------------->
    <script src="script.js"></script>
</body>

</html>