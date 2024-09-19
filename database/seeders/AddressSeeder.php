<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Fetch the JSON data
            $response = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
            $data = $response->json();

            DB::beginTransaction(); // Start a database transaction

            // Insert data into the provinces, districts, and wards tables
            foreach ($data as $province) {
                if (!isset($province['Name']) || !isset($province['Id'])) {
                    Log::error('Missing "Name" or "Id" key in province data: ' . json_encode($province));
                    continue; // Skip this province if "Name" or "Id" is not set
                }

                // Insert into provinces table
                $provinceId = DB::table('provinces')->insertGetId([
                    'id' => $province['Id'],
                    'name' => $province['Name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($province['Districts'] as $district) {
                    if (!isset($district['Name']) || !isset($district['Id'])) {
                        Log::error('Missing "Name" or "Id" key in district data: ' . json_encode($district));
                        continue; // Skip this district if "Name" or "Id" is not set
                    }

                    // Insert into districts table
                    $districtId = DB::table('districts')->insertGetId([
                        'id' => $district['Id'],
                        'name' => $district['Name'],
                        'province_id' => $provinceId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($district['Wards'] as $ward) {
                        if (!isset($ward['Name'])) {
                            Log::error('Missing "Name" key in ward data: ' . json_encode($ward));
                            $ward['Name'] = 'Unknown Ward'; // Default value for missing 'Name'
                        }
                        if (!isset($ward['Level'])) {
                            Log::error('Missing "Level" key in ward data: ' . json_encode($ward));
                            $ward['Level'] = 'Unknown Level'; // Default value for missing 'Level'
                        }
                        if (!isset($ward['Id'])) {
                            Log::error('Missing "Id" key in ward data: ' . json_encode($ward));
                            continue; // Skip this ward if "Id" is not set
                        }

                        // Insert into wards table
                        DB::table('wards')->insert([
                            'id' => $ward['Id'],
                            'name' => $ward['Name'],
                            'district_id' => $districtId,
                            'level' => $ward['Level'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            DB::commit(); // Commit the transaction if all is well
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction in case of error
            // Log the error message
            Log::error('Error inserting data: ' . $e->getMessage());
        }
    }


}
