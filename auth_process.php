<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Usuario.php");
    require_once("models/Message.php");
    require_once("dao/UsuarioDAO.php");
    
    $message = new Message($BASE_URL);

    $userDao = new UsuarioDAO($conn, $BASE_URL);

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
            //verificar se as senhas batem
            if($password === $confirmPassword)
            {
                //verificar se o email já está cadastrado
                if($userDao->findByEmail($email) === false)
                {
                    $user = new Usuario();

                    //criação de token e senha

                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDao->create($user, $auth);
                }
                else
                {
                    $message->setMessage("E-mail já cadastrado.", "error", "back");
                }
            }
            else
            {
                $message->setMessage("As senhas não são iguais.", "error", "back");
            }
        }
        else
        {
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
        }
    }
    else if($type === "login")
    {
        
    }