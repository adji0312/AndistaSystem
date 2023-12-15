<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingNote;
use App\Models\CartBooking;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServicePrice;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;

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
        $booking = Booking::find($sale->booking_id);
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

        $booking->total_price = $sale->total_price;
        $booking->save();

        
        return redirect()->back();
    }

    public function addCartProduct3(Request $request){
        // dd($request->all());
        $product = Product::where('product_name', $request->product_id)->first();
        $quotation = Quotation::find($request->quotation_id);
        // dd($product);
        $validatedData = $request->validate([
            'staff_id' => 'required',
            // 'sub_booking_id' => 'required',
            // 'staff_id' => 'required'
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['quotation_id'] = $quotation->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['price'] = $product->price;

        // DB::table('products')

        QuotationItem::create($validatedData);

        $quotation->total_price = $quotation->total_price + $product->price;
        $quotation->save();

        
        return redirect()->back();
    }

    public function addCartService(Request $request){
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

    public function addCartService2(Request $request){
        // dd($request->all());
        $service = Service::where('service_name', $request->service_name)->first();
        // dd($service);

        $validatedData = $request->validate([
            'booking_id' => 'required'
        ]);

        $validatedData['service_id'] = $service->id;
        $validatedData['sub_booking_id'] = 0;
        $validatedData['staff_id'] = 0;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['total_price'] = 0;

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
        $booking = Booking::find($cart->booking_id);
        // dd($booking);
        
        if($cart->product_id != null){
            
            $cartBooking = $cart->booking->sale->first();
            $cartBooking->total_price = $cartBooking->total_price - $cart->total_price;
            $cartBooking->save();

            $booking->total_price = $cartBooking->total_price;
            $booking->save();

            $product = Product::find($cart->product_id);
            $product->stock = $product->stock + $cart->quantity;
            $product->save();

            
            

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
            
        }else{
            $cartBooking = $cart->booking->sale->first();
            $cartBooking->total_price = $cartBooking->total_price - $cart->total_price;
            $cartBooking->save();

            $booking->total_price = $cartBooking->total_price;
            $booking->save();

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
            // dd($cart->service);
        }

        return redirect()->back();
    }

    public function deleteCartBooking3($id){
        $quoItem = QuotationItem::find($id);
        $quotation = Quotation::find($quoItem->quotation->id);
        $product = Product::find($quoItem->product_id);
        // dd($quoItem);
        
        // $cartBooking = $cart->booking->sale->first();
        // $cartBooking->total_price = $cartBooking->total_price - $quoItem->total_price;
        // $cartBooking->save();

        // $booking->total_price = $cartBooking->total_price;
        // $booking->save();

        $quotation->total_price = $quotation->total_price - $quoItem->price;
        $quotation->save();

        $product->stock = $product->stock + $quoItem->quantity;
        $product->save();
        

            
            

        DB::table('quotation_items')->where('id', $quoItem->id)->delete();

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
        $booking = Booking::find($cart->booking_id);
        $sale = Sale::find($request->sale_id);
        // dd($booking);
        
        if($cart->service_id != null){
            $servicePrice = ServicePrice::find($request->service_price_id);
            // dd($request->all());

            $lastPrice = $cart->total_price;
            $sale->total_price = $sale->total_price - $lastPrice;
            $sale->save();
            $booking->total_price = $booking->total_price - $lastPrice;
            $booking->save();
            
            $totalPrice = $request->quantity * $servicePrice->price;
            
            $sale->total_price = $sale->total_price + $totalPrice;
            $sale->save();
            $booking->total_price = $booking->total_price + $totalPrice;
            $booking->save();
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->service_price_id = $servicePrice->id;
            $cart->staff_id = $request->staff_id;
            $cart->save();

        }else{
            $lastPrice = $cart->total_price;
            $sale->total_price = $sale->total_price - $lastPrice;
            $sale->save();
            $booking->total_price = $booking->total_price - $lastPrice;
            $booking->save();
            // dd($booking->total_price);
            
            $totalPrice = $request->quantity * $cart->product->price;
            
            $sale->total_price = $sale->total_price + $totalPrice;
            $sale->save();
            $booking->total_price = $booking->total_price + $totalPrice;
            $booking->save();
    
            $cart->quantity = $request->quantity;
            $cart->total_price = $totalPrice;
            $cart->staff_id = $request->staff_id;
            $cart->save();
        }

        return redirect()->back();
        // $cart->total_price = $request->quantity
    }

    public function updateCartBooking3(Request $request, $id){
        // dd($request->all());
        $quoItem = QuotationItem::find($id);
        $quotation = Quotation::find($request->quotation_id);
        // dd($quoItem);
        
        
        $lastPrice = $quoItem->price;
        // dd($lastPrice);
        $quotation->total_price = $quotation->total_price - $lastPrice;
        $quotation->save();

        
        $totalPrice = $request->quantity * $quoItem->product->price;
        $quoItem->quantity = $request->quantity;
        $quoItem->staff_id = $request->staff_id;
        $quoItem->price = $totalPrice;
        $quoItem->save();
        
        $quotation->total_price = $quotation->total_price + $totalPrice;
        $quotation->save();

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

    public function saveCartBooking2(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        // dd($cart->quantity);
        // dd($cart->quantity);
        $cart->flag = 0;
        $cart->save();
        
        if($cart->product_id != null){
            $product = Product::find($cart->product->id);
            // dd($product);
            $product->stock = $product->stock - $cart->quantity;
            $product->save();
        }

        return redirect()->back();
    }

    public function saveCartBooking3(Request $request, $id){
        // dd($request->all());
        $quoItem = QuotationItem::find($id);
        $quoItem->flag = 0;
        $quoItem->save();
        
        $product = Product::find($quoItem->product->id);
        // dd($product);
        $product->stock = $product->stock - $quoItem->quantity;
        $product->save();

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
