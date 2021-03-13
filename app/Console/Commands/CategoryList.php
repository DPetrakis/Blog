<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;

class CategoryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get category list';

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
        $headers = [ 'id', 'name'];
        $categories = Category::all(['id', 'name'])->toArray();
        $this->table($headers, $categories);

        return 0;
    }
}
