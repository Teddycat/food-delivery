
function showTwo() {
    $('#phoneTwo').css('display', 'block');
}

function sendero() {
    var mailer = $('#mailero').val();
    var ider = $('#datas').attr('idero');
    if (mailer.length < 1) {
        alert("Похоже, вы не ввели почту друга. Как же он тогда получит приглашение? Попробуйте еще раз");
    } else {
        $.ajax({
            url: "/profile/mailer",
            type: 'post',
            dataType: 'json',
            data: {
                'mailer': mailer,
                'ider': ider
            },
            success: function (data) {
                console.log(data);
                $('#right').css('display', 'block');
                $('#wrong').css('display', 'none');

            }, error: function (data) {
                console.log(data);
                $('#right').css('display', 'none');
                $('#wrong').css('display', 'block');
            }
        });
    }
}

function savero() {
    var data = {
        'namer': $('#namer').val(),
        'mailer': $('#mailer').val(),
        'phoner': $('#phoner').val(),
        'phoner2': $('#phoner2').val(),
        'day': $('#day').val(),
        'idero': parseInt($('#datas').attr('idero')),
    }
    console.log($('#phoner').val());
        $.ajax({
            url: "/profile/saver",
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (data) {
                console.log(data);
                if (data) {
                    alert("Данные успешно изменены");
                    window.location.reload();
                } else {
                    alert("Данные не изменены");
                }

            }, error: function (data) {
                console.log(data);

            }
        });


    console.log(data);


}

function passSave() {
    var data = {
        'older': $('#oldPass').val(),
        'new': $('#newPass').val(),
        'newer': $('#confNewPass').val(),
        'idero': parseInt($('#dataso').attr('idero')),
    }

    if (data.new === data.newer) {

        $.ajax({
            url: "/profile/pass",
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (data) {
                console.log(data);
                if (data) {
                    alert("Пароль успешно изменен");
                } else {
                    alert("Вы ввели неправильный пароль");
                }
            }, error: function (data) {
                console.log(data);

            }
        });
    } else {
        alert("Пароли не совпадают");
    }


}
function closer(obj) {
    var deleti = $(obj).closest('.address-table__row').attr('idiero');
    $(obj).closest('.address-table__row').remove();
    var count = 1;
    $('.address-table__row').each(function () {
        var self = $(this);
        console.log(self.find('.rower').text());
        self.find('.rower').text(count);
        count++;
    });
    
    $.ajax({
        url: "/profile/deleteri",
        type: 'post',
        dataType: 'json',
        data: {
            'deleti': deleti
        },
        success: function (data) {
            console.log(data); 
            window.location.reload();
            
        }, error: function (data) {
            console.log(data);
        }
    });
}
function filled() {
    $('.column-text').each(function () {
        var parent = $(this).closest('td'),
                value = parent.find('.column-edit-text').val();
        $(this).text(value);
    });
}
filled();


$('.column-edit-text').change(function () {
    var parent = $(this).closest('td'),
            value = $(this).val(),
            text = parent.find('.column-text');
    text.text(value);
});

$(document).on('click', '.edit-row', function () {
    $(this).closest('tr').addClass('edit')
});


$('#addRow').click(function () {
    var row = $('.address-table__row').length;
    var code = $('.address-table__row').html();
    row++;

    // console.log(row);
    //$('#addressTable').append(code);
    $('#addressTable').append('<tr class="address-table__row edit"><td><a href="javascript:void(0)" onclick="closer(this)" class="circle-icon removen-row"><i class="fa fa-close"></i></a></td><td class="rower">' + row + '</td><td><div class="column-text city"></div><input type="text" onkeyup="showcity(this)" class="form-input column-edit-text"><div id="livesearcher"></td><td><div class="column-text street"></div><input type="text" onkeyup="showhome(this)" class="form-input column-edit-text"><div id="livesearch"></div></td><td><div class="column-text house"></div><input type="text" class="form-input column-edit-text"></td><td><div class="column-text flat"></div><input type="text" class="form-input column-edit-text"></td><td><a href="javascript:void(0)" class="circle-icon edit-row"><i class="fa fa-pencil"></i></a><a href="javascript:void(0)" class="circle-icon accept-row addering"><i class="fa fa-check"></i></a></td></tr>');


});

function showhome(str) {
    // var city = $(str).attr('city');
    var city = 'Воронеж';
    var home = ' ';
   var inputer = str;
    var street = $(str).val(); console.log(str);
    $.ajax({
        url: "/kladr/getting",
        type: 'post',
        dataType: 'json',
        data: {
            'city': city,
            'street': street,
            'house': home,
        },
        success: function (data) {
            console.log(data);
            $("#livesearch").html(" ");
            var gok = " ";
            var stro = data.street;
            if(data.street.length == 0) {
                gok = '<p class="pi">Улица не определена</p>';
                $("#livesearch").html(gok);
                $("#livesearch").css('width', '250px');
                $("#livesearch").css('backgroundColor', 'white');
                $("#livesearch").css('border', '1px solid #A5ACB2');
            } else {
                for (var i = 0; i < data.street.length; i++) {
                    gok += '<p class="pi" onclick="raz(event, this)">' + data.street[i] + '</p>';
                    $("#livesearch").html(gok);
                    $("#livesearch").css('width', '250px');
                    $("#livesearch").css('backgroundColor', 'white');
                }

                $("#livesearch").css('border', '1px solid #A5ACB2');

            }
            // document.getElementById("livesearch").style.border = "0px";
        }, error: function (data) {
            console.log(data);
        }
    });

}

function showcity(str) {
    // var city = $(str).attr('city');
    //var city = 'Воронеж';
    var home = ' ';
    var inputer = str;
    var city = $(str).val();
    var street = ' ';
    $.ajax({
        url: "/kladr/getting",
        type: 'post',
        dataType: 'json',
        data: {
            'city': city,
            'street': street,
            'house': home,
        },
        success: function (data) {
            console.log(data);
            $("#livesearcher").html(" ");
            var gok = " ";
            var stro = data.city;
            if(data.city.length == 0) {
                gok = '<p class="pi">Улица не определена</p>';
                $("#livesearcher").html(gok);
                $("#livesearcher").css('width', '250px');
                $("#livesearcher").css('backgroundColor', 'white');
                $("#livesearcher").css('border', '1px solid #A5ACB2');
            } else {
                for (var i = 0; i < data.city.length; i++) {
                    gok += '<p class="pi" onclick="razo(event, this)">' + data.city[i]['name'] + '</p>';
                    $("#livesearcher").html(gok);
                    $("#livesearcher").css('width', '250px');
                    $("#livesearcher").css('backgroundColor', 'white');
                }

                $("#livesearcher").css('border', '1px solid #A5ACB2');

            }
            // document.getElementById("livesearch").style.border = "0px";
        }, error: function (data) {
            console.log(data);
        }
    });

}


function raz(e, obj) {
    e.preventDefault();
    $("#livesearch").css('display', 'none');
    $(obj).closest('td').find('.column-edit-text').val($(obj).text());
    console.log($(obj).closest('.column-edit-text'));
    //$("#street").(obj);
    return false;
}

function razo(e, obj) {
    e.preventDefault();
    $("#livesearcher").css('display', 'none');
    $(obj).closest('td').find('.column-edit-text').val($(obj).text());
    console.log($(obj).closest('.column-edit-text'));
    //$("#street").(obj);
    return false;
}



$(document).on('mouseover', '.pi', function () {
    $(this).css('cursor', 'pointer');
    $(this).css('background-color', 'yellow');
});
$(document).on('mouseout', '.pi', function () {
    $(this).css('cursor', 'pointer');
    $(this).css('background-color', '');
});

$(document).on('click', '.addering', function (evt) {
    evt.stopImmediatePropagation();
    $(this).closest('tr').removeClass('edit');
    filled();
    var idish = parseInt($('#datasi').attr('idish'));
    var arr = [];
    $('.address-table__row').each(function () {
        var self = $(this);
        arr.push({
            city: self.find('.city').text(),
            street: self.find('.street').text(),
            house: self.find('.house').text(),
            flat: self.find('.flat').text(),
            idiero: self.closest('.address-table__row').attr('idiero')
        });
    });
    console.log("REPEAT");
    //console.log(arr);
    $.ajax({
        url: "/profile/addplace",
        type: 'post',
        dataType: 'json',
        //async: false,
        data: {
            'arr': arr,
            'idish': idish
        },
        success: function (data) {
              console.log(data);
            window.location.reload();

        }, error: function (data) {
            //console.log(data);

        }
    });
});


$(document).on('click', '.btn.btn-big.btn-red.w200', function () {
    var thing = $(this).closest('.cart-item').attr('thing');
    var pricer = $(this).closest('.cart-item').attr('pricer');
    $.ajax({
        url: "/site/tobasket",
        type: 'post',
        dataType: 'json',
        data: {
            'thing': thing,
            'pricer': pricer
        },
        success: function (data) {
            console.log(data);
            var howmuch = data.length;
            var count = 0;
            var price = 0;
            $.each(data, function (i, item) {
                price += parseInt(item.price);
                count++;
            })
            console.log(count);
//                for (var i=0; i<howmuch; i++){
//                count+= parseInt(data[i]['price'], 10);
//                }
            $('#basket').html('<strong>' + count + ' шт., ' + price + 'рублей </strong>');
            $('#basketTitle').html('<strong><span style="color:red">Мой заказ</span></strong>');
        }, error: function (data) {
            console.log(data);
            exit;
        }
    });
});

$(document).on('click', '.cart-item__close', function () {
    var deleto = parseInt($(this).closest('.cart-item').attr('idro'));
     $.ajax({
        url: "/site/deleter",
        type: 'post',
        dataType: 'json',
        data: {
            'deleto': deleto
        },
        success: function (data) {
            console.log(data);           
        }, error: function (data) {
            console.log(data);
        }
    });
    $(this).closest('.cart-item').remove();
});

$(document).on('click', '.recent-order-open', function () {
        var number = parseInt($(this).attr('number')); 
        $('#recentOrderNum').text(number);
        
         $.ajax({
        url: "/profile/grabber",
        type: 'post',
        dataType: 'json',
        data: {
            'number': number
        },
        success: function (data) {
            $('.recent-order__item.mb50').html('');
            $(data).each(function () {
        var self = $(this);
        
        $('.cart-item').prepend('<div class="recent-order__item mb50"><div class="row"><div class="col-3"><img src="/img'+self[0]['orders_product_img']+'" alt="" class="img-responsive"></div><div class="col-9"><div class="cart-item__title">'+self[0]['orders_product_name']+'</div><div class="cart-item__descr">'+self[0]['orders_product_descript']+'</div><ul class="cart-item__prop-list clearfix"><li class="cart-item__prop-item cart-item__prop-item--weight">'+self[0]['orders_product_weight']+' грамм</li><li class="cart-item__prop-item cart-item__prop-item--ccal">'+self[0]['orders_product_kkal']+' ккал</li><li class="cart-item__prop-item cart-item__prop-item--price">'+self[0]['orders_product_price']+' руб.</li><li class="cart-item__prop-item cart-item__prop-item--bonus">'+self[0]['orders_product_token']+' баллов </li></ul><a href="javascript:void(0)" class="btn btn-small btn-red recent-order__buy-btn">Купить</a></div></div></div>');    
    });
    
        }, error: function (data) {
            console.log(data);
        }
    });
       
       $.ajax({
        url: "/profile/orderinfo",
        type: 'post',
        dataType: 'json',
        data: {
            'number': number
        },
        success: function (data) {           
if(data.orders_pay_info.indexOf('наличными') + 1) {
var stringer = 'наличными';
} else if(data.orders_pay_info.indexOf('безналом') + 1) {
var stringer = 'безналом';
} else if(data.orders_pay_info.indexOf('электронным') + 1) {
var stringer = 'электронным платежом';
}
if(data.orders_send.indexOf('курьером') + 1) {
var point = data.orders_send.split(':');
point = point[1];
} else if(data.orders_send.indexOf('самостоятельно') + 1) {
var point = 'самовывоз';
}


            $('#recentSummaryAddress').text(point);
            $('#recentSummaryCash').text(stringer);
            $('#recentSummaryBonusIn').text(data.orders_bonus_plus);
            $('#recentSummaryBonusOut').text(data.orders_bonus_minus);
            $('#recentSummaryPersons').text(data.orders_persons);
            $('#recentSummaryPrice').text(data.orders_total);
        }, error: function (data) {
            console.log(data);
        }
    });
        var box = $('.recent-order-box');
        $('tr').removeClass('open');;
        $(this).closest('tr').addClass('open');
        box.addClass('active');
    });

$(document).on('click', '.recent-order-close, .recent-order__close', function () {
        var box = $('.recent-order-box');
        var row = $('.recent-table__row');
        row.removeClass('open');
        box.removeClass('active')
    });
    
    $(document).on('click', '.circle-icon.remove-row', function () {
       $(this).closest('.recent-table__row').remove(); 
    });
    
    $(document).on('click', '.btn.btn-big.btn-red.wmax', function () { 
       var number = parseInt($('#recentOrderNum').text()); 
        var danger = confirm('Вы дублируете свой заказ, и он автоматически становится подтвержденным со всеми введенными ранее параметрами (адрес, сумма и др.) Нажмите "ОК" чтобы подтвердить или "Отмена", чтобы отказаться');

if (danger) {
        $.ajax({
        url: "/profile/repeat",
        type: 'post',
        dataType: 'json',
        data: {
            'number': number
        },
        success: function (data) {
            window.location.href=location.origin+"/basket/"+data;
        }, error: function (data) {
            console.log(data);
        }
    });
}
    }); 
$(document).on('mouseover', '.circle-icon.order-row', function () { 
    $(this).closest('td').append('<div class="hovernik" style="z-index:123; border: 1px solid black; background-color:white; margin-left: -125px; margin-top: 30px; position: relative; text-decoration: none; min-width:200px; min-hight:190px"><p>Внимание! Вы дублируете свой заказ, и он автоматически становится подтвержденным со всеми введенными ранее параметрами (адрес, сумма и др.)</p></div>')
})

$(document).on('mouseout', '.circle-icon.order-row', function () { 
    $(this).closest('td').find('.hovernik').remove();
})
 $(document).on('click', '.circle-icon.order-row', function () { 
       var number = parseInt($(this).attr('ord')); 
//      var danger = confirm('Вы дублируете свой заказ, и он автоматически становится подтвержденным со всеми введенными ранее параметрами (адрес, сумма и др.) Нажмите "ОК" чтобы подтвердить или "Отмена", чтобы отказаться');
//
//if (danger) {
        $.ajax({
        url: "/profile/repeat",
        type: 'post',
        dataType: 'json',
        data: {
            'number': number
        },
        success: function (data) {
            window.location.href=location.origin+"/basket/"+data;
        }, error: function (data) {
            console.log(data);
        }
    });
//}
    });
    
  $(document).on('click', '.btn.btn-big.btn-gray.wmax', function () {   
  var ord = $('#recentOrderNum').text();  
  window.location.href=location.origin+"/feedback/"+ord;
  });