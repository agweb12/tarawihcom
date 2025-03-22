<?php
    require 'database_tarawih.php';

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Vue-du-livre</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Voir un livre</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="voiradminlivre">        
        <div class="pro-container admin">
            <div class="pro admin">
            <img src="<?php echo '../livres-tarawih/img-livre/' . $livres_tarawih['image_principale']; ?>" alt="<?php echo 'ﺍﻟﺘﺮﺍﻭﻳﺢ' . ' ' . $livres_tarawih['titre'] . ' le ' . $livres_tarawih['langue'] ; ?>">
                <div class="des admin">
                    <span><?php echo $livres_tarawih['langue']; ?></span>
                    <h5><?php echo $livres_tarawih['titre']; ?></h5>
                    <p>Auteur : <?php echo $livres_tarawih['auteur']; ?></p>
                    <p>Editeur : <?php echo $livres_tarawih['editeur']; ?></p>
                    <p>Langue : <?php echo $livres_tarawih['langue']; ?></p>
                    <p>Nb Page : <?php echo $livres_tarawih['nombre_de_page']; ?></p>
                    <p>Date Publication : <?php echo $livres_tarawih['date_publication']; ?></p>
                    <div class="star admin">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <button class="disponible admin"><?php echo $livres_tarawih['disponibilite'] ;?></button>
                    <div>
                    <a class="telechargeable admin" href="<?php echo $livres_tarawih['pdf_url'] ;?>" style="text-decoration: none;" target="_blank" download="<?php echo $livres_tarawih['slug'] . '.pdf';?>"><?php echo $livres_tarawih['disponibilitepdf'] ;?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>