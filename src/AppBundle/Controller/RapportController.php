<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rapport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\PointVente;

/**
 * Rapport controller.
 *
 */
class RapportController extends Controller
{
    /**
     * Lists all rapport entities.
     *
     */
    public function indexAction($section='sales',PointVente $pointVente=null)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType($region, $startDate, $endDate,$pointVente);

        return $this->render('rapport/'.$section.'.html.twig', array(
            'rapports' => $rapports,'pointVente' => $pointVente,
        ));
    }
    /**
     * Lists all rapport entities.
     *
     */
    public function salesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypeSales($region, $startDate, $endDate);
        $salesweek = $em->getRepository('AppBundle:Rapport')->findSalesWeek($region, $startDate, $endDate);
        return $this->render('analyse/sales.html.twig', array(
            'rapports' => $rapports,'salesweek' => $salesweek,
        ));
    }

    /**
     * Lists all rapport entities.
     *
     */
    public function sharesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypeShares($region, $startDate, $endDate);
        $sharesweek = $em->getRepository('AppBundle:Rapport')->findSharesWeek($region, $startDate, $endDate);
        return $this->render('analyse/shares.html.twig', array(
            'rapports' => $rapports,'sharesweek' => $sharesweek,
        ));
    }

    /**
     * Lists all rapport entities.
     *
     */
    public function pricesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypePrices($region, $startDate, $endDate);
        return $this->render('analyse/prices.html.twig', array(
            'rapports' => $rapports
        ));
    }



 public function gagnantsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $gagnants = $em->getRepository('AppBundle:Gagnant')->findByType($region, $startDate, $endDate);
        $findFreeIssue = $em->getRepository('AppBundle:Gagnant')->findFreeIssue($region, $startDate, $endDate);
        return $this->render('rapport/gagnants.html.twig', array(
            'gagnants' => $gagnants,  'findFreeIssue' => $findFreeIssue,
        ));
    }



  public function visibilitieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType($region, $startDate, $endDate);
        return $this->render('rapport/visibilitie.html.twig', array(
            'rapports' => $rapports,
        ));
    }



    public function apercuPeriodeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $marques = $em->getRepository('AppBundle:Situation')->findApercuPeriode($region, $startDate, $endDate);
        $sales = $em->getRepository('AppBundle:Rapport')->findByTypeSales($region, $startDate, $endDate);
        $shares = $em->getRepository('AppBundle:Rapport')->findByTypeShares($region, $startDate, $endDate);
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType($region, $startDate, $endDate);
         $gagnants = $em->getRepository('AppBundle:Gagnant')->findFreeIssue($region, $startDate, $endDate,true);
        $colors=array("#FF6384","#36A2EB","#FFCE56","#F7464A","#FF5A5E","#46BFBD", "#5AD3D1","#FDB45C","#FFC870", "#5AE4D1","#FDB478","#FFD973");
        return $this->render('analyse/periode.html.twig', array(
            'marques' => $marques,'sales' => $sales,'shares' => $shares, 'colors' => $colors,   'rapports' => $rapports, 'gagnants' => $gagnants,
        ));
    }


    public function apercuDernierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $marques = $em->getRepository('AppBundle:Situation')->findApercuDernier($region, $startDate, $endDate);
        $sales = $em->getRepository('AppBundle:Rapport')->findByTypeSalesDernier($region, $startDate, $endDate);
        $shares = $em->getRepository('AppBundle:Rapport')->findByTypeSharesDernier($region, $startDate, $endDate);
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType($region, $startDate, $endDate);
          $gagnants = $em->getRepository('AppBundle:Gagnant')->findFreeIssue($region, $startDate, $endDate,true);
         $colors=array("#FF6384","#36A2EB","#FFCE56","#F7464A","#FF5A5E","#46BFBD", "#5AD3D1","#FDB45C","#FFC870", "#5AE4D1","#FDB478","#FFD973");
        return $this->render('analyse/dernier.html.twig', array(
            'marques' => $marques,'sales' => $sales,'shares' => $shares, 'colors' => $colors, 'rapports' => $rapports, 'gagnants' => $gagnants,
        ));
    }


    /**
     * Finds and displays a rapport entity.
     *
     */
    public function showAction(Rapport $rapport)
    {

        return $this->render('rapport/show.html.twig', array(
            'rapport' => $marques,
        ));
    }
}
