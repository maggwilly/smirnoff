<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\PointVente;
/**
 * RapportRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RapportRepository extends EntityRepository
{

	/**
Nombre de point de vente visités
 */
  public function findByTypeSales($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){

        $qb = $this->createQueryBuilder('r')->join('r.pointVente','p');
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

          if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
           
          }    
              $qb->select('sum(CASE WHEN r.posRealTarget<=15 THEN 0 ELSE r.posTarget END) as posTarget')
              ->addSelect('sum(CASE WHEN r.posRealTarget<=15 THEN 1 ELSE 0 END) as rupture')
             ->addSelect('sum(r.posRealTarget) as posRealTarget')
             ->addSelect('sum(r.posRealDay) as posRealDay')
 
             ->addSelect('p.nom')
             ->addSelect('p.quartier')
             ->addSelect('p.type')
             ->addSelect('p.id')->groupBy('p.nom')->addGroupBy('p.id')->addGroupBy('p.quartier')->addGroupBy('p.type');
         return $qb->getQuery()->getArrayResult();  
   
  }

//situation comparee
  public function findByTypeSalesDernier ($region=null, $startDate=null, $endDate=null){
    $em = $this->_em;
    $RAW_QUERY =($region!=null) ?'select v.posTarget as postarget ,v.posRealTarget as posrealtarget, v.posRealDay as posrealday from (select pv.id as pv , max(v.date) as date from point_vente pv join rapport v  on pv.id=v.point_vente_id and v.date>=:startDate and v.date<=:endDate and pv.type=:region group by  pv.id order by pv.id) as u  join  rapport v on (u.pv=v.point_vente_id and u.date=v.date) ;'  : 'select v.posTarget as postarget ,v.posRealTarget as posrealtarget, v.posRealDay as posrealday  from (select pv.id as pv , max(v.date) as date from point_vente pv join rapport v  on pv.id=v.point_vente_id and v.date>=:startDate and v.date<=:endDate  group by  pv.id order by pv.id) as u  join  rapport v on (u.pv=v.point_vente_id and u.date=v.date) ;'; 
     $statement = $em->getConnection()->prepare($RAW_QUERY);
        if($region!=null){
    $statement->bindValue('region', $region);
          }
    $startDate=new \DateTime($startDate);
    $endDate=new \DateTime($endDate);
    $statement->bindValue('startDate', $startDate->format('Y-m-d'));
    $statement->bindValue('endDate',  $endDate->format('Y-m-d'));
    $statement->execute();

     return  $result = $statement->fetchAll();
  } 

//situation comparee
  public function findByTypeSharesDernier ($region=null, $startDate=null, $endDate=null){
    $em = $this->_em;
    $RAW_QUERY =($region!=null) ?'select sum(ora.bnreBlle) as origine, sum(exp.bnreBlle) as export, sum(bo.bnreBlle) as boostrer,sum(he.bnreBlle) as heineken,sum(vo.bnreBlle) as voodka,sum(sa.bnreBlle) as sabc,sum(sa16.bnreBlle) as sabc1664,sum(sRed.bnreBlle) as sminoffred,sum(sBlue.bnreBlle) as sminoffblue,sum(sBlack.bnreBlle) as sminoffblack ,u.pv from (select pv.id as pv , max(v.date) as date from point_vente pv join rapport v  on pv.id=v.point_vente_id and v.date>=:startDate and v.date<=:endDate and pv.type=:region group by  pv.id order by pv.id) as u  join  rapport v on (u.pv=v.point_vente_id and u.date=v.date) join situation ora  on v.origine_id=ora.id join situation exp  on v.export_id=exp.id  join situation bo  on v.boostrer_id=bo.id join situation he  on v.heineken_id=he.id join situation vo  on v.voodka_id=vo.id join situation sa  on v.sabc_id=sa.id join situation sa16  on v.sabc1664_id=sa16.id join situation sRed  on v.sminoff_red_id=sRed.id join situation sBlack  on v.sminoff_black_id=sBlack.id join situation sBlue  on v.sminoff_blue_id=sBlue.id  group by u.pv;'  : 'select sum(ora.bnreBlle) as origine, sum(exp.bnreBlle) as export, sum(bo.bnreBlle) as boostrer,sum(he.bnreBlle) as heineken,sum(vo.bnreBlle) as voodka,sum(sa.bnreBlle) as sabc,sum(sa16.bnreBlle) as sabc1664,sum(sRed.bnreBlle) as sminoffred,sum(sBlue.bnreBlle) as sminoffblue,sum(sBlack.bnreBlle) as sminoffblack, u.pv from (select pv.id as pv , max(v.date) as date from point_vente pv join rapport v  on pv.id=v.point_vente_id and v.date>=:startDate and v.date<=:endDate  group by  pv.id order by pv.id) as u  join  rapport v on (u.pv=v.point_vente_id and u.date=v.date) join situation ora  on v.origine_id=ora.id join situation exp  on v.export_id=exp.id join situation bo  on v.boostrer_id=bo.id join situation he  on v.heineken_id=he.id join situation vo  on v.voodka_id=vo.id join situation sa  on v.sabc_id=sa.id join situation sa16  on v.sabc1664_id=sa16.id join situation sRed  on v.sminoff_red_id=sRed.id join situation sBlack  on v.sminoff_black_id=sBlack.id join situation sBlue  on v.sminoff_blue_id=sBlue.id  group by u.pv;'; 
     $statement = $em->getConnection()->prepare($RAW_QUERY);
        if($region!=null){
    $statement->bindValue('region', $region);
          }
    $startDate=new \DateTime($startDate);
    $endDate=new \DateTime($endDate);
    $statement->bindValue('startDate', $startDate->format('Y-m-d'));
    $statement->bindValue('endDate',  $endDate->format('Y-m-d'));
    $statement->execute();

     return  $result = $statement->fetchAll();
  } 



   public function findByTypeShares($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){

        $qb = $this->createQueryBuilder('r')
        ->join('r.pointVente','p')
         ->join('r.boostrer','bo')
          ->join('r.heineken','he')
           ->join('r.voodka','vo')
            ->join('r.sabc','sa')
             ->join('r.sabc1664','sa16')
              ->join('r.sminoffRed','sRed')
               ->join('r.sminoffBlue','sBlue')
                ->join('r.sminoffBlack','sBlack')
                ->join('r.origine','ora')
                ->join('r.export','exp');
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

        if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
          }   
             $qb->select('sum(bo.bnreBlle) as boostrer')
             ->addSelect('sum(he.bnreBlle) as heineken')
             ->addSelect('sum(vo.bnreBlle) as voodka')
             ->addSelect('sum(sa.bnreBlle) as sabc')
             ->addSelect('sum(sa16.bnreBlle) as sabc1664')
             ->addSelect('sum(sRed.bnreBlle) as sminoffRed')
             ->addSelect('sum(sBlue.bnreBlle) as sminoffBlue')
             ->addSelect('sum(sBlack.bnreBlle) as sminoffBlack')
              ->addSelect('sum(ora.bnreBlle) as origine')
             ->addSelect('sum(exp.bnreBlle) as export')
             ->addSelect('p.nom')
              ->addSelect('p.quartier')
             ->addSelect('p.type')            
             ->addSelect('p.id')->groupBy('p.nom')->addGroupBy('p.id')->addGroupBy('p.quartier')->addGroupBy('p.type');
         return $qb->getQuery()->getArrayResult();  
   
  } 

   public function findByTypePrices($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){

        $qb = $this->createQueryBuilder('r')
        ->join('r.pointVente','p')
         ->join('r.boostrer','bo')
          ->join('r.heineken','he')
           ->join('r.voodka','vo')
            ->join('r.sabc','sa')
             ->join('r.sabc1664','sa16')
              ->join('r.sminoffRed','sRed')
               ->join('r.sminoffBlue','sBlue')
                ->join('r.sminoffBlack','sBlack')
                  ->join('r.origine','ora')
                ->join('r.export','exp');
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
        if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
          }       
             $qb->select('avg(bo.price) as boostrer')
             ->addSelect('avg(he.price) as heineken')
             ->addSelect('avg(vo.price) as voodka')
             ->addSelect('avg(sa.price) as sabc')
             ->addSelect('avg(sa16.price) as sabc1664')
             ->addSelect('avg(sRed.price) as sminoffRed')
             ->addSelect('avg(sBlue.price) as sminoffBlue')
             ->addSelect('avg(sBlack.price) as sminoffBlack')
            ->addSelect('avg(ora.price) as origine')
             ->addSelect('avg(exp.price) as export')
             ->addSelect('p.nom')
              ->addSelect('p.quartier')
             ->addSelect('p.type')            
             ->addSelect('p.id')->groupBy('p.nom')->addGroupBy('p.id')->addGroupBy('p.quartier')->addGroupBy('p.type');
         return $qb->getQuery()->getArrayResult();  
   
  }


     public function findSharesWeek($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){

        $qb = $this->createQueryBuilder('r')
        ->join('r.pointVente','p')
         ->join('r.boostrer','bo')
          ->join('r.heineken','he')
           ->join('r.voodka','vo')
            ->join('r.sabc','sa')
             ->join('r.sabc1664','sa16')
              ->join('r.sminoffRed','sRed')
               ->join('r.sminoffBlue','sBlue')
                ->join('r.sminoffBlack','sBlack');
        if($region!=null){
           $qb->where('p.type=:type')
          ->setParameter('type', $region);
          }
          if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
          }      
/**      if($startDate!=null){
           $qb->andWhere('r.date>=:startDate')
          ->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
           $qb->andWhere('r.date<=:endDate')
          ->setParameter('endDate',new \DateTime($endDate));
          }
          **/
             $qb->select('avg(bo.bnreBlle) as boostrer')
             ->addSelect('avg(he.bnreBlle) as heineken')
             ->addSelect('avg(vo.bnreBlle) as voodka')
             ->addSelect('avg(sa.bnreBlle) as sabc')
             ->addSelect('avg(sa16.bnreBlle) as sabc1664')
             ->addSelect('avg(sRed.bnreBlle) as sminoffRed')
             ->addSelect('avg(sBlue.bnreBlle) as sminoffBlue')
             ->addSelect('avg(sBlack.bnreBlle) as sminoffBlack')
             ->addSelect('r.weekText')
             ->groupBy('r.weekText')->addGroupBy('r.week')->orderBy('r.week','ASC');
         return $qb->getQuery()->getArrayResult();  
   
  } 


    /**
Nombre de point de vente visités
 */
  public function findSalesWeek($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){

        $qb = $this->createQueryBuilder('r')->join('r.pointVente','p');
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
           if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
          }  
           $qb->select('sum(CASE WHEN r.posRealTarget<15 THEN 0 ELSE r.posTarget END) as posTarget')
             ->addSelect('sum(CASE WHEN r.posRealTarget<15 THEN 1 ELSE 0 END) as rupture')
             ->addSelect('sum(r.posRealTarget) as posRealTarget')
             ->addSelect('sum(r.posRealDay) as posRealDay')
             ->addSelect('r.weekText')
             ->groupBy('r.weekText')->addGroupBy('r.week')->orderBy('r.week','ASC');
         return $qb->getQuery()->getArrayResult();  
   
  }

 	   /**
  *Nombre visite effectue par utilisateur par journee
  */
  public function findByType ($region=null, $startDate=null, $endDate=null, PointVente $pointVente=null){
  
         $qb = $this->createQueryBuilder('r')->join('r.pointVente','p');
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
           if($pointVente!=null){
           $qb->andWhere('p=:pointVente')->setParameter('pointVente',$pointVente);
          }
 
          return $qb->getQuery()->getResult();
  } 



}
