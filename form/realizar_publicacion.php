 <style>
  .search-bubble-innardsxb {
    background: -webkit-linear-gradient(rgba(255, 248, 172, 0.9), rgba(255, 243, 128, 0.9));
    border-radius: 2px;
    padding: 4px 10px;
    text-align: center;
    width:100px;
}

.search-bubble-innardsxb::before {
    border: 1px solid rgb(220, 198, 72);
    border-radius: 2px;
    bottom: -1px;
    content: '';
    left: -1px;
    position: absolute;
    right: -1px;
    top: -1px;
    z-index: -2;
}
.search-bubblexb {
    position: absolute;
    z-index: 1;
}
</style>
<script>
$(document).ready(setInterval(function() {
   var publicacion=$('#cont_publicacion').val();
	if(publicacion!=''){
		$('.search-bubblexb').css('display','block');
	}else{
		$('.search-bubblexb').css('display','none');
	}
}),1000);
</script>
<script>
$(document).ready(function() {
  	$('.search-bubble-innardsxb').click(function(){
		var cont_publicacion=$('#cont_publicacion').val();
		var propietario=<?php echo $_GET['session'];?>;
		$.post("ins.php", {cont_publicacion: cont_publicacion, propietario: propietario},function(){
			var cont_publicacion=$('#cont_publicacion').val('');
			});
		
	})
});
</script>
<div class="search-bubblexb" style="left: 499px;top: 29px;display:none;"><div class="search-bubble-innardsxb"><span class="icon-checkmark"></span> Publicar</div></div>
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
#realizar_publi{
	
border-bottom:2px solid #000;	
}
textarea{font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;text-height:25px; overflow:3px; height:64px;
 border:0px solid #FFF; padding-left:5px;padding-top:20px; padding-bottom:15px;margin-left:8px; }
</style>

<table width="auto" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col"><div class="imgSmall" style="margin:7px;"><?php if($foto==''){?>
<?php if($sexo=='Hombre'){?>
<img src="material/Hombre.jpg" class="foto" width="60"  height="60" />
<?php }else if($sexo=='Mujer'){ ?>
<img src="material/Mujer.jpg" class="foto" width="60"  height="60" />
 <?php }?>
<?php }else{ ?>
 <img src="fotos/<?php echo $foto;?>" class="foto" width="60"  height="60" />           
 <?php }?></div></th>
    <th scope="col"><textarea cols="64" id="cont_publicacion"  placeholder="Que estas pensando, <?php echo $nome; ?>"></textarea></th>
  </tr>
</table>

