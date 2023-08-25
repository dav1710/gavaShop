<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ShoesSize;
use App\Models\ShoesSizeProduct;
use App\Models\Tag;
use Faker\Core\File;
use Illuminate\Http\Request;
use Image, Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        $shoes = ShoesSize::all();

        return view('product.create', compact('tags', 'colors', 'categories', 'shoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $images = [];
        foreach ($data['images'] as $image) {
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_path = 'images/resource/' . $image_name;
            Image::make($image)->save(public_path($image_path));
            array_push($images, $image_path);
        }
        $data['images'] = $images;
        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);
        // dd($product->tags());
        $product->tags()->attach($data['tags']);
        $product->shoes_size()->attach($data['shoes_size']);
        $product->colors()->attach($data['colors']);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
