<?php

use App\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class sizeCsvRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen( base_path( "database/csv/size_report.csv" ), "r" );

        $firstLine = true;

        while( ( $data = fgetcsv( $csvFile, 2000, "," ) ) !== FALSE ) {
            if (!$firstLine) {
                Size::create([
                    "name" => $data['1'],
                ]);
            }
            $firstLine = false;
        }
   
        fclose($csvFile);

    }
}
