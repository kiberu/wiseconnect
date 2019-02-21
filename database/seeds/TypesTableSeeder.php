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
      $names = array('Business', 'Salary Loan', 'Progressive Loan');
      for ( $i=0; $i < 3; $i++ ) {
        DB::table('types')->insert([
          'name' => $names[$i],
        ]);
      }

    }
}
