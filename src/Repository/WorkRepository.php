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
     * @param $offset
     * @return mixed
     */
    public function findWorksNmb($nmb, $offset = null){
    	return $this->createQueryBuilder('w')
            ->orderBy('w.id', 'ASC')
            ->setMaxResults($nmb)
		    ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
	}
}
