<?php

$query = $db->query('SELECT COUNT(*) FROM article');
$nbArticles = $query->fetch();

$query = $db->query('SELECT COUNT(*) FROM category');
$nbCategories = $query->fetch();

$query = $db->query('SELECT COUNT(*) FROM user');
$nbUsers = $query->fetch();




?>


<nav class="col-3 py-2 categories-nav">
    <a class="d-block btn btn-warning mb-4 mt-2" href="../index.php">Site</a>
    <ul>
        <li><a href="user-list.php">Gestion des utilisateurs(<?php echo $nbUsers[0]; ?>)</a></li>
        <li><a href="category-list.php">Gestion des catégories (<?php echo $nbCategories[0]; ?>)</a></li>
        <li><a href="article-list.php">Gestion des articles (<?php echo $nbArticles [0]; ?>)</a></li>
    </ul>
</nav>