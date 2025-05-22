<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Usuario.php");
    require_once("models/Message.php");
    require_once("dao/UsuarioDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UsuarioDAO($conn, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");

    //atualizar usuario
    if($type === "update")
    {
        //resgata dados do usua´rio
        $userData = $userDao->verifyToken();

        //receber dados do post
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        //criar novo obj de usuário
        $user = new Usuario();

        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->bio = $bio;

        // Upload da imagem
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
            
            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checagem de tipo de imagem
            if(in_array($image["type"], $imageTypes)) {

                // Checar se jpg
                if(in_array($image, $jpgArray)) {

                $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                // Imagem é png
                } else {

                $imageFile = imagecreatefrompng($image["tmp_name"]);

                }

                $imageName = $user->imageGenerateName();

                imagejpeg($imageFile, "./img/users/" . $imageName, 100);

                $userData->image = $imageName;

            } else {

                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

            }
        }

        $userDao->update($userData);
    } 
    //atualizar senha do usuário
    else if($type === "changepassword")
    {
        //receber dados do post
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //regatando dados do usuário
        $userData = $userDao->verifyToken();
        $id = $userData->id;

        if($password == $confirmpassword)
        {
            $user = new Usuario();

            $finalPassword = $user->generatePassword($password);

            $user->password = $finalPassword;
            $user->id = $id;

            $userDao->changePassword($user);
        }
        else
        {
            $message->setMessage("As senhas não são iguais!", "error", "back");

        }

    }
    else 
    {
            
        $message->setMessage("Informações inválidas", "error", "index.php");

    }