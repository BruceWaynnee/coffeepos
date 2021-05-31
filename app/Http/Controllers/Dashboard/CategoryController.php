<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getCategories();
        if(!$categories->data) {
            return view('dashboard/index')->with('error', $categories->message);
        }
        $categories = $categories->data;

        return view('dashboard/modules/category/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/modules/category/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validat all request values
        $requestResult = Category::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // save record
        try {
            DB::beginTransaction();
            
            $category = new Category([
                'name' => $requestResult->name,
            ]);
            $category->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Category already exist!';     
            } else {
                $message = 'Problem occured while tying to create category!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('category-list')
            ->with('success', 'Category create successfully!');
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
        // get record
        $category = Category::getCategory($id);
        if(!$category->data) {
            return back()->with('error', $category->message);
        }
        $category = $category->data;
        return view('dashboard/modules/category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get record
        $category = Category::getCategory($id);
        if(!$category->data) {
            return back()->with('error', $category->message);
        }
        $category = $category->data;

        // validat all request values
        $requestResult = Category::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // update record
        try {
            DB::beginTransaction();

            $category->name = strtolower($requestResult->name);
            $category->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Category already exist!';     
            } else {
                $message = 'Problem occured while tying to update category!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('category-list')
            ->with('success', 'Category update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get record
        $category = Category::getCategory($id);
        if(!$category->data) {
            return back()->with('error', $category->message);
        }
        $category = $category->data;

        // delete record
        try {
            $category->delete();
        } catch(Exception $ex) {
            if($ex->getCode() == "23000"){
                return back()
                    ->with('warning', 'Unable to delete this record due to 
                    [ Integrity Constraint Violation], you first need to 
                    detach all products that associated to this selected category!');
            } else {
                return back()
                    ->with('error', 'Problem while trying to delete category record!');
            }
        }
        return redirect()->route('category-list')
            ->with('success', 'Category delete successfully');
    }
}
