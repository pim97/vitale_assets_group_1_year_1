<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Category;
use DB;

/**
 * Class CategoriesController
 * @package App\Http\Controllers
 * @author Nathanael Baaij
 */
class CategoriesController extends Controller
{
    /**
     * Get all the main categories to the categories.index page
     * wcalith sortable options and pagination of maximum 20 per page
     * index also checks and acts on filter options
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //if the request has filter and the filter is active on only showing main/head categories
        if (request()->has('f') && request('f') == 'main') {
            $categories = Category::with('assets')->whereNull('parent_id')
                ->sortable()->paginate(20)->appends('filter', request('filter'));
        } else {
            $categories = Category::with('assets')->sortable()->paginate(20);
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * show the relevant category by id with optional parent category and optional children category
     * the children are listed in a table that is sortable
     * return a show view with the given data
     * @param $id category id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $category = Category::with('children')->with('parent')->find($id);
        $assets = Asset::all()->where('category_id', $id);

        return view('categories.show', [
            'category' => $category,
            'assets' => $assets
        ]);
    }

    /**
     * return the category create view with all the categories from the database sorted on asc order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::getAllCategories('asc')->get();
        return view('categories.create', compact('categories'));
    }

    /**
     * validate the data from the from, save it to the database and redirect the user back
     * to the categories.index with a success flash message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:categories|min:3|max:255',
            'description' => 'max:1024',
            'threshold' => 'nullable|numeric',
        ]);

//        dd((double)request('threshold'));

        Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'threshold' => (double)request('threshold'),
            'parent_id' => request('parent_id'),
        ]);

        session()->flash('message', 'Asset categorie "' . request('name') . '" is aangemaakt.');
        return redirect('/categories');
    }

    /**
     * Find the relevant category by id with all the categories in the database ordered by asc except the current one
     * return a edit view with the data
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parentCategories = Category::exceptGivenId($id)->orderBy('name', 'asc')->get();

        return view('categories.edit', [
            'category' => $category,
            'parentCategories' => $parentCategories,
        ]);
    }

    /**
     * validate the form data, get the relevant category by id and update it
     * redirect user back to the categories.index with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => [
                'required',
                Rule::unique('categories')->ignore($id),
                'min:3',
                'max:255',
            ],
            'description' => 'max:1024',
            'threshold' => 'nullable|numeric',
        ]);

        $category = Category::find($id);

        $category->update([
            'name' => request('name'),
            'description' => request('description'),
            'threshold' => (double)request('threshold'),
            'parent_id' => (request('parent_id') == '' ? null : request('parent_id')),
        ]);

        session()->flash('message', 'Asset categorie "' . request('name') . '" is gewijzigd.');
        return redirect('/categories');
    }

    /**
     * return the delete category view with the relevant category
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Category $category)
    {
        return view('categories.delete', compact('category'));
    }

    /**
     * Checks if category exists if so it gets deleted and
     * the user will be redirected back to the category.index
     * with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::with('children')->findOrFail($id);
        $categoryName = $category->name;

        //Check if category is filled with one or more assets.
        $assets = DB::table('assets')->where('category_id', '=', $category->id);

        //Count the results, 1 of more is true 0 is false
        if ($amountOfAssets = $assets->count()) {
            return redirect()->route('categories.delete', ['id' => $category->id])
                ->with('errors', 'Categorie is nog gevuld met ' . $amountOfAssets . ' asset(s).');
        }

        //Check if the category has subcategories
        if ($amountOfSubCat = $category->children->count()) {
            return redirect()->route('categories.delete', ['id' => $category->id])
                ->with('errors', 'Categorie is nog gekoppeld aan ' . $amountOfSubCat . ' subcategorie(ën).');
        }

        $category->delete();
        session()->flash('message', 'Asset categorie "' . $categoryName . '" is verwijderd.');
        return redirect('/categories');
    }

    /**
     * this method searches categories in the database and returns json
     * if it can't find what the user wants it returns all the categories.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        //Trims the search request
        $searchTerm = trim(preg_replace('/\s/', '', $request->search));
        //Check if the search request is ajax call and isn't whitespaces of spaces
        if ($request->ajax() && $searchTerm !== '') {
            $categories = DB::table('categories')
                //->whereNull('parent_id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
                })
                ->paginate(20);
        } else {
            //If it cant find anything it will return all the categories
            $categories = DB::table('categories')->paginate(20);
        }

        //return result in json for ajaxcall
        return response()->json($categories);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getThresholdByAssetId(Request $request)
    {
        $categoryId = $request->categoryId;
        $category = Category::find($categoryId);
        return $category;
    }
}
