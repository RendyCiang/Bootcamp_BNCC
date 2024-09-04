<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Stok tidak cukup');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            if ($cart[$product->id]['quantity'] + $quantity > $product->quantity) {
                return redirect()->back()->with('error', 'Tidak bisa tambah Stok');
            }
            $cart[$product->id]['quantity'] += $quantity;
            $cart[$product->id]['total_price'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity'];
        } else {
            $cart[$product->id] = [
                'category' => $product->category->name, 
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function showCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['total_price'];
        }

        return view('cart', compact('cart', 'total'));
    }
    

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Cart is empty.');
        }
    
        $invoiceNumber = $this->generateInvoiceNumber();
    
        $invoice = Invoice::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoiceNumber,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'total_price' => array_sum(array_column($cart, 'total_price')),
        ]);
    
        foreach ($cart as $product_id => $item) {
            $product = Product::findOrFail($product_id);
            // dd($product);

            if ($product->quantity < $item['quantity']) {
                return redirect('/cart')->with('error', 'Stok tidak cukup');
            }
    
            $product->quantity -= $item['quantity'];
            $product->save();
    
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product_id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['total_price'],
            ]);
        }
    
        session()->forget('cart');
    
        return redirect('/')->with('success', 'Checkout completed successfully!');
    }
    

    private function generateInvoiceNumber()
    {
        do {
            $number = 'INV-' . strtoupper(Str::random(8));
        } while (Invoice::where('invoice_number', $number)->exists());

        return $number;
    }
}
