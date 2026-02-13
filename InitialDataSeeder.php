<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Speaker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = User::factory(5)->create();
       $speakers = Speaker::factory(10)->create();
       $participants = Participant::factory(20)->create();
       $events=Event::factory(10)->create();
    }
}
