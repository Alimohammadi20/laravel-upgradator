<?php
namespace Alimi7372\Upgradetor\Facades;
class Upgradetor extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Alimi7372\SystemUpdator\Upgradetor::class;
    }
}