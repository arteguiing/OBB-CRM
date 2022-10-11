<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Company as Companies;

class Company extends Controller
{
    public function getCompany(Request $request){

       $company_id =$request->company_id;
       
       $company = Companies::where('id', $company_id)->first();

        return $company;

    }
}
