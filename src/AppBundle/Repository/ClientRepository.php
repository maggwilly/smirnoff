<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{

  /**
  *Nombre total de visite effectue par utilisateur 
  */
  public function visitesParUser ( $region=null, $startDate=null, $endDate=null){

       $qb = $this->createQueryBuilder('u')->leftJoin('u.rapports','v')->leftJoin('v.pointVente','pv');
  
        if($region!=null){
           $qb->where('pv.type=:ville')
          ->setParameter('ville', $region);
          }
          if($startDate!=null){
           $qb->andWhere('v.date is null or v.date>=:startDate')->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
           $qb->andWhere('v.date is null or v.date<=:endDate')->setParameter('endDate',new \DateTime($endDate));
          }
 
            $qb->select('max(v.date) as date');
            $qb->addSelect('u.id');
             $qb->addSelect('u.nom');
             $qb->addGroupBy('u.nom');
            $qb->addGroupBy('u.id');
            $qb->addSelect('count(v.id) as nombre'); 
          return $qb->getQuery()->getArrayResult();
     
  }

  /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function synchrosParUser ($startDate=null, $endDate=null){

       $qb = $this->createQueryBuilder('u')->leftJoin('u.synchros','s');

          if($startDate!=null){
           $qb->andWhere('s.date is null or s.date>=:startDate')->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
           $qb->andWhere('s.date is null or s.date<=:endDate')->setParameter('endDate',new \DateTime($endDate));
          }
 
            $qb->select('max(s.date) as date');
            $qb->addSelect('u.id');
             $qb->addSelect('u.nom');
             $qb->addGroupBy('u.nom');
            $qb->addGroupBy('u.id');
            $qb->addSelect('count(s.id) as nombre'); 
          return $qb->getQuery()->getArrayResult();
  }

 
}
