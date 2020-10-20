<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductGalerie;

class ProductController extends Controller
{
    /**
     *
     * @return 
     */
    public function index()
    {
        $record = Product::with('galeries')->get();
        return view('pages.product.index',[
            'record' => $record
        ]);

    }

    /**
     *
     * @return 
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     *
     * @param  
     * @return 
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('assets/product','public');
        }
        $barang = Product::create([
            'name' => $request->name,
            'slug' => str::slug($request->name),
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        $barang->galeries()->create([
            'photo' => $photo,
            'is_default'=> true
        ]);
        return redirect('product');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     *
     * @param  
     * @return 
     */
    public function edit($id)
    {
        return view('pages.product.edit',[
            'record' => Product::find($id)
        ]);
    }

    /**
     *
     * @param  
     * @param  
     * @return 
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('assets/product','public');
        }
        $barang = Product::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => str::slug($request->name),
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        $barang->galeries()->create([
            'photo' => $photo,
            'is_default'=> true
        ]);
        return redirect('product');
    }

    /**
     *
     * @param  int  $id
     * @return 
     */
    public function destroy($id)
    {
        //
    }
}
