<?php

use Illuminate\Database\Migrations\Migration;

class ConvertExistingTablesToInnodb extends Migration
{
    protected $tables = [
        'users',
        'visitors',
        'meetings',
        'delivers',
        'delivertype',
        'drops',
        'lostitems',
        'securities',
        'meeting_user',
        'meeting_visitor',
    ];

    public function up()
    {
        foreach ($this->tables as $table) {
            DB::statement("ALTER TABLE `{$table}` ENGINE=InnoDB");
        }
    }

    public function down()
    {
        foreach ($this->tables as $table) {
            DB::statement("ALTER TABLE `{$table}` ENGINE=MyISAM");
        }
    }
}
