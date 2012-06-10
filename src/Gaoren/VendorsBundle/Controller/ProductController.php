<?php

namespace Gaoren\VendorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Gaoren\VendorsBundle\Entity\Product;
use Gaoren\VendorsBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

      /**
       * Lists all Product entities.
       *
       * @Route("/", name="product")
       * @Template()
       */
      public function indexAction()
      {
            $em = $this->getDoctrine()->getManager();
            $dql = "SELECT p FROM GaorenVendorsBundle:Product p WHERE p.user =" . $this->getUser()->getId();
            $entities = $em->createQuery( $dql );

            $paginator = $this->get( 'knp_paginator' );
            $pagination = $paginator->paginate(
                    $entities, $this->getRequest()->query->get( 'page', 1 ), 10
            );

            return compact( 'pagination' );
      }

      /**
       * Finds and displays a Product entity.
       *
       * @Route("/product/{id}/show", name="product_show")
       * @Template()
       */
      public function showAction($id)
      {
            $em = $this->getDoctrine()->getManager();

            $this->checkPrivilege( $em, $id );

            $entity = $em->getRepository( 'GaorenVendorsBundle:Product' )->find( $id );

            if ( ! $entity)
            {
                  throw $this->createNotFoundException( '抱歉，找不到该产品.' );
            }

            $deleteForm = $this->createDeleteForm( $id );

            return array(
                      'entity' => $entity,
                      'delete_form' => $deleteForm->createView(),
            );
      }

      /**
       * Displays a form to create a new Product entity.
       *
       * @Route("/product/new", name="product_new")
       * @Template()
       */
      public function newAction()
      {
            $entity = new Product();
            $form = $this->createForm( new ProductType(), $entity );

            return array(
                      'entity' => $entity,
                      'form' => $form->createView(),
            );
      }

      /**
       * Creates a new Product entity.
       *
       * @Route("/product/create", name="product_create")
       * @Method("post")
       * @Template("GaorenVendorsBundle:Product:new.html.twig")
       */
      public function createAction()
      {
            $entity = new Product();
            $entity->setUser( $this->getUser() );
            $request = $this->getRequest();
            $form = $this->createForm( new ProductType(), $entity );
            $form->bindRequest( $request );

            if ($form->isValid())
            {
                  $em = $this->getDoctrine()->getManager();
                  $em->persist( $entity );
                  $em->flush();

                  return $this->redirect( $this->generateUrl( 'product_show', array('id' => $entity->getId()) ) );
            }

            return array(
                      'entity' => $entity,
                      'form' => $form->createView(),
            );
      }

      /**
       * Displays a form to edit an existing Product entity.
       *
       * @Route("/product/{id}/edit", name="product_edit")
       * @Template()
       */
      public function editAction($id)
      {
            $em = $this->getDoctrine()->getManager();

            $this->checkPrivilege( $em, $id );

            $entity = $em->getRepository( 'GaorenVendorsBundle:Product' )->find( $id );

            if ( ! $entity)
            {
                  throw $this->createNotFoundException( 'Unable to find Product entity.' );
            }

            $editForm = $this->createForm( new ProductType(), $entity );
            $deleteForm = $this->createDeleteForm( $id );

            return array(
                      'entity' => $entity,
                      'edit_form' => $editForm->createView(),
                      'delete_form' => $deleteForm->createView(),
            );
      }

      /**
       * Edits an existing Product entity.
       *
       * @Route("/product/{id}/update", name="product_update")
       * @Method("post")
       * @Template("GaorenVendorsBundle:Product:edit.html.twig")
       */
      public function updateAction($id)
      {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository( 'GaorenVendorsBundle:Product' )->find( $id );

            if ( ! $entity)
            {
                  throw $this->createNotFoundException( 'Unable to find Product entity.' );
            }

            $editForm = $this->createForm( new ProductType(), $entity );
            $deleteForm = $this->createDeleteForm( $id );

            $request = $this->getRequest();

            $editForm->bindRequest( $request );

            if ($editForm->isValid())
            {
                  $em->persist( $entity );
                  $em->flush();

                  return $this->redirect( $this->generateUrl( 'product_edit', array('id' => $id) ) );
            }

            return array(
                      'entity' => $entity,
                      'edit_form' => $editForm->createView(),
                      'delete_form' => $deleteForm->createView(),
            );
      }

      /**
       * Deletes a Product entity.
       *
       * @Route("/product/{id}/delete", name="product_delete")
       * @Method("post")
       */
      public function deleteAction($id)
      {
            $form = $this->createDeleteForm( $id );
            $request = $this->getRequest();

            $form->bindRequest( $request );

            if ($form->isValid())
            {
                  $em = $this->getDoctrine()->getManager();
                  $entity = $em->getRepository( 'GaorenVendorsBundle:Product' )->find( $id );

                  if ( ! $entity)
                  {
                        throw $this->createNotFoundException( 'Unable to find Product entity.' );
                  }

                  $em->remove( $entity );
                  $em->flush();
            }

            return $this->redirect( $this->generateUrl( 'product' ) );
      }

      private function createDeleteForm($id)
      {
            return $this->createFormBuilder( array('id' => $id) )
                            ->add( 'id', 'hidden' )
                            ->getForm()
            ;
      }

      private function checkPrivilege($em, $id)
      {
            $priviledge = $em->getRepository( 'GaorenVendorsBundle:Product' )->checkProductOwnership( $id, $this->getUser()->getId() );

            if ( ! $priviledge)
            {
                  throw new AccessDeniedException( '您没权限对该产品浏览' );
            }
      }

}
