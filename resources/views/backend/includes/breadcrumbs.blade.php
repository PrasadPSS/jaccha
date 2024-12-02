<ol class="breadcrumb">
 <li>
     <i class="fa fa-home"></i>
     <a href="{{url('/')}}">HOME</a> >
 </li>
<?php $link = "" ?>
@for($i = 1; $i <= count(Request::segments()); $i++)
  @if($i < count(Request::segments()) & $i > 0)
  <?php $link .= "/" . Request::segment($i); ?>
  <a href="<?=url('/'). $link ?>">&nbsp;{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a> &nbsp;> 
  @else &nbsp;{{ucwords(str_replace('-',' ',Request::segment($i)))}}
  @endif
@endfor
</ol>
