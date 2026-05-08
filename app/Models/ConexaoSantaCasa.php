<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConexaoSantaCasa extends Model
{
   	var $con;
	//** Constructor to open connection 
	function ConnectionBD()
	{
		
		 
	 $this->con = oci_connect('webservice', '123mudar', 'producao.world');	
		if( !$this->con )
		{
			echo( "Erro ao conectar com o banco de dados." );
			exit;
		}
		// mysql_select_db( apsgeren_xcrud , $this->con );
		
		return $this->con;
	}
	
	//** Close connection function 
	function CloseBd()
	{
		oci_close($this->con );
	}
}

 