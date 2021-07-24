<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBrandRequest;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    // check if authenticated
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        $this->storeImage($brand);
        return redirect()->back()->with('message', 'Brand Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        $this->storeImage($brand);
        return redirect()->route('brands.index')->with('message', $brand->name . ' Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('message', $brand->name . ' Brand Deleted Successfully');
    }

    //store, update & resize for calling when needed
    private function storeImage($brand)
    {
        if (request()->hasFile('image')) {
            // $image = request()->file('image');
            // $name_gen = hexdec(uniqid());
            // $img_ext = strtolower($image->getClientOriginalExtension());
            // $img_name = $name_gen . '.' . $img_ext;
            // $up_location = 'image/brand/';
            // $last_img = $up_location . $img_name;
            // $image->move($up_location, $img_name);

            // use package intervension for image resize & refractor
            $image = request()->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('image/brand/' . $name_gen);
            $last_img = 'image/brand/' . $name_gen;

            $brand->update([
                'image' => $last_img,
            ]);
        }
    }
}
