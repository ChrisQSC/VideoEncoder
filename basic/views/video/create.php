<?php

use yii\helpers\Html;
use app\assets\UploaderAsset;


/* @var $this yii\web\View */
/* @var $model app\models\Video */

UploaderAsset::register($this);

$this->title = '视频上传';
$this->params['breadcrumbs'][] = ['label' => '视频', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>

<div class="container">

    <br>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>添加文件...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>开始上传</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>停止上传</span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">注意事项</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>上传文件最大为 <strong>1.5 GB</strong> .</li>
                <li>仅支持图片文件 (<strong>JPG, GIF, PNG</strong>) 以及视频文件.</li>
                <li>可通过拖曳添加文件.</li>
            </ul>
        </div>
    </div>
</div>


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class='col-sm-4'>
            <span class="preview"></span>
        </td>
        <td class='col-sm-4'>
            <br>
            <div class="input-group">
              <span class="input-group-addon">视频名称</span>
              <input type="text" class="form-control" name = "videoname[]"required>
            </div>
            <p></p>
            <strong class="error text-danger"></strong>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td class='col-sm-4'>
            <br>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>开始</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>取消</span>
                </button>
            {% } %}
            <p>{%=file.name%}</p>
            <p class="size">上传中</p>
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td class='col-sm-4'>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="/index.php?r=video/view&md5={%=file.md5%}" title="{%=file.name%}"><img src="{%=file.thumbnailUrl%}" style = "width:80; height:60"></a>
                {% } %}
            </span>
        </td>
        <td class='col-sm-4'>
            <p class="name">
                {% if (file.md5) { %}
                    <a href="/index.php?r=video/view&md5={%=file.md5%}" title="{%=file.videoname%}"><h3>{%=file.videoname%}&emsp;<span class="size btn btn-success btn-xs">{%=o.formatFileSize(file.size)%}</span></h3></a>
                {% } else { %}
                    <h3>{%=file.name%}&emsp;<span class="size btn btn-success btn-xs">{%=o.formatFileSize(file.size)%}</span></h3>
                {% } %}          
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
            <p></p>
            <form class = 'form-inline' role = "form">
            <div class = "form-group select_tpl">
                <?= Html::dropDownList('m_category',$category[0][1],$category[0],['class'=>'form-control maincategory']);
                    echo Html::dropDownList('select_1',$category[1],$category[1],['class'=>'form-control subcategory active']);

                    for($i=2;$i<sizeof($category);$i++)
                    {
                        echo Html::dropDownList('select_'.$i,$category[$i],$category[$i],['class'=>'form-control subcategory hidden']);
                    }
                ?>
                <span class="btn btn-primary btn-sm category-commit" file={%=file.md5%}>提交</span>
            </div>
            </form>
        </td>
        <td class='col-sm-4'>
        </td
    </tr>
{% } %}
</script>

<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
