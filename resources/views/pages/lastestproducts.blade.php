<!-- row -->
<div class="row">
  <!-- section title -->
  <div class="col-md-12">
    <div class="section-title">
      <h2 class="title">Danh sách sản phẩm</h2>
    </div>
    <span><h4>Giá tiền được tính theo 1Kg</h4></span>
  </div>
  <!-- section title -->
  @foreach ($lastest_products as $lastest_product)
    <!-- Product Single -->
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="product product-single">
        <div class="product-thumb">
          <img src="upload/images/{{$lastest_product->image}}" alt="" style="width: 260px; height: 190px;">
        </div>
        <div class="product-body">
          <h3 class="product-price">{{$lastest_product->price*(1-$lastest_product->discount)}} VNĐ</h3>
          @php
            $rating = round($lastest_product->comment->avg('rating'));
          @endphp
          <div class="product-rating">
            @for ($i=0; $i< $rating; $i++)
              <i class="fa fa-star"></i>
            @endfor
            @for ($i=0; $i< 5-$rating; $i++)
              <i class="fa fa-star-o empty"></i>
            @endfor
          </div>
          <h2 class="product-name"><a href="products/{{$lastest_product->id}}/show">{{$lastest_product->name}}</a></h2>
          <div class="product-btns">
            @if (Auth::user())
              @if ((App\Like::is_like(Auth::user()->id, $lastest_product->id)))
                <span class="liked icon-btn like-destroy" data-id="{{$lastest_product->id}}">
                  @if (count($lastest_product->like)>0)
                    {{count($lastest_product->like)}} 
                  @endif
                  <i class="fa fa-heart"></i>
                </span>
              @else
                <span class="main-btn icon-btn like-create" data-id="{{$lastest_product->id}}">
                  @if (count($lastest_product->like)>0)
                    {{count($lastest_product->like)}}
                  @endif 
                  <i class="fa fa-heart"></i>
                </span>
              @endif
            @else
              <span class="main-btn icon-btn like-create" data-id="{{$lastest_product->id}}">
                @if (count($lastest_product->like)>0)
                  {{count($lastest_product->like)}}
                @endif 
                <i class="fa fa-heart"></i>
              </span>
            @endif
            <button class="primary-btn add-to-cart" data-id="{{$lastest_product->id}}" quantity="1" > <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /Product Single -->
  @endforeach

</div>
<!-- /row -->