<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Tools;

class jsonGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateJson {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generara json base para formularios';

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
        $tabla=$this->argument('table');
         $columns = \DB::select("SHOW COLUMNS FROM $tabla");
         $json=[];
         $tools=new Tools();
         foreach($columns as $key=>$column){
             $json[$column->Field]['name']=$column->Field;
             $json[$column->Field]['placeholder']='Ingresa ' +$tools->splitAtUpperCase( $column->Field);
             $json[$column->Field]['className']='form-control';
             $json[$column->Field]['type']='text';
             $json[$column->Field]['label']=$tools->splitAtUpperCase($column->Field);
         }
         if (!file_exists('public/json')) {
            mkdir('public/json', 0777, true);
            }
         file_put_contents("public/json/$tabla.Form.json",json_encode($json));
         $this->comment('Json para formulario creado en public/json/ desde:'.$tabla);
    }
}
