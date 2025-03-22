<?php
    require '../admin/database_tarawih.php';

    if (!empty($_GET['id'])) {
        $id =  checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT
    livres_tarawih.id, 
    livres_tarawih.langue, 
    livres_tarawih.titre, 
    livres_tarawih.auteur, 
    livres_tarawih.editeur, 
    livres_tarawih.nombre_de_page, 
    livres_tarawih.date_publication, 
    livres_tarawih.resumes, 
    livres_tarawih.image_principale, 
    livres_tarawih.pdf_url, 
    livres_tarawih.slug,
    livres_disponible.nom_disponibilite AS disponibilite, 
    livres_downloadable.statut_pdf AS disponibilitepdf
    FROM livres_tarawih 
    LEFT JOIN livres_disponible ON livres_tarawih.disponibilite = livres_disponible.id
    LEFT JOIN livres_downloadable ON livres_tarawih.disponibilitepdf = livres_downloadable.id
    WHERE livres_tarawih.id = ?');

    $statement->execute(array($id));
    $livres_tarawih = $statement->fetch();
    Database::disconnect();
    if($livres_tarawih['slug']!=$_GET['slug']) {
        header('location: /livres-tarawih/details-livre/' . $livres_tarawih['slug'] . '-' . $livres_tarawih['id']);
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
    <!-- Twitter conversion tracking base code -->
    <script>
    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
    a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
    twq('config','okb95');
    </script>
    <!-- End Twitter conversion tracking base code -->
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
    <title><?php echo $livres_tarawih['titre'] . ' | Livre Innovation' ;?></title> 
    <meta name="description" content="<?php echo substr($livres_tarawih['resumes'], 0, 150) . ' [...]' ;?>" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="<?php echo $livres_tarawih['titre'] ;?>">
    <meta property="og:title" content="<?php echo $livres_tarawih['titre'] ;?>" />
    <meta name="twitter:description" content="<?php echo substr($livres_tarawih['resumes'], 0, 150) . ' [...]' ;?>">
    <meta property="og:description" content="<?php echo substr($livres_tarawih['resumes'], 0, 150) . ' [...]' ;?>"/>
    <meta name="twitter:image" content="<?php echo '../img-livre/' . $livres_tarawih['image_principale']; ?>">
    <meta property="og:image" content="<?php echo '../img-livre/' . $livres_tarawih['image_principale']; ?>" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:type" content="article" />
    <meta property="article:published_time" content="<?php echo $livres_tarawih['date_publication']; ?>" />
    <meta property="article:modified_time" content="<?php echo $livres_tarawih['date_miseajour']; ?>" />
    <meta property="article:author" content="<?php echo $livres_tarawih['auteur'] ; ?>" />
    <meta property="og:url" content="<?php echo 'https://www.tarawih.com/livres-tarawih/details-livre/' . $livres_tarawih['slug'] . '-' . $livres_tarawih['id']; ?>" />
    <link rel="image_src" href="<?php echo '../img-livre/' . $livres_tarawih['image_principale']; ?>">
    <link rel="canonical" href="<?php echo 'https://www.tarawih.com/livres-tarawih/details-livre/' . $livres_tarawih['slug'] . '-' . $livres_tarawih['id']; ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../../favicon.ico">
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
        <li><a href="../../index.php">Accueil</a></li>
            <li class="active"><a href="../../livres-priere-tarawih">Livres</a><i></i></li>
            <li><a href="../../articles-priere-tarawih">Articles</a><i></i></li>
            <li><a href="../../faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li><a href="<?php echo $livres_tarawih['slug'] . '-' . $livres_tarawih['id'] . '#contact' ;?>">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<!------------------------END HEADER------------------------------->
<!------------------------start DETAILS CHAQUE LIVRE TARAWIH------------------------------->

    <div id="pagedulivre" style='background-image: url("<?php echo '../img-livre/' . $livres_tarawih['image_principale'];?>")'  class="container-fluid">
    <h1><?php echo $livres_tarawih['titre'] ; ?></h1>
        <p class="sub3">Télécharge-le ou Commande-le !</p>
    </div>
    <section itemscope itemtype="https://schema.org/Book" id="detailslivretarawih" class="section-p1">
        <div class="linksite-breadlivre">
            <div class="breadcrumb-livre" class="" itemscope itemtype="https://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a class="breadcrumb-livre1" itemprop="item" href="https://www.tarawih.com/" style="text-decoration:none"><span itemprop="name">ACCUEIL</span></a>
                <meta itemprop="position" content="1"/>
                </div>/
                <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">   
                    <a class="breadcrumb-livre1" itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="../../livres-priere-tarawih" href="../../livres-priere-tarawih" style="text-decoration:none"><span itemprop="name">LIVRES TARAWIH</span></a>
                <meta itemprop="position" content="2" />
                </div>/
                <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php echo $livres_tarawih['titre'] ; ?></span>
                    <meta itemprop="position" content="3" />
                </div>
            </div>
            <div class="single-pro-image">
                <img itemprop="image" src="<?php echo '../img-livre/' . $livres_tarawih['image_principale'] ;?>" width="100%" id="MainImg" alt="">
            </div>
        </div>
        <div class="single-pro-details">
            <h4 itemprop="name"><?php echo $livres_tarawih['titre'] ; ?></h4>
            <div>
                <span  itemprop ="offers" itemscope itemtype = "https://schema.org/Offer">
                    <h2><span itemprop="price">0 €</span> <strong>GRATUIT</strong></h2>
                    <meta itemprop="priceCurrency" content = "EUR" />
            <?php
            if($livres_tarawih['disponibilite'] == 'Commander le livre papier')
                    echo    '<a itemprop="availability" href="commande-livre"><button class="disponible" >'. $livres_tarawih['disponibilite'] . '</button></a>';
                else
                    echo    '<a itemprop="availability" href=""><button class="indisponible" >'. $livres_tarawih['disponibilite'] . '</button></a>';

                if($livres_tarawih['disponibilitepdf'] == 'Telecharger le livre PDF')
                    echo    '<div><a itemprop="availability" class="telechargeable" href="/../../' . $livres_tarawih['pdf_url'] . '" style="text-decoration: none;" target="_blank" download="/../../' . $livres_tarawih['pdf_url'] . '">' . $livres_tarawih['disponibilitepdf'] . '</a></div>';
                else 
                    echo    '<div><a itemprop="availability" class="nontelechargeable"  href="" style="text-decoration: none;">' . $livres_tarawih['disponibilitepdf'] . '</a></div>';
            ?>
                </span>
            </div>
            <h4>Détails du produit</h4>
            <p>Auteur : <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop ="name"><?php echo $livres_tarawih['auteur'] ; ?></span></span></p>
            <p>Editeur : <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><span itemprop ="publisher"><?php echo $livres_tarawih['editeur'] ; ?></span></span></p>
            <p>Langue : <span itemprop="inLanguage"><?php echo $livres_tarawih['langue'] ; ?></span></p>
            <p>Nombre de page : <span itemprop="numberOfPages"><?php echo $livres_tarawih['nombre_de_page'] ; ?></span></p>
            <p>Date de Publication : <span itemprop="datePublished" content="<?php echo $livres_tarawih['date_publication'] ; ?>"><?php echo $livres_tarawih['date_publication'] ; ?></span></p>
            <p>Résumé : <br><span itemprop="abstract" style="text-decoration: none"><?php echo $livres_tarawih['resumes'] ; ?></span></p>
        </div>
        <meta itemprop="genre" content="Islam">
    </section>
    <section id="deslivrestarawih">
        <div class="pro-container-deslivrestarawih">
        <?php

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
                $slug_livres = $livres_tarawih['slug'] . '-' . $livres_tarawih['id'];
                echo    '<div id ="lienverslivre" class="pro-deslivrestarawih">';
                echo    '<img src="../img-livre/' . $livres_tarawih['image_principale'] . '" alt="le livre ' . $livres_tarawih['titre'] . 'La prière de Tarawih en' . $livres_tarawih['langue'] . '">';
                echo    '<div class="des-deslivrestarawih">';
                echo    '<span style="text-transform:uppercase;">' . $livres_tarawih['langue'] . '</span>';
                echo    '<h5>' . $livres_tarawih['titre'] . '</h5>';
                echo    '<span>' . $livres_tarawih['auteur'] . '</span>';
                if($livres_tarawih['disponibilite'] == 'Commander le livre papier')
                    echo    '<a href="'. $slug_livres . '"><button class="disponible1" >'. $livres_tarawih['disponibilite'] . '</button></a>';
                else
                    echo    '<a href="'. $slug_livres . '"><button class="indisponible1" >'. $livres_tarawih['disponibilite'] . '</button></a>';

                if($livres_tarawih['disponibilitepdf'] == 'Telecharger le livre PDF')
                    echo    '<div><a class="telechargeable1" href="/../../' . $livres_tarawih['pdf_url'] . '" style="text-decoration: none;" target="_blank" download="/../../' . $livres_tarawih['pdf_url'] . '">' . $livres_tarawih['disponibilitepdf'] . '</a></div>';
                else 
                    echo    '<div><a class="nontelechargeable1" href="" style="text-decoration: none;" >' . $livres_tarawih['disponibilitepdf'] . '</a></div>';

                echo    '</div></div>';
            }
            Database::disconnect();
        ?>
            
        </div>
    </section>
    
<!------------------------END DETAILS CHAQUE LIVRE TARAWIH------------------------------->
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

<!------------------------END SM BANNER------------------------------->
<!------------------------Start FOOTER------------------------------->

    <footer class="section-p1">
        <div id="contact" class="col">
            <a href="#"><img class="logo" src="../logo-256.png" class="logo" alt=""></a>
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


<!------------------------END FOOTER------------------------------->




<!------------------------SCRIPT FILES------------------------------->
   
    <script src="../script.js"></script>
</body>
</html>