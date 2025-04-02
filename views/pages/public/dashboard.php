<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Bienvenue <?= getSession("user")["username"] ?></h2>
                    <p class="mb-0 text-title-gray">Vous êtes <?= getSession("user")["role"] ?></p>
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
                    <div class="card-header card-no-border mb-3 pb-0 d-flex justify-content-between">
                        <h3>Liste des opérations</h3>
                        <a class="btn btn-info btn-lg" href="/pressingapp/invoice"><i class="fa-solid fa-plus fs-6 me-2"></i>Nouvelle facture</a>
                    </div>
                    <div class="card-body pt-0 recent-order">
                        <?php displayFlashMessage(); ?>
                        <div class="table-responsive theme-scrollbar">
                            <table id="tableDashboard" class="table display mt-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Facture NO</th>
                                        <th>Montant dû</th>
                                        <th>Montant payé</th>
                                        <th>Remise</th>
                                        <th>Reste à payer</th>
                                        <th>Caissier</th>
                                        <th>status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($factures as $fac) :
                                        $montant = $fac["montant"];
                                        $montant_paie = $fac["montant_paie"];
                                        $remise = $fac["remise"];

                                        // Calcul du montant restant après remise
                                        $remise_valeur = ($remise !== 0) ? ($montant * $remise / 100) : 0;
                                        $reste_a_payer = $montant - $montant_paie - $remise_valeur;

                                        // Détermination du statut
                                        if ($montant_paie >= ($montant - $remise_valeur)) {
                                            $status = '<span class="badge bg-success">Payé</span>';
                                        } elseif ($montant_paie > 0 && $montant_paie < ($montant - $remise_valeur)) {
                                            $status = '<span class="badge bg-warning">Paiement Partiel</span>';
                                        } else {
                                            $status = '<span class="badge bg-danger">Non Payé</span>';
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $fac["created_at"] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="flex-grow-1">
                                                        <a href="#">
                                                            <h6 class="fw-bold"><?= $fac["full_name"] ?></h6>
                                                        </a>
                                                        <small class="text-muted"><?= $fac["phone"] ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="f-w-600">Facture n°<?= $fac["facture_id"] ?></td>
                                            <td class="font-primary f-w-600"><?= number_format($montant, 2, ',', ' ') ?> F</td>
                                            <td class="font-primary f-w-600"><?= number_format($montant_paie, 2, ',', ' ') ?> F</td>
                                            <td class="font-primary f-w-600"><?= $remise ?>%</td>
                                            <td class="font-primary f-w-600"><?= number_format($reste_a_payer, 2, ',', ' ') ?> F</td>
                                            <td class="f-w-600"><?= $fac["username"] ?></td>
                                            <td><?= $status ?></td> <!-- Statut de paiement mis à jour -->
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                                    <ul class="dropdown-menu dropdown-block">
                                                        <?php if ($reste_a_payer > 0): ?>
                                                            <li>
                                                                <button onclick='triggerFacData("<?= $fac["facture_id"] ?>","<?= $fac["client_id"] ?>", "<?= $fac["full_name"] ?>", "<?= $fac["phone"] ?>", "<?= $montant ?>", "<?= $montant_paie ?>", "<?= $remise ?>");'
                                                                    class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modal-payment">
                                                                    <i class="icon-money text-primary me-2"></i> Paiement
                                                                </button>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if ($montant_paie == 0): ?>
                                                            <li><a class="dropdown-item" onclick="return confirm('Etes-vous sûr de vouloir continuer cette opération ??')" href="/pressingapp/delete_invoice?id=<?= $fac["facture_id"] ?>"> <i class="icon-trash text-danger"></i> Supprimer</a></li>
                                                        <?php endif; ?>

                                                        <li><a class="dropdown-item" href="#"><i class="icon-pencil-alt text-info me-2"></i> Voir détails</a></li>
                                                        <li><a class="dropdown-item" href="/pressingapp/single_print?id=<?= $fac["facture_id"] ?>"><i class="icon-printer text-info me-2"></i> Imprimer</a></li>
                                                    </ul>
                                                </div>
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

    <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <form method="post" action="/pressingapp/order_invoice" class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="myExtraLargeModal">Paiement Facture NO. <span id="facno"></span></h3>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <ul style="padding: 0; margin: 0; list-style: none;">
                        <li style="display:flex; padding-bottom: 16px; font-weight:900">
                            <span style="display: block; width: 250px;">Client Nom complet</span>
                            <span style="display: block; width: 25px;">:</span>
                            <span id="client-name" style="display: block; width: 100%; color:rgb(6, 17, 29); opacity: 0.9; font-weight:600;"></span>
                        </li>
                        <li style="display:flex; padding-bottom: 16px; font-weight:900">
                            <span style="display: block; width: 250px;">Téléphone</span>
                            <span style="display: block; width: 25px;">:</span>
                            <span id="client-phone" style="display: block; width: 100%; color:rgb(7, 29, 27); opacity: 0.9; font-weight:600;"></span>
                        </li>
                    </ul>
                    <div class="theme-form row g-3">
                        <input type="text" id="factureID" name="facture_id" hidden>
                        <input type="text" id="clientID" name="client_id" hidden>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label text-info" for="due-amount">Montant à payer</label>
                                <input class="form-control border-primary" id="due-amount" type="text" placeholder="Montant dû" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label text-info" for="last-pay-amount">Paiement déjà effectué</label>
                                <input class="form-control border-primary" id="last-pay-amount" type="text" placeholder="Montant Payé" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="pay-amount">Montant payé(CDF) <sup class="text-danger">*</sup></label>
                                <input class="form-control border-info" id="pay-amount" name="amount" type="text" placeholder="Saisir le montant payé" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn btn-primary" type="submit">Valider & sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <a href="/pressingapp/invoice" class="d-flex justify-content-center align-items-center" style="height: 50px; width: 50px; background-color: #02a2b9; box-shadow: 2px #000000; color: #ffffff; border-radius: 100%; position: fixed; bottom: 40px; right: 40px; z-index: 9999;">
        <i class="icon-plus"></i>
    </a>
</div>

<script>
    function triggerFacData(factureId, clientId, clientNom, clientPhone, dueAmount, lastPayAmount, discount) {
        document.getElementById("client-name").innerText = clientNom;
        document.getElementById("client-phone").innerText = clientPhone;
        document.getElementById("clientID").value = clientId;
        document.getElementById("factureID").value = factureId;
        document.getElementById("facno").innerText = factureId;
        let remise = parseInt(discount);
        if (remise !== 0) {
            let amount = parseFloat(dueAmount);
            let discountAmount = amount / remise;
            let normalAmount = amount - discountAmount;
            document.getElementById("due-amount").value = normalAmount.toFixed(2);
        } else {
            document.getElementById("due-amount").value = dueAmount;
        }

        document.getElementById("last-pay-amount").value = lastPayAmount
    }
</script>