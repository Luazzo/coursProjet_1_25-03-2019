<?php

namespace App\Repository;

use App\Entity\Work;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Work|null find($id, $lockMode = null, $lockVersion = null)
 * @method Work|null findOneBy(array $criteria, array $orderBy = null)
 * @method Work[]    findAll($nmb)
 * @method Work[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkRepository extends ServiceEntityRepository
{

    /**
     * @param $tgs
     * @return mixed
     */
    public function findByTags($tgs)
    {
        $qb=$this->createQueryBuilder('w')
            ->leftJoin('w.tags','tags')
            ->addSelect('tags');
        if(is_iterable($tgs)) {
            foreach ($tgs as $tg) {
                $qb->andWhere(':val MEMBER OF w.tags')->setParameter('val', $tg);
            }
        }elseif ($tgs==null){

        }else{
            $qb
                ->andWhere(':val MEMBER OF w.tags')->setParameter('val', $tg);
        }
        return $qb->getQuery() ->getResult();
    }
    /**
     * WorkRepository constructor.
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Work::class);
    }

    /**
     * @param $nmb
     * @return mixed
     */
    public function findWorksNmb($nmb){
    	return $this->createQueryBuilder('w')
            ->orderBy('w.id', 'ASC')
            ->setMaxResults($nmb)
            ->getQuery()
            ->getResult()
        ;
	}

    /**
     * @param $nmb
     * @param $offset
     * @return mixed
     */
    public function findWorksNmbo($nmb, $offset){
    	return $this->createQueryBuilder('w')
            ->orderBy('w.id', 'ASC')
            ->setMaxResults($nmb)
		    ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
	}

    // /**
    //  * @return Work[] Returns an array of Work objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Work
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
