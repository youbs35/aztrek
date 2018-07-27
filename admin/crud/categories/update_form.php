<?php
require_once '../../../model/database.php';

$id = $_GET["id"];
$categorie = getOneEntity("categorie", $id);

require_once '../../layout/header.php';
?>

<h1>Modifier une catégorie</h1>

<form action="update_query.php" method="post">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Libellé</label>
        <div class="col-sm-10">
            <input type="text" name="libelle" value="<?php echo $categorie["libelle"]; ?>" class="form-control" placeholder="Libellé">
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-success float-right">
        <i class="fa fa-save"></i>
        Enregistrer
    </button>
</form>

<?php require_once '../../layout/footer.php'; ?>

