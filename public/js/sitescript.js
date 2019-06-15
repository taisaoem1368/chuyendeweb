$(document).ready(function(){
    $('#booking').submit(function() {
        flag = true;
        var from = $('#from').val();
        var to = $('#to').val();
        if(from == to)
        {
            alert('Điểm Đi Không Được Trùng Điểm Đếm');
            flag = false;
        }
        return flag;
    })
    
});

function changeRadio()
{
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() +1;
    var year = date.getFullYear();
   // alert(full);
    if(day < 10)
    {
        day = '0' + day;
    }

    if(month < 10)
    {
        month = '0' + month;
    }
    var full = year + '-' + month + '-' + day;
    var a = "<?php echo date('Y-m-d'); ?>";
    var radios = $("input[name='flight_type']:checked").val();
    if(radios == "one-way")
    {
        $('.return').empty();
    }
    else {
        $('.return').append('<label class="control-label" >Return: </label>');
        $('.return').append('<input type="date" name="datereturn" value="'+full+'" min="'+full+'" class="form-control" placeholder="Choose Return Date">');
    }
}