<?php
require_once __DIR__."/_session.php";

$menuAction = 'news';
$year = date("Y");
?>

<head>
    <?php include( __DIR__."/head.php"); ?>

    <!-- css froala -->
    <?php include( __DIR__."/_froalaCss.php"); ?>



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
                <img id="src_image" src="upload/file_upload/null.png" alt="File Upload" class="img-rounded" style="height: 250px;">
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
                    <option value="<?php echo ($i);?>"> <?php echo ($i+543); ?></option>
                    <?php endfor; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="input_title">หัวข้อข่าว</label>
                <input class="form-control" id="input_title" name="title" type="text" placeholder="หัวข้อข่าว" value="">
            </div>

            <div class="form-group">
                <label for="username">รายละเอียด </label>
                <div id="editor">
                    <div id='edit'>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
            <button type="button" class="btn btn-success" onclick="saveNews();" >บันทึก</button>
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
<?php include( __DIR__."/_froalaScript.php"); ?>

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
            var file_type_set_accept = ["png","jpg"];
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


    function saveNews() {
        var path  = $('#src_image').attr('src');
        var title = $('#input_title').val();
        var detail = $('#edit').froalaEditor("html.get");
        var year = $('#input_year').val();
        var req = $.ajax({
            type: 'POST',
            url: './controller/service.php',
            data: {
                fn: 'insertNews',
                detail: detail,
                title: title,
                img: path,
                year: year,
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