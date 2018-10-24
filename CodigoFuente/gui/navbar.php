<!-- Los estilos de navbar son definidos en la libreria css de Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <img src="../lib/img/Logo-VASPA.png" width="100" height="60" class="d-inline-block align-top" alt="">
        
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
        <span class="navbar-toggler-icon"></span>   
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="../uargflow/usuarios.php">
                    <span class="oi oi-person" />
                    Usuarios
                </a>
            </li>

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_ROLES)) { ?>
                <li class = "nav-item">
                    <a class = "nav-link" href = "../uargflow/roles.php">
                        <span class = "oi oi-graph" />
                        Roles
                    </a>
                </li>
            <?php } ?>

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_PERMISOS)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../uargflow/permisos.php">
                        <span class="oi oi-lock-locked" />
                        Permisos
                    </a>
                </li>
                <?php } ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="../uargflow/salir.php">
                        <span class="oi oi-account-logout" /> 
                        Salir
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="alert alert-info alert-dismissible fade show" role="alert">
        Ud. est&aacute; conectad@ como <strong><?= $_SESSION['usuario']->nombre; ?></strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>