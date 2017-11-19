<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('common.css') ?>
    <?= $this->Html->css('main.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
  <?php $toParent = $this->get('toParent');?>

    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">Backend Management</a></h1>
        </div>
    </div>

<div class="container clearfix">
    <div class="sidebar-wrap">

            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe9ae;</i>Business</a>
                    <ul class="sub-menu">
                        <li> <?= $this->Html->link('<i class="icon-font">&#xe930;</i>'.__('Categories', true), ['controller' => 'Categories', 'action' => 'index'], ['escape' => false]); ?> </li>
                        <li> <?= $this->Html->link('<i class="icon-font">&#xe937;</i>'.__('Products', true), ['controller' => 'Products', 'action' => 'index'], ['escape' => false]); ?> </li>
                        <li> <?= $this->Html->link('<i class="icon-font">&#xe93a;</i>'.__('Orders', true), ['controller' => 'Orders', 'action' => 'index'], ['escape' => false]); ?> </li>
                        <li> <?= $this->Html->link('<i class="icon-font">&#xe964;</i>'.__('Stocks', true), ['controller' => 'Stocks', 'action' => 'index'], ['escape' => false]); ?> </li>
                        <li> <?= $this->Html->link('<i class="icon-font">&#xe935;</i>'.__('Prices', true), ['controller' => 'Products', 'action' => 'index'], ['escape' => false]); ?> </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe920;</i>Administration</a>
                    <ul class="sub-menu">
                        <li><a href="#"><i class="icon-font">&#xea0c;</i>Notices</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe99d;</i>Sales</a>
                    <ul class="sub-menu">
                        <li><a href="#"><i class="icon-font">&#xe99b;</i>Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe972;</i>HR</a>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe904;</i>Finance</a>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe991;</i>Tools</a>
                    <ul class="sub-menu">
                        <li><a href="#"><i class="icon-font">&#xe994;</i>Options</a></li>
                        <li><a href="#"><i class="icon-font">&#xea2d;</i>Data Process</a></li>
                    </ul>
                </li>
            </ul>
    </div>
    <!--/sidebar-->

    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <!--/main-->
</div>
</body>
</html>
