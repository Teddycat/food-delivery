$(document).ready(function () {
    $('#first_reg').on('beforeSubmit', function (event, jqXHR, settings) {
        var form = $(this);
        $.ajax({
            url: "/entry/index",
            type: 'post',
            data: form.serialize(),
            success: function (data) { console.log(data);
                if(data) {
                    $('.main-form').html('<img id="success" src="img/success.png" alt="">');
                } else {
                    alert("Извините, ошибка регистрации. Скоро мы поправим ее");
                }
            }, error: function (data) {
                alert("Извините, данный номер уже зарегистрирован. Попробуйте зарегистрировать другой номер");
                $('#entryform-phone').val("");
            }
        });
        return false;
    });

    $('#backpass').on('beforeSubmit', function (event, jqXHR, settings) {

        var form = $(this);
        $.ajax({
            url: "/entry/newpass",
            type: 'post',
            data: form.serialize(),
            success: function (data) { console.log(data);
                if(data) {
                    alert('Пароль успешно изменен');
                    window.location.href=location.origin;
                } else {
                    alert("Извините, ошибка. Скоро мы поправим ее");
                }
            }, error: function (data) {

            }
        });
        return false;
    });

    $('#askforpass').on('beforeSubmit', function (event, jqXHR, settings) {
        var form = $(this);
        $.ajax({
            url: "/entry/forgot",
            type: 'post',
            data: form.serialize(),
            success: function (data) { console.log(data);
                $('#form2').html('<h3>Запрос успешно отправлен</h3>');

//                if(data) {
//                alert('Пароль успешно изменен')
//            } else {
//                alert("Извините, ошибка. Скоро мы поправим ее");
//            }
            }, error: function (data) {
                alert('Извините, этот email не зарегистрирован ни у одного из наших клиентов');

            }
        });
        return false;
    });

    setTimeout('$(".main-firstscreen__ninja-popup").fadeOut(2000)', 4000);
    $('.header-categories__item').on('click', function () {
        $(".main-firstscreen__ninja-popup").css('display', 'block');
        setTimeout('$(".main-firstscreen__ninja-popup").fadeOut(2000)', 4000);
    })

    $('.header-schedule__day-item').click(function () {
        $('.header-schedule__day-item').removeClass('active');
        $(this).addClass('active');
    });


    var week = parseInt((new Date()).getDay());
    switch (week) {
        case 1:
            $('#mon').addClass('active');
            break;
        case 2:
            $('#tue').addClass('active');
            break;
        case 3:
            $('#wed').addClass('active');
            break;
        case 4:
            $('#thur').addClass('active');
            break;
        case 5:
            $('#fri').addClass('active');
            break;
        case 6:
            $('#sat').addClass('active');
            break;
        case 7:
            $('#sun').addClass('active');
            break;


    }


});

$(document).mouseup(function (e) {
    var container = $("#headerCallModal");
    if (container.has(e.target).length === 0){
        container.hide();
    }
});


$(document).on('click', '.categories__btn-order.right.mt10', function () {
    var ider = $(this).attr('ider');
    var price = $(this).attr('price');
    var weight = $(this).attr('weight');
    var kkal = $(this).attr('kkal');
    var tokens = $(this).attr('kkal');
    $.ajax({
        url: "/site/ajax",
        type: 'post',
        dataType: 'json',
        data: {
            'ider': ider,
            'price': price,
            'weight': weight,
            'kkal': kkal,
            'tokens': tokens,
            'whatprice': 0,
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
            $('#basket').html('<strong>' + count + ' шт., ' + price + ' руб. </strong>');
            $('#basketTitle').html('<strong><span style="color:red">Мой заказ</span></strong>');
            $('#basket').attr('href', '/basket');
        }, error: function (data) {
            console.log(data);
            exit;
        }
    });
});


function addchoos(obj) {
    //this = obj;
    var dana = {};
    var ider = $(obj).attr('ider');
    var viser = $(obj).attr('viser');
    dana.namer = $(obj).attr('namer');
    dana.descro = $(obj).attr('descro');
    dana.img = $('#im').attr('src');
    if (viser == 'lot') {
        dana.pi = $('#pi').text();
        dana.li = $('#li').text();
        dana.wi = $('#wi').text();
        dana.ki = $('#ki').text();
        dana.bi = $('#bi').text();
    } else if (viser == 'lot2') {
        dana.pi = $('#pi2').text();
        dana.li = $('#li2').text();
        dana.wi = $('#wi2').text();
        dana.ki = $('#ki2').text();
        dana.bi = $('#bi2').text();
    } console.log(dana);
    $.ajax({
        url: "/site/theone",
        type: 'post',
        dataType: 'json',
        data: {
            'ider': ider,
            'dana': dana
        },
        success: function (data) {
            console.log(data);
            // var howmuch = data.length;
            // var count = 0;
            // for (var i = 0; i < howmuch; i++) {
            //     count += parseInt(data[i]['price'], 10);
            // }
            $('#theOne').html('<strong>' + data + ' шт.</strong>');
            $('#theOneTitle').html('<strong><span style="color:red">В избранном</span></strong>');
            $('.one').removeClass('fa-star-o');
            $('.one').removeClass('mr5');
            $('.one').addClass('fa-star');
            //window.location.reload();
        }, error: function (data) {
            console.log(data);
            exit;
        }
    });
}

$(document).on('click', '.filter-item', function () {
    $(this).toggleClass('active'); 
    var filt = $('.filter').attr('name');
    var b = $('.filter-item.active');
    var mass = new Array;
    for (var i = 0; i < b.length; i++) {
        mass[mass.length] = b.children()[i].innerText;
    } console.log(mass); console.log(filt);
    $.ajax({
        url: "../site/product",
        type: 'post',
        data: {
            'mass': mass,
            'filt': filt
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            // var masser  = [];
            // for (var i = 0; i < data.length; j++) {
            //
            // }


            var catego = $('#whats_cat').attr('namer');
            $('.categories-row.row').html('');
            for (var j = 0; j < data.length; j++) {
            //     masser.push ({
            //         ider: data[j]["product_id"]
            // }); console.log(masser);
            //     masser.each(function () {
            //         console.log(this);
            //     })
                // for (var i = 0; i < data[j].length; i++) {
                    if (data[j]["product_choice"] == 1) {
                        var startprice = data[j]['product_price1']*data[j]['product_percent'];
                        var midprice = Math.round((startprice/100));
                        var endoprice = data[j]['product_price1']-midprice;
                        var styler ='<div class="sale-percent medium">'+data[j]["product_percent"]+'% </div>';
                        var styler2 = '<div class="categories-price"><strong>'+endoprice+'</strong><sup class="h6 text-gray">'+data[j]['product_price1']+'</sup></div>';
                        var pricer= '<div class="categories-price"><strong>'+endoprice/2+'</strong><sup class="h6 text-gray">'+data[j]['product_price2']+'</sup></div>';
                        if(data[j]['product_price2'] != 0) {
                            var price2= '<div class="clearfix"><div class="left">'+pricer+'<div class="categories-size"><div>'+data[j]['product_length2']+'см, '+ data[j]['product_weight_2']+' гр.</div><div>'+data[j]['product_kkal2']+' ккал/100гр. </div></div></div><a href="javascript:void(0)" class="categories__btn-order right mt10" ider="'+data[j]['product_id']+'" price="product_price2" weight="product_weight_2" kkal="product_kkal2" tokens="product_balls2">Хочу!</a></div>';
                        } else {
                            var price2= ' ';
                        }
                    } else if (data[j]["product_choice"] == 2) {
                        var midprice = data[j]['product_price1']-data[j]['product_fixprice'];
                        var endprice = Math.round((midprice*100)/data[j]['product_price1']);
                        var styler ='<div class="sale-percent medium">'+endprice+'% </div>';
                        var styler2 = '<div class="categories-price"><strong>'+data[j]['product_fixprice']+'</strong><sup class="h6 text-gray">'+data[j]['product_price1']+'</sup></div>';
                        var pricer= '<div class="categories-price"><strong>'+data[j]['product_fixprice']/2+'</strong><sup class="h6 text-gray">'+data[j]['product_price2']+'</sup></div>';
                        if(data[j]['product_price2'] != 0) {
                            var price2= '<div class="clearfix"><div class="left">'+pricer+'<div class="categories-size"><div>'+data[j]['product_length2']+'см, '+ data[j]['product_weight_2']+' гр.</div><div>'+data[j]['product_kkal2']+' ккал/100гр. </div></div></div><a href="javascript:void(0)" class="categories__btn-order right mt10" ider="'+data[j]['product_id']+'" price="product_price2" weight="product_weight_2" kkal="product_kkal2" tokens="product_balls2">Хочу!</a></div>';
                        } else {
                            var price2= ' ';
                        }
                    } else {
                        var styler = ' ';
                        var styler2 = '<div class="categories-price"><strong>'+data[j]['product_price1']+'</strong></div>';
                        var pricer= '<div class="categories-price"><strong>'+data[j]['product_price2']+'</strong></div>';
                        if(data[j]['product_price2'] != 0) {
                            var price2= '<div class="clearfix"><div class="left">'+pricer+'<div class="categories-size"><div>'+data[j]['product_length2']+'см, '+ data[j]['product_weight_2']+' гр.</div><div>'+data[j]['product_kkal2']+' ккал/100гр. </div></div></div><a href="javascript:void(0)" class="categories__btn-order right mt10" ider="'+data[j]['product_id']+'" price="product_price2" weight="product_weight_2" kkal="product_kkal2" tokens="product_balls2">Хочу!</a></div>';
                        } else {
                            var price2= ' ';
                        }
                    }
                    $('.categories-row.row').append('<div class="categories-col col-4"><div class="categories-item"><a href="'+catego+'/'+data[j]['product_alias']+'" class="categories-title"><strong>' + data[j]["product_name"] + '</strong></a><a href="'+catego+'/'+data[j]['product_alias']+'" class="categories-img"><img src="/img' + data[j]["product_img"] + '" alt="">'+styler+'</a><div class="categories-info"><div class="clearfix"><div class="left">'+styler2+'<div class="categories-size"><div>' + data[j]['product_length'] + 'см,  ' + data[j]['product_weight'] + 'гр.</div><div>' +data[j]['product_kkal'] + 'ккал/100гр. </div></div></div><a href="javascript:void(0)" class="categories__btn-order right mt10">Хочу!</a></div>'+price2+'</div><div class="categories-descr">' + data[j]["product_description"] + '</div></div></div>');

                // }
            }

        }, error: function (data) {
            $('.categories-row.row').html('');
        }
    });
});

function showforOne() {
    $('#second').css('display', 'none');
    $('#secondRow').css('display', 'none');
    $('#first').css('display', 'block');
    $('#firstRow').css('display', 'block');
    $('.btn.btn-favourite.wmax').attr('viser', 'lot');
}
function showforTwo() {
    $('#first').css('display', 'none');
    $('#firstRow').css('display', 'none');
    $('#second').css('display', 'block');
    $('#secondRow').css('display', 'block');
    $('.btn.btn-favourite.wmax').attr('viser', 'lot2');

}
$(document).on('click', '#resetForm', function () {
    var form = $(this).closest('form'),
        upload = $('.jq-file'),
        uploadText = upload.find('.jq-file__name');
    form.find("input, textarea, select").val("");
    if (upload.hasClass('changed')) {
        upload.removeClass('changed');
        uploadText.html('');
    }
});

$(document).on('click', '#regiso', function () {
    var pass = $('#passer').val();
    var pass2 = $('#passer2').val();
    var namer = $('#namer').val();
    var phoner = $('#entryform-phoner').val();
    var mailer = $('#mailer').val();
    var dater = $('#entryform-birth').val();
    function validateEmail(mailer) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(mailer);
    }
    if (pass.length < 1) {
        alert("Вы не ввели пароль");
        return false;
    } else if (pass2.length < 1) {
        alert("Вы не подтвердили пароль");
        return false;
    } else if (pass !== pass2) {
        alert("Пароли не совпадают");
        return false;
    } else if (namer.length < 3) {
        alert("Введите корректное имя");
        return false;
    } else if (phoner.length < 9) {
        alert("Введите корректный номер телефона");
        return false;
    } else if (!validateEmail(mailer)) {
        alert("Введите корректный email");
        return false;
    } else if (dater.length < 5) {
        alert("Введите дату рождения");
        return false;
    }


});

function schedule(obj) {
    var times = $(obj).attr('id');
    switch (times) {
        case 'mon':
            times= 1;
            break;
        case 'tue':
            times=2;
            break;
        case 'wed':
            times= 3;
            break;
        case 'thur':
            times= 4;
            break;
        case 'fri':
            times= 5;
            break;
        case 'sat':
            times= 6;
            break;
        case 'sun':
            times= 7;
            break;


    }
    $.ajax({
        url: "/site/times",
        type: 'post',
        dataType: 'json',
        data: {
            'times': times
        },
        success: function (data) {
            console.log(data);
            $('.header-schedule__time-begin').text(data);
        }, error: function (data) {
        }
    });
}

function showMod() {
    $('#headerCallModal').show();
}

function callerback() {
    var num = $('#numbero').val();
    $.ajax({
        url: "/site/num",
        type: 'post',
        dataType: 'json',
        data: {
            'num': num
        },
        success: function (data) {
            console.log(data);
            $('#headerCallModal').hide();
            alert('Спасибо! Мы свяжемся с Вами в самое ближайшее время');

        }, error: function (data) {
        }
    });
}

function showForg() {
    $('#form1').css('display', 'none');
    $('#form2').css('display', 'block');
}

function setplace(obj) {
    var place = $(obj).attr('place');
    $.ajax({
        url: "/entry/city",
        type: 'post',
        dataType: 'json',
        data: {
            'place': place
        },
        success: function (data) {
            console.log(data);
            $('#cityPopup').hide();
            window.location.reload();

        }, error: function (data) {
        }
    });
}

function logout() {
    $.ajax({
        url: "/site/nolog",
        type: 'post',
        dataType: 'json',
        data: {
            'nolog': true
        },
        success: function (data) {
            console.log(data);
            if(data) {
                alert('Вы вышли из своей учетной записи');
                window.location.reload();
            } else {
                console.log(data);
                alert('Вы не авторизированы');
            }

        }, error: function (data) {
        }
    });
}