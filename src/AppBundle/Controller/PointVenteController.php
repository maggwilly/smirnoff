<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PointVente;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Pointvente controller.
 *
 */
class PointVenteController extends Controller
{
    /**
     * Lists all pointVente entities.
     *
     */
    public function indexAction()
    {

      $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $pointVentes = $em->getRepository('AppBundle:PointVente')->pointVentes($region,$startDate, $endDate);
        $nombrePointVente = $em->getRepository('AppBundle:PointVente')->nombrePointVente($region,$startDate, $endDate);
        return $this->render('pointvente/index.html.twig', array(
            'pointVentes' => $pointVentes,  'nombrePointVente' => $nombrePointVente,
        ));
    }

    /**
     * Finds and displays a pointVente entity.
     *
     */
    public function showAction(PointVente $pointVente)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $marques = $em->getRepository('AppBundle:Situation')->findApercuPeriode($region, $startDate, $endDate,$pointVente);
        $sales = $em->getRepository('AppBundle:Rapport')->findByTypeSalesDernier($region, $startDate, $endDate,$pointVente);
        $shares = $em->getRepository('AppBundle:Rapport')->findByTypeSharesDernier($region, $startDate, $endDate,$pointVente);
        $salesweek = $em->getRepository('AppBundle:Rapport')->findSalesWeek($region, $startDate, $endDate,$pointVente);
        $gagnants = $em->getRepository('AppBundle:Gagnant')->findByType($region, $startDate, $endDate,false,$pointVente);
         $colors=array("#FF6384","#36A2EB","#FFCE56","#F7464A","#FF5A5E","#46BFBD", "#5AD3D1","#FDB45C","#FFC870", "#5AE4D1","#FDB478","#FFD973");
        return $this->render('pointvente/show.html.twig', array(
            'marques' => $marques,'sales' => $sales,'shares' => $shares, 'colors' => $colors,'pointVente' => $pointVente,'salesweek' => $salesweek, 'gagnants' => $gagnants
        ));
    }

     /**
     * Finds and displays a pointVente entity.
     *
     */
    public function eligiblesAction($note=0)
    {

    $em = $this->getDoctrine()->getManager();
      $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $eligibles = $em->getRepository('AppBundle:PointVente')->eligibles($region,$startDate, $endDate);
        $eligiblesranking = $em->getRepository('AppBundle:PointVente')->eligiblesranking($region,$startDate, $endDate);
        $nombrePointVenteVisite = $em->getRepository('AppBundle:PointVente')->nombrePointVenteVisite($region,$startDate, $endDate);
        return $this->render('pointvente/eligibles.html.twig', array(
            'eligibles' => $eligibles,  
            'eligiblesranking' => $eligiblesranking,
             'nombrePointVenteVisite' => $nombrePointVenteVisite,
        ));
    } 


     /**
     * Finds and displays a pointVente entity.
     *
     */
    public function mapAction()
    {
    $em = $this->getDoctrine()->getManager();
       $session = $this->getRequest()->getSession();
       $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-04-20');
        $endDate=$session->get('endDate', date('Y').'-07-30');
        $pointVentes = $em->getRepository('AppBundle:PointVente')->pointVentes($region,$startDate, $endDate);
        $nombrePointVente = $em->getRepository('AppBundle:PointVente')->nombrePointVente($region,$startDate, $endDate);
        return $this->render('pointvente/map.html.twig', array(
            'pointVentes' => $pointVentes,  'nombrePointVente' => $nombrePointVente,
        ));
    } 

    public function pdvExcelAction($name=null)
    {
      $em = $this->getDoctrine()->getManager();
      $session = $this->getRequest()->getSession();
      $region=$session->get('region');
      $startDate=$session->get('startDate',date('Y').'-04-20');
      $endDate=$session->get('endDate', date('Y').'-07-30');
      $periode= $session->get('periode');
      $pointVentes = $em->getRepository('AppBundle:PointVente')->pointVentes($region,$startDate, $endDate);
      
        // ask the service for a Excel5
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AllReport")
           ->setLastModifiedBy("AllReport")
           ->setTitle("Liste des points de vente")
           ->setSubject("Liste des points de vente")
            ->setDescription("Liste des points de vente")
            ->setKeywords("Liste des points de vente")
            ->setCategory("Rapports AllReport");
               $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'NOM')
               ->setCellValue('B1', 'MATRICULE')
               ->setCellValue('C1', 'CATEGORIE')
               ->setCellValue('D1', 'REGION')
               ->setCellValue('E1', 'QUARTIER')
               ->setCellValue('F1', 'DESCRIPTION')
               ->setCellValue('G1', 'MOIS DE CREATION')
               ->setCellValue('H1', 'TELEPHONE');
             foreach ($pointVentes as $key => $value) {
                // $startDate= \DateTime::createFromFormat('Y-m-d', $value['createdAt']);
               $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A'.($key+2), $value['nom'])
               ->setCellValue('B'.($key+2), $value['matricule'])
               ->setCellValue('C'.($key+2), $value['type'])
               ->setCellValue('D'.($key+2), $value['ville'])
               ->setCellValue('E'.($key+2), $value['quartier'])
               ->setCellValue('F'.($key+2), $value['description'])
               ->setCellValue('G'.($key+2), $value['createdAt']->format('M Y'))
               ->setCellValue('H'.($key+2), $value['tel']) ;
           };
            $format = 'd/m/Y';
       $phpExcelObject->getActiveSheet()->setTitle('liste-des-points-de-vente');
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'liste-des-'.$region.'-pdv.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;        
    }

public function boleanToString($boolVal){
    switch ($boolVal) {
        case 1:
            # code...
           return 'OUI';
        
        default:
            # code...
           return 'NON';
    }
}


    //apk
    public function importAction()
{
  $request = $this->get('request');
    $path = $this->get('kernel')->getRootDir(). "/../web/import/secteurs.xls";
     $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($path);

   foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    for ($row = 1; $row <= $highestRow; ++ $row) {


        for ($col = 0; $col < 2; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
        }
    }

} 
    $response = new Response();

    //set headers
    $response->headers->set('Content-Type', 'mime/type');
    $response->headers->set('Content-Disposition', 'attachment;filename="allreport_v1.0.8.1.apk"');

    $response->setContent($content);
    return $response;

 
}   
}
