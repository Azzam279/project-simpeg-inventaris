<input type="hidden" id="host" value="<?=$host?>">

<?php
include_once("$docs/database/koneksi.php");
include_once("$docs/modals.php");
?>

<!-- BEGIN JAVASCRIPT -->
<script src="<?="$host/assets/js/libs/jquery/jquery-1.11.2.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/bootstrap/bootstrap.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/spin.js/spin.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/autosize/jquery.autosize.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/jquery-validation/dist/jquery.validate.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/jquery-validation/dist/additional-methods.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/toastr/toastr.js"?>"></script>
<script src="<?="$host/assets/js/core/source/App.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppNavigation.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppOffcanvas.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppCard.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppForm.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppNavSearch.js"?>"></script>
<script src="<?="$host/assets/js/core/source/AppVendor.js"?>"></script>
<script src="<?="$host/assets/js/libs/DataTables/jquery.dataTables.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"?>"></script>
<script src="<?="$host/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"?>"></script>
<script src="<?="$host/assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"?>"></script>
<script src="<?="$host/assets/js/core/demo/Demo.js"?>"></script>
<script src="<?="$host/assets/js/sweetalert.min.js"?>"></script>
<script src="<?="$host/assets/js/custom-script.js"?>"></script>
<!-- END JAVASCRIPT -->

<?php
ob_end_flush();
?>