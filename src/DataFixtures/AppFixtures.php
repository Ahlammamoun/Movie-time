<?php 

namespace App\DataFixtures;


use App\Entity\Season;
use Doctrine\bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use DateTime;
use Doctrine\DBAL\Connexion;


class AppFixtures extends Fixture
{
    //comment executer du pure sql
    private $connexion;

    public function __construct(Connexion $connexion){

        $this->connexion = $connexion;
    }


    public function truncate()
    {

        //on désactive les fk sinon truncate ne fonctionne pas
        $this->connexion->executeQuery('SET foreign_key_checks = 0');


        //le TRUNCATE remet l'auto incrément à 1
        $this->connexion->executeQuery('TRUNCATE TABLE casting');
        $this->connexion->executeQuery('TRUNCATE TABLE genre');
        //etc 

    }


    public function load(ObjectManager $manager): void
    {

        $this->truncate();

        /***genre */




        /***movie */
        for ($i = 1; $i<20; $i++)
        {
            $newMovie = new Movie();

            $newMovie->setTitle("Film #" . $i);
            $newMovie->setDuration(rand(30, 180));
        
            $type = rand(1, 2) == 1 ? 'Film' : 'Serie';

            $newMovie->setType($type);
            $newMovie->setReleaseDate(new DateTime("now"));
            $newMovie->setSummary("Lorem");
            $newMovie->setSynopsis("lorem ipsum");
            $newMovie->setPoster('https://picsum.photos/id/'.mt_rand(1, 100).'/450/350');
            
            //j'ajoute des saisons pour au séries
            if ($type == 'Série')
            {

                $nbSeason = rand(0, 5);
                for ($j = 1; $j <= $nbSeason; $j++)
                {
                    $newSeason = new Season();
                    $newSeason->setNumber($j);
                    $newSeason->setEpisodesNumber(mt_rand(6, 24));

                    //on persiste pour que le manager prenne connaissance de ce nouvel objet
                    $manager->persist($newSeason);

                    //j'ajoute ça à mon movie
                    $newMovie->addSeason($newSeason);
                }



            }
            
            
            $doctrine->persist($newMovie);
        }
        $doctrine->flush();


    }





}