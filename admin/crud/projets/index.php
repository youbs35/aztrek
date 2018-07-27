<?php
require_once '../../../model/database.php';

$list_projets = getAllProjects();

require_once '../../layout/header.php';
?>

<h1>Gestion des projets</h1>

<a href="insert_form.php" class="btn btn-primary">Ajouter</a>

<hr>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date début</th>
            <th>Catégorie</th>
            <th>Photo</th>
            <th>Coût</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_projets as $projet) : ?>
        <tr>
            <td><?php echo $projet["titre"]; ?></td>
            <td><?php echo $projet["date_debut_format"]; ?></td>
            <td><?php echo $projet["categorie"]; ?></td>
            <td>
                <img src="<?php echo SITE_URL . "/uploads/" . $projet["image"]; ?>" class="img-thumbnail">
            </td>
            <td><?php echo $projet["prix_format"]; ?> €</td>
            <td class="col-actions">
                <form action="delete_query.php" method="post" class="form-delete">
                    <input type="hidden" name="id" value="<?php echo $projet["id"]; ?>">
                    <button type="submit" class="btn btn-danger" title="Supprimer">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <a href="update_form.php?id=<?php echo $projet["id"]; ?>" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../../layout/footer.php'; ?>