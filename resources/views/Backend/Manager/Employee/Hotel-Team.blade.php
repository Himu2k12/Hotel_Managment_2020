@extends('Backend.master')

@section('title')
    New York Team
@endsection
@section('style')
    <style>

        ul, ol { font-family: 'Montserrat', sans-serif; }
        a { text-decoration: none; color: #55595d; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; transition: all 0.3s; }
        a:focus, a:hover { text-decoration: none; color: #c38d3f; }
        .content{padding-top:80px; padding-bottom:80px;}
        .mb40{margin-bottom:40px;}

        .team-block { }
        .team-img { margin-bottom: 20px; position: relative; }
        .team-img img { width: 100%; }
        .team-img img.border { border-color: #fff !important; }
        .social-media { position: absolute; bottom: 36px; opacity: 0; }
        .social-icon-box { margin-bottom: 5px; background-color: #193e6b; width: 46px; height: 46px; color: #ffffff; font-size: 16px; padding: 15px 19px 26px 16px; display: inline-block; line-height: 1.2; }
        .team-img:hover .social-media { opacity: 1; transition: 2s ease; }
        .team-block.active .social-media { opacity: 1; transition: 2s ease; }
    </style>

@endsection
@section('content')

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb40 text-center">
                    <h2 class="page-title">HOTEL NEW YORK TEAM</h2>
                    <!-- /.section-title -->
                </div>
            </div>
            <div class="row">
                @foreach($staffInfo as $data)
                <!-- team-block -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb30">
                    <div data-aos="fade-up" class="team-block">
                        <div class="team-img">
                            <a href="{{url('view-new-staff-adding-form/'.$data->user_id)}}">
                                <img src="{{asset('Staff_photos/'.$data->staff_photo)}}" alt="" height="250px">
                                <div class="social-media">
                                    <a href="#" class="social-icon-box"><i class="fab fa-facebook-f"></i></a>
                                    <br>
                                    <a href="#" class="social-icon-box"><i class="fab fa-twitter"></i></a>
                                    <br>
                                    <a href="#" class="social-icon-box"><i class="fab fa-google-plus-g"></i></a>
                                    <br>
                                    <a href="#" class="social-icon-box"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="team-content">
                            <h4>{{$data->first_name}} {{$data->last_name}}</h4>
                        </div>
                    </div>
                </div>
                <!-- /.team-block -->

                    @endforeach
            </div>
        </div>


@endsection
