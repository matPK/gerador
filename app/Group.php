<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function users()
    {
        return $this->hasMany('App\User');
    } 
    
    public function delete()
    {
        foreach($this->users()->get() as $user){
            $user->group_id = null;
            $user->save();
        }
        parent::delete();
    }
}
