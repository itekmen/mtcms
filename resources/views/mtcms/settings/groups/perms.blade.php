@extends('sbadmin/layout')

@section('title') Grup İzin Yönetimi @endsection

@section('head')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"> Ayarlar - Grup Yönetimi <small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">Anasayfa</a></li>
                <li><a href="#">Ayarlar</a></li>
                <li><a href="{{URL::to('settings/groups')}}">Grup Yönetimi</a></li>
                <li><a href="{{URL::to('settings/groups/data/perms/'.$group->id)}}">Grup İzin Yönetimi</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> {{$group->value}} grubuna ait izinler
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">

                @if(!isset($controllers) && count($controllers)<1)
                    <div class="alert alert-danger" role="alert">Controller dosyaları bulunamadı!</div>
                @else

                    {!! Form::open(['action'=>["Admin\Settings\GroupController@postPerms",$group->id],"class"=>""]) !!}

                    <table class="table table-striped table-bordered">
                        <thead><tr role="row" class="heading success"><th><label class="checkbox-inline"><input type="checkbox" name="allperms" class="allperms" value="1" @if(isset($currentperms['all___all'])) checked="checked" @endif> Tüm Yetkiler</label>   <button class="btn btn-xs btn-success text-right" style="float:right;">Kaydet</button>     </th></tr></thead>
                    </table>

                    <br><br>

                    @foreach($controllers AS $row=>$item)
                        {{-- Controller And AuthController Hidden --}}
                        @if($item['class']!="Controller" && $item['class']!="AuthController")

                            @if(strlen($item['namespace'])>0)
                                @set $classname=strtolower($item['namespace']."\\".$item['class'])
                            @else
                                @set $classname=strtolower($item['namespace'].$item['class'])
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead><tr role="row" class="active"><th>
                                    {{$item['class']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="checkbox-inline"><input type="checkbox" name="perms[]" class="permsitem permsallmethod" @if(isset($currentperms[$classname."___all"])) checked="checked" @endif value="{{$classname}}___allmethods" > Tüm Metodlar </label>
                                </th></tr></thead>
                                <tbody><tr><td>
                                    <table class="table table-no-border"><tr>
                                    @foreach($item['method'] AS $r=>$method)
                                        @if($r%5==0 && $r!=0) </tr><tr> @endif
                                        <td>
                                            <label class="checkbox-inline">
                                                <input name="perms[]" class="permsitem" type="checkbox" @if(isset($currentperms[$classname."___".strtolower($method)])) checked="checked" @endif value="{{$classname}}___{{strtolower($method)}}"> {{$method}}
                                            </label>
                                        </td>
                                    @endforeach
                                    </tr></table></td></tr></tbody>
                            </table>

                        @endif

                    @endforeach

                    <div class="form-groups">
                        <div class="row">
                            <div class="col-md-12">
                                <br><br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Kaydet</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                @endif

            </div>

        </div>
    </div>

    <div class="clearfix">

@endsection


@section('footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.allperms').change(function(){
                if($(this).is(":checked")===true) {
                    $('.permsitem').prop("checked",true);
                    $('.permsitem').prop("disabled",true);
                } else{
                    $('.permsitem').prop('disabled',false);
                    $('.permsitem').prop('checked',false);
                }
            });
            $('.permsallmethod').change(function () {
                var sbitems = $(this).parents('table').find("table input.permsitem");
                if($(this).is(":checked")===true) {
                    sbitems.prop("checked",true);
                    sbitems.prop("disabled",true);
                } else{
                    sbitems.prop('disabled',false);
                    sbitems.prop('checked',false);
                }
            });
            if($('.allperms').is(":checked")===true) {
                $('.permsitem').prop("checked",true);
                $('.permsitem').prop("disabled",true);
            }
            $('.permsallmethod').each(function(){
                var sbitems = $(this).parents('table').find("table input.permsitem");
                if($(this).is(":checked")===true) {
                    sbitems.prop("checked",true);
                    sbitems.prop("disabled",true);
                }
            });
        });
    </script>
@endsection