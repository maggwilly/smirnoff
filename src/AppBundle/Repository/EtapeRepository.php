<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Entity\Client;
/**
 * EtapeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EtapeRepository extends EntityRepository
{

	   /**
  *Nombre visite effectue par utilisateur par journee
  */
  public function etapesParUser (Client $user=null, $startDate=null, $endDate=null){
  
        $qb = $this->createQueryBuilder('e')->join('e.user','u')->leftJoin('e.suivant','s');
           $qb->where('e.type=:type')->setParameter('type', 'debut');
          if($user!=null){
           $qb->andWhere('e.user=:user')->setParameter('user', $user);
          }
          if($startDate!=null){
             $qb->andWhere('e.date>=:startDate')->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
             $qb->andWhere('e.date<=:endDate')->setParameter('endDate',new \DateTime($endDate));
          }
            $qb->select('u.id');
            $qb->addSelect('e.date');
            $qb->addSelect('u.username');
             $qb->addSelect('u.nom');
          $qb->addSelect('e.heure as debut');
            $qb->addSelect('e.longitude as longDebut');
            $qb->addSelect('e.latitude as latDebut');

            $qb->addSelect('s.heure as fin');
            $qb->addSelect('s.longitude as longFin');
            $qb->addSelect('s.latitude as latFin');
            $qb->orderBy('u.username'); 
            
          return $qb->getQuery()->getArrayResult();
  }
}
