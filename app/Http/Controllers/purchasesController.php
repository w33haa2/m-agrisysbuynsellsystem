<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Commodity;
use App\Customer;
use App\ca;
use App\Purchases;
class purchasesController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $commodity = Commodity::all();
        $customer = Customer::all();
        $ca = ca::all();

        return view('main.purchases')->with(compact('commodity','customer','ca'));
    }

    function findAmount(Request $request){
         $id = $request->input('id');
         $ca = ca::where('customer_id', '=', $id)
               ->orderBy('updated_at', true)
               ->first();
         $customer = customer::where('id', '=', $id)
               ->first();

        $output = array(
               'amount' => $ca->amount,
               'balance' => $ca->balance,
               'suki_type'=> $customer->suki_type,
           );

         echo json_encode($output);
    }

    function findcomm(Request $request){
         $id = $request->input('id');

         $commodity = Commodity::where('id', '=', $id)
               ->first();

       $output = array(
               'price'=> $commodity->price,
               'suki_price'=> $commodity->suki_price,
           );

         echo json_encode($output);
    }


    public function store(Request $request)
    {
            $purchases= new Purchases;
            $purchases->trans_no = $request->ticket;
            $purchases->customer_id = $request->commodity;
            $purchases->commodity_id= $request->destination;
            $purchases->sacks = $request->driver_id;
            $purchases->ca_id = $request->company;
            $purchases->balance_id = $request->plateno;
            $purchases->partial_id = $request->liter;
            $purchases->kilo = $request->liter;
            $purchases->price = $request->liter;
            $purchases->total = $request->liter;
            $purchases->amtpay= $request->liter;
            $purchases->remarks= $request->liter;
            $purchases->save();



    }

    function updateId(){
       $temp = DB::select('select MAX(id) as "temp" FROM purchases');
       echo json_encode($temp);
    }

}
