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

@section('title', '| Edit Client')

@section('content')
<!-- content goes below -->
<div class="container m-t-30">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Client</div>

                <div class="panel-body m-t-30">
                    <form class="form-horizontal" method="POST" action="{{ route('clients.update', [$client->id]) }}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$client->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('admin_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Client Administrator</label>

                            <div class="col-md-6">
                                
                                <select class="form-control" name="admin_id" required>
                                    @foreach($admins as $admin)
                                        <option 
                                            <?=($admin->id == $client->admin->id)?'selected':''?>
                                            value="{{$admin->id}}">
                                            {{$admin->email}}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('admin_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('admin_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{route('clients.index')}}" class="btn btn-default">Cancel</a>
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