<?php 
require_once '../Controllers/conexionControllers.php';


class producto extends conexionController
{
	
	public function crear(array $data = null) 		// -- C --
	{
		if ($data == null) 
		{
			$dataMenssage = ['Menssage' => 'Campos vacios, debe ingresar algun registro'];
			echo json_encode($dataMenssage);
		}else{
				$productoExistente = self::leer($data['nombre']);
					if ($productoExistente['nombre'] == $data['nombre']) 
					{
						$dataMenssage = ['Menssage' =>'Este producto ya se encuentra registrado'];
						$result = json_encode($dataMenssage);
						echo $result;
					}else{
						$sql = "INSERT INTO producto (nombre, 
														descripcion, 
														costo,
														precio, 
														cantidad, 
														imagen) 
														VALUES (  
														'".$data['nombre']."', 
													  	'".$data['descripcion']."', 
													  	'".$data['costo']."',
													  	'".$data['precio']."',
													  	'".$data['cantidad']."', NULL)";
						$crear  = $this->query($sql);
						$dataMenssage = ['Menssage' => 'Producto Creado'];
						$result = json_encode($dataMenssage);
						echo $result;
		 			}
		}
	}
	public function leer($nombreT = null) 			// -- R --
	{ 

		if ($nombreT == null) 
		{
			$sql = "SELECT * FROM producto";
		}else{
			$sql = "SELECT * FROM producto WHERE nombre = '". $nombreT ."'";
		}
	
		$ver = $this->query($sql);
		$result = mysqli_fetch_assoc($ver);

		if ($result == null) {
			$dataMenssage = ['Menssage' => 'El producto no existe'];
			echo json_encode($dataMenssage);
		}

		return $result;
	
	}
	public function actualizar(array $data, $id) 	// -- U --
	{
		$sql = "UPDATE producto SET nombre = '".$data['nombre']."', descripcion = '".$data['descripcion']."' , costo = '".$data['costo']."', precio = '".$data['precio']."', cantidad = '".$data['cantidad']."' WHERE id = '".$id."' ";
		$actualizar = $this->query($sql);
		if ($actualizar == true) 
		{
			$dataMenssage = ['Menssage' => 'Producto actualizado'];
			echo json_encode($dataMenssage);
		}else{
			$dataMenssage = ['Menssage' => 'Error al actualizar el producto'];
			echo json_encode($dataMenssage);
		}
	}
	public function eliminar($id = null) 		// -- D --
	{
		
		$sql = "DELETE FROM producto WHERE id = '".$id."' ";
		$eliminar = $this->query($sql);

		if ($eliminar == true) 
		{
			$dataMenssage = ['Menssage' => 'El Producto " -- '.$id.' --" ha sido eliminado'];
			echo json_encode($dataMenssage);

		}else{
			$dataMenssage = ['Menssage' => 'Error al eliminar el producto: " --'.$id.' --"'];
			echo json_encode($dataMenssage);
		}
		return $eliminar;
	}
}

?>