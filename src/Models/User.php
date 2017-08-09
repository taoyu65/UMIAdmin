<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class User extends Model
{
    use BreadOperation;

    protected $table = 'users';
    public $timestamps = true;

    private $modelNameSpace = 'YM\Models';

    public function __construct(array $attributes = [])
    {
        $this->fillable = Config::get('umiEnum.fillable.' . $this->table);

        parent::__construct($attributes);
    }

    public function MenuJson()
    {
        return $this->hasOne($this->modelNameSpace . '\UserMenu', 'user_id');
    }

    public function menusJson()
    {
        $minute = Config::get('umi.cache_minutes');
        $json = Cache::remember('menuJson', $minute, function () {
            return $re = self::find(Auth::user()->id)
                ->MenuJson()
                ->first();
                //->firstOrFail()
                //->json;
        });
        return $json ? $json->json : $json;
    }

    public function userNameList()
    {
        return self::select('id', 'name')->pluck('name', 'id');
    }

    public function insert($inputs)
    {
        try {
            self::create($inputs);
        } catch (\Exception $exception) {
            exit($exception->getMessage());
            //abort(503, $exception->getMessage());
        }
    }
}