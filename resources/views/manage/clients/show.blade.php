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

@section('title', '| Client Details')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Client {{$client->name}}</span>
                </div>

                <div class="panel-body">
                    
                    <div class="panel-content form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="admin_id">Client administrator:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">
                                    <a href="{{route('users.show', [$client->admin->id])}}">{{$client->admin->email}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="client_users">Client Users:</label>
                            <div class="col-sm-8">
                                <ul class="list-group">
                                    @forelse($client->users as $user)
                                    <li class="list-group-item">
                                        <a href="{{route('users.show', [$user->id])}}">{{$user->email}}</a>
                                    </li>
                                    @empty
                                    <li>No users</li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-4 text-left">
                            <a href="{{route('clients.index')}}" class="btn btn-sm btn-default">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="col-xs-8 text-right">
                            <a href="{{route('clients.edit',[$client->id])}}" class="btn btn-sm btn-info">
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
<form method="POST" action="{{ route('clients.destroy', [$client->id]) }}">
    {{method_field('DELETE')}}
    {{csrf_field()}}
    @include('partials._modal')
</form>
@endsection

@section('scripts')
<!-- insert below the custom scripts this view will use -->
@endsection