<?php

namespace App\Console\Commands;

use App\Api\Models\ModelModel;
use App\Api\Models\ModelParamModel;
use App\Api\Models\TemplateCategoryRelationModel;
use App\Api\Models\TemplateParamModel;
use App\Api\Models\TemplatesModel;
use Illuminate\Console\Command;

class InitModelParamsCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:initModelParams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化chatgpt模型参数';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("开始 " . nowTime());
        // $this->updateDes();
        return;
//        $this->copyParams();
//        return;
        //`t_id`, `pid`, `name`, `zh_cn_name`, `en_us_name`, `description`, `zh_cn_description`, `en_us_description`, `command`, `type`, `required`,
        $tid = 69;
        $pid = 722;
        $names = [
            '公司页面招聘摘要',
            '招聘文案'
        ];
        $enNames = [
            'Recruit summary for company page',
            'Recruitment copywriting'
        ];
        $description = [
            '公司页面的招聘摘要,包含 [50] 个单词以吸引 [3] 个样本',
            '描述[职位]的招聘标题及其描述'
        ];
        $enDescription = [
            'Recruit summary for company page for [50] words to attract with [3] samples',
            'Describe the recruit headline and its description for [job]'
        ];
        $paramModel = new TemplateParamModel();
        foreach ($names as $key => $v) {
            $data = [
                't_id' => $tid,
                'pid' => $pid,
                'name' => $v,
                'zh_cn_name' => $v,
                'en_us_name' => $enNames[$key],
                'description' => $description[$key],
                'zh_cn_description' => $description[$key],
                'en_us_description' => $enDescription[$key],
                'command' => '',
                'type' => 'checkbox',
                'required' => 0,
            ];
            $paramModel->insertData($data);
        }

        $this->info("结束 " . nowTime());
    }

    /** 复制参数 */
    public function copyParams()
    {
        $tid = 63; // 来源
        $toTid = 69; // 目标
        $paramModel = new TemplateParamModel();
        $list = $paramModel->findBy([
            't_id' => $tid,
            'pid' => 0
        ]);
        foreach ($list as $val) {
            $data = $val;
            unset($data['id']);
            $data['t_id'] = $toTid;
            $pid = $paramModel->insertData($data);

            $pList = $paramModel->findBy([
                't_id' => $tid,
                'pid' => $val['id']
            ]);
            foreach ($pList as $v) {
                $dataC = $v;
                unset($dataC['id']);
                $dataC['t_id'] = $toTid;
                $dataC['pid'] = $pid;
                $paramModel->insertData($dataC);
            }
        }

    }

    public function insertImageTemp()
    {
        $name = [
        ];
        $enName = [
        ];
        $des = [
        ];
        $enDes = [
        ];
        $paramDes = [
        ];
        $enParamDes = [
        ];
        $model = new TemplatesModel();
        $paramModel = new TemplateParamModel();
        $rModel = new TemplateCategoryRelationModel();
        foreach ($enName as $key => $val) {
            // 判断是否重复
            $info = $model->findOneBy([
                'en_us_name' => $val,
                'status' => 0,
                'type' => 3
            ], 'id');
            if (!empty($info['id'])) {
                continue;
            }
            $tempData = [
                'name' => $name[$key],
                'zh_cn_name' => $name[$key],
                'en_us_name' => $val,
                'description' => $des[$key],
                'zh_cn_description' => $des[$key],
                'en_us_description' => $enDes[$key],
                'icon' => '',
                'type' => 3,
                'command' => "{$enDes[$key]},Please create a picture in {$val} style,The image description is:"
            ];
            $tId = $model->insertData($tempData);

            $data = [
                't_id' => $tId,
                'pid' => 0,
                'name' => '描述',
                'zh_cn_name' => '描述',
                'en_us_name' => 'Description',
                'description' => empty($paramDes[$key]) ? '描述您想要创建的内容' : $paramDes[$key],
                'zh_cn_description' => empty($paramDes[$key]) ? '描述您想要创建的内容' : $paramDes[$key],
                'en_us_description' => empty($enParamDes[$key]) ? 'Describe what you want to create' : $enParamDes[$key],
                'command' => '',
                'type' => 'textarea',
                'required' => 0,
            ];
            $paramModel->insertData($data);

            $data = [
                'c_id' => 15,
                't_id' => $tId
            ];
            $rModel->insertData($data);
        }
    }

    public function updateDes()
    {
        //SELECT * from template_param where type='checkbox';
        $model = new TemplateParamModel();
        $list = $model->findBy([
            'type' => 'checkbox'
        ], 'id,description,zh_cn_description,en_us_description');
        foreach ($list as $val) {
            if (empty($val['description'])) {
                continue;
            }
            $des = str_replace('[', '【', $val['description']);
            $des = str_replace(']', '】', $des);

            $zhdes = str_replace('[', '【', $val['zh_cn_description']);
            $zhdes = str_replace(']', '】', $zhdes);

            $endes = str_replace('[', '【', $val['en_us_description']);
            $endes = str_replace(']', '】', $endes);
            $model->updateData([
                'description' => $des,
                'zh_cn_description' => $zhdes,
                'en_us_description' => $endes
            ], [
                'id' => $val['id']
            ]);
        }
    }
}