<?php

namespace App\Console\Commands;

use App\Api\Models\ModelModel;
use App\Api\Models\ModelParamModel;
use App\Base\Services\SysI18nService;
use Illuminate\Console\Command;

class getPromptsCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:get_prompts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取prompts';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 设置key
        $commands = json_decode(file_get_contents(base_path('resources') . "/data/commands.json"), true);
        foreach ($commands as &$val) {
            foreach ($val['prompts'] as &$p) {
                $p['key'] = createGuid();
            }
        }
        \Log::info(json_encode($commands, JSON_UNESCAPED_UNICODE));
        return;
        $s = new SysI18nService();
        $s->autoMachineTrans();
        return;
        $this->info("开始 " . nowTime());

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://proof.notion.site/api/v3/queryCollection?src=reset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "source": {
        "type": "collection",
        "id": "1b8a7172-588f-4655-b719-f063e57e83d3",
        "spaceId": "1dac9fb6-3cf4-4af3-a488-7c6118bfafcd"
    },
    "collectionView": {
        "id": "18dd8a90-ce6b-430c-bc1a-b357e1a38590",
        "spaceId": "1dac9fb6-3cf4-4af3-a488-7c6118bfafcd"
    },
    "loader": {
        "type": "reducer",
        "reducers": {
            "collection_group_results": {
                "type": "results",
                "limit": 200
            }
        },
        "sort": [
            {
                "property": "aOqo",
                "direction": "ascending"
            }
        ],
        "searchQuery": "",
        "userTimeZone": "Asia/Shanghai"
    }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: __cf_bm=2HHfMunJNdLTQitwxiNSLZohJVvhggtvYfE7GrbH.Xs-1690185711-0-AdF0ps9EMmj9lc0YnMLtMdwiA/4OebERf95TUHymfq8Qw5UROe524FFqP85y3bm4arWvXeUPZWSSpYdmSSR2yQQ=; notion_browser_id=21328135-6d8e-4901-be17-dbbfdf5fe863; notion_check_cookie_consent=false'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $ret = json_decode($response, true);
        $recordMap = $ret['recordMap']['block'];
        $list = [];
        foreach ($recordMap as $key => $block) {
            if ($block['value']['type'] != 'page' || empty($block['value']['properties']['aOqo'][0][0]) || empty($block['value']['properties']['title'][0][0])) {
                continue;
            }
            $list[] = [
                'tag' => $block['value']['properties']['aOqo'][0][0],
                'title' => $block['value']['properties']['title'][0][0],
                'icon' => $block['value']['format']['page_icon'],
                'prompts' => $this->getPrompts($key)
            ];
        }
        $list = json_encode($list, JSON_UNESCAPED_UNICODE);
        \Log::info($list);
        $this->info("结束 " . nowTime());
    }

    public function getPrompts($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://proof.notion.site/api/v3/loadCachedPageChunk',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"page":{"id":"'.$id.'"},"limit":30,"cursor":{"stack":[]},"chunkNumber":0,"verticalColumns":false}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: __cf_bm=har0WpevFHQlMdLLmrWI.Rdr8q4MICJnLL7qaHMFGqM-1690186763-0-AUEEmChoxp/u2q2Pu46yCgHZ4U2SelkydKOi52HMW9GH4JOzq/CFAX6m8BYAHNH7Wz7XbvciILgojTABWmvWbmo=; notion_browser_id=21328135-6d8e-4901-be17-dbbfdf5fe863; notion_check_cookie_consent=false'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        $data = $response['recordMap']['block'];
        $list = [];
        foreach ($data as $value) {
            if (empty($value['value']['type']) || $value['value']['type'] != 'code') {
                continue;
            }
            $list[] = trim($value['value']['properties']['title'][0][0], '"');
        }
        return $list;
    }
}