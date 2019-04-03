<?php
require ('../_tools.php');


$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$biography = isset($_POST['biography']) ? $_POST['biography'] : NULL;

if (isset($_POST['save'])){
    if (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['password'])){

            //echo $_POST['email'];

            $query_connection = $db->prepare('SELECT email FROM user WHERE email = :email'); // :c moi qui donnele nom et ca correspond en dessous a query_connection
            $query_connection->execute(
                [

                    'email' => htmlspecialchars($_POST['email']),

                ]
            );

            $result_connection = $query_connection->fetch();

        if (isset($result_connection)AND $result_connection){
            echo "Cette adresse mail existe déjà";
        }
        else{
            $query_insert = $db->prepare('INSERT INTO user (firstname, lastname, password, email, biography, is_admin ) VALUES (?, ?, ?, ?, ?, ?)');
            $result_insert = $query_insert->execute(
                [
                    htmlspecialchars($_POST['firstname']),
                    htmlspecialchars($_POST['lastname']),
                    md5($_POST['password']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['bio']),
                    htmlspecialchars($_POST['is_admin']),
                ]
            );
            $bravo = "Utilisateur ajouté avec succès !";

            $firstname = null;
            $lastname = null;
            $email = null;
            $biography = null;
        }
    }
    else{
       $erreur = "Impossible d'ajouter, veuillez remplir les champs obligatoires.";
    }
}

if (isset($_GET['user_id'])){
    $query_update = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query_update->execute(array($_GET['user_id']));

    $infoUser = $query_update->fetch();
}

if (isset($_POST['update'])){
    $query_other_update = $db->prepare('UPDATE user SET firstname = ?, lastname = ?, email = ?, password = ?, biography = ?, is_admin = ? WHERE id = ?');
    $result_update = $query_other_update->execute(
        [
            htmlspecialchars($_POST['firstname']),
            htmlspecialchars($_POST['lastname']),
            htmlspecialchars($_POST['email']),
            md5($_POST['password']),
            htmlspecialchars($_POST['bio']),
            htmlspecialchars($_POST['is_admin']),
            $_POST['id']

        ]
    );

    if($result_update){ //result est le résultat de ‘execute’. True si succès, sinon false
        echo 'Utilisateur mis à jour avec succès !';
    }
    else{
        echo 'Impossible de mettre à jour l\'utilisateur...';
    }

}



?>

<!DOCTYPE html>
<html>
<head>

    <title>Administration des utilisateurs - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-3">
                <!-- Si $user existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter un utilisateur</h4>
            </header>


            <!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->

            <form action="user-form.php" method="post">
                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input class="form-control"  type="text" placeholder="Prénom" name="firstname" id="firstname" value="<?php if (isset($_GET['user_id'])) echo $infoUser['firstname'] ?>" />

                    <?php if (isset($_POST['firstname'])AND (empty($_POST['firstname']) )) : ?>
                        <?php echo "Le prénom est obligatoire " ; ?>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille : </label>
                    <input class="form-control"  type="text" placeholder="Nom de famille" name="lastname" id="lastname" value="<?php if (isset($_GET['user_id'])) echo $infoUser['lastname'] ?>"/>

                    <?php if (isset($_POST['lastname'])AND (empty($_POST['lastname']) )) : ?>
                        <?php echo "Le nom de famille est obligatoire " ; ?>
                    <?php endif; ?>



                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input class="form-control"  type="email" placeholder="Email" name="email" id="email" value="<?php if (isset($_GET['user_id'])) echo $infoUser['email'] ?>" />

                    <?php if (isset($_POST['email'])AND (empty($_POST['email']) )) : ?>
                        <?php echo "L'email est obligatoire " ; ?>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="password">Password : </label>
                    <input class="form-control" type="password" placeholder="Mot de passe" name="password" id="password" />

                    <?php if (isset($_POST['password'])AND (empty($_POST['password']) )) : ?>
                        <?php echo "Le mot de passe est obligatoire " ; ?>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="bio" value="<?php echo $infoUser['biography'] ?>">Biographie :</label>
                    <textarea class="form-control" name="bio" id="bio" placeholder="Sa vie son oeuvre..."></textarea>
                </div>
                <div class="form-group">
                    <label for="is_admin"> Admin ?</label>
                    <select class="form-control" name="is_admin" id="is_admin">
                        <?php if ($infoUser['is_admin'] == 1): ?>
                        <option value="0" >Non</option>
                        <option selected = "selected" value="1" >Oui</option>
                        <?php else :?>
                        <option selected = "selected" value="0" >Non</option>
                        <option value="1" >Oui</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="text-right">
                    <?php if (isset($_GET['user_id'])): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                    <?php else: ?>
                    <!-- Si $user existe, on affiche un lien de mise à jour -->
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                    <?php endif; ?>
                </div>



                <!-- Si $user existe, on ajoute un champ caché contenant l'id de l'utilisateur à modifier pour la requête UPDATE -->
                <input type="hidden" name="id" value="<?php if (isset($_GET['user_id'])) echo $infoUser['id'];  ?>">

            </form>


            <?php if (isset($bravo)) : ?>
                <?php echo $bravo ; ?>
            <?php endif; ?>
            <?php if (isset($erreur)) : ?>
                <?php echo $erreur ; ?>
            <?php endif; ?>

        </section>
    </div>

</div>
</body>
</html>