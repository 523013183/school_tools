<?php

namespace App\Console\Commands;

use App\Api\Models\ModelModel;
use App\Api\Models\ModelParamModel;
use App\Api\Models\PromptWordModel;
use App\Api\Models\TemplateCategoryRelationModel;
use App\Base\Services\SysI18nService;
use Illuminate\Console\Command;

class postPromptCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:post_prompt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '提交提示词';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("开始 " . nowTime());
        $model = new PromptWordModel();
        $str = "";
        // SELECT b.* from templates_category_relation as a inner join templates as b on a.t_id=b.id where a.c_id=15 and b.`status`=0;
        $model2 = new TemplateCategoryRelationModel();
        $list = $model2->db("a")->selectRaw("b.*")->join("templates as b", "a.t_id", "=", "b.id")
            ->where([
                "a.c_id" => 15,
                "b.status" => 0
            ])->get()->toArray();
        $pid = 3;
        // $array = explode("\n", $str);
        $data = [];
        foreach ($list as $val) {
//            $arr = explode("「", $val);
//            $enName = trim($arr[0]);
//            $name = trim(str_replace("」", "", $arr[1]));
            $data[] = [
                "pid" => $pid,
                "name" => $val['name'],
                "en_us_name" => $val['en_us_name'],
                "pic" => $val['icon']
            ];
        }
        $model->insertAll($data);
        $this->info("结束 " . nowTime());
    }
}