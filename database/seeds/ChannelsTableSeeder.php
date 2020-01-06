<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 5.8',
            'slug' => str_slug('Laravel 5.8'),
        ]);
        Channel::create([
            'name' => 'Vue 2.2',
            'slug' => str_slug('Vue 2.2'),
        ]);
        Channel::create([
            'name' => 'Wordpress 5',
            'slug' => str_slug('Wordpress 5'),
        ]);
        Channel::create([
            'name' => 'NodeJs 3.0.2',
            'slug' => str_slug('NodeJs 3.0.2'),
        ]);

    }
}
