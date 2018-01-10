<?php

namespace App\Support;

trait Repository {

    public function update( array $attributes = [], array $options = [] )
    {
        if( isset($attributes['meta']) )
        {
            $attributes['meta'] = $this->syncMeta( $attributes['meta'], 'meta' );
        }

        if( isset($attributes['system']) )
        {
            $attributes['system'] = $this->syncMeta( $attributes['system'], 'system' );
        }

        return parent::update( array_remove_null($attributes) );
    }

    /**
    * Sync meta information in this Model
    *
    * @param Array $data
    * @param String $field
    * @return Array
    */
    public function syncMeta( $data, $field='meta' )
    {
        if( !$data || count($data) == 0 ){ return false; }

        $meta = [];

        if( $this->$field )
        {
            $meta = $this->$field;
        }

        $data = array_merge($meta, $data);

        return $data;
    }

    /**
    * Sync meta information in this Model pushing new values
    *
    * @param Array $data
    * @param String $field
    * @return Array
    */
    public function syncMetaPush( $data, $field='meta' )
    {

        if( !$data || count($data) == 0 ){ return false; }

        $meta = [];

        if( $this->$field )
        {
            $meta = $this->$field;
        }
        
        foreach($data as $key=>$value)
        {      
            if( !isset($meta[$key]) || !in_array( $value, $meta[$key] ) )
            { 
                $meta[$key][] = $value;
            }
            
        }

        return $meta;
        
    }

}