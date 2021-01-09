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

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager){

        //Status datas creation
        $statusAble = new Status();
        $statusAble->setName("Able");
        $manager->persist($statusAble);

        $statusDisable = new Status();
        $statusDisable->setName("Disable");
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