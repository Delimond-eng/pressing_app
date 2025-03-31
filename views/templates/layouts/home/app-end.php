
<?php include __DIR__."/../components/footer.php";?>
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


<!-- custom script -->
<script src="assets/js/script.js"></script>


<script>
    $(document).ready(function(){
        if($("#existClient").length){
            $("#existClient").select2({
                placeholder:"Sélectionnez un client existant...",
                closeOnSelect:true
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
    })
</script>
</body>

</html>