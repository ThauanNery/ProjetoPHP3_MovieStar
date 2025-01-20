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

        $userDao->update($userData);
    } 
    //atualizar senha do usuário
    else if($type === "changepassword")
    {

    }
    else 
    {
            
        $message->setMessage("Informações inválidas", "error", "index.php");

    }