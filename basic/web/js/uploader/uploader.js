/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/?r=video/uploader'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    $('#fileupload').bind('fileuploadsubmit', function (e, data) {
        var inputs = data.context.find(':input');
        if (inputs.filter(function () {
                return !this.value && $(this).prop('required');
            }).first().focus().length) {
            data.context.find('button').prop('disabled', false);
            return false;
        }
        data.formData = inputs.serializeArray();
    });

    $(document).on('change','.maincategory',function(e){
        var parent = $(e.target).parent();
        parent.find('.active').removeClass('active').addClass('hidden').addClass('disabled');
        var selection = parent.find('.maincategory').children('option:selected').val();
        parent.find("[name='select_"+selection+"']").removeClass('hidden').removeClass('disabled').addClass('active');
    });

    $(document).on('click','.category-commit',function(e){
        var parent = $(e.target).parent();
        var data = {'category':parent.find('.active').val()};
        $(e.target).attr("disabled",true);
        $.ajax({
            type:"POST",
            url:"/?r=video/setcategory&md5="+$(e.target).attr("file"),
            data:data,
            success:function(data){
                $('.category-commit').attr("disabled",false);
                $.globalMessenger().post("分类修改成功！");
            }
        });
    });
});

