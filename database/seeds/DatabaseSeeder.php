<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tag::class, 40)->create();
        factory(App\Models\Category::class, 40)->create();
        factory(App\Models\Level::class, 3)->create();
        factory(App\User::class, 100)->create()->each(function ($user){
            $profile = $user->profile()->save(factory(App\Models\Profile::class)->make());
            $profile->location()->save(factory(App\Models\Location::class)->make());
            $profile->categories()->attach($this->array(rand(1, 3)));
            $profile->tags()->attach($this->array(rand(1, 7)));

            $number_comments = rand(1, 20);
            for ($i = 0; $i < $number_comments; $i++) {
                $user->comments()->save(factory(App\Models\Comment::class)->make());
            }
        });

        factory(App\Models\Task::class, 100)->create()->each(function ($task){
            $task->tags()->attach($this->array(rand(1, 30)));
            $number_offers = rand(1, 40);
            for ($i = 0; $i < $number_offers; $i++) {
                $task->offers()->save(factory(App\Models\Offer::class)->make());
            }
        });

        factory(App\Models\Advisory::class, 100)->create()->each(function ($advisory){
            $advisory->tags()->attach($this->array(rand(1, 30)));
            $number_offers = rand(1, 40);
            for ($i = 0; $i < $number_offers; $i++) {
                $advisory->offers()->save(factory(App\Models\Offer::class)->make());
            }
        });

        factory(App\User::class)->create([
            'name'              => 'Dante',
            'email'             => 'dante@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'admin123',
            'remember_token'    => Str::random(10),
            'birthday'          => Carbon::parse('26.12.1993'),
            'gender'            => 0,
            'mobile'            => '3123036763',
            'active'            => 0,
            'admin'             => 0,
        ]);

        $dante = \App\User::find(101);
        $dante->profile()->save(factory(App\Models\Profile::class)->make());
        $dante->profile->location()->save(factory(App\Models\Location::class)->make());


    }

    public function array($max)
    {
        $values = [];

        for ($i = 1; $i < $max; $i++) {
            $values[] = $i;
        }

        return $values;
    }
}
