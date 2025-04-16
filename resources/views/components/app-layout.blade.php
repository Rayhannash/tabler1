<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

@include('partials.head', ['pageTitle' => $pageTitle])


<body class="{{ $pageTitle <> 'Login' ? 'layout-fluid' : 'd-flex flex-column' }}"data-bs-theme="light">
    <div class="page">
        <!-- Sidebar -->
        @if($pageTitle <> 'Login')
            @include('partials.sidebar')
            @include('partials.navbar')
            <div class="page-wrapper">
        @endif
            <!-- Page body -->
            {{ $slot }}
            <!-- Footer -->
        @if($pageTitle <> 'Login')
            @include('partials.footer')
            </div>
        @endif
    </div>
    <!-- Scripts -->
    @include('partials.scripts')
</body>

</html>
<!--  -->
