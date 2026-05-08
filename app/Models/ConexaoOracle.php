<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConexaoOracle extends Model
{
   	var $con;
	//** Constructor to open connection 
	function ConnectionBD()
	{
		
		$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =10.201.21.2)(PORT = 1521))
(CONNECT_DATA = (SERVICE_NAME = prdme1)))";


		 
	 $this->con = oci_connect('tangram', 'tangram2019', $dbstr1);	
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

 