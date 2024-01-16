<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->getOutput()->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}
