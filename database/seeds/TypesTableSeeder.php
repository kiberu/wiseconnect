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
      $loan_types = array('Business', 'Salary Loan', 'Progressive Loan');
      for ( $i=0; $i < 3; $i++ ) {
        DB::table('loan_types')->insert([
          'name' => $loan_types[$i],
        ]);
      }

      $business_types = array('Agriculture', 'IT', 'Trade', 'Retail');
      for ( $i=0; $i < 4; $i++ ) {
        DB::table('business_types')->insert([
          'name' => $business_types[$i],
        ]);
      }

    }
}
