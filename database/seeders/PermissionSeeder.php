<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = collect(['browse','create','read','update','delete']);
        $tables = collect(['users','permissions','roles']);

        $data = $tables->crossJoin($actions);

        $actions = collect(['browse','create','read','update','delete']);
        $tables = collect(['users','permissions','roles']);


        $data = $tables->crossJoin($actions);

        $dataItesm = $data->map(function($item){
            return [
                'title'=>$item[1].'_'.$item[0],
                'table_name'=>$item[0],
            ];
        });

        DB::table('permissions')->insert($dataItesm->toArray());
    }
}
