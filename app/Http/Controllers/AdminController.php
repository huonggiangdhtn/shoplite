<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $pagesize;
    public function __construct( )
    {
        $this->pagesize = env('NUMBER_PER_PAGE','20');
        $this->middleware('auth');
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = \Auth::user();
        // dd($request->get('current_password'));
            // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return back()->with('error', "Current Password is Invalid");
        }
 
        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
     public function admin()
     {
          
          $func = "admin_view";
          if(!$this->check_function($func))
          {
              return redirect()->route('home');
          }
          $data['breadcrumb'] = '
          <li class="breadcrumb-item"><a href="#">/</a></li>
          <li class="breadcrumb-item active" aria-current="page"> Bảng điều khiển</li>';
          $data['active_menu']="dashboard";
          $month = date('m');
          $year = date('Y');
          $day = date('d');
          $lastmonth = $month - 1;
          $lastyear = $year;
          if($lastmonth <= 0)
          {
                    $lastmonth = 12;
                    $lastyear = $year - 1;
          }
         
          $sql1 = "select count(id) as tong from blogs where status = 'active'  ";
          $data['sobai'] = \DB::select($sql1)[0]->tong;
          $sql2 = "select count(id) as tong from orders where status = 'active'  ";
          $data['sodon'] = \DB::select($sql2)[0]->tong;
          $sql3 = "select sum(final_amount) as tong from orders where status = 'active'  ";
          $data['tongdon'] = \DB::select($sql3)[0]->tong;

          $data['hotproducts']=\DB::select('select * from products order by hit desc limit 10');
          $data['logs'] = \App\Models\Log::orderBy('id','desc')->limit(20)->get();
          return view ('backend.index',   $data);
     }
  
}
