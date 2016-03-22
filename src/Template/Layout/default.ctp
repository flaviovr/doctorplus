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
    <!-- Includes do CSS do Bootstrap Datepicker https://github.com/Eonasdan/bootstrap-datetimepicker-->
    <?= $this->Html->css('bootstrap-datetimepicker.min') ?>
    <!-- Includes do CSS do jQuery UI-->
    <?= $this->Html->css('jquery-ui.min') ?>
    <?= $this->Html->css('jquery-ui.theme.min') ?>


    <!-- Includes do CSS da página de login-->
    <?= $this->Html->css('layout') ?>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Includes do Bootstrap-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top clearfix">

        <div class="container ">

            <div class="navbar-header" >
                <?= $this->Html->link(
                    $this->Html->image('logo_doctorplus_brand.png'),
                    ['controller'=>'Pages', 'action'=>'display', 'home'],
                    ['class'=>'navbar-brand text-center', 'escape'=>false]
                    )
                ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"> </span>
                </button>

            </div>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-fw fa-envelope"></span> <?= $userAuth['USERNAME']?> <span class='label label-info label-as-badge'>3</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <p class='text-danger tituloMsg'><b><span class="fa fa-fw fa-calendar-times-o"></span> Cirurgia cancelada </b></p>
                                    <p class='tituloMsg'>
                                        <span class="fa fa-fw fa-user"></span> Alberto Luiz Batista Santos<br>
                                        <span class="fa fa-fw fa-clock-o"></span> 23 Nov, 08:55
                                    </p>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <p class='text-danger tituloMsg'><b><span class="fa fa-fw fa-calendar-times-o"></span> Cirurgia cancelada </b></p>
                                    <p class='tituloMsg'>
                                        <span class="fa fa-fw fa-user"></span> Alberto Luiz Batista Santos<br>
                                        <span class="fa fa-fw fa-clock-o"></span> 23 Nov, 08:55
                                    </p>
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <p class='text-danger tituloMsg'><b><span class="fa fa-fw fa-calendar-times-o"></span> Cirurgia cancelada </b></p>
                                    <p class='tituloMsg'>
                                        <span class="fa fa-fw fa-user"></span> Alberto Luiz Batista Santos<br>
                                        <span class="fa fa-fw fa-clock-o"></span> 23 Nov, 08:55
                                    </p>
                                </a>
                            </li>
                            <li role='navigation' class="divider"></li>
                            <li class='hidden-xs'><?= $this->Html->link('<span class="fa fa-fw fa-bell"></span> Ver Todos Alertas',['controller'=>'medicos', 'action'=>'alertas'],['class'=>'text-info','escape'=> false])?></li>
                            <li class='hidden-xs'><?= $this->Html->link('<span class="fa fa-fw fa-user-md"></span> Meu Perfil',['controller'=>'medicos', 'action'=>'perfil' ,$userAuth['ID']],['escape'=> false])?>
                            </li>
                            <li class='hidden-xs'><?= $this->Html->link('<span class="fa fa-fw fa-comment"></span> Enviar Feedback',['controller'=>'pages', 'action'=>'feedback'],['escape'=> false])?>
                            </li>
                            <li class='hidden-xs'><?= $this->Html->link('<span class="fa fa-fw fa-sign-out"></span> Sair',['controller'=>'medicos', 'action'=>'logout'],['escape'=> false])?>
                            </li>
                        </ul>
                    </li>
                    <li class='visible-xs'><?= $this->Html->link('<span class="fa fa-fw fa-bell"></span> Ver Todos Alertas',['controller'=>'medicos', 'action'=>'alertas'],['class'=>'text-info','escape'=> false])?></li>
                    <li class='visible-xs'><?= $this->Html->link('<span class="fa fa-fw fa-user-md"></span> Meu Perfil',['controller'=>'medicos', 'action'=>'perfil' ,$userAuth['ID']],['escape'=> false])?>
                    </li>
                    <li class='visible-xs'><?= $this->Html->link('<span class="fa fa-fw fa-comment"></span> Enviar Feedback',['controller'=>'pages', 'action'=>'feedback'],['escape'=> false])?>
                    </li>
                    <li class='visible-xs'><?= $this->Html->link('<span class="fa fa-fw fa-sign-out"></span> Sair',['controller'=>'medicos', 'action'=>'logout'],['escape'=> false])?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?= $this->Flash->render() ;?></p>

    <?= $this->fetch('content') ?>

    <!-- Inclui jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?= $this->Html->script("jquery-1.12.1.min")?>

    <!-- Include script de easing para suavizar animações -->
    <?= $this->Html->script('jquery.easing.min');?>

    <!-- Biblioteca JS Moment necessaria para o boostrap datepicker http://momentjs.com/ -->
    <?= $this->Html->script('moment-with-locales.min');?>

    <!-- Include Bootstrap JS -->
    <?= $this->Html->script("bootstrap.min")?>

    <!-- Include Jquey UI  -->
    <?= $this->Html->script("jquery-ui.min")?>

    <!-- Include Bootstrap datepicker https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <?= $this->Html->script("bootstrap-datetimepicker")?>

    <!-- Include Bootstrap datepicker localizacao para portugues -->
    <?= $this->Html->script("pt-br")?>

    <!-- Include com javascript do site -->
    <?= $this->Html->script('default');?>

</body>
</html>
