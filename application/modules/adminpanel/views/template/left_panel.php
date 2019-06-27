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
                    <li id='ChildrenContactUs'><a href="<?=base_url('adminpanel/manages/contactUs')?>">
                        <i class="fa fa-caret-right"></i> Manage Contact Us</a>
                    </li>
                    <li id='ChildrenArticle'><a href="<?=base_url('adminpanel/manages/article')?>">
                        <i class="fa fa-caret-right"></i> Manage Article</a>
                    </li>
                </ul>
            </li>
            <!-- // ------------------------------------ End Manages ------------------------------------ // -->

            <!-- // ------------------------------------ Users ------------------------------------ // -->
            <li id="ParentUsers" class=" nav-parent"><a href="javascript:;"><i class="fa fa-users"></i> <span>Users</span></a>
                <ul class="children" style="">
                    <li id='ChildrenAllUser' class=""><a href="<?=base_url('adminpanel/users')?>"><i class="fa fa-caret-right"></i> All Users</a></li>
                    <li id='ChildrenAddUser' class=""><a href="<?=base_url('adminpanel/users/add')?>"><i class="fa fa-caret-right"></i> Add User</a></li>
                    <li id='ChildrenRequestUser' class=""><a href="<?=base_url('adminpanel/users/requests')?>"><i class="fa fa-caret-right"></i> Request</a></li>
                </ul>
            </li>
            <!-- // ------------------------------------ End Users ------------------------------------ // -->
            <!-- // ------------------------------------ Settings ------------------------------------ // -->
            <li id="ParentSettings" class=" nav-parent"><a href="javascript:;"><i class="fa fa-wrench"></i> <span>Settings</span></a>
                <ul class="children" style="">
                    <li id='ChildrenGeneral' class=""><a href="<?=base_url('adminpanel/settings/general')?>"><i class="fa fa-caret-right"></i> General</a></li>
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