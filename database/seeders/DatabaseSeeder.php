<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Answer;

class DatabaseSeeder extends Seeder {
    /**
     * Create dummy date for the application
     *
     * @return void
     */
    public function run() {
        User::factory( 5 )->create();
        Poll::factory( 10 )->create();
        Question::factory( 50 )->create();
        Answer::factory( 500 )->create();
    }
}
