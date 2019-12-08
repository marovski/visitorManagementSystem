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
    protected $signature = 'mysql:createdb {name} {--delete= : Drop Table}';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mysql database schema based on the database config file';

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
        $option=$this->options('delete');
      
         if (!empty($option)){
            echo "Array is empty"; 
            $this->createDatabase();
         }
      else {
          # code...
          echo "Array is not empty"; 
          $this->deleteDb();
      }


     

    }

    private function createDatabase(){
        $schemaName = $this->argument('name') ?: config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');
        $engine= config("database.connections.mysql.engine","MyISAM");

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";

        DB::statement($query);

        config(["database.connections.mysql.database" => $schemaName]);

    }

    private function deleteDb(){
        $schemaName = $this->argument('name') ?: config("database.connections.mysql.database");
  

        config(["database.connections.mysql.database" => null]);

        $query = "DROP SCHEMA $schemaName;";

        DB::statement($query);

        config(["database.connections.mysql.database" => $schemaName]);

    }
}
