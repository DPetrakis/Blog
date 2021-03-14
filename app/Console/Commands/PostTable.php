<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use App\Post;

class PostTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show post table';

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
        $post= new Post;
    
        $table = $post->getTable();
    
        $columns  = Schema::getColumnListing($table);

        dd($columns);
    }
}
