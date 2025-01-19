<?php
namespace App\Web\Controllers;

use App\Base\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Base\Services\ExportExcel;
use App\Mathematics\Services\IndexService;

class IndexController extends Controller
{
    /**
     * 路由公共入口
     */
    public function index(Request $request)
    {
        $service = new IndexService();
        $data = $service->generateQuestion(130);
        // 导出
        return $this->exportExcel($data);
    }

    public function generateQuestion() 
    {
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $operation = rand(0, 1) ? '+' : '-';
        
        // 确保加法不超过20，减法不出现负数
        if ($operation === '+') {
            while ($num1 + $num2 > 20) {
                $num1 = rand(1, 20);
                $num2 = rand(1, 20);
            }
        } else {
            while ($num1 - $num2 < 0) {
                $num1 = rand(1, 20);
                $num2 = rand(1, 20);
            }
        }
        $answer = $operation === '+' ? $num1 + $num2 : $num1 - $num2;
        return [$num1, $operation, $num2, $answer];
    }

    /** 
     * 导出
     */
    public function exportExcel($data)
    {
        $list = [];
        $columnList = [];
        foreach ($data as $val) {
            $columnList[] = $val;
            if (count($columnList) == 4) {
                $list[] = $columnList;
                $columnList = [];
            }
        }
        if (!empty($columnList)) {
            $list[] = $columnList;
        }
        $row = count($list);
        $headerMap = ['','','',''];
        //表格格式化
        $afterSheetStyle = [
            AfterSheet::class => function(AfterSheet $event) use ($row) {
                // ... 此处你可以任意格式化
                //表头字体
                $cellRange = 'A1:D' . $row;
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(22);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(22);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(22);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(22);
                for ($i = 1; $i <= $row; $i++) {
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(35);
                }

                $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            
            }
        ];
        return Excel::download(new ExportExcel($headerMap, $list, $afterSheetStyle),
            "口算_".date('YmdHis').".xlsx");
    }
}
