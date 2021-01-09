<?php


namespace App\Data;


use App\Entity\Status;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class datas
{

    /**@var UserPasswordEncoderInterface */
    private $encoder;

    /**@var ObjectManager */
    private $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    /**
     */
    public function load(){

        //Status datas creation
        $statusAble = new Status();
        $statusAble->setName("Able");
        $this->manager->persist($statusAble);

        $statusDisable = new Status();
        $statusDisable->setName("Disable");
        $this->manager->persist($statusDisable);

        //User datas creation
        $user = new User();
        $user->setEmail("admin@email.fr");
        $hash = $this->encoder->encodePassword($user, "admin");
        $user->setPassword($hash);
        $user->setRoles(["ADMIN"]);
        $this->manager->persist($user);

        $this->manager->flush();

    }

}