<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class pesquisaTrangramSCIH extends Model
{
    protected $connection = 'oracle';
 	protected $table = 'PESQUISA_TRANGRAM_SCIH';
 	//protected $table = 'VDIC_PACIENTE_BENEFICIARIO';
 	//protected $fillable = ['PACIENTE'];  

 

      public function pesquisaTrangramSCIH()  
      {

      	 return DB::connection('oracle')
    		 ->select("select * from dbamv.pesquisa_trangram_scih
				"); 
 

   
    }

}



// WHERE TO_DATE(AC.DT_AVISO_CIRURGIA, 'dd/mm/yyyy') =
// (SELECT TO_DATE(SYSDATE, 'dd/mm/yyyy') - 30 FROM DUAL)
// AND P.CD_PACIENTE = A.CD_PACIENTE
// AND PR.CD_PRESTADOR = A.CD_PRESTADOR
// AND AC.CD_ATENDIMENTO = A.CD_ATENDIMENTO
// AND U.CD_UNID_INT = AC.CD_UNID_INT
// AND CA.CD_AVISO_CIRURGIA = AC.CD_AVISO_CIRURGIA
// AND C.CD_CIRURGIA = CA.CD_CIRURGIA
// AND PF.CD_PRO_FAT = C.CD_PRO_FAT
// AND P.CD_CIDADE=CDD.CD_CIDADE--> Inserido Andre Luiz
// AND A.DT_ALTA IS NOT NULL
// AND AC.DT_REALIZACAO IS NOT NULL
// ;
