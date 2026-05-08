<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description'];  

    public function rules($id='') 
    {
    	return 
    	[
    		'name' => "required|unique:products,name,{$id},id",
    		'description' => "required"

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
}
