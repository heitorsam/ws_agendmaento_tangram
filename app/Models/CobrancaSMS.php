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

    public function getLinkReceiturario($id, $cd_atendimento)
    {
        $whereSQL = "";

        if($id == "-1"){
            return   DB::connection('oracle')->table(DB::raw('dbamv.vdic_prescricoes_mevo t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw('data_finalizacao_presc >= (sysdate-1)')
            ->orderBy('t.cd_atendimento', 'DESC')      
            ->get();    

        }
        
        if ($id != "0"){
            return   DB::connection('oracle')->table(DB::raw('dbamv.vdic_prescricoes_mevo t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.referencia = " . $id)      
            ->get();
        }

        if ($cd_atendimento != "0"){
            return   DB::connection('oracle')->table(DB::raw('dbamv.vdic_prescricoes_mevo t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_atendimento = " . $cd_atendimento)      
            ->get();
        }

        return null;
                         
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
	
	public function agendamento_proc2_ExecProc_v2(){
		
		$model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
		$curs = oci_new_cursor($this->bd);
		$stmt = oci_parse($this->bd, "begin dbamv.prc_tangram_agend_consult_v2(:cursor_); end;");
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

    public function agendamento_no_show($i){

		$model = new ConexaoSantaCasa();
        $this->bd  = $model->ConnectionBD();
		$stmt = oci_parse($this->bd, "SELECT a.cd_agenda_central, a.cd_it_agenda_central cd_it_marcacao,
                                        a.cd_paciente cd_paciente,
                                        a.nm_paciente nm_paciente,
                                        a.nr_ddd_fone,
                                        a.nr_fone,
                                        a.nr_ddd_celular||
                                        regexp_replace(a.nr_celular , '[^[:digit:]]', null ) nr_telefone ,
                                        a.cd_ser_dis cd_ser_dis,
                                        d.ds_ser_dis ds_ser_dis,
                                        a.hr_agenda,
                                        a.hr_agenda dt_marcacao,
                                        a.hr_agenda dt_agendado,
                                        to_char(a.hr_agenda,'HH24') || 'h'|| to_char(a.hr_agenda,'MI') horario,
                                        b.cd_prestador,
                                        E.nm_prestador,
                                        c.ds_unidade_atendimento ds_undidade
                                    FROM   dbamv.it_agenda_central a,
                                        dbamv.agenda_central b,
                                        dbamv.unidade_atendimento c,
                                        dbamv.ser_dis d,
                                        dbamv.prestador E
                                    WHERE  a.cd_agenda_central = b.cd_agenda_central
                                        AND d.cd_ser_dis = a.cd_ser_dis
                                        AND E.cd_prestador = B.cd_prestador
                                        AND b.cd_unidade_atendimento = c.cd_unidade_atendimento
                                        --AND a.hr_agenda >= sysdate + 0.40
                                        ----  AND a.cd_usuario <> 'INTEGRADOR.AGENDA'   ---  a partir de 15/03/2021 esta mandando whats para todos agendamentos APP +  WEB  + CENTRAL
                                        AND a.cd_it_agenda_pai IS NULL
                                        --AND a.sn_atendido <> 'S'
                                        AND (A.TP_SITUACAO IS NULL  OR  A.TP_SITUACAO <> 'C') ---- NAO PEGA horario em vermelho  cancelado
                                        AND a.cd_item_agendamento <> 1001 --- NAO PEGA AGENDA CLINICA DOLZANI.
                                        AND B.cd_prestador <> 3229 --- NAO PEGA TRANSPLANTE CLINICA CENTRO
                                        AND A.cd_ser_dis <> 130 ---   NAO PEGA NUTRI TRANSPLANTE
                                        AND to_date(a.hr_agenda,'DD/MM/YYYY')= to_date(sysdate-:i,'DD/MM/YYYY')
                                        AND A.SN_BLOQUEADO <> 'S'   --- Não pega agenda bloqueada
                                        AND a.nr_celular is not null
                                        AND a.cd_paciente not in (45445)
                                        and a.cd_atendimento is null");
		oci_bind_by_name($stmt, ":i", $i);
		oci_execute($stmt);

        $result = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $result[] = array_map(function($value) {
                return is_string($value) ? mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1') : $value;
            }, $row);
        }
        return $result;
    }

	public function agendamentosPendentes()
    {
        return   DB::connection('oracle')->table(DB::raw('dbamv.log_agendamento_consultas t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_status_envio = 'PE' ") 
            ->whereRaw("trunc(t.data_envio) = trunc(sysdate) ")           
            ->get();                 
    }
	
	public function agendamentosPendentes_v2()
    {
        return   DB::connection('oracle')->table(DB::raw('dbamv.log_agendamento_consultas_v2 t  ')) 
            ->select(DB::raw(" t.* "))  
            ->whereRaw("t.cd_status_envio = 'PE' ") 
            ->whereRaw("trunc(t.data_envio) >= trunc(sysdate) ")           
            ->get();                 
    }
}
 