<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gagnant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\GagnantType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\PointVente;
/**
 * Gagnant controller.
 *
 */
class GagnantController extends Controller
{
    /**
     * Lists all gagnant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gagnants = $em->getRepository('AppBundle:Gagnant')->findAll();

        return $this->render('gagnant/index.html.twig', array(
            'gagnants' => $gagnants,
        ));
    }

    /**
     * Creates a new gagnant entity.
     *
     */
    public function newAction(Request $request)
    {
        $data= array('date'=>new \Datetime());
        $form = $this->createFormBuilder($data) 
                ->add('date','datetime', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'invalid_message' => 'Validation date',
                'error_bubbling' => true,
                'input' => 'datetime' # return a Datetime object (*)
            ))
           ->add('pointVente', EntityType::class, array('class' => 'AppBundle:PointVente','property' => 'affichage'))
            ->add('file', FileType::class,  array('label' => 'Liste excel'))
            ->setAction($this->generateUrl('gagnant_new'))
             ->setMethod('POST')
             ->getForm();
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
             if( $form->isValid()){
              $em = $this->getDoctrine()->getManager();
             $data=$form->getData();
             $file=$data['file'];
             $pointVente=$data['pointVente'];
             $date=$data['date'];
             $fileName ='tmp.'.$file->guessExtension();
             $path = $this->get('kernel')->getRootDir(). "/../web/import";
             $file->move($path,$fileName);
             $this->loadWiners($pointVente, $date,$fileName);
            $this->get('session')->getFlashBag()->add('success', 'Enregistrement réussi !');
                 return $this->redirectToRoute('gagnant_new');
             }else{
                $this->get('session')->getFlashBag()->add('error', 'Les informqtions saisies ne sont pqs toute valides. Vérifiez les âges.');
                 return $this->redirectToRoute('gagnant_new'); 
             }

        }
        return $this->render('gagnant/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

   /*load secteurs from excel*/
  public function loadWiners(PointVente $pointVente,$date,$fileName)
    {
     $manager = $this->getDoctrine()->getManager();
     $path = $this->get('kernel')->getRootDir(). "/../web/import/".$fileName;
     $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($path);
     $winers= $objPHPExcel->getSheet(0);
     $highestRow  = $winers->getHighestRow(); // e.g. 10
     for ($row = 2; $row <= $highestRow; ++ $row) {
            $nom = $winers->getCellByColumnAndRow(0, $row);
            $numero = $winers->getCellByColumnAndRow(1, $row);
            $quantite = $winers->getCellByColumnAndRow(2, $row);
            $offert = $winers->getCellByColumnAndRow(3, $row);
            $gagnant=new Gagnant( $nom->getValue(),$numero->getValue(),$quantite->getValue(),$offert->getValue());
            $gagnant->setPointVente($pointVente)->setDate($date)->setObject('Bouteille');
            $manager->persist($gagnant);
    }
     $manager->flush();   
    }


    /**
     * Finds and displays a gagnant entity.
     *
     */
    public function showAction(Gagnant $gagnant)
    {
        $deleteForm = $this->createDeleteForm($gagnant);

        return $this->render('gagnant/show.html.twig', array(
            'gagnant' => $gagnant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gagnant entity.
     *
     */
    public function editAction(Request $request, Gagnant $gagnant)
    {
        $deleteForm = $this->createDeleteForm($gagnant);
        $editForm = $this->createForm('AppBundle\Form\GagnantType', $gagnant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gagnant_new');
        }

        return $this->render('gagnant/edit.html.twig', array(
            'gagnant' => $gagnant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gagnant entity.
     *
     */
    public function deleteAction(Request $request, Gagnant $gagnant)
    {
        $form = $this->createDeleteForm($gagnant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gagnant);
            $em->flush($gagnant);
        }

        return $this->redirectToRoute('gagnant_index');
    }

    /**
     * Creates a form to delete a gagnant entity.
     *
     * @param Gagnant $gagnant The gagnant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gagnant $gagnant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gagnant_delete', array('id' => $gagnant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
