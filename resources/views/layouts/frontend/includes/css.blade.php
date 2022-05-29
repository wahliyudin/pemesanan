<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<!-- Site CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<style>
    .nav-icon {
        display: flex;
        align-items: center;
    }

    .nav-icon .icon {
        color: #cfa671;
        font-size: 20px;
        transition: color .5s ease;
    }

    .nav-item:hover .nav-icon .icon {
        color: white;
    }

    .nav-item.active .nav-icon .icon {
        color: white;
    }

</style>
@stack('css')
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
