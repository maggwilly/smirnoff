<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etape;
use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Etape controller.
 *
 */
class EtapeController extends Controller
{
    /**
     * Lists all etape entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
         $session = $this->getRequest()->getSession();

         $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
         $visitesParUser = $em->getRepository('AppBundle:Client')->visitesParUser($region,$startDate, $endDate);
         $synchrosParUser = $em->getRepository('AppBundle:Client')->synchrosParUser( $startDate, $endDate);
        return $this->render('etape/index.html.twig', array(
            'visitesParUser' => $visitesParUser,
            'synchrosParUser' => $synchrosParUser,
        ));
    }



    /**
     * Finds and displays a etape entity.
     *
     */
    public function showAction(Client $client)
    {
        $em = $this->getDoctrine()->getManager();
         $session = $this->getRequest()->getSession();

         $region=$session->get('region');
         $startDate=$session->get('startDate',date('Y').'-01-01');
         $endDate=$session->get('endDate', date('Y').'-12-31');
        $visitesParUser = $em->getRepository('AppBundle:Rapport')->findByType($client, $region, $startDate, $endDate,null);
         $etapesParUser = $em->getRepository('AppBundle:Etape')->etapesParUser( $client, $startDate, $endDate);
        return $this->render('user/show.html.twig', array(
            'client' => $client,
            'visitesParUser' => $visitesParUser,
            'etapesParUser' => $etapesParUser,
        ));
    }    
}
