<?php
/**
 * Created by PhpStorm.
 * User: ywl
 * Date: 2019/3/19
 * Time: 15:08
 */

namespace App\Base\Facades;


use Illuminate\Support\Facades\Facade;
class PinYinFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return self::class;
    }

}
