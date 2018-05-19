<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemRecetaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
         $builder
                ->add('receta')
                ->add('ingrediente')
                ->add('cantidad')
            ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ItemReceta',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'ItemReceta';
    }

}
