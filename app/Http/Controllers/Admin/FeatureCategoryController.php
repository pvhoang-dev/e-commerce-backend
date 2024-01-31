<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateFeatureCategoryRequest;
use App\Http\Requests\Admin\UpdateFeatureCategoryRequest;
use App\Models\Feature;
use App\Models\FeatureCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();

            $featureCategory = FeatureCategory::findOrFail($id);

            $subFeatures = Feature::where('feature_category_id', $id)->first();

            if($subFeatures){
                return redirect()->back()
                    ->with('error', 'Cannot delete the feature category. It is associated with sub records.');
            }

            $featureCategory->delete();

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->back()
                    ->with('error', 'Cannot delete the feature category. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
