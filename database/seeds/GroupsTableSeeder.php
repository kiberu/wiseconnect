<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = factory(App\Models\Clients\Group::class, 5)
            ->create()
            ->each(
                function ($group) {
                            $group->clients()->save(factory(App\Models\Clients\Client::class)->make());
                            $group->clients()->save(factory(App\Models\Clients\Client::class)->make());
                            $group->clients()->save(factory(App\Models\Clients\Client::class)->make());
                            $group->clients()->save(factory(App\Models\Clients\Client::class)->make());
                            $group->clients()->save(factory(App\Models\Clients\Client::class)->make());
                }
            );
    }
}
