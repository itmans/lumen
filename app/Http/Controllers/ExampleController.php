<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class ExampleController extends Controller
{
    protected $cache;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->cache = app('redis');
    }

    public function index()
    {
/*        $data = [
            'name' => 'josh',
            'sex' => 1,
            'age' => 100
        ];
        $this->cache->set('user', json_encode($data));
        $this->cache->expire('user', 30);
        print_r(json_decode($this->cache->get('user')));*/
        $key = 'set_score';
        $this->cache->zadd($key, '50', json_encode(['name' => 'Tom']));
        $this->cache->zadd($key, '70', json_encode(['name' => 'John']));
        $this->cache->zadd($key, '90', json_encode(['name' => 'Jerry']));
        $this->cache->zadd($key, '30', json_encode(['name' => 'Job']));
        $this->cache->zadd($key, '100', json_encode(['name' => 'LiMing']));
        $ret = $this->cache->zrevrange($key, 0, -1);
        print_r($ret);
    }

    //
}
