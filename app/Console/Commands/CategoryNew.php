<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;

class CategoryNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

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
        return Category::create([
            
            'name' =>  $this->ask('Category Title:'),
        
        ]);
    }
}
