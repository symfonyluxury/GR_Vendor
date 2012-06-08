<?php

namespace Gaoren\VendorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="Gaoren\VendorsBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{

      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

      /**
       * @ORM\OneToMany(targetEntity="Product", mappedBy="user")
       * @ORM\OrderBy({"createdAt" = "DESC"})
       */
      protected $products;
      /*
       * @ORM\Column(type="datetime", name="created_at")
       */
      protected $createAt;

      public function __construct()
      {
            parent::__construct();
            $this->products = new ArrayCollection();
            $this->createAt = new \DateTime();
      }

      /**
       * Get id
       *
       * @return integer 
       */
      public function getId()
      {
            return $this->id;
      }

      /**
       * Add products
       *
       * @param Gaoren\VendorsBundle\Entity\Product $products
       * @return User
       */
      public function addProduct(\Gaoren\VendorsBundle\Entity\Product $products)
      {
            $this->products[] = $products;
            return $this;
      }

      /**
       * Get products
       *
       * @return Doctrine\Common\Collections\Collection 
       */
      public function getProducts()
      {
            return $this->products;
      }

}