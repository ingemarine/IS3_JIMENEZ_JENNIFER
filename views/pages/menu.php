<h1 class="text-center">Bienvenido a la Aplicación MVC-2-2024</h1>

<?php if ($_SESSION['user']['roles_nombre'] == 'LOGIN_ADMIN') : ?>
    <div class="row">
        <div class="container d-flex justify-content-center align-items-center mt-5">
            <div class="card text-center shadow-lg">
                <div class="card-header bg-primary text-white">
                    ¡Bienvenido, Usted es un Administrador!
                </div>
                <div class="card-body">
                    <h5 class="card-title">Has ingresado a la aplicación</h5>
                    <p class="card-text">MVC-2-2024</p>
                </div>
                <div class="card-footer text-muted">
                    Usted puede ingresar a todas las funciones de esta aplicación.
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="container d-flex justify-content-center align-items-center mt-5">
            <div class="card text-center shadow-lg">
                <div class="card-header bg-secondary text-white">
                    ¡Bienvenido, Usted es un Usuario!
                </div>
                <div class="card-body">
                    <h5 class="card-title">Has ingresado a la aplicación</h5>
                    <p class="card-text">MVC-2-2024</p>
                </div>
                <div class="card-footer text-muted">
                    Estamos aca para ayudarte.
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script src="build/js/menu/menu.js"></script>