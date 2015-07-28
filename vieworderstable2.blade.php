@extends('layouts.main')
@section('content')
    {{HTML::script(asset('js/jquery.js'))}}
    {{HTML::script(asset('js/jquery.datetimepicker.js'))}}
    {{HTML::script(asset('js/qrcode.js'))}}
    {{HTML::script(asset('js/md5.js'))}}
    {{HTML::script(asset('js/wechat-pay2.js'))}}
    {{HTML::style(asset('styles/bootstrap.css'))}}
    {{HTML::style(asset('styles/order-style.css'))}}

    <div class="hide order-tip">
        <a href="javascript:window.location.reload();" class="animated" id="new-order-txt">有<span class="new-order-num" id="new-order-num"></span>个新订单出现</a>
    </div>
    <input type="hidden" id="store-id-input" value="{{$store->id}}" />
    <input type="hidden" id="select-time-input" value="{{$time}}" />
    <div class="time-select-div">
        <a href="javascript:toogleTimeSelectBox(0);" class="time-select-btn" id="time-select-btn">{{empty($time)?$today:$today."&nbsp;&nbsp;&nbsp;&nbsp;(".$time.")"}}</a>
        <div class="time-select-box">
            <ul>
                @foreach($can_delivery_times as $can_delivery_time)
                    <li class="left time-item"><a href="javascript:;">{{$can_delivery_time}}</a></li>
                @endforeach
            </ul>
            <form method="post" action="{{url('order/mobileorders',$store->id)}}">
                <input type="hidden" id="time-arrs" name="timearrs" value="{{$time}}">
                <button id="sure-time-select" type="submit">确定</button>
            </form>
        </div>
    </div>
    <div class="container-body">
        {{--左边--}}
        <table class='table table-striped left order-list-table'>
            <thead>
            <tr>
                <th>序号</th>
                <th>单号</th>
                <th>用户</th>
                <th>总数</th>
                <th style="width:28%;">详情</th>
                <th style="width:28%;">备注</th>
                <th>配送时间</th>
                <th style="width:20%;">地址</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $k=>$order)
                <tr class="order-{{$order->id}} {{$last_fetch_id<$order->id?"new-order-item-tr":""}}" >
                    <td class="num-text">{{$k+1}}</td>
                    <td class="num-text">{{$order->id}}</td>
                    <td>{{$order->user->user_description}}</td>
                    <td class="num-text">{{$order->total}}</td>
                    <td>
                        <table class="orderitem-list">
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td >
                                        {{ $orderItem->item_description }}
                                        -
                                        @if( is_null($orderItem->attribute) )
                                            {{ $attribute = PomeMartDomainModel\Entities\Attribute::withTrashed()->find($orderItem->attribute_id)->attribute_name }}
                                        @else
                                            {{ $orderItem->attribute->attribute_name }}
                                        @endif
                                        *<span style="color:red;">{{ $orderItem->quantity }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td>
                        {{ $order->payment_note }}
                    </td>
                    <td class="num-text">
                        {{ $order->expect_deliver_at }}
                    </td>
                    <td>
                        @if (strpos($order->location_and_phone, "锦秋") !== false)
                            <h3 style="color:red">锦秋</h3>
                        @elseif (strpos($order->location_and_phone, "致真")  !== false)
                            <h3 style="color:green">致真</h1>
                                @else
                                @endif
                                <br>
                            {{$order->location_and_phone}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--右边--}}
        <div class="cofe-detail-list right">
            <ul  style="padding: 12px;">
                @foreach($coffeelist as $k=>$cl)
                    <li>
                        <span class="coffee-num">{{$cl}}</span>
                        <span class="coffee-name">{{$k}}</span>
                        <span class=""></span>
                    </li>
                @endforeach
            </ul>
            <div class="order-info" style="padding: 12px;border-top: 2px solid #FF8B2D;">
                <span>总订单/个<i class="tongji_num">{{count($orders)}}</i></span>
                <span>总计/杯<i class="tongji_num">{{$cup_total}}</i></span>
            </div>
        </div>

    </div>
    <div id="back-to-top" onclick="scrollToTop()">
       <span href="#" class="back-to-top-arrow"></span>
    </div>
    <script>

        $(function(){
            initTimeSelectLink();
            setInterval("fetchNewOrder()",30000);

            var audio_path = "{{public_path()}}/raw/";
            {{--$('body').append("<audio id='tipAudio'><source src='{{asset('raw/tip.mp3')}}' type='audio/mpeg'><source src='{{asset('raw/tip.wav')}}' type='audio/wav'><source src='{{asset('raw/notify.ogg')}}' type='audio/ogg'></audio>");--}}

            $('.time-select-box li.time-item').on('click',function(){
                var tt = $.trim($(this).find('a').text());

                var time_arr = $("#time-arrs").val().split('|');
                console.log(time_arr);
                var pos = $.inArray(tt,time_arr);
                if(pos!=-1){
                    console.log('在数组中：'+pos);
                    time_arr.splice(pos, 1);
                }else{
                    console.log(tt+'不在数组中：');
                    time_arr.push(tt);
                }
                $(this).toggleClass('selected');
                $("#time-arrs").val($.trim(time_arr.join('|')));
                console.log($("#time-arrs").val());
            });

            $(window).on('scroll',function(){
                 if(parseInt($(document).scrollTop())>100){
                     $('#back-to-top').show();
                 }else{
                     $('#back-to-top').hide();
                 }

            });
        });

        function initTimeSelectLink(){
            var time_arr = $('#select-time-input').val().trim().split('|');
            $('.time-item').each(function(i){
                var txt = $(this).find('a').text().trim();
                var pos = $.inArray(txt,time_arr);
                if(pos != -1){
                    $(this).addClass('selected');
                }
            });
        }

        function fetchNewOrder(){
            $.ajax({
                type: "POST",
                url : "/order/checknew",
                data :
                {
                    store_id : parseInt($('#store-id-input').val())
                },
                dataType : 'json',
                success:function(data){
                    if(data.code==2&&data.new_order_num!=undefined&&data.new_order_num>0) {
                        if($('#new-order-num').text().trim().indexOf(data.new_order_num)==-1){
                            voiceTip();
                        }

                        $('#new-order-num').text(data.new_order_num);
                        $('.order-tip').removeClass('hide');

                        if(!$('#new-order-txt').hasClass('tada')){
                            $('#new-order-txt').addClass('tada');
                        }

                    }
                },
                error:function(data){
                    $('#new-order-txt').html("获取信息失败");
                }
            });
        }

//        function voiceTip()
//        {
//            $('#tipAudio')[0].play();
//        }

        function toogleTimeSelectBox(flag)
        {
            console.log($('.time-select-box').css('height'));
            $('.time-select-box').fadeToggle(300);
        }

        function scrollToTop()
        {
            $('html, body').animate({scrollTop:0}, 'fast');
        }

    </script>

@stop