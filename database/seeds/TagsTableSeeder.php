<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Tin hot',
            ],
            [
                'id' => '2',
                'name' => 'PHP',
            ],
            [
                'id' => '3',
                'name' => 'Laravel',
            ],
            [
                'id' => '4',
                'name' => 'Android',
            ],
            [
                'id' => '5',
                'name' => 'Ruby',
            ],
            [
                'id' => '6',
                'name' => 'Java',
            ],  
        ];
        DB::table('tags')->insert($data);
    }
}
