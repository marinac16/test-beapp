<?php

namespace App\DataFixtures;

use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**@var UserPasswordEncoderInterface */
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        //Status datas creation
        $statusAble = new Status();
        $statusAble->setName("Open");
        $manager->persist($statusAble);

        $statusDisable = new Status();
        $statusDisable->setName("Close");
        $manager->persist($statusDisable);

        //User datas creation
        $user = new User();
        $user->setEmail("admin@email.fr");
        $hash = $this->encoder->encodePassword($user, "admin");
        $user->setPassword($hash);
        $user->setRoles(["ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}
