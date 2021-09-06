<div id="bg" style="width: 100vw; height: 100vh; position: fixed; z-index: -100;">
    @php
        
        // $background_type = ''; // image_changer | image_changer_fade | night_moon | spiderweb | web_buildings | stars_to_up | zodiac_sign | waves | moving_note | note
        
        // if (empty($background_type)) {
        //     $time = intval(date('H'));
        //     if (4 <= $time && $time < 24) {
        //         $background_type = 'image_changer';
        //     } else {
        //         $background_type = 'night_moon';
        //     }
        // }
        
        $topImageUrl_arr = ['layout/bg/img/main/01.jpg', 'layout/bg/img/main/02.jpg', 'layout/bg/img/main/03.jpg', 'layout/bg/img/main/04.jpg'];
        
    @endphp

    @switch($background_type)
        @case('image_changer')
            <ul class="background-container bg_img_changer">
                @for ($i = 0; $i < count($topImageUrl_arr); $i++)
                    <li class="bg_keys_anm"></li>
                @endfor
            </ul>
            <style>
                .bg_img_changer li:not(.sp-bg) {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100vh;
                    background-repeat: no-repeat !important;
                    opacity: 0;
                    animation: anm-image-changer {{ count($topImageUrl_arr) * 5 . 's' }} linear 0s infinite;
                    background-position: 50% 50% !important;
                    background-size: cover !important;
                }

                @foreach ($topImageUrl_arr as $key => $value).bg_img_changer li:nth-child({{ $key + 1 }}) {
                    background: linear-gradient(to top, rgba(0, 0, 0, 0) 85%, rgba(0, 0, 0, 0.7) 100%), url({{ $value }});
                    {{ $key ? 'animation-delay: ' . $key * 5 . 's' : '' }}
                }

                @endforeach @keyframes anm-image-changer {
                    0% {
                        animation-timing-function: ease-in;
                        opacity: 0;
                        z-index: -1;
                    }

                    10% {
                        opacity: 1;
                    }

                    20% {}

                    40% {
                        transform: scale(1.15);
                        animation-timing-function: ease-out;
                        opacity: 1;
                        z-index: -2;
                    }

                    50% {
                        opacity: 0;
                    }

                    100% {
                        opacity: 0;
                    }
                }

            </style>

        @break
        @case('')

        @break

        @case('image_changer_fade')
            @php
                $interval = 8;
            @endphp
            <ul class="background-container bg_img_changer">
                @foreach ($topImageUrl_arr as $key => $value)
                    <li class="bg_keys_anm"><img src="{{ $value }}" /></li>
                @endforeach
            </ul>
            <style>
                .bg_img_changer li {
                    position: absolute;
                    overflow: hidden;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100vh;
                    z-index: -10;
                    opacity: 1;
                }

                .bg_img_changer li.pre_active {
                    opacity: 0;
                }

                .bg_img_changer li.next_active {
                    opacity: 1;
                    z-index: -9;
                }

                .bg_img_changer li.active {
                    z-index: -8;
                    opacity: 1;
                    animation: image_changer_fade {{ $interval }}s ease-in-out 0s both;
                }

                .bg_img_changer li img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    z-index: inherit;
                }

                @keyframes image_changer_fade {

                    0%,
                    10% {
                        opacity: 1;
                    }

                    100% {
                        opacity: 0;
                    }
                }

            </style>
            <script type="module">
                $(function() {
                    var $interval = {{ $interval }}000;
                    $(".bg_img_changer li:last").addClass("pre_active");
                    $(".bg_img_changer li:first").addClass("active");
                    $(".bg_img_changer li:first").next("li").addClass("next_active");
                    setInterval(function() {
                        var $active = $(".bg_img_changer li.active");
                        var $next_active = $(".bg_img_changer li.next_active");
                        var $next_next = $next_active.next("li").length ? $next_active.next("li") : $(
                            ".bg_img_changer li:first");
                        $(".bg_img_changer li.pre_active").removeClass("pre_active");
                        $active.addClass("pre_active").removeClass("active");
                        $next_active.addClass("active").removeClass("next_active");
                        $next_next.addClass("next_active");
                    }, $interval);
                });
            </script>

        @break

        @case('night_moon')
            <ul class="background-container">
                <li class="bg-night_moon">
                    <img class="moon" src="layout/bg/img/night_moon/moon.png" alt="">
                    <div class="stars"></div>
                    <div class="twinkling"></div>
                    <div class="clouds"></div>
                </li>
            </ul>
            <style>
                @keyframes move-background {
                    from {
                        transform: translate3d(0px, 0px, 0px);
                    }

                    to {
                        transform: translate3d(1000px, 0px, 0px);
                    }
                }

                .bg-night_moon {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100vh;
                }

                .stars {
                    background: black url('./layout/bg/img/night_moon/stars.png') repeat;
                    position: absolute;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    display: block;
                    z-index: -10;
                }

                .twinkling {
                    width: 10000px;
                    height: 100%;
                    background: transparent url('./layout/bg/img/night_moon/twinkling.png') repeat;
                    background-size: 1000px 1000px;
                    position: absolute;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    z-index: -9;
                    animation: move-background 70s linear infinite;
                }

                .clouds {
                    width: 10000px;
                    height: 100%;
                    background: transparent url('./layout/bg/img/night_moon/clouds_repeat.png') repeat;
                    background-size: 1000px 1000px;
                    position: absolute;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    z-index: -8;
                    animation: move-background 150s linear infinite;
                }

                img.moon {
                    height: 18vh;
                    width: 18vh;
                    position: absolute;
                    z-index: -8;
                    top: 12vw;
                    right: 12vw;
                }

            </style>
        @break

        @case('spiderweb')
            <div id="bg_spiderweb"></div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r67/three.min.js"></script>
            <script src="layout/bg/js/spiderweb.js"></script>
            <style>
                #bg {
                    background-color: blue;
                    background-image: url(fallback-gradient.svg);
                    background-image: -webkit-gradient(linear, left top, right top, from(blue), to(#f06d06));
                    background-image: -webkit-linear-gradient(left, blue, #f06d06);
                    background-image: -moz-linear-gradient(left, blue, #f06d06);
                    background-image: -o-linear-gradient(left, blue, #f06d06);
                    background-image: linear-gradient(to right, blue, #f06d06);
                    margin: 0;
                    overflow: hidden
                }

            </style>
        @break

        @case('web_buildings')
            <script src="./layout/bg/js/web_buildings.js"></script>
        @break


        @case('stars_to_up')
            <div id="bg_stars"></div>
            <div id="bg_stars2"></div>
            <div id="bg_stars3"></div>
            <link rel="stylesheet" href="./layout/bg/css/bg_stars.css">
        @break

        @case('zodiac_sign')
            <div id="particles">
                <div class="overlay"></div>
            </div>
            <style>
                #bg {
                    background: #1f1fad
                }

                #particles {
                    background-size: cover;
                    background-repeat: no-repeat;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }

                .overlay {
                    position: fixed;
                    background: rgba(0, 0, 0, 0.5);
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: block;
                }

            </style>
            <script src="./layout/bg/js/zodiac_sign.js"></script>
        @break

        @case('waves')
            <canvas id="waveCanvas"></canvas>
            <style>
                #waveCanvas {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 200px;
                }

            </style>
            <script src="./layout/bg/js/bg_waves.js"></script>
        @break

        @case('moving_note')
            <link rel="stylesheet" href="./layout/bg/css/bg_moving_note.css">
        @break

        @case('note')
            <style>
                #bg {
                    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAIAAAC0Ujn1AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAB4SURBVEhL7da7DcAgDEXROFBAAfuvxgZMgCX+RnSunSKSr2SXp36QUgohxBgB4BGqtdZ7h5yzc857L0iPMeacgIjGGGutIL3Wov/SESroUhc89EcpzVKapTRLaZbSLKVZSrN+StdaaZ/dvSMVbb5SyqFpoonTiLgBVrs1TWYBhyQAAAAASUVORK5CYII=") repeat 0 0;
                }

                @media screen and (min-width:500px) {
                    #bg {
                        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAABnSURBVHja7M5RDYAwDEXRDgmvEocnlrQS2SwUFST9uEfBGWs9c97nbGtDcquqiKhOImLs/UpuzVzWEi1atGjRokWLFi1atGjRokWLFi1atGjRokWLFi1af7Ukz8xWp8z8AAAA//8DAJ4LoEAAlL1nAAAAAElFTkSuQmCC") repeat 0 0;
                    }
                }

            </style>
        @break

        @default
        <style>
            #bg{
                background-color: #f1f1f1;
            }
        </style>
            @break

        @endswitch
    </div>
