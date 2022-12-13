@extends('master')

@section('title', "Details of Product {{ $product->nama }}")

@section('content_master')

@push('styles')
    <style>
        
    @import 'https://fonts.googleapis.com/css?family=Baloo+Tamma|Raleway|Lato';
    body {
    font: 15px/1.25 "Raleway";
    font-weight: 400;
    }

    h1,
    h2,
    h3,
    button {
    font-family: "Baloo Tamma";
    }

    .wrapper {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #5dac48;
    position: relative;
    }

    .product-single {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    min-width: 761px;
    font-size: 16px;
    z-index: 1;
    }
    .product-single .product-gallery {
    margin-bottom: -4px;
    overflow: hidden;
    float: left;
    width: 380px;
    height: 380px;
    border-right: 1px solid #d0ddcb;
    position: relative;
    }
    .product-single .product-gallery:hover .slider-arrows {
    opacity: 1;
    height: 30px;
    }
    .product-single .product-gallery ul,
    .product-single .product-gallery li {
    margin: 0;
    padding: 0;
    list-style: none;
    }
    .product-single .product-gallery .slider-arrows {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    margin: auto;
    height: 0;
    font-size: 30px;
    color: #fff;
    padding: 0 10px;
    opacity: 0;
    transition: all 0.2s ease-in;
    z-index: 1;
    }
    .product-single .product-gallery .slider-arrows i {
    text-shadow: 0 0 7px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    color: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease-in-out;
    }
    .product-single .product-gallery .slider-arrows i:hover {
    color: #fff;
    }
    .product-single .product-gallery .slider-arrows i:first-child {
    float: left;
    }
    .product-single .product-gallery .slider-arrows i:last-child {
    float: right;
    }
    .product-single .product-gallery #slider-wrap {
    position: relative;
    background: #999;
    overflow: hidden;
    height: 380px;
    width: 380px;
    }
    .product-single .product-gallery #slider-wrap .slides {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    transition: all 0.2s 0.1s ease-out;
    }
    .product-single .product-gallery #slider-wrap .slides li {
    float: left;
    width: 380px;
    height: 380px;
    position: relative;
    }
    .product-single .product-gallery #slider-wrap .slides img {
    max-width: 100%;
    }
    .product-single .product-gallery .nav-dots {
    display: block;
    margin: auto;
    text-align: center;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 12px;
    }
    .product-single .product-gallery .nav-dots li {
    height: 8px;
    width: 8px;
    border-radius: 50%;
    margin-right: 10px;
    position: relative;
    display: inline-block;
    background: transparent;
    }
    .product-single .product-gallery .nav-dots li:before {
    content: "";
    position: absolute;
    background: transparent;
    top: -50%;
    bottom: -50%;
    right: -50%;
    left: -50%;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 7px -2px #000;
    }
    .product-single .product-gallery .nav-dots li.active {
    background: #d75229;
    transition: all 0.1s 0.1s linear;
    }
    .product-single .product-gallery .nav-dots li:last-child {
    margin-right: 0;
    }
    .product-single .product-details {
    padding: 20px;
    width: 380px;
    height: 380px;
    float: left;
    box-sizing: border-box;
    font-size: 14px;
    position: relative;
    }
    .product-single .product-details .product-title {
    margin-top: 0;
    line-height: 1;
    font-size: 1.6rem;
    font-weight: 600;
    color: #d75229;
    }
    .product-single .product-details .product-cost {
    font-size: 20px;
    /* margin-bottom: 10px; */
    color: #5dac48;
    }
    .product-single .product-details .product-rating .product-reviews {
    font-family: "Lato";
    margin-left: 15px;
    font-size: 12px;
    }
    .product-single .product-details .product-rating .product-reviews a {
    color: #999;
    text-transform: uppercase;
    text-decoration: none;
    transition: color 0.05s ease;
    }
    .product-single .product-details .product-rating .product-reviews a:hover {
    text-decoration: underline;
    color: #d75229;
    }
    .product-single .product-details .product-rating ul {
    display: inline-block;
    }
    .product-single .product-details .product-rating ul,
    .product-single .product-details .product-rating li {
    padding: 0;
    margin: 0;
    list-style: none;
    }
    .product-single .product-details .product-rating li {
    color: #fcd000;
    }
    .product-single .product-details .product-description {
    font-size: 15px;
    line-height: 1.1;
    overflow: hidden;
    max-height: 150px;
    margin: 10px 0;
    }
    .product-single .product-details .product-cta {
    /* text-align: center; */
    margin: 13px 0;
    margin-left: 20px;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 40px;
    }
    .product-single .product-details .product-atc,
    .product-single .product-details .product-atw {
    font-size: 16px;
    padding: 10px 22px;
    color: #fff;
    border: none;
    margin: auto;
    border-radius: 20px;
    transition: all 0.1s ease;
    margin-right: 10px;
    }
    .product-single .product-details .product-atc:last-child,
    .product-single .product-details .product-atw:last-child {
    margin: 0;
    }
    .product-single .product-details .product-atc:focus,
    .product-single .product-details .product-atw:focus {
    outline: none;
    }
    .product-single .product-details .product-atc:hover,
    .product-single .product-details .product-atw:hover {
    background: #d75229;
    }
    .product-single .product-details .product-atc {
    background: #5dac48;
    }
    .product-single .product-details .product-atw {
    color: #999;
    }
    .product-single .product-details .product-atw:hover {
    color: #fff;
    }
    .product-single .product-details .product-info {
    font-size: 11px;
    font-family: "Lato";
    position: absolute;
    bottom: 20px;
    margin-top: 10px;
    color: #999;
    }
    .product-single .product-details .product-info span {
    display: inline-block;
    margin-right: 10px;
    }
    </style>
@endpush

<a href="{{ route('homepage') }}" class="mt-2 font-semibold text-slate-800 hover:text-green-300 transition duration-200 ease-in-out" >Kembali</a>

    <div class="product-single" style="margin-top: 1rem;">
      <div class="product-gallery">
        <div class="slider-arrows"><i class="fa fa-fw fa-arrow-circle-o-left" id="prev-slide"></i><i class="fa fa-fw fa-arrow-circle-o-right" id="next-slide"></i></div>
        <div id="slider-wrap">
          <ul class="slides">
            <li><img src="{{ asset($product->foto_url) }}" alt=""/></li>
          </ul>
          {{-- <ul class="nav-dots">
            <li class="active"></li>
          </ul> --}}
        </div>
      </div>
      <div class="product-details">
        <h1 class="product-title">{{ $product->nama }}</h1>
        <div style="display: flex; align-items: center; gap: 10px; margin-top: .4rem;">
          <h3 class="product-cost">Rp. {{ $product->diskon > 0 ? $product->harga_diskon : $product->harga }} </h3>
          <span style="font-size: 1rem;">{{ floor($product->diskon) }}%</span>
        </div>
        {{-- <div class="product-rating">
          <ul>
            <li class="fa fa-fw fa-lg fa-star"></li>
            <li class="fa fa-fw fa-lg fa-star"></li>
            <li class="fa fa-fw fa-lg fa-star"></li>
            <li class="fa fa-fw fa-lg fa-star"></li>
            <li class="fa fa-fw fa-lg fa-star-half"></li>
          </ul><span class="product-reviews"><a href="#">10 Reviews</a></span>
        </div> --}}
        <div class="product-description">
          <p>
            {{ $product->deskripsi }}
          </p>
        </div>
        <div class="product-cta">
          <button class="product-atc">Add to Cart</button>
        </div>
        <div class="product-info"><span class="product-sku">SKU #{{ $product->id }}</span></div>
      </div>
    </div>
</div>


@push('scripts')
  <script type="text/javascript">var $sliderWrap = $('#slider-wrap'),
    $slider = $sliderWrap.find('.slides'),
    $firstSlide = $slider.find('li:first'),
    $lastSlide = $slider.find('li:last'),
    $sliderSlides = $sliderWrap.find('.slides > li'),
    $navDots = $sliderWrap.find('.nav-dots li'),
    $slideArrowLeft = $('#prev-slide'),
    $slideArrowRight = $('#next-slide'),
    $slideArrows = $slideArrowLeft.add($slideArrowRight),
    sliderWidth = $sliderWrap.width(),
    // dynamic variables
    sliderPos = 0,
    s_index = 0,
    currentSlide = $sliderSlides[s_index];

    function changeSlide() {
        $slider.css('left', sliderPos);

        $navDots.removeClass('active');
        $($navDots[s_index]).addClass('active');
    }


    function setSliderWidth() {
        /* -----------------------------------------
        * set slider width
        * slider container * number of slides
        * ----------------------------------------- */
        $slider.css('width', sliderWidth * $sliderSlides.length);
    }

    function nextSlide() {
        /* -----------------------------------------
        * IF: slide index >= total slides
        * THEN:
        *      slide index = 0 
        *      slide pos = 0
        * ELSE:
        *      slide index + 1
        *      move slider position one slide
        * ---------------------------------------- */
        s_index >= ($sliderSlides.length - 1) ? (
            // s_index = 0,
            // sliderPos = 0,
            false
        ) : (
            s_index++,
            sliderPos -= sliderWidth
        );

        // change slide
        changeSlide();
    }

    function prevSlide() {
        /* -----------------------------------------
        * IF: slide index <= 0
        * THEN:
        *      slide index = $slides.length
        *      move slider position to last slide
        * ELSE:
        *      slide index - 1
        *      move slider position back one slide
        * ---------------------------------------- */
        s_index <= 0 ? (
            // s_index = ($sliderSlides.length - 1),
            // sliderPos = -$sliderWrap.width()
            false
        ) : (
            s_index--,
            sliderPos += sliderWidth
        );

        // change slide
        changeSlide();
    }

    // set slider width
    setSliderWidth();

    $slideArrows.on('click', function() {
        // get target id
        var $target_id = $(this).attr('id');

        /* -----------------------------------------
        * Based on target id
        * Execute nextSlide() or prevSlide()
        * --------------------------------------- */
        switch ($target_id) {
            case 'prev-slide':
                prevSlide();
                break;
            case 'next-slide':
                nextSlide();
                break;
        }
    });

    $navDots.on('click', function(e) {
        var oldIndex = s_index,
            curIndex = $navDots.index(this);

        /* -----------------------------------------
        * IF: curIndex = oldIndex
        * THEN: return false
        * ELSE IF: oldIndex < curIndex
        * THEN: nextSlide()
        * ELSE: prevSlide()
        * ----------------------------------------- */
        curIndex === oldIndex ? false : (oldIndex < curIndex) ? nextSlide() : prevSlide();
    });
  </script>
@endpush

@endsection