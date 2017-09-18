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

@section('title', 'Group Details')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Group {{$group->name}}</span>
                </div>

                <div class="panel-body">
                    
                    <div class="panel-content form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{$group->description}}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-12" for="roles">Users:</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="list-group">
                                @forelse($group->users as $user)
                                    <a class="list-group-item" href="{{route('users.show', [$user->id])}}">{{$user->email}}</a>
                                @empty
                                    <span class="list-group-item text-muted">None</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-4 text-left">
                            <a href="{{route('groups.index')}}" class="btn btn-sm btn-default">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="col-xs-8 text-right">
                            <a href="{{route('groups.edit',[$group->id])}}" class="btn btn-sm btn-info">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>  
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-trash"></i>
                                Delete
                            </a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('groups.destroy', [$group->id]) }}">
    {{method_field('DELETE')}}
    {{csrf_field()}}
    @include('partials._modal')
</form>
@endsection

@section('scripts')
<!-- insert below the custom scripts this view will use -->
@endsection