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

            $menu->addChild( 'vendor_panel' )->setAttribute( 'class', 'nav-header li-header' )->setLabel( '公司信息' );
            $menu->addChild( 'profile', array('route' => 'fos_user_profile_show') )->setExtra( 'safe_label', true )->setLabel( '<i class="icon-user"></i>账户概要' );
            $menu->addChild( 'profile_setting', array('route' => 'fos_user_profile_edit') )->setExtra( 'safe_label', true )->setLabel( '<i class="icon-cog"></i>账户设置' );
            $menu->addChild( 'resetting', array('route' => 'fos_user_change_password') )->setExtra( 'safe_label', true )->setLabel( '<i class="icon-lock"></i>重设密码' );
            $menu->addChild( 'product' )->setAttribute( 'class', 'nav-header li-header' )->setLabel( '公司产品' );
            $menu->addChild( 'product_list', array('route' => 'product') )->setExtra( 'safe_label', true )->setLabel( '<i class="icon-th-list"></i>产品列表' );
            $menu->addChild( 'product_new', array('route' => 'product_new') )->setExtra( 'safe_label', true )->setLabel( '<i class="icon-plus-sign"></i>新建产品' );

            return $menu;
      }

}

?>