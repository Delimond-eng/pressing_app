<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Creation facture</h2>
                </div>
                <div class="col-sm-6 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="iconly-Home icli svg-color"></i></a></li>
                        <li class="breadcrumb-item">Facturation</li>
                        <li class="breadcrumb-item active">nouvelle facture</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-Fluid Starts-->
    <div class="container invoice-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    
                    <form class="card-body" method="post" action="/pressingapp/create_invoice">

                        <?php displayFlashMessage(); ?>
                        <table class="table-wrapper table-responsive table-borderless theme-scrollbar">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table-responsive table-borderless" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="width:100%;">
                                                        <div class="mb-2">
                                                            <label>Client existant ou</label>
                                                            <select id="existClient" class="form-select mb-1">
                                                                <option value="" selected hidden>Sélectionnez un client existant</option>
                                                                <?php foreach($clients as $cl): ?>
                                                                    <option data-info='<?= json_encode($cl)?>' value="<?= $cl["id"]; ?>"><?= $cl["full_name"]; ?> | <?= $cl["phone"]; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:80%;">
                                                        <div class="mb-3">
                                                            <label>Nouveau client</label>
                                                            <div class="d-flex">
                                                                <input type="text" class="form-control me-2" name="client[nom]" placeholder="Nom complet..." required>
                                                                <input type="text" class="form-control me-2" name="client[phone]" placeholder="Téléphone..." required>
                                                                <input type="text" hidden class="form-control me-2" name="client[id]" placeholder="ID...">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td  style="width:20%;">
                                                        <div class="mb-3">
                                                            <label for="remise">REMISE(optionnelle)</label>
                                                            <input type="number" value="0" name="client[remise]" class="form-control" placeholder="Remise en %. ex : 10">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table-responsive table-borderless" style="width: 100%; border-spacing:0;">
                                            <thead>
                                                <tr style="background: #308e87;">
                                                    <th style="padding: 18px 15px; text-align: left; border-top-left-radius: 10px;"><span style="color: #fff; font-size: 16px; font-weight: 600;">Désignation</span></th>
                                                    <th style="padding: 18px 15px; text-align: center"><span style="color: #fff; font-size: 16px; font-weight: 600;">Prix unitaire</span></th>
                                                    <th style="padding: 18px 15px; text-align: center"><span style="color: #fff; font-size: 16px; font-weight: 600;">QTE</span></th>
                                                    <th style="padding: 18px 15px; text-align: center; border-top-right-radius: 10px;"><span style="color: #fff; font-size: 16px; font-weight: 600;">Sous-total</span></th>
                                                </tr>
                                            </thead>
                                            <tbody id="details-body">
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr style="height: 3px; width: 100%; background: linear-gradient(90deg, #308e87 20.61%, #0DA759 103.6%); display: block; margin-top: 6px;"></tr>
                                <tr>
                                    <td>
                                        <table style="width:100%;">
                                            <tbody>
                                                <tr style="display: flex; justify-content: space-between; margin: 16px 0 24px 0; align-items: end;">
                                                    <td></td>
                                                    <td>
                                                        <ul style="padding: 0; margin: 0; list-style: none;">
                                                            <li style="display:flex; padding-bottom: 16px; font-weight:900">
                                                                <span style="display: block; width: 150px;">Remise</span>
                                                                <span style="display: block; width: 25px;">:</span>
                                                                <span id="remise" style="display: block; width: 95px; color:rgb(20, 116, 206); opacity: 0.9; font-weight:600;">0.00 F</span>
                                                            </li>
                                                            <li style="display:flex; padding-bottom: 16px; font-weight:900">
                                                                <span style="display: block; width: 150px;">Total Général</span>
                                                                <span style="display: block; width: 25px;">:</span>
                                                                <span id="total-general" style="display: block; width: 95px; color: #308e87; opacity: 0.9; font-weight:600;">0.00 F</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr style="width: 100%; display: flex; justify-content: space-between;">
                                    <td></td>
                                    <td>
                                        <button type="submit" style="background: #308e87; color: #fff; border-radius: 10px; padding: 18px 27px; font-size: 16px; font-weight: 600; border: 0;">
                                            Créer & Imprimer
                                        </button>
                                        <button type="button" id="btnCancel" style="background:rgb(41, 46, 46); color: #fff; border-radius: 10px; padding: 18px 27px; font-size: 16px; font-weight: 600; border: 0;">
                                            Annuler tout
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-Fluid Ends-->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let detailsContainer = document.getElementById("details-body");
    let totalGeneral = document.getElementById("total-general");
    let remiseDisplay = document.getElementById("remise");
    let remiseInput = document.querySelector("input[name='client[remise]']");
    let rowIndex = 0;

    function updatePrice(select) {
        let selectedOption = select.options[select.selectedIndex];
        let prodInfo = selectedOption.getAttribute("data-info");

        if (prodInfo) {
            let product = JSON.parse(prodInfo);
            let row = select.closest("tr");
            let puInput = row.querySelector(".pu");
            let libelleInput = row.querySelector('.libelle')
            puInput.value = product.prod_pu || 0;
            libelleInput.value = product.prod_libelle || "";
            calculateSubtotal(puInput);
        }
    }

    function calculateSubtotal(input) {
        let row = input.closest("tr");
        let pu = parseFloat(row.querySelector(".pu").value) || 0;
        let qte = parseInt(row.querySelector(".qte").value) || 0;
        let subtotal = pu * qte;

        row.querySelector(".subtotal").innerText = `$${subtotal.toFixed(2)}`;
        updateTotalGeneral();
    }

    function updateTotalGeneral() {
        let total = 0;
        document.querySelectorAll(".subtotal").forEach(subtotalElement => {
            total += parseFloat(subtotalElement.innerText.replace("$", "")) || 0;
        });
        let remise = parseFloat(remiseInput.value) || 0;
        let remiseAmount = (total * remise) / 100;
        let totalAfterRemise = total - remiseAmount;
        
        remiseDisplay.innerText = `$${remiseAmount.toFixed(2)}`;
        totalGeneral.innerText = `$${totalAfterRemise.toFixed(2)}`;
    }

    function removeRow(button) {
        button.closest("tr").remove();
        updateTotalGeneral();
    }

    function addDetailRow() {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td style="padding: 15px;">
                <input type="text" class="libelle" name="details[${rowIndex}][libelle]" hidden required/>
                <select class="form-select item-select">
                    <option value="" selected hidden> Sélectionnez une rubrique !</option>
                    <?php foreach($configs as $value):?>
                    <option value="<?= $value["prod_id"]?>" data-info='<?= json_encode($value)?>'><?= $value["prod_libelle"]?></option>
                    <?php endforeach;?>
                </select>
            </td>
            <td style="width: 12%; text-align: center;">
                <input type="number" name="details[${rowIndex}][pu]" class="form-control pu" placeholder="Prix unitaire..." min="0" step="0.01" readOnly required/>
            </td>
            <td style="width: 12%; text-align: center;">
                <input type="number" value="1" name="details[${rowIndex}][qte]" class="form-control qte" placeholder="Qté..." min="1" step="1" required/>
            </td>
            <td style="width: 12%; text-align: center;">
                <span class="subtotal" style="color: #308e87; font-weight: 600; opacity: 0.9;">0.00 F</span>
                <button type="button" class="btn btn-sm ${rowIndex === 0 ? 'btn-primary add-detail' : 'btn-danger remove-detail'}">
                    <i class="fa-solid ${rowIndex === 0 ? 'fa-plus' : 'fa-close'}"></i>
                </button>
            </td>
        `;
        detailsContainer.appendChild(row);
        attachEventListeners(row);
        rowIndex++;
    }

    function attachEventListeners(row) {
        row.querySelector(".pu").addEventListener("input", function() {
            calculateSubtotal(this);
        });
        row.querySelector(".qte").addEventListener("input", function() {
            calculateSubtotal(this);
        });
        let removeButton = row.querySelector(".remove-detail");
        if (removeButton) {
            removeButton.addEventListener("click", function() {
                removeRow(this);
            });
        }
        row.querySelector(".item-select").addEventListener("change", function() {
            checkDuplicateItem(this);
        });
    }

    function checkDuplicateItem(select) {
        let selectedValue = select.value;
        if (!selectedValue) return;

        let existingRow = [...document.querySelectorAll(".item-select")].find(el => el !== select && el.value === selectedValue);
        if (existingRow) {
            let existingQteInput = existingRow.closest("tr").querySelector(".qte");
            existingQteInput.value = parseInt(existingQteInput.value) + 1;
            calculateSubtotal(existingQteInput);
            select.closest("tr").remove();
            updateTotalGeneral();
        } else {
            updatePrice(select);
        }
    }

    addDetailRow();

    document.addEventListener("click", function(event) {
        if (event.target.closest(".add-detail")) {
            addDetailRow();
        }
    });

    // Remplissage automatique du client
    document.getElementById("existClient").addEventListener("change", function() {
        let selectedOption = this.options[this.selectedIndex];
        let clientInfo = selectedOption.getAttribute("data-info");
        if (clientInfo) {
            let client = JSON.parse(clientInfo);
            document.querySelector("input[name='client[nom]']").value = client.full_name || "";
            document.querySelector("input[name='client[phone]']").value = client.phone || "";
            document.querySelector("input[name='client[id]']").value = client.id || "";
        }
    });

    // Mise à jour de la remise
    remiseInput.addEventListener("input", updateTotalGeneral);

    // Annuler tout
    document.getElementById("btnCancel").addEventListener("click", function() {
        document.getElementById("existClient").selectedIndex = 0;
        document.querySelector("input[name='client[nom]']").value = "";
        document.querySelector("input[name='client[phone]']").value = "";
        document.querySelector("input[name='client[id]']").value = "";
        remiseInput.value = "";
        remiseDisplay.innerText = "$0.00";
        totalGeneral.innerText = "$0.00";
        detailsContainer.innerHTML = "";
        rowIndex = 0;
        addDetailRow();
    });
});

</script>