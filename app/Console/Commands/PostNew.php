<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;

class PostNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new post';

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
        return Post::create([
            
            'title' =>  $this->ask('Post Title:'),
            'description' => $this->ask('Post Description:'),
            'category_id' => $this->ask('Category id:'),
            'admin_id' => $this->ask('Admin Id:'),
            'breaking_news' => $this->ask('Breaking News:'),
            'tags' => $this->ask('Tags:')

        ]);
    }
}
