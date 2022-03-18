<!DOCTYPE html>
<html lang="zh">

@include('layout.layout')
@yield('head')

<body>
    @yield('spinner')
    <div id="app">
        <navbar></navbar>
        <login></login>
        <toast></toast>
    </div>
</body>

</html>

@yield('js')
