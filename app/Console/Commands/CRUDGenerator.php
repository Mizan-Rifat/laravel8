<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class CRUDGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator
    {data* : Class (singular) for example User}';

    protected $description = 'Create CRUD operations';

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
     * @return int
     */
    public function handle()
    {
        
        $data = $this->argument('data');

        // $this->addPermissions($data['table']['name']);
        // $this->migration($data['table']);
        // $this->model($data['model_name']);
        $this->controller($data['model_name']);
        // $this->routes($data['model_name']);
        $this->formRequest($data['model_name']);

        // $this->adminView($data['model_name']);
        
    }


    public function adminView($model_name){
        $path = base_path().'/resources/views/admin/'. strtolower(Str::plural($model_name));
        File::makeDirectory($path, $mode = 0777, true, true);
        
        $indexTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralUcCase}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $model_name,
                ucwords(Str::plural($model_name)),
                strtolower(Str::plural($model_name)),
                strtolower($model_name)
            ],
            $this->getStub('IndexView')
        );

        file_put_contents(base_path("/resources/views/admin/".strtolower(Str::plural($model_name))."/index.blade.php"),$indexTemplate);



        $showTemplate = str_replace(
            [
                '{{modelNamePluralUcCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                ucwords(Str::plural($model_name)),
                strtolower($model_name),
                strtolower(Str::plural($model_name))
            ],
            $this->getStub('ShowView')
        );

        file_put_contents(base_path("/resources/views/admin/".strtolower(Str::plural($model_name))."/show.blade.php"),$showTemplate);



        $addEditTemplate = str_replace(
            [
                '{{modelNamePluralUcCase}}',
                '{{modelNameSingularlowerCase}}',
                '{{modelNameSingularUcCase}}',
            ],
            [
                ucwords(Str::plural($model_name)),
                strtolower($model_name),
                ucwords(strtolower($model_name)),
            ],
            $this->getStub('AddEditView')
        );

        file_put_contents(base_path("/resources/views/admin/".strtolower(Str::plural($model_name))."/add-edit.blade.php"),$addEditTemplate);
    }

    public function addPermissions($tableName){
        $actions = collect(['browse','create','read','update','delete']);

        $permissions = $actions->map(function($itme) use($tableName){
            return [
                'title'=>$itme.'_'.$tableName,
                'table_name'=>$tableName

            ];
        });

        DB::table('permissions')
        ->insert($permissions->toArray());

    }

    public function routes($name){
        
        $verbs=[
                'index'=>'get',
                'create'=>'get',
                'show'=>'get',
                'edit'=>'get',
                'destroy'=>'get',
                'store'=>'post',
                'update'=>'post',
                'bulkdestroy'=>'post'
            ];

        $routes ="Route::group(['prefix'=>'".strtolower($name)."'],function(){\n";

        foreach ($verbs as $key => $verb) {
            $routes = $routes."\tRoute::".$verb."('/".$key."', [App\\Http\\Controllers\\".ucwords($name)."Controller::class, '".$verb."'])->name('".Str::plural(strtolower($name)).".".$key."');\n";
        }

        $routes = $routes."});";

        File::append(base_path('routes/web.php'), $routes);

    }


    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    public function migration($table){

        $tableCollection = collect($table);

        $columns = $tableCollection['columns'];

        $columnsTemp='';
        if($tableCollection['id']){
            $columnsTemp = '$table->id();';
        }

        foreach ($columns as $key => $column) {

            $columnsTemp = $columnsTemp."\n"."$"."table->".$column['type']."('".$column['name']."');";

            if($column['nullable'] == 'true'){
                $columnsTemp = substr($columnsTemp, 0, -1);
                $columnsTemp = $columnsTemp."->nullable();";
            }
            if($column['default'] != null){
                
                $columnsTemp = substr($columnsTemp, 0, -1);
                $columnsTemp = $columnsTemp."->default(".$column['default'].");";
            }
        }

        if($tableCollection['timestamps']){
            $columnsTemp = $columnsTemp."\n"."$"."table->timestamps();";
        }
        

        
        $migrationTemplate = str_replace(
            [
                '{{camelCaseTableName}}',
                '{{tableName}}',
                '{{columns}}'
            ],
            [
                $this->camelize($tableCollection['name']),
                $tableCollection['name'],
                $columnsTemp
            ],
            $this->getStub('Migration')
        );

        file_put_contents(base_path("/database/migrations/".Carbon::now()->format('Y_m_d_u')."_create_{$tableCollection['name']}_table.php"), $migrationTemplate);
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }
    protected function formRequest($name)
    {
        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                $name,
                pluralDatatype($name),

            ],
            $this->getStub('RequestView')
        );

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }
    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                pluralDatatype($name),
                singularDatatype($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }


    function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
