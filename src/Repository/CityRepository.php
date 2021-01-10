<?php

namespace App\Repository;

use App\Entity\City;
use App\Services\DatasExt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function getCities(ObjectManager $manager){
        $json = file_get_contents("https://api.jcdecaux.com/vls/v3/contracts?apiKey=eac86f2a1287f417645f574439af24278441bd8a");
        $obj = json_decode($json);
        foreach ($obj['name'] as $city){
            $newcity = new City();
            $newcity->setName($city);
            $manager->persist($newcity);
            $manager->flush();


        }
    }




}
