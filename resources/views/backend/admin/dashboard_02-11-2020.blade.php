@extends('backend.layouts.app')
@section('title', 'Admin-Dashboard')
@section('content')
@if(Auth::guard('admin')->user()->user_type !='counter')
<!-- begin::Body -->
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
      <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
          <div class="d-flex align-items-center">
            <div class="mr-auto">
              <h3 class="m-subheader__title ">
                Dashboard
              </h3>
            </div>
            <div>
              <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                <span class="m-subheader__daterange-label">
                  <span class="m-subheader__daterange-title"></span>
                  <span class="m-subheader__daterange-date m--font-brand"></span>
                </span>
                <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                  <i class="la la-angle-down"></i>
                </a>
              </span>
            </div>
          </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
          <!--Begin::Section-->
          <div class="row">
            <div class="col-xl-6">
              <!--begin:: Widgets/Quick Stats-->
              <div class="row m-row--full-height">
                <div class="col-sm-12 col-md-12 col-lg-6">
                  <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-brand ">
                    <div class="m-portlet__body">
                      <div class="m-widget26">
                        <div class="m-widget26__number">
                          <i class="la la-rupee big"></i>{{ format_currency($all_sale) }}
                          <small>
                            Total Sales
                          </small>
                        </div>
                        <div class="m-widget26__chart" style="height:90px; width: 220px;">
                          <canvas id="m_chart_quick_stats_1"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="m--space-30"></div>
                  <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-danger ">
                    <div class="m-portlet__body">
                      <div class="m-widget26">
                        <div class="m-widget26__number">
                          {{$all_orders}} / {{$manual_orders}}
                          <small>
                            Total Orders / Manual Orders
                          </small>
                        </div>
                        <div class="m-widget26__chart" style="height:90px; width: 220px;">
                          <canvas id="m_chart_quick_stats_2"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                  <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-accent ">
                    <div class="m-portlet__body">
                      <div class="m-widget26">
                        <div class="m-widget26__number">
                          <i class="la la-rupee big"></i>{{ format_currency($all_current_year_sale) }}
                          <small>
                            Current Year Sale ({{$start_year}} - {{$end_year}})
                          </small>
                        </div>
                        <div class="m-widget26__chart" style="height:90px; width: 220px;">
                          <canvas id="m_chart_quick_stats_4"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="m--space-30"></div>
                  <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-success ">
                    <div class="m-portlet__body">
                      <div class="m-widget26">
                        <div class="m-widget26__number">
                          {{$all_distributors}} / {{$all_pc}}
                          <small>
                            Distributors / PC
                          </small>
                        </div>
                        <div class="m-widget26__chart" style="height:90px; width: 220px;">
                          <canvas id="m_chart_quick_stats_3"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Quick Stats-->
            </div>
            <div class="col-xl-6">
              <!--begin:: Widgets/Finance Summary-->
              <div class="m-portlet m-portlet--full-height m-portlet--fit ">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text">
                        Finance Summary
                      </h3>
                    </div>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="tab-content">
                    <div class="tab-pane active">
                      <div class="m-widget12 m-widget12--chart-bottom m--margin-top-10" style="min-height: 450px">
                        <div class="m-widget12__item">
                          <span class="m-widget12__text1">
                            Total Collection
                            <br>
                            <span>
                              <i class="la la-rupee small"></i> <span class="todays_collection">{{ format_currency($todays_collection) }}</span>
                            </span>
                          </span>
                          <span class="m-widget12__text2">
                            Online / Manual Collection
                            <br>
                            <span>
                              <i class="la la-rupee small"></i><span class="todays_online_orders_collection"> {{ format_currency($todays_online_orders_collection) }} </span> / <i class="la la-rupee small"></i><span class="todays_manual_orders_collection"> {{ format_currency($todays_manual_orders_collection) }} </span>
                            </span>
                          </span>
                        </div>
                        <div class="m-widget12__item">
                          <span class="m-widget12__text1">
                            Online Orders
                            <br>
                            <span class="todays_orders">
                              {{$todays_orders}}
                            </span>
                          </span>
                          <span class="m-widget12__text2">
                            Manual Order
                            <br>
                            <span  class="todays_manual_orders">
                              {{$todays_manual_orders}}
                            </span>
                          </span>

                        </div>
                        <div class="m-widget12__chart m-portlet-fit--sides" style="height:290px;">
                          <canvas id="m_chart_finance_summary"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane"></div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Finance Summary-->
            </div>
          </div>
          <!--End::Section-->
        </div>
      </div>
    </div>
  </div>
  <!-- end:: Body -->

<script>
$(document).ready(function(){

      if(0!=$("#m_dashboard_daterangepicker").length) {
          var e=$("#m_dashboard_daterangepicker"),
          t=moment(),
          a=moment();
          e.daterangepicker( {
              startDate:t, endDate:a, opens:"left", ranges: {
                  Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
              }
          }
          , r).on('apply.daterangepicker', function(ev, picker) {
    var start_date = picker.startDate.format('YYYY-MM-DD');
    var end_date = picker.endDate.format('YYYY-MM-DD');
    $.ajax({
type: 'post',

url: "{{url('admin/dashboardfinancesummary')}}",
data: {start_date: start_date,end_date: end_date},
success: function(data) {
$(".todays_collection").html(data.todays_collection);
$(".todays_orders").html(data.todays_orders);
$(".todays_manual_orders").html(data.todays_manual_orders);
$(".todays_manual_orders_collection").html(data.todays_manual_orders_collection);
$(".todays_online_orders_collection").html(data.todays_online_orders_collection);
}
});
}),
          r(t, a, "")
      }
      function r(t, a, r) {
          var o="",
          n="";
          a-t<100||"Today"==r?(o="Today:", n=t.format("MMM D")): "Yesterday"==r?(o="Yesterday:", n=t.format("MMM D")): n=t.format("MMM D")+" - "+a.format("MMM D"), e.find(".m-subheader__daterange-date").html(n), e.find(".m-subheader__daterange-title").html(o)
      }

});
</script>
@endif
@endsection
