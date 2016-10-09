<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',function() {
	$people = \App\Client::all();
	foreach($people as $person){
		$person->sex = ( substr_compare($person['name'], 'a', -1, 1, true)===0?"Kobieta":"Mężczyzna");
		$person->city = $person->city()->first();
		$year = DateTime::createFromFormat('Y-m-d', $person->birthdate);
		$cy = new DateTime();
		$person->age = $cy->diff($year)->format('%y');
		$person->branch = $person->branch()->first();
		$person->company = $person->branch->company()->first();
	}
    return view('users', compact('people'));
});

Route::post('/', function(Request $request){
	if($request->action == "new"){
		\App\Client::create( $request->client );
	}
	else if($request->action == "edit"){
		$client = \App\Client::where('id', $request->id);
		$client->update($request->client);
	}
	else if($request->action == "delete"){
		\App\Client::where('id', $request->id)->delete();
	}
	
	$people = \App\Client::all();
	foreach($people as $person){
		$person->sex = ( substr_compare($person['name'], 'a', -1, 1, true)===0?"Kobieta":"Mężczyzna");
		$person->city = $person->city()->first();
		$year = DateTime::createFromFormat('Y-m-d', $person->birthdate);
		$cy = new DateTime();
		$person->age = $cy->diff($year)->format('%y');
		$person->branch = $person->branch()->first();
		$person->company = $person->branch->company()->first();
	}
	return view('users', compact('people'));
});

Route::get('new', function(){
	$cities = \App\City::all();
	$companies = \App\Company::all();
	foreach($companies as $company){
		$company->branches = $company->branches()->get();
	}
	$action="new";
	$person = (object) array(
		'name' => '',
		'surname' => '',
		'birthdate' => date('Y-m-d'),
		'branch' => '1',
		'city' => '1',
		'company' => '1'
	);
	return view('edit', compact('action','cities', 'companies','person'));
});

Route::get('edit/{id}',function($id) {
	$cities = \App\City::all();
	$companies = \App\Company::all();
	foreach($companies as $company){
		$company->branches = $company->branches()->get();
	}
	$action="edit";
	$person = \App\Client::where('id', $id)->first();
	$person->company = $person->branch()->first()->company()->first()->id;
    return view('edit', compact('action', 'cities', 'companies', 'person'));
});