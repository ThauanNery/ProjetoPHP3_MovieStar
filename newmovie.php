<?php
    require_once("templates/header.php");
    require_once("models/Usuario.php");
    require_once("dao/UsuarioDAO.php");

    $user = new Usuario();
    $userDao = new UsuarioDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

?>
   <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title"> Adicionar Filme</h1>
            <p class="page-description">Adicione sua critica e compartilhe com o mundo!</p>
            <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Digite o titulo do filme">
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="length">Duração:</label>
                    <input type="text" class="form-control" name="length" id="length" placeholder="Digite a duração do filme">
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select type="text" class="form-control" name="category" id="category">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Comedia">Comedia</option>
                        <option value="Fantasia/Ficção">Fantasia/Ficção</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">trailer:</label>
                    <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Insira o link do trailer">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme..."></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar">
            </form>
        </div>
   </div>
<?php
    require_once("templates/footer.php")
?>