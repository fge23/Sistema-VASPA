<link href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" type="text/css" rel="stylesheet" />
<footer class="footer">
    <span class="oi oi-person"></span> 
    <?php $usuario = $_SESSION['usuario']; 
    echo $usuario->nombre;
    ?>
    <a href="../app/salir.php">Salir</a>
</footer>
