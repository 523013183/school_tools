<?php

namespace App\Console;

use App\Api\Services\TaskService;
use App\Base\Services\SysI18nService;
use App\Console\Commands\CacheCommand;
use App\Console\Commands\getPromptsCommand;
use App\Console\Commands\InitModelCommand;
use App\Console\Commands\InitModelParamsCommand;
use App\Console\Commands\MakeDocCommand;
use App\Console\Commands\postPromptCommand;
use App\Console\Commands\updateParamsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CacheCommand::class,
        MakeDocCommand::class,
        InitModelCommand::class,
        InitModelParamsCommand::class,
        getPromptsCommand::class,
        updateParamsCommand::class,
        postPromptCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $i18nService = app()->make(SysI18nService::class);
        $i18nService->autoTransTables();
        return;
        // 执行chatgpt任务
        $schedule->call(function () {
            $gptTask = app()->make(TaskService::class);
            $gptTask->runTask();
        })->everyMinute()->name('runTask')
            ->runInBackground()
            ->withoutOverlapping(600);
    }
}
