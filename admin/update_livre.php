<?php
    require 'database_tarawih.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $titrelivreErreur = $auteurlivreErreur = $editeurlivreErreur = $languelivreErreur = $nbpagelivreErreur = $imageprincipalelivreErreur = $datepublicationlivreErreur = $resumelivreErreur = $disponibilitepdfErreur = $disponibiliteErreur 
    = $titreLivre = $auteurLivre = $langueLivre = $nbpageLivre = $imageprincipaleLivre = $datepublicationLivre = $resumeLivre = $disponibilitepdfLivre = $disponibiliteLivre = $urlLivre = "";
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
            $imageprincipalelivreUpdated = false;
        }
        else
        {
            $imageprincipalelivreUpdated = true;
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
            $disponibiliteErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($disponibilitepdfLivre))
        {
            $disponibilitepdfErreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(($estValide && $imageprincipalelivreUpdated && $estUploadValide) || ($estValide && !$imageprincipalelivreUpdated))
        {
            $db = Database::connect();
            if($imageprincipalelivreUpdated)
            {
                $statement = $db->prepare("UPDATE livres_tarawih set 
                livres_tarawih.titre = ?, 
                livres_tarawih.auteur = ?,
                livres_tarawih.editeur = ?,
                livres_tarawih.langue = ?, 
                livres_tarawih.nombre_de_page = ?, 
                livres_tarawih.image_principale = ?, 
                livres_tarawih.pdf_url = ?, 
                livres_tarawih.disponibilitepdf = ?,
                livres_tarawih.disponibilite = ?
                livres_tarawih.date_publication = ?, 
                livres_tarawih.resumes = ?
                WHERE livres_tarawih.id = ?");
                $statement->execute(array($titreLivre,$auteurLivre,$editeurLivre,$langueLivre,$nbpageLivre,$imageprincipaleLivre,$urlLivre,$disponibilitepdfLivre,$disponibiliteLivre,$datepublicationLivre,$resumeLivre,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE livres_tarawih set 
                livres_tarawih.titre = ?, 
                livres_tarawih.auteur = ?,
                livres_tarawih.editeur = ?, 
                livres_tarawih.langue = ?, 
                livres_tarawih.nombre_de_page = ?, 
                livres_tarawih.pdf_url = ?, 
                livres_tarawih.disponibilitepdf = ?,
                livres_tarawih.disponibilite = ?,
                livres_tarawih.date_publication = ?, 
                livres_tarawih.resumes = ?                
                WHERE livres_tarawih.id = ?");
                $statement->execute(array($titreLivre,$auteurLivre,$editeurLivre,$langueLivre,$nbpageLivre,$urlLivre,$disponibilitepdfLivre,$disponibiliteLivre,$datepublicationLivre,$resumeLivre,$id));
            }
            Database::disconnect();
            header("Location: index.php");
        }
        else if($imageprincipalelivreUpdated && !$estUploadValide)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT livres_tarawih.image_principale FROM livres_tarawih WHERE livres_tarawih.id = ?");
            $statement->execute(array($id));
            $livres_tarawih = $statement->fetch();
            $imageprincipaleLivre = $livres_tarawih['image_principale'];
            Database::disconnect();
        }
    }
    else
    {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM livres_tarawih WHERE livres_tarawih.id = ?");
            $statement->execute(array($id));
            $livres_tarawih = $statement->fetch();
            $titreLivre                     = $livres_tarawih['titre'];
            $auteurLivre                    = $livres_tarawih['auteur'];
            $editeurLivre                   = $livres_tarawih['editeur'];
            $langueLivre                    = $livres_tarawih['langue'];
            $nbpageLivre                    = $livres_tarawih['nombre_de_page'];
            $imageprincipaleLivre           = $livres_tarawih['image_principale'];
            $datepublicationLivre           = $livres_tarawih['date_publication'];
            $resumeLivre                    = $livres_tarawih['resumes'];
            $disponibilitepdfLivre          = $livres_tarawih['disponibilitepdf'];
            $disponibiliteLivre             = $livres_tarawih['disponibilite'];
            $urlLivre                       = $livres_tarawih['pdf_url'];

            Database::disconnect();
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
    <title>Admin Modifier-un-livre</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Modifier un livre</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="modifierlivreadmin"> 
                    <form class="form-modifierlivre" role="form" action="<?php echo 'update_livre.php?id=' . $id ; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-groupemodifierlivre">
                            <label for="titrelivre">Titre</label>
                            <input class="form-livre" id="titrelivre" name="titrelivre" placeholder="Entrer le titre" value="<?php echo $titreLivre ; ?>" type="text">
                            <span class="aide-enligne"><?php echo $titrelivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="auteurlivre">Auteur</label>
                            <input class="form-livre" id="auteurlivre" name="auteurlivre" placeholder="Entrer l'auteur" value="<?php echo $auteurLivre ; ?>" type="text">
                            <span class="aide-enligne"><?php echo $auteurlivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="editeurlivre">Editeur</label>
                            <input class="form-livre" id="editeurlivre" name="editeurlivre" placeholder="Entrer l'éditeur" value="<?php echo $editeurLivre ; ?>" type="text">
                            <span class="aide-enligne"><?php echo $editeurlivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="languelivre">Langue</label>
                            <input class="form-livre" id="languelivre" name="languelivre" placeholder="Entrer la langue" value="<?php echo $langueLivre ; ?>" type="text">
                            <span class="aide-enligne"><?php echo $languelivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="nbpagelivre">Nombre de Page</label>
                            <input class="form-livre" id="nbpagelivre" name="nbpagelivre" placeholder="Entrer le nombre de page" value="<?php echo $nbpageLivre ;?>" type="number" step="1">
                            <span class="aide-enligne"><?php echo $nbpagelivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre" id="fichierimagelivre"> 
                            <label for="">Image</label>
                            <p><?php echo $imageprincipaleLivre; ?></p>
                            <label id="labelfichierimage"for="imageprincipalelivre">Sélectionner une Image Principale</label>
                            <input type="file" id="imageprincipalelivre" name="imageprincipalelivre" value="<?php echo $imageprincipaleLivre ;?>">
                            <span class="aide-enligne"><?php echo $imageprincipalelivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="datepublicationlivre">Date de Publication</label>
                            <input type="date" id="datepublicationlivre" name="datepublicationlivre" value="<?php echo $datepublicationLivre ;?>">
                            <span class="aide-enligne"><?php echo $datepublicationlivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="resumelivre" id="resumelivre">Résumé</label>
                            <textarea class="form-livre" name="resumelivre" id="resumelivre" placeholder="Entrer le résumé du livre" value="<?php echo $resumeLivre ;?>" cols="30" rows="10"><?php echo $resumeLivre ;?></textarea>
                            <span class="aide-enligne"><?php echo $resumelivreErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="disponibilite">Disponibilité Livre Papier</label>
                            <select class="form-livre" name="disponibilite" id="disponibilite">
                                <?php
                                    $db = Database::connect();
                                    foreach($db->query('SELECT * FROM livres_disponible') as $row)
                                    {
                                        if($row['id'] == $disponibiliteLivre)
                                            echo '<option selected="selected" id="disponibilite" value="' . $row['id'] . '">' . $row['nom_disponibilite'] . '</option>';
                                        else
                                            echo '<option id="disponibilite" value="' . $row['id'] . '">' . $row['nom_disponibilite'] . '</option>';
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                            <span class="aide-enligne"><?php echo $disponibiliteErreur ; ?></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="disponibilitepdf">Disponibilité Livre Electronique</label>
                            <select class="form-livre" name="disponibilitepdf" id="disponibilitepdf">
                            <?php
                                    $db = Database::connect();
                                    foreach($db->query('SELECT * FROM livres_downloadable') as $row)
                                    {
                                        if($row['id'] == $disponibilitepdfLivre)
                                            echo '<option selected="selected" id="disponibilitepdf" value="' . $row['id'] . '">' . $row['statut_pdf'] . '</option>';
                                        else
                                            echo '<option id="disponibilitepdf" value="' . $row['id'] . '">' . $row['statut_pdf'] . '</option>';
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                            <span class="aide-enligne"></span>
                        </div>
                        <div class="form-groupemodifierlivre">
                            <label for="urllivre">URL du livre</label>
                            <input class="form-livre" id="urllivre" name="urllivre" placeholder="Entrer l'URL du livre électronique" value="<?php echo $urlLivre ; ?>" type="text">
                        </div>
                        <div>
                            <button type="submit" class="submit-livre">MODIFIER</button>
                        </div>
                    </form>
            <div class="modifierlivre">
                <img src="<?php echo '../livres-tarawih/img-livre/' . $imageprincipaleLivre; ?>" alt="<?php echo 'ﺍﻟﺘﺮﺍﻭﻳﺢ' . ' ' . $titreLivre . ' le ' . $langueLivre ; ?>">
                    <div class="modifierlivrevision">
                        <span><?php echo $langueLivre; ?></span>
                        <h5><?php echo $titreLivre; ?></h5>
                        <p>Auteur : <?php echo $auteurLivre; ?></p>
                        <p>Editeur : <?php echo $editeurLivre; ?></p>
                        <p>Nb Page : <?php echo $nbpageLivre; ?></p>
                        <p>Date Publication : <?php echo $datepublicationLivre; ?></p>
                        <button class="modifierlivrevision disponible"><?php echo $disponibiliteLivre ;?></button>
                        <div>
                        <a class="modifierlivrevision telechargeable" href="<?php echo $urlLivre ;?>" style="text-decoration: none;" target="_blank" download="<?php echo $livres_tarawih['slug'] . '.pdf';?>"><?php echo $disponibilitepdfLivre ;?></a>
                        </div>
                    </div>
            </div>
    </section>
</body>

</html>

