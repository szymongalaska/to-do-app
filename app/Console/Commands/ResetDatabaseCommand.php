<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database and create a test user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        
        User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('test1234'),
            'email_verified_at' => now(),
        ]);

        $this->info('Database refreshed');
        return 0;
    }
}
