<?php
require_once __DIR__."/_session.php";


$menuAction = 'saving';
$menuSave = 0;
$UrlYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : 2561;
$UrlYear = $UrlYear>2500?$UrlYear-543:$UrlYear;
$year = date("Y");




require_once __DIR__."/controller/teacherSaveSearch.php";

?>


<head>
    <?php include(__DIR__ . "/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include(__DIR__ . "/memu.php"); ?>

<div class="content-wrapper">

    <ul class="nav nav-pills breadcrumb">
        <li class="nav-item">
            <strong>ค้นหา</strong>
        </li>
    </ul>

    <div class="form-inline" method="post">
        <div class="form-group ml-5">
            <select class="btn btn-light" name="search_attr" id="search_attr">
                <option value="name">ชื่อ</option>
                <option value="surname">นามสกุล</option>
                <option value="id">User id</option>
                <option value="username">Username</option>
                <option value="id_card">เลขประจำตัวประชาชน</option>
            </select>
            <input class="form-control" name="search_value" id="search_value" type="text" value="">
            <button class="btn btn-info" type="submit" onclick="showSearch();" data-toggle="modal" data-target="#modalSearchListUser"><i class="fa fa-search"></i> Search</button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6" style="background-color: #D5F5E3;">
            <div class="m-2">

                <div class="text-center">
                    <strong style="text-decoration: underline;"> ฝาก </strong>
                </div>

                <div class="form-inline mt-2">
                    <div class="form-group ml-2">
                        <label class="mr-3" for="deposit_year"> ปีการศึกษา </label>
                        <select class="form-control" id="deposit_year" name="year">
                            <?php for ($i=$year;$i>($year-10);$i--): ?>
                                <option value="<?php echo ($i);?>"> <?php echo ($i+543); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group ml-2">
                        <label class="mr-3" for="deposit_ymd"> วันที่ฝากเงิน </label>
                        <input class="form-control" id="input_ymd" name="date_at" type="date" value="">
                    </div>
                </div>
                <div class="form-inline mt-2">
                    <div class="form-group ml-2">
                        <label class="mr-3" for="deposit_balance"> จำนวนเงินที่ฝาก </label>
                        <input class="form-control" id="deposit_balance" name="balance" type="number" value="">
                    </div>
                </div>

                <div class="text-center mt-2">
                    <button class="btn btn-success">ฝาก</button>
                </div>


            </div>
        </div>
        <div class="col-md-6" style="background-color: #FADBD8;">
            <div class="m-2">

                <div class="text-center">
                    <strong style="text-decoration: underline;"> ถอน </strong>
                </div>

                <div class="form-inline mt-2">
                    <div class="form-group ml-2">
                        <label class="mr-3" for="withdraw_year"> ปีการศึกษา </label>
                        <select class="form-control" id="withdraw_year" name="year">
                            <?php for ($i=$year;$i>($year-10);$i--): ?>
                                <option value="<?php echo ($i);?>"> <?php echo ($i+543); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group ml-2">
                        <label class="mr-3" for="withdraw_ymd"> วันที่ถอน </label>
                        <input class="form-control" id="withdraw_ymd" name="date_at" type="date" value="">
                    </div>
                </div>
                <div class="form-inline mt-2">
                    <div class="form-group ml-2">
                        <label class="mr-3" for="withdraw_balance"> จำนวนเงินที่ถอน </label>
                        <input class="form-control" id="withdraw_balance" name="balance" type="number" value="">
                    </div>
                </div>

                <div class="text-center mt-2">
                    <button class="btn btn-danger">ถอน</button>
                </div>


            </div>
        </div>
    </div>

    <hr>

    <div class="container-fluid mt-4">
        <!-- Card Columns Example Social Feed-->


        <div class="text-center">
            <strong>รายการฝากถอน</strong> ยอดเงิน:<span style="color: red">(20)</span>
        </div>
        <table id="table_saving" class="table table-striped table-bordered" style="width:100%;">
            <thead style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>วันที่ทำรายการ</th>
                <th>ปีการศึกษา</th>
                <th> ฝาก ถอน </th>
                <th>ยอดฝากถอน</th>
                <th> Action </th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($SAVELIST as $key=>$item): ?>
                <tr>
                    <td><?php echo ($key+1);?></td>
                    <td><?php echo $item['date_at'];?></td>
                    <td><?php echo $item['year'];?></td>
                    <td><?php echo $item['event'];?></td>
                    <td><?php echo $item['balance'];?></td>
                    <td>x</td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <div class="value-attr" hidden>
            <input id="input_year" value="<?php echo $UrlYear;?>">
            <input id="input_class" value="<?php echo $menuSave;?>">
            <input id="input_login_user_id" value="<?php echo $SESSION_user_id;?>">
        </div>

    </div>


    <!--    modal -->
    <div class="modal fade" id="modalSearchListUser" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายวิชา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table id="table_usersearch" class="table table-striped table-bordered" style="width:100%;">
                        <thead style="font-size: 12px;">
                        <tr>
                            <th>เลขประจำตัวประชาชน</th>
                            <th>ชื่อ สกุล</th>
                            <th>Select</th>
                        </tr>
                        </thead>
                        <tbody id="showListSearch">

                        </tbody>
                    </table>
                </div>

                <form class="modal-footer" method="post">
                    <input id="modal_user_id" name="id" value=""  hidden>
                    <button type="submit" class="btn btn-success" >เลือกสมาชิก</button>
                </form>

            </div>
        </div>
    </div>


</body>

<footer class="sticky-footer">
    <?php include(__DIR__ . "/footer.php"); ?>
</footer>

<script>

    $(document).ready(function() {

        $('#table_usersearch').DataTable({
            "lengthChange": false,
            "bInfo" : false,
            "bPaginate":false,
            "iDisplayLength" : 100
        });

        $('#table_saving').DataTable({
            "lengthChange": false,
            "bInfo" : false,
            "iDisplayLength" : 30
        });
    } );

    function showSearch() {
        var attr = $('#search_attr').val();
        var value = $('#search_value').val();
        if(value.length > 0){
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'searchUser',
                    attr: attr,
                    value: value
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    var item = res.data;
                    var str = "";
                    for(var i =0 ;i<item.length;i++){
                        if(i==0){
                            $('#modal_user_id').attr('value',item[i]['id']);
                        }
                        str+="<tr>";
                        str+="<td>"+item[i]['id_card']+"</td>";
                        str+="<td>"+item[i]['name']+" "+item[i]['surname']+"</td>";
                        str+="<td><input type='radio' name='modelSelectUser' value='"+item[i]['id']+"' "+((i==0)?"checked":"")+" onclick='clickSelect(this)' > Select</td>";
                        str+="</tr>";
                    }

                    $('#showListSearch').html(str);
                }
            });

        }

    }
    function clickSelect(res) {
        $('#modal_user_id').attr('value',$(res).val());
    }



</script>


