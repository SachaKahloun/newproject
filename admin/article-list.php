<?php
require ('../_tools.php');

if (isset($_GET['action'])){
    $query_delete = $db->PREPARE('DELETE FROM article WHERE id = ?');
    $query_delete -> execute(array( $_GET['article_id']));

}

$query_articles = $db->query('SELECT * FROM article ');
$articles = $query_articles->fetchAll();

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
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des articles</h4>
                <a class="btn btn-primary" href="article-form.php">Ajouter un article</a>
            </header>


            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Publié</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($articles as $key => $article) : ?>
                    <tr>
                        <td><?php echo $article['id']?></td>
                        <th><?php echo $article['title']?></th>
                        <th>
                            <?php echo ($article['is_published'] == 1) ? 'Oui' : 'Non'; ?>
                        </th>

                        <td>
                            <a href="article-form.php?article_id=<?php echo $article['id'] ?>&action=edit" class="btn btn-warning">Modifier</a>
                            <a onclick="return confirm('Are you sure?')" href="article-list.php?article_id=<?php echo $article['id'] ?>&action=delete" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>


                <?php endforeach; ?>




                </tbody>
            </table>

        </section>

    </div>

</div>
</body>
</html>