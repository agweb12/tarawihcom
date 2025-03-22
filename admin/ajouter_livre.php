<?php
    require 'database_tarawih.php';

    $titrelivreErreur = $auteurlivreErreur = $editeurlivreErreur = $languelivreErreur = $nbpagelivreErreur = $imageprincipalelivreErreur = $datepublicationlivreErreur = $resumelivreErreur = $disponibilitepdfErreur = $disponibiliteErreur = 
    $titreLivre = $auteurLivre = $editeurLivre = $langueLivre = $nbpageLivre = $imageprincipaleLivre = $datepublicationLivre = $resumeLivre = $disponibilitepdfLivre = $disponibiliteLivre = $urlLivre = ""; 

    if (!empty($_POST)) 
    {
        $titreLivre                         = checkInput($_POST['titrelivre']);
        $auteurLivre                        = checkInput($_POST['auteurlivre']);
        $editeurLivre                       = checkInput($_POST['editeurlivre']);
        $langueLivre                        = checkInput($_POST['languelivre']);
        $nbpageLivre                        = checkInput($_POST['nbpagelivre']);
        $imageprincipaleLivre               = checkInput($_FILES['imageprincipalelivre']['name']);
        $imageprincipaleLivrePath           = '../livres-tarawih/img-livre/' . basename($imageprincipaleLivre);
        $imageprincipaleLivreExtension      = pathinfo($imageprincipaleLivrePath, PATHINFO_EXTENSION);
        $datepublicationLivre               = checkInput($_POST['datepublicationlivre']);
        $resumeLivre                        = checkInput($_POST['resumelivre']);
        $disponibilitepdfLivre              = checkInput($_POST['disponibilitepdf']);
        $disponibiliteLivre                 = checkInput($_POST['disponibilite']);
        $urlLivre                           = checkInput($_POST['urllivre']);
        $estValide                          = true;
        $estUploadValide                    = false;

        if(empty($titreLivre))
        {
            $titrelivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($auteurLivre))
        {
            $auteurlivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($editeurLivre))
        {
            $editeurlivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($langueLivre))
        {
            $languelivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($nbpageLivre))
        {
            $nbpagelivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($imageprincipaleLivre))
        {
            $imageprincipalelivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        else
        {
            $estUploadValide = true;
            if($imageprincipaleLivreExtension != "jpg" && $imageprincipaleLivreExtension != "png" && $imageprincipaleLivreExtension != "jpeg" && $imageprincipaleLivreExtension != "gif")
            {
                $imageprincipalelivreErreur = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $estUploadValide            = false;
            }
            if(file_exists($imageprincipaleLivrePath))
            {
                $imageprincipalelivreErreur = "Le fichier existe déjà";
                $estUploadValide            = false;
            }
            if($_FILES['imageprincipalelivre']['size'] > 700000)
            {
                $imageprincipalelivreErreur = "Le fichier ne doit pas dépasser les 700Kb (0.7Mo)";
                $estUploadValide            = false;
            }
            if($estUploadValide)
            {
                if(!move_uploaded_file($_FILES['imageprincipalelivre']['tmp_name'], $imageprincipaleLivrePath))
                {
                    $imageprincipalelivreErreur = "Il y a eu une erreur lors de l'upload";
                    $estUploadValide            = false;
                }
            }
        }
        if(empty($datepublicationLivre))
        {
            $datepublicationlivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($resumeLivre))
        {
            $resumelivreErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($disponibiliteLivre))
        {
            $disponibilitepdfErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($urlLivre))
        {
            $urlLivreErreur = '';
            $estValide        = true;
        }
        if($estValide && $estUploadValide)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO livres_tarawih (titre, auteur, editeur, langue, nombre_de_page, image_principale, pdf_url, disponibilitepdf,disponibilite, date_publication, resumes) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $statement->execute(array($titreLivre,$auteurLivre,$editeurLivre,$langueLivre,$nbpageLivre,$imageprincipaleLivre,$urlLivre,$disponibilitepdfLivre,$disponibiliteLivre,$datepublicationLivre,$resumeLivre));
            Database::disconnect();
            header("Location: index.php");
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Ajouter-un-livre</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Ajouter un livre</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="ajouterlivreadmin">   
        <form class="form-ajouterlivre" role="form" action="ajouter_livre.php" method="post" enctype="multipart/form-data">
            <div class="form-groupeajouterlivre">
                <label for="titrelivre">Titre</label>
                <input class="form-livre" id="titrelivre" name="titrelivre" placeholder="Entrer le titre" value="<?php echo $titreLivre ; ?>" type="text">
                <span class="aide-enligne"><?php echo $titrelivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="auteurlivre">Auteur</label>
                <input class="form-livre" id="auteurlivre" name="auteurlivre" placeholder="Entrer l'auteur" value="<?php echo $auteurLivre ; ?>" type="text">
                <span class="aide-enligne"><?php echo $auteurlivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="editeurlivre">Editeur</label>
                <input class="form-livre" id="editeurlivre" name="editeurlivre" placeholder="Entrer l'éditeur" value="<?php echo $editeurLivre ; ?>" type="text">
                <span class="aide-enligne"><?php echo $editeurlivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="languelivre">Langue</label>
                <input class="form-livre" id="languelivre" name="languelivre" placeholder="Entrer la langue" value="<?php echo $langueLivre ; ?>" type="text">
                <span class="aide-enligne"><?php echo $languelivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="nbpagelivre">Nombre de Page</label>
                <input class="form-livre" id="nbpagelivre" name="nbpagelivre" placeholder="Entrer le nombre de page" value="<?php echo $nbpageLivre ; ?>" type="number" step="1">
                <span class="aide-enligne"><?php echo $nbpagelivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre"> 
                <label for="imageprincipalelivre">Image Principale</label>
                <input type="file" id="imageprincipalelivre" name="imageprincipalelivre" value="<?php echo $imageprincipaleLivre ;?>">
                <span class="aide-enligne"><?php echo $imageprincipalelivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="datepublicationlivre">Date de Publication</label>
                <input type="date" id="datepublicationlivre" name="datepublicationlivre" value="<?php echo $datepublicationLivre?>">
                <span class="aide-enligne"><?php echo $datepublicationlivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="resumelivre" id="resumelivre">Résumé</label>
                <textarea class="form-livre" name="resumelivre" id="resumelivre" placeholder="Entrer le résumé du livre" value="<?php echo $resumeLivre ;?>" cols="30" rows="10"></textarea>
                <span class="aide-enligne"><?php echo $resumelivreErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="disponibilite">Disponibilité Livre Papier</label>
                <select class="form-livre" name="disponibilite" id="disponibilite">
                    <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM livres_disponible') as $row)
                        {
                            echo '<option id="disponibilite" value="' . $row['id'] . '">' . $row['nom_disponibilite'] . '</option>';
                        }
                        Database::disconnect();
                    ?>
                </select>
                <span class="aide-enligne"><?php echo $disponibiliteErreur ; ?></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="disponibilitepdf">Disponibilité Livre Electronique</label>
                <select class="form-livre" name="disponibilitepdf" id="disponibilitepdf">
                <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM livres_downloadable') as $row)
                        {
                            echo '<option id="disponibilitepdf" value="' . $row['id'] . '">' . $row['statut_pdf'] . '</option>';
                        }
                        Database::disconnect();
                    ?>
                </select>
                <span class="aide-enligne"></span>
            </div>
            <div class="form-groupeajouterlivre">
                <label for="urllivre">URL du livre</label>
                <input class="form-livre" id="urllivre" name="urllivre" placeholder="Entrer l'URL du livre électronique" value="<?php echo $urlLivre ; ?>" type="text">
            </div>
            <div>
                <button type="submit" class="submit-livre">AJOUTER</button>
            </div>
        </form>
            

    </section>
</body>

</html>

