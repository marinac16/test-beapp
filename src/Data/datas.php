<?php


namespace App\Data;


use App\Entity\Status;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class datas
{
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
        $user->setPassword("admin");
        $user->setRoles(["ADMIN"]);

        $manager->flush();

    }

}