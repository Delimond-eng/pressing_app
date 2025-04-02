<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Configuration des rubriques pour la facturation</h2>
                </div>
                <div class="col-sm-6 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pressingapp"><i class="iconly-Home icli svg-color"></i></a></li>
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active">Configurations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <h3>Création utilisateurs</h3>
                    </div>
                    <div class="card-body">
                        <?php displayFlashMessage(); ?>
                        <form method="post" action="/pressingapp/config_create" class="stepper-one row g-3 d-flex align-items-end needs-validation custom-input">
                            <div class="col-12">
                                <label class="form-label">Designation<span class="text-danger">*</span></label>
                                <input class="form-control" name="libelle" type="text" required placeholder="ex: nettoyage chemise..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Prix unitaire<span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <input class="form-control me-1" name="pu" type="text" required placeholder="ex: 500">
                                    <select name="devise" style="width: 100px;" class="form-control">
                                        <option value="CDF" selected>CDF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button id="btnAction" type="submit" class="btn btn-primary btn-block">Soumettre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h3>Liste des produits & services</h3>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Designation service</th>
                                        <th>Prix unitaire </th>
                                        <th>Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($settings as $s) : ?>
                                    <tr>
                                        <td>
                                            <?= $s["prod_libelle"]?>
                                        </td>
                                        <td><?= $s["prod_pu"]?> <?= $s["prod_devise"]?></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Vous êtes sûr de vouloir continuer cette opération ??');" href="/pressingapp/config_delete?id=<?= $s["prod_id"]?>">Supprimer</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>