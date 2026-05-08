<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cirurgia; 
use DB;

class CirurgiaController extends Controller
{
    private $cirurgia;

    public function __construct(Cirurgia $cirurgia) 
    {
        $this->cirurgia = $cirurgia;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cirurgia = $this->cirurgia->where('NR_CPF','22269283830')->first();

        return response()->json($cirurgia);
    }

    public function searchCpf(Request $request)
    {
        $cpf = $request->cpf;

         $cirurgia = $this->cirurgia->where('NR_CPF', $cpf)->first();

        return response()->json($cirurgia);
    }

    public function searchRg(Request $request)
    {
        $rg = $request->rg;
        $cirurgia = $this->cirurgia->where('NR_IDENTIDADE', $rg)->first();
        return response()->json($cirurgia);
    }


    public function searchMae(Request $request)
    {

        // dd($request->mae);

        $mae =  $request->mae;

        $cirurgia =  $this->cirurgia->searchMae($mae);

        return response()->json($cirurgia);


    }


    public function searchCDPaciente(Request $request)
    {
        $cd_paciente = $request->cd_paciente;
        $cirurgia = $this->cirurgia->where('CD_PACIENTE', $cd_paciente)->first();
        return response()->json($cirurgia);
    }


    public function searchCID(Request $request)
    {

        // dd($request->cid);

        $cid =  $request->cid;

        $cid =  $this->cirurgia->searchCID($cid);

        return response()->json($cid);


    }

    public function searchConvenio(Request $request)
    {
        // dd($request->convenio);
        $convenio =  $request->convenio;

        $convenio =  $this->cirurgia->searchConvenio($convenio);

        return response()->json($convenio);
    }

    public function searchTUSS(Request $request)
    {

        $tuss =  $request->tuss;

        $tuss =  $this->cirurgia->searchTUSS($tuss);

        return response()->json($tuss);
    }

    public function searchOPME(Request $request)
    {

        $opme =  $request->opme;

        $opme =  $this->cirurgia->searchOPME($opme);

        return response()->json($opme);
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
