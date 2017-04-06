function bnm(obj, vara) {
    console.log(obj);
    if (vara)
        $(obj).hide();
    else
        $(obj).closest('.cart-item__order-comment').hide();
}
;

$(document).on('click', '.btn.btn-red.btn-large', function () {
    var sauces = ' ';
    var checker = $('#rulesCheck').prop('checked');
    var count = 0;
    var userSauce = [];
    $('#souses').find('.col-3').each(function () {
        var self = $(this);
        var inputer = self.find('input').attr('adding');
        var amountSausses = parseInt(self.find('input[name="amountSausses"]').val());
        if (amountSausses > 0) {
            var namen = self.find('.cart-spices__name').text();
            var pricer = parseInt(self.find('.cart-spices__price').text());
            sauces += ' ' + amountSausses + ' соуса "' + namen + '" по цене ' + pricer + ' рублей за одну штуку, итого ' + amountSausses * pricer + ' руб.;';
            userSauce.push({
                name: namen,
                price: pricer,
                amount: amountSausses,
                inputer: inputer
            });
            var post = {
                'sauceName': namen,
                'saucePrice': pricer,
                'count': count,
                'consider': amountSausses,
                'sauces': sauces
            };
            var link = "/site/sauces";
//        console.log(ajaxer(link, post));
//        function ajaxer(link, post) {
            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: post,
                success: function (data) {
                }, error: function (data) {
                }
            });
            count++;
        }
    });
   // console.log(userSauce);
    //собираем данные с общих подчетво по заказаному товару
    var addPrice = $('#addPrice').text();
    sauces += ' ОБЩАЯ СУММА: ' + addPrice;
    var user = $('#user').val();
    var city = $("#city").text();
    var phone = $('#phone').val();
    var persons = $('#persons').val();
    var kkaly = $('#numKkal').text();
    var tokeny = $('#numToken').text();
    var grammy = $('#numGramm').text();
    var totPrice = $('#totalPrice').text();
    var bonuses = $('#bonuses').text();

    var delivery = $('input[name=delivery-type]:checked', '.cart-delivery__radio.radio.mr20').val();
    var wayPay = $('input[name="cart-payment"]:checked', '.radio.mr5').val();
    var cheker = $(".checker.mr5").prop("checked");
    var sendOrder = '';
    if (delivery == 'we') {
        var timeDelivery = $('input[name=delivery-time]:checked', '.radio.mr5').val();
        if (timeDelivery == 'closeTime') {
            var timero = $('#ourTime').text();
        } else {
            var vb = true;// ДОБАВИТЬ ВРЕМЯ ЮЗЕРА    
        }
        if ($('#street').val().length < 1) {
            alert('Укажите, пожалуйста, улицу доставки');
        } else if ($('#home').val().length < 1) {
            alert('Укажите, пожалуйста, номер дома доставки');
        } else if ($('#flat').val().length < 1) {
            alert('Укажите, пожалуйста, квартиру доставки либо офис');
        } else if ($('#door').val().length < 1) {
            alert('Укажите, пожалуйста, подъезд доставки');
        } else if ($('#level').val().length < 1) {
            alert('Укажите, пожалуйста, этаж доставки');
        } else {
            sendOrder += 'Доставка курьером по адресу: улица ' + $('#street').val() + ', дом ' + $('#home').val() + ', квартира ' + $('#flat').val() + ', подъезд ' + $('#door').val() + ' , этаж ' + $('#level').val() + ', домофон: ' + $('#domophone').val() + ', комментарий: ' + $('#commentAdress').val() + ', время доставки: ' + timero + '.';
        }
    } else if (delivery == 'he') {
        var outer = $('input[name=delivery-adress]:checked', '.radio.mr5').val();
        console.log(outer);
        sendOrder += 'Клиент заберет самостоятельно по адресу: ' + outer;
    }
    if (wayPay == 'cash') {
        var payInfo = 'Клиент расплачивается наличными, сдача: ' + $("#shortPay option:selected").text();
    } else if (wayPay == 'uncash') {
        var payInfo = 'Клиент пожелал оплатить безналом при получении';
    } else if (wayPay == 'netcash') {
        var payInfo = 'Клиент пожелал оплатить электронным платежом';
    }
    var timeWay = $('input[name=delivery-time]:checked', '.radio.mr5').val();
    if (timeWay == 'closeTime') {
        var timer = $('#ourTime').text();
    } else if (timeWay == 'ownTime') {
        var ho = $('#hours').val();
        var mi = $('#minutes').val();
        var timer = 'от клиента: ' + ho + ' часов, ' + mi + ' минут';
    }
    var sumOrder = $('#summaryPrice').text(); //summa zakaza
    var bonusPlus = $('#summaryBonusesIn').text(); //nachisleno bonusov
    var bonusMinus = parseInt($('#summaryBonusesOut').text()); //oplacheno bonusami
    var devPrice = parseInt($('#summaryDeliveryPrice').text());//summa dostavki
    var promo = $('#summaryPromo').text();//promokod
    var totalSum = $('#summaryPriceFinal').text();//summa oplaty

    if (user.length < 1 || phone.length < 1) {
        alert("Проверьте корректность персональных данных");
    } else if (city == 'Выберите город') {

        alert("Пожалуйста, выберите свой город");

    } else if (!checker) {
        alert('Согласие с условиями заказа является обязательным условием');
    } else {
        $.ajax({
            url: "/site/order",
            type: 'post',
            dataType: 'json',
            data: {
                'user': user,
                'city': city,
                'phone': phone,
                'persons': persons,
                'sauces': sauces,
                'sendOrder': sendOrder,
                'sumOrder': sumOrder,
                'payInfo': payInfo,
                'bonusPlus': bonusPlus,
                'bonusMinus': bonusMinus,
                'devPrice': devPrice,
                'promo': promo,
                'timer': timer,
                'totalSum': totalSum,
                'userSauce': userSauce
            },
            success: function (data) {
                console.log(data);
                window.location.href = '/basket/' + data;

            }, error: function (data) {
                console.log(data);
            }
        });

    }
});



$(document).on('change', '#bonuses', function () {
    var bonuses = parseInt($('#bonuses').val());
    var howBon = parseInt($('#howBon').text());
    console.log(howBon);
    if (bonuses > howBon/2) {
        alert('Количество введенных бонусов превышает количество доступных');
    } else if (isNaN(howBon)) { alert('nan');
        var knowPrice = parseInt($('#totalOrder').text());
        $('#summaryBonusesOut').text('0 руб.');
        $('#howBon').text(' 0');
    } else {
        $('#summaryBonusesOut').text(bonuses + ' руб.');
    }

});
$(document).on('focus', '#bonuses', function () {
    $('#bonuses').val(' ');
    var knowPrice = parseInt($('#totalPrice').text());
    $('#summaryBonusesOut').text('0 руб.');

});

function givemap(lat, let, ident) {
    $('.maper').html(' ');
    $('.maper').attr('id', ident); 
    ymaps.ready(init); // Ожидание загрузки API с сервера Яндекса
    function init() {
        myMap = new ymaps.Map("" + ident + "", {
            center: [lat, let], // Координаты центра карты
            zoom: 17 // Zoom
        });
       // $('.cart__delivery-map').html(' ');
       // $('.maper').css("display", "block");
       // $('#' + ident + '').css("display", "block");
    }

}

   
$(document).ready(function () {
    var len = $('.jq-number__spin.minus');
    len.each(function() {
        var self = $(this);
        var founder = self.closest('.jq-number').find('input').val();
        if(founder < 1) {
            self.css('display', 'none');
        }

    });

     var choose = $("#city").text();
    $.ajax({
        url: "/site/citytimer",
        type: 'post',
        dataType: 'json',
        data: {
            'choose': choose
        },
        success: function (data) {
            console.log(data);
            $('#setTime').text(data.city.city_time + ' минут');
            var eS = new Date().getTime() / 1000;
            var minutes = (data.city.city_time * 60) + eS;
            var date = new Date();
            date.setTime(minutes * 1000);
            var year = date.getFullYear()
            var month = date.getMonth() + 1;
            var d = date.getDate()
            var h = date.getHours();
            var m = date.getMinutes();
            if(d.toString().length == 1)
                d='0'+d;
            if(m.toString().length == 1)
                m='0'+m;
            if(h.toString().length == 1)
                h='0'+h;
            if(month.toString().length == 1)
                month='0'+month; 

            $('#ourTime').text(year + '-' + month + '-' + d + ' ' + h + ':' + m+':00');
            $('#minimum').attr('minim', data.city.city_minsum);
            $('#locations').html(' ');
            for (var i = 0; i < data.addresses.length; i++) {
                var lat = data.addresses[i]["location_lat"];
                var let = data.addresses[i]["location_let"];
                var ident = data.addresses[i]["location_ident"];
                $('#locations').append('<div class="mb10"><label for="" class="radio-check"><input type="radio" class="radio mr5" name="delivery-adress" onclick="givemap(\'' + lat + '\',\'' + let + '\', \'' + ident + '\')" value="' + data.addresses[i]["location_address"] + '"><span class="radio-text"><span class="medium">' + data.addresses[i]["location_address"] + '</span></span></label></div>');
            }
        }, error: function (data) {
            console.log(data);
        }
    });


    $('.cart-item__closer').click(function () {
        var atri = $(this).closest('.cart-item').attr('iderow');
        var wprice = $(this).closest('.cart-item').attr('wprice');
        $.ajax({
            url: "/basket/deleter",
            type: 'post',
            dataType: 'json',
            data: {
                'atri': atri,
                'wprice': wprice
            },
            success: function (data) {
                 console.log(data);
                $(this).closest('.cart-item').fadeOut('300').delay('300').remove();
                window.location.reload();
            }, error: function (data) {
                console.log(data);
            }
        });

    });

    var cartLength = $('.cart-item').length;
    var finder = $('.cart-item');
    var knowWeight = 0;
    var knowKkal = 0;
    var knowPrice = 0;
    var knowTokens = 0;

    for (var i = 0; i < cartLength; i++) {
        var indeep = finder[i].children[1].children[1].children[2];
        var number = parseInt($(indeep).closest('.cart-item').find('.cypher').val());
        knowWeight += parseInt(indeep.children[0].innerText)*number;
        knowKkal += parseInt(indeep.children[1].innerText)*number;
        knowPrice += parseInt(finder[i].children[1].children[2].children[0].children[1].innerText);
        knowTokens += parseInt(indeep.children[3].innerText);
    }
    $(document).on('click', '.jq-number__spin.plus', function () {
        var valuers = parseInt($(this).closest('.jq-number').find('input').attr('adding'));
        var nums = parseInt($(this).closest('.jq-number').find('input').attr('num'));
        var amounts = parseInt($(this).closest('.jq-number').find('input').val());
        var sign = true;
        var classer = this.parentNode.parentNode;
        var testo = $(this).closest('.col-3');

        if (classer.className === 'cart-spices__ammount') {
            if (valuers == 99987 || amounts > valuers) {
                var plusPrice = parseInt($('#addPrice').text());
                var currentPrice = parseInt(classer.parentNode.children[2].innerText);
                plusPrice += currentPrice;
                if (plusPrice < 0) {
                    plusPrice = 0;
                }
                $('#addPrice').text(plusPrice + ' руб');
                var addingor = parseInt($('#addPrice').text());
                var tottyPrice = parseInt($('#totalPrice').text());
                addingor += tottyPrice;
                $('#summaryPrice').text(addingor + ' руб');
                this.parentNode.children[1].style.display = 'block';
            }
        } else if (classer.className == 'mb20') {
            var boom = true;
        } else {
            var tester = $(this).closest('.row');
            //var starter = $(this).parent().parent().parent().parent().children();
            var kkaler = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--ccal').text());
            var token = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--bonus').text());
            var pricer = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--price').text());
            var weighter = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--weight').text());
            changePrice(this, sign, kkaler, token, pricer, weighter);

            $.ajax({
                url: "/basket/sauces",
                type: 'post',
                dataType: 'json',
                data: {
                    'atri': nums
                },
                success: function (data) {
                    console.log(data);
                    for (var i=0; i<data.length; i++) {
                        $('#souses').find('.col-3').each(function () {
                            var self = $(this);
                            var inputer = self.find('input').attr('ider');
                            var amountSausses = parseFloat(self.find('input[name="amountSausses"]').attr('sum'));
                            if (data[i]['adds_sauce'] == inputer) {
                                console.log(inputer);
                                console.log(amountSausses);
                                var newval = amountSausses+parseFloat(data[i]['adds_amount']);
                                self.find('input[name="amountSausses"]').attr('sum', newval);
                                self.find('input[name="amountSausses"]').val(Math.ceil(newval));

                            }
                        });
                    }

                }, error: function (data) {
                    console.log(data);
                }
            });

            //this.parentNode.children[1].style.display = 'block';
        }
        $(this).closest('.jq-number').find('.jq-number__spin.minus').css('display', 'block');
    });

    $(document).on('click', '.jq-number__spin.minus', function () {
        var valuer = parseInt($(this).closest('.jq-number').find('input').attr('adding'));
        var nums = parseInt($(this).closest('.jq-number').find('input').attr('num'));
        var amount = parseInt($(this).closest('.jq-number').find('input').val());

        var classer = this.parentNode.parentNode;
        console.log(classer.className);
        if (classer.className == 'cart-spices__ammount') {
            if (valuer == 99987 || (amount >= valuer)) {
                var plusPrice = parseInt($('#addPrice').text());
            if (plusPrice < 0) {
                plusPrice = 0;
            }
            var currentPrice = parseInt(classer.parentNode.children[2].innerText);
            plusPrice -= currentPrice;
            var sector = $(this).parent().children(0).children(0);
            var number = parseInt(sector.val());
            if (number > 1) {
                changeSaucePrice(this);
            } else if (number == 1) {
                changeSaucePrice(this);

                //$('.cart-item__close').click();
            } else if (number == 0) {
                changeSaucePrice(this);
                $(this).css('display', 'none');
            }
        }
//            if (number != 0)
//                document.getElementById('addPrice').innerText = plusPrice + ' руб';
        } else if (classer.className == 'mb20') {
            var boom = true;
        } else {
            var tester = $(this).closest('.row');
            var kkaler = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--ccal').text());
            var token = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--bonus').text());
            var pricer = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--price').text());
            var weighter = parseInt(tester.find('.cart-item__prop-item.cart-item__prop-item--weight').text());
            var sign = false;
            var sector = $(this).parent().children(0).children(0);
            var number = parseInt(sector.val());
            if (number > 1) {
                changePrice(this, sign, kkaler, token, pricer, weighter);
            } else if (number == 1) {
                stayPrice(this, kkaler, token, pricer, weighter);
                //$(this).css('display', 'none');
                //$('.cart-item__close').click();
            } else {
                //alert(2);
                changePrice(this, sign, kkaler, token, pricer, weighter);
                $(this).css('display', 'none');
            }
            $.ajax({
                url: "/basket/sauces",
                type: 'post',
                dataType: 'json',
                data: {
                    'atri': nums
                },
                success: function (data) {
                    console.log(data);
                    for (var i=0; i<data.length; i++) {
                        $('#souses').find('.col-3').each(function () {
                            var self = $(this);
                            var inputer = self.find('input').attr('ider');
                            var amountSausses = parseFloat(self.find('input[name="amountSausses"]').attr('sum'));
                            if (data[i]['adds_sauce'] == inputer) {
                                var newval = amountSausses-parseFloat(data[i]['adds_amount']);
                                self.find('input[name="amountSausses"]').attr('sum', newval);
                                self.find('input[name="amountSausses"]').val(Math.ceil(newval));



                            }
                        });
                    }

                }, error: function (data) {
                    console.log(data);
                }
            });
        }
        //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
        var summero = parseInt($('#summaryPrice').text());
        var delivo = parseInt($('#summaryDeliveryPrice').text());
        var bonuska = parseInt($('#summaryBonusesOut').text());
        if (bonuska === NaN) {
            bonuska = 0;
        }
        if (delivo === NaN) {
            bonuska = 0;
        }
        summero = summero + delivo - bonuska;
        $('#summaryPriceFinal').text(summero + ' руб');
    });

    $('#numKkal').text(knowKkal + ' ккал');
    $('#numToken').text(knowTokens);
    $('#numGramm').text(knowWeight + ' грамм');
    $('#totalPrice').text(knowPrice + ' руб');
    $('#summaryPrice').text(knowPrice + ' руб');
    var addinger = parseInt($('#addPrice').text());
    var bonio = parseInt($('#numToken').text());

    
    $('#summaryDeliveryPrice').text(' руб.');
    //document.getElementById('summaryBonusesOut').innerText = ' руб.';
    $('#summaryBonusesIn').text(bonio);
    // document.getElementById('summaryPriceFinal').innerText = ' ';
    //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
    var summero = parseInt($('#summaryPrice').text());
    var delivo = parseInt($('#summaryDeliveryPrice').text());
    var bonuska = parseInt($('#summaryBonusesOut').text());
    if (bonuska === NaN) {
        bonuska = 0;
    }
    console.log(bonuska);
    console.log(delivo);
    console.log(summero);
    summero = summero + delivo - bonuska;
    $('#summaryPriceFinal').text(summero + ' руб');


    $(window).scroll(function () {
        var deliv = 0;
        var bo = $("body").scrollTop();
        var div_position = $('.cart-bonus.slide-toggle-item').offset();
        if (bo > div_position.top) {
            var adding = parseInt(document.getElementById('addPrice').innerText);
            var minimizer = parseInt($('#minimum').attr('minim'));
            if (knowPrice > minimizer) {
                deliv = 0;
            } else {
                deliv = 1000;
            }
            //console.log(addinger);
            var timeWay = $('input[name=delivery-time]:checked', '.radio.mr5').val();
            if (timeWay == 'closeTime') {
                var timer = $('#ourTime').text();
            } else if (timeWay == 'ownTime') {
                var ho = $('#hours').val();
                var mi = $('#minutes').val();
                var timer = 'от клиента: ' + ho + ' часов, ' + mi + ' минут';
            }

            $('#summaryDeliveryTime').text(timer);
            if ($('#summaryDeliveryTime').text().length < 1)
                $('#summaryDeliveryTime').text('Чтобы узнать, выберите город');
            $('#summaryDeliveryPrice').text(deliv + ' руб.');

//var boni = parseInt($('#summaryPrice').text());
            //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
            var summero = parseInt($('#summaryPrice').text());
            var delivo = parseInt($('#summaryDeliveryPrice').text());
            var bonuska = parseInt($('#summaryBonusesOut').text());
            if (bonuska === NaN) {
                bonuska = 0;
            }
            summero = summero + delivo - bonuska;
            $('#summaryPriceFinal').text(summero + ' руб');

//            //document.getElementById('summaryBonusesIn').innerText = knowPrice + adding;
//            var bonusMinus = parseInt(document.getElementById('summaryBonusesOut').innerText);
//            if(isNaN(bonusMinus))
//            bonusMinus = 0;    
//            var devPrice = parseInt(document.getElementById('summaryDeliveryPrice').innerText);
//           // var promo = parseInt(document.getElementById('summaryPromo').innerText);
//           // var totPrice = (knowPrice - bonusMinus - promo) + devPrice + adding; console.log(knowPrice );
//            //document.getElementById('summaryPriceFinal').innerText = totPrice + ' руб.';
        }

    })

});

function changePrice(obj, sign, kkaler, token, pricero, weighter) {
    var knowWeight = parseInt($('#numGramm').text());
    var knowKkal = parseInt($('#numKkal').text());
    var knowPrice = parseInt($('#totalPrice').text());
    var pron = $(obj).closest('.row');
    var prono = pron.find('.cart-item__price.light.mt15');
    var clon = parseInt($(obj).closest('.jq-number').find('.jq-number__field').children(0).val());
    var priceno = parseInt(pron.find('.cart-item__prop-item.cart-item__prop-item--price').text());
    clon *= priceno;
    var knowTokens = parseInt($('#numToken').text());
    if (sign) {
        knowKkal += kkaler;
        knowPrice += pricero;
        knowTokens += token;
        knowWeight += weighter;
    } else {
        knowKkal -= kkaler;
        knowPrice -= pricero;
        knowTokens -= token;
        knowWeight -= weighter;
    }
    // pricer.children[1].innerText = howMuch + ' руб.';
    $('#numKkal').text(knowKkal + ' ккал');
    $('#numGramm').text(knowWeight + ' грамм');
    $('#numToken').text(knowTokens);
    var bonio = parseInt($('#numToken').text());
    $('#summaryBonusesIn').text(bonio);
    $('#totalPrice').text(knowPrice + ' руб');
    var addingor = parseInt($('#addPrice').text());
    addingor += knowPrice;
    $('#summaryPrice').text(addingor + ' руб');
    //$('#summaryBonusesIn').text(addingor +' руб');
    prono.text(clon + ' руб.');

    //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
    var summerow = parseInt($('#summaryPrice').text());
    var delivo = parseInt($('#summaryDeliveryPrice').text());
    var bonuska = parseInt($('#summaryBonusesOut').text());
    if (bonuska === NaN) {
        bonuska = 0;
    }
    summerow = summerow + delivo - bonuska;
    $('#summaryPriceFinal').text(summerow + ' руб');
}

function changeSaucePrice(obj) {
    var current = parseInt($(obj).closest('.col-3').find('.cart-spices__price').text());
    var addero = parseInt($('#addPrice').text());
    addero -= current;
    $('#addPrice').text(addero + ' руб.');

    var knowPrice = parseInt($('#totalPrice').text());
    var addingor = parseInt($('#addPrice').text());
    addingor = knowPrice + addingor;
    //$('#addPrice').text(addingor +' руб');
    $('#summaryPrice').text(addingor + ' руб');
    $('#summaryBonusesIn').text(addingor + ' руб');

    //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
    var summerow = parseInt($('#summaryPrice').text());
    var delivo = parseInt($('#summaryDeliveryPrice').text());
    var bonuska = parseInt($('#summaryBonusesOut').text());
    if (bonuska === NaN) {
        bonuska = 0;
    }
    summerow = summerow + delivo - bonuska;
    $('#summaryPriceFinal').text(summerow + ' руб');
}

function stayPrice(obj, kkaler, token, pricero, weighter) {
    var knowWeight = parseInt($('#numGramm').text());
    var knowKkal = parseInt($('#numKkal').text());
    var knowToken = parseInt($('#numToken').text());
    var knowPrice = parseInt($('#totalPrice').text());

    var pronio = $(obj).closest('.row');
    // var pronion = pronio.find('.cart-item__price.light.mt15');

    var pricento = parseInt(pronio.find('.cart-item__prop-item.cart-item__prop-item--price').text());
    var bonusento = parseInt(pronio.find('.cart-item__prop-item.cart-item__prop-item--bonus').text());
    var kalorento = parseInt(pronio.find('.cart-item__prop-item.cart-item__prop-item--ccal').text());
    var grammer = parseInt(pronio.find('.cart-item__prop-item.cart-item__prop-item--weight').text());
    pricento = knowPrice - pricento;
    bonusento = knowToken - bonusento;
    kalorento = knowKkal - kalorento;
    grammer = knowWeight - grammer;

    var pron = $(obj).closest('.row');
    var prono = pron.find('.cart-item__price.light.mt15');
    var clon = $(obj).closest('.mt65.text-center').find('.cart-item__price.light.mt15');
    clon.text(pricero + ' руб.');
    //console.log(knowPrice);
    console.log(pricero);
    //var knowTokens = parseInt($('#numToken').text());

    // pricer.children[1].innerText = howMuch + ' руб.';
    $('#numKkal').text(kalorento + ' ккал');
    $('#numGramm').text(grammer + ' грамм');
    $('#numToken').text(bonusento);
    $('#totalPrice').text(pricento + ' руб');
    var totallo = parseInt($('#totalPrice').text());
    var addero = parseInt($('#addPrice').text());
    addero += totallo;
    $('#summaryPrice').text(totallo + ' руб');
    var bonio = parseInt($('#numToken').text());
    $('#summaryBonusesIn').text(bonio);
    //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
    var summero = parseInt($('#summaryPrice').text());
    var delivo = parseInt($('#summaryDeliveryPrice').text());
    var bonuska = parseInt($('#summaryBonusesOut').text());
    if (bonuska === NaN) {
        bonuska = 0;
    }
    summero = summero + delivo - bonuska;
    $('#summaryPriceFinal').text(summero + ' руб');

}

function staySaucePrice(obj) {
    var current = parseInt($(obj).closest('.col-3').find('.cart-spices__price').text());
    var addero = parseInt($('#addPrice').text());
    addero -= current;
    if(addero <0) {
        plusPrice = 0;
    }
    $('#addPrice').text(addero + ' руб.');



    //КОД ДЛЯ ФИНАЛЬНОЙ СУММЫ
    var summero = parseInt($('#summaryPrice').text());
    var delivo = parseInt($('#summaryDeliveryPrice').text());
    var bonuska = parseInt($('#summaryBonusesOut').text());
    if (bonuska === NaN) {
        bonuska = 0;
    }
    console.log(bonuska);
    summero = summero + delivo - bonuska;
    $('#summaryPriceFinal').text(summero + ' руб');

}

$(document).on('click', '.categories__btn-order.right.mt10', function () {
   setTimeout('window.location.reload()', 2000);
});

$('.cart-delivery__radio').click(function (event) {
    var deliveryType = $(this).find('input[name=delivery-type]').val();
    console.log(deliveryType);
});

function showenter(str) {
    var city = $(str).attr('city');
    var street = $(str).val();
    if(street.length > 3) {
        $.ajax({
            url: "/kladr/getting",
            type: 'post',
            dataType: 'json',
            data: {
                'city': city,
                'street': street,
                'house': 0,
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

}

function showhome(str) {
    var city = $(str).attr('city');
    var home = $(str).val();
    var street = $('#street').val();
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

function raz(e, obj) {
    e.preventDefault();
    $("#livesearch").css('display', 'none');
    $("#street").val($(obj).text());
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

// $(document).on('change', '#mon-styler', function () {
//   var way =  $('#mon-styler :selected').val(); alert(way);
//     if(way == 'Yan') {
//         $('#payer').display('css', 'block');
//     }
//     // if (way)
// });
