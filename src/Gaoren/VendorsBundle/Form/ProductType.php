<?php

namespace Gaoren\VendorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{

      public function buildForm(FormBuilderInterface $builder, array $options)
      {
            $builder
                  ->add( 'name', 'text', array('label' => '产品名称', 'required' => false) )
                  ->add( 'price', null, array('label' => '产品价格', 'required' => false) )
                  ->add( 'description', 'textarea', array('label' => '产品描述', 'required' => false) )
            ;
      }

      public function getName()
      {
            return 'gaoren_vendorsbundle_producttype';
      }

}
