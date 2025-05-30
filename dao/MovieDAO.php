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
            $movie = new Movie();
  
            $movie->id = $data["id"];
            $movie->title = $data["title"];
            $movie->description = $data["description"];
            $movie->image = $data["image"];
            $movie->trailer = $data["trailer"];
            $movie->category = $data["category"];
            $movie->lenght = $data["lenght"];
            $movie->usuario_id = $data["usuario_id"];
      
            return $movie;
        }
        
        public function FindAll(){}

        public function getLatestMovies()
        {
            $movies = [];

            $stmt = $this->conn->query("SELECT * FROM filmes ORDER BY id DESC");

            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $moviesArray = $stmt->fetchAll();

                foreach($moviesArray as $movie)
                {
                    $movies[] = $this->buildMovie($movie);
                }
            }

            return $movies;
        }

        public function getMovieByCategory($category)
        {
            
            $movies = [];

            $stmt = $this->conn->prepare("SELECT * FROM filmes 
                                          WHERE category = :category
                                          ORDER BY id DESC");

            $stmt->bindParam(":category", $category);

            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $moviesArray = $stmt->fetchAll();

                foreach($moviesArray as $movie)
                {
                    $movies[] = $this->buildMovie($movie);
                }
            }

            return $movies;
        }

        public function getMoviesByUserId($id){}

        public function FinById($id){}

        public function findByTitle($title){}
        
        public function create(movie $movie)
        {
            $stmt = $this->conn->prepare("INSERT INTO filmes (
            title, description, image, trailer, category, lenght, usuario_id
            )VALUES(
            :title, :description, :image, :trailer, :category, :lenght, :usuario_id
            )");

            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":lenght", $movie->lenght);
            $stmt->bindParam(":usuario_id", $movie->usuario_id);

            $stmt->execute();

            $this->message->setMessage("Filme adicionado com sucesso!", "success", "index.php");
        }

        public function update(movie $movie){}

        public function destroy($id){}
    }