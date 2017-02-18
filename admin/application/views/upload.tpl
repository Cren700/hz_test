<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>栏目标签</title>
    <link rel="stylesheet" href="/admin/static/css/uploadify.css">
    <script type="text/javascript" src="/admin/static/js/plugin/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/static/js/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="/admin/static/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/static/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="/admin/static/ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>


<form method="post" action="/admin/uploadfile/getUpload" enctype="multipart/form-data" />
<!--<input type="file" id="file_upload" name="userfile" size="20" />-->
<textarea name="content" id="edi" >1234</textarea>
<input type="submit" value="submit">
<div id="progress"></div>
</form>
<script id="editor" type="text/plain">

</script>

<script type="text/javascript">

    var $content = $('textarea[name=content]');
    var ue = UE.getEditor('edi', {
        autoHeightEnabled: true,
        autoFloatEnabled: true,
        initialFrameWidth: 800,
        initialFrameHeight: 300
    });

    // 初始化数据
    ue.ready(function() {
        ue.setContent($content.val());
    });

</script>
</body>
</html>