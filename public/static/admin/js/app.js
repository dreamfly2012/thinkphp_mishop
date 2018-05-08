$(document).on('click', '.sub-menu', function () {
    $.post($(this).attr('data-url'),function (data) {

        if(data.status == 200) {

            layer.msg(data.msg, {icon: 1, time:2000},function(index){
                layer.close(index);
                window.location.href = data.url;
            });
        } else if (data['data'] == 203)
        {
            layer.msg(data.msg,{icon:2, time:2000});
            return false;
        } else{
            layer.msg(data,{icon:2, time:1500});
        };
    });
});
//上传图片logo
$(document).on('change','input.file-config',function () {

    var formData = new FormData();

    formData.append('images', $(this)[0].files[0]);

    $.ajax({
        url: '/admin/upload',
        type: 'POST',
        data: formData,
        // 告诉jQuery不要去处理发送的数据
        processData : false,
        // 告诉jQuery不要去设置Content-Type请求头
        contentType : false,
        success: function (data) {

            $('input.file-img').val(data);

        }
    });
});

// 表单提交
$(document).on('click', '.submits', function(){

    $dataurl = $('#myForm').attr('data-url');

    $.post($dataurl, $('#myForm').serialize(), function (data) {

        if(data.status == 200) {

            layer.msg(data.msg, {icon: 1, time:2000},function(index){

                layer.close(index);

                window.location.href = data.url;

            });

        }else if (data['data'] == 203)
        {
            layer.msg(data.msg,{icon:2, time:2000});

            return false;

        } else{

            layer.msg(data,{icon:2, time:1500});
        };
    });
});

//缩略图
function mouseover(e) {

    var img = "<img src='" + $('input.file-img').val() + "'>";

    layer.tips(img,e,{tips: [1, '#fff']});

};

// 测试发送邮件
$('span.uploader-text').on('click', function () {

    $.post('Mail/sendemail',function (data) {

        if(data.status == 200){

            layer.msg(data.msg, {icon: 1, time:2000, btnAlign: 'c'}, function(index){

                layer.close(index);

                location.href = data['url'];
            });

        } else{

            layer.msg(data.msg,{icon:2, time:1500});

        }

    });
});

// 行内编辑
$(document).on('click', '.action-link', function () {
    var tr = $(this).closest('tr');

    var html = '';

    tr.find('td').each(function (index) {

        if($(this).attr('class') == 'isshow') {

            if($(this).find('i').is('.fa-check-circle')) {

                html += '<td><div class="selectbox form-group"><select class="form-control select" name="isshow"><option value="1" selected="selected">显示</option><option value="0">隐藏</option></select></div></td>';

            }else{

                html += '<td><div class="selectbox form-group"><select class="form-control select" name="isshow"><option value="1">显示</option><option value="0" selected="selected">隐藏</option></select></div></td>';

            };

        }else if($(this).attr('class') == 'smart-actions') {

            html += '<td class="smart-actions" style="line-height: 43px;"><a class="btn btn-xs btn-success link-save"><i class="glyphicon glyphicon-ok"></i> 保存</a><a class="btn btn-xs btn-warning action-link-no"><i class="glyphicon glyphicon-remove"></i> 取消</a></td>';

        } else {

            var text  = $(this).text();

            var name = $(this).attr('class');

            html += '<td><input type="text" class="form-control" name="' + name + '" value="' + text + '"></td>';
        };
    });

    tr.html(html);

});

// 取消编辑
$(document).on('click', '.action-link-no',function () {
    var tr = $(this).closest('tr');
    var html = '';

    tr.find('td').each(function (index) {

        if( $(this).find('input').attr('name') == 'url'){

            var url = $(this).find('input').val();

            html += '<td class="url"><a href="' + url + '" target="_blank">' + url + '</a></td>'

        }else if($(this).find('select.select').attr('name') == 'isshow') {

            var select = $(this).find('select.select').val();

            if(select == false) {

                html += '<td class="isshow"><i class="fa fa-times-circle"></i></td>';

            }else{

                html += '<td class="isshow"> <i class="fa fa-check-circle"></i></td>';

            };

        }else if($(this).attr('class') == 'smart-actions') {

            var id = tr.find('td').find('input[name="id"]').val();

            html += '<td class="smart-actions"><a class="btn btn-info btn-xs action-link"><i class="fa fa-pencil"></i> 编辑</a> <a data-url="/admin/link/del/id/'+ id +'" class="btn btn-danger btn-xs action-delete"><i class="fa fa-trash-o"></i> 删除</a></td>';

        }else{

            var text  = $(this).find('input').val();

            var name = $(this).find('input').attr('name');

            html += '<td class="' + name + '">' + text + '</td>';
        };


    });

    tr.html(html);

    return false;
});

//友链提交更新
$(document).on('click', '.link-save', function(){

    var formdata = $('#myForm').serialize();

    $.post('/admin/link/save',formdata, function(data){

        if(data.status == 200) {

            layer.msg(data.msg, {icon: 1, time: 2000},function () {

                location.href = data['url'];

            });

        } else if (data['data'] == 203)
        {
            layer.msg(data.msg,{icon:2, time:2000});

            return false;
        } else {

            layer.msg(data, {icon: 2, time: 1500});
        }
    });

    return false;

});

//上传分类展示图片
$(document).on('change','input.file-category',function () {
    var formData = new FormData();
    formData.append('images', $(this)[0].files[0]);

    $.ajax({
        url: '/admin/upload/cate',
        type: 'POST',
        data: formData,
        // 告诉jQuery不要去处理发送的数据
        processData : false,
        // 告诉jQuery不要去设置Content-Type请求头
        contentType : false,
        success: function (data) {
            $('input.file-img').val(data);
        }
    });
});

//上传品牌logo
$(document).on('change', '.file-brand', function () {

    var formData = new FormData();

    formData.append('images', $(this)[0].files[0]);

    $.ajax({
        url: '/admin/upload/brand',
        type: 'POST',
        data: formData,
        // 告诉jQuery不要去处理发送的数据
        processData : false,
        // 告诉jQuery不要去设置Content-Type请求头
        contentType : false,
        success: function (data) {
            $('input.file-img').val(data);
        }
    });

});

//删除
$(document).on('click', '.action-delete', function () {

    $.post($(this).attr('data-url'), function (data) {

        if(data.status == 200) {

            layer.msg(data.msg, {icon: 1, time:2000},function(index){

                layer.close(index);

                location.href = data['url'];

            });

        } else if (data['data'] == 203)
        {
            layer.msg(data.msg,{icon:2, time:2000});

            return false;
        } else{

            layer.msg(data,{icon:2, time:1500});
        };

    });
});

//树形结构
$(document).on('click', '.tree', function () {
    var tree_id = $(this).attr('tree_id');

    if($(this).is('.fa-plus'))
    {
        $(this).attr('class','fa fa-minus tree');

        $('.parent_id_'+ tree_id).show();

    } else {

        $(this).attr('class', 'fa fa-plus tree');

        $('.parent_id_'+ tree_id).hide();
    }
});

//选择发布商品的类别
$(document).on('click', '.cate_id', function () {

    var bind = $('p.binding'),
        cate,
        _bind,
        text = '<b>您当前选择的商品类别是：</b>';

    eval('cate =' +  $(this).attr('cate-data'));

    if(cate.tid == 1)
    {
        $('ul.parent').html('');

        _bind = text + $(this).text();

    } else {
        _bind = text + $('.cate.active').text() + ' <i class="fa fa-angle-right"></i> ' +  $(this).text();

        $('input[name=cate]').val(cate.cat);

    };

    $(this).addClass('active').siblings('li').removeClass('active');

    bind.html(_bind);

    $('input[name=cate]').val(cate.cid);

   /* if(cate.cid !== undefined)
    {
        $.post('/admin/goods/cgtype/id/' + cate.cid,function (data) {
            if(data == 'null')
            {
                return false;
            } else {
                var html = '';
                for(var i in data)
                {
                    html += '<li class="cate_id" cate-data="{tid:2,cat:' + data[i]["id"] + '}">' + data[i]["name"] + '</li>';
                }
                $('.parent').html(html);
            }
        });
    };*/
});
//选择商品规格
$(document).on('ifClicked', 'input.GoodsSpec', function () {

    if($(this).hasClass('success'))
    {
        $(this).removeClass('success');
    } else {
        $(this).addClass('success');
    }

    var arr = {};

    var spec = $('input.success');

    spec.each(function () {
        if($(this).hasClass('success'))
        {
            var spec_id = $(this).data('spec_id');

            var mincheck = $(this).data('parsley-mincheck');

            if(!arr.hasOwnProperty(spec_id)) arr[spec_id] = [];

            arr[spec_id].push(mincheck);
        }
    });

    descartes(arr,hbdyg);
});

//生成商品规格表
function descartes(arr,callback)
{
    function cartesianProductOf(a) {
        var arr = [];
        var arr2 = [];
        for(i in a)
        {
            arr.unshift(a[i]);

            arr2.unshift(i);
        }

        function ret(args) {
            var rs   = [];
            for (var i = 0; i < args.length; i++) {
                if (!$.isArray(args[i])) {
                    return false;  // 参数必须为数组
                }
            }

            // 两个笛卡尔积换算
            var bothDescartes = function (m, n){
                var r = []
                for (var i = 0; i < m.length; i++) {
                    for (var ii = 0; ii < n.length; ii++) {
                        var t = [];
                        if ($.isArray(m[i])) {
                            t = m[i].slice(0);  //此处使用slice目的为了防止t变化，导致m也跟着变化
                        } else {
                            t.push(m[i]);
                        }
                        t.push(n[ii]);
                        r.push(t);
                    }
                }
                return r;
            }

            // 多个笛卡尔基数换算
            for (var i = 0; i < args.length; i++) {
                if (i == 0) {
                    rs = args[i];
                } else {
                    rs = bothDescartes(rs, args[i]);
                }
            }

            return rs;
        }

    return [ret(arr), arr2];
    }

    var b = cartesianProductOf(arr);

    var str = '';

    str = "<table class='table table-bordered table-hover' id='spec_input_tab'>";

    str += '<thead><tr>';

    var arr2 = b[1];

    for(var th in arr2)
    {
        str +='<th>' + $('.th_' + arr2[th]).text() + '</th>';
    }

    str += '<th>价格</th><th>库存</th><th>SKU</th></tr></thead>';

    var arr = b[0];

    for(var i in arr)
    {
        str += '<tr>';

        var s = arr[i];

        var key_name = [];

        if (!$.isArray(s)) {

            str += '<td>' + $("#Gsattr_" + s * 10).attr("item_id") + '</td>';

            key_name.push ($('.th_' + $("#Gsattr_" + s * 10).attr("data-spec_id")).text() + ':'+ $("#Gsattr_" + s * 10).attr("item_id"));

        } else {

            for(var z in s)
            {
                str += '<td>' + $("#Gsattr_" + s[z] * 10).attr("item_id") + '</td>';

                key_name.push( $('.th_' + $("#Gsattr_" + s[z] * 10).attr("data-spec_id")).text() + ':'+ $("#Gsattr_" + s[z] * 10).attr("item_id"));
            }
        }

        var item_name = key_name.join(' ');

        str += '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="价格" name="item[' + s + '][price]"></td>' +
            '<td><input type="text" class="form-control col-md-7 col-xs-12 item-store" placeholder="库存" name="item[' + s + '][store_count]"></td>' +
            '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="SKU" name="item[' + s + '][sku]"><input type="hidden" class="form-control col-md-7 col-xs-12" placeholder="item_name" name="item[' + s + '][key_name]" value="' + item_name + '"></td>';

        str += '</tr>';
    };

    str += '</table>';
    $('.gootdstable').html(str);
    callback();
};

$(document).on('keyup','.item-store',function(){
   var sum = $('.item-store');

   var suv = 0;

   for(var i = 0; i < sum.length; i++)
   {
       suv += Number(sum[i].value);
   }

    $("input[name='count']").val(suv);

})
//合并单元格
function hbdyg() {
    var tab = document.getElementById("spec_input_tab"); //要合并的tableID
    var maxCol = 2, val, count, start;  //maxCol：合并单元格作用到多少列
    if (tab != null) {
        for (var col = maxCol - 1; col >= 0; col--) {
            count = 1;
            val = "";
            for (var i = 0; i < tab.rows.length; i++) {
                if (val == tab.rows[i].cells[col].innerHTML) {
                    count++;
                } else {
                    if (count > 1) { //合并
                        start = i - count;
                        tab.rows[start].cells[col].rowSpan = count;
                        for (var j = start + 1; j < i; j++) {
                            tab.rows[j].cells[col].style.display = "none";
                        };
                        count = 1;
                    };
                    val = tab.rows[i].cells[col].innerHTML;
                };
            };
            if (count > 1) { //合并，最后几行相同的情况下
                start = i - count;
                tab.rows[start].cells[col].rowSpan = count;
                for (var j = start + 1; j < i; j++) {
                    tab.rows[j].cells[col].style.display = "none";
                };
            };
        };
    };
};



