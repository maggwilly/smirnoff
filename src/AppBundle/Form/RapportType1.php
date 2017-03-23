<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class RapportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('commentaire')
        ->add('posTarget')
        ->add('posRealTarget')
        ->add('posRealDay')
        ->add('nbreConsomateur')
        ->add('nbreProduitCon')
        ->add('nbreProduitGuiness')
        ->add('nbreProduitSminoff')
        ->add('nbreSminoffBlack')
        ->add('nbreSminoffBlue') 
        ->add('nbreSminoffRed')      
        ->add('el1')
        ->add('el2')
        ->add('el3')
        ->add('el4')
        ->add('sminoffBlue')
        ->add('sminoffBlack')
        ->add('sminoffRed')
        ->add('r1')
        ->add('r2')
        ->add('r3')
        ->add('r4')
        ->add('r5')
        ->add('r6')
        ->add('r7')
        ->add('r8')
        ->add('r9')
        ->add('boostrerCola')
        ->add('boostrerCider')
        ->add('heineken')  
        ->add('voodka') 
        ->add('biere')
        ->add('nbreProduitPromo')  
        ->add('nbreRh') 
        ->add('produitEnPromo')        
        ->add('user', EntityType::class, array('class' => 'AppBundle:Client'))     
        ->add('date','datetime', array(
              'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'Validation date',
                'error_bubbling' => true,
                'input' => 'datetime' # return a Datetime object (*)
            ))
        ->add('pointVente', EntityType::class, array('class' => 'AppBundle:PointVente'))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rapport',
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rapport';
    }


}
