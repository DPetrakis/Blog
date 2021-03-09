<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new link';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return Admin::create([
            'name' =>  $this->ask('Admin Name:'),
            'email' => $this->ask('Admin Email:'),
            'password' => Hash::make( $this->ask('Admin Password:')),
            'api_token' => Str::random(60),
            'role_id' => 1
        ]);
    }
}
