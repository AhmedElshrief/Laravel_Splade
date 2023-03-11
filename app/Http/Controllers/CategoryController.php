<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Tables\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    public function index()
    {
        return view('categories.index' , 
            [
                'categories' => Categories::class,  
            ]);
        
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each
        // $request->validate($rules);
        Category::create($request->all());
        Toast::title('Category was created!')
        ->success()
        ->autoDismiss(3);
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));

    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')
         ->ignore($category->id,'category_id')]];
            // $rules += [$locale . '.content' => 'required'];
        } 
        // dd( $request->all());
        // $request->validate($rules);
        $category->update($request->all());
        Toast::title('Category was Updated!')
        ->info()
        ->autoDismiss(3);
        
        return redirect()->route('categories.index');

    }

    public function destroy(Category $category)
    {
        $category->delete();
        Toast::title('Category Deleted Successfully!')
        ->warning()
        ->autoDismiss(3);
        
        return redirect()->back();

    }
}
