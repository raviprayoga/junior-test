<?php

namespace App\Http\Controllers;

use App\Model_Companies;
use App\Model_Employees;
use Companies;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use App\Imports\EmployeesImport;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
     // Home
     public function getHome(){
        return view('content.home');
    }
    // show data
    public function getCompany(){
        // $company = Model_Companies::paginate(10);
        $company = DB::table('companies')->orderBy('created_at', 'desc')->get();
        return view('content.home', ['company' => $company]);
    }
    // export from excel
    public function getCompaniesExport()
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }
    // import from excel
    public function getCompaniesImport(Request $request)
    {
        $file = request()->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('DataCompany', $nama_file);
        Excel::import(new CompaniesImport, public_path('/DataCompany/'.$nama_file));
        
        
        return redirect()->back()->with('success','Data berhasil di input!');
    }
    // add data
    public function uploadCompany(){
        $company = Model_Companies::orderBy('created_at', 'desc')->get();
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
        
        $company = new \App\Model_Companies;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $nama_file;
        $company->save();

        // email with mailtrap
        // Mail::raw('Wellcome ' .$company->name, function ($message) use($company) {
        //     $message->from('admin@admin.com', 'Admin');
        //     $message->to($company->email, $company->name);
        //     $message->subject('Your company has been registered in our system');
        // });
        // Mail::to('raviprayoga@gmail.com')->send(new SendEmail());
        // dispatch(new SendEmailJob());
        $job = (new SendEmailJob())->delay(Carbon::now()->addSecond(5));
        dispatch($job);
        //  php artisan queue:work to start job

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
            return redirect()->back()->with('success', 'Data berhasil diubah!');
        }
    }
    // search company
    public function searchCompany()
    {
        $search_text = $_GET['query'];
        $company = Model_Companies::where('name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('logo', 'LIKE', '%'.$search_text.'%')
        ->orWhere('created_at', 'LIKE', '%'.$search_text.'%')
        ->orWhere('updated_at', 'LIKE', '%'.$search_text.'%')
        ->get(); 
        
        return view('content.home', compact('company'));
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
    public function getEmployeesImport(Request $request)
    {
        $file = request()->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('DataPegawai', $nama_file);
        Excel::import(new EmployeesImport, public_path('/DataPegawai/'.$nama_file));
        return redirect()->back();
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
     // search company
     public function searchEmploye()
     {
         $company = \App\Model_Companies::all();
         $search_text = $_GET['query'];
         $employe = Model_Employees::where('first_name', 'LIKE', '%'.$search_text.'%')
         ->orWhere('last_name', 'LIKE', '%'.$search_text.'%')
         ->orWhere('company_id', 'LIKE', '%'.$search_text.'%')
         ->orWhere('email', 'LIKE', '%'.$search_text.'%')
         ->orWhere('phone', 'LIKE', '%'.$search_text.'%')
         ->orWhere('created_at', 'LIKE', '%'.$search_text.'%')
         ->orWhere('updated_at', 'LIKE', '%'.$search_text.'%')
         ->get(); 
         
         return view('content.employe', compact('employe','company'));
     }
    //  mail
    public function mail()
    {
        return view('email');
    }
}
