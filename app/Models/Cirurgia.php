<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cirurgia extends Model
{
    protected $connection = 'oracle';
 	protected $table = 'VDIC_PACIENTE_BENEFICIARIO';
 	protected $fillable = ['NR_CPF'];  

 
 

    public function searchMae($mae)
    {  	
     return  $this->where('NM_MAE', $mae)
                        ->orWhere('NM_MAE', 'like', "%$mae%")
                        ->orWhere('NM_PACIENTE', 'like', "%$mae%")
                        ->get();          
    }

    public function searchCID($cid)
    {  	
     return  DB::connection('oracle')->table('dbamv.cid')
     				->where('SN_ATIVO', 'S')
                    ->Where('CD_CID', $cid)
                    ->orWhere('DS_CID', 'like', "%$cid%")
                        ->get();          
    }


    public function searchConvenio($convenio)
    {  	
     // return  DB::connection('oracle')->table('dbamv.convenio')
     // 	->where('SN_ATIVO', 'S')
     //    ->Where('CD_CONVENIO',	$convenio)
     //    ->orWhere('NM_CONVENIO','like', "%$convenio%")
     //    ->get(); 
     return DB::connection('oracle')
     ->select("SELECT TO_CHAR(A.CD_CONVENIO) as CD_CONVENIO , A.NM_RAZAO_SOCIAL from DBAMV.CONVENIO A where A.SN_ATIVO = 'S'   and  ( TO_CHAR(A.CD_CONVENIO)  = '$convenio' OR A.NM_RAZAO_SOCIAL like '%$convenio%') 
				 ");            
    }

    public function searchTUSS($tuss)
    {  	
     return DB::connection('oracle')
     ->select("SELECT TO_CHAR(B.CD_TUSS) as CD_TUSS, upper(B.DS_TUSS) as DS_TUSS FROM DBAMV.TUSS B 
      WHERE B.CD_TIP_TUSS =  22 
      and  ( B.CD_TUSS  = '$tuss'  OR  B.DS_TUSS like '%$tuss%') 
      GROUP BY  B.CD_TUSS, B.DS_TUSS");       
    }

    public function searchOPME($opme)
    {  	
     return DB::connection('oracle')
     ->select("SELECT TO_CHAR(C.CD_PRO_FAT) as CD_PRO_FAT ,C.DS_PRO_FAT FROM
		DBAMV.GRU_PRO A, DBAMV.GRU_FAT B, DBAMV.PRO_FAT C
		WHERE A.CD_GRU_PRO IN (9,72)
		AND B.CD_GRU_FAT = A.CD_GRU_FAT
		AND A.CD_GRU_PRO = C.CD_GRU_PRO
		AND C.SN_ATIVO = 'S'
		AND  ( TO_CHAR(C.CD_PRO_FAT)  = '$opme'  OR  upper(C.DS_PRO_FAT) like '%$opme%') 
		 ");       
    }

 

//  select C.CD_PRO_FAT,C.DS_PRO_FAT from
// dbamv.gru_pro a,dbamv.gru_fat b,dbamv.pro_fat c
// where a.cd_gru_pro in (9,72)
// and b.cd_gru_fat = a.cd_gru_fat
// and a.cd_gru_pro = c.cd_gru_pro
// and c.sn_ativo = 'S'




}
