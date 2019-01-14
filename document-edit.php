<?php
require_once __DIR__."/_session.php";
require_once __DIR__ . "/_loginTeacher.php";

$menuAction = 'document';
require_once __DIR__."/controller/documentEditController.php";
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
            <h4><i class="fa fa-user"></i> เอกสาร </h4>
        </div>
        <hr class="mt-2">

        <form class="mb-0 mt-4 col-xl-10 offset-1" method="post">

            <div class="form-group">
                <label for="input_title">หัวข้อเอกสาร</label>
                <input class="form-control" id="input_title" name="title" type="text" placeholder="หัวข้อ" value="<?php echo $TITLE; ?>" required>
            </div>

            <div class="form-group">
                <label for="input_group">หมวดหมู่เอกสาร</label>
                <select class="form-control" id="input_group" name="group" required>
                    <option value="">กรุณาเลือก</option>
                    <option value="เอกสารงานแผน">เอกสารงานแผน</option>
                    <option value="เอกสารการเงิน">เอกสารการเงิน</option>
                    <option value="เอกสารอื่นๆ">เอกสารอื่นๆ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file_download">เอกสารอัพโหลด</label>
                <div id="file_download" attr="<?php echo (count($FILES)>0)?(count($FILES)+1):1;?>">
                    <?php foreach ($FILES as $key=>$item): ?>
                    <div id="file_<?php echo $key+1; ?>">
                        <input name="file_name_<?php echo $key+1; ?>" value="<?php echo $item['name']; ?>" hidden>
                        <input name="file_path_<?php echo $key+1; ?>" value="<?php echo $item['path']; ?>" hidden>
                        <a href="<?php echo $item['path']; ?>" target="_blank"> <?php echo $item['name']; ?> </a>
                        <button class="btn btn-danger btn-sm" onclick="deleteFile('<?php echo $key+1; ?>');"><i class="fa fa-remove"></i></button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="loadFile" class="text-center">
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
                            <input id="file_upload" type="file" style="display:none;" onchange="uploadFile(this)">
                        </label>
                    </div>
                </div>

            </div>

            <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
                <input id="doc_id" name="doc_id" value="<?php echo $DOCID;?>" hidden>
                <input name="fn" value="updateDoc" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>

        </form>

    </div>
    <!-- /.container-fluid-->



</div>
</body>
<footer class="sticky-footer">
    <?php include( __DIR__."/footer.php"); ?>
</footer>


<script>

    function deleteFile(number) {
        $('#file_'+number).remove();
    }


    var ajax_upload;
    function uploadFile(input) {
        if (input.files && input.files[0]) {
            ajax_upload = new XMLHttpRequest();
            var file_name = input.files[0].name;
            //console.log(file_name);

            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            file_type = file_type.toLowerCase();
            var set_type_upload = "doc";
            //console.log(file_type);

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

                    var indexNum = $('#file_download').attr('attr');
                    var strHtml = '<div id="file_'+indexNum+'">';
                    strHtml += '<input name="file_name_'+indexNum+'" value="'+file_name+'" hidden>';
                    strHtml += '<input name="file_path_'+indexNum+'" value="'+src+'" hidden>';
                    strHtml += '<a href="'+src+'" target="_blank"> '+file_name+' </a>';
                    strHtml += '<button class="btn btn-danger btn-sm" onclick="deleteFile('+indexNum+');"><i class="fa fa-remove"></i></button>';
                    strHtml += '</div>';
                    $('#file_download').attr('attr',(parseInt(indexNum) + 1));
                    $('#file_download').append(strHtml);

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