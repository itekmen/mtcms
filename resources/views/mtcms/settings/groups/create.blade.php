@extends('sbadmin/layout')

@section('title') Yeni Grup - Grup Yönetimi @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Ayarlar - Grup Yönetimi<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">Anasayfa</a></li>
                <li><a href="#">Ayarlar</a></li>
                <li><a href="{{URL::to('settings/groups')}}">Grup Yönetimi</a></li>
                <li><a href="{{URL::to('settings/groups/create')}}">Yeni Grup</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-users"></i> Yeni Grup</div>
        </div>
        <div class="portlet-body form">

            {!! Form::open(['route'=>"settings.groups.store","class"=>"form-horizontal form-row-seperated"]) !!}

                <div class="form-body">

                    <div class="form-group">
                        {!! Form::label('name',"Başlık",["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('name','',["class"=>"form-control",'placeholder'=>"Başlık"]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('value',"Açıklama",["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('value','',["class"=>"form-control",'placeholder'=>"Açıklama"]) !!}</div>
                    </div>

                    <div class="form-groups">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-offset-2 col-md-10">
                                    <br><br>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Kaydet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}


        </div>
    </div>

    <div class="clearfix">

@endsection


@section('footer')

@endsection