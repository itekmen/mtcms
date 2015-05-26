@extends('sbadmin/layout')

@section('title') Tanımlamalar @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"> Ayarlar - Tanımlamalar <small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">Anasayfa</a></li>
                <li><a href="#">Ayarlar</a></li>
                <li><a href="{{URL::to('settings/config')}}">Tanımlamalar</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> Tanımlar
            </div>
            <div class="actions">
                <a href="{{URL::to('settings/config/create')}}" class="btn btn-primary btn-xs yellow-stripe">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-480">Yeni Tanım</span>
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="datatable_ajax2">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="40%">Ad</th>
                        <th width="40%">Değer</th>
                        <th width="20%">İşlem</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="clearfix">

@endsection


@section('footer')
    <script type="text/javascript">MT.getDataTable("{{ URL::to('settings/config/data/index') }}");</script>
@endsection