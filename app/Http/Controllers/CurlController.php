<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use validator;


class CurlController extends Controller
{
    public function index()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://restcountries.eu/rest/v2/all?fields=region;");

        curl_setopt($ch, CURLOPT_POST, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $r=json_decode($result);

        $array = array_values( array_unique( $r, SORT_REGULAR ) );

        return view('curl',compact('array'));
    }

    public function getdata(Request $request){
        $region=$request->region;

        $url="https://restcountries.eu/rest/v2/region/$region";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result1 = curl_exec($ch);

        curl_close($ch);

        return response()->json($result1);

    }

    public function getdetails(Request $request){
        $country=$request->country;

        $url="https://restcountries.eu/rest/v2/name/$country";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result1 = curl_exec($ch);

        curl_close($ch);

        return response()->json($result1);

    }

}
