<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Character;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadDataTest extends TestCase
{
    /**
     * A basic feature test example.
     * Per info, leggere app\Console\Commands\DownloadDataCommand.php
     *
     * @return void
     */
    public function test_command_download_data()
    {
        $this->artisan('download:data')->assertSuccessful();

        $character = Character::inRandomOrder()->first();

        $this->assertTrue($character->films()->count() > 0);
    }
}
