<?php

namespace App\Repository;

use App\Entity\Record;
use App\Entity\Track;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Track|null find($id, $lockMode = null, $lockVersion = null)
 * @method Track|null findOneBy(array $criteria, array $orderBy = null)
 * @method Track[]    findAll()
 * @method Track[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Track::class);
    }

    /**
     * Retourne la liste des pistes d'un disque à partir de l'identifiant du disque
     * @param $recordId
     * @return int|mixed|string
     */
    public function findByRecordId($recordId)
    {
        return
            //Récupération d'un querybuilder préparamétré avec
            //un select sur la table de l'entité en cours
            $this->createQueryBuilder('t')
            ->join(Record::class,'r')
            //Ajout d'une condition dans la clause WHERE
            ->where('r.id = :recordId')
            ->setParameter('recordId', $recordId)
            //Facultatif : Ajout d'un tri sur l'identifiant de piste ascendant
            ->orderBy('t.id', 'ASC')
            //Création de la requête
            ->getQuery()
            //Récupération du résultat formatté, en tableau de Track
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Track
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
