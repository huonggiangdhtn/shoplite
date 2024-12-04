<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UGroup;
use App\Models\User;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $pagesize;
    public function __construct( )
    {
        $this->pagesize = env('NUMBER_PER_PAGE','20');
        $this->middleware('auth');
    }
    public function index()
    {
        $func = "order_list";
        if(!$this->check_function($func))
        {
            return redirect()->route('unauthorized');
        }
        //
        $active_menu="or_list";
        $breadcrumb = '
        <li class="breadcrumb-item"><a href="#">/</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Danh sách đặt hàng </li>';
        $orders=Order::orderBy('id','DESC')->paginate($this->pagesize);
        return view('backend.orders.index',compact('orders','breadcrumb','active_menu'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
      
        ///create SupTransaction
        
       ///create ship invocie ///////////
        
       ///create log /////////////
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $func = "order_list";
        if(!$this->check_function($func))
        {
            return redirect()->route('unauthorized');
        }
        //
        $order = order::find($id);
        if($order)
        {
            $active_menu="or_list";
            $breadcrumb = '
            <li class="breadcrumb-item"><a href="#">/</a></li>
            <li class="breadcrumb-item  " aria-current="page"><a href="'.route('order.index').'">DS đặt hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Xem chi tiết</li>';
            $wo_details = OrderDetail::where('wo_id',$id)->get();
            return view('backend.orders.show',compact('breadcrumb','order','active_menu','wo_details'));
        }
        else
        {
            return back()->with('error','Không tìm thấy dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $func = "order_edit";
        if(!$this->check_function($func))
        {
            return redirect()->route('unauthorized');
        }
        //
        $order = order::find($id);
        if($order)
        {
            $order->status = 'done';
            $order->save();
            return redirect()->route('order.index')->with('success','Cập nhật thành công');
        }
        else
        {
            return back()->with('error','Không tìm thấy dữ liệu');
        }
    }
    public function getProductList(Request $request)
    {
        $this->validate($request,[
            'wo_id'=>'numeric|required',
        ]);
        $wo = Order::find($request->wo_id);
        $query = "(select id,photo, type,title from products ) as p";
        $query1 = "(select product_id ,quantity from inventories where wh_id = ".$wo->wh_id.") as np";
               
        $products = DB::table('order_details')
        ->select ('order_details.price','order_details.product_id','order_details.quantity', 'p.title','p.photo','p.id','p.type','np.quantity as stock_qty')
        ->where('wo_id',$request->wo_id)
        ->leftJoin(DB::raw($query),'order_details.product_id','=','p.id')
        ->leftJoin(DB::raw($query1),'order_details.product_id','=','np.product_id')
        ->orderBy('id','ASC')->get();
        foreach($products as $product)
        {
            $query = "select b.*,c.id as idg, c.title from (select id, price, ugroup_id from group_prices where product_id = ".$product->id
            ." ) as b left join (select id,title from u_groups) as c on b.ugroup_id = c.id  order by c.id ASC";
            $prices = DB::select($query) ;
      
            $product->groupprice=$prices;
        }
        return response()->json(['msg'=>$products,'status'=>true]);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
          
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $func = "order_delete";
        if(!$this->check_function($func))
        {
            return redirect()->route('unauthorized');
        }
        //
        $oldorder = Order::find($id);
        if(  $oldorder==null)
            return response()->json(['msg'=>'không tìm thấy!','status'=>false]);
        $user = auth()->user();
        //check detail product are exported
        $detailpros = orderDetail::where('wo_id',$oldorder->id)->get();
        
        //delete all old product detail
        
        foreach($detailpros as $dtpro)
        {
          $dtpro->delete();
        }
        $oldorder->delete();
        ///delete sup trans 1 for importing
       return redirect()->route('order.index')->with('success','Xóa thành công!'); 
    }
    
}
