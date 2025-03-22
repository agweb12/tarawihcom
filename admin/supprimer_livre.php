<?php
    require 'database_tarawih.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM livres_tarawih WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
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
    <title>Admin Supprimer-un-livre</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>

    <div id="voiradmin" class="titre-container">
        <h1>Admin : Supprimer un livre</h1>
        <a href="index.php">Retour</a>
    </div>
    <section id="supprimerlivreadmin" style="    display:flex;justify-content:center;justify-items: baseline;text-align: center;padding: 40px 0px 80px 0px;background-color: white;">   
        <form class="form-groupesupprimerlivre" style="max-width: 400px;height: fit-content;align-items: center;justify-content: left;margin: 10px 20px;padding: 20px;min-width: fit-content;background-color: whitesmoke;position: relative" role="form" action="supprimer_livre.php" method="post">
            <div class="form-supprimerlivre" style ="width: 300px;display: inline-block;justify-content:center;flex-wrap: wrap;min-width: fit-content;padding: 20px 15px;border: 1px solid #E3E6F3;border-radius: 25px;box-shadow: 0px 20px 34px #12121216;margin: 20px 20px;transition: 0.3s ease;background-color: white">
            <input type="hidden" name="id" value="<?php echo $id; ?>">   
            <h3 class="supprimerlivre" style="margin-bottom:20px;">Êtes-vous sûr de vouloir supprimer le livre ?</h5>
                <button type="submit" class="supprimerlivre" style="cursor:pointer;font-size: 16px;font-family: 'Raleway';font-weight: 700;color: white;margin: 20px;width: fit-content;padding: 10px 20px;border: 2px solid #2b2b2b;text-shadow: 1px 2px 7px #1212128e;background-color: #121212">OUI</button>
                <a class="pas-supprimerlivre" href="index.php" style="cursor:pointer;text-decoration:none;font-size: 16px;font-family: 'Raleway';font-weight: 700;color: white;margin: 20px;width: fit-content;padding:10px 20px;border: 2px solid #2b2b2b;text-shadow: 1px 2px 7px #1212128e;background-color: #121212" >NON</a>
            </div>
        </form>
    </section>
</body>

</html>

