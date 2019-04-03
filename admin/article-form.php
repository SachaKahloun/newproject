<?php

require ('../_tools.php');

$title = isset($_POST['title']) ? $_POST['title'] : NULL;
$summary = isset($_POST['summary']) ? $_POST['summary'] : NULL;
$content = isset($_POST['content']) ? $_POST['content'] : NULL;
$date = isset($_POST['date']) ? $_POST['date'] : NULL;
$categories = isset($_POST['categories']) ? $_POST['categories'] : NULL;


$query_categories = $db->query('SELECT * FROM category');
$categories = $query_categories->fetchAll();

if (isset($_POST['save'])){
    if (!empty($_POST['title']) AND !empty($_POST['date']) AND !empty($_POST['categories'] )){
        $query = $db->prepare('SELECT name FROM article WHERE id = ?');
        $yes_article = $query->fetch();

        $query_insert = $db->prepare('INSERT INTO article (title, summary, content, date, category_id, is_published ) VALUES (?, ?, ?, ?, ?, ?)');
        $result_insert = $query_insert->execute(
            [
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['summary']),
                htmlspecialchars($_POST['content']),
                htmlspecialchars($_POST['date']),
                htmlspecialchars($_POST['categories'][0]),
                htmlspecialchars($_POST['is_published'])
            ]
        );
        $bravo = "Catégorie ajoutée avec succès !";

        $title = null;
        $summary = null;
        $content = null;
        $date = null;
        $categories = null;
    }
    else{
        $erreur = "Impossible d'ajouter, veuillez remplir les champs obligatoires.";
    }
}

if (isset($_GET['article_id'])){
    $query_update = $db->prepare('SELECT * FROM article WHERE id = ?');
    $query_update->execute(array($_GET['article_id']));

    $infoArticle = $query_update->fetch();
}

if (isset($_POST['update'])){
    $query_other_update = $db->prepare('UPDATE article SET category_id = ?, title = ?, date = ?, summary = ?, content = ?, is_published = ? WHERE id = ?');
    $result_update = $query_other_update->execute(
        [
            htmlspecialchars($_POST['categories'][0]),
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['date']),
            htmlspecialchars($_POST['summary']),
            htmlspecialchars($_POST['content']),
            htmlspecialchars($_POST['is_published']),
            $_POST['id']
        ]
    );

    if($result_update){ //result est le résultat de ‘execute’. True si succès, sinon false
        echo 'Article mis à jour avec succès !';
    }
    else{
        echo 'Impossible de mettre à jour l\'article...';
    }

}


?>


<!DOCTYPE html>
<html>
<head>

    <title>Administration des articles - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
                <!-- Si $article existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter un article</h4>
            </header>

            <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#infos" role="tab">Infos</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane container-fluid active" id="infos" role="tabpanel">


                    <!-- Si $article existe, chaque champ du formulaire sera pré-remplit avec les informations de l'article -->
                    <form action="article-form.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Titre :</label>
                            <input class="form-control"  type="text" placeholder="Titre" name="title" id="title" value="<?php if (isset($_GET['article_id'])) echo $infoArticle['title'] ?>" />

                            <?php if (isset($_POST['title'])AND (empty($_POST['title']) )) : ?>
                                <?php echo "Le titre est obligatoire " ; ?>
                            <?php endif; ?>

                        </div>
                        <div class="form-group">
                            <label for="summary">Résumé :</label>
                            <input class="form-control"  type="text" placeholder="Résumé" name="summary" id="summary" value="<?php if (isset($_GET['article_id'])) echo $infoArticle['summary'] ?>" />
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu :</label>
                            <textarea class="form-control" name="content" id="content" placeholder="Contenu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input class="form-control" type="file" name="image" id="image" />
                        </div>
                        <div class="form-group">
                            <label for="title">Date :</label>
                            <input class="form-control"  type="date" placeholder="Date" name="date" id="date" value="<?php if (isset($_GET['article_id'])) echo $infoArticle['date'] ?>" />

                            <?php if (isset($_POST['date'])AND (empty($_POST['date']) )) : ?>
                                <?php echo "La date est obligatoire " ; ?>
                            <?php endif; ?>

                        </div>

                        <div class="form-group">
                            <label for="categories"> Catégorie </label>
                            <select class="form-control" name="categories[]" id="categories" multiple="multiple">

                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']?>"
                                    <?php if (isset($_GET['article_id']) AND $category['id'] == $infoArticle['category_id']): ?>
                                    selected = "selected"
                                    <?php endif; ?>>
                                        <?php echo $category['name']?>
                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <?php if (isset($_POST['categories']) AND (empty($_POST['categories']) )) : ?>
                                <?php echo "La catégorie est obligatoire " ; ?>
                            <?php endif; ?>

                        </div>

                        <div class="form-group">
                            <label for="is_published"> Publié ?</label>
                            <select class="form-control" name="is_published" id="is_published">
                                <?php if (isset($_GET['article_id'])) :?>
                                    <?php if ($infoArticle['is_published'] == 0) : ?>
                                        <option selected="selected" value="<?php echo $infoArticle['is_published']?>">Non</option>
                                        <option value="1" >Oui</option>
                                    <?php else: ?>
                                        <option selected="selected" value="<?php echo $infoArticle['is_published']?>">Oui</option>
                                        <option value="O" >Non</option>
                                    <?php endif; ?>
                                    <?php else: ?>
                                        <option selected="selected" value="0">Non</option>
                                        <option value="1" >Oui</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="text-right">
                            <?php if (isset($_GET['article_id'])): ?>
                                <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                            <?php else: ?>
                            <!-- Si $article existe, on affiche un lien de mise à jour -->
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                            <?php endif; ?>
                        </div>

                        <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                        <input type="hidden" name="id" value="<?php if (isset($_GET['article_id'])) echo $infoArticle['id'];  ?>">

                    </form>

                    <?php if (isset($bravo)) : ?>
                        <?php echo $bravo ; ?>
                    <?php endif; ?>
                    <?php if (isset($erreur)) : ?>
                        <?php echo $erreur ; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>