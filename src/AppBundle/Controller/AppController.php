<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etape;
use AppBundle\Entity\Produit;
use AppBundle\Entity\PointVente;
use AppBundle\Entity\Synchro;
use AppBundle\Entity\Visite;
use AppBundle\Entity\Situation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use AppBundle\Entity\Secteur;
use AppBundle\Entity\Quartier;
use AppBundle\Entity\RH;
/**
 * Etape controller.
 *
 */
class AppController extends Controller
{
    /**
     * Lists all etape entities.
     *
     */
    public function indexAction()
    {
        
        return $this->render('layout.html.twig');
    }


    /**
     * Lists all etape entities.
     *
     */
    public function homeAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_SUPER')) {
               return      $this->redirectToRoute('gagnant_new');
            }
         return $this->redirectToRoute('rapport_apercu_dernier');
    }



   /* * Lists all etape entities.
     *
     */
    public function dernierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');

     //$concurents=array_column($situationsComparee, 'nomcon', 'id');
      $colors=array("#FF6384","#36A2EB","#FFCE56","#F7464A","#FF5A5E","#46BFBD", "#5AD3D1","#FDB45C","#FFC870", "#5AE4D1","#FDB478","#FFD973");
        return $this->render('statistiques/derniere.html.twig');
    }


 


    public function setPeriodeAction(Request $request)
    {
  
        $region=$request->request->get('region');
        $periode= $request->request->get('periode');
        $dates = explode(" - ", $periode);
        $startDate=$dates[0];
        $endDate=$dates[1];
        $format = 'd/m/Y';
        $startDate= \DateTime::createFromFormat($format, $dates[0]);
        $endDate= \DateTime::createFromFormat($format, $dates[1]);
        $session = $this->getRequest()->getSession();
        $session->set('region',$region);
        $session->set('startDate',$startDate->format('Y-m-d'));
        $session->set('endDate',$endDate->format('Y-m-d'));
        $session->set('periode',$periode);
        $session->set('end_date_formated',$endDate->format('d/m/Y'));
        $session->set('start_date_formated',$startDate->format('d/m/Y'));
       $referer = $this->getRequest()->headers->get('referer');   
         return new RedirectResponse($referer);
    }


   /*load secteurs from excel*/
  public function loadrhAction()
    {
        $manager = $this->getDoctrine()->getManager();
    $path = $this->get('kernel')->getRootDir(). "/../web/import/rhs.xlsx";
     $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($path);
    $rhs= $objPHPExcel->getSheet(0);
    $highestRow  = $secteurs->getHighestRow(); // e.g. 10
    for ($row = 2; $row <= $highestRow; ++ $row) {
            $nom = $rhs->getCellByColumnAndRow(0, $row);
            $numero = $rhs->getCellByColumnAndRow(1, $row);
            $rh=new RH( $nom->getValue(),$numero->getValue());
            $manager->persist($rh);
    }
     $manager->flush();
    return $this->redirectToRoute('user_homepage');      
    }

}
