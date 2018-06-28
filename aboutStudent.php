<head>
<?php include( __DIR__."/head.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include( __DIR__."/memu.php"); ?>
  <center><div class="card mb-3" style="width: 40rem">
  <form name="form" id="form">
                      <div align="center"> <br>
                      <select name="jumpMenu" id="jumpMenu">
                          <option value="" selected="">เลือกปีการศึกษา</option>
                                                <option value="">ปีการศึกษา 2560</option>
                                                <option value="">ปีการศึกษา 2559</option>
                                                <option value="">ปีการศึกษา 2558</option>
                                                <option value="">ปีการศึกษา 2557</option>
                                                <option value="">ปีการศึกษา 2556</option>
                                                <option value="">ปีการศึกษา 2555</option>
                                                <option value="">ปีการศึกษา 2554</option>
                                                <option value="">ปีการศึกษา 2553</option>
                                                <option value="">ปีการศึกษา 2552</option>
                                                <option value="">ปีการศึกษา 2551</option>
                                                <option value="">ปีการศึกษา 2550</option>
                                                <option value="">ปีการศึกษา 2549</option>
                                                <option value="">ปีการศึกษา 2548</option>
                                                 </select>
                        <input type="button" name="go_button" id="go_button" value="เลือก" onclick="MM_jumpMenuGo('jumpMenu','parent',1)">
    </div></form>

    <table width="600" border="0" align="center">
                          <tbody><tr>
                            <td width="125" bgcolor="#4682b4"><div align="center" class="style35 style42 style31">ชั้น/เพศ</div></td>
                              <td width="100" bgcolor="#4682b4"><div align="center" class="style35 style42 style31">ชาย</div></td>
                              <td width="100" bgcolor="#4682b4"><div align="center" class="style35 style42 style31">หญิง</div></td>
                              <td width="125" bgcolor="#4682b4"><div align="center" class="style35 style42 style31">รวม</div></td>
                              <td width="100" bgcolor="#4682b4"><div align="center" class="style35 style42 style31">ห้องเรียน</div></td>
                          </tr>
						  <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">อบ.3 ขวบ</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">12</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">อบ.1</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">4</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">5</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">อบ.2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">3</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">4</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">7</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="right" class="style58">
                              <div align="center"><strong>รวม อบ.</strong></div>
                              </div></td>
                             <td bgcolor="#CCCCCC"><div align="center" class="style58">13</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">11</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">24</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">3</div></td>
                          </tr>
                          <tr>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.1</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">0</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">7</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">4</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">11</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.3</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">10</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">5</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">15</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>                          
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.4</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">8</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.5</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">2</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">8</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="center" class="style58">ป.6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">3</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">6</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">9</div></td>
                              <td bgcolor="#F2F2F2"><div align="center" class="style58">1</div></td>
                          </tr>                          
                          <tr>
                            <td bgcolor="#CCCCCC"><div align="right" class="style58">
                              <div align="center"><strong>รวมประถม</strong></div>
                              </div></td>
                           	 <td bgcolor="#CCCCCC"><div align="center" class="style58">26</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">27</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">53</div></td>
                              <td bgcolor="#CCCCCC"><div align="center" class="style58">6</div></td>
                          </tr>
                         
                          <tr>
                            <td bgcolor="#999999"><div align="center" class="style58"><strong>รวมทั้งหมด</strong></div></td>
                              <td bgcolor="#999999"><div align="center" class="style58">39</div></td>
                              <td bgcolor="#999999"><div align="center" class="style58">38</div></td>
                              <td bgcolor="#999999"><div align="center" class="style58">77</div></td>
                              <td bgcolor="#999999"><div align="center" class="style58">9</div></td>
                          </tr>
                          <tr>
                        <td colspan="5"><div align="center" class="style58">ข้อมูล ณ วันที่ 10 มิถุนายน 2560</div><br></td>
                      </tr>
                       </tbody></table>
</div></center>
</body>

<footer class="sticky-footer">
<?php include( __DIR__."/footer.php"); ?>
</footer>