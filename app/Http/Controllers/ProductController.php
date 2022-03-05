<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{

    public function showHomePage()
    {
        $products = Product::with('category')->paginate(8);
        return view('product.index', ['products'=> $products]);
    }

    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->paginate(8);
        return view('product.category', ['products'=> $products]);
    }

    public function getProductsBySlug($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('product.single_product', ['product'=> $product]);
    }

    public function getProductsBySearch(Request $request)
    {
        $request->validate([
            'keyword' => 'sometimes|string|min:2|nullable'
        ]);

        $keyword = $request->keyword;
        $products = $keyword ? Product::where('name', 'like', '%' . $keyword . '%')->paginate(8) : Product::with('category')->paginate(8);
        return view('product.index', ['products'=> $products, 'keyword'=> $keyword]);
    }

    // save data in session
    public function addInCart(Request $request)
    {
        $quantity = $request->quantity;
        $product_id = $request->product_id;

        $request->session()->put('quantity', $quantity);
        $value = $request->session()->get('quantity', $quantity);

        $request->session()->put('product_id', $product_id);
        $value2 = $request->session()->get('product_id', $product_id);

        return view('product.addCart', ['value'=> $value, 'value2'=> $value2]);
    }

    // buying a product and sending email to user for success buy
    public function buy(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $quantity = $request->quantity;
        $product_id = $request->product_id;

        $order = new Order();
        $order->name = $name;
        $order->address = $address;
        $order->quantity = $quantity;
        $order->product_id = $product_id;

        $order->save();

        $details = [
            'title'=> 'Mail from Luka Stepanovic',
            'body'=> 'This is for testing mail using mailtrap'
        ];

        Mail::to('nenadstaniskovic3@gmail.com')->send(new TestMail($details));

        return redirect('/')->with('message', 'product successfully BOUGHT');

    }
}
