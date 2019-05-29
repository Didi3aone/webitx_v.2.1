<?=$ViewHead?>
<body ng-controller="UserRequest">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">   
		<div class="panel panel-default">
        <div class="panel-body">
			<div class="table-responsive">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Email</th>
							<th>Request Type</th>
                            <th>Request Status</th>
                            <th>Privy ID</th>
                            <th>Document</th>
                            <th>Action</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="data in List">
                            <td> {{ $index+1 }} </td>
                            <td> {{ data.UserName }} </td>
                            <td> {{ data.Email }} </td>
                            <!-- <td>
                                <div ng-if="data.Seller == 'requested'">
                                    <a ng-click="acceptSeller(data)" class="tooltipx pointer">
                                        <button class="btn btn-xs btn-success">Submit</button><span>Submit to PrivyId</span>
                                    </a>
                                    <a ng-click="rejectSeller(data.UserId)" class="tooltipx pointer">
                                        <button class="btn btn-xs btn-danger">Reject</button><span>Reject request</span>
                                    </a>
                                </div>
                                <div ng-if="data.Seller == 'rejected'">
                                    Rejected
                                </div>
                                <div ng-if="data.Seller == 'accepted'">
                                    Accepted
                                </div>
                                <div ng-if="data.Seller == 'undefined'">
                                    Un-Requested
                                </div>
                            </td> -->
                            <!-- <td>
                                <div ng-if="data.Buyer == 'requested'">
                                    <a ng-click="acceptBuyer(data)" class="tooltipx pointer">
                                        <button class="btn btn-xs btn-success">Submit</button><span>Submit to PrivyId</span>
                                    </a>
                                    <a ng-click="rejectBuyer(data.UserId)" class="tooltipx pointer">
                                        <button class="btn btn-xs btn-danger">Reject</button><span>Reject request</span>
                                    </a>
                                </div>
                                <div ng-if="data.Buyer == 'undefined'">
                                    Un-Requested
                                </div>
                                <div ng-if="data.Buyer != 'requested' && data.Buyer != 'undefined'">
                                    {{ data.Buyer }}
                            </td> -->
                            <td>
                                <div ng-if="data.ReqType == 'seller' ">
                                    Seller
                                </div>
                                <div ng-if="data.ReqType == 1 ">
                                    Buyer - API
                                </div>
                                <div ng-if="data.ReqType == 2 ">
                                    Buyer - WL
                                </div>
                                <div ng-if="data.ReqType == 3 ">
                                    Buyer - TA
                                </div>

                                <div ng-if="data.ReqType == 'NoReq'">
                                    No Request
                                </div>
                            </td>
                            <td>
                                <div ng-if="data.Status == 1">
                                    Requested
                                </div>
                                <div ng-if="data.Status == 2">
                                    On Progress
                                </div>
                                <div ng-if="data.Status == 3">
                                    Signature Waiting
                                </div>
                                <div ng-if="data.Status == 4">
                                    Signed
                                </div>
                                <div ng-if="data.Status == 'undefined'">
                                    Undefined
                                </div>
                                <div ng-if="data.Status == 5">
                                <a ng-click="chckReject(data.UserId, data.ReqType)" href="#" data-toggle="modal" data-target="#reasonRejectModal" class="tooltipx pointer">Rejected<span>view reason</span></a>
                                </div>
                                <!-- Modal Reason Reject -->
                                <div class="modal fade" id="reasonRejectModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Reason Reject</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p style="font-weight:bold">{{ reasonReject }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div ng-if="data.PrivyId != 'empty' && data.PrivyIdStatus != 'waiting'">
                                    <a ng-click="chckPrivId(data)" href="#" data-toggle="modal" data-target="#privyModal" class="tooltipx pointer">
                                        {{ data.PrivyId }} <span>view detail</span>
                                    </a>
                                    <div class="modal fade" id="privyModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">PrivyId Detail</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <label class="control-label col-sm-3" style="text-align: left;">PrivyId Status</label> 
                                                        <div class=" col-sm-3">
                                                           :&nbsp;&nbsp;{{ datacheck.PrivyIdStatus }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div ng-if="data.PrivyIdStatus == 'waiting'">
                                    waiting
                                </div>
                                <div ng-if="data.PrivyId == 'empty'">
                                    {{ data.PrivyId }}
                                </div>
                            </td>
                            <td>
                                <div>
                                    <a ng-click="chckPrivId(data)" href="#" data-toggle="modal" data-target="#docModal">
                                        view detail
                                    </a>
                                    <div class="modal fade" id="docModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Document List</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Document Name</th>
                                                                <th>Status</th>
                                                                <th>Sign Document</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="doc in datacheck.Document">
                                                                <td>
                                                                    <a href="{{doc.Url}}" target="__blank">{{ doc.Name }}</a>
                                                                </td>
                                                                <td>
                                                                    <!-- <div ng-if="doc.Status == 'undefined'">
                                                                        <a ng-click="submitDoc(doc)" class="tooltipx pointer">
                                                                            <button class="btn btn-sm btn-success">Submit</button><span>Submit to PrivyId</span>
                                                                        </a>
                                                                    </div> -->
                                                                    <div>{{ doc.Status }}</div>
                                                                </td>
                                                                <td class="text-center">

                                                                    <a ng-if="doc.SignUrl != 'empty' && doc.Status == 'in progress'" href="{{doc.SignUrl}}" target="blank__">
                                                                        <button class="btn btn-success btn-xs">Sign</button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button ng-if="datacheck.Status != 5 && datacheck.Status != 4" class="btn btn-sm btn-success" ng-click="submitDocAll(datacheck.Document, datacheck.PrivyId)">Submit all documents</button>
                                                    <button ng-if="loading == false && datacheck.Status != 5 && datacheck.Status != 4" class="btn btn-sm btn-success" ng-click="checkDoc(datacheck)">Update Status</button>
                                                    <button ng-if="loading == true && datacheck.Status != 5 && datacheck.Status != 4" class="btn btn-sm btn-success fa fa-spinner" disabled>Update Status</button>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <a ng-if="data.ReqType != 'NoRequest' && data.Status != 5 && data.PrivyIdStatus == 'empty'" id="accept" ng-click="chckPrivId(data)" href="" class="tooltipx pointer" data-toggle="modal" data-target="#acceptModal">
                                        <button class="btn btn-xs btn-success fa fa-check">
                                            <span>Accept</span>
                                        </button>
                                    </a>
                                    
                                    <a ng-if="data.ReqType != 'NoRequest' && data.Status != 5 && data.Status != 4" ng-click="chckPrivId(data)" href="" class="tooltipx pointer" data-toggle="modal" data-target="#rejectModal">
                                        <button class="btn btn-xs btn-danger fa fa-times">
                                            <span>Reject</span>
                                        </button>
                                    </a>
                                    <a ng-click="chckPrivId(data)" href="" class="tooltipx pointer"  data-toggle="modal" data-target="#detModal">
                                        <button class="btn btn-xs btn-primary fa fa-eye">
                                            <span>View Detail</span>
                                        </button>
                                    </a>
                                </div>

                                <!-- Modal Accept -->
                                <div class="modal fade" id="acceptModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Accept Request?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p style="font-weight:bold">Accept request and submit user's data to Privy ID</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button ng-click="acceptRequest(datacheck)" type="button" class="btn btn-success" data-dismiss="modal">Accept</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Reject -->
                                <div class="modal fade" id="rejectModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Reject Request?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div style="margin:10px">
                                                    <label>Remark&nbsp;:</label>
                                                    <input type="text" class="form-control" id="remarkReject"  placeholder="Input reason of rejection...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button ng-click="rejectRequest(datacheck.UserId, datacheck.ReqType)" type="button" class="btn btn-danger">Reject</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal View Detail -->
                                <div class="modal fade" id="detModal" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">User's Detail</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#personaldata" data-toggle="tab">Personal Data</a>
                                                        </li>
                                                        <li>
                                                            <a ng-click="getDoc(datacheck.UserId)" href="#dokumen" data-toggle="tab">Dokumen</a>
                                                        </li>
                                                        <li>
                                                            <a href="#infomitra" data-toggle="tab">Info Mitra</a>
                                                        </li>
                                                        <li>
                                                            <a href="#kontak" data-toggle="tab">Kontak Perwakilan</a>
                                                        </li>
                                                        <li>
                                                            <a href="#rekening" data-toggle="tab">Rekening Bank</a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content clearfix">

                                                        <div class="tab-pane active" id="personaldata">
                                                            <div style="padding:2%;">
                                                                <h3 style="margin-bottom:10px;">Personal Data</h3>
                                                            </div>
                                                            <div class="col-md-8" >
                                                                    
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Username</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="username" value="{{datacheck.UserName}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">First Name</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="firstname" value="{{datacheck.FirstName}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Last Name</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="lastname" value="{{datacheck.LastName}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Gender</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-user"></i>
                                                                                </span>
                                                                                <input class="form-control" name="gender" value="{{datacheck.Gender}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Birth Date</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="birthdate" value="{{datacheck.BirthDate}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Email</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-envelope"></i>
                                                                                </span>
                                                                                <input type="email" class="form-control" name="email" value="{{datacheck.Email}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">Phone</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-phone"></i>
                                                                                </span>
                                                                                <input type="tel" class="form-control" name="phone" value="{{datacheck.Phone}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-2" style="text-align: left;">NIK</label> 
                                                                            <div class="input-group col-sm-10">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="nik" value="{{datacheck.Nik}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                            </div>
                                                                        
                                                            <div class="col-md-4 text-center">
                                                                
                                                                <div class="img-thumbnail text-center">
                                                                    <img height="200" width="200" src="{{datacheck.Img}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="dokumen">
                                                            <h3 style="padding:2%;">Dokumen Upload</h3>
                                                            <form class="form-horizontal">
                                                                
                                                                <div class="col-md-12">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>File</th>
                                                                                <!-- <th>Status</th>
                                                                                <th>Action</th> -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Scan KTP</td>
                                                                                <td>
                                                                                    <a href="{{docList.ktp.url}}" target="__blank">{{docList.ktp.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Scan Selfie KTP</td>
                                                                                <td>
                                                                                    <a href="{{docList.selfie.url}}" target="__blank">{{docList.selfie.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Scan NPWP</td>
                                                                                <td>
                                                                                    <a href="{{docList.npwp.url}}" target="__blank">{{docList.npwp.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Scan SIUP/TDP</td>
                                                                                <td>
                                                                                    <a href="{{docList.siup.url}}" target="__blank">{{docList.siup.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Scan Akta Perusahaan</td>
                                                                                <td>
                                                                                    <a href="{{docList.akta.url}}" target="__blank">{{docList.akta.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Scan Surat Kuasa (bila diwakilkan)</td>
                                                                                <td>
                                                                                    <a href="{{docList.sk.url}}" target="__blank">{{docList.sk.name}}</a>
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="tab-pane" id="infomitra">
                                                            <div style="padding:2%;">
                                                                <h3 style="margin-bottom:10px;">Informasi Mitra</h3>
                                                            </div>
                                                            <form class="form-horizontal">
                                                            <div class="col-md-6" style="padding:2%;">
                                                                    
                                                                    
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Nama Brand / Merk</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-qrcode"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" id="brand" name="brand" value="{{datacheck.Company.Brand}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Nama Perusahaan</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-briefcase"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="coname" value="{{datacheck.Company.Name}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Jenis Usaha</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-briefcase"></i>
                                                                                </span>
                                                                                <input class="form-control" value="" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Nama Pemilik Usaha</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="owner" value="{{datacheck.Company.Owner}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">No Telepon</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-phone"></i>
                                                                                </span>
                                                                                <input type="tel" class="form-control" name="phone" value="{{datacheck.Company.Phone}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">No HP</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-mobile"></i>
                                                                                </span>
                                                                                <input type="tel" class="form-control" name="mobile" value="{{datacheck.Company.Mobile}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Alamat Perusahaan</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-home"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="address" value="{{datacheck.Company.Address}}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Kecamatan</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-home"></i>
                                                                                </span>
                                                                                <select class="form-control" name="subdistrict" value="{{datacheck.Company.District}}" disabled>
                                                                                
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-sm-4" style="text-align: left;">Provinsi</label> 
                                                                            <div class="input-group col-sm-8">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-home"></i>
                                                                                </span>
                                                                                <select class="form-control" name="province" value="{{datacheck.Company.Province}}" disabled>
                                                                                
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                        
                                                            </div>
                                                                        
                                                            <div class="col-md-6 text-center"style="padding:2%;">
                                                                <!-- <div class="form-group"> -->
                                                                <div class="img-thumbnail text-center" style="margin-bottom:35px;">
                                                                        <img src="{{data.Company.Logo}}" height="200" width="200">
                                                                </div>
                                                                <!-- </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-4" style="text-align: left;">Email</label> 
                                                                    <div class="input-group col-sm-8">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </span>
                                                                        <input type="email" class="form-control" name="email" value="{{datacheck.Company.Email}}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-4" style="text-align: left;">Website</label> 
                                                                    <div class="input-group col-sm-8">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-globe"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="website" value="{{datacheck.Company.Website}}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-4" style="text-align: left;">Kabupaten / Kota</label> 
                                                                    <div ng-app="myApp" ngController="myCtrl" class="input-group col-sm-8">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-home"></i>
                                                                        </span>
                                                                        <select class="form-control" name="city" value="{{datacheck.Company.City}}" disabled>
                                                                        
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-4" style="text-align: left;">Kode Pos</label> 
                                                                    <div class="input-group col-sm-8">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-envelope-o"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="postal" value="{{datacheck.Company.Postal}}" disabled>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="tab-pane" id="kontak">
                                                            <div style="padding:2%;">
                                                                <h3 style="margin-bottom:10px;">Kontak Perwakilan Perusahaan</h3>
                                                            </div>
                                                            <form class="form-horizontal">
                                                                <div class="col-md-12">    
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Kontak Umum</th>
                                                                                <th>Kontak Operasional</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group" style="margin-right:5%;">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">Nama</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="glyphicon glyphicon-user"></i>
                                                                                            </span>
                                                                                            <input type="text" class="form-control" name="name" value="{{datacheck.Contact.Name}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">Nama</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="glyphicon glyphicon-user"></i>
                                                                                            </span>
                                                                                            <input type="text" class="form-control" name="nameops" value="{{datacheck.Contact.NameOps}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group" style="margin-right:5%;">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">Email</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-envelope"></i>
                                                                                            </span>
                                                                                            <input type="email" class="form-control" name="email" value="{{datacheck.Contact.Email}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">Email</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-envelope"></i>
                                                                                            </span>
                                                                                            <input type="email" class="form-control" name="emailops" value="{{datacheck.Contact.EmailOps}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group" style="margin-right:5%;">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">No. Tlp</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-phone"></i>
                                                                                            </span>
                                                                                            <input type="tel" class="form-control" name="phone" value="{{datacheck.Contact.Phone}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">No. Tlp</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-phone"></i>
                                                                                            </span>
                                                                                            <input type="tel" class="form-control" name="phoneops" value="{{datacheck.Contact.PhoneOps}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group" style="margin-right:5%;">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">No. HP</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-mobile"></i>
                                                                                            </span>
                                                                                            <input type="tel" class="form-control" name="mobile" value="{{datacheck.Contact.Mobile}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-sm-2" style="text-align: left;">No. HP</label> 
                                                                                        <div class="input-group col-sm-10">
                                                                                            <span class="input-group-addon">
                                                                                                <i class="fa fa-mobile"></i>
                                                                                            </span>
                                                                                            <input type="tel" class="form-control" name="mobileops" value="{{datacheck.Contact.MobileOps}}" disabled>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </form>
                                                            
                                                        </div>

                                                        <div class="tab-pane" id="rekening">
                                                            <div style="padding:2%;">
                                                                <h3 style="margin-bottom:10px;">Kontak Perwakilan Perusahaan</h3>
                                                            </div>
                                                            <form id="rekfrm" class="form-horizontal" style="padding-left:2%;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2" style="text-align: left;">Nama Bank</label> 
                                                                    <div class="input-group col-sm-4">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-briefcase"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="bankname" value="{{datacheck.Bank.BankName}}" disabled>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2" style="text-align: left;">Nomor Rekening</label> 
                                                                    <div class="input-group col-sm-4">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-credit-card"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="bankaccount" value="{{datacheck.Bank.Account}}" disabled>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2" style="text-align: left;">Atas Nama</label> 
                                                                    <div class="input-group col-sm-4">
                                                                        <span class="input-group-addon">
                                                                            <i class="glyphicon glyphicon-user"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="bankuser" value="{{datacheck.Bank.BankUser}}" disabled>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>



                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- <td> {{ data.Group.name }} </td> -->
							<!-- <td class="table-action">
			                    <a ng-click="GoToDetailUser(data.UserId)" class="tooltipx pointer">
                                    <i class="fa fa-pencil"></i><span>Edit User</span>
			                    </a>
                                <a ng-if="Member.id != data.UserId" ng-click="DeleteUser(data.UserId)" class="tooltipx pointer">
                                    <i class="fa fa-trash-o"></i><span>Delete User</span>
                                </a>
			                </td> -->
						</tr>
					</tbody>
				</table> 
			</div>
		</div>
		</div>

      <?=$ViewCopyRight?>
    </div>

  </div><!-- mainpanel -->

</section>

<?=$ViewFooter?>

<script type="text/javascript">
  app.controller('UserRequest', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
    	$scope.AngularService   = AngularService;
    	$scope.List             = <?=json_encode($List)?>;
        $scope.Member           = <?=json_encode($Member)?>;
        $scope.loading          = false;
        console.log($scope.List);
    };
    (function () {
        // FlightSearch.startLoadingPage("Your transaction is being processed. Please be patient");
        $scope.init();
        $('#ParentUsers').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenRequestUser').addClass('active');

        getDatatablesContent();

    })();

    function getDatatablesContent(){
        // $scope.columnDefs = [];

        // $scope.columnDefs.push(
        //     {className: "text-left",orderable: true,targets: [0], visible: true}, // No
        //     {className: "text-left",orderable: true,targets: [1], visible: true}, //  Discount
        //     {className: "text-left",orderable: true,targets: [2], visible: true}, // QTY
        //     {className: "text-left",orderable: true,targets: [3], visible: true},   //  Start date
        //     {className: "text-left",orderable: true,targets: [4], visible: true},   // End date
        //     {className: "text-left",orderable: true,targets: [5], visible: true}, // Action
        // );

        setTimeout(function() {
            var table = $('#datatable').DataTable({
                "sPaginationType": "full_numbers",
                destroy: true,
                "lengthChange": false,
                "aaSorting": [],
                buttons: {
                    buttons: []
                },
                columnDefs: $scope.columnDefs
            });
        }, 300);
    };
    
    // $scope.GoToAddNewUser = function() {
    //     window.location.href = adminUrl+'users/add';
    // };

    // $scope.GoToDetailUser = function(UserId) {
    //     window.location.href = adminUrl+'users/add/'+UserId;
    // };

    $scope.chckPrivId = function(data){

        $scope.datacheck = data;
    }

    $scope.chckReject = function(userid, reqtype){
        $http.post(adminUrl+'crud_user/getReasonReject', {'UserId' : userid, 'ReqType' : reqtype}).then(function(resp){
            $scope.reasonReject = resp.data.reason_reject;
        })
    }

    $scope.getDoc = function(UserId){
        $http.post(adminUrl+'crud_user/getDocument', {'UserId' : UserId}).then(function(resp){
            $scope.docList = resp.data;
            console.log(resp.data);
        })
    }

    function isSubmitted(arr){
            var res = true;
            for(var key in arr){
                console.log(arr[key].Status)
                if(arr[key].Status == 'new'){
                    res = false
                }
            }
            return res;
        }
    
    $scope.submitDocAll = function(doc, privyid) {
        console.log(privyid);
        if(privyid == 'empty' ){
            alert('Privy ID not available!')
        }else if(isSubmitted(doc)){
            alert('All documents were submitted')
        }else{
        var c = confirm("Are you sure you want to submit all documents?");
          if(c) {
            AngularService.startLoadingPage();
            $http.post(
                adminUrl+'crud_user/submitAllDokumen',
                doc
            ).then(function successCallback(resp) {
                console.log(resp);
                AngularService.stopLoadingPage();
                if (resp.data['StatusResponse'] == 0) {
                    AngularService.ErrorResponse(resp.data['Message']);
                }
                else if (resp.data['StatusResponse'] == 1) {
                    AngularService.SuccessResponse();
                }
            }, function errorCallback(err) {
                console.log(err);
                AngularService.ErrorResponse(err);
                });
            }
        }
    };

    $scope.checkDoc = function(data){

        //check if there're submitted doc
        // function isSubmitted(arr){
        //     var res = false;
        //     for(var key in arr){
        //         console.log(arr[key].Status)
        //         if(arr[key].Status != 'undefined'){
        //             res = true
        //         }
        //     }
        //     return res;
        // }
        var userData = data;

        if(!isSubmitted(userData.Document)){
            alert('No documents were submitted yet!')
        }else{
        $scope.loading = true;
        AngularService.startLoadingPage();
        $http.post(adminUrl+'crud_user/checkDokumenStatus', userData).then(function successCallback(resp){
                console.log(resp);
                $scope.loading = false;
                AngularService.stopLoadingPage();
        }, function errorCallback(err) {
                console.log(err);
        });
        // location.reload();
        }
    }

    $scope.acceptRequest = function(UserData){
        AngularService.startLoadingPage();
        $http.post(
                adminUrl+'crud_user/acceptRequest',
                UserData
            ).then(function successCallback(resp) {
                console.log(resp)
                AngularService.stopLoadingPage();
                if (resp.data['StatusResponse'] == 0) {
                    AngularService.ErrorResponse(resp.data['Message']);
                }
                else if (resp.data['StatusResponse'] == 1) {
                    AngularService.SuccessResponse();
                }
            }, function errorCallback(err) {
                console.log(err);
                AngularService.ErrorResponse(err);
            });
    }

    $scope.rejectRequest = function(UserId, ReqType){
        var Remark = document.getElementById('remarkReject').value
        AngularService.startLoadingPage();
        $http.post(
                adminUrl+'crud_user/rejectRequest',
                {'UserId' : UserId, 'ReqType' : ReqType, 'Remark' : Remark}
            ).then(function successCallback(resp) {
                console.log(resp);
                AngularService.stopLoadingPage();
                if (resp.data['StatusResponse'] == 0) {
                    AngularService.ErrorResponse(resp.data['errors']['messages']);
                }
                else if (resp.data['StatusResponse'] == 1) {
                    AngularService.SuccessResponse();
                }
            }, function errorCallback(err) {
                console.log(err);
                AngularService.ErrorResponse(err);
            });
    }

    // $scope.acceptSeller = function(user) {
    //     user['type'] = 'seller'
    //     var c = confirm("Are you sure you want to accept this request?");
    //       if(c) {
    //         AngularService.startLoadingPage();
    //         $http.post(
    //             adminUrl+'crud_user/acceptSeller',
    //             user
    //         ).then(function successCallback(resp) {
    //             console.log(resp);
    //             AngularService.stopLoadingPage();
    //             if (resp.data['StatusResponse'] == 0) {
    //                 AngularService.ErrorResponse(resp.data['Message']);
    //             }
    //             else if (resp.data['StatusResponse'] == 1) {
    //                 AngularService.SuccessResponse();
    //             }
    //         }, function errorCallback(err) {
    //             console.log(err);
    //             AngularService.ErrorResponse(err);
    //         });
    //     }
    // };

    // $scope.rejectSeller = function(UserId) {
    //     var c = confirm("Are you sure you want to reject this request?");
    //       if(c) {
    //         AngularService.startLoadingPage();
    //         $http.post(
    //             adminUrl+'crud_user/rejectSeller',
    //             {'UserId': UserId}
    //         ).then(function successCallback(resp) {
    //             console.log(resp);
    //             AngularService.stopLoadingPage();
    //             if (resp.data['StatusResponse'] == 0) {
    //                 AngularService.ErrorResponse(resp.data['Message']);
    //             }
    //             else if (resp.data['StatusResponse'] == 1) {
    //                 AngularService.SuccessResponse();
    //             }
    //         }, function errorCallback(err) {
    //             console.log(err);
    //             AngularService.ErrorResponse(err);
    //         });
    //     }
    // };
    
    // $scope.acceptBuyer = function(user) {
    //     user['type'] = 'buyer'
    //     var c = confirm("Are you sure you want to accept this request?");

    //       if(c) {
    //         AngularService.startLoadingPage();
    //         $http.post(
    //             adminUrl+'crud_user/acceptBuyer',
    //             user
    //         ).then(function successCallback(resp) {
    //             console.log(resp);
    //             AngularService.stopLoadingPage();
    //             if (resp.data['StatusResponse'] == 0) {
    //                 AngularService.ErrorResponse(resp.data['Message']);
    //             }
    //             else if (resp.data['StatusResponse'] == 1) {
    //                 AngularService.SuccessResponse();
    //             }
    //         }, function errorCallback(err) {
    //             console.log(err);
    //             AngularService.ErrorResponse(err);
    //         });
    //     }
    // };

    // $scope.rejectBuyer = function(UserId) {
    //     var c = confirm("Are you sure you want to reject this request?");
    //       if(c) {
    //         AngularService.startLoadingPage();
    //         $http.post(
    //             adminUrl+'crud_user/rejectBuyer',
    //             {'UserId': UserId}
    //         ).then(function successCallback(resp) {
    //             console.log(resp);
    //             AngularService.stopLoadingPage();
    //             if (resp.data['StatusResponse'] == 0) {
    //                 AngularService.ErrorResponse(resp.data['Message']);
    //             }
    //             else if (resp.data['StatusResponse'] == 1) {
    //                 AngularService.SuccessResponse();
    //             }
    //         }, function errorCallback(err) {
    //             console.log(err);
    //             AngularService.ErrorResponse(err);
    //         });
    //     }
    // };

    // $scope.submitDoc = function(doc) {
    //     var c = confirm("Are you sure you want to submit this document?");
    //       if(c) {
    //         AngularService.startLoadingPage();
    //         $http.post(
    //             adminUrl+'crud_user/submitDokumen',
    //             doc
    //         ).then(function successCallback(resp) {
    //             console.log(resp);
    //             AngularService.stopLoadingPage();
    //             if (resp.data['StatusResponse'] == 0) {
    //                 AngularService.ErrorResponse(resp.data['Message']);
    //             }
    //             else if (resp.data['StatusResponse'] == 1) {
    //                 AngularService.SuccessResponse();
    //             }
    //         }, function errorCallback(err) {
    //             console.log(err);
    //             AngularService.ErrorResponse(err);
    //         });
    //     }
    // };


  }); // --- end angular controller --- //
</script>

</body>
</html>