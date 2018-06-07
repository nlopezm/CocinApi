<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InformacionNutricionalType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cantidad')
                ->add('calorias')
                ->add('grasas_totales')
                ->add('sodio')
                ->add('carbohidratos')
                ->add('proteinas')
                ->add('calcio')
                ->add('fibras')
                ->add('hierro')
                ->add('potasio')
                ->add('colesterol')
                ->add('magnesio')
                ->add('zinc')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InformacionNutricional',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'InformacionNutricional';
    }

}
