<?php

namespace App\Http\Controllers;

use App\Model_Companies;
use App\Model_Employees;
use Companies;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use App\Imports\EmployeesImport;

use Illuminate\Support\Facades\Config;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use App\Timezone;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
     // Home
     public function getHome(){
        $timezone = \App\Timezone::all();
        return view('content.home', ['timezone' =>$timezone]);
    }
    // show data
    public function getCompany(Request $request){
        $company = DB::table('companies')->orderBy('created_at', 'desc')->get();
        return view('content.home', ['company' => $company, ]);
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
    public function uploadCompany(Request $request){
        // dd(Session::get('jwt_token'));
        // dd($request->user());
        // dd(request('query'));

        $paged= $request->paged;
        $company = Model_Companies::orderBy('created_at', 'desc')->filter(request('query'))->paginate($paged)->withQueryString();
        
        $user = \App\User::all();
        return view('content.home', compact('company','user','paged'));
    }
    public function proses_upload_company(Request $request){
        // $timezone = Session::get('timezone');
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,svg,jpg|',
            'logo' => 'dimensions:min_width=100,min_height=100',
            'website' => 'required',
            
        ]);

        $file = $request->file('logo');
        $nama_file = $file->getClientOriginalName();
        $tujuan_upload = 'img_company';
        $file->move($tujuan_upload, $nama_file);
        
        $company = new \App\Model_Companies;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $nama_file;
        $company->website = $request->website;
        $company->created_by_id = Auth::user()->id;
        $company->updated_by_id = Auth::user()->id;
        $company->save();
        $job = (new SendEmailJob())->delay(Carbon::now()->addSecond(5));
        dispatch($job);
        //  php artisan queue:work to start job
        // Config::set('app.timezone', 'UTC');

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
                'website' => 'required',
            ]);
            
            $file = $request->file('logo');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'img_company';
            $file->move($tujuan_upload, $nama_file);
            $user = Auth::user()->id;

            Model_Companies::where(['id'=>$id])
            ->update([
                'name'=>$company['name'], 
                'email'=>$company['email'], 
                'logo'=>$nama_file, 
                'website'=>$company['website'],
                'updated_by_id'=>$user
            ]);
            return redirect()->back()->with('success', 'Data berhasil diubah!');
        }
    }
   
    // employe
    public function getEmploye(){
        $employe = DB::table('employees')->orderBy('created_at','desc')->get();
        return view('content.employe', compact('employe'));
    }
    public function employe(){
        $employe = DB::table('employees')->orderBy('created_at','desc')->get();
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
    public function uploadEmploye(Request $request){
        $paged = $request->paged;
        $employe = Model_Employees::orderBy('created_at', 'desc')->filter(request('query'))->paginate($paged)->withQueryString();
        $company = \App\Model_Companies::all();
        return view('content.employe',compact('employe','company','paged'));
    }
    public function proses_upload_employe(Request $request){
        // dd($request->all());
        $timezone = Session::get('timezone');
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $employe = new \App\Model_Employees;
        $employe->first_name = $request->first_name;
        $employe->last_name = $request->last_name;
        $employe->email = $request->email;
        $employe->company_id = $request->company;
        $employe->phone = $request->phone;
        $employe->password = bcrypt($request->password);
        $employe->created_by_id = Auth::user()->id;
        $employe->updated_by_id = Auth::user()->id;
        $employe->save();
 
        Config::set('app.timezone', 'UTC');
        return redirect()->back()->with('success','Data berhasil di input!');
    }
    public function hapus_employe($id){
        Model_Employees::where('id',$id)->delete();
        return redirect()->back()->with('success','Data telah dihapus!');
    }
    public function editEmploye(Request $request, $id){
        if($request->isMethod('post')){
            $employe = $request->all();
            $user = Auth::user()->id;
            // $pw = bcrypt($request->password);
            Model_Employees::where(['id'=>$id])
            ->update([
                'first_name'=>$employe['first_name'], 
                'last_name'=>$employe['last_name'],
                'company_id'=>$employe['company'],
                'email'=>$employe['email'], 
                'phone'=>$employe['phone'], 
                'password'=>bcrypt($employe['password']),
                'updated_by_id'=>$user
            ]);
            return redirect()->back();
        }
    }
    
    //  mail
    public function mail()
    {
        return view('email');
    }
}
