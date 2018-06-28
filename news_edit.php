<?php
date_default_timezone_set("Asia/Bangkok");

$menuAction = 'news';
require_once __DIR__."/controller/newsEditController.php";
$year = date("Y");
?>

<head>
    <?php include( __DIR__."/head.php"); ?>

    <!-- css froala -->
    <link rel="stylesheet" href="froala/css/froala_editor.css">
    <link rel="stylesheet" href="froala/css/froala_style.css">
    <link rel="stylesheet" href="froala/css/plugins/code_view.css">
    <link rel="stylesheet" href="froala/css/plugins/colors.css">
    <link rel="stylesheet" href="froala/css/plugins/emoticons.css">
    <link rel="stylesheet" href="froala/css/plugins/image_manager.css">
    <link rel="stylesheet" href="froala/css/plugins/image.css">
    <link rel="stylesheet" href="froala/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="froala/css/plugins/table.css">
    <link rel="stylesheet" href="froala/css/plugins/char_counter.css">
    <link rel="stylesheet" href="froala/css/plugins/video.css">
    <link rel="stylesheet" href="froala/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="froala/css/plugins/file.css">
    <link rel="stylesheet" href="froala/css/plugins/quick_insert.css">



</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include( __DIR__."/memu.php"); ?>


<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Card Columns Example Social Feed-->
        <div class="mb-0 mt-4">
            <h4><i class="fa fa-user"></i> เพิ่มข่าวประกาศ </h4>
        </div>
        <hr class="mt-2">


        <div id="loadFile" class="text-center">
            <div class="form-show-file" style="padding-top: 20px;">
                <img id="src_image" src="<?php echo $this_img; ?>" alt="File Upload" class="img-rounded" style="height: 250px;">
            </div>
            <div class="form-inline" id="show_progressBar_upload" hidden>
                <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                    <div id="progressBar_upload" class="progress-bar" role="progressbar"
                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                         style="width: 0%;">
                        0%
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-xs"
                        onclick="cancelUploadFile()">
                    <span class="fa fa-remove" aria-hidden="true"></span>
                </button>
            </div>
            <div class="text-center" style="padding-top: 20px;">
                <div class="box-img-ready">
                    <label class="alert alert-dark" style="cursor: pointer" for="file_upload">
                        <span class="label label-info"><i class="fa fa-upload"></i> Upload </span>
                        <input id="file_upload" accept="image/*" type="file" style="display:none;" onchange="uploadFile(this)">
                    </label>
                </div>
            </div>

        </div>


        <div class="mb-0 mt-4">

            <div class="form-group">
                <label for="input_year">ปีการศึกษา</label>
                <select class="form-control" id="input_year" name="year">
                    <?php for ($i=$year;$i>($year-10);$i--): ?>
                    <option value="<?php echo ($i);?>" <?php echo $i==$this_year?'selected':'';?>> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="input_title">หัวข้อข่าว</label>
                <input class="form-control" id="input_title" name="title" type="text" placeholder="หัวข้อข่าว" value="<?php echo $this_title; ?>">
            </div>

            <div class="form-group">
                <label for="username">รายละเอียด </label>
                <div id="editor">
                    <div id='edit'><?php echo $this_detail; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
            <input id="news_id" name="news_id" value="<?php echo $news_id;?>" hidden>
            <button type="button" class="btn btn-success" onclick="editNews();" >บันทึก</button>
        </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->



</div>
</body>
<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
</footer>


<!-- froala script -->
<script type="text/javascript" src="froala/js/froala_editor.min.js" ></script>
<script type="text/javascript" src="froala/js/plugins/align.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/entities.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/file.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/image.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/link.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/table.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/save.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/url.min.js"></script>
<script type="text/javascript" src="froala/js/plugins/video.min.js"></script>

<script>
    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
    });


    var ajax_upload;
    function uploadFile(input) {
        if (input.files && input.files[0]) {
            ajax_upload = new XMLHttpRequest();
            var file_name = input.files[0].name;
            //console.log(file_name);

            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            file_type = file_type.toLowerCase();
            var file_type_set_accept = ["png"];
            var set_type_upload = "news";
            //console.log(file_type);

            //check type file upload
            if (file_type_set_accept.indexOf(file_type)>=0) {

                var show_progressBar_upload = "show_progressBar_upload";
                var progressBar = "progressBar_upload";

                $('#'+show_progressBar_upload).removeAttr('hidden');

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_upload.upload.addEventListener("progress", progressHandler, false);
                ajax_upload.addEventListener("load", completeHandler, false);
                ajax_upload.addEventListener("error", errorHandler, false);
                ajax_upload.addEventListener("abort", abortHandler, false);
                ajax_upload.open("POST", "/school/upload/upload_file.php?type="+set_type_upload);
                ajax_upload.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/school/upload/file_upload/'+data_return['new_name'];
                        var res_filename = data_return['file_name'];
                        $('#' + show_progressBar_upload).attr("hidden",true);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#src_image').attr('src',src);
                        $('#path_upload').attr('value',src);
                        $('#name_upload').attr('value',res_filename);


                    } else {
                        ajax_upload.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_upload.abort();
                    alert("Upload Failed");
                    $('#' + show_progressBar_upload).attr("hidden",true);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_upload.abort();
                    alert("Upload Aborted");
                    $('#' + show_progressBar_upload).attr("hidden",true);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }

            } else {
                alert("File type cannot upload!!!");
            }
        } else {
            alert("Not found file input!!!");
        }
    }
    function cancelUploadFile() {
        ajax_upload.abort();
        $('#show_progressBar_upload').attr("hidden",true);
        $("#file_upload").val("");

    }


    function editNews() {
        var path  = $('#src_image').attr('src');
        var title = $('#input_title').val();
        var detail = $('#edit').froalaEditor("html.get");
        var year = $('#input_year').val();
        var id = $('#news_id').val();
        var req = $.ajax({
            type: 'POST',
            url: './controller/service.php',
            data: {
                fn: 'updateNews',
                detail: detail,
                title: title,
                img: path,
                year: year,
                id: id
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "news.php";
            }else{
                alert('save data false!!!!');
            }
        });


    }


</script>