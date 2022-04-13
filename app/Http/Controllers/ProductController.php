<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('company_id', auth()->user()->company_id);

        $search = $request->input('search');
        if ($search) {
            $products = $products->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $search_status = $request->input('search_status');
        if ($search_status) {
            $products = $products->where('status', $search_status);
        }

        $products = $products->orderBy('name')->paginate(10);

        return view('products.index', compact('products', 'search', 'search_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if($data['company_id'] != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão de criar produtos para outras empresas.');
        }

        Product::create($data);
        
        flash('Produto criado com sucesso!')->success();
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar produtos de outras empresas.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if($product->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar produtos de outras empresas.');
        }

        $data = $request->all();

        $product->update($data);

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para excluir produtos de outras empresas.');
        }

        $product->delete();

        flash('Produto removido com sucesso!')->success();
        return redirect()->route('product.index');
    }
}
