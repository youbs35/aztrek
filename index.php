<?php
require_once 'lib/functions.php';
require_once 'model/database.php';

$list_projects = getAllProjects(3);

get_header("Accueil");
?>

<header class="home-banner">
    <h1>Bienvenue sur <strong>Ecolidaire</strong></h1>
    <p>Let's go Green!</p>
    <form method="get" action="search.php">
        <input type="search" name="title" placeholder="Recherchez...">
        <input type="submit">
    </form>
</header>

<section class="container">
    <h2>Nos dernières actions</h2>
    <div class="actions">
        <?php foreach ($list_projects as $project) : ?>
            <?php include 'include/project_inc.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php get_footer(); ?>