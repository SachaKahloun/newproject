<?php require_once '_tools.php';

if(isset($_POST['login'])){

    if (!empty($_POST['email']) AND !empty($_POST['password'])){

        $query_user = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
        $query_user->execute( array( $_POST['email'],  md5($_POST['password'])) );
        $result_user = $query_user->fetch();



        if($result_user){
            $_SESSION['user'] = $result_user;
        }
    }

    header('location:index.php');
    exit();

}
else{
    $email = NULL;
    $password = NULL;
}


$messages = [];

//si le formulaire a été soumis
if(isset($_POST['register'])){

//si firstname est vide, j'ajoute un message à mon tableau
//idem pour les autres champs vides
if(empty($_POST['firstname'])){
    $messages['firstname'] = 'le prénom est obligatoire';
}
if(empty($_POST['lastname'])){
    $messages['lastname'] = 'le nom de famille est obligatoire';
}
if(empty($_POST['email'])){
    $messages['email'] = 'l-email est obligatoire';
}
if(empty($_POST['password'])){
    $messages['password'] = 'le mot de passe est obligatoire';
}
if(empty($_POST['password_confirm'])){
    $messages['password_confirm'] = 'Veuillez confirmer le mot de passe';
}

$query = $db->prepare('SELECT email FROM user WHERE email = ?');
$query->execute(
    [
        $_POST['email']
    ]
);
$emailExist = $query->fetch();

//si l'email est déjà dans la base de données, on prévient l'utilisateur qu'il ne peut pas l'utiliser
if($emailExist != false){
    $messages['emailExist'] = "l'adresse email est déjà utilisée";
}

if($_POST['password'] != $_POST['password_confirm']){
    $messages['password_confirm'] = 'Les mots de passe doivent être identiques.';
}

    if(empty($messages)){
        $query = $db->prepare('INSERT INTO user (firstname, lastname, email, password) VALUES (? , ? , ? , ?)');
        $result = $query->execute(
            [
                htmlspecialchars($_POST['firstname']),
                htmlspecialchars($_POST['lastname']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars(md5($_POST['password']))
            ]
        );

        //si l'ensertion s'est bien passée, prévenir l'utilisateur
        if($result == true){
            echo 'Inscription réalisée avec succès !';
        }
        else{
            echo 'Inscription non aboutie, veuillez réessayer.';
        }
    }
}




?>



<!DOCTYPE html>
<html>
<head>

    <title>Login - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>

    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="css/main.css">

</head>
<body class="article-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 article-content">
        <?php require 'partials/nav.php'; ?>



        <main class="col-9">

            <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#login" role="tab">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#register" role="tab">Inscription</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane container-fluid active" id="login" role="tabpanel">

                    <form action="login-register.php" method="post" class="p-4 row flex-column">

                        <h4 class="pb-4 col-sm-8 offset-sm-2">Connexion</h4>


                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="email">Email</label>
                            <input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
                        </div>

                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="password">Mot de passe</label>
                            <input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
                        </div>

                        <div class="text-right col-sm-8 offset-sm-2">
                            <input class="btn btn-success" type="submit" name="login" value="Valider" />
                        </div>

                    </form>

                </div>
                <div class="tab-pane container-fluid " id="register" role="tabpanel">

                    <form action="login-register.php" method="post" class="p-4 row flex-column">

                        <h4 class="pb-4 col-sm-8 offset-sm-2">Inscription</h4>


                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="firstname">Prénom <b class="text-danger">*</b></label>
                            <input class="form-control" value="" type="text" placeholder="Prénom" name="firstname" id="firstname" />
                        </div>
                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="lastname">Nom de famille</label>
                            <input class="form-control" value="" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
                        </div>
                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="email">Email <b class="text-danger">*</b></label>
                            <input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
                        </div>
                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="password">Mot de passe <b class="text-danger">*</b></label>
                            <input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
                        </div>
                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="password_confirm">Confirmation du mot de passe <b class="text-danger">*</b></label>
                            <input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" />
                        </div>
                        <div class="form-group col-sm-8 offset-sm-2">
                            <label for="bio">Biographie</label>
                            <textarea class="form-control" name="bio" id="bio" placeholder="Ta vie Ton oeuvre..."></textarea>
                        </div>

                        <div class="text-right col-sm-8 offset-sm-2">
                            <p class="text-danger">* champs requis</p>
                            <input class="btn btn-success" type="submit" name="register" value="Valider" />
                        </div>

                    </form>
                    <?php

                    foreach($messages as $message){
                        echo $message . '<br>';
                    }

                    ?>

                </div>


            </div>
        </main>

    </div>

    <footer class="row mt-3">
        <div class="col py-2 text-right">
            <b>Footer du site</b>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.js"></script>

    <script src="js/main.js"></script>

</div>
</body>
</html>