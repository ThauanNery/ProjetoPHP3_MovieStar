<?php

    require_once("models/Usuario.php");

    class UsuarioDAO implements UserDAOInterface
    {

        private $conn;
        private $url;

        public function __construct(PDO $conn, $url)
        {
            $this->conn = $conn;
            $this->url = $url;
        }

        public function buildeUser($data)
        {
            $user = new Usuario();

            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->image = $data['image'];
            $user->bio = $data['bio'];
            $user->token = $data['token'];

        }
        public function create(Usuario $user, $authUser = false)
        {

        }
        public function upadete(Usuario $user)
        {

        }
        public function verifyToken($protected = false)
        {

        }
        public function steTokenToSession($token, $redirect = true)
        {

        }
        public function authenticateUser($email, $password)
        {

        }
        public function findByEmail($email)
        {

        }
        public function findById($id)
        {

        }
        public function findByToken($token)
        {

        }
        public function changePassword(Usuario $user)
        {

        }
    }