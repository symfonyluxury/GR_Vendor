<?php

namespace Gaoren\VendorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Gaoren\VendorsBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks
 */
class Product
{

      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

      /**
       * @ORM\Column(type="string", length=33)
       * @Assert\NotBlank(message= "请填写产品名称")
       * @Assert\MinLength(
       *     limit=2,
       *     message="信息过短，至少需要{{ limit }}个字"
       * )
       * @var string $name 
       */
      protected $name;

      /**
       * @ORM\Column(type="decimal", scale=2)
       * @Assert\NotBlank(message= "请填写产品价格")
       * @var type 
       */
      protected $price;

      /**
       * @ORM\Column(type="text")
       * @Assert\NotBlank(message = "请填写产品名称")
       * @var string $description 
       */
      protected $description;

      /**
       * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
       * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
       */
      protected $user;

      /**
       * @ORM\Column(type="datetime", name="created_at")
       * @var DateTime  $createdAt
       */
      protected $createdAt;

      /**
       * @ORM\Column(type="datetime", name="updated_at")
       * @var DateTime  $updatedAt
       */
      protected $updatedAt;

      public function __construct()
      {
            $this->createdAt = new \DateTime();
            $this->updatedAt = new \DateTime();
      }

      /** @ORM\PreUpdate */
      public function preUpdate()
      {
            $this->updatedAt = new \DateTime();
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
       * Set name
       *
       * @param string $name
       * @return Product
       */
      public function setName($name)
      {
            $this->name = $name;
            return $this;
      }

      /**
       * Get name
       *
       * @return string 
       */
      public function getName()
      {
            return $this->name;
      }

      /**
       * Set description
       *
       * @param text $description
       * @return Product
       */
      public function setDescription($description)
      {
            $this->description = $description;
            return $this;
      }

      /**
       * Get description
       *
       * @return text 
       */
      public function getDescription()
      {
            return $this->description;
      }

      /**
       * Set createdAt
       *
       * @param datetime $createdAt
       * @return Product
       */
      public function setCreatedAt($createdAt)
      {
            $this->createdAt = $createdAt;
            return $this;
      }

      /**
       * Get createdAt
       *
       * @return datetime 
       */
      public function getCreatedAt()
      {
            return $this->createdAt;
      }

      /**
       * Set updatedAt
       *
       * @param datetime $updatedAt
       * @return Product
       */
      public function setUpdatedAt($updatedAt)
      {
            $this->updatedAt = $updatedAt;
            return $this;
      }

      /**
       * Get updatedAt
       *
       * @return datetime 
       */
      public function getUpdatedAt()
      {
            return $this->updatedAt;
      }

      /**
       * Set price
       *
       * @param decimal $price
       * @return Product
       */
      public function setPrice($price)
      {
            $this->price = $price;
            return $this;
      }

      /**
       * Get price
       *
       * @return decimal 
       */
      public function getPrice()
      {
            return $this->price;
      }

      /**
       * Set user
       *
       * @param Gaoren\VendorsBundle\Entity\User $user
       * @return Product
       */
      public function setUser($user)
      {
            $this->user = $user;
            return $this;
      }

      /**
       * Get user
       *
       * @return Gaoren\VendorsBundle\Entity\User 
       */
      public function getUser()
      {
            return $this->user;
      }

}