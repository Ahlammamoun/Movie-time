<?php

namespace App\Datafixtures\Provider;


class MovieTimeProvider 
{


    private $movies = [


        'antones',
        'vite bidouille',
        'les comptes de la script',
        'hotel transvanilla',
        'moon',
        'les solistes',
        'plus moche la vie',
        'stratosphère',
        'et téléphone maison',
        'john que',
        'hey man',






    ];

    private $genre = [];


    public function movieGenre()
    {
        return $this->genres[array_rand($this->genres)];
    }


    public function movieTitle()
    {
        return $this->movies[array_rand($this->movies)];
    }




















}