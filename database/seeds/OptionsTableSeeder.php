<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array( 'Application Fees', 'Loan Processing Fees', 'Insurance Fees', 'Appraisal Fees', 'Miscellaneous Fees');
        for ( $i=0; $i < count($names); $i++ ) {
            DB::table('options')->insert(
                [
                'name' => $names[$i],
                'value' => rand(30000, 1000000),
                ]
            );
        }
    }
}
