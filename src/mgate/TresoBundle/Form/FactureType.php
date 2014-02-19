<?php
namespace mgate\TresoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilder;

use mgate\TresoBundle\Form\FactureDetailType;
use mgate\PersonneBundle\Entity\PersonneRepository;

class FactureType extends AbstractType {

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder->add('exercice', 'integer', array('label'=>'Mandat', 'required' => true))
                ->add('numero', 'integer', array('label'=>'Numéro de la Note de Frais', 'required' => true))
                ->add('type', 'choice', array('choices' => \mgate\TresoBundle\Entity\Facture::getTypeChoices(), 'required' => true))
                ->add('objet', 'textarea', 
                    array('label' => 'Objet de la Note de Frais',
                        'required' => false, 
                        'attr'=>array(
                            'cols'=>'100%', 
                            'rows'=>5)
                        )
                    )
                ->add('details', 'collection', array(
                    'type' => new FactureDetailType,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                ))
                /*->add('demandeur','genemu_jqueryselect2_entity',array (
                      'label' => 'Demandeur',
                       'class' => 'mgate\\PersonneBundle\\Entity\\Personne',
                       'property' => 'prenomNom',
                       'query_builder' => function(PersonneRepository $pr) {
                            return $pr->getMembreOnly();
                        },
                       'required' => true))*/
                ->add('date', 'genemu_jquerydate', array('label'=>'Date', 'required'=>true, 'widget'=>'single_text'));
    }

    public function getName() {
        return 'mgate_tresobundle_facturetype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'mgate\TresoBundle\Entity\Facture',
        ));
    }
    


}