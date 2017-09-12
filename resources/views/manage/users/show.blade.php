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

@section('title', '| User Details')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">User {{$user->email}}</span>
                </div>

                <div class="panel-body">
                    <div class="panel-content form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="name">Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{$user->name}}</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="group">Group:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{$user->group['name']}}</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="roles">Roles:</label>
                            <div class="col-sm-6">
                                <ul class="list-group">
                                    @forelse($user->roles as $role)
                                        <li class="list-group-item">{{$role->name}}</li>
                                    @empty
                                        <li class="list-group-item text-muted">None</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="roles">Permissions:</label>
                            <div class="col-sm-6">
                                <ul class="list-group">
                                    @forelse($user->permissions as $permission)
                                        <li class="list-group-item">{{$permission->display_name}}</li>
                                    @empty
                                        <li class="list-group-item text-muted">None</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-4 text-left">
                            <a href="{{route('users.index')}}" class="btn btn-sm btn-default">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="col-xs-8 text-right">
                            <a href="{{route('users.edit',[$user->id])}}" class="btn btn-sm btn-info">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('users.destroy', [$user->id]) }}">
    {{method_field('DELETE')}}
    {{csrf_field()}}
    @include('partials._modal')
</form>
@endsection

@section('scripts')
<!-- insert below the custom scripts this view will use -->
@endsection