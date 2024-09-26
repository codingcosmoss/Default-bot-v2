<?php

namespace App\Console\Commands;

use Database\Seeders\PasswordResetSeeder;
use Illuminate\Console\Command;

class ResetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset system admin user password';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Running PasswordResetSeeder...');

        // Seeder-ni ishga tushirish
        $seeder = new PasswordResetSeeder();
        $seeder->run();

        $this->info('ResetPasswordSeeder completed successfully.' . PHP_EOL .
            'Login: admin' . PHP_EOL .
            'Password: 12345678adc');
    }
}
