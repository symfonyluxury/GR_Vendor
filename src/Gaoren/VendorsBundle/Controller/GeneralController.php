<?php

namespace Gaoren\VendorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gaoren\VendorsBundle\Form\ProductType;
use Gaoren\VendorsBundle\Entity\Product;

class GeneralController extends Controller
{

      /**
       * @Route("/hello/{name}")
       * @Template()
       */
      public function indexAction($name)
      {
            $product = new Product();
            $form = $this->createForm( new ProductType(), $product );

            return array('name' => $name, 'form' => $form->createView());
      }

}
