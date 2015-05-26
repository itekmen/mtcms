@extends('sbadmin/layout')

@section('title') Kullanıcı Düzenle - Kullanıcı Yönetimi @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Ayarlar - Kullanıcı Yönetimi<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">Anasayfa</a></li>
                <li><a href="#">Ayarlar</a></li>
                <li><a href="{{URL::to('settings/users')}}">Kullanıcı Yönetimi</a></li>
                <li><a href="{{URL::to('settings/users/'.$user->id.'/edit/')}}">Kullanıcı Düzenle ({{$user->name}} {{$user->surname}})</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-users"></i> Kullanıcı Bilgileri - {{$user->name}} {{$user->surname}}</div>
        </div>
        <div class="portlet-body form">

            {!! Form::model($user,['route'=>["settings.users.update",$user->id],"class"=>"form-horizontal form-row-seperated"]) !!}

            {!! Form::hidden("_method","PUT")!!}

            <div class="form-body">

                <div class="form-group">
                    {!! Form::label('name',"Adı",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::text('name',null,["class"=>"form-control",'placeholder'=>"Adı"]) !!}</div>
                </div>

                <div class="form-group">
                    {!! Form::label('surname',"Soyadı",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::text('surname',null,["class"=>"form-control",'placeholder'=>"Soyadı"]) !!}</div>
                </div>

                <div class="form-group">
                    {!! Form::label('email',"E-Posta",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::email('email',null,["class"=>"form-control",'placeholder'=>"E-Posta"]) !!}</div>
                </div>

                <div class="form-group">
                    {!! Form::label('password',"Parola",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::password('password',["class"=>"form-control",'placeholder'=>"Parola"]) !!}</div>
                </div>

                <div class="form-group">
                    {!! Form::label('password_repeat',"Parola (Tekrar)",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::password('password_repeat',["class"=>"form-control",'placeholder'=>"Parola (Tekrar)"]) !!}</div>
                </div>

                <div class="form-group">
                    {!! Form::label('groups',"Yetkiler",["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">
                        {!! Form::select('groups[]',$groups,$user->Groups()->lists('group_id'),["class"=>"form-control groups",'placeholder'=>"Yetkiler",'multiple'=>"multiple"]) !!}
                        <a href="javascript:void(0)" class="btn btn-xs btn-danger btn-destroy-group">Yetkileri Kaldır</a>
                    </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-destroy-group').click(function () {
                $(".groups option").removeAttr("selected");
            });
        });
    </script>
@endsection