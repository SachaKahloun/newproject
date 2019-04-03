<?php require ('../_tools.php');

if (isset($_GET['action'])){
    $query_delete = $db->PREPARE('DELETE FROM category WHERE id = ?');
    $query_delete -> execute(array( $_GET['category_id']));

}

$query_categories = $db->query('SELECT * FROM category');
$categories = $query_categories->fetchAll();

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

        ﻿

        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des catégories</h4>
                <a class="btn btn-primary" href="category-form.php">Ajouter une catégorie</a>
            </header>


            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach ($categories as $key => $category) : ?>
                        <tr>
                            <th><?php echo $category['id']?></th>
                            <td><?php echo $category['name']?></td>
                            <td><?php echo $category['description']?></td>
                            <td>
                                <a href="category-form.php?category_id=<?php echo $category['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')" href="category-list.php?category_id=<?php echo $category['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
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