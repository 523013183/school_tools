<?php


namespace App\Mathematics\Services;

use App\Base\Services\BaseService;
use LDAP\Result;

class IndexService
{
    
    /** 
     * 批量生成算式
     */
    public function generateQuestion($number)
    {
        // 到处excel一页: 20*4 = 80条
        $page = (int) ceil($number / 80); // 一共几页
        $pageNumber = $number; // 当前页条数
        if ($page > 1) $pageNumber = 80;

        $data = [];
        for ($i = 0; $i < $page; $i++) {
            if ($pageNumber > 20) {
                $sizeNumber = (int) ($pageNumber * 0.2);
                $pageNumber = $pageNumber - $sizeNumber;
            }
            
            for ($j = 0; $j < $pageNumber; $j++) {
                list($nums, $operations) = $this->generateQuestionOne();
                $data[] = $this->questionToString($nums, $operations);
            }
            if (!empty($sizeNumber)) {
                for ($j = 0; $j < $sizeNumber; $j++) {
                    list($nums, $operations) = $this->generateCompareSizeQuestionOne();
                    $data[] = $this->questionToString($nums, $operations);
                }
            }
            // 判断是否最后一页
            if ($i == $page - 1) {
                $pageNumber = $number - ($page - 1) * 80; // 最后一页条数
            }
        }
        return $data;
    }

    /** 
     * 单个算式转字符串
     */
    private function questionToString($nums, $operations)
    {
        $str = '';
        foreach ($nums as $key => $num) {
            $str .= ' ' . $num . ' ' . ($operations[$key] ?? '');
        }
        return $str;
    }

    /** 
     * 创建单个等式
     */
    public function generateQuestionOne() 
    {
        $type = rand(0, 1) ? 'symbolsSame' : 'symbolsDifferent';
        if ($type === 'symbolsSame') {
            list($nums, $operations) = $this->symbolsSameQuestion();
        } else {
            list($nums, $operations) = $this->symbolsDifferentQuestion();
        }
        
        $ignore = array_rand($nums);
        $nums[$ignore] = '(  )';
        return [$nums, $operations];
    }

    /** 
     * 创建单个比大小算式
     */
    public function generateCompareSizeQuestionOne() 
    {
        $type = rand(0, 1) ? 'symbolsSame' : 'symbolsDifferent';
        if ($type === 'symbolsSame') {
            list($nums, $operations) = $this->symbolsSameQuestion();
        } else {
            list($nums, $operations) = $this->symbolsDifferentQuestion();
        }
        list($newResult, $newOperator) = $this->compareSize(end($nums));
        $nums[count($nums) - 1] = $newResult;
        $operations[count($operations) - 1] = '○';
        return [$nums, $operations];
    }

    /** 
     * 算式修改为，计算结果比大小
     */
    private function compareSize($result)
    {
        // 随机选择一个比较符号（小于、大于或等于）
        $operator = '';
        if ($result == 0 || $result == 20) {
            $operator = '='; // 等于
            $newResult = $result; // 保持结果相等
            return [$newResult, $operator];
        }
        do {
            $operatorChoice = rand(0, 2);
            if ($operatorChoice == 0) {
                $operator = '<'; // 小于
                $newResult = rand($result + 1, 20); // 比结果大的随机数
            } elseif ($operatorChoice == 1) {
                $operator = '>'; // 大于
                $newResult = rand(0, $result - 1); // 比结果小的随机数
            } else {
                $operator = '='; // 等于
                $newResult = $result; // 保持结果相等
            }
        } while ($newResult <= 0 || $newResult > 20); // 确保新结果在1到20之间
        return [$newResult, $operator];
    }

    /** 
     * 生成符号不同的题目
     */
    private function symbolsDifferentQuestion()
    {
        // 随机生成两个加减数，确保第一个计算结果大于0且小于等于20
        do {
            $num1 = rand(1, 20); // 第一个数
            $num2 = rand(1, 20); // 第二个数
            $operator1 = rand(0, 1) == 0 ? '+' : '-'; // 随机选择加法或减法

            // 计算第一个运算结果
            if ($operator1 == '+') {
                $result1 = $num1 + $num2;
            } else {
                $result1 = $num1 - $num2;
            }
        } while ($result1 <= 0 || $result1 > 20);

        // 随机生成第三个数，确保第二个计算结果大于0且小于等于20
        do {
            $num3 = rand(1, 20); // 第三个数
            $operator2 = rand(0, 1) == 0 ? '+' : '-'; // 随机选择加法或减法

            // 计算第二个运算结果
            if ($operator2 == '+') {
                $finalResult = $result1 + $num3;
            } else {
                $finalResult = $result1 - $num3;
            }
        } while ($finalResult <= 0 || $finalResult > 20);

        $nums = [$num1, $num2, $num3, $finalResult];
        $operations = [$operator1, $operator2, '='];
        return [$nums, $operations];
    }


    /** 
     * 生成符号相同的题目
     */
    private function symbolsSameQuestion()
    {
        // =号左边的数量
        $letfEqualNum = rand(2, 3);
        $nums = $this->getRandNums($letfEqualNum);

        $operation = rand(0, 1) ? '+' : '-';
        $operations = array_fill(0, $letfEqualNum - 1, $operation);

        // 确保加法不超过20，减法不出现负数
        $answer = 0;
        if ($operation === '+') {
            while (array_sum($nums) > 20) {
                $nums = $this->getRandNums($letfEqualNum);
            }
            $answer = array_sum($nums);
        } else {
            while (($nums[0] - $nums[1] - ($nums[2] ?? 0)) < 0) {
                $nums = $this->getRandNums($letfEqualNum);
            }
            $answer = $nums[0] - $nums[1] - ($nums[2] ?? 0);
        }
        $operations[] = '=';
        $nums[] = $answer;
        return [$nums, $operations];
    }

    /** 
     * 获取随机数字数组
     * @param int $num 数字个数

     */
    private function getRandNums($letfEqualNum)
    {
        $nums = [];
        for ($i = 0; $i < $letfEqualNum; $i++) {
            $nums[] = rand(1, 20);
        }
        return $nums;
    }
}
