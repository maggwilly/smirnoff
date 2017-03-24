<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GagnantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GagnantRepository extends EntityRepository
{
 	   /**
  *Nombre visite effectue par utilisateur par journee
  */
  public function findByType ($region=null, $startDate=null, $endDate=null){
  
         $qb = $this->createQueryBuilder('g')->join('g.rapport','r')->join('r.pointVente','p');
        if($region!=null){
           $qb->where('p.type=:type')
          ->setParameter('type', $region);
          }
      if($startDate!=null){
           $qb->andWhere('r.date>=:startDate')
          ->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
           $qb->andWhere('r.date<=:endDate')
          ->setParameter('endDate',new \DateTime($endDate));
          }

 
          return $qb->getQuery()->getResult();
  } 

}