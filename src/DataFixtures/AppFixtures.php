<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Position;
use App\Entity\Station;
use App\Entity\Status;
use App\Entity\Statut;
use App\Entity\User;
use App\Services\DatasExt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**@var UserPasswordEncoderInterface */
    private $encoder;

    /**@var DatasExt */
    private $dataExt;


    public function __construct(UserPasswordEncoderInterface $encoder, DatasExt $datasExt)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        //User datas creation
        $user = new User();
        $user->setEmail("admin@email.fr");
        $hash = $this->encoder->encodePassword($user, "admin");
        $user->setPassword($hash);
        $user->setRoles(["ADMIN"]);
        $manager->persist($user);

        //Status datas creation
        $statusActivated = new Statut();
        $statusActivated->setName("Activated");
        $statusDeactivated = new Statut();
        $statusDeactivated->setName("Deactivated");
        $manager->persist($statusActivated);
        $manager->persist($statusDeactivated);


        //Cities datas creation
        $json = file_get_contents("https://api.jcdecaux.com/vls/v3/contracts?apiKey=eac86f2a1287f417645f574439af24278441bd8a");
        $obj = json_decode($json, true);

        foreach ($obj as $city) {
            $newcity = new City();
            $newcity->setName($city['name']);
            $newcity->setStatut($statusDeactivated);
            $manager->persist($newcity);


            //Station datas creation
            $json = file_get_contents("https://api.jcdecaux.com/vls/v1/stations?contract=". $newcity->getName() ."&apiKey=eac86f2a1287f417645f574439af24278441bd8a");
            $obj = json_decode($json, true);

            foreach ($obj as $station) {
                $newStation = new Station();
                $newStation->setName($station['name']);
                $newStation->setAdress($station['address']);
                $newStation->setStatut($statusDeactivated);
                $newStation->setCapacity($station['bike_stands']);
                $newStation->setBikeQuantityAvailable($station['available_bikes']);
                $newStation->setCity($newcity);
                $newPosition = new Position();
                $newPosition->setLatitude($station['position']['lat']);
                $newPosition->setLongitude($station['position']['lng']);
                $newStation->setPosition($newPosition);
                $manager->persist($newPosition);
                $manager->persist($newStation);

            }
        }



        $manager->flush();
    }

}
