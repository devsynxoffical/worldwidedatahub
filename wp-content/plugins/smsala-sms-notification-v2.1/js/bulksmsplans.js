$(document).ready(function () {
    $('#txtPhone').blur(function (e) {
        var phone_number=$(this).val();
      
      if(phone_number!="")
      {
        if (validatePhone('txtPhone')) {
            $('#spnPhoneStatus').html('<b>Valid</b>');
            $('#spnPhoneStatus').css('color', 'green');
        }
        else {
            $('#spnPhoneStatus').html(' <b>Invalid</b>');
            $('#spnPhoneStatus').css('color', 'red');
        }
    }else{
        $('#spnPhoneStatus').html('');
        
    }
    });

    $("#send_sms_form").submit(function () {
        var phone = $('#txtPhone').val();
        if (validatePhone('txtPhone'))
        {
            return true;
        } else
        {
            return false;
        }
    });


    var part1Count = 160;
    var part2Count = 145;
    var part3Count = 152;

    $('#message').keyup(function () {
        var chars = $(this).val().length;
        var messages = 0;
        var remaining = 0;
        var total = 0;
        if (chars <= part1Count) {
            messages = 1;
            remaining = part1Count - chars;
        } else if (chars <= (part1Count + part2Count)) {
            messages = 2;
            remaining = part1Count + part2Count - chars;
        } else if (chars > (part1Count + part2Count)) {
            moreM = Math.ceil((chars - part1Count - part2Count) / part3Count);
            remaining = part1Count + part2Count + (moreM * part3Count) - chars;
            messages = 2 + moreM;
        }
        $('#remaining').text(remaining);
        $('#messages').text(messages);
        $('#total').text(chars);
        if (remaining > 1)
            $('.cplural').show();
        else
            $('.cplural').hide();
        if (messages > 1)
            $('.mplural').show();
        else
            $('.mplural').hide();
        if (chars > 1)
            $('.tplural').show();
        else
            $('.tplural').hide();
    });
    $('#message').keyup();
});

function validatePhone(txtPhone) {
    var a = document.getElementById(txtPhone).value;
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}