<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostTagTableSeeder extends Seeder
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
                'post_id' => '1',
                'tag_id' => '1',
            ],
            [
                'id' => '2',
                'post_id' => '1',
                'tag_id' => '2',
            ],  
            [
                'id' => '3',
                'post_id' => '1',
                'tag_id' => '3',
            ],  
            [
                'id' => '4',
                'post_id' => '1',
                'tag_id' => '4',
            ],
            [
                'id' => '5',
                'post_id' => '2',
                'tag_id' => '5',
            ],
            [
                'id' => '6',
                'post_id' => '2',
                'tag_id' => '6',
            ],  
        ];
        DB::table('post_tag')->insert($data);
    }
}
