<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    public function index()
    {
        return view('admin.locations.index');
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $jsonProvinceFilePath = public_path('locations/index.json');

            $jsonProvinceData = file_get_contents($jsonProvinceFilePath);

            $dataProvinceArray = json_decode($jsonProvinceData, true);

            $position = 1;

            foreach ($dataProvinceArray as $provinceKey => $provinceValue) {
                $province = new Province();
                $province->name = $provinceKey;
                $province->code = $provinceValue['code'];
                $province->position = $position;
                $position++;
                $province->save();

                $jsonDistrictFilePath = public_path('locations/data/' . $provinceValue['code'] . '.json');

                $jsonDistrictData = file_get_contents($jsonDistrictFilePath);

                $dataDistrictArray = json_decode($jsonDistrictData, true);

                foreach ($dataDistrictArray['district'] as $districtData) {
                    $district = new District();
                    $district->province_id = $province->id;
                    $district->name = $districtData['pre'] . ' ' . $districtData['name'];

                    $district->save();

                    foreach ($districtData['ward'] as $wardData) {
                        $ward = new Ward();
                        $ward->district_id = $district->id;
                        $ward->name = $wardData['pre'] . ' ' . $wardData['name'];

                        $ward->save();
                    }
                }
            }

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->back()
                    ->with('error', 'Something was wrong!!!');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
