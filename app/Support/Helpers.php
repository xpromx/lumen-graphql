<?php

if (! function_exists('auth')) {

    function auth()
    {
        return request()->user();
    }
}

function array_remove_null($item)
{
    if (!is_array($item)) {
        return $item;
    }

   return collect($item)
        ->reject(function ($item) {
            return is_null($item);
        })
        ->flatMap(function ($item, $key) {

            return is_numeric($key)
                ? [array_remove_null($item)]
                : [$key => array_remove_null($item)];
        })
        ->toArray();
}

if (! function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string  $key
     * @param  mixed   $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        if (is_array($key)) {
            return app('request')->only($key);
        }

        return data_get(app('request')->all(), $key, $default);
    }
}

if (! function_exists('config_path')) {
    /**
     * Get the path to the configuration files.
     *
     * @return string
     */
    function config_path()
    {
        return app()->basePath().'/config';
    }
}


if (!function_exists('public_path')) {
    /**
     * Return the path to public dir
     *
     * @param null $path
     *
     * @return string
     */
    function public_path($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

if (!function_exists('getSQL')) {

    /**
    * Print the final SQL from the builder
    *
    * @param Builder $json
    * @return String
    */
    function getSQL($builder) 
    {
        $sql = $builder->toSql();
        foreach ( $builder->getBindings() as $binding ) {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }

}