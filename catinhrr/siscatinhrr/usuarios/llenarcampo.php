<?php
	require_once('conexion_fns.php');
	$conector=ConectarBD();
	$sql1="SELECT * FROM usuarios WHERE cedula = '$ParCed' LIMIT 1";
	$consulta1=EjecuteExec1($conector,$sql1) or die($sql1);
	if(mysql_num_rows($consulta1)>0){
		$campo1 = mysql_fetch_object($consulta1);
		$apellido = $campo1->apellidos;
		$nombre = $campo1->nombres;
		$usuario = $campo1->usuario;
		$clave = $campo1->clave;
		$nivel = $campo1->nivel;
		echo "<div>&nbsp;Apellidos</div><div>&nbsp;<input type='text' name='txtApellidos' id='txtApellidos' size='50' maxlength='50' value='$apellido'/></div><br />";
		echo "<div>&nbsp;Nombres</div><div>&nbsp;<input type='text' name='txtNombres' id='txtNombres' size='50' maxlength='50' value='$nombre'/></div><br />";
		echo "<div>&nbsp;Usuario</div><div>&nbsp;<input type='text' name='txtUsuario' id='txtUsuario' size='50' maxlength='50' value='$usuario'/></div><br />";
		echo "<div>&nbsp;Clave</div><div>&nbsp;<input type='text' name='txtClave' id='txtClave' size='50' maxlength='50' value='$clave'/></div><br />";
		echo "<div>&nbsp;Nivel</div><div>&nbsp;<input type='text' name='txtNivel' id='txtNivel' size='50' maxlength='50' value='$nivel'/></div>";	
	}else{
		$sql2="SELECT apellidos, nombres, codunifisica FROM personal WHERE cedula = '$ParCed' LIMIT 1";
		$consulta2=EjecuteExec2($conector,$sql2) or die($sql2);
		if(mysql_num_rows($consulta2)>0){
			$campo2 = mysql_fetch_object($consulta2);
			$apellido = $campo2->apellidos;
			$nombre = $campo2->nombres;
			$codua = $campo2->codunifisica;
		echo "<div>&nbsp;Apellidos</div><div>&nbsp;<input type='text' name='txtApellidos' id='txtApellidos' size='50' maxlength='50' value='$apellido'/></div><br />";
		echo "<div>&nbsp;Nombres</div><div>&nbsp;<input type='text' name='txtNombres' id='txtNombres' size='50' maxlength='50' value='$nombre'/></div><br />";
		echo "<div>&nbsp;Usuario</div><div>&nbsp;<input type='text' name='txtUsuario' id='txtUsuario' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Clave</div><div>&nbsp;<input type='text' name='txtClave' id='txtClave' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Nivel</div><div>&nbsp;<input type='text' name='txtNivel' id='txtNivel' size='50' maxlength='50'/></div>";	
		}else{
		echo "<div>&nbsp;Apellidos</div><div>&nbsp;<input type='text' name='txtApellidos' id='txtApellidos' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Nombres</div><div>&nbsp;<input type='text' name='txtNombres' id='txtNombres' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Usuario</div><div>&nbsp;<input type='text' name='txtUsuario' id='txtUsuario' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Clave</div><div>&nbsp;<input type='text' name='txtClave' id='txtClave' size='50' maxlength='50'/></div><br />";
		echo "<div>&nbsp;Nivel</div><div>&nbsp;<input type='text' name='txtNivel' id='txtNivel' size='50' maxlength='50'/></div>";	
		}
	}
?>