<?php
	session_start();
	include_once "../defines.php";
	require_once('../classes/BD.class.php');
	BD::conn();
		$pegaUsuarios = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE `id` = ?");
				$pegaUsuarios->execute(array($_GET['session']));
				while($row = $pegaUsuarios->fetch()){
					$foto = $row['foto'];
					$sexo = $row['sexo'];
					$nome = $row['nome'];
					$blocks = explode(',', $row['blocks']);
					$agora = date('Y-m-d H:i:s');
					if(!in_array($_SESSION['id_user'], $blocks)){
						$status = 'on';
						if($agora >= $row['limite']){
							$status = 'off';
						}
					}}
			?>
			<style>
#album{
	
border-bottom:2px solid #000;	
}
textarea{font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;text-height:25px; overflow:3px; height:64px;
 border:0px solid #FFF; padding-left:5px;padding-top:20px; padding-bottom:15px;margin-left:8px; }
</style>

<table width="auto" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col"><div class="imgSmall" style="margin:7px;"><?php if($foto==''){?>
<?php if($sexo=='Hombre'){?>
<img src="material/Mujer.jpg" class="foto" width="60"  height="60" />
<?php }else if($sexo=='Mujer'){ ?>
<img src="material/Hombre.jpg" class="foto" width="60"  height="60" />
 <?php }?>
<?php }else{ ?>
 <img src="fotos/<?php echo $foto;?>" class="foto" width="60"  height="60" />           
 <?php }?></div></th>
    <th scope="col"><textarea cols="64"  placeholder="Que estas pensando, <?php echo $nome; ?>"></textarea></th>
  </tr>
</table>

