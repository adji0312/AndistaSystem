<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingNote;
use App\Models\CartBooking;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServicePrice;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartBookingController extends Controller
{
    public function addCartProduct(Request $request){
        // dd($request->all());
        $product = Product::where('product_name', $request->product_id)->first();
        // dd($product);
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'sub_booking_id' => 'required',
            'staff_id' => 'required'
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['total_price'] = $product->price;

        // DB::table('products')

        CartBooking::create($validatedData);
        return redirect()->back();
    }

    public function addCartProduct2(Request $request){
        // dd($request->all());
        $product = Product::where('product_name', $request->product_id)->first();
        $sale = Sale::find($request->sale_id);
        // dd($sale);
        // dd($product);
        $validatedData = $request->validate([
            'booking_id' => 'required',
            // 'sub_booking_id' => 'required',
            // 'staff_id' => 'required'
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['sub_booking_id'] = 0;
        $validatedData['staff_id'] = 0;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['total_price'] = $product->price;

        // DB::table('products')

        CartBooking::create($validatedData);

        $sale->total_price = $sale->total_price + $product->price;
        $sale->save();

        
        return redirect()->back();
    }

    public function addCartService(Request $request){
        // dd($request->all());
        $service = Service::where('service_name', $request->service_name)->first();
        // dd($service);

        $validatedData = $request->validate([
            'booking_id' => 'required',
            'sub_booking_id' => 'required',
            'staff_id' => 'required'
        ]);

        $validatedData['service_id'] = $service->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        // $validatedData['total_price'] = $product->price;

        // DB::table('products')

        CartBooking::create($validatedData);
        return redirect()->back();
    }

    public function deleteCartBooking($id){
        $cart = CartBooking::find($id);

        DB::table('cart_bookings')->where('id', $cart->id)->delete();
        return redirect()->back();
    }

    public function deleteCartBooking2($id){
        $cart = CartBooking::find($id);
        // dd($cart);
        
        if($cart->product_id != null){
            
            $cartBooking = $cart->booking->sale->first();
            $cartBooking->total_price = $cartBooking->total_price - $cart->total_price;
            $cartBooking->save();

            $product = Product::find($cart->product_id);
            $product->stock = $product->stock + $cart->quantity;
            $product->save();

            
            

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
            
        }else{
            $cartBooking = $cart->booking->sale->first();
            $cartBooking->total_price = $cartBooking->total_price - $cart->total_price;
            $cartBooking->save();

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
            // dd($cart->service);
        }

        return redirect()->back();
    }

    public function updateCartBooking(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        $servicePrice = ServicePrice::find($request->service_price_id);
        // dd($servicePice);
        
        if($cart->service_id != null){
            // dd($request->all());
            $totalPrice = $request->quantity * $servicePrice->price;
            // dd($totalPrice);
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->service_price_id = $servicePrice->id;
            $cart->save();
        }else{
            $totalPrice = $request->quantity * $cart->product->price;
            // dd($totalPrice);
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->save();
        }

        return redirect()->back();
        // $cart->total_price = $request->quantity
    }

    public function updateCartBooking2(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        // dd($cart);
        $servicePrice = ServicePrice::find($request->service_price_id);
        
        if($cart->service_id != null){
            // dd($request->all());
            $totalPrice = $request->quantity * $servicePrice->price;
            // dd($totalPrice);
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->service_price_id = $servicePrice->id;
            $cart->save();
        }else{
            $totalPrice = $request->quantity * $cart->product->price;
            // dd($totalPrice);
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->save();
        }

        return redirect()->back();
        // $cart->total_price = $request->quantity
    }

    public function saveCartBooking(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        $booking = Booking::find($request->booking_id);
        // dd($cart->quantity);
        $cart->flag = 0;
        $cart->save();
        
        if($cart->product_id != null){
            $product = Product::find($cart->product->id);
            $product->stock = $product->stock - $cart->quantity;
            $product->save();
        }

        $booking->total_price = $booking->total_price + $cart->total_price;
        $booking->save();

        return redirect()->back();
    }

    public function submitTextBooking(Request $request){
        // dd($request->all());

        $validatedData['text'] = $request->text;
        $validatedData['booking_id'] = $request->booking_id;
        $validatedData['sub_booking_id'] = $request->sub_booking_id;

        // DB::table('products')

        BookingNote::create($validatedData);
        return redirect()->back();
    }

    public function editTextBooking(Request $request, $id){
        // dd($request->all());

        $note = BookingNote::find($id);
        $note->text = $request->text;
        $note->save();
        return redirect()->back();
    }
}
