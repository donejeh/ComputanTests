<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ApiData;
use App\Models\UserData;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Imports\UsersDataExport;
use App\Imports\UsersDataImport;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = UserData::paginate(100);

        return view('home', compact('users'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersDataExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        $this->validate(request(), [
            "file" => "required|mimes:csv,xlsx,xls"
        ]);

        try {
            Excel::import(new UsersDataImport, request()->file('file'));
            return back()->with('success', 'data imported successfully into database');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error importing file');
        }
    }

    /**
     * fetchDataFromAPI
     *
     * @return void
     */
    public function fetchDataFromAPI()
    {

        //api call into publicapis
        $response = Http::get('https://api.publicapis.org/entries');

        $jsonData = $response->json();

        if ($response->successful() && $response->ok()) {

            foreach ($jsonData['entries'] as $key => $row) {

                ApiData::updateOrCreate([
                    'API'     => $row['API'],
                    'Description'    => $row['Description'],
                    'Auth'    => $row['Auth'],
                    'HTTPS'   => $row['HTTPS'],
                    'Cors'   => $row['Cors'],
                    'Link'   => $row['Link'],
                    'Category'   => $row['Category'],
                ]);
            }

            return back()->with('success_viewFetch', 'fetch data inserted into database successfully');
        } else {
            return back()->with('error', 'Error occurs fetching data');
        }
    }
    
    /**
     * viewFetch
     *
     * @return void
     */
    public function viewFetch()
    {
        $rows = ApiData::paginate(100);

        return view('view_fetch', compact('rows'));
    }


        
    /**
     * sendActiveUsersEmail
     *
     * @return void
     */
    public function sendActiveUsersEmail(){

        $users = User::where("is_active",1)->get();

    foreach ($users as $user) { 
        $details['email'] = $user->email;
        $details['name'] = $user->name;
        $details['username'] = $user->name;
        dispatch(new SendEmailJob($details));
    }

    return back()->with(['success'=> 'Done sending']);

    }

   // list of emp that salary match with any other emp

   employee::max('salary')->groupBy('salary')->get();

    //User::with(['ADDRESSES','DEPTS'])->where('')
}
