<?php

    require_once("models/Movie.php");
    require_once("models/Message.php");

    //Review DAO

    class MovieDAO implements MovieDaoInterface
    {
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url)
        {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data)
        {
            $user = new Movie();
  
            $movie->id = $data["id"];
            $movie->title = $data["name"];
            $movie->description = $data["lastname"];
            $movie->image = $data["email"];
            $movie->trailer = $data["password"];
            $movie->category = $data["image"];
            $movie->lenght = $data["bio"];
            $movie->users_id = $data["token"];
      
            return $movie;
        }
        
        public function FindAll(){}

        public function getLatestMovies(){}

        public function getMovieByCategory($category){}

        public function getMoviesByUserId($id){}

        public function FinById($id){}

        public function findByTitle($title){}
        
        public function create(movie $movie){}

        public function update(movie $movie){}

        public function destroy($id){}
    }