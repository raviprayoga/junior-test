<?php

namespace App\Http\Controllers;

use App\Model_Companies;
use App\Model_Employees;
use Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
     // Home
     public function getHome(){
        return view('content.home');
    }
    // show data
    public function getCompany(){
        $company = DB::table('companies')->get();
        return view('content.home', ['company' => $company]);
    }
    // add data
    public function uploadCompany(){
        $company = Model_Companies::get();
        return view('content.home',['company' => $company]);
    }
    public function proses_upload_company(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,svg,jpg|',
            'logo' => 'dimensions:min_width=100,min_height=100',
            
        ]);

        $file = $request->file('logo');
        $nama_file = $file->getClientOriginalName();
        $tujuan_upload = 'img_company';
        $file->move($tujuan_upload, $nama_file);

        // Model_Companies::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'logo' => $nama_file,
        // ]);
        
        $company = new \App\Model_Companies;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $nama_file;
        $company->save();

        // email with mailtrap
        Mail::raw('Wellcome ' .$company->name, function ($message) use($company) {
            $message->from('admin@admin.com', 'Admin');
            $message->to($company->email, $company->name);
            $message->subject('Your company has been registered in our system');
        });
        

        return redirect()->back()->with('success','Data berhasil di input!');
    }
    // delate company
    public function hapus($id){
        Model_Companies::where('id',$id)->delete();
        return redirect()->back()->with('success','Data telah dihapus!');
    }
    // edit company
    public function editCompany(Request $request, $id){
        if($request->isMethod('post')){
            $company = $request->all();
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'logo' => 'required|image|mimes:jpeg,png,svg,jpg|',
                'logo' => 'dimensions:min_width=100,min_height=100',
            ]);
            
            $file = $request->file('logo');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'img_company';
            $file->move($tujuan_upload, $nama_file);

            Model_Companies::where(['id'=>$id])->update(['name'=>$company['name'], 'email'=>$company['email'], 'logo'=>$nama_file]);
            return redirect()->back();
        }
    }

    // employe
    public function getEmploye(){
        return view('content.employe');
    }
    public function employe(){
        $employe = DB::table('employees')->get();
        $company = \App\Model_Companies::all();
        return view('content.employe', ['employe' => $employe, 'company' => $company]);
    }
    public function uploadEmploye(){
        $employe = Model_Employees::get();
        $company = \App\Model_Companies::all();
        return view('content.employe',['employe' => $employe, 'company' => $company]);
    }
    public function proses_upload_employe(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        Model_Employees::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company,
            'phone' =>$request->phone,
        ]);
        return redirect()->back()->with('success','Data berhasil di input!');
    }
    public function hapus_employe($id){
        Model_Employees::where('id',$id)->delete();
        return redirect()->back()->with('success','Data telah dihapus!');
    }
    public function editEmploye(Request $request, $id){
        if($request->isMethod('post')){
            $employe = $request->all();
            Model_Employees::where(['id'=>$id])->update(['first_name'=>$employe['first_name'], 'last_name'=>$employe['last_name'],'company_id'=>$employe['company'],'email'=>$employe['email'], 'phone'=>$employe['phone']]);
            return redirect()->back();
        }
    }
}
