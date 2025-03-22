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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <title>Articles | Tout sur la prière de Tarawih | Islam Innovation</title>
    <meta name="description" content="Lire tous nos articles sur la prière de Tarawih, une innovation dans l'Islam. Des explications, des réfutations précises de livres et discours officiels concernant cette prière." />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="Articles | Tout sur la prière de Tarawih | Islam Innovation">
    <meta property="og:title" content="Articles | Tout sur la prière de Tarawih | Islam Innovation" />
    <meta name="twitter:description" content="Lire tous nos articles sur la prière de Tarawih, une innovation dans l'Islam. Des explications, des réfutations précises de livres et discours officiels concernant cette prière.">
    <meta property="og:description" content="Lire tous nos articles sur la prière de Tarawih, une innovation dans l'Islam. Des explications, des réfutations précises de livres et discours officiels concernant cette prière."/>
    <meta name="twitter:image" content="https://tarawih.com/img-tarawih/articles-tarawih.png">
    <meta property="og:image" content="https://tarawih.com/img-tarawih/articles-tarawih.png" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.tarawih.com/articles-priere-tarawih" />
    <link rel="image_src" href="https://tarawih.com/img-tarawih/articles-tarawih.png">
    <link rel="canonical" href="https://www.tarawih.com/articles-priere-tarawih">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="">
    <link rel="apple-touch-icon" href="tarawih-apple-touch-icon.png">
    <link rel="android-chrome" href="tarawih-android-chrome-192x192.png">
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
            <li><a href="livres-priere-tarawih">Livres</a><i></i></li>
            <li class="active"><a href="#">Articles</a><i></i></li>
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
<div id="pagearticles" class="container-fluid">
    <h1>Nos articles sur la prière de Tarawih</h1>
    <p>Histoire de la prière de Tarawih - <br>Réfutations des livres de plusieurs imams sur les Tarawih - <br>Réfutations des discours officiels sur la prière de Tarawih</p>
    <p class="sub2">À Lire et à Partager absolument !</p>
</div>
<section id="articletarawih-alaune" class="section-article">
<?php
        $db = Database::connect();
        $statement = $db->query('SELECT
        articles_tarawih.id,
        articles_tarawih.slug,
        articles_tarawih.titre, 
        articles_tarawih.chapo, 
        articles_tarawih.image_principale,
        articles_tarawih.auteur,
        articles_tarawih.date_publication
        FROM articles_tarawih
        ORDER BY date_publication DESC
        LIMIT 1
        ');
        while ($articles_tarawih = $statement->fetch())
        {
            $slug_articles = "articles-tarawih/details-articles/" . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'];
            echo '<div class="section-a1">';
            echo '<h2 class="texth2">LE DERNIER ARTICLE SUR LE TARAWIH</h2>';
            echo '<h2>' . $articles_tarawih['titre'] . '</h2>';
            echo '<span>Publié le ' . date_format(date_create($articles_tarawih['date_publication']), "d/m/Y") . ' à ' . date_format(date_create($articles_tarawih['date_publication']), "H:i") . '</span>';
            echo '<span class="chapo-article">' . $articles_tarawih['chapo'] . ' [...]</span>';
            echo '<a style="text-decoration:none; color:white" href="'. $slug_articles . '">LIRE</a>';
            echo '</div>';
        }
        Database::disconnect();
?>
</section>

<section id="pagearticles-tarawih" class="section-p1">
    <div class="pro-containerpagearticles">
    <?php 


        $db = Database::connect();
        $statement = $db->query('SELECT
        articles_tarawih.id,
        articles_tarawih.slug,
        articles_tarawih.titre, 
        articles_tarawih.chapo, 
        articles_tarawih.image_principale,
        articles_tarawih.auteur,
        articles_tarawih.date_publication
        FROM articles_tarawih
        ORDER BY date_publication DESC
        ');
        while ($articles_tarawih = $statement->fetch())
        {
            $slug_articles = "articles-tarawih/details-articles/" . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'];
            echo    '<div class="propagearticles">'; 
            echo    '<div class="des">';
            echo    '<div class="img-block">';
            echo    '<img class="img-articles-textuel" src="articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] . '" alt="' . $articles_tarawih['titre'] . ' écrit par ' . $articles_tarawih['auteur'] . '"">';
            echo    '</div>';
            echo    '<div class="subdes">';
            echo    '<h5>' . $articles_tarawih['titre'] . '</h5>';
            echo    '<span class="auteurarticle">' . $articles_tarawih['auteur'] . '<span><br>';
            echo    '<span class="datepublicationarticle">Publié le ' . date_format(date_create($articles_tarawih['date_publication']), "d/m/Y") . ' à ' . date_format(date_create($articles_tarawih['date_publication']), "H:i") . '<span><br>';

            echo    '<span>' . substr($articles_tarawih['chapo'], 0, 70) . ' [...]</span></div></div>';
            echo    '<h4><a href="'. $slug_articles . '" style="color: white; text-decoration : none;">LIRE</a><i></i></h4>';
            echo    '</div>';
        }
        Database::disconnect();
?>
    </div>
</section>      

<!------------------------END TOUS LES LIVRES TARAWIH ------------------------------->
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