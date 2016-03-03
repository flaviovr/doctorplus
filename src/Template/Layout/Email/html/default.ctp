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

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
 */


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
 	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  		<title><?= $this->fetch('title') ?></title>
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet" type="text/css">
	<style type="text/css">
		body{
			background-image: url('http://i.imgur.com/yqijPVJ.gif');
			background-repeat: repeat-y no-repeat;
			background-color: #f8f8f8;
			margin: 0;
			padding: 0;
		}
		.bgcor {
			background-image: url('http://i.imgur.com/R8is5cD.gif');
			background-repeat: repeat-x no-repeat;
			background-color: #fff;
			margin: 0;
			padding: 0;	
		}
		p{
			font-size:12px;
			margin:0px;
			line-height:14px;
			font-family:"Roboto Condensed", Arial;
			text-align:left;
		}
		p.nome{
			display:block;
			font-size:28px;
			font-weight:800;
			line-height:28px;
			margin-bottom:3px;
		}
		#data{
			height:30px;
			font-family:"Roboto Condensed", Arial;
			line-height:30px;
			padding:0px 20px 0px 20px;
			margin:0px;
			background-color:#e8e7e7;
			color:#585858;
			font-weight:700;
			font-size:11px;
			text-transform:uppercase;
			text-align:left;
		}
		#texto p{
			font-family:Arial;
			font-size:14px;
			margin-bottom:10px;
			color:#585858;
		}
		.amarelo{
			background:linear-gradient(to bottom,  #fcdd4e 0%,#f9c404 100%);
			filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcdd4e', endColorstr='#f9c404',GradientType=0 );
		}
		.amarelotxt{
			color:#03316f;
			line-height:14px;
		}
		.amarelobg{
			background-color:#f9c404;
		}
</style></head>
	
	<body bgcolor="#f8f8f8" style="margin: 0; padding: 0;">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height='100%' background='http://i.imgur.com/yqijPVJ.gif' bgcolor='#fff' style='background-position: center -30px; '>
			
			<tr><td style="font-size: 0; line-height: 0;" height="40"> </td></tr>
			
			<tr>
				<td align="center" valign="top">
					
					<table class='bgcor' align="center" cellpadding="0" cellspacing="0" width="600"  bgcolor='#fff' style="border:1px solid #f8f8f8; background-repeat: repeat-x; border-collapse: collapse;">
						
						<!-- Cabeçalho -->
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style='margin-bottom:20px;'>
									
									<tr class="" style="">
										<td align="center" style="height:120px; padding:0;">
											<img src="http://i.imgur.com/fYQLHEe.png" />
										</td>
									</tr>
									
								</table>
							</td>

						</tr>


						<!-- Barra de Datas -->
						<tr><td bgcolor="#e8e7e7" id="data" align="left" style="height: 30px;font-family: 'Roboto Condensed', Arial;line-height: 30px;padding: 0px 20px 0px 20px;margin: 0px;background-color: #e8e7e7;color: #585858;font-weight: 700;font-size: 11px;text-transform: uppercase;text-align: left;"><?=$data?></td></tr>
						
						<!-- Corpo  do E-mail -->
						<tr><td bgcolor="#FFFFFF" style="padding:30px 20px 30px 20px;">
							
							<div><?= $this->fetch('content') ?></div>

						</td></tr>
						
						<!-- Rodapé -->
						<tr><td valign="middle" align="center" bgcolor="#f8f8f8" style="padding:20px 20px 20px 20px ;"><p>	Esta é uma publicação interna da Casa de Saúde São José. Se você não for o destinatário pretendido, favor notificar imediatamente o remetente e remover a mensagem do seu computador.  A disseminação, distribuição e/ou cópia deste email, como permite a lei são proibidas. </p></td></tr>

						<!-- Links de Cancelamento -->
						<tr>
							<td bgcolor="#FFFFFF" style="padding:20px;">
								<p style="padding-top: 10px;line-height: 20px;font-size: 12px;text-align: center;margin: 0px;font-family: 'Roboto Condensed', Arial;">
									Caso não deseje mais receber esses e-mails : 
									<a href="#">Cancelar Assinatura</a> 
									<br> Não consegue ver esse e-mail? 
									<a href="#">Ver no Navegador</a>
								</p>
							</td>
						</tr>

						

					</table>

				</td>
			</tr>
			
			<tr><td style="font-size: 0; line-height: 0;" height="60"> </td></tr>

		</table>
		
	</body>

</html>