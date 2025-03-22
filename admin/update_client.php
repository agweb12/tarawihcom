<?php
    require 'database_tarawih.php';

    if(!empty($_GET['id']))
    {
        $idClient = checkInput($_GET['id']);
    }

    $nomclientErreur = $prenomclientErreur = $emailclientErreur = $telephoneclientErreur = $adresse1clientErreur = $villeclientErreur = $codepostalclientErreur = $paysclientErreur = $quantiteparticulierclientErreur = 
    $nomClient = $prenomClient = $emailClient = $telephoneClient  = $adresse1Client = $adresse2Client = $villeClient = $codepostalClient = $paysClient = $quantiteparticulierClient = $quantiteproClient = ""; 

    if (!empty($_POST)) 
    {   
        $nomClient                = checkInput($_POST['nom']);
        $prenomClient             = checkInput($_POST['prenom']);
        $emailClient              = checkInput($_POST['email']);
        $telephoneClient          = checkInput($_POST['telephone']);
        $adresse1Client           = checkInput($_POST['adresse1']);
        $adresse2Client           = checkInput($_POST['adresse2']);
        $villeClient              = checkInput($_POST['ville']);
        $codepostalClient         = checkInput($_POST['codepostal']);
        $paysClient               = checkInput($_POST['pays']);
        $quantiteparticulierClient= checkInput($_POST['quantiteparticulier']);
        $quantiteproClient        = checkInput($_POST['quantitepro']);
        $estValide                = true;

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
        
            $db = Database::connect();
            $statement = $db->prepare('UPDATE clients_adresses SET
            clients_adresses.nom = ?, 
            clients_adresses.prenom = ?, 
            clients_adresses.email = ?, 
            clients_adresses.telephone = ?, 
            clients_adresses.adresse1 = ?, 
            clients_adresses.adresse2 = ?, 
            clients_adresses.ville = ?, 
            clients_adresses.codepostal = ?, 
            clients_adresses.pays = ?, 
            clients_adresses.quantiteparticulier = ?, 
            clients_adresses.quantitepro = ?
            WHERE clients_adresses.id = ?');
            $statement->execute(array($nomClient,$prenomClient,$emailClient,$telephoneClient,$adresse1Client,$adresse2Client,$villeClient,$codepostalClient,$paysClient,$quantiteparticulierClient, $quantiteproClient,$idClient));
            Database::disconnect();
            header("Location: index.php");
        
    }
    else
    {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM clients_adresses WHERE clients_adresses.id = ?");
            $statement->execute(array($idClient));
            $clients_adresses = $statement->fetch();
            $nomClient                     = $clients_adresses['nom'];
            $prenomClient                  = $clients_adresses['prenom'];
            $emailClient                   = $clients_adresses['email'];
            $telephoneClient               = $clients_adresses['telephone'];
            $adresse1Client                = $clients_adresses['adresse1'];
            $adresse2Client                = $clients_adresses['adresse2'];
            $villeClient                   = $clients_adresses['ville'];
            $codepostalClient              = $clients_adresses['codepostal'];
            $paysClient                    = $clients_adresses['pays'];
            $quantiteparticulierClient     = $clients_adresses['quantiteparticulier'];
            $quantiteproClient             = $clients_adresses['quantitepro'];

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
    <title>Admin Modifier-un-client</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Modifier un client</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="modifierlivreadmin"> 
            <form class="form-ajouterlivre" role="form" action="update_client.php" method="post">
                    <div class="form-groupeajouterlivre">
                        <label for="nom">Nom</label>
                        <input class="form-livre" id="nom" name="nom" placeholder="Entrer le nom" value="<?php echo $nomClient ; ?>" type="text">
                        <span class="aide-enligne"><?php echo $nomclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="prenom">Prenom</label>
                        <input class="form-livre" id="prenom" name="prenom" placeholder="Entrer le prénom" value="<?php echo $prenomClient ; ?>" type="text">
                        <span class="aide-enligne"><?php echo $prenomclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="email">Email</label>
                        <input class="form-livre" id="email" name="email" placeholder="Entrer l'email" value="<?php echo $emailClient ; ?>" type="email">
                        <span class="aide-enligne"><?php echo $emailclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="telephone">Telephone</label>
                        <input class="form-livre" id="telephone" name="telephone" placeholder="Entrer le numero de telephone (XXXXXXXXXX)" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?php echo $telephoneClient ; ?>" type="tel">
                        <span class="aide-enligne"><?php echo $telephoneclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="adresse1">Adresse 1</label>
                        <input class="form-livre" id="adresse1" name="adresse1" placeholder="Entrer l'adresse" value="<?php echo $adresse1Client ; ?>" type="text">
                        <span class="aide-enligne"><?php echo $adresse1clientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="adresse2" id="adresse2">Adresse 2 (Complément d'adresse)</label>
                        <input class="form-livre" name="adresse2" id="adresse2" placeholder="Entrer le complément d'adresse" value="<?php echo $adresse2Client ;?>" type="text"></input>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="codepostal" id="codepostal">Code Postal</label>
                        <input class="form-livre" name="codepostal" id="codepostal" placeholder="Entrer le code postal" value="<?php echo $codepostalClient ;?>" type="number"></input>
                        <span class="aide-enligne"><?php echo $codepostalclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="ville" id="ville">Ville</label>
                        <input class="form-livre" name="ville" id="ville" placeholder="Entrer la ville" value="<?php echo $villeClient ;?>" type="text"></input>
                        <span class="aide-enligne"><?php echo $villeclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="pays" id="pays">Pays</label>
                        <input class="form-livre" name="pays" id="pays" placeholder="Entrer le pays" value="<?php echo $paysClient ;?>" type="text"></input>
                        <span class="aide-enligne"><?php echo $paysclientErreur ; ?></span>
                    </div>
                    <div class="form-groupeajouterlivre">
                        <label for="quantiteparticulier">Quantité Livre (Particulier)</label>
                        <select class="form-livre" name="quantiteparticulier" id="quantiteparticulier">
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
                    <div class="form-groupeajouterlivre">
                        <label for="quantitepro">Quantité Livre (Professionnel)</label>
                        <select class="form-livre" name="quantitepro" id="quantitepro">
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
                        <button type="submit" class="submit-livre">MODIFIER</button>
                    </div>
                </form>        
    </section>
</body>

</html>

