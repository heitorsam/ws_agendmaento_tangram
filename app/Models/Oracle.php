<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Oracle extends Model
{
 protected $connection = 'oracle';
 protected $table = 'products';
 //protected $fillable = ['NAME','DESCRIPTION'];  





    public function rules($id='') 
    {
    	return 
    	[
    		'NAME' => "required|unique:PRODUCTS,NAME,{$id},ID",
    		'DESCRIPTION' => "required"

    	];

    }

     public function rulesSearch() 
    {
    	return 
    	[
    		'key-search' => "required",
    		 

    	];

    }

    public function search($data)
    {

    	return  $products = $this->where('name', $data['key-search'])
                        ->orWhere('description', 'like', "%{$data['key-search']}%")
                        ->paginate(5);

    }


           public function products()  
      {

                return   DB::connection('oracle')->table(DB::raw('PRODUCTS t  '))
                     
                    ->select(DB::raw(" t.ID,  t.NAME, t.DESCRIPTION ")
                 )  
          
                  ->get(); 

 
    } 

	         public function clientes()  
      {

      	        return   DB::connection('oracle')->table(DB::raw('clientes t  '))
                     
                    ->select(DB::raw(" t.* ")
                 )  
                   // ->whereRaw("e.id_viagem  =  v.id ")
                   // ->whereRaw("e.id  =  $id ")
                   // ->whereRaw("e.id_embarcacao  =  l.id ")
                   // ->whereRaw("e.id_destino  =  c.id ") 
                   // ->whereRaw("e.id_vendedor  =  u.id ")
                   // ->whereRaw("e.id_pagamento  =  pg.id ")
                //  ->whereRaw("p.id_order  =  o.id ")
                  //->orderBy(DB::raw('e.payment_method'))             
                  ->get(); 

				// 	$con = oci_connect('system', 'Dw67y443014$', 'ora11');	
				// 		if( !$con  )
				// 		{
				// 			echo( "Erro ao conectar com o banco de dados." );
				// 			exit;
				// 		}
					
				// $c = oci_connect ("system", "Dw67y443014$",'ora11'); 
				// $s = oci_parse ($c, 'select * from clientes'); 
				// oci_execute ($s); 
				// return $res = oci_fetch_array ($s, OCI_ASSOC);
				// while ($res = oci_fetch_array ($s, OCI_ASSOC)) { 
				// var_dump ($res); 
				// }

//  $sql = "select * from clientes";		


//    $s = oci_parse($this->con, $sql);	
//    oci_execute ($s); 

//    while ($res = oci_fetch_array ($s, OCI_ASSOC)) { 
// var_dump ($res); 
// }
		} 
               
//         return   DB::connection('oracle')->table(DB::raw('clientes t  '))
                     
//                     ->select(DB::raw(" t.* ")
//                  )  
//                    // ->whereRaw("e.id_viagem  =  v.id ")
//                    // ->whereRaw("e.id  =  $id ")
//                    // ->whereRaw("e.id_embarcacao  =  l.id ")
//                    // ->whereRaw("e.id_destino  =  c.id ") 
//                    // ->whereRaw("e.id_vendedor  =  u.id ")
//                    // ->whereRaw("e.id_pagamento  =  pg.id ")
//                 //  ->whereRaw("p.id_order  =  o.id ")
//                   //->orderBy(DB::raw('e.payment_method'))             
//                   ->get(); 
//       }


 
}
