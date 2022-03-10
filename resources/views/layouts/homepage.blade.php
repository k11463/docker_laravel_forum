<!DOCTYPE html>
<html lang="en">

<head>
    @yield('head')
</head>

<body>
    <div id="app">
        <div class="row-12">
            <div class="col-12" style="float: right;">
                @yield('navbar')
            </div>
            <div class="col-12" style="float: right;">
                @yield('articles')
            </div>
        </div>
    </div>
</body>

</html>
