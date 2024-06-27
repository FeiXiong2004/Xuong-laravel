<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\ProductVariants;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductsController extends Controller
{   
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Products::query()->with(['catalogue','tags'])->latest('id')->get();
        // foreach($products as $product){
        //     $product->catalogues->name;

        // }
    
        return view(self::PATH_VIEW. __FUNCTION__,compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues=Catalogues::query()->pluck('name','id')->all();
        $colors =ProductColor::query()->pluck('name','id')->all();
        $sizes =ProductSize::query()->pluck('name','id')->all();
        $tags =Tag::query()->pluck('name','id')->all();
        
        return view(self::PATH_VIEW. __FUNCTION__,compact('catalogues','colors','sizes','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except([
            "product_variants",
            "tags",
            "product_galleries"
        ]);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal']= isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal']= isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new']= isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home']= isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug']= Str::slug( $dataProduct['name']) . '-' . $dataProduct['sku'];
        if($dataProduct['img_thumbnail'] ){
            $dataProduct['img_thumbnail'] = Storage::put('products',$dataProduct['img_thumbnail']);
        }   
        $dataProductVariantsTmp=$request->product_variants;
        $dataProductVariants=[];
    
        foreach($dataProductVariantsTmp as $key=>$item){
            $tmp=explode('-',$key);
                $dataProductVariants[]=[
                    'product_size_id'=>$tmp[0],
                    'product_color_id'=>$tmp[1],
                    'quantity'=>$item['quantity'],
                    'image'=>$item['image'] ?? null,
                  
                 
                ];
        }
        // dd($dataProductVariants);
        
        $dataProductTags=$request->tags;
        $dataProductGalleries=$request->product_galleries ?: [];
     
        try{
            DB::beginTransaction();
            
            $product = Products::query()->create($dataProduct);

            foreach($dataProductVariants as $dataProductVariant){
                $dataProductVariant['products_id']= $product->id;
                if($dataProductVariant['image'] ){
                    $dataProductVariant['image'] = Storage::put('products',$dataProductVariant['image']);
                }   
                ProductVariants::query()->create($dataProductVariant);
              
            }
            $product->tags()->sync($dataProductTags);
            foreach($dataProductGalleries as $dataProductGallery ){
                ProductGallery::query()->create([
                    'products_id' =>  $product->id,
                    'image'=> Storage::put('products',$dataProductGallery)
                ]);
          
            }


            DB::commit();
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return back();
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {   
        dd($products);
            try{
                
                DB::Transaction(function () use ($products){
                    $products->delete();
                    $products->tags()->sync([]);
                    $products->variants()->delete();
                    $products->galleries()->delete();
                },3);
                return back();  
            }catch(\Exception $e){
                DB::rollBack();
                dd($e->getMessage());
                return back();
            }   
        
    }
}
