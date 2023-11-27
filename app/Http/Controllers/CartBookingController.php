<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingNote;
use App\Models\CartBooking;
use App\Models\Product;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartBookingController extends Controller
{
    public function addCartProduct(Request $request){
        // dd($request->all());
        $product = Product::where('product_name', $request->product_id)->first();
        
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'sub_booking_id' => 'required',
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['total_price'] = $product->price;

        // DB::table('products')

        CartBooking::create($validatedData);
        return redirect()->back();
    }

    public function deleteCartBooking($id){
        $cart = CartBooking::find($id);

        DB::table('cart_bookings')->where('id', $cart->id)->delete();
        return redirect()->back();
    }

    public function updateCartBooking(Request $request, $id){
        $cart = CartBooking::find($id);

        $totalPrice = $request->quantity * $cart->product->price;
        // dd($totalPrice);

        $cart->quantity = $request->quantity;
        $cart->total_price = $totalPrice;
        $cart->save();
        return redirect()->back();
        // $cart->total_price = $request->quantity
    }

    public function saveCartBooking(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        $product = Product::find($cart->product->id);
        $booking = Booking::find($request->booking_id);
        // dd($cart->quantity);
        $cart->flag = 0;
        $cart->save();
        
        $product->stock = $product->stock - $cart->quantity;
        $product->save();

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
