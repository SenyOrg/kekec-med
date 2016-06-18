<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $vc->getPageHeader()  }}
        <small>{{ $vc->getPageSubHeader()  }}</small>
    </h1>
    <ol class="head-buttons" style="top: 5px;">
        @yield('head-buttons')
    </ol>
</section>