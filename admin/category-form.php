<?php
require ('../_tools.php');

$name = isset($_POST['name']) ? $_POST['name'] : NULL;
$description = isset($_POST['description']) ? $_POST['description'] : NULL;


if (isset($_POST['save'])){
    if (!empty($_POST['name'])){
        $query = $db->prepare('SELECT name FROM category WHERE id = ?');
        $yes_category = $query->fetch();

        $query_insert = $db->prepare('INSERT INTO category (name, description ) VALUES (?, ?)');
        $result_insert = $query_insert->execute(
            [
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['description']),
            ]
        );
        $bravo = "Catégorie ajoutée avec succès !";

        $name = null;
        $description = null;
    }
    else{
        $erreur = "Impossible d'ajouter, veuillez remplir les champs obligatoires.";
    }
}

if (isset($_GET['category_id'])){
    $query_update = $db->prepare('SELECT * FROM category WHERE id = ?');
    $query_update->execute(array($_GET['category_id']));

    $infoCategory = $query_update->fetch();
}

if (isset($_POST['update'])){
    $query_other_update = $db->prepare('UPDATE category SET name = ?, description = ? WHERE id = ?');
    $result_update = $query_other_update->execute(
        [
            htmlspecialchars($_POST['name']),
            htmlspecialchars($_POST['description']),
            $_POST['id']
        ]
    );

    if($result_update){ //result est le résultat de ‘execute’. True si succès, sinon false
        echo 'Catégorie mise à jour avec succès !';
    }
    else{
        echo 'Impossible de mettre à jour la catégorie...';
    }

}


?>

<!DOCTYPE html>
<html>
<head>

    <title>Administration des catégories - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
                <!-- Si $category existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter une catégorie</h4>
            </header>


            <!-- Si $category existe, chaque champ du formulaire sera pré-remplit avec les informations de la catégorie -->

            <form action="category-form.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input class="form-control"  type="text" placeholder="Nom" name="name" id="name" value="<?php if (isset($_GET['category_id'])) echo $infoCategory['name']; ?>"  />

                    <?php if (isset($_POST['name'])AND (empty($_POST['name']) )) : ?>
                        <?php echo "Le nom de la catégorie est obligatoire " ; ?>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="description">Description : </label>
                    <input class="form-control"  type="text" placeholder="Description" name="description" id="description" value="<?php if (isset($_GET['category_id'])) echo $infoCategory['description']; ?>"  />
                </div>

                <div class="form-group">
                    <label for="image">Image :</label>
                    <input class="form-control" type="file" name="image" id="image" />
                </div>

                <div class="text-right">
                    <?php if (isset($_GET['category_id'])): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                    <?php else: ?>
                    <!-- Si $category existe, on affiche un lien de mise à jour -->
                    <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                    <?php endif; ?>
                </div>

                <!-- Si $category existe, on ajoute un champ caché contenant l'id de la catégorie à modifier pour la requête UPDATE -->
                <input type="hidden" name="id" value="<?php if (isset($_GET['category_id'])) echo $infoCategory['id'];  ?>">

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