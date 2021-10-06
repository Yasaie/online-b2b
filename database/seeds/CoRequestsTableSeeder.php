<?php

use App\CoRequest;
use Illuminate\Database\Seeder;

class CoRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoRequest::create([
            'product_id' => 1,
            'user_id' => 2,
            'description' => 'سلام من اینو میخوام',
        ]);
    }
}
