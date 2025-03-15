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
                    <form class="card-body" method="post" action="/create_invoice">
                        <?php displayFlashMessage(); ?>
                        <table class="table-wrapper table-responsive table-borderless theme-scrollbar">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table-responsive table-borderless" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <ul style="list-style: none; display: flex; gap:15px; padding: 0; margin: 20px 0;">
                                                            <li><span style="font-size: 16px; font-weight: 600; opacity: 0.8;">CLIENT</span></li>
                                                            <li><input type="text" class="form-control" name="client[nom]" placeholder="Nom complet..." required></li>
                                                            <li><input type="text" class="form-control" name="client[phone]" placeholder="Téléphone..." required></li>
                                                        </ul>
                                                    </td>
                                                    <td></td>
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
                                                <tr>
                                                    <td style="padding: 15px;">
                                                        <input type="text" name="details[0][libelle]" class="form-control" placeholder="Saisir la désignation..." required/>
                                                    </td>
                                                    <td style="width: 12%; text-align: center;">
                                                        <input type="number" name="details[0][pu]" class="form-control pu" placeholder="Prix unitaire..." min="0" step="0.01" oninput="calculateSubtotal(this)" required/>
                                                    </td>
                                                    <td style="width: 12%; text-align: center;"> 
                                                        <input type="number" name="details[0][qte]" class="form-control qte" placeholder="Qté..." min="1" step="1" oninput="calculateSubtotal(this)" required/>
                                                    </td>
                                                    <td style="width: 12%; text-align: center;"> 
                                                        <span class="subtotal" style="color: #308e87; font-weight: 600; opacity: 0.9;">$0.00</span> 
                                                        <button type="button" class="btn btn-sm btn-primary" id="add-detail"> <i class="fa-solid fa-plus"></i></button>
                                                    </td>
                                                </tr>
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
                                                                <span style="display: block; width: 150px;">Total Général</span>
                                                                <span style="display: block; width: 25px;">:</span>
                                                                <span id="total-general" style="display: block; width: 95px; color: #308e87; opacity: 0.9; font-weight:600;">$0.00</span>
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
        let rowIndex = 0;

        // Fonction pour ajouter une nouvelle ligne de détail
        function addDetailRow() {
            rowIndex++;
            let row = document.createElement("tr");
            row.innerHTML = `
                <td style="padding: 15px;">
                    <input type="text" name="details[${rowIndex}][libelle]" class="form-control" placeholder="Saisir la désignation..." required/>
                </td>
                <td style="width: 12%; text-align: center;">
                    <input type="number" name="details[${rowIndex}][pu]" class="form-control pu" placeholder="Prix unitaire..." min="0" step="0.01" required/>
                </td>
                <td style="width: 12%; text-align: center;"> 
                    <input type="number" name="details[${rowIndex}][qte]" class="form-control qte" placeholder="Qté..." min="1" step="1" required/>
                </td>
                <td style="width: 12%; text-align: center;"> 
                    <span class="subtotal" style="color: #308e87; font-weight: 600; opacity: 0.9;">$0.00</span> 
                    <button type="button" class="btn btn-sm btn-danger remove-detail"> <i class="fa-solid fa-close"></i></button>
                </td>
            `;

            detailsContainer.appendChild(row);
            attachEventListeners(row);
        }

        // Fonction pour supprimer une ligne
        function removeRow(button) {
            button.closest("tr").remove();
            updateTotalGeneral();
        }

        // Fonction pour calculer le sous-total et total général
        function calculateSubtotal(input) {
            let row = input.closest("tr");
            let pu = parseFloat(row.querySelector(".pu").value) || 0;
            let qte = parseInt(row.querySelector(".qte").value) || 0;
            let subtotal = pu * qte;

            row.querySelector(".subtotal").innerText = `$${subtotal.toFixed(2)}`;
            updateTotalGeneral();
        }

        // Fonction pour mettre à jour le total général
        function updateTotalGeneral() {
            let total = 0;
            document.querySelectorAll(".subtotal").forEach(subtotalElement => {
                total += parseFloat(subtotalElement.innerText.replace("$", "")) || 0;
            });
            totalGeneral.innerText = `$${total.toFixed(2)}`;
        }

        // Fonction pour attacher les écouteurs d'événements
        function attachEventListeners(row) {
            row.querySelector(".pu").addEventListener("input", function() {
                calculateSubtotal(this);
            });
            row.querySelector(".qte").addEventListener("input", function() {
                calculateSubtotal(this);
            });
            row.querySelector(".remove-detail").addEventListener("click", function() {
                removeRow(this);
            });
        }

        // Ajouter un écouteur sur le bouton "+"
        document.getElementById("add-detail").addEventListener("click", addDetailRow);

        // Attacher les événements initiaux
        document.querySelectorAll("#details-body tr").forEach(attachEventListeners);
    });
</script>