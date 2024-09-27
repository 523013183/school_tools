<?php

namespace App\Console\Commands;

use App\Api\Models\TemplateParamModel;
use Illuminate\Console\Command;

class updateParamsCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:updateParams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更改模版参数';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("开始 " . nowTime());
        $model = new TemplateParamModel();
        $list = $model->db()->selectRaw("id,description,zh_cn_description,en_us_description")
            ->where("t_id", ">", 62)
            ->where("t_id", "<", 70)
            ->whereRaw("description like '%“火锅酱料制造”%'")
            ->get()->toArray();
        foreach ($list as $val) {
            $description = str_replace("“火锅酱料制造”", "【火锅底料制造商】", $val['description']);
            $en_us_description = str_replace("【hot pot sauce manufacture】", "【hot pot sauce base manufacturer】", $val['en_us_description']);
            $model->updateData([
                'description' => $description,
                'zh_cn_description' => $description,
                'en_us_description' => $en_us_description,
            ], [
                "id" => $val['id']
            ]);
        }
        $this->info("结束 " . nowTime());
    }
}