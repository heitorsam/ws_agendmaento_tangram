<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CobrancaSMS; 
use App\Models\Oracle; 
use App\Models\pesquisaTrangramSCIH;
use DB;

class TangranController extends Controller
{

    private $cobrancasms, $oracle;

    public function __construct(CobrancaSMS $cobrancasms , Oracle $oracle, pesquisaTrangramSCIH $pesquisaTrangramSCIH) 
    {
        $this->cobrancasms = $cobrancasms;
         $this->oracle = $oracle;
          $this->pesquisaTrangramSCIH = $pesquisaTrangramSCIH;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $this->cobrancasms->execProc();        
       $cobrancasms = $this->cobrancasms
                           ->searchSatusPendente();
      //dd($cobrancasms); nao pode usar dd no postamn
       return response()->json($cobrancasms);
    }

 
    public function searchSatusPendente()
    {      
       $cobrancasms = $this->cobrancasms
                           ->searchSatusPendente();
        return response()->json($cobrancasms);
    }

	public function getEnvioWhatsappBoasVindas()
    {      
       $cobrancasms = $this->cobrancasms
                           ->getEnvioWhatsappBoasVindas();
        return response()->json($cobrancasms);
    }
	
    public function pesquisaTrangramSCIH(){        
       $scih = $this->pesquisaTrangramSCIH
                           ->pesquisaTrangramSCIH();
        return response()->json($scih);
    }

    public function alterarPendente(Request $request)
    {
        $id_cobrancasms = $request->id_cobrancasms;
        $status = $request->status;
        $this->cobrancasms
                ->alterarPendente($id_cobrancasms,$status);
        return response()->json(["result" => "ok"]);
    }

    public function panico(){        
       $this->cobrancasms->panicoExecProc();
       $panicoPendentes =  $this->cobrancasms
                                ->panicoPendentes();
        return response()->json($panicoPendentes);
    }

    public function alterarPendentePanico($cd_log, $cod_status_envio)
    {
        $this->cobrancasms
                ->alterarPendentePanico($cd_log, $cod_status_envio);
        return response()->json(["result" => "ok"]);
    }
	
	public function lista_agendamento(){  
	
       $this->cobrancasms->agendamento_proc1_ExecProc();
	   $this->cobrancasms->agendamento_proc2_ExecProc();
       $agendamentoPendentes =  $this->cobrancasms
                                ->agendamentosPendentes();
        return response()->json($agendamentoPendentes);
    }
	
	public function aprovacaoAntibioticoIAMSPE(){        
       $this->cobrancasms->aprovacaoAntibioticoIAMSPEExecProc();
       $aprovacaoAntibioticoIAMSPEPendentes =  $this->cobrancasms
                                ->aprovacaoAntibioticoIAMSPEPendentes();
        return response()->json($aprovacaoAntibioticoIAMSPEPendentes);
    }

    public function alterarPendenteAprovacaoAntibioticoIAMSPE($cd_log, $cod_status_envio)
    {
        $this->cobrancasms
                ->alterarPendenteAprovacaoAntibioticoIAMSPE($cd_log, $cod_status_envio);
        return response()->json(["result" => "ok"]);
    }
	
	

    public function alterarRespostaPanico($cd_log,$dt_hr_resposta_panico, $resposta_panico)
    {

        $dt_hr_resposta_panico = str_replace("-","/", $dt_hr_resposta_panico);
       // $dt_hr_resposta_panico = date("d/m/Y H:i:s", strtotime($dt_hr_resposta_panico));
        $this->cobrancasms
                ->alterarRespostaPanico($cd_log,$dt_hr_resposta_panico, $resposta_panico);
        return response()->json(["result" => "ok"]);
    }

    public function integracao(){        
       
       $integracao =  $this->cobrancasms
                                ->integracao();
        return response()->json($integracao);
    }


    public function envioEmailSSaude(){ 

         $this->cobrancasms
                    ->execProcPrcEnvioEmailSSaude();       
       
       $list =  $this->cobrancasms
                    ->listEnvioEmailSSaude();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioEmailSSaude($id_cobrancaemail, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioEmailSSaude($id_cobrancaemail, $status);
        return response()->json(["result" => "ok"]);
    }

    public function envioDesligamento(){ 

       

         $this->cobrancasms
                    ->execPrcEnvioDesligamento();       
       
       $list =  $this->cobrancasms
                    ->listEnvioDesligamento();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioDesligamento($id_enviodesligamento, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioDesligamento($id_enviodesligamento, $status);
        return response()->json(["result" => "ok"]);
    }
	
    public function envioInclusao(){ 

       

         $this->cobrancasms
                    ->execPrcEnvioInclusao();       
       
       $list =  $this->cobrancasms
                    ->listEnvioInclusao();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioInclusao($id, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioInclusao($id, $status);
        return response()->json(["result" => "ok"]);
    }

    public function envioTransContrato(){ 

       

         $this->cobrancasms
                    ->execPrcEnvioTransContrato();       
       
       $list =  $this->cobrancasms
                    ->listEnvioTransContrato();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioTransContrato($id, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioTransContrato($id, $status);
        return response()->json(["result" => "ok"]);
    }


    public function envioSegundaVia(){ 

       

         $this->cobrancasms
                    ->execPrcEnvioSegundaVia();       
       
       $list =  $this->cobrancasms
                    ->listEnvioSegundaVia();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioSegundaVia($id, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioSegundaVia($id, $status);
        return response()->json(["result" => "ok"]);
    }

    public function envioCorretor(){ 

       

         $this->cobrancasms
                    ->execPrcEnvioCorretor();       
       
       $list =  $this->cobrancasms
                    ->listEnvioCorretor();
       
        return response()->json($list);
    }
	
	public function SCS_beneficiaro40dias(){ 

       
        $list =  $this->cobrancasms
                    ->listaSCS_beneficiaro40dias();
       
        return response()->json($list);
    }

    public function alterarPendenteEnvioCorretor($id, $status)
    {
        $this->cobrancasms
                ->alterarPendenteEnvioCorretor($id, $status);
        return response()->json(["result" => "ok"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
