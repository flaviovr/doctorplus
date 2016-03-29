<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Doctor Plus';

?>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $cakeDescription ?> : <?= $this->fetch('title') ?></title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <!-- Includes do CSS Bootstrap-->
    <?= $this->Html->css('bootstrap.min')?>
    <?= $this->Html->css('bootstrap-theme.min')?>
    <!-- Includes do CSS do FontAwesome-->
    <?= $this->Html->css('font-awesome.min') ?>
    <!-- Includes do CSS da página de login-->
    <?= $this->Html->css('login') ?>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Includes do Bootstrap-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
    		<div id='loginWraper' class='col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 round'>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>

    <!-- Inclui jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?= $this->Html->script("jquery-1.12.1.min")?>
    <!-- Include script de easing para suavizar animações -->
    <?= $this->Html->script('jquery.easing.min');?>
    <!-- Include Bootstrap JS -->
    <?= $this->Html->script("bootstrap.min")?>

</body>
</html>
