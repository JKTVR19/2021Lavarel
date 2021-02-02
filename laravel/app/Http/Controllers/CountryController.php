<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('Code', 'asc')->latest()->paginate(8);
        return view('countries.listCountry', compact('countries'))->with('i', (request()->input('page', 1) - 1) * 8);
        //
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
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $country = Country::where('code', $code) ->first();
        return view('countries.show', compact('country'));
        //
    }

//-------------------------------------------------------------------------------------------
    public function search(Request $request)
    {
        //Get the search value form from requst
        $search = $request->input('search');

            //Search in the Name and Continent columna from country table
        $countries = Country::query()
            ->where('Name', 'LIKE', "%{$search}%")
            ->orWhere('Continent', 'LIKE', "%{$search}%")
            ->get();

            //Return the search view with the results compacted
        return view('countries.searchCountry', compact('countries'));
    }
    //-------------------------------------------------------------
    public function listContinent()
    {
        //список контитнентов
        $continents=Country::distinct()->get('continent');
        return view('countries.countryContinent', compact('continents'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }
//--------------------------filterCountry form
    public function filterCountry()
    {
        //list continents all
        $continents=Country::distinct()->get('continent');
        //list GovernmentForm all
        $governments=Country::distinct()->get('GovernmentForm');
        //list countries all
        $countries=Country::orderBy('Code', 'asc')->get();
        //IndepYear - min
        $numberMin=Country::query()
        ->whereNotNull('IndepYear')
        ->orderBy('IndepYear', 'asc')->first();
        //IndepYear - min
        $numberMax=Country::orderBy('IndepYear','desc')->first();

        return view('countries.countryFilter', compact('continents', 'governments','countries', 'numberMin', 'numberMax'));
    }
//--------Метод в контроллере - вывод данных после обработки формы фильтрации
    public function filterShow(Request $request)
    {
        //              read data from form
        $continent = $request->input('continent');
        $government = $request->input('government');
        $numberFrom= $request->input('numberFrom');
        $numberTo = $request->input('numberTo');
        //              requsts: all values from the for are passed
        $countries = Country::query()
        ->where('Continent', 'LIKE', "%{$continent}%")
        ->where('GovernmentForm', 'LIKE', "%{$government}%")
        ->where('IndepYear', '>=', "{$numberFrom}")
        ->where('IndepYear', '<=', "{$numberTo}")
        ->get();
        //              requsts: not passed values $numberFrom='' $numberTo=''
        if ($numberFrom=='' && $numberTo=='') {
            $countries = Country::query()
            ->where('Continent', 'LIKE', "%{$continent}%")
            ->where('GovernmentForm', 'LIKE', "%{$government}%")
            ->get();
        }
        elseif ($numberFrom=='') {//--------$numberFrom='' $numberTo='
             $countries = Country::query()
            ->where('Continent', 'LIKE', "%{$continent}%")
            ->where('GovernmentForm', 'LIKE', "%{$government}%")
            ->where('IndepYear', '<=', "{$numberTo}")
            ->get();
    }
        elseif ($numberTo=='') {//--------$numberFrom='' $numberTo='
             $countries = Country::query()
            ->where('Continent', 'LIKE', "%{$continent}%")
            ->where('GovernmentForm', 'LIKE', "%{$government}%")
            ->where('IndepYear', '>=', "{$numberFrom}")
            ->get();
    }
    //-----requstes for filing filter forms
                // list of all continents
       $continents=Country::distinct()->get('continent');
               // list of all continents
       $governments=Country::distinct()->get('GovernmentForm');
                //----min IndepYear\
        $numberMin=Country::query()
        ->whereNotNull('IndepYear')
        ->orderBy('IndepYear', 'asc')->first();
                 //----max IndepYear
        $numberMax=Country::orderBy('IndepYear', 'desc')->first();
        //-----------end query
        return view('countries.countryFilter', compact('continents', 'governments', 'countries', 'numberMin', 'numberMax'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
     
}
