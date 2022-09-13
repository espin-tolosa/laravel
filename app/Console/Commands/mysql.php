<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class mysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:createdb {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mysql database using the schema of .env';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schema = $this->argument('name') ?: config('database.connections.mysql.database');
        
        
		$charset = config("database.connections.mysql.charset",'utf8mb4');	
		$collation = config('database.connections.mysql.collation','utf8mb4_unicode');
        
		$query = "CREATE DATABASE IF NOT EXISTS $schema CHARACTER SET $charset COLLATE $collation;";
        
        $this->muteConfigSchema();
        DB::statement($query) && print("Done: $query");
    }

    /**
     * Mutes the config database name at run-time to avoid DB:statement run internally the command "USE schema"
     */

	private function muteConfigSchema()
	{
		config(["database.connections.mysql.database" => null]);
	}
}
