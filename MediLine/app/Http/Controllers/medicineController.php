<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Medicine;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Owner;
use Stripe\Charge;
use Stripe\Stripe;

use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:owner', ['only' => 'store']);
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $medicines = Medicine::orderBy('med_name', 'desc')->paginate(10);
        $med_name = $request->input('med_name');
        if (!empty($med_name)) {
           $medicines = DB::table('medicines')
                ->where('med_name', 'like', '%'.$med_name.'%')
                ->orWhere('med_group', 'like', '%'.$med_name.'%')
                ->get();
        }
       // $medicines = $medicines->paginate(5);
        return view('pages.medicineView', compact('medicines'));
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
        $this->validate($request,[
            'med_name' => 'required',
            'med_group' => 'required',
            'power_mg' => 'required',
            'price' => 'required'
        ]);

        $medicine = new Medicine([
            'med_name' => $request->input('med_name'),
            'med_group' => $request->input('med_group'),
            'power_mg' => $request->input('power_mg'),
            'price' => $request->input('price')
        ]);

        $medicine->save();


        return redirect()->route('owner.dashboard')->with('message', 'med uploaded successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }

    public function getModel() {
        return new Transaction;
    }
    
    public function getAll() {
        return $this->getModel()->all();
    }
    
    public function paginate($limit = 15) {
        return $this->getModel()->paginate($limit);
    }

    public function getAddToCart(Request $request, $id){
        $medicine = Medicine::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($medicine, $medicine->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('medicine.index')->with('message', 'item added to cart successfully!!');
    }

    public function getCart(){
        if (!Session::has('cart')){
            return view('medicine.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


        return view('medicine.shopping-cart', ['products' => $cart->items,
            'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
        if (!Session::has('cart')){
            return redirect()->back();
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        return view('medicine.checkout', ['total'=>$total, 'items' =>$cart->items]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postCheckout(Request $request){
        if (!Session::has('cart')){
            return redirect()->route('medicine.shoppingCart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_NLagNy7bXR7TAqfjRe2zfIp9');
        try{
            $charge = Charge::create(array(
                    "amount" => $cart->totalPrice * 100,
                    "currency" => "usd",
                    "source" => $request->input('stripeToken'), // obtained with Stripe.js
                    "description" => "charged from mediline"
            ));
             $order = new Order();
             $order->cart = serialize($cart);
             $order->address = $request->input('address');
             $order->name = $request->input('name');
             $order->payment_id = $charge->id;
             auth()->user()->orders()->save($order);
        }
        catch (\Exception $e){
            return redirect()->route('medicine.checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('medicine.index')->with('message', '
        Order completed');
    }


}
