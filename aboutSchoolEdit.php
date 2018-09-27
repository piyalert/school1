<?php
require_once __DIR__.'/_session.php';


$menuAction = 'about';
$menuAbout = 'school';
$year = date("Y");

require_once __DIR__."/controller/aboutSchoolEditController.php";
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
              <h4><i class="fa fa-user"></i> เกี่ยวกับโรงเรียน </h4>
          </div>
          <hr class="mt-2">

          <div class="mb-0 mt-4">

              <div class="form-group">
                  <label for="input_year">ปีการศึกษา</label>
                  <select class="form-control" id="input_year" name="year" onchange="selectYear(this);">
                      <?php for ($i=$year;$i>($year-10);$i--): ?>
                          <option value="<?php echo ($i);?>" <?php echo $i==$school_year?'selected':'';?> > <?php echo ($i+543); ?></option>
                      <?php endfor; ?>
                  </select>
              </div>


              <div class="form-group">
                  <label for="username">รายละเอียด </label>
                  <div id="editor">
                      <div id='edit'> <?php echo $school_detail; ?> </div>
                  </div>
              </div>
          </div>

          <div class="text-center" style="padding-top: 20px; padding-bottom: 30px;">
              <input id="about_id" name="about_id" value="<?php echo $school_id; ?>" hidden>
              <button type="button" class="btn btn-success" onclick="saveAbout();" >บันทึก</button>
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

    function selectYear(res) {
        var input_year = res.value;
        document.location = "aboutSchoolEdit.php?year="+input_year;
    }

    function saveAbout() {
        var type = 'school';
        var detail = $('#edit').froalaEditor("html.get");
        var year = $('#input_year').val();
        var id = $('#about_id').val();
        if(id==0){
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'insertAbout',
                    detail: detail,
                    type: type,
                    year: year
                },
                dataType: 'JSON'
            });
        }else{
            var req = $.ajax({
                type: 'POST',
                url: './controller/service.php',
                data: {
                    fn: 'updateAbout',
                    detail: detail,
                    type: type,
                    year: year,
                    id: id
                },
                dataType: 'JSON'
            });
        }

        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                document.location = "aboutSchoolEdit.php?year="+year;
            }else{
                alert('save data false!!!!');
            }
        });


    }
</script>


