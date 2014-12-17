<?php $form = new MActiveForm(); ?>
<form action="" method="post" class="form-horizontal">

    <?= $form->errorSummary($model); ?>

    <?php echo $form->activeTextField($model, 'title'); ?>
    <?php echo $form->activeTextField($model, 'alias'); ?>
    <?php echo $form->activeTextField($model, 'link'); ?>
    <?php echo $form->activeSwfUpload($model, 'image', array ('swfUploadId' => 'fu-image')); ?>
    <div id="image-wrapper" class="col-sm-offset-2">
        <?php if ($model->image) {
            echo MHtml::image($model->image, 100);
        } ?>
    </div>

    <?php echo $form->activeTextAreaField($model, 'content', array (
        'id' => 'editor',
    )); ?>

    <?php //echo $form->activeEditorField($model, 'content'); ?>

    <div class="col-sm-offset-2">
        <button class="btn btn-primary" type="submit">下一步</button>
    </div>
</form>


<script type="text/javascript">
    $().ready(function () {

        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        };

        $('#editor').wysihtml5({locale: "zh-CN"});

        $('#fu-image').rsupload({
            success: function (data) {
                if (data.code != 0) {
                    alert(data.message);
                    return;
                }

                var file = data.file;
                var imgUrl = '/storage/down?key=' + file.fileKey;
                $('input.data-image').val(imgUrl);
                var $wrapper = $('#image-wrapper');
                $wrapper.empty();
                $wrapper.append('<img src="' + imgUrl + '" width="100"/>');
            }
        });
    });
</script>
