<div class="leftpanel">
    <div class="logopanel text-center">
        <h1>
          <img ng-click="AngularService.GoToDashboard()" src="" class="pointer" style="max-width:155px;max-height: 55px; display: inline;">
        </h1>
    </div><!-- logopanel -->
    <div class="leftpanelinner cs_df">    
      <div class="visible-xs hidden-sm hidden-md hidden-lg">   
          <div class="media userlogged">
          </div>
      </div>
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li id="ParentDashboard">
          <a href="<?=base_url('adminpanel/dashboard')?>/">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <!-- // ------------------------------------ Pages ------------------------------------ // -->
        <li  id="ParentPages"class="nav-parent"><a href="javascript:;"><i class="fa fa-file-text"></i> <span>Pages</span></a>
          <ul class="children" style="">
            <li id='ChildrenPages'><a href="<?=base_url('adminpanel/pages')?>"><i class="fa fa-caret-right"></i> All Pages</a></li>
          </ul>
        </li>
        <!-- // ------------------------------------ End Pages ------------------------------------ // -->

        <!-- // ------------------------------------ Manages ------------------------------------ // -->
         <!-- ng-class="{'nav-parent active nav-active': activeParentMenu('manages'), 'nav-parent': !activeParentMenu('manages')}" -->
        <li id="ParentManages" class="nav-parent" >
          <a href="javascript:;"><i class="fa fa-edit"></i> <span>Manages</span></a>
          <ul class="children">
            <li id='ChildrenContactUs'><a href="<?=base_url('adminpanel/manages/contactUs')?>"><i class="fa fa-caret-right"></i> Manage Contact Us</a></li>
            <!-- <li id='ChildrenAirline'><a href="<?=base_url('adminpanel/manages/airlines')?>"><i class="fa fa-caret-right"></i> Manage Airline</a></li> -->
            <!-- <li id='ChildrenDiscounts'><a href="<?=base_url('adminpanel/manages/discounts')?>"><i class="fa fa-caret-right"></i> Manage Discount</a></li> -->
            <!-- <li id='ChildrenBanks'><a href="<?=base_url('adminpanel/manages/banks')?>"><i class="fa fa-caret-right"></i> Manage Bank</a></li> -->
            <!-- <li id='ChildrenCareers'><a href="<?=base_url('adminpanel/manages/careers')?>"><i class="fa fa-caret-right"></i> Manage Career</a></li> -->
            <!-- <li id='ChildrenCareersApply'><a href="<?=base_url('adminpanel/manages/careersApply')?>"><i class="fa fa-caret-right"></i> Manage Career(Apply)</a></li> -->
            <!-- <li id='ChildrenMembers'><a href="<?=base_url('adminpanel/manages/members')?>"><i class="fa fa-caret-right"></i> Manage Member</a></li> -->
            <!-- <li id='ChildrenSugestionPlace'><a href="<?=base_url('adminpanel/manages/sugestionPlace')?>"><i class="fa fa-caret-right"></i> Manage Sugestion Place</a></li> -->
            <!-- <li id='ChildrenTestimoni'><a href="<?=base_url('adminpanel/manages/testimoni')?>"><i class="fa fa-caret-right"></i> Manage Testimoni</a></li> -->

            <!-- <?php //if ($IsServiceHotel) { ?>
              <li id='ChildrenTransactions'><a href="<?=base_url('adminpanel/manages/transactionsFlight')?>"><i class="fa fa-caret-right"></i> Manage Transaction Flight</a></li>
            <?php //} ?> -->

            <!-- <?php //if ($IsServiceHotel) { ?>
              <li id='ChildrenTransactionsHotel'><a href="<?=base_url('adminpanel/manages/transactionsHotel')?>"><i class="fa fa-caret-right"></i> Manage Transaction Hotel</a></li>  
            <?php //} ?> -->

            <!-- <li id='ChildrenUmroh'><a href="<?=base_url('adminpanel/manages/umroh')?>"><i class="fa fa-caret-right"></i> Manage Package Umroh</a></li> -->
            <!-- <li id='ChildrenAirports'>
              <a href="<?=base_url('adminpanel/manages/airports')?>"><i class="fa fa-caret-right"></i> Manage Airport</a>
            </li> -->
            <!-- <li id='ChildrenItinerary'>
              <a href="<?=base_url('adminpanel/manages/itinerary')?>"><i class="fa fa-caret-right"></i> Manage Itinerary</a>
            </li> -->
          </ul>
        </li>
        <!-- // ------------------------------------ End Manages ------------------------------------ // -->

        <!-- // ------------------------------------ Users ------------------------------------ // -->
        <li id="ParentUsers" class=" nav-parent"><a href="javascript:;"><i class="fa fa-users"></i> <span>Users</span></a>
          <ul class="children" style="">
            <li id='ChildrenAllUser' class=""><a href="<?=base_url('adminpanel/users')?>"><i class="fa fa-caret-right"></i> All Users</a></li>
            <li id='ChildrenAddUser' class=""><a href="<?=base_url('adminpanel/users/add')?>"><i class="fa fa-caret-right"></i> Add User</a></li>
            <li id='ChildrenRequestUser' class=""><a href="<?=base_url('adminpanel/users/requests')?>"><i class="fa fa-caret-right"></i> Request</a></li>
            <!-- <li id='ChildrenProfileUser' class=""><a href="<?=base_url('adminpanel/profile')?>"><i class="fa fa-caret-right"></i> Your Profile</a></li> -->
          </ul>
        </li>
        <!-- // ------------------------------------ End Users ------------------------------------ // -->

        <!-- // ------------------------------------ Settings ------------------------------------ // -->
        <li id="ParentSettings" class=" nav-parent"><a href="javascript:;"><i class="fa fa-wrench"></i> <span>Settings</span></a>
          <ul class="children" style="">
            <li id='ChildrenGeneral' class=""><a href="<?=base_url('adminpanel/settings/general')?>"><i class="fa fa-caret-right"></i> General</a></li>
            <!-- <li id='ChildrenBooking' class=""><a href="<?=base_url('adminpanel/settings/booking')?>"><i class="fa fa-caret-right"></i> Booking</a></li> -->
            <!-- <li id='ChildrenOpsitools' class=""><a href="<?=base_url('adminpanel/settings/opsitools')?>"><i class="fa fa-caret-right"></i> Opsitools </a></li> -->
            <!-- <li id='ChildrenEmail' class=""><a href="<?=base_url('adminpanel/settings/email')?>"><i class="fa fa-caret-right"></i> Email</a></li> -->

            <!-- <?php //if ($FaspayCheck) { ?>
            <li id='ChildrenFaspay'class="">
              <a href="<?=base_url('adminpanel/settings/faspay')?>"><i class="fa fa-caret-right"></i> Faspay</a>
            </li>
            <?php //} if($MidtransCheck) { ?>
            <li id='ChildrenMidtrans'class="">
              <a href="<?=base_url('adminpanel/settings/midtrans')?>"><i class="fa fa-caret-right"></i> Midtrans</a>
            </li>
          <?php //} ?> -->
          </ul>
        </li>
        <!-- // ------------------------------------ End Settings ------------------------------------ // -->

        <li>
          <a href="<?=base_url('adminpanel/login/logout')?>">
            <i class="fa fa-lock"></i>
            <span>Log Out 
              <strong style="margin-left:5px;">
                (<?=$this->ion_auth->user()->row()->first_name?>)
              </strong>
            </span>
          </a>
        </li>


      </ul>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->