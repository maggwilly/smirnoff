<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rapport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
    public function indexAction($section='sales')
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypeSales(null,$region, $startDate, $endDate,null);

        return $this->render('rapport/'.$section.'.html.twig', array(
            'rapports' => $rapports,
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
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypeSales(null,$region, $startDate, $endDate,null);

        return $this->render('rapport/sales.html.twig', array(
            'rapports' => $rapports,
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
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByTypeShares(null,$region, $startDate, $endDate,null);
        return $this->render('rapport/shares.html.twig', array(
            'rapports' => $rapports,
        ));
    }

 public function gagnantsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $gagnants = $em->getRepository('AppBundle:Gagnant')->findByType($region, $startDate, $endDate);
        return $this->render('rapport/gagnants.html.twig', array(
            'gagnants' => $gagnants,
        ));
    }

public function posRhsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $posrhs = $em->getRepository('AppBundle:PointVente')->findPosRhs($region, $startDate, $endDate);
        return $this->render('rapport/posrhs.html.twig', array(
            'posrhs' => $posrhs,
        ));
    }


  public function visibilitieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType(null,$region, $startDate, $endDate,null);
        return $this->render('rapport/visibilitie.html.twig', array(
            'rapports' => $rapports,
        ));
    }



    public function apercuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $marques = $em->getRepository('AppBundle:Situation')->findApercu($region, $startDate, $endDate,null);

        return $this->render('rapport/apercu.html.twig', array(
            'marques' => $marques,
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
