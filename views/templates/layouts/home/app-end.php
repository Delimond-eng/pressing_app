<?php include __DIR__ . "/../components/footer.php"; ?>
<?php $session = json_encode($_SESSION["user"]); ?>
</div>
</div>
<!-- jquery-->
<script src="assets/js/vendors/jquery/jquery.min.js"></script>
<!-- bootstrap js-->
<script src="assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
<script src="assets/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
<script src="assets/js/vendors/select2/js/select2.full.min.js"></script>
<!--fontawesome-->
<script src="assets/js/vendors/font-awesome/fontawesome-min.js"></script>
<!-- sidebar -->
<script src="assets/js/sidebar.js"></script>
<!-- config-->
<script src="assets/js/config.js"></script>
<!-- scrollbar-->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>
<!-- slick-->
<script src="assets/js/slick/slick.min.js"></script>
<script src="assets/js/slick/slick.js"></script>
<!-- touchspin -->
<script src="assets/js/touchspin_2/custom_touchspin.js"></script>
<!-- data_table-->
<!-- swiper-->
<script src="assets/js/vendors/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/js-datatables/datatables/datatable.custom1.js"></script>


<!-- custom script -->
<script src="assets/js/script.js"></script>


<script>
    $(document).ready(function() {
        let user = <?= $session ?>;
        if(user.role !== "admin"){
            $("#pageWrapper").addClass("sidebar-open");
        }
        if ($("#existClient").length) {
            $("#existClient").select2({
                placeholder: "Sélectionnez un client existant...",
                closeOnSelect: true
            }).on('select2:open', function() {
                $('.select2-search__field').attr('placeholder', 'Recherchez un client...');
            });

            /* $("#existClient").on("change", function() {
                let selectedOption = $(this).find("option:selected");
                let clientInfo = selectedOption.data("info");
                
                if (clientInfo) {
                    let client = clientInfo;
                    $("input[name='client[nom]']").val(client.full_name || "");
                    $("input[name='client[phone]']").val(client.phone || "");
                    $("input[name='client[id]']").val(client.id || "");
                }
            }); */
        }
        if ($("#tableDashboard").length) {
            $("#tableDashboard").DataTable({
                order: [[4, "asc"]],
                language: {
                    searchPlaceholder: "Rechercher un élément...",
                    sProcessing: "Traitement en cours...",
                    sLengthMenu: "Afficher _MENU_ éléments",
                    sZeroRecords: "Aucun élément correspondant trouvé",
                    sInfo: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    sInfoEmpty: "Affichage de 0 à 0 sur 0 éléments",
                    sInfoFiltered: "(filtré de _MAX_ éléments au total)",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Premier",
                        sPrevious: "Précédent",
                        sNext: "Suivant",
                        sLast: "Dernier",
                    },
                },
            });
            $(".dataTables_filter input").on("focus", function(e){
                $(this).val("Facture n°");
            });
            $(".dataTables_filter input").on("mouseleave", function(e){
                $(this).val("");
            });
        }
        if ($("#tableReport").length) {
            var table = $('#tableReport').DataTable({
                language: {
                    searchPlaceholder: "Rechercher un élément...",
                    sProcessing: "Traitement en cours...",
                    sLengthMenu: "Afficher _MENU_ éléments",
                    sZeroRecords: "Aucun élément correspondant trouvé",
                    sInfo: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    sInfoEmpty: "Affichage de 0 à 0 sur 0 éléments",
                    sInfoFiltered: "(filtré de _MAX_ éléments au total)",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Premier",
                        sPrevious: "Précédent",
                        sNext: "Suivant",
                        sLast: "Dernier",
                    },
                }
            });
            function updateFooter() {
                var total = 0;
                table.column(4, {
                    search: 'applied'
                }).nodes().each(function(cell) {
                    var value = $(cell).text().replace(/[^0-9.-]+/g, "");
                    total += parseFloat(value) || 0; 
                });
                $('#tableReport tfoot td:eq(1)').html('<h6 class="fw-bold">' + total.toLocaleString('fr-FR') + ' F</h6>');
            }
            table.on('draw', function() {
                updateFooter();
            });
            updateFooter();
        }
        $(".dataTables_filter input").addClass("form-control border-primary");
        $(".dataTables_length select").addClass("form-control border-primary");
    })
</script>
</body>

</html>