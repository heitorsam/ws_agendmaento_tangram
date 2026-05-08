<?php



//$this->resource('products', 'Api\V1\ProductController', ['except'=>'create','edit']); 

$this->group(['prefix'=>'v1'], function(){

	$this->post('auth','Auth\AuthApiController@authenticate');
	$this->post('auth-refresh','Auth\AuthApiController@refreshToken');

	// $this->get('cirurgias/paciente/{cpf}', 'Api\v1\CirurgiaController@searchCpf');

	///// TRANGRAM SANTA CASA SAUDE //////
	Route::get('tangran/scih', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@pesquisaTrangramSCIH'));

	Route::get('tangran/teste', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@searchSatusPendente'));

	///// TRANGRAM SANTA CASA SAUDE //////
	Route::get('tangran/cobrancasms', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@index'));

	Route::get('tangran/cobrancasms/{id_cobrancasms}/status/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendente'));

	Route::get('tangran/panico', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@panico'));

	Route::get('tangran/lista_agendamento', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@lista_agendamento'));
	 
	Route::get('tangran/lista_agendamento_v2', array('middleware' => 'cors',
	'uses' => 'Api\v1\TangranController@lista_agendamento_v2'));

	Route::get('tangran/panico_alterar/cod_log/{cod_log}/cod_status_envio/{cod_status_envio}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendentePanico'));

	Route::get('tangran/panico_resposta/cod_log/{cod_log}/dt_hr_resposta_panico/{dt_hr_resposta_panico}/resposta_panico/{resposta_panico}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarRespostaPanico'));

	Route::get('tangran/integracao', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@integracao'));

	Route::get('tangran/envioEmailSSaude', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioEmailSSaude'));

	Route::get('tangran/envioDesligamentoSSaude', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioDesligamento'));

    Route::get('tangran/alterarPendenteEnvioEmailSSaude/{id_cobrancaemail}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioEmailSSaude'));
	
	Route::get('tangran/alterarPendenteEnvioDesligamento/{id_enviodesligamento}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioDesligamento'));
	 
	 Route::get('tangran/envioInclusaoSSaude', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioInclusao'));

	Route::get('tangran/alterarPendenteEnvioInclusao/{id}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioInclusao'));
	 
		 Route::get('tangran/envioTransContrato', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioTransContrato'));

	Route::get('tangran/alterarPendenteEnvioTransContrato/{id}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioTransContrato'));

	 Route::get('tangran/envioSegundaVia', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioSegundaVia'));

	Route::get('tangran/alterarPendenteEnvioSegundaVia/{id}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioSegundaVia')); 
	 
	Route::get('tangran/envioCorretor', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@envioCorretor'));

	Route::get('tangran/alterarPendenteEnvioCorretor/{id}/{status}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteEnvioCorretor'));
	 
	Route::get('tangran/SCS_beneficiaro40dias', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@SCS_beneficiaro40dias'));
	 
	Route::get('tangran/aprovacaoAntibioticoIAMSPE', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@aprovacaoAntibioticoIAMSPE'));
	
	Route::get('tangran/alterarPendenteAprovacaoAntibioticoIAMSPE/cod_log/{cod_log}/cod_status_envio/{cod_status_envio}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@alterarPendenteAprovacaoAntibioticoIAMSPE'));
	 
	Route::get('tangran/getEnvioWhatsappBoasVindas', array('middleware' => 'cors',
	 'uses' => 'Api\v1\TangranController@getEnvioWhatsappBoasVindas'));


	///// TRANGRAM SANTA CASA SAUDE //////

	///// TOTEN IMPRESSAO RECEITA MEVO ////
	Route::get('tangran/TotemLinkReceiturario/{id}', array('middleware' => 'cors',
	'uses' => 'Api\v1\TangranController@getLinkReceiturario'));

	///// TOTEN IMPRESSAO RECEITA MEVO ////
	Route::get('tangran/TotemLinkReceiturario/{id}/{cd_atendimento}', array('middleware' => 'cors',
	'uses' => 'Api\v1\TangranController@getLinkReceiturario'));

	/// SOLICITACAO DE  CIRURGIAS //////

	Route::get('cirurgias/opme/{opme}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchOPME'));

	Route::get('cirurgias/tuss/{tuss}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchTUSS'));

	Route::get('cirurgias/convenio/{convenio}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchConvenio'));

	Route::get('cirurgias/cid/{cid}', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchCID'));

	Route::get('cirurgias/paciente/{cpf}/cpf', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchCpf'));

	Route::get('cirurgias/paciente/{rg}/rg', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchRg'));

	Route::get('cirurgias/paciente/{mae}/mae', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchMae'));

	Route::get('cirurgias/paciente/{cd_paciente}/cd_paciente', array('middleware' => 'cors',
	 'uses' => 'Api\v1\CirurgiaController@searchCDPaciente'));
	/// SOLICITACAO DE  CIRURGIAS //////

	

	

	 

	// Route::resource('cirurgias', 'Api\v1\CirurgiaController');

	// para autenticar
	$this->group(['middleware'=>'jwt.auth'], function(){
		
		Route::resource('oracle', 'Oracle\OracleController');
		
		Route::resource('vendas', 'Api\v1\VendasController');
		
		$this->get('products/search', 'Api\V1\ProductController@search'); 
		//$this->resource('products', 'Api\V1\ProductController', ['except'=>'create','edit']); 
		$this->resource('products', 'Api\V1\ProductOracleController', ['except'=>'create','edit']); 
	});

});
