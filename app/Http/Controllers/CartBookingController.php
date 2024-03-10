<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingNote;
use App\Models\BookingService;
use App\Models\CartBooking;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServicePrice;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;
use RealRashid\SweetAlert\Facades\Alert;

class CartBookingController extends Controller
{
    public function addCartProduct(Request $request){
        // dd($request->all());
        $product = Product::where('product_name', $request->product_id)->first();
        // dd($product);
        if($product == null || $product == ''){
            Alert::warning('Gagal', "Produk tidak tersedia!");
            return redirect()->back();
        }
        // dd($product);
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'sub_booking_id' => 'required',
            'staff_id' => 'required'
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['name'] = $product->product_name;
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
        $subBook = SubBook::find($sale->sub_booking_id);
        // dd($subBook);
        // dd($sale);
        // dd($product);
        $validatedData = $request->validate([
            'booking_id' => 'required',
            // 'sub_booking_id' => 'required',
            // 'staff_id' => 'required'
        ]);

        $validatedData['product_id'] = $product->id;
        $validatedData['sub_booking_id'] = $sale->sub_booking_id;
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

        $subBook->sub_total_price = $sale->total_price;
        // dd($subBook);
        $subBook->save();

        
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
        // dd($request->all());
        $service = Service::where('service_name', $request->service_name)->first();
        // dd($service->service_name);
        if($service == null || $service == ''){
            Alert::warning('Gagal', "Servis tidak tersedia!");
            return redirect()->back();
        }
        // dd($request->all());

        // $validatedData = $request->validate([
        //     'booking_id' => 'required',
        //     'staff_id' => 'required'
        // ]);

        $validatedData['booking_id'] = $request->booking_id;
        $validatedData['staff_id'] = Auth::user()->id;
        $validatedData['sub_booking_id'] = $request->sub_booking_id;
        $validatedData['service_id'] = $service->id;
        $validatedData['quantity'] = 1;
        $validatedData['flag'] = 1;
        $validatedData['name'] = $service->service_name;
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
        $validatedData['sub_booking_id'] = $request->sub_booking_id;
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

    public function deleteCartBooking2(Request $request, $id){
        // dd($request->all());
        $cart = CartBooking::find($id);
        // dd($cart);
        $booking = Booking::find($cart->booking_id);
        $subBooking = SubBook::find($cart->sub_booking_id);
        $sale = Sale::find($request->sale_id);
        // dd($sale);
        // dd($subBooking);
        
        if($cart->product_id != null){
            // dd($cart->total_price);

            $booking->total_price = $booking->total_price - $cart->total_price;
            $booking->save();

            $subBooking->sub_total_price = $subBooking->sub_total_price - $cart->total_price;
            $subBooking->save();

            $sale->total_price = $sale->total_price - $cart->total_price;
            $sale->save();

            if($cart->flag == 0){
                $product = Product::find($cart->product_id);
                $product->stock = $product->stock + $cart->quantity;
                $product->save();
            }

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
            
        }else{
            // dd("here");
            // $cartBooking = $cart->booking->sale->first();
            // $cartBooking->total_price = $cartBooking->total_price - $cart->total_price;
            // $cartBooking->save();

            $booking->total_price = $booking->total_price - $cart->total_price;
            $booking->save();

            $subBooking->sub_total_price = $subBooking->sub_total_price - $cart->total_price;
            $subBooking->save();

            $sale->total_price = $sale->total_price - $cart->total_price;
            $sale->save();

            DB::table('cart_bookings')->where('id', $cart->id)->delete();
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
        $subBooking = SubBook::find($cart->sub_booking_id);
        // dd($subBooking);
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
            $subBooking->sub_total_price = $subBooking->sub_total_price - $lastPrice;
            $subBooking->save();
            
            $totalPrice = $request->quantity * $servicePrice->price;
            
            $sale->total_price = $sale->total_price + $totalPrice;
            $sale->save();
            $booking->total_price = $booking->total_price + $totalPrice;
            $booking->save();
            $subBooking->sub_total_price = $subBooking->sub_total_price + $totalPrice;
            $subBooking->save();
    
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
            $subBooking->sub_total_price = $subBooking->sub_total_price - $lastPrice;
            // dd($subBooking->sub_total_price);
            $subBooking->save();
            
            $totalPrice = $request->quantity * $cart->product->price;
            // dd($totalPrice);
            
            $sale->total_price = $sale->total_price + $totalPrice;
            $sale->save();
            $booking->total_price = $booking->total_price + $totalPrice;
            $booking->save();
            $subBooking->sub_total_price = $subBooking->sub_total_price + $totalPrice;
            // dd($subBooking);
            $subBooking->save();
    
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
        // $booking = Booking::find($request->booking_id);
        $subBook = SubBook::find($request->sub_booking_id);
        // dd($subBook);
        // dd($cart->quantity);
        $cart->flag = 0;
        $cart->save();
        
        if($cart->product_id != null){
            $product = Product::find($cart->product->id);
            $product->stock = $product->stock - $cart->quantity;
            $product->save();
        }

        // $booking->total_price = $booking->total_price + $cart->total_price;
        // $booking->save();
        $subBook->sub_total_price = $subBook->sub_total_price + $cart->total_price;
        $subBook->save();

        return redirect()->back();
    }

    public function saveCartBooking2(Request $request, $id){
        dd($request->all());
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
        // dd($note);
        $note->text = $request->text;
        $note->save();

        Alert::success('Berhasil!', 'Perbarui Note Berhasil!');
        return redirect()->back();
    }

    public function deleteTextBooking($id){
        $catatan = BookingNote::find($id);
        DB::table('booking_notes')->where('id', $catatan->id)->delete();
        Alert::success('Berhasil!', 'Hapus Catatan Berhasil Dilakukan');
        return redirect()->back();
    }

    public function deleteBookingService2(Request $request, $id){
        // dd($request->all());
        $bs = BookingService::find($id);
        $sale = Sale::all()->where('sub_booking_id', $bs->subBooking->id)->first();
        $subBook = SubBook::find($bs->sub_booking_id);
        
        $sale->total_price = $sale->total_price - $bs->price;
        $subBook->sub_total_price = $subBook->sub_total_price - $bs->price;
        // dd($subBook->sub_total_price);
        $sale->save();
        $subBook->save();

        DB::table('booking_services')->where('id', $bs->id)->delete();



        return redirect()->back();
    }

    public function editCartPrice(Request $request, $id){
        $cart = CartBooking::find($id);
        $cart->total_price = $request->total_price;
        $cart->save();
        $subBooking = SubBook::find($cart->sub_booking_id);
        $subBooking->sub_total_price = 0;
        $subBooking->save();
        foreach($subBooking->carts as $sc){
            $subBooking->sub_total_price += $sc->total_price;
        }
        $subBooking->save();

        $sale = Sale::find($request->sale_id);
        $sale->total_price = $subBooking->sub_total_price;
        $sale->save();
        // dd($subBooking->sub_total_price);

        // dd($cart);
        return redirect()->back();
        // dd($request->all());
    }
}
