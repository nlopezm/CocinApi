<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\InformacionNutricionalType;

class IngredienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('unidad')
                ->add('info_nutricional', InformacionNutricionalType::class)
                ->add('categoria')
                ->add('apto_para')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ingrediente',
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'Ingrediente';
    }

}
