<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Status;
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


        /*//Cities datas creation
        $obj = $this->dataExt->getDatas("https://api.jcdecaux.com/vls/v3/contracts?apiKey=eac86f2a1287f417645f574439af24278441bd8a");

        foreach ($obj['name'] as $city) {
            $newcity = new City();
            $newcity->setName($city);
            $manager->persist($newcity);
            $manager->flush();


        }*/




        $manager->flush();
    }

}
