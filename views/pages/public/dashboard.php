<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Bienvenue <?= getSession("user")["username"] ?></h2>
                    <p class="mb-0 text-title-gray">Vous êtes  <?= getSession("user")["role"] ?></p>
                </div>
                <div class="col-sm-6 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pressingapp"><i
                                        class="iconly-Home icli svg-color"></i></a></li>
                        <li class="breadcrumb-item">Facturation</li>
                        <li class="breadcrumb-item active">Liste des factures</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 box-col-12">
                <div class="card">
                    <div class="card-header card-no-border pb-0 d-flex justify-content-between">
                        <h3>Liste des opérations</h3>
                        <a class="btn btn-primary" href="/pressingapp/invoice"><i class="fa-solid fa-plus"></i>Nouvelle facture</a>
                    </div>
                    <div class="card-body pt-0 recent-order">
                        <div class="table-responsive theme-scrollbar">
                            <table class="table display table-bordernone mt-0" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Facture NO</th>
                                    <th>Montant</th>
                                    <th>Caissier</th>
                                    <th>status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach($factures as $fac) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0 comman-round"><img src="assets/images/dashboard-2/user/13.png" alt="" /></div>
                                            <div class="flex-grow-1">
                                                <a href="#">
                                                    <h6><?= $fac["full_name"] ?></h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="f-w-600">Facture n°<?= $fac["facture_id"] ?></td>
                                    <td class="font-primary f-w-600"><?= $fac["montant"] ?></td>
                                    <td class="f-w-600"><?= $fac["username"] ?></td>
                                    <td>
                                        <div class="status-showcase">
                                           <span class="badge badge-success">actif</span>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                        <ul class="dropdown-menu dropdown-block"> 
                                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                        <li><a class="dropdown-item" href="#">Voir détails</a></li>
                                        <li><a class="dropdown-item" href="/pressingapp/single_print?id=<?= $fac["facture_id"] ?>">imprimer</a></li>
                                        </ul>
                                    </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
