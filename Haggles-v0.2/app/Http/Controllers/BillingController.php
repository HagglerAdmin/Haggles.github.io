<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Bought;
use App\Order;
use App\StockHistory;
use App\ProductStock;
use App\Notification;
use App\shippingRate;
use App\Deal;
use App\Billing;
use App\Product;
use App\User;
use Mail;
use Auth;

class BillingController extends Controller
{
    
    public function store(Request $request)
    {
        $count = User::find(auth::id())->billing()->count();
        
        if ($count > 0) {
            
            User::find(auth::id())->billing()->update([

                'billing_name' => $request->input('fname'), 'billing_address' => $request->input('address'), 'billing_city' => $request->input('city'),
                'billing_zip'=> $request->input('zip'), 'billing_phone' => $request->input('number'), 'billing_email'	=> $request->input('email'),
                'billing_note'	=> $request->input('otherNote'),
            ]);
        }
        else if($count <= 0) {

            Billing::create([
                'users_id' => auth::id(), 'billing_name' => $request->input('fname'), 'billing_address' => $request->input('address'),
                'billing_city' => $request->input('city'), 'billing_zip'=> $request->input('zip'), 'billing_phone' => $request->input('number'),
                'billing_email'	=> $request->input('email'), 'billing_note'	=> $request->input('otherNote'),
            ]);
        }
        // validation for user type
        if ($request->input('result') == "buyer") 
        {
            if (Order::find($request->input('id'))->order_remarks != "Complete" )
            {
                Order::where('id', $request->input('id'))->update([ 'order_remarks' => "Processing" ]);        
            }
        }
        else 
        {
            event(new Bought($request));
        }

        return $request->input('result');
    }

    public function summary ($id)
    {   
         $selectBilling = Billing::join('orders','orders.user_id','=','billings.users_id')
        
        ->join('products','products.id','=','orders.product_id')

        ->join('customer_cities','customer_cities.city_name','=','billings.billing_City')

        ->select('orders.id','billings.billing_address','billings.billing_city','billings.billing_zip','orders.user_id',
        'orders.order_price','orders.product_id','products.product_name','orders.order_weight','customer_cities.city_type')

        ->limit(1)

        ->where(['orders.user_id' => auth::id(), 'orders.id' => $id])

        ->get();

        $rate = ShippingRate::all();

        return view('billing.billing-summary', compact('selectBilling','rate'));
    }

    public function deal (Request $request)
    {   
        $trackingNumber = (new \App\Repositories\RandomGenerator)->quickRandom(7);

        Order::where('id', $request->input('billing_id'))->update([
			'mode_of_payment' => $request->input('mop'),
			'order_remarks' => 'Complete'
        ]);
        
        Deal::create([
			'order_id' => $request->input('billing_id'),
			'user_id' => auth::id(),
			'product_id' => $request->input('products_id'),
			'tracking_number' => $trackingNumber,
			'shipping_fee' => $request->input('shippingFee'),
			'deal_remark' => "Pending",
        ]);
        
        Notification::create([
            'order_id' => $request->input('billing_id'),
            'user_from' => auth::id(),
            'user_to' => Product::find($request->input('products_id'))->user_id,
            'notif_content' => "Has bought your product",
            'notif_type' => "buyer-bought",
            'notif_remarks' => "Sent"
        ]);
        
        return $trackingNumber;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function seller ($id) 
    {   
        $order = Order::find($id);
        
        $validate = Billing::where('users_id', Auth::id())->count();

        return view('billing.billing-seller', compact('order','validate'));
    }

    public function show($id)
    {   
        $product = Order::find($id);
        
        $validate = Billing::where('users_id', Auth::id())->count();

        return view('billing.billing-form', ['order' => $product, 'validate' => $validate]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
