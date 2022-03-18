<!DOCTYPE html>
<html lang="zh">

@include('layout.layout')
@yield('head')

<body>
    @yield('spinner')
    <div id="app">
        <navbar></navbar>
        <home></home>
        <toast></toast>
        <footbar></footbar>
    </div>
</body>

</html>

@yield('js')
