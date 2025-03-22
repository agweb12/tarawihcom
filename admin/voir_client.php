<?php
    require 'database_tarawih.php';

    if (!empty($_GET['id'])) {
        $id =  checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT
                    clients_adresses.id,
                    clients_adresses.nom,
                    clients_adresses.prenom,
                    clients_adresses.email,
                    clients_adresses.telephone,
                    clients_adresses.date_inscription,
                    clients_adresses.adresse1,
                    clients_adresses.adresse2,
                    clients_adresses.ville,
                    clients_adresses.codepostal,
                    clients_adresses.pays,
                    quantite_livre_particulier.quantite_particulier AS quantiteparticulier,
                    quantite_professionnelle.quantite_pro1 AS quantitepro
                    FROM clients_adresses
                    LEFT JOIN quantite_livre_particulier ON clients_adresses.quantiteparticulier = quantite_livre_particulier.id
                    LEFT JOIN quantite_professionnelle ON clients_adresses.quantitepro = quantite_professionnelle.id
                    WHERE clients_adresses.id = ?');

    $statement->execute(array($id));
    $clients_adresses = $statement->fetch();
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
    <title>Admin Voir Client</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Voir un client</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="voiradminlivre">        
        <div class="pro-container admin">
            <div class="pro admin">
                <div class="des admin">
                    <p>ID : <?php echo $clients_adresses['id']; ?></p>
                    <p>Nom : <?php echo $clients_adresses['nom']; ?></p>
                    <p>Prenom : <?php echo $clients_adresses['prenom']; ?></p>
                    <p>Email : <?php echo $clients_adresses['email']; ?></p>
                    <p>Telephone : <?php echo $clients_adresses['telephone']; ?></p>
                    <p>Date d'inscription : <?php echo $clients_adresses['date_inscription']; ?></p>
                    <p>Adresse 1 : <?php echo $clients_adresses['adresse1']; ?></p>
                    <p>Adresse 2 : <?php echo $clients_adresses['adresse2']; ?></p>
                    <p>Ville  : <?php echo $clients_adresses['ville']; ?></p>
                    <p>Code Postal  : <?php echo $clients_adresses['codepostal']; ?></p>
                    <p>Pays  : <?php echo $clients_adresses['pays']; ?></p>
                    <p>Quantité Particulier : <?php echo $clients_adresses['quantiteparticulier']; ?></p>
                    <p>Quantité Pro : <?php echo $clients_adresses['quantitepro']; ?></p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>