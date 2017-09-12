<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function admin()
    {
        return $this->belongsTo('App\User');
    }
    
    
    public function delete()
    {
        foreach($this->users()->get() as $user){
            $user->delete();
        }
        parent::delete();
    }
}
