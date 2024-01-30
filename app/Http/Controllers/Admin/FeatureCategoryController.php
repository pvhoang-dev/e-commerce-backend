<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateFeatureCategoryRequest;
use App\Http\Requests\Admin\UpdateFeatureCategoryRequest;
use App\Models\FeatureCategory;
use Illuminate\Http\Request;

class FeatureCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = FeatureCategory::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $featureCategories = $query->paginate(10);

        $featureCategoriesPreview = FeatureCategory::all();

        return view('admin.product_features.index', [
            'featureCategories' => $featureCategories,
            'featureCategoriesPreview' => $featureCategoriesPreview,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.product_features.create');
    }

    public function store(CreateFeatureCategoryRequest $request)
    {
        $input = $request->all();

        $featureCategories = FeatureCategory::create($input);

        return redirect()->route('admin.feature_categories.edit', [
            'id' => $featureCategories->id
        ]);
    }

    public function edit($id)
    {
        $featureCategory = FeatureCategory::findOrFail($id);

        return view('admin.product_features.edit', [
            'featureCategory' => $featureCategory,
        ]);
    }

    public function update(UpdateFeatureCategoryRequest $request, $id)
    {
        $featureCategory = FeatureCategory::findOrFail($id);

        $input = $request->all();

        $featureCategory->update($input);

        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $attribute = FeatureCategory::findOrFail($id);
            $attribute->delete();

            return redirect()->route('admin.feature_categories.index');
        } catch (\Exception $e) {
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.feature_categories.index')
                    ->with('error', 'Cannot delete the attribute. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
