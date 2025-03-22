<?php
    require '../admin/database_tarawih.php';

    if (!empty($_GET['id'])) {
        $id =  checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare('SELECT
        articles_tarawih.id,
        articles_tarawih.titre, 
        articles_tarawih.chapo, 
        articles_tarawih.image_principale,
        articles_tarawih.alt_text,
        articles_tarawih.photo_profil_auteur,
        articles_tarawih.auteur,
        articles_tarawih.date_publication,
        articles_tarawih.date_miseajour,
        articles_tarawih.sous_titre_1,
        articles_tarawih.p1,
        articles_tarawih.sous_titre_2,
        articles_tarawih.p2,
        articles_tarawih.sous_titre_3,
        articles_tarawih.p3,
        articles_tarawih.slug
        FROM articles_tarawih 
        WHERE articles_tarawih.id = ?');

    $statement->execute(array($id));
    $articles_tarawih = $statement->fetch();
    Database::disconnect();
    if($articles_tarawih['slug']!=$_GET['slug']) {
        header('location: /articles-tarawih/details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id']);
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
    <title><?php echo $articles_tarawih['titre'] ;?></title> 
    <meta name="description" content="<?php echo substr($articles_tarawih['chapo'], 0, 150) . ' [...]' ;?>" />
    <base href="/articles-tarawih/">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="<?php echo $articles_tarawih['titre'] ;?>">
    <meta property="og:title" content="<?php echo $articles_tarawih['titre'] ;?>" />
    <meta name="twitter:description" content="<?php echo substr($articles_tarawih['chapo'], 0, 150) . ' [...]' ;?>">
    <meta property="og:description" content="<?php echo substr($articles_tarawih['chapo'], 0, 150) . ' [...]' ;?>"/>
    <meta name="twitter:image" content="<?php echo 'https://tarawih.com/articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] ?>">
    <meta property="og:image" content="<?php echo 'https://tarawih.com/articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] ?>" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:type" content="article" />
    <meta property="article:published_time" content="<?php echo $articles_tarawih['date_publication']; ?>" />
    <meta property="article:modified_time" content="<?php echo $articles_tarawih['date_miseajour']; ?>" />
    <meta property="article:author" content="<?php echo $articles_tarawih['auteur'] ; ?>" />
    <meta property="og:url" content="<?php echo 'https://www.tarawih.com/articles-tarawih/details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'] ?>" />
    <link rel="image_src" href="<?php echo 'https://tarawih.com/articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] ?>">
    <link rel="canonical" href="<?php echo 'https://www.tarawih.com/articles-tarawih/details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'] ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-article-tarawih.css">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGFBG9D"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<!------------------------start HEADER------------------------------->
<section id="header">
    <a href="../accueil"><img src="logo-256.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
        <li><a href="../accueil">Accueil</a></li>
            <li><a href="../livres-priere-tarawih">Livres</a><i></i></li>
            <li class="active"><a href="../articles-priere-tarawih">Articles</a><i></i></li>
            <li><a href="../faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li><a href="<?php echo 'details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'] . '#contact' ;?>">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<!------------------------END HEADER------------------------------->
<!------------------------start DETAILS CHAQUE ARTICLES TARAWIH------------------------------->
    <article itemscope itemtype="https://schema.org/Article"  id="detailsarticletarawih">
        <div class="single-article-tarawih">
            <div class="sub-article-tarawih">
                <h1 itemprop="headline" ><?php echo $articles_tarawih['titre'] ?></h1>
                <h3 ><?php echo $articles_tarawih['id'] ?></h3>
            </div>
            <p itemprop="description"><?php echo $articles_tarawih['chapo'] ?></p>
        </div>
        <div class="link-article-tarawih" itemscope itemtype="https://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="breadcrumb-livre1" itemprop="item" href="https://www.tarawih.com/"><span itemprop="name">ACCUEIL</span></a>
                <meta itemprop="position" content="1"/>
            </div>/
            <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="breadcrumb-livre1" itemprop="item" href="../articles-tarawih"><span itemprop="name">ARTICLES <span itemprop="articleSection">TARAWIH</span></span></a>
                <meta itemprop="position" content="2"/>
            </div>/
            <div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo $articles_tarawih['titre'] ; ?></span>
                <meta itemprop="position" content="3" />
            </div>
        </div>
        <div class="subshare-article-tarawih">
            <a href="https://www.facebook.com/sharer.php?u=<?php echo 'https://www.tarawih.com/articles-tarawih/details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'];?>&t=<?php echo $articles_tarawih['titre'] ; ?>" target="_blank"><i class="fab fa-facebook"></i>Partager</a>
            <a href="https://t.me/share/url?url=<?php echo 'https://www.tarawih.com/articles-tarawih/details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'] ;?>&text=<?php echo $articles_tarawih['titre'] ; ?>" target="_blank"><i class="fab fa-telegram"></i>Partager</a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $articles_tarawih['titre'] ; ?>" target="_blank"><i class="fab fa-fab fa-twitter"></i>Partager</a>
        </div>
        <div class="img-article-tarawih" itemprop="image" itemscope itemtype="https://schema.org/ImageObject" >
            <img itemprop="image" src="<?php echo 'img-articles/' . $articles_tarawih['image_principale'] ; ?>" alt="<?php echo $articles_tarawih['alt_text'] ; ?>">
            <meta itemprop="url" content="<?php echo 'https://www.tarawih.com/articles-tarawih/img-articles/' . $articles_tarawih['image_principale'] ; ?>">
            <p><?php echo $articles_tarawih['alt_text'] ; ?></p>
        </div>
        <article class="content-article">
            <div class="content-article-tarawih">
                <div class="subauteur-article-tarawih" >
                    <p>Ecrit par 
                        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <span  itemprop="name">
                                <a itemprop="url" href="https://maamarmetmati.fr/presentation-maamar-metmati" target="_blank"><?php echo $articles_tarawih['auteur'] ; ?></a>
                            </span>
                        </span>
                    </p>
                    <meta itemprop="datePublished" content="<?php echo $articles_tarawih['date_publication']?>">
                    <p class="date-article-tarawih" itemprop="datePublished"><?php echo 'Publié le ' . date_format(date_create($articles_tarawih['date_publication']), "D d M Y") . ' à ' . date_format(date_create($articles_tarawih['date_publication']), "H:i") ; ?></p>
                    <meta itemprop="dateModified" content="<?php echo $articles_tarawih['date_miseajour']?>">
                    <p class="date-article-tarawih" itemprop="dateModified"><?php echo 'Mis à jour le ' . date_format(date_create($articles_tarawih['date_miseajour']), "D d M Y") . ' à ' . date_format(date_create($articles_tarawih['date_miseajour']), "H:i") ; ?></p>
                </div>
                <div class="content1-article-tarawih">
                    <span itemprop="articleBody">
                        <h2 class="soustitre1-article-tarawih"><?php echo $articles_tarawih['sous_titre_1'] ; ?></h2>
                        <p  class="paragraphe1-article-tarawih"><?php echo $articles_tarawih['p1'] ; ?></p>
                    </span>
                </div>
            </div>
            <section class="quelquesarticles-tarawih">
                <section class="pro-containerquelquesarticles">
                <?php 
                    $db = Database::connect();
                    $statement = $db->query('SELECT
                    articles_tarawih.id,
                    articles_tarawih.slug,
                    articles_tarawih.titre, 
                    articles_tarawih.auteur, 
                    articles_tarawih.chapo, 
                    articles_tarawih.image_principale,
                    articles_tarawih.date_miseajour
                    FROM articles_tarawih
                    ORDER BY RAND()
                    LIMIT 3
                    ');
                    while ($articles_tarawih = $statement->fetch())
                    {
                        $slug_articles = 'details-articles/' . $articles_tarawih['slug'] . '-' . $articles_tarawih['id'];
                        echo    '<div class="proquelquesarticles">'; 
                        echo    '<img src="img-articles/' . $articles_tarawih['image_principale'] . '" onclick="lienVersLivre()" alt="' . $articles_tarawih['titre'] . ' écrit par ' . $articles_tarawih['auteur'] . '">';
                        echo    '<h5>' . $articles_tarawih['titre'] . '</h5><br>';
                        echo    '<span class="datemiseajourarticle">Mis à jour le ' . date_format(date_create($articles_tarawih['date_miseajour']), "d/m/Y") . ' à ' . date_format(date_create($articles_tarawih['date_miseajour']), "H:i") . '<span><br>';
                        echo    '<span class="chapoarticle">' . substr($articles_tarawih['chapo'], 0, 30) . ' [...]</span>';
                        echo    '<h4><a class ="lirearticle" href="'. $slug_articles . '" style="color: white; text-decoration : none;">LIRE</a><i></i></h4>';
                        echo    '</div>';
                    }
                    Database::disconnect();
                ?>
                </section>
            </section>
        </article>
        <meta itemprop="url" content="<?php echo 'https://tarawih.com/articles-tarawih/details-articles/'. $articles_tarawih['slug'] ?>">
        <span itemprop="publisher" itemscope itemptype="http://schema.org/Organization">
            <meta itemprop="name" content="Maamar Metmati">
        </span>
    </article>

<!------------------------END DETAILS CHAQUE ARTICLES TARAWIH------------------------------->
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
            <a><img class="logo" src="logo-256.png" class="logo" alt=""></a>
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
    <script src="../script.js"></script>
</body>
</html>
