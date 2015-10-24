<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TakkenSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Takken_info')->insert([
            [
                'Title' => 'De Kapoenen',
                'Sub_title' => 'van 6 tot 8 jaar',
                'URI_fragment' => 'kapoenen',
                'created_at' => new DateTime()
            ],
            [
                'Title' => 'De Welpen',
                'Sub_title' => 'van 8 tot ... jaar',
                'URI_fragment' => 'welpen',
                'created_at' => new DateTime()
            ],
            [
                'Title' => 'De Jong-givers',
                'Sub_title' => 'van ... tot ... jaar',
                'URI_fragment' => 'jong-givers',
                'created_at' => new DateTime()
            ],
            [
                'Title' => 'De Givers',
                'Sub_title' => 'van ... tot ... jaar',
                'URI_fragment' => 'givers',
                'created_at' => new DateTime()
            ],
            [
                'Title' => 'De Jins',
                'Sub_title' => 'van ... tot ... jaar',
                'URI_fragment' => 'jins',
                'created_at' => new DateTime()
            ],
            [
                'Title' => 'De Leiding',
                'Sub_title' => 'van ... tot ... jaar',
                'URI_fragment' => 'leiding',
                'created_at' => new DateTime()
            ]
        ]);
    }
}
