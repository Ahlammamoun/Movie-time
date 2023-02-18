<?php 

namespace App\DataFixtures;


use App\DataFixtures\Provider\MovieTimeProvider;
use Doctrine\bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Casting;
use App\Entity\Season;
use App\Entity\User;
use DateTime;
use Faker\Factory as Faker;
use Doctrine\DBAL\Connection;
use Symfony\Component\PasswordHasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    //comment executer du pure sql
    private $connection;
    private $hasher;


    public function __construct(Connection $connection, UserPasswordHasherInterface $hasher){

        $this->connection = $connection;
        $this->$hasher = $hasher;
    }


    public function truncate()
    {

        //on désactive les fk sinon truncate ne fonctionne pas
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        //le TRUNCATE remet l'auto incrément à 1
        $this->connection->executeQuery('TRUNCATE TABLE casting');
        $this->connection->executeQuery('TRUNCATE TABLE genre');
        $this->connection->executeQuery('TRUNCATE TABLE user');
        $this->connection->executeQuery('TRUNCATE TABLE movie');
        //etc 

    }

    public function load(ObjectManager $manager): void
    {
        $this->truncate();
        $faker = Faker::create('fr_FR');
        $MovieTimeProvider = new MovieTimeProvider();
        /***genre */


        /***movie */
        for ($i = 1; $i<20; $i++)
        {
            $newMovie = new Movie();

            $newMovie->setTitle($MovieTimeProvider->movieTitle());
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
            //casting
            for ($i=0; $i < mt_rand(1, 5); $i++){

                $casting = new Casting();
                $casting->setRole("Rôle #" . $i);
                $casting->creditOrder($i);

                $randomMovie = $allMovieEntity[mt_rand(0, count($allMovieEntity) - 1)];
                $casting->setMovie($randomMovie);
                $randomActor = $allActorEntity[mt_rand(0, count($allActorEntity) - 1)];

                $casting->setActor($randomActor);

                $manager->persist($casting);
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