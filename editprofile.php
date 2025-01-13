<?php
    require_once("templates/header.php");
    require_once("dao/UsuarioDAO.php");

    $userDao = new UsuarioDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

?>
   <div id="main-container" class="container-fluid">
    <h1>Perfil</h1>
   </div>
<?php
    require_once("templates/footer.php")
?>