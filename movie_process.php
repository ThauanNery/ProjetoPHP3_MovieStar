<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("dao/UsuarioDAO.php");
    require_once("dao/MovieDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UsuarioDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");

    $userData = $userDao->verifyToken();

    if($type === "create")
    {
        //Receber dados dos inputs
        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $lenght = filter_input(INPUT_POST, "lenght");

        $movie = new Movie();

        //validação minima de dados
        if(!empty($title) && !empty($description) && !empty($category))
        {
            $movie->title = $title;
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->lenght = $lenght;
            $movie->usuario_id = $userData->id;

             // Upload de imagem do filme
            if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                // Checando tipo da imagem
                if(in_array($image["type"], $imageTypes)) {

                // Checa se imagem é jpg
                if(in_array($image["type"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                // Gerando o nome da imagem
                $imageName = $movie->imageGenerateName();

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;

                } else {

                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

                }
                    
            }
        }
        else
        {
            $message->setMessage("Os campos titulo, descrição e categoria devem está preenchidos", "error", "back");
        }

        $movieDao->create($movie);
    }
    else
    {
        $message->setMessage("Informações inválidas", "error", "index.php");
    }