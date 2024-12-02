@php

use App\Http\Models\backend\BackendMenubar;
use App\Http\Models\backend\BackendMenubarSublink;
use App\Http\Models\backend\AdminUsers;
use App\Http\Models\backend\UserMaster;


$user_id = Auth()->guard('admin')->user()->id;
$user_master = UserMaster::where('user_id',$user_id)->first();

$menu_ids=explode(",",$user_master->menu_master);
$submenu_ids=explode(",",$user_master->submenu_master);
$sub_submenu_ids=explode(",",$user_master->sub_sub_master);
$child_sub_submenu_ids=explode(",",$user_master->child_sub_sub_master);
$backend_menubar = DB::select("SELECT * FROM  backend_menubar_sublink bms, backend_menubar bm where   bms.menu_id=bm.menu_id and bm.visibility=1 group by bm.menu_id");
@endphp
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-aside-left  m-aside-left--skin-dark ">
  <!-- BEGIN: Aside Menu -->
<div
id="m_ver_menu"
class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
data-menu-vertical="true"
m-menu-scrollable="1" m-menu-dropdown-timeout="500"
>
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">


      @php foreach($backend_menubar as $menu){
      				if(in_array($menu->menu_id,$menu_ids)){

                  $backend_menubar_sublink = BackendMenubarSublink::where([['menu_id',$menu->menu_id],['visibility',1],['sub_parent_id',NULL]])->get();
                  	if($backend_menubar_sublink){
                      @endphp
                      <li class="m-menu__section m-menu__section--first">
                        <h4 class="m-menu__section-text">
                          {{$menu->menu_name}}
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                      </li>
                              @php foreach($backend_menubar_sublink as $submenu){
                              if(in_array($submenu->submenu_id,$submenu_ids)){
                              $sub_sublink = DB::select("SELECT * FROM backend_menubar_sublink where sub_parent_id=$submenu->submenu_id");
                              if($sub_sublink){
                              @endphp
                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                      <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-user"></i>
                        <span class="m-menu__link-text">
                          {{$submenu->submenu_name}}
                        </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                      </a>
                      <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            @php $child_submenu = DB::select("SELECT * FROM backend_menubar_sublink where sub_parent_id=$submenu->submenu_id");
                				foreach($child_submenu as $child_menu){
      							 if(in_array($child_menu->submenu_id,$sub_submenu_ids)){
                       @endphp
                     <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                       <a  href="{{ route($child_menu->submenu_controller_name) }}" class="m-menu__link ">
                         <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                           <span></span>
                         </i>
                         <span class="m-menu__link-text">
                           {{$child_menu->submenu_name}}
                         </span>
                       </a>
                     </li>
                   @php }
                  }
                  @endphp
                  </ul>
                </div>
              </li>
                    @php }else{
                      $route="/";
                      if($submenu->submenu_controller_name != "#"){
                        $route = "$submenu->submenu_controller_name";
                      }

                      @endphp
                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                      <a  href="{{ route($route) }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-open-box"></i>
                        <span class="m-menu__link-text">
                          {{$submenu->submenu_name}}
                        </span>
                      </a>
                    </li>
                  @php }
                 }
               }
               @endphp
                      @php }else{ @endphp
                          <li class="m-menu__section m-menu__section--first">
                            <h4 class="m-menu__section-text">
                              {{$menu->menu_name}}
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                          </li>
                      @php }
                     }
                   }
                   @endphp
                   </ul>
  </div>
  <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
