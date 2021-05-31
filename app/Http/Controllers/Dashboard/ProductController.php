<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Http\Controllers\Controller;
use App\ImageServiceProvider as Image;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Main Product CRDU Methods [BEGIN]
        /**
         * Display a listing of the resource.
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            // get category records
            $categories = Product::getCategories();
            if(!$categories->data){
                return view('dashboard/index')->with('error', $categories->message);
            }
            $categories = $categories->data;
            return view('dashboard/modules/product/add', compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            // get category record
            $category = Product::getCategory( $request['category'] );
            if(!$category->data){
                return back()->with('error', $category->message);
            }
            $category = $category->data;

            // validat all request values
            $requestResult = Product::checkRequestValidation( $request['name'], );
            if(!$requestResult->data){
                return back()->with('error', $requestResult->message);
            }

            // save record
            try {
                DB::beginTransaction();
                $product = new Product([
                    'category_id' => $category->id,
                    'name'        => $requestResult->name,
                    'description' => $request['description'],
                ]);
                $product->save();

                $imageFileResult = Image::storeImage($request, 'image-file', $product->name);
                if($imageFileResult->data) { // update record if file != null
                    // update product image
                    $product->image = $imageFileResult->data;
                    $product->save();
                }
                

            } catch(QueryException $queryEx) {
                DB::rollBack();
                if($queryEx->errorInfo[1] == 1062){
                    $message = 'Sorry, product name already exists!';
                } else {
                    $message = 'Problem occured while trying to create product, please contact us to fix the bugs!';
                }
                return back()->with('error', $message);
            }
            DB::commit();
            return redirect()->route('productvariant-add', ['productId' => $product->id]);
        }

        /**
         * Display the specified resource.
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            // get product record
            $product = Product::getProduct($id);
            if(!$product->data){
                return back()->with('error', $product->message);
            }
            $product = $product->data;

            // get category records
            $categories = Product::getCategories();
            if(!$categories->data){
                return back()->with('error', $categories->message);
            }
            $categories = $categories->data;

            return view( 'dashboard/modules/product/edit', compact('product', 'categories') );
        }

        /**
         * Update the specified resource in storage.
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            // check product record
            $product = Product::getProduct($id);
            if(!$product->data){
                return back()->with('error', $product->message);
            }
            $product = $product->data;

            // get category record
            $category = Product::getCategory( $request['category'] );
            if(!$category->data){
                return back()->with('error', $category->message);
            }
            $category = $category->data;

            // validat all request values
            $requestResult = Product::checkRequestValidation( $request['name'], );
            if(!$requestResult->data){
                return back()->with('error', $requestResult->message);
            }            

            // update record
            try {
                DB::beginTransaction();
                $oldVariantName = $product->name;

                $product->category_id = $category->id;
                $product->name        = $requestResult->name;
                $product->description = $request['description'];
                $product->save();

                // update product variant name
                $productVariants = $product->productVariants;
                foreach( $productVariants as $productVariant ){
                    $tempNewVariantName = str_replace($oldVariantName, $product->name, $productVariant->name);
                    $productVariant->name = $tempNewVariantName;
                    $productVariant->save();
                }

            // if user not upload, everything remain the same
            if($request->hasFile('image-file')){
                
                // delete file from storage on value != null
                if($product->image != null){
                    $imageFileResult = Image::deleteImageStorage($product->image);
                    if(!$imageFileResult->data){
                        return back()->with('error', $imageFileResult->message);
                    }
                }

                // validat and update file record 
                $imageFileResult = Image::storeImage($request, 'image-file', $product->sku);
                if($imageFileResult->data){ // update record if file != null
                // update product image
                    $product->image = $imageFileResult->data;
                    $product->save();
                }

            }

            } catch(QueryException $queryEx) {
                DB::rollBack();
                if($queryEx->errorInfo[1] == 1062) {
                    $message = 'Sorry, product name already exists!';
                } else {
                    $message = 'Problem occured while trying to update product, please contact us to fix the bugs!';
                }
                return back()->with('error', $message);
            }
            DB::commit();
            return redirect()->route('productvariant-edit', ['productId' => $product->id]);
        }

        /**
         * Remove the specified resource from storage.
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            // get product record
            $product = Product::getProduct($id);
            if(!$product->data){
                return back()->with('error', $product->message);
            }
            $product = $product->data;

            // delete record
            try {
                DB::beginTransaction();

                $imagePath = $product->image;

                $result = $product->delete();

                // delete image from disk on != null
                if($result && $imagePath){
                    $imageResult = Image::deleteImageStorage($imagePath);
                    if(!$imageResult->data){
                        return back()->with('error', $imageResult->message);
                    }
                }

            } catch(Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Problem occured while trying to delete product, please contact us to fix the bugs!');
            }
            DB::commit();
            return back()->with('success', 'Product delete succeefully');
        }
    // Main Product CRDU Methods [END]

    // Product And Category Relation Methods [BEGIN]
        /**
         * Display a listing of the resource based on specific category.
         * @param  int  $categoryId
         * @return \Illuminate\Http\Response
         */
        public function categoryProductsIndex($categoryId)
        {
            // get category record
            $category = Product::getCategory($categoryId);
            if(!$category->data){
                return view('dashboard/index')->with('error', $category->message);
            }
            $category = $category->data;

            // get products
            $products = $category->products()->paginate(5);
            return view('dashboard/modules/product/index', compact('products', 'category'));
        }
    // Product And Category Relation Methods [END]
}
