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
        $rapports = $em->getRepository('AppBundle:Rapport')->findByType(null,$region, $startDate, $endDate,null);

        return $this->render('rapport/'.$section.'.html.twig', array(
            'rapports' => $rapports,
        ));
    }

    /**
     * Finds and displays a rapport entity.
     *
     */
    public function showAction(Rapport $rapport)
    {

        return $this->render('rapport/show.html.twig', array(
            'rapport' => $rapport,
        ));
    }
}
