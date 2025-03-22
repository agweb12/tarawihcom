<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Administration Tarawih</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div id="tableuradmin">
        <div class="pro-container2 admin">
            <div class="pro-container3 admin">
                <h1>Tableur Admin Livres</h1>
                <a href="ajouter_livre.php">+ Ajouter</a>
            </div>
            <table class="table admin">
                <thead class="tetetable admin">
                    <tr class="ligne admin">
                        <th>Titre du livre</th>
                        <th>Auteur</th>
                        <th>Editeur</th>
                        <th>Langue</th>
                        <th>Nb Page</th>
                        <th>Date Publication</th>
                        <th>Résumé</th>
                        <th>Image du livre</th>
                        <th>PDF_url</th>
                        <th>Disponibilité</th>
                        <th>Disponibilité PDF</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody  class="bodytable admin">

                    <?php
                    require 'database_tarawih.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT
                    livres_tarawih.id, 
                    livres_tarawih.titre, 
                    livres_tarawih.auteur, 
                    livres_tarawih.editeur, 
                    livres_tarawih.langue, 
                    livres_tarawih.nombre_de_page, 
                    livres_tarawih.date_publication, 
                    livres_tarawih.resumes, 
                    livres_tarawih.image_principale, 
                    livres_tarawih.pdf_url, 
                    livres_disponible.nom_disponibilite AS disponibilite, 
                    livres_downloadable.statut_pdf AS disponibilitepdf
                    FROM livres_tarawih 
                    LEFT JOIN livres_disponible ON livres_tarawih.disponibilite = livres_disponible.id
                    LEFT JOIN livres_downloadable ON livres_tarawih.disponibilitepdf = livres_downloadable.id

                    ORDER BY livres_tarawih.id ASC');
                    while ($livres_tarawih = $statement->fetch()) 
                    {
                        echo '<tr class="ligne admin">';
                            echo '<td>' . $livres_tarawih['titre'] . '</td>';
                            echo '<td>' . $livres_tarawih['auteur'] . '</td>';
                            echo '<td>' . $livres_tarawih['editeur'] . '</td>';
                            echo '<td>' . $livres_tarawih['langue'] . '</td>';
                            echo '<td>' . $livres_tarawih['nombre_de_page'] . '</td>';
                            echo '<td>' . $livres_tarawih['date_publication'] . '</td>';
                            echo '<td>' . substr($livres_tarawih['resumes'], 0, 80) . ' [...]' . '</td>';
                            echo '<td>' . $livres_tarawih['image_principale'] . '</td>';
                            echo '<td>' . $livres_tarawih['pdf_url'] . '</td>';
                            echo '<td>' . $livres_tarawih['disponibilite'] . '</td>';
                            echo '<td>' . $livres_tarawih['disponibilitepdf'] . '</td>';
                            echo '<td width=300>';
                                echo'<a class="voir" href="voir_livre.php?id=' . $livres_tarawih['id'] . '">Voir</a>';
                                echo '<a class="modifier" href="update_livre.php?id=' . $livres_tarawih['id'] . '">Modifier</a>';
                                echo '<a class="supprimer" href="supprimer_livre.php?id=' . $livres_tarawih['id'] . '">Supprimer</a>';
                            echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <div id="tableuradmin">
        <div class="pro-container2 admin">
            <div class="pro-container3 admin">
                <h1>Tableur Admin Clients</h1>
                <a href="ajouter_client.php">+ Ajouter</a>
            </div>
            <table class="table admin">
                <thead class="tetetable admin">
                    <tr class="ligne admin">
                        <th>id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Date Inscription</th>
                        <th>Adresse 1</th>
                        <th>Adresse 2</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Pays</th>
                        <th>Quantité Particulier</th>
                        <th>Quantité Pro</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody  class="bodytable admin">

                    <?php
                    $db = Database::connect();
                    $statement = $db->query('SELECT
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
                    ');
                    while ($clients_adresses = $statement->fetch())
                    {
                        echo '<tr class="ligne admin">';
                            echo '<td>' . $clients_adresses['id'] . '</td>';
                            echo '<td>' . $clients_adresses['nom'] . '</td>';
                            echo '<td>' . $clients_adresses['prenom'] . '</td>'; 
                            echo '<td>' . $clients_adresses['email'] . '</td>'; 
                            echo '<td>' . $clients_adresses['telephone'] . '</td>'; 
                            echo '<td>' . $clients_adresses['date_inscription'] . '</td>'; 
                            echo '<td>' . $clients_adresses['adresse1'] . '</td>';
                            echo '<td>' . $clients_adresses['adresse2'] . '</td>';
                            echo '<td>' . $clients_adresses['ville'] . '</td>';
                            echo '<td>' . $clients_adresses['codepostal'] . '</td>';
                            echo '<td>' . $clients_adresses['pays'] . '</td>';
                            echo '<td>' . $clients_adresses['quantiteparticulier'] . '</td>';
                            echo '<td>' . $clients_adresses['quantitepro'] . '</td>';
                            echo '<td width=300>';
                                echo'<a class="voir" href="voir_client.php?id=' . $clients_adresses['id'] . '">Voir</a>';
                                echo '<a class="modifier" href="update_client.php?id=' . $clients_adresses['id'] . '">Modifier</a>';
                                echo '<a class="supprimer" href="supprimer_client.php?id=' . $clients_adresses['id'] . '">Supprimer</a>';
                            echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>