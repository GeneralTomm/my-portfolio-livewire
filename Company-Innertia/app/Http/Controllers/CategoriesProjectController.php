<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesProject;
use Illuminate\Support\Facades\Validator;

class CategoriesProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CategoriesProject::latest()->get();
        return Inertia::render(
            'CategoriesProject/Index',
            [
                'data'   => $data,
            ]
        );
    }

    public function store(Request $request)
    {
        // Validator::make($request->all(), [
        //     'name_categories' => ['required'],
        // ])->validate();
        $categories = $request->validate([
            'name_categories'   => 'required'
        ]);

        $categories = CategoriesProject::create(
            [
                'name_categories' => $request->name_categories,
                'slug'  => Str::slug($request->name_categories)

            ]
        );
        return redirect()->back()
            ->with('message', 'Categories Created Successfully!');
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name_categories' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            CategoriesProject::find($request->input('id'))->update(
                [
                    'name_categories'  => $request->name_categories,
                    'slug'  => Str::slug($request->name_categories)
                ]
            );
            return redirect()->back()
                ->with('message', 'Post Updated Successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $request->has('id') ?
            CategoriesProject::find($request->input('id'))->delete() :
            redirect()->back()
            ->with('errors', 'Somethings goes wrong.');

        return redirect()->back()
            ->with('message', 'Article deleted successfully.');
    }
}
