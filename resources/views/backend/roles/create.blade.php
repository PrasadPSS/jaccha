@extends('backend.layouts.app')
@section('title', 'Create Roles')

@section('content')
@php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use Spatie\Permission\Models\Permission;


$user_id = Auth()->guard('admin')->user()->id;

$backend_menubar = BackendMenubar::Where(['visibility'=>1])->orderBy('sort_order')->get();
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Role</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Create
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <section id="multiple-column-form">
          <div class="row match-height">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('admin.roles') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Role</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.roles.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Role Name', 'required' => true]) }}
                              {{ Form::label('name', 'Role Name *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                          <h4 class="card-title">
                            <div class="checkbox checkbox-primary">
                              <input type="checkbox" id="give_all_access_label" name="give_all_access" class="give_all_access" value="1"> 
                              <label for="give_all_access_label">Select All</label>
                            </div>
                          </h4>
                          </div>
                          @php
                          //dd($has_permissions);
                            foreach($backend_menubar as $menu)
                            {
                          @endphp
                              <div class="col-md-12 col-12">
                              <div class="card" style="border: 1px solid rgba(0,0,0,.125);">
                          @php
                              if($menu->has_submenu == 1)
                              {
                                //$backend_menu_permission = explode(',',$role->menu_ids);
                                //$backend_submenu_permission = explode(',',$role->submenu_ids);
                                $backend_submenubar = BackendSubMenubar::Where(['menu_id'=>$menu->menu_id])->get();
                                if($backend_submenubar)
                                {
                          @endphp
                                  <!-- <h4 class="card-title">{{$menu->menu_name}}</h4> -->
                                  <div class="card-header" style="background-color: rgba(0,0,0,.03); border-bottom: 1px solid rgba(0,0,0,.125); padding: .75rem 1.25rem;">
                                  <h4 class="card-title">
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('menu_id[]', $menu->menu_id, null, ['id'=>'menu_'.$menu->menu_id.'', 'class'=>'menu']) }}
                                      {{ Form::label('menu_'.$menu->menu_id.'', $menu->menu_name) }}
                                    </div>
                                  </h4>
                                  </div>
                                  <div class="card-body" style="padding: 1.25rem;">
                                  <div class="row">
                          @php
                                    foreach($backend_submenubar as $submenu)
                                    {
                          @endphp
                                      <div class="col-md-6 col-12">
                                      <div class="card" style="border: 1px solid rgba(0,0,0,.125);">
                                        <!-- <h5 class="">{{ $submenu->submenu_name }}</h5> -->
                                        <div class="card-header" style="background-color: rgba(0,0,0,.03); border-bottom: 1px solid rgba(0,0,0,.125); padding: .75rem 1.25rem;">
                                        <h3 class="card-title">
                                          <div class="checkbox checkbox-primary">
                                            {{ Form::checkbox('submenu_id[]', $submenu->submenu_id, null, ['id'=>'submenu_'.$menu->menu_id.'_'.$submenu->submenu_id.'', 'class'=>'submenu menu_'.$menu->menu_id.'']) }}
                                            {{ Form::label('submenu_'.$menu->menu_id.'_'.$submenu->submenu_id.'', $submenu->submenu_name) }}
                                          </div>
                                        </h3>
                                        </div>
                                        <div class="col-md-12 col-12 mt-2 menu_permissions">
                                          <ul class="list-unstyled mb-0">
                                            @php
                                              $backend_permission = explode(',',$submenu->submenu_permissions);
                                              $permissions = Permission::where('menu_id',$menu->menu_id)->where('submenu_id',$submenu->submenu_id)->get();
                                              $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                                  return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                                });
                                              //dd($permissions);
                                            @endphp
                                            @foreach($backend_permission as $permission)
                                            @if($permission)
                                            <li class="d-inline-block mr-2 mb-1">
                                              <fieldset>
                                                <div class="checkbox checkbox-primary">
                                                  {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], null, ['id'=>'permissions['.$permissions[$permission]['id'].']', 'class'=>'menu_'.$menu->menu_id.' submenu_'.$menu->menu_id.'_'.$submenu->submenu_id.'']) }}
                                                  {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}
                                                </div>
                                              </fieldset>
                                            </li>
                                            @endif
                                            @endforeach
                                          </ul>
                                        </div>
                                      </div>
                                      </div>
                          @php

                                    }
                                    @endphp
                                    </div>
                                    </div>
                                    @php
                                }
                              }
                              else
                              {
                                //$backend_menu_permission = explode(',',$role->menu_ids);
                          @endphp
                                <div class="card-header" style="background-color: rgba(0,0,0,.03); border-bottom: 1px solid rgba(0,0,0,.125); padding: .75rem 1.25rem;">
                                <h4 class="card-title">
                                  <div class="checkbox checkbox-primary">
                                    {{ Form::checkbox('menu_id[]', $menu->menu_id, null, ['id'=>'menu_'.$menu->menu_id.'', 'class'=>'menu']) }}
                                    {{ Form::label('menu_'.$menu->menu_id.'', $menu->menu_name) }}
                                  </div>
                                </h4>
                                </div>
                                <div class="col-md-6 col-12 mt-2 menu_permissions">
                                  <ul class="list-unstyled mb-0">
                                    @php
                                      $backend_permission = explode(',',$menu->permissions);
                                      $permissions = Permission::where('menu_id',$menu->menu_id)->get();
                                      $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                          return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                        });
                                      //dd($permissions);
                                    @endphp
                                    @foreach($backend_permission as $permission)

                                    @if(isset($permissions[$permission]))
                                    <li class="d-inline-block mr-2 mb-1">
                                      <fieldset>
                                        <div class="checkbox checkbox-primary">
                                          {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], null, ['id'=>'permissions['.$permissions[$permission]['id'].']', 'class'=>'menu_'.$menu->menu_id.'']) }}
                                          {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}
                                        </div>
                                      </fieldset>
                                    </li>
                                    @endif
                                    @endforeach
                                  </ul>
                                </div>
                          @php
                              }
                          @endphp
                                </div>
                                </div>
                          @php
                            }
                          @endphp
                          <div class="col-12 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){

    // To Select All Checkbox Box
    $('.give_all_access').on('change',function () {
      if ($('.give_all_access:checked').val() == '1') {
        $('input[type="checkbox"]').each(function(){
            $(this).prop("checked",true);
        });
      }else {
        $('input[type="checkbox"]').each(function(){
           $(this).prop("checked",false);
        });
      }
    });

    // To Select All Submenu and Options related to the Menu
    $('.menu').on('change',function(){
        var menu_id = $(this).attr('id');
        if($(this).is(':checked')){
            $('.'+menu_id).each(function(){
                $(this).prop("checked",true);
            });
        }else{
            $('.'+menu_id).each(function(){
                $(this).prop("checked",false);
            });
        }
    });

    // To Select All Submenu related to the Menu
    $('.submenu').on('change',function(){
        var submenu_id = $(this).attr('id');
        if($(this).is(':checked')){
          $('.'+submenu_id).each(function(){
            $(this).prop("checked",true);
          });
        }else{
          $('.'+submenu_id).each(function(){
            $(this).prop("checked",false);
          });
        }
    });

  });
</script>
@endsection