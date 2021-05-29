<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Results;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CompanyResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::disk('local')->get('mock_data.json');
        $json = json_decode($file, true);

        foreach ($json as $item) {
            $results = $item['results'];
            unset($item['results']);
            $company = Company::firstOrCreate(['name' => $item['name']], $item);

            foreach ($results as $result){
                $result['company_id'] = $company->id;
                Results::firstOrCreate(['year' => $result['year'], 'company_id' => $company->id], $result);
            }
        }

    }
}
