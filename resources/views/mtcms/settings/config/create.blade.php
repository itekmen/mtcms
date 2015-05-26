@extends('sbadmin/layout')

@section('title') Yeni Tanım - Tanımlamalar @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Ayarlar - Tanımlamalar<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">Anasayfa</a></li>
                <li><a href="#">Ayarlar</a></li>
                <li><a href="{{URL::to('settings/config')}}">Tanımlamalar</a></li>
                <li><a href="{{URL::to('settings/config/create')}}">Yeni Tanım</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-users"></i> Yeni Tanım</div>
        </div>
        <div class="portlet-body form">

            {!! Form::open(['route'=>"settings.config.store","class"=>"form-horizontal form-row-seperated"]) !!}

                <div class="form-body">

                    <div class="form-group">
                        {!! Form::label('name',"Başlık",["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('name','',["class"=>"form-control",'placeholder'=>"Başlık"]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('value',"Değer",["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('value','',["class"=>"form-control",'placeholder'=>"Değer"]) !!}</div>
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