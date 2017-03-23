<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
class RapportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('posTarget')
        ->add('posRealTarget')
        ->add('posRealDay')
        ->add('nbreConsomateur')
        ->add('gagnants', CollectionType::class, array('entry_type'=> GagnantType::class,'allow_add' => true))
        ->add('boostrer',SituationType::class, array())
        ->add('heineken',SituationType::class, array())
        ->add('voodka',SituationType::class, array())
        ->add('sabc',SituationType::class, array())
        ->add('sabc1664',SituationType::class, array())
        ->add('sminoffRed',SituationType::class, array())
        ->add('sminoffBlue',SituationType::class, array())
        ->add('sminoffBlack',SituationType::class, array())
        ->add('rh', EntityType::class, array('class' => 'AppBundle:RH'))     
        ->add('user', EntityType::class, array('class' => 'AppBundle:Client'))     
        ->add('date','datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'invalid_message' => 'Validation date',
                'error_bubbling' => true,
                'input' => 'datetime' # return a Datetime object (*)
            ))
        ->add('pointVente', EntityType::class, array('class' => 'AppBundle:PointVente'));
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
