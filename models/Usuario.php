<?php

    class Usuario
    {
        public $id;
        public $nome;
        public $sobrenome;
        public $email;
        public $senha;
        public $imagem;
        public $bio;
        public $token;
    }

    interface UserDAOInterface
    {
        public function buildeUser($data);
        public function create(Usuario $user, $authUser = false);
        public function upadete(Usuario $user);
        public function verifyToken($protected = false);
        public function steTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $senha);
        public function findByEmail($email);
        public function findById($id);
        public function findByToken($token);
        public function changePassword(Usuario $user);
    }