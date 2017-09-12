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

@section('title', '| User List')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <span class="panel-title">User List</span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{route('users.create')}}" class="btn btn-sm btn-default pull-right">
                                <i class="glyphicon glyphicon-plus"></i>
                                Create User
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Group</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{route('users.show', [$user->id])}}">
                                            {{$user->email}}                                        
                                        </a>
                                    </td>
                                    <td>
                                        {{$user->group['name']}}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('users.edit', [$user->id])}}" class="btn btn-xs btn-info">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                {!!$users->links()!!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- insert below the custom scripts this view will use -->
@endsection