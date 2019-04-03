<?php
	//récupération de la liste des catégories pour générer le menu
	$query = $db->prepare('SELECT  name ,id FROM category ');
	$query->execute();
	$categoriesList = $query->fetchAll();
?>

<nav class="col-3 py-2 categories-nav">
    <p class="h2 text-center"><?php if (isset($_SESSION['user'])){ echo 'Salut ' .$_SESSION['user']['firstname']. ' !'; } ?></p>

    <?php if (isset($_SESSION['user'])) : ?>
    <a class="d-block btn btn-danger mb-4 mt-2" href="index.php?logout">Déconnexion</a>
        <?php if ($_SESSION['user']['is_admin']==1): ?>
            <p>
                <a class="btn btn-block btn-lg btn-warning" href="admin/index.php">Administration</a>
            </p>
        <?php endif; ?>
    <?php else : ?>
    <a class="d-block btn btn-primary mb-4 mt-2" href="login-register.php">Connexion / inscription</a>
    <?php endif; ?>

	<b>Catégories :</b>
	<ul>
		<li><a href="article_list.php">Tous les articles</a></li>
		<!-- liste des catégories -->
		<?php foreach($categoriesList as $key => $category): ?>
		<li><a href="article_list.php?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
