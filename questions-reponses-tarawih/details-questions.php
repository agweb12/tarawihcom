<?php
    require '../admin/database_tarawih.php';

    if (!empty($_GET['id'])) {
        $id =  checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT
    questions_reponses_tarawih.id, 
    questions_reponses_tarawih.question, 
    questions_reponses_tarawih.reponse,
    questions_reponses_tarawih.slug 
    FROM questions_reponses_tarawih 
    WHERE questions_reponses_tarawih.id = ?');

    $statement->execute(array($id));
    $questions_reponses_tarawih = $statement->fetch();
    Database::disconnect();

    if($questions_reponses_tarawih['slug']!=$_GET['slug']) {
        header('location: /questions-reponses-tarawih/details-faq/' . $questions_reponses_tarawih['slug'] . '-' . $questions_reponses_tarawih['id']);
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
<html lang="fr" itemscope itemtype="https://schema.org/FAQPage">
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
<script src="https://cdn.by.wonderpush.com/sdk/1.1/wonderpush-loader.min.js" async></script>
    <script>
    window.WonderPush = window.WonderPush || [];
    WonderPush.push(["init", {
        webKey: "a4eb9f863260138a027d6bb893163db7f6bdd5cff6282c36bf1183e9a99b9a36",
    }]);
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
        fbq('init', '1276286509617166');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1276286509617166&ev=PageView&noscript=1"/></noscript>
<!-- End Meta Pixel Code -->
    <!-- Meta Head -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $questions_reponses_tarawih['question'] ;?></title>
    <meta name="description" content="<?php echo substr($questions_reponses_tarawih['reponse'], 0, 150) . ' [...]' ;?>" />
    <base href="/questions-reponses-tarawih/">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MaamarMetmati">
    <meta name="twitter:creator" content="@MaamarMetmati">
    <meta name="twitter:title" content="<?php echo $questions_reponses_tarawih['question'] ;?>">
    <meta property="og:title" content="<?php echo $questions_reponses_tarawih['question'] ;?>" />
    <meta name="twitter:description" content="<?php echo substr($questions_reponses_tarawih['reponse'], 0, 150) . ' [...]' ;?>">
    <meta property="og:description" content="<?php echo substr($questions_reponses_tarawih['reponse'], 0, 150) . ' [...]' ;?>"/>
    <meta name="twitter:image" content="<?php echo 'https://tarawih.com/questions-reponses-tarawih/logo-256.png' ?>">
    <meta property="og:image" content="<?php echo 'https://tarawih.com/questions-reponses-tarawih/logo-256.png' ?>" />
    <meta property="og:site_name" content="Tarawih"/>
    <meta property="og:url" content="<?php echo 'https://www.tarawih.com/questions-reponses-tarawih/details-faq/' . $questions_reponses_tarawih['slug'] . '-' . $questions_reponses_tarawih['id'] ?>" />
    <link rel="image_src" href="<?php echo 'https://tarawih.com/questions-reponses-tarawih/logo-256.png' ?>">
    <link rel="canonical" href="<?php echo 'https://www.tarawih.com/questions-reponses-tarawih/details-faq/' . $questions_reponses_tarawih['slug'] . '-' . $questions_reponses_tarawih['id'] ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="style-question-tarawih.css">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGFBG9D"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<!------------------------start HEADER------------------------------->
<section id="header">
    <a href="../faq-priere-tarawih"><img src="logo-256.png" class="logo" alt=""></a>
    <div>
    <ul id="navbar">
            <li><a href="../accueil">Accueil</a></li>
            <li><a href="../livres-priere-tarawih">Livres</a><i></i></li>
            <li><a href="../articles-priere-tarawih">Articles</a><i></i></li>
            <li class="active"><a href="../faq-priere-tarawih">FAQ Tarawih</a><i></i></li>
            <li><a href="<?php echo 'details-faq/' . $questions_reponses_tarawih['slug'] . '-' . $questions_reponses_tarawih['id'] . '#contact' ;?>">Contactez-Nous</a><i></i></li>
            <a id="close"><i class="fa fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<!------------------------END HEADER------------------------------->
<!------------------------start DETAILS CHAQUE QUESTION TARAWIH------------------------------->

    <section id="detailsquestiontarawih">
        <div class="single-question-tarawih" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="sub-question-tarawih">
                <h3><?php echo $questions_reponses_tarawih['id'] ?></h3>
                <h1 itemprop="name"><?php echo $questions_reponses_tarawih['question'] ?></h1>
            </div>
                <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text">
                        <p><?php echo $questions_reponses_tarawih['reponse'] ?></p>
                    </div>
                </div>
        </div>
    </section>

<!------------------------END DETAILS CHAQUE QUESTION TARAWIH------------------------------->
 
    <section id="pagefaq-tarawih" class="section-p1">
        <div class="pro-containerpagefaq">
                <?php 
                    $db = Database::connect();
                    $statement = $db->query('SELECT
                    questions_reponses_tarawih.id, 
                    questions_reponses_tarawih.question, 
                    questions_reponses_tarawih.reponse,
                    questions_reponses_tarawih.slug
                    FROM questions_reponses_tarawih
                    ORDER BY RAND()
                    LIMIT 5
                    ');
                    while ($questions_reponses_tarawih = $statement->fetch())
                    {
                        $slug_faq = 'details-faq/' . $questions_reponses_tarawih['slug'] . '-' . $questions_reponses_tarawih['id'];

                        echo    '<div class="pageprofaq">';    
                        echo    '<h3>' . $questions_reponses_tarawih['id'] . '</h3>';
                        echo    '<div class="des">';
                        echo    '<h5>' . $questions_reponses_tarawih['question'] . '</h5><br>';
                        echo    '<span>' . substr($questions_reponses_tarawih['reponse'], 0, 75) . ' [...]</span>';
                        echo    '<a href="' . $slug_faq . '"><div class="savoir"><i></i><button>Savoir</button></div></a>';
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