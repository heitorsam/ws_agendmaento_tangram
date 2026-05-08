<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\ConexaoOracle; 
use App\Models\ConexaoSantaCasa; 

class CobrancaSMS extends Model
{
    protected $connection = 'oracleSaude';
 	protected $table = 'DBAPS.COBRANCASMS';
 	//protected $fillable = ['*']; 






 	public function searchSatusPendente()
    {
   	    return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.COBRANCASMS t  ')) 
			->select(DB::raw(" t.* ")
			)  
		    ->whereRaw("t.status  =  'P' ") 
			->get();                 
    }
	
	public function getEnvioWhatsappBoasVindas()
    {
   	    return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.V_ENVIO_WHATSAPP_BOAS_VINDAS t  ')) 
			->select(DB::raw(" t.* ")
			)  
		    //->whereRaw("t.status  =  'P' ") 
			->get();                 
    }

    public function panicoExecProc(){
        $model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin dbamv.prc_tangram_panico; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;      
    }

    public function panicoPendentes()
    {
        return   DB::connection('oracle')->table(DB::raw('LOG_AGENDAMENTO_CONSULTAS t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_status_envio = 'PE' ") 
            ->whereRaw("t.tipo_comun = '7' ")           
            ->get();                 
    }

    public function getLinkReceiturario($id)
    {
        return   DB::connection('oracle')->table(DB::raw('dbamv.vdic_prescricoes_mevo t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.referencia = " . $id)      
            ->get();                 
    }

    

    public function alterarRespostaPanico($cd_log,$dt_hr_resposta_panico, $resposta_panico)
    {
        return    DB::connection('oracle')->table('dbamv.LOG_AGENDAMENTO_CONSULTAS')
            ->where('CD_LOG', $cd_log)
            ->update([
                        'DT_HR_RESPOSTA_PANICO' => "$dt_hr_resposta_panico",
                        'RESPOSTA_PANICO'       => "$resposta_panico"

                    ]);              
    }

    public function alterarPendentePanico($cd_log,$cod_status_envio)
    {
        return    DB::connection('oracle')->table('dbamv.LOG_AGENDAMENTO_CONSULTAS')
            ->where('CD_LOG', $cd_log)
            ->update(['CD_STATUS_ENVIO' => "$cod_status_envio"]);              
    }

    public function aprovacaoAntibioticoIAMSPEExecProc(){
        $model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin dbamv.prc_tangram_autorizacao_atb; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;      
    }

    public function aprovacaoAntibioticoIAMSPEPendentes()
    {
        return   DB::connection('oracle')->table(DB::raw('LOG_AGENDAMENTO_CONSULTAS t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_status_envio = 'PE' ") 
            ->whereRaw("t.tipo_comun = '8' ")           
            ->get();                 
    }

   
    
	
	public function alterarPendenteAprovacaoAntibioticoIAMSPE($cd_log,$cod_status_envio)
    {
        return    DB::connection('oracle')->table('dbamv.LOG_AGENDAMENTO_CONSULTAS')
            ->where('CD_LOG', $cd_log)
            ->update(['CD_STATUS_ENVIO' => "$cod_status_envio"]);              
    }
	
    public function integracao()
    {
        return   DB::connection('oracle')->table(DB::raw('DBAMV.VDIC_PRESTADORES_TANGRAM t  ')) 
            ->select(DB::raw(" t.* "))          
            ->get();                 
    }

    public function alterarPendente($id_cobrancasms,$status)
    {

   // 	    return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.COBRANCASMS t  ')) 
			// ->update(DB::raw(" t.* ")
			// )  
			//  ->whereRaw("t.status  =  'P' ")           
			// ->get();   

		  return 	DB::connection('oracleSaude')->table('DBAPS.COBRANCASMS')
            ->where('ID_COBRANCASMS', $id_cobrancasms)
            ->update(['STATUS' => "$status"]);              
    }


    public function execProc()
    {
    	$model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin dbaps.prc_enviosms; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;

//    $procedureName = "dbaps.prc_enviosms";

// // $bindings = [
// //     'user_id'  => $id,
// // ];

// $result = DB::connection("oracleSaude")->executeProcedure($procedureName);

// dd($result);

//     	$pdo = DB::connection("oracleSaude")->getPdo();
// $p1 = 8;

// $stmt = $pdo->prepare("begin DBAPS.PRC_ENVIOSMS; end;");
// // $stmt->bindParam(':p1', $p1, PDO::PARAM_INT);
// // $stmt->bindParam(':p2', $p2, PDO::PARAM_INT);
// $stmt->execute();

//return $p2; // prints 16

    	//      $command = 'begin DBAPS.PRC_ENVIOSMS; end;';
     // return   DB::connection('oracleSaude')->getPdo()->exec($command);

//     		return DB::connection('oracleSaude')->select("begin
//    DBAPS.PRC_ENVIOSMS; end;
// ");

//     	return	DB::connection('oracleSaude')->raw(
//     'begin DBAPS.PRC_ENVIOSMS; end;'
// )->execute();
           
    }

    public function execProcPrcEnvioEmailSSaude()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIOEMAIL; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }



    public function listEnvioEmailSSaude()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.COBRANCAEMAIL t  ')) 
            ->select(DB::raw(" t.* "))     
			->whereRaw("t.status_envio = 'P' ") 
            ->get();  
                       
    }

     public function alterarPendenteEnvioEmailSSaude($id_cobrancaemail,$status)
    {

   //       return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.COBRANCASMS t  ')) 
            // ->update(DB::raw(" t.* ")
            // )  
            //  ->whereRaw("t.status  =  'P' ")           
            // ->get();   

          return    DB::connection('oracleSaude')->table('DBAPS.COBRANCAEMAIL t  ')
            ->where('id_cobrancaemail', $id_cobrancaemail)
            ->update(['status_envio' => "$status"]);              
    }

    public function execPrcEnvioDesligamento()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIODESLIGAMENTO; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }

     public function listEnvioDesligamento()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.ENVIODESLIGAMENTO t  ')) 
            ->select(DB::raw(" t.* "))  
			 ->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
	
	public function alterarPendenteEnvioDesligamento($id_enviodesligamento,$status)
    {


          return    DB::connection('oracleSaude')->table('DBAPS.ENVIODESLIGAMENTO t  ')
            ->where('id_enviodesligamento', $id_enviodesligamento)
            ->update(['status_envio' => "$status"]);              
    }
	
	public function execPrcEnvioInclusao()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIOINCLUSAO; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }

    public function listEnvioInclusao()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.envioinclusao t  ')) 
            ->select(DB::raw(" t.* "))  
             ->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
    
    public function alterarPendenteEnvioInclusao($id,$status)
    {


          return    DB::connection('oracleSaude')->table('DBAPS.ENVIOINCLUSAO t ')
            ->where('id_enviodesligamento', $id)
            ->update(['status_envio' => "$status"]);              
    }

    public function execPrcEnvioTransContrato()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIO_TRANS_CONTRATO; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }

    public function listEnvioTransContrato()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.ENVIOTRANSCONTRATO t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
    
    public function alterarPendenteEnvioTransContrato($id,$status)
    {


          return    DB::connection('oracleSaude')->table('DBAPS.ENVIOTRANSCONTRATO t  ')
            ->where('id_enviodesligamento', $id)
            ->update(['status_envio' => "$status"]);              
    }


    public function execPrcEnvioSegundaVia()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIO_SEGUNDA_VIA; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }

    public function listEnvioSegundaVia()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.ENVIO2VIA t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
    
    public function alterarPendenteEnvioSegundaVia($id,$status)
    {


          return    DB::connection('oracleSaude')->table('DBAPS.ENVIO2VIA t  ')
            ->where('id_enviodesligamento', $id)
            ->update(['status_envio' => "$status"]);              
    }
	
	
	public function execPrcEnvioCorretor()
    {
        $model = new ConexaoOracle();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin DBAPS.PRC_ENVIOCORRETOR; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;
    }

    public function listEnvioCorretor()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.enviocorretor t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
    
    public function alterarPendenteEnvioCorretor($id,$status)
    {


          return    DB::connection('oracleSaude')->table('DBAPS.enviocorretor t  ')
            ->where('id_enviocorretor', $id)
            ->update(['status_envio' => "$status"]);              
    }
	
	public function listaSCS_beneficiaro40dias()
    {

          return   DB::connection('oracleSaude')->table(DB::raw('DBAPS.V_ENVIO_WHATSAPP t  ')) 
            ->select(DB::raw(" t.* "))  
            //->whereRaw("t.status_envio  =  'P' ")  
            ->get();  
                       
    }
	
	public function agendamento_proc1_ExecProc(){
        $model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin dbamv.PRC_TANGRAM_PARMED; end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
        return $curs;      
    }
	
	public function agendamento_proc2_ExecProc(){
		
		$model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
		$curs = oci_new_cursor($this->bd);
		$stmt = oci_parse($this->bd, "begin dbamv.prc_tangram_agend_consult(:cursor_); end;");
		oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
		oci_execute($stmt);
		oci_execute($curs);
		
/*        $model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
        $curs = oci_new_cursor($this->bd);
        $stmt = oci_parse($this->bd, "begin dbamv.prc_tangram_agend_consult(:cursor_); end;");
        //oci_bind_by_name($stmt, "cursor_", $curs, -1, OCI_B_CURSOR);
        $curs = oci_execute($stmt);
        //oci_execute($curs);
  */      return $curs;      
    }
	
	public function agendamentosPendentes()
    {
        return   DB::connection('oracle')->table(DB::raw('dbamv.log_agendamento_consultas t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_status_envio = 'PE' ") 
            ->whereRaw("trunc(t.data_envio) = trunc(sysdate) ")           
            ->get();                 
    }
}
 