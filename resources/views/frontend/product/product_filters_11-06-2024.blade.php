<style>
  input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}
</style>
@foreach($filters as $filter)
                    
  @if($filter->filter_type == 'default')
      <hr class="filter-hr">

      <div class="row  ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <!-- <div> -->
            <div class="tab">

            <button class="accordion">{{ $filter->filter_name }}</button>
                <!-- <h4 class="filter-head">{{ $filter->filter_name }}<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></h4> -->
            <!-- </div> -->
            <div class="accordion-content">
          <div class="@if(isset($filter->filtervalues) && count($filter->filtervalues)>5)scroll @endif style-checkbox">
            @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
              @foreach($filter->filtervalues as $filter_value)
                <label class="style">
                  <span class="checkbox-text">
                    {{ $filter_value->filter_value }}
                  </span>
                  <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="checkbox" class="filter_check" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            @endif
          </div>
          </div>
        </div>
        </div>
      </div>
  @elseif($filter->filter_type == 'gender' && false)
  <hr class="filter-hr">
    <div class="row pt-2">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
        <div class="style-checkbox">
          @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
            @foreach($filter->filtervalues as $filter_value)
              <label class="style">
                <span class="gender-bold checkbox-text">{{ $filter_value->filter_value }}</span>
                <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="checkbox" class="filter_check" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                <span class="checkmark"></span>
              </label>
            @endforeach
          @endif
          
        </div>
      </div>
    </div>
  @elseif($filter->filter_type == 'size')
      <hr class="filter-hr">

      <div class="row products-filters ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
        <div class="tab">
          <button class="accordion">{{ $filter->filter_name }}</button>
          <!-- <h4 class="filter-head">{{ $filter->filter_name }}</h4> -->
          <div class="accordion-content ks-cboxtagsin">

          <ul class="ks-cboxtags">
            @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
              @foreach($filter->filtervalues as $filter_value)
              <li>
                <input type="checkbox" id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" class="filter_check" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                <label for="{{ $filter->filter_slug.$filter_value->filter_value_id }}">{{ $filter_value->filter_value }}</label>
              </li>
              @endforeach
            @endif
          </ul>
        </div>
        </div>
      </div>
      </div>
  @elseif($filter->filter_type == 'color')
      <hr class="filter-hr">

      <div class="row products-filters  ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
          <div class="tab">
            <button class="accordion swatchesin-in">{{ $filter->filter_name }}</button>
          <div class="accordion-content swatches-colorsin">
          @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
        <div class="scroll swatches-colors">
          <div class="swatch-color clearfix" data-option-index="1">
            @foreach($filter->filtervalues as $filter_value)
            <div data-value="Blue" class="swatch-element color blue available">
              <input style="background:{{ $filter_value->filter_value }};"  id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="checkbox"  class="filter_check" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif />
              <label for="{{ $filter->filter_slug.$filter_value->filter_value_id }}" title="{{ isset($filter_value->color->color_name)?$filter_value->color->color_name:'' }}">
              @if(isset($filter_value) && $filter_value->reference_data == 'multi')
                <img height="20" width="20" src="{{ asset('backend-assets/uploads/color_code/'.$filter_value->filter_value) }}" alt="Color">
              @else 
              <span style="background-color: {{ $filter_value->filter_value }}; border: 1px solid black;"></span>
              @endif
                
              </label>
            </div>
              @endforeach
              
          </div>
          </div>
          @endif
        </div>
        </div>
      </div>
      </div>

    @elseif($filter->filter_type == 'price')
      <hr class="filter-hr">

      <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
        <div class="tab">

            <button class="accordion">{{ $filter->filter_name }}</button>
          
          <div class="accordion-content">
          @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
            <div class="scroll style-checkbox">
              @foreach($filter->filtervalues as $filter_value)
                <label class="style">
                  <span class="checkbox-text">{{ $filter_value->filter_value }}</span>
                  <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="checkbox" class="filter_check price_filter" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" data-min_price="{{ $filter_value->filter_min_value }}" data-max_price="{{ $filter_value->filter_max_value }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            </div>
          @endif
        </div>
        </div>
      </div>
      </div>
      <div class="row products-filters pt-3 ">
        <div class="col-sm-12">
              <div id="slider-range"></div>
            </div>
          </div>
          <div class="row slider-labels">
            <div class="col-xs-6 caption">
              <span id="slider-range-value1"></span>
            </div>
            <div class="col-xs-6 text-right caption">
              <span id="slider-range-value2"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <form>
                <input type="hidden" name="min-value" id="min_value" class="price_filter" value="">
                <input type="hidden" name="max-value" id="max_value" class="price_filter" value="">
              </form>
            </div>
      </div>
      <div class="row text-center pt-3">
        <div class="col-lg-12">
            <div class="select-max-min">
              <!-- <form action="#"> -->
                <input type="number" maxlength="9" min="125" max="31999" id="low-price" placeholder="Min." name="high-price" class="min-max" aria-label="Min" >
                <input type="number" maxlength="9" min="126" max="32000" id="high-price" placeholder="Max." name="high-price" class="min-max" aria-label="Max" >
                <button class="move-right" id="search_price_filter" type="button"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></button>
              <!-- </form> -->
            </div>
        </div>
      </div>
    @elseif($filter->filter_type == 'material')
      <hr class="filter-hr">

      <div class="row  ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <!-- <div> -->
            <div class="tab">

            <button class="accordion">{{ $filter->filter_name }}</button>
                <!-- <h4 class="filter-head">{{ $filter->filter_name }}<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></h4> -->
            <!-- </div> -->
            <div class="accordion-content">
          <div class="@if(isset($filter->filtervalues) && count($filter->filtervalues)>5)scroll @endif style-checkbox">
            @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
              @foreach($filter->filtervalues as $filter_value)
                <label class="style">
                  <span class="checkbox-text">
                    {{ $filter_value->filter_value }}
                  </span>
                  <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="checkbox" class="filter_check" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            @endif
          </div>
          </div>
        </div>
        </div>
      </div>
    @elseif($filter->filter_type == 'discount')
      <hr class="filter-hr">

      <div class="row  ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <!-- <div> -->
            <div class="tab">

            <button class="accordion">{{ $filter->filter_name }}</button>
                <!-- <h4 class="filter-head">{{ $filter->filter_name }}<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></h4> -->
            <!-- </div> -->
            <div class="accordion-content">
          <div class="@if(isset($filter->filtervalues) && count($filter->filtervalues)>5)scroll @endif style-checkbox">
            @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
              @foreach($filter->filtervalues as $filter_value)
                <label class="style">
                  <span class="checkbox-text">
                    {{ $filter_value->filter_value }}
                  </span>
                  <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="radio" class="filter_check discount_filter" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" data-min_price="{{ $filter_value->filter_min_value }}" data-max_price="100" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            @endif
          </div>
          </div>
        </div>
        </div>
      </div>

    @elseif($filter->filter_type == 'ratings')
      <hr class="filter-hr">

      <div class="row  ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
            <!-- <div> -->
            <div class="tab">

            <button class="accordion">{{ $filter->filter_name }}</button>
                <!-- <h4 class="filter-head">{{ $filter->filter_name }}<i class="fa fa-chevron-down float-right" aria-hidden="true"></i></h4> -->
            <!-- </div> -->
            <div class="accordion-content">
          <div class="@if(isset($filter->filtervalues) && count($filter->filtervalues)>5)scroll @endif style-checkbox">
            @if(isset($filter->filtervalues) && count($filter->filtervalues)>0)
              @foreach($filter->filtervalues as $filter_value)
                <label class="style">
                  <span class="checkbox-text">
                    {{ $filter_value->filter_value }}
                  </span>
                  <input id="{{ $filter->filter_slug.$filter_value->filter_value_id }}" type="radio" class="filter_check ratings_filter" name="filter_check" value="{{ $filter_value->filter_value_id }}" data-name="{{ $filter_value->filter_value_slug }}" data-category="{{ $filter->filter_slug }}" data-min_price="{{ $filter_value->filter_min_value }}" data-max_price="5" @if(in_array($filter_value->filter_value_id,$filter_values_ids))checked @endif>
                  <span class="checkmark"></span>
                </label>
              @endforeach
            @endif
          </div>
          </div>
        </div>
        </div>
      </div>

    @endif

    @endforeach