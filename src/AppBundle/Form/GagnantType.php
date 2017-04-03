<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class GagnantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
             ->add('tel')
             ->add('age')
             ->add('object', 'choice', array(
                               'required' => true,
                               'choices'=>array(
                                          'Bouteille'=>'Bouteille','T-shirt'=>'T-shirt','Casquette'=>'Casquette','Reward 3'=>'Reward 3','Reward 4'=>'Reward 4')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Gagnant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_gagnant';
    }


}
