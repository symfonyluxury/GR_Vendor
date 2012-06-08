<?php

namespace Gaoren\VendorsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Description of Builder
 *
 * @author cc
 */
class Builder extends ContainerAware
{

      public function mainMenu(FactoryInterface $factory, array $options)
      {
            $menu = $factory->createItem( 'menu' )->setChildrenAttribute( 'class', 'nav nav-list' );
            $menu->setCurrentUri( $this->container->get( 'request' )->getRequestUri() );

            $menu->addChild( '企业面板' )->setAttribute( 'class', 'nav-header' );
            $menu->addChild( '', array('route' => 'fos_user_profile_show') )->setLabel( '账户概要' );
            $menu->addChild( '账户设置', array('route' => 'fos_user_profile_edit') );
            $menu->addChild( '重设密码', array('route' => 'fos_user_change_password') );
            $menu->addChild( '企业产品' )->setAttribute( 'class', 'nav-header' );
            $menu->addChild( '产品列表', array('route' => 'product') );
            $menu->addChild( '新建产品', array('route' => 'product_new') );

            return $menu;
      }

}

?>