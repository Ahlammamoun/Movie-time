<?php 

namespace App\DataFixtures;


use App\DataFixtures\Provider\MovieTimeProvider;
use Doctrine\bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Casting;
use App\Entity\Season;
use App\Entity\User;
use DateTime;
use Faker\Factory as Faker;
use Doctrine\DBAL\Connexion;
use Symfony\Component\PasswordHasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    //comment executer du pure sql
    private $connexion;

    public function __construct(Connexion $connexion, UserPasswordHasherInterface $hasher){

        $this->connexion = $connexion;
        $this->$hasher = $hasher;
    }


    public function truncate()
    {

        //on désactive les fk sinon truncate ne fonctionne pas
        $this->connexion->executeQuery('SET foreign_key_checks = 0');


        //le TRUNCATE remet l'auto incrément à 1
        $this->connexion->executeQuery('TRUNCATE TABLE casting');
        $this->connexion->executeQuery('TRUNCATE TABLE genre');
        $this->connexion->executeQuery('TRUNCATE TABLE user');
        $this->connexion->executeQuery('TRUNCATE TABLE movie');
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
            

            $users = [

                [
                    'login' => 'admin@admin.com',
                    'passeword' => 'admin',
                    'roles' => 'ROLE_ADMIN',
                ],
                [
                    'login' => 'manager@manager.com',
                    'passeword' => 'manager',
                    'roles' => 'ROLE_MANAGER',
                ],
                [
                    'login' => 'user@user.com',
                    'passeword' => 'user',
                    'roles' => 'ROLE_USER',
                ],


             


            ];


                    foreach ($users as $currentUser){


                        $newUser = new Users();
                        $newUser->setEmail($currentUser['login']);
                        $newUser->setRoles($currentUser['roles']);
                        $newUser->setPassword($currentUser['password']);
                    
                        
        
                        $hashedPassword = $this->$hasher->hashPassword(
                            $newUser,
                            $currentUser['password']
                        );
                        $newUser->setPassword($hashedPassword);
                        $doctrine->persist($newUser);

                    }

        }
        $doctrine->flush();

    }

}