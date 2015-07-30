<header>{{$message or ''}}</header>
<section>
    @if(Auth::check())
    <p>你现在已经登录进来了{{HTML::link('user/signout','点击退出')}}</p>
    @else
    <p>{{HTML::link('user/signin','点击登入')}}</p>
    @endif
</section>