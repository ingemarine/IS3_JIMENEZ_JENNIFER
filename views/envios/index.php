<h2 class="text-center text-primary">ESTADO DE ENVIOS</h2>
<div class="row justify-content-center mt-4">
    <div class="col-lg-10 table-wrapper">
        <h2 class="text-center mb-4">PRODUCTOS ENVIADOS</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover w-100" id="envios">
            </table>
        </div>
    </div>
</div>
<script>
    const userRole = '<?= $_SESSION['user']['roles_nombre'] ?>';
</script>
<script src="<?=  asset('/build/js/envios/index.js' )?>" ></script>

