<?php


namespace App\Console\Commands;

use App\Doc\Services\DocService;
use Illuminate\Console\Command;

class MakeDocCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:doc {module?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自动生成api文档';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $module = $this->argument('module');
        $service = app()->make(DocService::class);
        $path = $module ? base_path('app').'/'.$module : base_path('app');
        $service->make($path);
//        exec('cd public/document && npm run build');
        echo 'api document create successful.'.PHP_EOL;
    }
}
