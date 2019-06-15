<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Hello, world!</title>
  <style type="text/css">
    .header {
      margin-top: 50px;
    }
    #result-time {
      position: relative;

    }
    #result-time::before
    {

      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      right: -900px;
      border: 1px solid red;

    }

  </style>
  <style type="text/css">
    table {
      font-size: 10px;
    }
    .table-bordered thead tr {
      background: #0099ff;
      color: #fff;

    }



  </style>
</head>
<body class="table-striped">
<div class="treecolumn">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Mã Sinh Viên</th>
      <th scope="col">Họ & Tên</th>
      <th scope="col">Ngày Sinh</th>
      <th scope="col">Bậc Đào Tạo</th>
      <th scope="col">Loại hình đào tạo</th>
      <th scope="col">Mã Lớp</th>
      <th scope="col">Ngành Học</th>
      <th scope="col">Điểm TBC</th>
      <th scope="col">Số TBTL</th>
      <th scope="col">Số TC Còn Nợ</th>
      <th scope="col">Điểm TBCTL</th>
      <th scope="col">ĐTB10</th>
      <th scope="col">SV năm thứ</th>
      <th scope="col">Phản hổi từ CVHT</th>
      <th scope="col">Phản hồi từ Khoa</th>
      <th scope="col">Tình Trạng</th>
      <th scope="col">CB-TT Học vụ</th>
      <th scope="col">Ghi chú</th>
      <th scope="col">Kết quả trước</th>
      <th scope="col">Ghi chú phản hồi của CVHT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>18211TT2541</td>
      <td>Nguyễn Văn Hải</td>
      <td>21/12/2000</td>
      <td>Cao Đẳng</td>
      <td>Chính quy</td>
      <td>CD18TT6</td>
      <td>CNTT</td>
      <td>0</td>
      <td>108</td>
      <td>0</td>
      <td>6.69</td>
      <td>0</td>
      <td>1</td>
      <td>+</td>
      <td>SV đã hoàn thành CTĐT -> chờ xét TN -> đề nghị không BTH</td>
      <td>Buộc thôi học</td>
      <td></td>
      <td>SV bị cảnh báo học vụ lần 2</td>
      <td>
        <ul>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
        </ul>
      </td>
      <td>Đã phản hồi</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>18211TT2541</td>
      <td>Nguyễn Văn Hải</td>
      <td>21/12/2000</td>
      <td>Cao Đẳng</td>
      <td>Chính quy</td>
      <td>CD18TT6</td>
      <td>CNTT</td>
      <td>0</td>
      <td>108</td>
      <td>0</td>
      <td>6.69</td>
      <td>0</td>
      <td>1</td>
      <td>+</td>
      <td>SV đã hoàn thành CTĐT -> chờ xét TN -> đề nghị không BTH</td>
      <td>Buộc thôi học</td>
      <td></td>
      <td>SV bị cảnh báo học vụ lần 2</td>
      <td>
        <ul>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
        </ul>
      </td>
      <td>Đã phản hồi</td>
    </tr>
        <tr>
      <th scope="row">3</th>
      <td>18211TT2541</td>
      <td>Nguyễn Văn Hải</td>
      <td>21/12/2000</td>
      <td>Cao Đẳng</td>
      <td>Chính quy</td>
      <td>CD18TT6</td>
      <td>CNTT</td>
      <td>0</td>
      <td>108</td>
      <td>0</td>
      <td>6.69</td>
      <td>0</td>
      <td>1</td>
      <td>+</td>
      <td>SV đã hoàn thành CTĐT -> chờ xét TN -> đề nghị không BTH</td>
      <td>Buộc thôi học</td>
      <td></td>
      <td>SV bị cảnh báo học vụ lần 2</td>
      <td>
        <ul>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
          <li>SV bị CBHV(HK1 NH: 2018-2019)</li>
        </ul>
      </td>
      <td>Đã phản hồi</td>
    </tr>
  </tbody>
</table>
</div>
<!--END-->


  <div class="container header" style="margin-bottom: 20px;">
    <div class="form-header">
      <h3>Đổi Ngày Sang Số</h3>
    </div>
    <form id="form-change-time">
      <div class="form-group mx-sm-3 mb-2">
        <label for="inputEmail4" style="margin-right: 20px">Nhập ngày và thời gian theo format: <span style="color: red; font-weight: bold;">d/m/Y H:i:s</span></label>
        <input type="text" class="form-control" id="inputPassword2" placeholder="05/11/2018 12:15:00">
      </div>
      <button type="submit" id="change_time" class="btn btn-primary mb-2" style="margin-left: 20px">Change</button>
    </form>
    <h4 style="display: inline;">Kết quả:</h4>
  <p id="result-time" style="display: inline;">000000000</p>
    
  </div>
  <div class="container" >
    <div class="form-header">
      <h3>Tính Giá Vé</h3>
    </div>
    <form>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Số Kilomet</label>
          <input type="text" class="form-control" id="inputEmail4" placeholder="nhập số nguyên">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Thời gian khởi hành chuyến bay</label>
          <input type="text" class="form-control" id="inputPassword4" placeholder="nhập số nguyên">
        </div>
      </div>
       <label for="inputState">Tạo chuyến bay đột
xuất, trước giờ bay gần 3 tháng giá vé sẽ tăng lên 5%</label>
      <div class="form-group col-md-4">
           
            <select id="inputState" class="form-control">
              <option selected>False</option>
              <option>True</option>
              
            </select>
          </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
        <h4 style="display: inline;">Kết quả:</h4>
  <p id="result-time" style="display: inline;">000000000</p>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
      $('#form-change-time').submit(function(e) {
        e.preventDefault();
        var value = $('#inputPassword2').val();
        var d = value.substr(0,2);
        var m = value.substr(3,2);
        var y = value.substr(6,4);
        var h = value.substr(11, 2);
        var i = value.substr(14,2);
        var s = value.substr(17,2);
        value = d + "-" + m + "-" + y + "-" + h + "-" + i + "-" + s;
        alert(value);
        $('#result-time').load('change-time/'+value);
        
      });
    });

</script>