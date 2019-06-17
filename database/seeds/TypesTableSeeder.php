<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan_types = array('Small Business Loans', 'Salary loans', 'Commercial Loans', 'Others');
        for ( $i=0; $i < 3; $i++ ) {
            DB::table('loan_types')->insert(
                [
                'name' => $loan_types[$i],
                'interest_rate' => rand(10,20),
                'insurance_fee' => rand(1000,9999),
                'other_fee' => rand(1000,9999),
                'grace_period' => rand(1, 10)
                ]
            );
        }

        $business_types = array('Agriculture', 'IT', 'Retail Trade', 'Wholesale Trade', 'Services', 'Repairs', 'Others');
        for ( $i=0; $i < count($business_types); $i++ ) {
            DB::table('business_types')->insert(
                [
                'name' => $business_types[$i],
                ]
            );
        }

    }
}
