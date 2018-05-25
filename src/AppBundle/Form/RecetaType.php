<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('dificultad')
                ->add('personas')
                ->add('tiempo')
                ->add('imagenes')
                ->add('video')
                ->add('categoria')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Receta',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'Receta';
    }
}
