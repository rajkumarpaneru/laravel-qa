<?php

use App\Answer;
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
        factory(User::class, 5)->create()
            ->each(function ($user) {
                $user->questions()->saveMany(
                    factory(Question::class, rand(1, 5))->make())
                    ->each(function ($question) {
                        $question->answers()->saveMany(factory(Answer::class, rand(1, 5))->make());
                    });
            });
    }
}
