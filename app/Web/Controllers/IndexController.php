<?php
namespace App\Web\Controllers;

use App\Base\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Base\Services\ExportExcel;

class IndexController extends Controller
{
    /**
     * 路由公共入口
     */
    public function index(Request $request)
    {
        $max = 20;
        $min = 0;
        // A-E, 50题， 1行5题
        $data = [];
        $symbolList = [
            '-', '+'
        ];
        for ($i = 1; $i <= 100; $i++) {
            $symbol = $symbolList[array_rand($symbolList)];
            if ($symbol == '-') {
                $n1 = rand(10, 20);
                $n2 = rand(1, $n1);
                $result = $n1 - $n2;
            } else {
                $n1 = rand(1, 20);
                $n2 = rand(1, 20); 
                $result = $n1 + $n2;
            }
            // 随机设置填空项
            $fill = rand(0, 2);
            $fillData = ['n1', 'n2', 'result'];
            $emptyFill = $fillData[$fill];
            $info = [
                'n1' => $n1,
                'n2' => $n2,
                'result' => $result,
                'symbol' => $symbol,
            ];
            $info[$emptyFill] = '';
            $data[] = $info;
        }
        return $this->exportExcel($data);
    }

    /** 
     * 导出
     */
    public function exportExcel($data)
    {
        $list = [];
        $columnList = [];
        foreach ($data as $val) {
            $columnList[] = ($val['n1'] === '' ? '(__)' : $val['n1']) 
            . ' ' . $val['symbol'] . ' ' 
            . ($val['n2'] === '' ? '(__)' : $val['n2'])
            . ' = ' . ($val['result'] === '' ? '(__)' : $val['result']);
            if (count($columnList) == 5) {
                $list[] = $columnList;
                $columnList = [];
            }
        }
        if (!empty($columnList)) {
            $list[] = $columnList;
        }
        $headerMap = ['','','','',''];
        //表格格式化
        $afterSheetStyle = [
            AfterSheet::class => function(AfterSheet $event) {
                // ... 此处你可以任意格式化
                //表头字体
                $cellRange = 'A1:E20';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(18);
                for ($i = 1; $i <= 20; $i++) {
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(35);
                }

                $cellRange = 'A1:E20'; // 根据需要调整范围
                $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            
            }
        ];
        return Excel::download(new ExportExcel($headerMap, $list, $afterSheetStyle),
            "exhibitors_product_".date('YmdHis').".xlsx");
    }
}
