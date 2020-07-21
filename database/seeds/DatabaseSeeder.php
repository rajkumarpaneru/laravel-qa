<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class, 10)->create()
            ->each(function ($user) {
                $user->questions()
                    ->saveMany(
                        factory(Question::class, rand(1, 5)))->make();

            });
    }
}
