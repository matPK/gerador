<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * This is the create.blade view.
 * 
 * @author: Matheus.
 * 
 * @created_at: 31/08/2017.
 */
?>

@extends('layouts.app')

@section('styles')
<!-- insert below the custom stylesheets this view will use -->

@endsection

@section('title', '| Edit User')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Edit User</span>
                </div>

                <div class="panel-body m-t-20">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', [$user->id]) }}">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" disabled required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                            <label for="group" class="col-md-4 control-label">Group</label>

                            <div class="col-md-6">
                                <select id="group" name="group" class="form-control">
                                    <option value="0"></option>
                                    @foreach($groups as $group)
                                        <option
                                            <?=($user->group_id == $group->id)?'selected':''?>
                                            value="{{$group->id}}">
                                            {{$group->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if(!is_null($roles) && !is_null($permissions))
                            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label for="roles" class="col-md-4 control-label">Roles</label>

                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                <?php foreach($user->roles as $user_role):
                                                    if($user_role->id === $role->id):?>
                                                        checked
                                                <?php endif; 
                                                endforeach; ?>
                                                name="roles[]"
                                                type="checkbox"
                                                value="{{$role->id}}"
                                            />
                                            {{$role->display_name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    @if ($errors->has('roles'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('roles') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                                <label for="permissions" class="col-md-4 control-label">Permissions</label>

                                <div class="col-md-6">
                                    @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                <?php foreach($user->permissions as $user_permission):
                                                    if($user_permission->id === $permission->id):?>
                                                        checked
                                                <?php endif; 
                                                endforeach; ?>
                                                name="permissions[]"
                                                type="checkbox"
                                                value="{{$permission->id}}"
                                            />
                                            {{$permission->display_name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    @if ($errors->has('permissions'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary m-t-20">
                                    Save Changes
                                </button>
                                <a href="{{route('users.index')}}" class="btn btn-default m-t-20">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- insert below the custom scripts this view will use -->
@endsection