<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{



    public function boot()
    {
        $sqlDebug = env("SQL_DEBUG");
        if($sqlDebug) {
            DB::listen(function ($sql) {
                foreach ($sql->bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if (is_string($binding)) {
                            $sql->bindings[$i] = "'$binding'";
                        }
                    }
                }
                $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
                $query = vsprintf($query, $sql->bindings);
                Log::debug('SQL: '. $query);
                Log::debug('Time: '. $sql->time. 'ms');
            });
        }
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
