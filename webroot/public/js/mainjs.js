//===== jquery setting =====//

var ajaxSetupData = {};

$.ajaxSetup({
    data: ajaxSetupData,
    error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status == 0 && textStatus != "error") {
            return;
        }
        if (jqXHR.status == 412) {
            return;
        }
        try {
            if (jqXHR.status == 0) {
                if (textStatus == 'error') {
                    console.log('系统错误');
                } else {
                    alert('访问出错：' + textStatus);
                }
            } else {
                var msg = '访问出错：(' + jqXHR.status + ')';
                if (jqXHR.responseText) {
                    msg = msg + jqXHR.responseText;
                }
                alert(msg)
            }
        } catch (ex) {
            console.log("request error: " + jqXHR.status + '; status: ' + textStatus, ex);
        }
    },
    jsonp: null,
    jsonpCallback: null
});

$('.requireNum').each(function () {
    $(this).keypress(function (event) {
        return (/[\d.]/.test(String.fromCharCode(event.keyCode)));
    });
});

$.loading = function () {
    if ($.browser.msie && $.browser.version <= 9) {
        $('body').append('<div class="overlay" class="background-color: #F0F4FF;"><div class="opacity"></div><i class="gif-loading spin"></i></div>');
    } else {
        $('body').append('<div class="overlay"><div class="opacity"></div><i class="icon-spinner2 spin"></i></div>');
    }
    $('.overlay').fadeIn(150);
}

$.fn.loading = function () {
    var $wrapper = $(this);
    var $loading = $('#loading-container-parent').clone();
    $loading.attr('id', '').css('display', 'block');
    $wrapper.html('<div class="loading-content-wrapper" style="display:none;">' + $wrapper.html() + "</div>");
    $wrapper.append($loading);
}

$.fn.hideLoading = function () {
    var $wrapper = $(this);
    $('.loading-container', $wrapper).remove();
    $('.hide-until-loading', $wrapper).removeClass('hide-until-loading');
    $wrapper.html($('.loading-content-wrapper', $wrapper).html());
}

$.hideLoading = function () {
    $('.overlay').fadeOut(150);
}

var intervalList = {};
$.interval = function (key, callback, nanoTime) {

    if (!nanoTime) {
        throw 'no nano time for interval';
    }

    if (_.has(intervalList, key)) {
        clearInterval(intervalList[key]);
    }
    intervalList[key] = setInterval(callback, nanoTime);
}

$.clearInterval = function (key) {
    if (_.has(intervalList, key)) {
        clearInterval(intervalList[key]);
        delete(intervalList[key]);
    }
}

$.containInterval = function (key) {
    return _.has(intervalList, key);
}

//$.fn.loadLoading = function (left, top, width, height) {
//    if (!width) {
//        width = '100%';
//    }
//    if (!height) {
//        height = '100%';
//    }
//    if (!left) {
//        return;
//    }
//    left = left + "px";
//    if (!top) {
//        return;
//    }
//    top = top + "px";
//
//    var $this = $(this);
//    $this.empty();
//    $this.html(_.template($('#template-load-loading').html(), {
//        width: width,
//        height: height,
//        left: left,
//        top: top
//    }));
//}

//IE8 trim()兼容
if (typeof String.prototype.trim !== 'function') {
    String.prototype.trim = function () {
        return this.replace(/^\s+|\s+$/g, '');
    }
}

// ----------  get message alert  ----------
$.getHtmlAlertSuccess = function (message) {
    return _.template($('#template-alert-success').html(), {message: message});
}

$.getHtmlAlertFail = function (message, error) {
    return _.template($('#template-alert-error').html(), {message: message, error: error});
}

$.fn.formValues = function () {
    var list = {};
    $('input, select').each(function (key, one) {
        list[$(one).attr('name')] = $(one).val();
    });
    return list;
}

$.redirect = function (url) {
    window.location = url;
}

// ----------  load model  ----------
$.load = function (url) {
    var model = undefined;
    $.ajax({
        url: url,
        async: false,
        success: function (data, textStatus, jqXHR) {
            if (!_.isUndefined(data.code) && (data.code == 0)) {
                model = data.model;
                return;
            }
            console.log(data);
        }
    });
    return model;
}

//caret control
$('.caret-controller').click(function () {
    var $con = $(this);
    var $ta = $($con.data('target'));

    if ($ta.data('shown') == 1) {
        $ta.data('shown', 0);
        $('.icon-arrow-up2', $con).show();
        $('.icon-arrow-down2', $con).hide();
    } else {
        $ta.data('shown', 1);
        $('.icon-arrow-down2', $con).show();
        $('.icon-arrow-up2', $con).hide();
    }

    $ta.toggle();
});

// ----------  upload  ----------

$.fn.rsupload = function (options) {

    var opt = $.extend({
        url: '/storage/upload',
        success: function () {
            alert('need to add options.success');
        },
        error: function () {
            console.log()
            // alert('need to add options.error');
        },
        complete: function () {
            // alert('need to add options.complete');
        },
        data: ajaxSetupData
    }, options);
    opt.data.isajax = 1;

    console.log(ajaxSetupData);

    $(this).swfupload({
        upload_url: opt.url,
        file_size_limit: "102400",
        file_types: "*.*",
        file_types_description: "文件",
        file_upload_limit: "0",
        post_params: opt.data,
        flash_url: app.config.res + "/bower_components/jquery-file-upload-swf/vendor/swfupload/swfupload.swf",
        button_image_url: app.config.res + "/bower_components/jquery-file-upload-swf/vendor/swfupload/XPButtonUploadText_61x22.png",
        button_width: 61,
        button_height: 22,
        button_placeholder: $('.swf-button', $(this))[0],
        debug: false,
        custom_settings: {something: "here"}
    })
        .bind('swfuploadLoaded', function (event) {
            $('#log').append('<li>Loaded</li>');
        })
        .bind('fileQueued', function (event, file) {
            $('#log').append('<li>File queued - ' + file.name + '</li>');
            // start the upload since it's queued
            $(this).swfupload('startUpload');
        })
        .bind('fileQueueError', function (event, file, errorCode, message) {
            $('#log').append('<li>File queue error - ' + message + '</li>');
        })
        .bind('fileDialogStart', function (event) {
            $('#log').append('<li>File dialog start</li>');
        })
        .bind('fileDialogComplete', function (event, numFilesSelected, numFilesQueued) {
            $('#log').append('<li>File dialog complete</li>');
        })
        .bind('uploadStart', function (event, file) {
            $('#log').append('<li>Upload start - ' + file.name + '</li>');
        })
        .bind('uploadProgress', function (event, file, bytesLoaded) {
            $('#log').append('<li>Upload progress - ' + bytesLoaded + '</li>');
        })
        .bind('uploadSuccess', function (event, file, serverData) {
            var data = jQuery.parseJSON(serverData);
            opt.success(data);
        })
        .bind('uploadComplete', function (event, file) {
            opt.complete.apply(this, arguments);
            $(this).swfupload('startUpload');
        })
        .bind('uploadError', function (event, file, errorCode, message) {
            opt.error.apply(this, arguments);
        });

}

/* # Bootstrap Plugins
 ================================================== */

//===== Tooltip =====//

$('.tip').tooltip();

//===== Popover =====//

$("[data-toggle=popover]").popover().click(function (e) {
    e.preventDefault()
});

//===== Add fadeIn animation to dropdown =====//

$('.dropdown, .btn-group').on('show.bs.dropdown', function (e) {
    $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
});

//===== Add fadeOut animation to dropdown =====//

$('.dropdown, .btn-group').on('hide.bs.dropdown', function (e) {
    $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
});

//===== Prevent dropdown from closing on click =====//

$('.popup').click(function (e) {
    e.stopPropagation();
});

// ----------  admin table update  ----------

function updateAndReload(form, updateDoneFunc) {
    var $tr = $(this).parents('tr:first');
    var data = {};
    $('.ajax-input', $tr).each(function (ind, ele) {
        data[$(ele).attr('name')] = $(ele).val();
    });

    data.id = $tr.data('id');
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: {DataNotDoneUpdate: data},
        success: function (ret) {
            if (ret.code == 0) {
                $(form).yiiGridView('update', {});
                if (updateDoneFunc) {
                    updateDoneFunc();
                }
            } else {
                alert(ret.message);
            }
        }
    });

    return false;
}

function rebindGridInit(updateDoneFunc) {
    console.log('rebind');
    $(".grid-view .ajax-done").unbind("click");
    $(".grid-view .ajax-done").click(function () {
        var $form = $(this).parents('.grid-view:first');
        updateAndReload.apply(this, $form, updateDoneFunc);
        return false;
    });

    $('.grid-view .ajax-input').unbind('keydown');
    $('.grid-view .ajax-input').keydown(function (e) {
        if (e.keyCode == 13) {
            var $form = $(this).parents('.grid-view:first');
            updateAndReload.apply(this, $form, updateDoneFunc);
            return false;
        }
    });

    loadDatePicker('.grid-view .grid-date-picker', function ($dom, obj) {
        $wrapper = $dom.parent();
        $('input.date-range', $wrapper).val(obj.startDate + ':' + obj.endDate);
        $('input.date-range', $wrapper).change();
    });
}

/**
 usage

 */
var datePickerFuncList = {};
$.datePickerFunc = function (opts) {
    for (var key in opts) {
        if (typeof(datePickerFuncList[key]) != 'undefined') {
            throw 'dataPicker func set before'
        }
        datePickerFuncList[key] = opts[key];
    }
}

$.callDatePickerfunc = function (key) {
    if (typeof(datePickerFuncList[key]) == 'undefined') {
        throw 'dataPicker func [' + key + '] not set, please set'
    }
    return datePickerFuncList[key];
}

function loadDatePicker(select, func) {
    console.log('load date picker' + select)
    $(select).each(function () {
        var $dom = $(this);
        var $this = $(this);
        var id = $('.date_title', $this).attr('id');
        var inputId = $('.opt_sel', $this).attr('id');
        var dateRange = new pickerDateRange(id, {
            isTodayValid: true,
            startDate: $this.data('start-date'),
            endDate: $this.data('end-date'),
            //needCompare : true,
            //isSingleDay : true,
            //shortOpr : true,
            defaultText: ' 至 ',
            inputTrigger: inputId,
            theme: 'ta',
            success: function (obj) {
                $.callDatePickerfunc($this.data('func-success')).call(this, obj, $dom);

                if (typeof(func) == 'function') {
                    func($dom, obj);
                }
            }
        });
    });
}

$().ready(function () {
    rebindGridInit();
    loadDatePicker('.date-picker');
    $.datePickerFunc({
        grieviewDatePickerReload: function (obj, $dom) {
            $wrapper = $dom.parents('.grid-view:first');
        }
    })
})


