<div class="headerbar">
  <a class="menutoggle"><i class="fa fa-bars"></i></a>
  <div class="header-right">
    <ul class="headermenu">
      <li>  
        <div id="iconnotif" class="btn-group">
          <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown" id="getComment">
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <span class="badge" id="jumlah"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-head pull-right">
            <h5 class="title" id="jumlahtxt">You Have 0 New Notifications</h5>
            <ul class="dropdown-list gen-list">
                <span id="notifi"></span>
            </ul>
          </div>
        </div>
      </li>

      <!-- <li>
        <div id="iconmessage" class="btn-group">
          <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown" id="getInquiry">
            <i class="glyphicon glyphicon-list"></i>
            <span class="badge" id="jumlah-inquiry"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-head pull-right">
            <h5 class="title" id="jumlahtxt-inquiry">You Have 0 New Inquiry</h5>
            <ul class="dropdown-list gen-list">
              <span id="notifi-inquiry"></span>
            </ul>
          </div>
        </div>
      </li>
      <li>
        <div class="btn-group">
          <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown" id="getCareer">
            <i class="glyphicon glyphicon-briefcase"></i>
            <span class="badge" id="jumlah-career"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-head pull-right">
            <h5 class="title" id="jumlahtxt-career">You Have 0 New Career Apply</h5>
            <ul class="dropdown-list gen-list">
              <span id="notifi-career"></span>
            </ul>
          </div>
        </div>
      </li> -->

    </ul>
  </div><!-- header-right -->
</div><!-- headerbar -->

<div class="pageheader cs_df">
  <h2><i class="fa <?=$FaName?>"></i> <?=$LeftMenuTitle?> </h2>
    <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">

      <?php
        foreach ($RightMenuTitle as $key => $value) {
          if ($value['isUrl']) { 
            $RightMenuTitleUrl = base_url("adminpanel/".$value['Url']);
            echo "<li class=''><a href='".$RightMenuTitleUrl."'>".$value['Name']."</a></li>";
          }
          else {
            echo "<li class='active'>".$value['Name']."</li>";
          }
        }
      ?>

    </ol>
  </div>
</div>