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
                        <li class="breadcrumb-item">Rapport</li>
                        <li class="breadcrumb-item active">Liste de rapport des opérations</li>
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
                        <h3>Rapport des opérations</h3>
                    </div>
                    <div class="card-body pt-0 recent-order">
                        <div class="table-responsive theme-scrollbar">
                            <table id="tableReport" class="table display mt-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Facture NO</th>
                                        <th>Montant dû</th>
                                        <th>Montant payé</th>
                                        <th>Remise</th>
                                        <th>Reste</th>
                                        <th>Caissier</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($reports as $rp) : ?>
                                        <tr>
                                            <td>
                                                <?= $rp["date_paie"] ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="flex-grow-1">
                                                        <a href="#">
                                                            <h6 class="fw-bold"><?= $rp["full_name"] ?></h6>
                                                        </a>
                                                        <small class="text-muted"><?= $rp["phone"] ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="f-w-600">Facture n°<?= $rp["facture_id"] ?></td>
                                            <td class="font-primary f-w-600"><?= $rp["montant"] ?> F</td>
                                            <td class="font-primary f-w-600"><?= $rp["total_paiement"] ?> F</td>
                                            <td class="font-primary f-w-600"><?= $rp["remise"] ?>%</td>
                                            <td class="font-primary f-w-600"><?= $rp["remise"] !==0 ?  $rp["montant"] -  $rp["total_paiement"] - ($rp["montant"] / $rp["remise"]) : $rp["montant"] - $rp["total_paiement"] ?> F</td>
                                            <td class="f-w-600"><?= $rp["username"] ?></td>

                                            <td>
                                                <button class="btn btn-pill btn-info btn-sm" type="button"><i class="icon-eye"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <h6 class="m-0"><span class="f-w-900">TOTAL</span></h6>
                                        </td>
                                        <td><h6 class="fw-bold">0 F</h6></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="myExtraLargeModal">Paiement Facture NO.</h3>
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
                                <label class="form-label" for="due-amount">Montant Dû(CDF)</label>
                                <input class="form-control border-primary" id="due-amount" type="text" placeholder="Montant dû" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="last-pay-amount">Montant Payé(CDF)</label>
                                <input class="form-control border-primary" id="last-pay-amount" type="text" placeholder="Montant Payé" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="pay-amount">Paiement Montant(CDF) <sup class="text-danger">*</sup></label>
                                <input class="form-control border-info" id="pay-amount" type="text" placeholder="Montant dû" required>
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
</div>

<script>
    function triggerFacData(factureId, clientId, clientNom, clientPhone, dueAmount, lastPayAmount, discount) {
        document.getElementById("client-name").innerText = clientNom;
        document.getElementById("client-phone").innerText = clientPhone;
        document.getElementById("clientID").value = clientId;
        document.getElementById("factureID").value = factureId;
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