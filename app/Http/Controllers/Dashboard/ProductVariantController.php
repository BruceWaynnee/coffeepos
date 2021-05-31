<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\ProductVaraint;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    // Main Product Variant CRUD Methods [BEGIN]
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
        public function create($productId)
        {
            // get product record
            $product = ProductVaraint::getProduct($productId);
            if(!$product->data){
                return back()->with('error', $product->message);
            }
            $product = $product->data;

            // product variants
            $tempProductVariants = new Collection();
            foreach($product->productVariants as $productVariant) {
                $tempProductVariants->push([
                    'price'     => $productVariant->price,
                    'product'   => ucwords($product->name),
                    'typeValue' => $productVariant->type->id,
                    'sizeValue' => $productVariant->size->id,
                    'typeText'  => ucwords($productVariant->type->name),
                    'sizeText'  => ucwords($productVariant->size->name),
                ]);
            };
            $productVariants = json_encode($tempProductVariants);

            // get type records
            $types = ProductVaraint::getTypes();
            if(!$types->data){
                return redirect()
                    ->route( 'category-products-list', ['categoryId' => $product->category->id] )
                    ->with('error', $types->message);
            }
            $types = $types->data;

            // get size records
            $sizes = ProductVaraint::getSizes();
            if(!$sizes->data){
                return redirect()
                    ->route( 'category-products-list', ['categoryId' => $product->category->id] )
                    ->with('error', $sizes->message);
            }
            $sizes = $sizes->data;

            return view( 'dashboard/modules/product_variant/add', compact('product', 'sizes', 'types', 'productVariants') );
        }

        /**
         * Store a newly created resource in storage.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            // get product record
            $product = ProductVaraint::getProduct($request['product']);
            if(!$product->data){
                return back()->with('error', $product->message);
            };
            $product = $product->data;

            // get type records
            $types = ProductVaraint::getTypesArr($request['typeId']);
            if(!$types->data){
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with('error', $types->message);
            }
            $types = $types->data;

            // get size records
            $sizes = ProductVaraint::getSizesArr($request['sizeId']);
            if(!$sizes->data){
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with('error', $sizes->message);
            }
            $sizes = $sizes->data;            
            
            // save record
            try {
                DB::beginTransaction();

                $productVariants = new ProductVaraint();
                // create product variant record based on type
                foreach($types as $key => $type){
                    ($sizes[$key])->name == 'one size' ? '' : ($sizes[$key])->name;
                    $tempProductVariant = [
                        'name'       => strtolower( ($product->name).' '.($type->name).' '.( strtolower( ($sizes[$key])->name ) ) ), 
                        'price'      => $request['price'][$key],
                        'type_id'    => $type->id,
                        'size_id'    => $sizes[$key]->id,
                        'product_id' => $product->id,
                    ];
                    $productVariants->create($tempProductVariant);
                }

            } catch(QueryException $queryEx) {
                DB::rollBack();
                if($queryEx->errorInfo[1] == 1062){
                    $message = 'Duplicated product variant name, please check product variant list again before create new data!';
                    $errorType = 'warning';
                } else {
                    $message = 'Problem occured while trying to create product variant records, please contact us to fix the bugs!';
                    $errorType = 'error';
                }
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with($errorType, $message);
            }
            DB::commit();
            return redirect()->route('category-products-list', ['categoryId' => $product->category->id]);
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
        public function edit($productId)
        {            
            // get product record
            $product = ProductVaraint::getProduct($productId);
            if(!$product->data){
                return back()->with('error', $product->message);
            }
            $product = $product->data;

            // product variants
            $tempProductVariants = new Collection();
            foreach($product->productVariants as $productVariant) {
                $tempProductVariants->push([
                    'price'     => $productVariant->price,
                    'product'   => ucwords($product->name),
                    'typeValue' => $productVariant->type->id,
                    'sizeValue' => $productVariant->size->id,
                    'typeText'  => ucwords($productVariant->type->name),
                    'sizeText'  => ucwords($productVariant->size->name),
                ]);
            };
            $productVariants = json_encode($tempProductVariants);

            // get type records
            $types = ProductVaraint::getTypes();
            if(!$types->data){
                return redirect()
                    ->route( 'category-products-list', ['categoryId' => $product->category->id] )
                    ->with('error', $types->message);
            }
            $types = $types->data;

            // get size records
            $sizes = ProductVaraint::getSizes();
            if(!$sizes->data){
                return redirect()
                    ->route( 'category-products-list', ['categoryId' => $product->category->id] )
                    ->with('error', $sizes->message);
            }
            $sizes = $sizes->data;

            return view( 'dashboard/modules/product_variant/edit', compact('product', 'sizes', 'types', 'productVariants') );
        }

        /**
         * Update the specified resource in storage.
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $productId)
        {
            // get product record
            $product = ProductVaraint::getProduct($productId);
            if(!$product->data){
                return back()->with('error', $product->message);
            };
            $product = $product->data;

            // get type records
            $types = ProductVaraint::getTypesArr($request['typeId']);
            if(!$types->data){
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with('error', $types->message);
            }
            $types = $types->data;

            // get size records
            $sizes = ProductVaraint::getSizesArr($request['sizeId']);
            if(!$sizes->data){
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with('error', $sizes->message);
            }
            $sizes = $sizes->data;

            // update record
            try {
                DB::beginTransaction();

                // detach product variants from product
                $product->productVariants()->delete();

                // create new product variants
                $productVariants = new ProductVaraint();
                foreach($types as $key => $type){
                    ($sizes[$key])->name == 'one size' ? '' : ($sizes[$key])->name;
                    $tempProductVariant = [
                        'name'       => strtolower( ($product->name).' '.($type->name).' '.( strtolower( ($sizes[$key])->name ) ) ), 
                        'price'      => $request['price'][$key],
                        'type_id'    => $type->id,
                        'size_id'    => $sizes[$key]->id,
                        'product_id' => $product->id,
                    ];
                    $productVariants->create($tempProductVariant);
                }

            } catch(QueryException $queryEx) {
                DB::rollBack();
                if($queryEx->errorInfo[1] == 1062){
                    $message = 'Duplicated product variant name, please check product variant list again before create new data!';
                    $errorType = 'warning';
                } else {
                    $message = 'Problem occured while trying to update product variant records, please contact us to fix the bugs!';
                    $errorType = 'error';
                }
                return redirect()
                    ->route('product-productvariants-list', ['productId' => $product->id])
                    ->with($errorType, $message);
            }
            DB::commit();
            return redirect()->route('category-products-list', ['categoryId' => $product->category->id]);
        }

        /**
         * Remove the specified resource from storage.
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    // Main Product Variant CRUD Methods [END]

    // Product Variant And Product Relation Methods [BEGIN]
        /**
         * Display a listing of the resource based on specific product.
         * @return \Illuminate\Http\Response
         */
        public function productVariantsIndex($productId)
        {
            // get product record
            $product = ProductVaraint::getProduct($productId);
            if(!$product->data){
                return view('dashboard/index')->with('error', $product->message);
            }
            $product = $product->data;
            $category = $product->category;

            // get product variants
            $productVariants = $product->productVariants()->paginate(5);
            return view('dashboard/modules/product_variant/index', compact('category', 'product', 'productVariants'));
        }
    
    // Product Variant And Product Relation Methods [END]

}
