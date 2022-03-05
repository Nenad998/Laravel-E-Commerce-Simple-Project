<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        // withoutGlobalScopes() it's necessary for ignoring Global Scope
        $products = Product::withoutGlobalScopes()->with('category')->paginate(8);
        return view('admin.index', ['products'=> $products]);
    }

    public function showNewProductForm()
    {
        $categories = Category::all();
        return view('admin.newProduct', ['categories'=> $categories]);
    }

    public function createNewProduct(StoreProductRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $categoryId = $request->categories;
        $image = $request->image;

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $categoryId;

        if ($request->file('image')->isValid()) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(400, 200)->save( public_path('storage/' . $filename) );
            $product->image = $filename;
        }

        $product->save();
        return redirect('/admin')->with('message', 'product successfully created');
    }

    public function showEditProductForm($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('admin.editProduct', ['product'=> $product, 'categories'=> $categories]);
    }

    public function editProduct(StoreProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);

        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $categoryId = $request->categories;

        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $categoryId;

        if ($request->file('image')->isValid()) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(400, 200)->save( public_path('storage/' . $filename) );
            $product->image = $filename;
        }

        $product->save();
        return redirect('/admin')->with('message', 'product successfully edited');
    }

    public function deleteProduct(Request $request, $id)
    {
        // withoutGlobalScopes() it's necessary for ignoring Global Scope
        $product = Product::withoutGlobalScopes()->findOrFail($id);
        $message = 'product successfully SOFT deleted';

        if($product->deleted){
            $product->delete();
            $message = 'product successfully permanently deleted';
        } else{
            $product->deleted = 1;
            $product->save();
        }

        return redirect()->back()->with('message', $message);
    }

    public function showAllOrders()
    {
        $orders = Order::with('product')->get();
        return view('admin.orders', ['orders'=> $orders]);
    }


}
