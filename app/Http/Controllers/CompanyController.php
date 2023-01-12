<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Company::orderBy('name')->paginate(10);
        return view('company.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        // check logo and upload to storage
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = 'company/'.time().'.'.$logo->getClientOriginalExtension();
            $logo->storeAs('public/',$filename);   
            $data['logo'] = $filename;
        }
        $company = Company::create($data);  
        if($company){
            return redirect()->back()->with('success', 'The company has been successfully create');
        }
        return redirect()->back()->with('fail', 'The company failed to create!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show',compact('company'));
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
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        if(isset($request->logo)){
            if($company->logo){
                Storage::delete($company->logo);
            }
            $base64image = $request->logo;
            @list($type, $file_data) = explode(';', $base64image);
            @list(, $file_data) = explode(',', $file_data); 
            $type = explode(";", explode("/", $base64image)[1])[0];
            $path = 'company/' . time() . '.' . $type;
            Storage::disk('public')->put($path, base64_decode($file_data));
            $company->logo = $path;
        }
        $company->save();
        return json_encode($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company->logo){
            Storage::delete($company->logo);
        }
        $company->delete();
        session()->flash('success', 'Company deleted successfully');
        return back();
    }
}
