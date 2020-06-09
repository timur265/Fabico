@extends('front.layouts.app')

@section('title')
    @if($catalogType == 'category')
        {{ $category->ru_title }}
    @elseif ($catalogType == 'brand')
        {{ $brand->title }}
    @endif
@endsection

@section('content')
  <section class="catalog" id="catalog">
    <div class="container">
      <h2 class="page-title">@if($catalogType == 'category') {{ $category->ru_title }} @else {{ $brand->title }} @endif</h2>

      <div class="catalog__filter_md md_visible">
        <ul class=" uk-nav-parent-icon nav-bar-list catalog__sort_md" uk-nav="multiple: true">
          <li class="catalog__sortItem_md uk-parent">
            <a href="#">Категории</a>
            <ul class="uk-nav-sub catalog__sort_md-dropdown catalogSortDropdown">
              @foreach ($parentCategories as $categoryObject)
                  <li class="catalog__sort_md-dropdown__item">
                    <a href="{{ $categoryObject->getAncestorsSlugs() }}">{{ $categoryObject->ru_title }}</a>
                      @if ($categoryObject->children()->count() > 0)
                          <ul class="uk-nav-sub">
                              @foreach ($categoryObject->children as $child)
                                <li><a href="{{ $child->getAncestorsSlugs() }}">{{ $child->ru_title }}</a></li>
                              @endforeach
                          </ul>
                      @endif
                  </li>
              @endforeach
            </ul>
          </li>
          <li class="catalog__sortItem_md uk-parent">
            <a href="#">Бренд</a>
            <ul class="uk-nav-sub catalog__sort_md-dropdown catalogSortDropdown">
              @foreach ($brands as $brand)
                    <li class="catalog__sort_md-dropdown__item"><a href="{{ route('catalog.index', $brand->slug) }}">{{ $brand->title }}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="catalog__sortItem_md uk-parent">
            <a href="#">Цена</a>
            <ul class="uk-nav-sub catalog__sort_md-dropdown catalogSortDropdown">
              <li class="catalog__sort_md-dropdown__item"><a href="@if($catalogType == 'brand') {{ route('catalog.index', ['params' => $brand->slug, 'price_order' => 'asc']) }} @else {{ route('catalog.index', ['params' => $category->getAncestorsSlugs() , 'price_order' => 'asc']) }} @endif">По возрастанию</a></li>
              <li class="catalog__sort_md-dropdown__item"><a href="@if($catalogType == 'brand') {{ route('catalog.index', ['params' => $brand->slug, 'price_order' => 'desc']) }} @else {{ route('catalog.index', ['params' => $category->getAncestorsSlugs() , 'price_order' => 'desc']) }} @endif">По убыванию</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="catalog__filter md_hidden">
        <div class="catalog__sort">
          <div class="catalog__sortItem">
            <div class="catalog__sortCurrent" id="catalogPeople">
              <span class="lbl">Категории&nbsp; <i class="fa fa-angle-down"></i></span>
              <div class="" style="width: auto; padding: 0; white-space: nowrap; margin-top: 0; box-shadow: 0 0 62px rgba(20, 47, 106, 0.47); border-radius: 8px 10px 10px; background-color: #ffffff;" uk-dropdown="mode: hover; offset: 30">
                <ul class="uk-nav catalog__sort__dropdown catalogSortDropdown">
                  @foreach ($parentCategories as $categoryObject)
                    <li class="catalog__sort__dropdown__item catalogSortDropdownItem">
                      <a href="{{ $categoryObject->getAncestorsSlugs() }}">{{ $categoryObject->ru_title }}</a>
                      @if ($categoryObject->children()->count() > 0)
                            <ul class="uk-nav-sub catalog__sort__subdropdown">
                                @foreach ($categoryObject->children as $child)
                                  <li><a href="{{ $child->getAncestorsSlugs() }}">{{ $child->ru_title }}</a></li>
                                @endforeach
                            </ul>
                      @endif
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>

          <div class="catalog__sortItem">
            <div class="catalog__sortCurrent" id="catalogBrand">
              <span class="lbl">Бренд&nbsp; <i class="fa fa-angle-down"></i></span>
              <div class="" style="width: auto; padding: 0; white-space: nowrap; margin-top: 0; box-shadow: 0 0 62px rgba(20, 47, 106, 0.47); border-radius: 8px 10px 10px; background-color: #ffffff;" uk-dropdown="mode: hover; offset: 30">
                <ul class="uk-nav catalog__sort__dropdown catalogSortDropdown">
                  @foreach ($brands as $brand)
                      <li class="catalog__sort__dropdown__item catalogSortDropdownItem"><a href="{{ route('catalog.index', $brand->slug) }}">{{ $brand->title }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          <div class="catalog__sortItem">
            <div class="catalog__sortCurrent" id="catalogPrice">
              <span class="lbl">Цена&nbsp; <i class="fa fa-angle-down"></i></span>
              <div class="" style="width: auto; padding: 0; white-space: nowrap; margin-top: 0; box-shadow: 0 0 62px rgba(20, 47, 106, 0.47); border-radius: 8px 10px 10px; background-color: #ffffff;" uk-dropdown="mode: hover; offset: 30">
                <ul class="uk-nav catalog__sort__dropdown catalogSortDropdown">
                  <li class="catalog__sort__dropdown__item catalogSortDropdownItem"><a href="@if($catalogType == 'brand') {{ route('catalog.index', ['params' => $brand->slug, 'price_order' => 'asc']) }} @else {{ route('catalog.index', ['params' => $category->getAncestorsSlugs() , 'price_order' => 'asc']) }} @endif">По возрастанию</a></li>
                  <li class="catalog__sort__dropdown__item catalogSortDropdownItem"><a href="@if($catalogType == 'brand') {{ route('catalog.index', ['params' => $brand->slug, 'price_order' => 'desc']) }} @else {{ route('catalog.index', ['params' => $category->getAncestorsSlugs() , 'price_order' => 'desc']) }} @endif">По убыванию</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div uk-slideshow="animation: push; max-height: 262;" class="catalog-slider uk-margin-medium-bottom md_hidden" index="1">

        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
          <ul class="uk-slideshow-items">
            <li>
              <img src="{{ asset('front/img/category/slider/1.jpg') }}" alt=""  class="uk-cover">
              <div class="uk-overlay uk-position-center uk-position-small">
                <h3 class="catalog-slider__title">The Universe Through A Child S Eyes</h3>
                <p class="uk-margin-large-top catalog-slider__subtitle">Start sales</p>
              </div>
            </li>
            <li>
              <img src="{{ asset('front/img/category/slider/2.jpg') }}" alt=""  class="uk-cover">
              <div class="uk-overlay uk-position-center uk-position-small">
                <h3 class="catalog-slider__title">The Universe Through A Child S Eyes</h3>
                <p class="uk-margin-large-top catalog-slider__subtitle">Start sales</p>
              </div>
            </li>
          </ul>

          <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
          <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

          <div class="uk-position-bottom-center">
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin catalog-slider-dotnav"></ul>
          </div>
        </div>
      </div>

    </div>

    <div uk-slideshow="animation: push;" class="catalog-slider uk-margin-medium-bottom md_visible" index="1">
      <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
        <ul class="uk-slideshow-items">
          <li>
            <img src="{{ asset('front/img/category/slider/1.jpg') }}" alt=""  class="uk-cover">
            <div class="uk-overlay uk-position-center uk-position-small">
              <h3 class="catalog-slider__title catalog-slider__title_md">The Universe Through A Child S Eyes</h3>
              <p class="uk-margin-large-top catalog-slider__subtitle">Start sales</p>
            </div>
          </li>
          <li>
            <img src="{{ asset('front/img/category/slider/2.jpg') }}" alt=""  class="uk-cover">
            <div class="uk-overlay uk-position-center uk-position-small">
              <h3 class="catalog-slider__title catalog-slider__title_md">The Universe Through A Child S Eyes</h3>
              <p class="uk-margin-large-top catalog-slider__subtitle">Start sales</p>
            </div>
          </li>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

      </div>

    </div>

    <div class="container">

      <div class="row">

        @foreach($products as $product)
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
              <div class="catalog-card">
                <a href="{{ route('catalog.index', $product->getAncestorsSlugs()) }}">
                  <div class="catalog-card__img">
                      @foreach($product->getAllImages() as $key => $image)
                          <img src="{{ $image->getCatalogImage() }}" alt="" data-color="{{ $key }}" @if($key !== 0) style="display: none;" @endif>
                      @endforeach
                  </div>
                </a>
                <div class="catalog-card-choice">
                    @foreach ($product->getAllImages() as $key => $image)
                <div class="catalog-card-choice__elem @if ($key == 0) catalog-card-choice__elem--active @endif" data-color-hex="{{ $image->color->colorHEX }}" data-color-name="{{ $image->color->name }}" data-color="{{ $key }}">
                          <img src="{{ $image->getCatalogImage() }}" alt="{{ $product->title }}">
                        </div>
                    @endforeach
                </div>
                <div class="catalog-card__title">
                  <a href="{{ $product->getAncestorsSlugs() }}">{{ $product->title }}</a>
                </div>
                <div class="catalog-card__buy">
                  <span class="catalog-card__price">{{ number_format($product->price, 0, ',', ' ') }} RMB</span>
                  <i class="fa fa-shopping-cart add-to-cart-button" data-product-id="{{ $product->id }}"></i>
                </div>
              </div>
            </div>
        @endforeach

      </div>
      {{-- <div class="loadmore">
        <div class="spinner-border text-primary" style="width: 40px; height: 40px; margin-right: 10px;" role="status"></div>
        load more
      </div> --}}
    </div>
  </section>
  @include('front.layouts.feedback')
@endsection
@section('js')
    <script>
        jQuery(function() {
            $('.add-to-cart-button').on('click', function(e) {
                e.preventDefault();
                let element = $(this);
                let catalogCardElement = element.parent().parent();
                let activeImage = catalogCardElement.find('.catalog-card-choice__elem--active');
                let colorHex = activeImage.data('color-hex');
                let colorName = activeImage.data('color-name');
                let quantity = 3;
                let productId = element.data('product-id');

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    'method': 'post',
                    data: {_token: '{{ csrf_token() }}', productId, quantity: quantity, colorHex, colorName},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        })
    </script>
@endsection
