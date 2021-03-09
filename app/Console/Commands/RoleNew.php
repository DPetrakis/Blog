<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Role;

class RoleNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new role';

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
        return Role::create([
            
            'title' =>  $this->ask('Role Title:'),
        
        ]);
    }
}
