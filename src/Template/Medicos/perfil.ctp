<?php
$this->assign('title', 'Meu Perfil');
?>

<ol class="breadcrumb bg-info">
  <li><a href="<?=$this->Url->build(["controller" => "Pages","action" => "display","home"]);?>"><span class='fa fa-home'></span> Início</a></li>
  <li class="active">Meu Perfil</li>
</ol>

<h1 class='roundTop'><i class='fa fa-user-md'></i> Meu Perfil</h1>

<div class="well-busca roundBottom">
	<h2><?=h(ucwords(strtolower($medico['NOME_USUARIO'])));?></h2>
	<ul>
		<li>Usuário: <?=h($medico['USERNAME']);?></li>
		<li>CRM: <?=h($medico['CRM']);?></li>
	</ul>
	<hr/>
	<h2>Especialidades</h2>
	<ul>
		<?php
		$esp = explode(',',$medico['ESPECIALIDADES']);
		foreach ($esp as $value) echo "<li>".ucfirst(strtolower($value))."</li>";
		?>
	</ul>

</div>
