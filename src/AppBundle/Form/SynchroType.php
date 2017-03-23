<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class SynchroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
      
        ->add('quartiers', CollectionType::class, array('entry_type'=> QuartierType::class,'allow_add' => true))
        ->add('pointVentes', CollectionType::class, array('entry_type'=> PointVenteType::class,'allow_add' => true))
        ->add('user', EntityType::class, array('class' => 'AppBundle:Client')) 
        ->add('id')
        ->add('rapports', CollectionType::class, array('entry_type'=> RapportType::class,'allow_add' => true))   ;
    }

    /**
     * {@inheritdoc}
     */
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Synchro',
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_synchro';
    }


}
