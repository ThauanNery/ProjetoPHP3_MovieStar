<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Usuario.php");
    require_once("models/Message.php");
    require_once("dao/UsuarioDAO.php");
    
    $message = new Message($BASE_URL_URL);

    //Verifica o tipo do form
    $type = filter_input(INPUT_POST, "type");

    //Verificação do tipo de form
    if($type === "register")
    {
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword");

        //Verificação de dados min
        if($name && $lastname && $email && $password)
        {

        }
        else
        {
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
        }
    }
    else if($type === "login")
    {
        
    }