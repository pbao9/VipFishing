<?php

namespace Database\Seeders;

use App\Models\Banks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $response = Http::get('https://api.vietqr.io/v2/banks');

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data'])) {
                $banks = $data['data'];

                foreach ($banks as $bank) {
                    Banks::create([
                        'code' => $bank['code'],
                        'name' => $bank['name'],
                        'logo' => $bank['logo'],
                        'shortname' => $bank['shortName'],
                    ]);
                }

                $this->command->info('Bank data seeded successfully!');
            } else {
                $this->command->error('Unexpected API response structure.');
            }
        } else {
            $this->command->error('Failed to fetch bank data from the API.');
        }
    }
}
