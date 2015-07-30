<?php
class Good extends \Eloquent {
	protected $fillable = [];

    public static function boot()
    {
        parent::boot();
    Good::created(function(){
      if(Session::has('hello')){
          Session::put("hello",Session.get('hello')+1);
      }
    });
}

public static function insertGood(array $params)
{
  $good = self::create($params);
}

}