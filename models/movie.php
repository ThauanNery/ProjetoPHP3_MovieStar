<?php

    class Movie{

        public $id;
        public $title;
        public $description;
        public $image;
        public $trailer;
        public $category;
        public $length;
        public $usuario_id;

        public function imageGenerateName()
        {
            return bin2hex(random_bytes(60)) . "jpg";
        }
    }

        interface MovieDaoInterface{
            public function BuildMovie($data);
            public function FindAll();
            public function getLatestMovies();
            public function getMovieByCategory($category);
            public function getMoviesByUserId($id);
            public function FinById($id);
            public function findByTitle($title);
            public function create(movie $movie);
            public function update(movie $movie);
            public function destroy($id);
        }