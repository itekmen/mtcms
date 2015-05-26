var MT = {
    oTable : null,

    init : function () {

    },

    getDataTable : function (source) {
        MT.oTable = $('#datatable_ajax2').dataTable( {
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {"sUrl": BASE+"/sbadmin/assets/js/plugins/data-tables/turkish.json"},
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": source
            //"fnDrawCallback": function ( oSettings ) {
                //$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
            //}
        });
    },
    dataTableReload : function () {
        if(MT.oTable!=null) MT.oTable.fnDraw();
    },

    deleteAjaxWithConfirm : function(url,token){
        bootbox.confirm("Silmek istediğinize emin misiniz?", function(result) {
            if(result==true && url!="" && url!="#"){
                $.ajax({
                    type: 'post',
                    url: url,
                    data: { _method:'DELETE',_token :token},
                    success: function(response) {
                        if(response=="ok"){
                            MT.showNotification("","İşlem başarılı","lime");
                            MT.dataTableReload();
                        }else{
                            MT.showNotification("HATA : ","Hata oluştu!","ruby");
                        }
                    }
                });
            }
        });
    },

    reActivationAjaxWithConfirm : function(url,token){
        bootbox.confirm("Aktivasyon kodu göndermek istediğinize emin misiniz?", function(result) {
            if(result==true && url!="" && url!="#"){
                $.ajax({
                    type: 'post',
                    url: url,
                    data: { _method:'POST',_token :token},
                    success: function(response) {
                        if(response=="ok"){
                            MT.showNotification("","İşlem başarılı","lime");
                            MT.dataTableReload();
                        }else{
                            MT.showNotification("HATA : ","Hata oluştu!","ruby");
                        }
                    }
                });
            }
        });
    },

    showNotification : function(title,content,theme){
        theme = (theme=="") ? "teal" : theme;
        // theme : teal,amethyst,ruby,tangerine,lemon,lime,ebony,smoke
        var settings = {theme: theme,sticky: false, horizontalEdge: "top", verticalEdge: "right", life : 3000};
        if($.trim(title) != '') settings.heading = $.trim(title);
        $.notific8('zindex', 11500);
        $.notific8($.trim(content), settings);
    },

    initDatePicker : function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                autoclose: true,
                language : 'tr'
            });
        }
    },
    
    getSelectLoad : function (id,url,item) { // id = parent_id, url = post url, item = append select id
        $('#'+item).html('<option value="">Yükleniyor... Bekleyiniz...</option>');
        $.getJSON(url,{id:id}).done(function (json) {
            $('#'+item).html('<option value="">Seçiniz</option>');
            var str = "";
            $.each( json, function( i, data) {
                str += '<option value="'+i+'">'+data+'</option>';
            });
            $('#'+item).append(str);
        });
    }

};


$(document).ready(function () {
    $('body').on("click",".del-item",function () {
        MT.deleteAjaxWithConfirm($(this).attr("href"),$(this).data("token"));
        return false;
    });
});