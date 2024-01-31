<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Nette\Utils\in;

class FeatureController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $feature = Feature::create([
            'feature_category_id' => $input['feature_category_id'],
            'name' => $input['feature_name'],
            'position' => $input['feature_position'] ?? 999,
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        $feature = Feature::find($id);

        return response()->json($feature);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $feature = Feature::findOrFail($input['edit_feature_id']);

        $feature->update([
            'name' => $input['edit_feature_name'],
            'position' => $input['edit_feature_position'] ?? 999,
        ]);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $feature = Feature::findOrFail($id);

            $feature->delete();

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->back()
                    ->with('error', 'Cannot delete the feature. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
