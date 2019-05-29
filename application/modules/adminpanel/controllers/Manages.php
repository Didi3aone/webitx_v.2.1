<?php

class Manages extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 0]);
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		redirect(base_url('adminpanel/login/logout'));
        $this->load->model('manages/m_manages');
    }

    // public function addDiscount() {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Add New Discount',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/discounts'],
    //             ['isUrl' => FALSE,'Name' => 'Add New Discount'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);
    //     $data['CheckDiscount'] = 0;
    //     $data['DiscountData'] = [];
    //     $data['DiscountType'] = 1;
    //     $this->load->view('adminpanel/manages/discounts/add', $data);
    // }

    // public function detailDiscount($DiscountId) {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Edit Discount',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/discounts'],
    //             ['isUrl' => FALSE,'Name' => 'Edit Discount'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);
    //     $this->load->model('m_update');
    //     $this->m_update->CheckExpiredDiscount();

    //     $data['DiscountData']         = $this->m_manages->getDiscountById($DiscountId);
    //     if (!$data['DiscountData']) {
    //         die('No Discount Data');
    //     }

    //     $data['DiscountData']->StartTime = date("H:i",strtotime($data['DiscountData']->StartDate));
    //     $data['DiscountData']->EndTime = date("H:i",strtotime($data['DiscountData']->EndDate));
    //     $data['DiscountData']->StartDate = date("m/d/Y",strtotime($data['DiscountData']->StartDate));
    //     $data['DiscountData']->EndDate = date("m/d/Y",strtotime($data['DiscountData']->EndDate));
    //     $data['DiscountData']->IsPublish = $data['DiscountData']->IsPublish==1 ? true : false;

    //     $data['CheckDiscount'] = 1;
    //     $data['DiscountType'] = $data['DiscountData']->DiscountType;

    //     $this->load->view('adminpanel/manages/discounts/add', $data);
    // }

    // public function discounts()
    // {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Discount',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/discounts'],
    //             ['isUrl' => FALSE,'Name' => 'Discount'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $this->load->model('m_update');
    //     $this->m_update->CheckExpiredDiscount();

    //     $Discounts = $this->m_manages->getListDiscounts();
    //     $data['List'] = [];
    //     if ($Discounts) {
    //         foreach ($Discounts as $key => $value) {
    //             $DiscountArr = array_merge( [], (Array) $value );
    //             $DiscountArr['TotalDiscount'] = $value->DiscountType == 1 ? number_format($value->TotalDiscount, 0, '', ',') : $value->TotalDiscount . ' %';  
    //             $data['List'][] = $DiscountArr;                
    //         }
    //     }
    //     $this->load->view('adminpanel/manages/discounts/all', $data);
    // }

    // public function banks()
    // {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Bank',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/banks'],
    //             ['isUrl' => FALSE,'Name' => 'Bank'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $Banks = $this->m_manages->getListBanks();
    //     $data['List'] = [];
    //     if ($Banks) {
    //         foreach ($Banks as $key => $value) {
    //             $BankArr = array_merge( [], (Array) $value );
    //             $data['List'][] = $BankArr;                
    //         }
    //     }

    //     $this->load->view('adminpanel/manages/banks/all', $data);
    // }

    // public function addBank() {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Add Bank',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/banks'],
    //             ['isUrl' => FALSE,'Name' => 'Add Bank'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $data['BankData']           = [];
    //     $data['CheckBank']      = 0;
    //     $this->load->view('adminpanel/manages/banks/add', $data);
    // }

    // public function itinerary() {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Manage Itinerary',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/itinerary'],
    //             ['isUrl' => FALSE,'Name' => 'Manage Itinerary'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $SettingItinerary    = $this->m_get->getRowDynamic([
    //       'select'    => 'id, text, image_footer',
    //       'from'      => 'v2_master_itinerary',
    //       'where'     => [
    //           'id' => 1
    //       ]
    //     ]);

    //     $SettingItineraryText = json_decode($SettingItinerary->text);
    //     $data['SettingItinerary'] = [
    //         'ImageFooter'   => $SettingItinerary->image_footer,
    //         'Text'          => json_decode($SettingItinerary->text),
    //         'id'            => 1
    //     ];

    //     $this->load->view('adminpanel/manages/itinerary/edit', $data);
    // }

    // public function airports() {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Manage Airport',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/airports'],
    //             ['isUrl' => FALSE,'Name' => 'Manage Airport'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $ManageAirport         = $this->m_get->getRowDynamic([
    //         'select'    => 'msa_id, msa_type',
    //         'from'      => 'v2_master_setting_airport',
    //         'where'     => [
    //             'msa_id' => 1
    //         ]
    //     ]);

    //     $data['ManageAirport'] = $ManageAirport;

    //     $this->load->view('adminpanel/manages/airport/edit', $data);
    // }

    // public function detailBank($BankId) {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Edit Bank',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/banks'],
    //             ['isUrl' => FALSE,'Name' => 'Edit Bank'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $data['Bank']         = $this->m_manages->getBankById($BankId);
    //     if (!$data['Bank']) {
    //         die('No Bank Data');
    //     }

    //     $data['BankData'] = $data['Bank'];
    //     $data['CheckBank'] = 1;
    //     $this->load->view('adminpanel/manages/banks/add', $data);
    // }

    // public function detailTransaction($OrderId = FALSE)
    // {
    //     if (!$OrderId) 
    //         die();

    //     // --- Check OrderId Exist --- /
    //     $Transactions = $this->m_manages->getTransactionByOrderId($OrderId);
    //     // --- End Check OrderId Exist --- /

    //     // --- Repopulate list Object --- //
    //     $data['List'] = [];
    //     if (!$Transactions) {
    //         die('no transaction');
    //     }

    //     // echo "<pre>";
    //     // print_r($Transactions);
    //     // die();

    //     $MasterAirline         = $this->m_get->getDynamicArray([
    //         'select'    => '*',
    //         'from'      => 'v2_master_airline',
    //         'where'     => []
    //     ]);

    //     // echo "<pre>";
    //     // print_r($MasterAirline);
    //     // die();

    //     $MasterAirport         = $this->m_get->getDynamicArray([
    //         'select'    => '*',
    //         'from'      => 'v2_master_airport',
    //         'where'     => []
    //     ]);

        
    //     $this->load->model('m_general');
    //     foreach ($Transactions as $key => $value) {
    //         $RsvResponse    = json_decode($value->RsvResponse);
    //         $LfrRequest     = json_decode($value->LfrRequest);
    //         $AirlineId      = array_search($RsvResponse->Airline, array_column($MasterAirline, 'code'));
    //         $Adult          = array_filter($RsvResponse->Passengers, function ($var) {
    //             return ($var->Type == 'Adult');
    //         });

    //         $GetPrice = $this->m_general->GetPrice(['OrderId' => $value->OrderId]);
    //         if (!$value->TotalPrice) {
    //             $TotalPrice     = $GetPrice['TotalPrice'];
    //         }
    //         else {
    //             $TotalPrice     = $value->TotalPrice;
    //         }
    //         $TotalDiscount  = $GetPrice['TotalDiscount'];

    //         $RsvArr['LfrRequest']           = $LfrRequest;
    //         $RsvArr['RsvResponse']          = $RsvResponse;
    //         $RsvArr['TotalPrice']           = number_format($value->TotalPrice, 0, '', ',');
    //         $RsvArr['AirlineName']          = $AirlineId !== false ? $MasterAirline[$AirlineId]['name'] : '';
    //         $RsvArr['TimeLimit']            = date('D, d M Y. H:i', strtotime($RsvResponse->TimeLimit));
    //         $RsvArr['OrderDate']            = date('l, d F Y. - H:i', strtotime($RsvResponse->Created));
    //         $RsvArr['DueDate']              = date('l, d F Y. - H:i', strtotime($value->RsvTimeLimit));
    //         $RsvArr['OrderId']              = $value->OrderId;
    //         $RsvArr['Adult']                = count($Adult);
    //         $RsvArr['ContactName']          = $LfrRequest->Contact->Title.' '.$LfrRequest->Contact->FirstName.' '.$LfrRequest->Contact->LastName;
    //         $RsvArr['CreatedDate']          = $RsvResponse->Created;
    //         $RsvArr['ReffId']               = $value->ReffId;
    //         $RsvArr['IsRead']               = $value->IsRead;
    //         $RsvArr['PaymentStatus']        = $value->PaymentStatus;
    //         if ($value->PaymentStatusId != '3' && strtotime($value->RsvTimeLimit) < strtotime("NOW")) {
    //             $RsvArr['PaymentStatus'] = "Expired";
    //         }
    //         $RsvArr['OrderCount']           = $value->OrderCount;
    //         $RsvArr['RsvId']                = $value->RsvId;
    //         $RsvArr['PnrId']                = $value->PnrId;
    //         $RsvArr['TotalPrice']           = number_format($TotalPrice, 0, '', ',');
    //         $RsvArr['TotalDiscount']        = $TotalDiscount;
    //         $RsvArr['BankName']             = $value->BankName;
    //         $RsvArr['PaymentType']          = $value->PaymentType;
    //         $RsvArr['PaymentTypeOri']       = $value->PaymentTypeOri;
    //         $RsvArr['PriceBeforeDiscount']  = number_format($TotalPrice + $TotalDiscount, 0, '', ',');
    //         $RsvArr['PaymentStatusId']      = $value->PaymentStatusId;
    //         $RsvArr['IsTicketed']           = $RsvResponse->Ticketed;
    //         $RsvArr['UseDiscount']          = $value->DiscountId ? 1 : 0;

    //         if ($value->DiscountId) {
    //             $RsvArr['DiscountDetail'] = [
    //                 'DiscountCode' => $value->DiscountCode,
    //                 'DiscountType' => $value->DiscountType,
    //                 'DiscountNominal' => $value->DiscountNominal
    //             ];
    //         }

    //         if (strtotime($RsvResponse->TimeLimit) < strtotime("now")) {
    //             $RsvArr['IsTicketExpired']    = TRUE;
    //         }
    //         else {
    //             $RsvArr['IsTicketExpired']    = FALSE;
    //         }

    //         $RsvArr['FlightDetails']        = [];
    //         foreach ($RsvResponse->FlightDetails as $key => $value) {                
    //             $AirlineId = array_search($value->Airline, array_column($MasterAirline, 'code'));
    //             $AirportDepartId = array_search($value->Origin, array_column($MasterAirport, 'code'));
    //             $AirportArriveId = array_search($value->Destination, array_column($MasterAirport, 'code'));

    //             $FlightDetail = array_merge( [], (Array) $value );
    //             $FlightDetail['AirlineName']        = $AirlineId ? $MasterAirline[$AirlineId]['name'] : '';
    //             $FlightDetail['AirportDepartName']  = $AirportDepartId ? $MasterAirport[$AirportDepartId]['cityname'] : '';
    //             $FlightDetail['AirportArriveName']  = $AirportArriveId ? $MasterAirport[$AirportArriveId]['cityname'] : '';
    //             $FlightDetail['DepartDateView']     = date('D, d M Y. H:i', strtotime($value->DepartDate.' '.$value->DepartTime));
    //             $FlightDetail['ArriveDateView']     = date('D, d M Y. H:i', strtotime($value->ArriveDate.' '.$value->ArriveTime));
    //             $RsvArr['FlightDetails'][] = (Object) $FlightDetail;
    //         }

    //         $data['List'][] = $RsvArr;
    //     }
    //     // --- End Repopulate List Object --- //

    //     // --- Update Payment Is Read --- //
    //     $this->load->model('m_update');
    //     $this->m_update->updateDynamic([
    //      'where'     => ['pay_order_id'=>$OrderId],
    //      'table'     => 'v2_rsv_payment',
    //      'data'      => ['pay_is_read'=>1]
    //     ]);
    //     // --- End Update Payment Is Read --- //

    //     // echo "<pre>";
    //     // print_r($data['List']);
    //     // die();

    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Detail Transaction',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/transactions'],
    //             ['isUrl' => FALSE,'Name' => 'Detail Transaction'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);
    //     $this->load->view('adminpanel/manages/transactions/detail', $data);
    // }

    // public function detailTransactionHotel($OrderId = FALSE)
    // {
    //     if (!$OrderId) 
    //         die();

    //     $Transactions = $this->m_manages->getHotelReservationByOrderId($OrderId);

    //     $RsvArr = [];
    //     if ($Transactions) {

    //         $Reservation = [
    //             'Guest'                 => json_decode($Transactions->Guest),
    //             'Booker'                => json_decode($Transactions->Booker),
    //             'PaymentTimeout'        => $Transactions->PaymentTimeout,
    //             'PaymentTimeoutView'    => date('D, d M Y - H:i', strtotime($Transactions->PaymentTimeout)),
    //             'Response'              => json_decode($Transactions->Response),
    //             'HotelResponse'         => json_decode($Transactions->HotelResponse),
    //             'IsSendMail'            => $Transactions->IsSendMail,
    //             'CreatedDate'           => $Transactions->CreatedDate,
    //             'CreatedDateView'       => date('D, d M Y - H:i', strtotime($Transactions->CreatedDate)),
    //             'PnrId'                 => $Transactions->PnrId ? $Transactions->PnrId : false,
    //             'StatusBooking'         => $Transactions->StatusBooking ? $Transactions->StatusBooking : false,
    //             'BookingResponse'       => $Transactions->BookingResponse ? json_decode($Transactions->BookingResponse) : false
    //         ];

    //         $Reservation['Response']->Confirmation->CheckInDateView = date('Y-m-d', strtotime($Reservation['Response']->Confirmation->CheckInDate));
    //         $Reservation['Response']->Confirmation->CheckOutDateView = date('Y-m-d', strtotime($Reservation['Response']->Confirmation->CheckOutDate));

    //         $RsvArr['Reservation']          = $Reservation;
    //         $RsvArr['ContactName']          = $Reservation['Booker']->FirstName.' '.$Reservation['Booker']->LastName;
    //         $RsvArr['CreatedDate']          = $Reservation['CreatedDate'];
    //         $RsvArr['OrderId']              = $Transactions->OrderId;
    //         $RsvArr['PaymentStatus']        = $Transactions->PaymentStatus;
    //         $RsvArr['PaymentStatusId']      = $Transactions->PaymentStatusId;
    //         $RsvArr['HotelName']            = $Reservation['Response']->Confirmation->HotelName;
    //         $RsvArr['TotalNight']           = $Reservation['Response']->Confirmation->TotalNight;
    //         $RsvArr['CountRoom']            = $Reservation['Response']->Confirmation->CountRoom;
    //         $RsvArr['CountGuest']           = $Reservation['Response']->Confirmation->CountGuest;

    //         if ($Transactions->PaymentStatusId != '3' && strtotime($Reservation['PaymentTimeout']) < strtotime("now")) {
    //             $RsvArr['PaymentStatus'] = "Expired";
    //         }

    //         $RsvArr['RsvId']                = $Transactions->RsvId;

    //         // $RsvArr['TotalPrice']           = number_format($TotalPrice, 0, '', ',');
    //         $RsvArr['BankName']             = $Transactions->BankName;
    //         $RsvArr['PayIsRead']            = $Transactions->PayIsRead;
    //         $RsvArr['PaymentType']          = $Transactions->PaymentType;
    //         $RsvArr['PayType']              = $Transactions->PayType;
    //         $RsvArr['UseDiscount']          = $Transactions->DiscountId ? 1 : 0;
    //         if ($Transactions->PayType == 4) {
    //             $MidtransResponse = (Array) json_decode($Transactions->PayResponseStatus);
    //             if (isset($MidtransResponse['payment_type'])) {
    //                 if ($MidtransResponse['payment_type'] == "bank_transfer") {
    //                     if (isset($MidtransResponse['va_numbers'])) {
    //                         $RsvArr['BankName'] = strtoupper($MidtransResponse['va_numbers'][0]->bank);
    //                         $RsvArr['PaymentType'] = "Bank Transfer Virtual Account";
    //                     }
    //                 }
    //                 else if ($MidtransResponse['payment_type'] == "credit_card") {
    //                     $RsvArr['BankName'] = strtoupper($MidtransResponse['bank']);
    //                     $RsvArr['PaymentType'] = "Credit Card";
    //                 }
    //                 else if ($MidtransResponse['payment_type'] == "bca_klikpay") {
    //                     $RsvArr['BankName'] = 'BCA';
    //                     $RsvArr['PaymentType'] = "BCA Klikpay";
    //                 }
    //             }
    //             // echo "<pre>";
    //             // print_r($MidtransResponse);
    //             // die();
    //         }

    //         $TotalPrice = round($Reservation['Response']->Confirmation->TotalPrice);
    //         // --- Check Discount --- //
    //         $TotalDiscount = 0;
    //         if ($Transactions->DiscountId) {
    //           if ($Transactions->DiscountType == 1) {
    //               $TotalDiscount = $Transactions->DiscountNominal;
    //           }
    //           elseif ($Transactions->DiscountType == 2) {
    //               $TotalDiscount = ($Transactions->DiscountNominal/100*$TotalPrice);
    //           }
    //           $TotalPrice -= $TotalDiscount;
    //         }

    //         $RsvArr['PriceBeforeDiscount']  = number_format($TotalPrice + $TotalDiscount, 0, '', ',');
    //         $RsvArr['TotalPrice'] = number_format($TotalPrice, 0, '', ',');
    //         if ($Transactions->DiscountId) {
    //             $RsvArr['DiscountDetail'] = [
    //                 'DiscountCode' => $Transactions->DiscountCode,
    //                 'DiscountType' => $Transactions->DiscountType,
    //                 'DiscountNominal' => $Transactions->DiscountNominal
    //             ];
    //         }

    //     }
    //     $data['RsvArr'] = $RsvArr;

    //     // --- Update Payment Is Read --- //
    //     $this->load->model('m_update');
    //     $this->m_update->updateDynamic([
    //      'where'     => ['pay_order_id'=>$OrderId],
    //      'table'     => 'v2_rsv_payment',
    //      'data'      => ['pay_is_read'=>1]
    //     ]);
    //     // --- End Update Payment Is Read --- //


    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Detail Transaction Hotel',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/transactionsHotel'],
    //             ['isUrl' => FALSE,'Name' => 'Detail Transaction Hotel'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);
    //     $this->load->view('adminpanel/manages/transactionsHotel/detail', $data);
    // }

    // public function transactionsFlight()
    // {
    // 	$data['HeaderBar'] = [
    // 		'FaName' 			=> 'fa-edit',
    // 		'LeftMenuTitle' 	=> 'Transaction Flight',
    // 		'RightMenuTitle' 	=> [
    // 			['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/transactionsFlight'],
    // 			['isUrl' => FALSE,'Name' => 'Transaction Flight'],
    // 		]
    // 	];
    // 	$data = $this->globalFunction($data);

    //     $this->load->view('adminpanel/manages/transactions/all', $data);
    // }

    // public function transactionsHotel()
    // {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Transaction Hotel',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/transactionsHotel'],
    //             ['isUrl' => FALSE,'Name' => 'Transaction Hotel'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);

    //     $this->load->view('adminpanel/manages/transactionsHotel/all', $data);
    // }

    // public function ListTransaction()
    // {
    //     $InputData = (Array) json_decode(file_get_contents('php://input'),true);
    //     $Filter = $InputData['data'];
    //     $Transactions = $this->m_manages->getListTransactions($Filter);
    //     $data['List'] = [];
    //     $this->load->model('m_general');
    //     if ($Transactions) {
    //         foreach ($Transactions as $key => $value) {
    //             $RsvResponse    = json_decode($value->RsvResponse);

    //             $Adult   = array_filter($RsvResponse->Passengers, function ($var) {
    //                 return ($var->Type == 'Adult');
    //             });

    //             if (!$value->TotalPrice) {
    //                 $GetPrice = $this->m_general->GetPrice(['OrderId' => $value->OrderId]);
    //                 $TotalPrice = $GetPrice['TotalPrice'];
    //             }
    //             else {
    //                 $TotalPrice = $value->TotalPrice;
    //             }

    //             $RsvArr = [];
    //             $RsvArr['FlightOrigin']         = $RsvResponse->FlightDetails[0]->Origin;
    //             $RsvArr['FlightDestination']    = $RsvResponse->FlightDetails[0]->Destination;
    //             $RsvArr['Adult']                = count($Adult);
    //             $RsvArr['ContactName']          = $RsvResponse->Contact->FirstName.' '.$RsvResponse->Contact->LastName;
    //             $RsvArr['CreatedDate']          = $RsvResponse->Created;
    //             $RsvArr['OrderId']              = $value->OrderId;
    //             $RsvArr['IsRead']               = $value->IsRead;
    //             $RsvArr['PaymentStatus']        = $value->PaymentStatus;
    //             $RsvArr['PaymentStatusId']        = $value->PaymentStatusId;
    //             if ($value->PaymentStatusId != '3' && strtotime($value->RsvTimeLimit) < strtotime("NOW")) {
    //                 $RsvArr['PaymentStatus'] = "Expired";
    //             }
    //             $RsvArr['OrderCount']           = $value->OrderCount;
    //             $RsvArr['RsvId']                = $value->RsvId;
    //             $RsvArr['TotalPrice']           = number_format($TotalPrice, 0, '', ',');
    //             $RsvArr['BankName']             = $value->BankName;
    //             $RsvArr['PayIsRead']            = $value->PayIsRead;
    //             $RsvArr['PaymentType']          = $value->PaymentType;
    //             $RsvArr['UseDiscount']          = $value->DiscountId ? 1 : 0;
    //             if ($value->PayType == 4) {
    //                 $MidtransResponse = (Array) json_decode($value->PayResponseStatus);
    //                 if (isset($MidtransResponse['payment_type'])) {
    //                     if ($MidtransResponse['payment_type'] == "bank_transfer") {
    //                         if (isset($MidtransResponse['va_numbers'])) {
    //                             $RsvArr['BankName'] = strtoupper($MidtransResponse['va_numbers'][0]->bank);
    //                             $RsvArr['PaymentType'] = "Bank Transfer Virtual Account";
    //                         }
    //                     }
    //                     else if ($MidtransResponse['payment_type'] == "credit_card") {
    //                         $RsvArr['BankName'] = strtoupper($MidtransResponse['bank']);
    //                         $RsvArr['PaymentType'] = "Credit Card";
    //                     }
    //                     else if ($MidtransResponse['payment_type'] == "bca_klikpay") {
    //                         $RsvArr['BankName'] = 'BCA';
    //                         $RsvArr['PaymentType'] = "BCA Klikpay";
    //                     }
    //                 }
    //                 // echo "<pre>";
    //                 // print_r($MidtransResponse);
    //                 // die();
    //             }

    //             $data['List'][] = $RsvArr;
    //         }
    //     }

    //     echo json_encode($data['List']);
    //     // echo "<pre>";
    //     // print_r($data['List']);
    //     // die();
    // }

    // public function ListTransactionHotel()
    // {
    //     $InputData = (Array) json_decode(file_get_contents('php://input'),true);
    //     $Filter = $InputData['data'];
    //     $Transactions = $this->m_manages->getHotelReservation($Filter);

    //     // echo json_encode($Transactions);
    //     // die();
    //     $data['List'] = [];
    //     if ($Transactions) {
    //         foreach ($Transactions as $key => $value) {

    //             $Reservation = [
    //                 'Guest'                 => json_decode($value->Guest),
    //                 'Booker'                => json_decode($value->Booker),
    //                 'PaymentTimeout'        => $value->PaymentTimeout,
    //                 'PaymentTimeoutView'    => date('D, d M Y - H:i', strtotime($value->PaymentTimeout)),
    //                 'Response'              => json_decode($value->Response),
    //                 'HotelResponse'         => json_decode($value->HotelResponse),
    //                 'IsSendMail'            => $value->IsSendMail,
    //                 'CreatedDate'           => $value->CreatedDate
    //             ];

    //             $RsvArr['ContactName']          = $Reservation['Booker']->FirstName.' '.$Reservation['Booker']->LastName;
    //             $RsvArr['CreatedDate']          = $Reservation['CreatedDate'];
    //             $RsvArr['OrderId']              = $value->OrderId;
    //             $RsvArr['PaymentStatus']        = $value->PaymentStatus;
    //             $RsvArr['PaymentStatusId']      = $value->PaymentStatusId;
    //             $RsvArr['HotelName']            = $Reservation['Response']->Confirmation->HotelName;
    //             $RsvArr['TotalNight']           = $Reservation['Response']->Confirmation->TotalNight;
    //             $RsvArr['CountRoom']            = $Reservation['Response']->Confirmation->CountRoom;
    //             $RsvArr['CountGuest']           = $Reservation['Response']->Confirmation->CountGuest;

    //             if ($value->PaymentStatusId != '3' && strtotime($Reservation['PaymentTimeout']) < strtotime("now")) {
    //                 $RsvArr['PaymentStatus'] = "Expired";
    //             }

    //             $RsvArr['RsvId']                = $value->RsvId;

    //             // $RsvArr['TotalPrice']           = number_format($TotalPrice, 0, '', ',');
    //             $RsvArr['BankName']             = $value->BankName;
    //             $RsvArr['PayIsRead']            = $value->PayIsRead;
    //             $RsvArr['PaymentType']          = $value->PaymentType;
    //             $RsvArr['UseDiscount']          = $value->DiscountId ? 1 : 0;
    //             if ($value->PayType == 4) {
    //                 $MidtransResponse = (Array) json_decode($value->PayResponseStatus);
    //                 if (isset($MidtransResponse['payment_type'])) {
    //                     if ($MidtransResponse['payment_type'] == "bank_transfer") {
    //                         if (isset($MidtransResponse['va_numbers'])) {
    //                             $RsvArr['BankName'] = strtoupper($MidtransResponse['va_numbers'][0]->bank);
    //                             $RsvArr['PaymentType'] = "Bank Transfer Virtual Account";
    //                         }
    //                     }
    //                     else if ($MidtransResponse['payment_type'] == "credit_card") {
    //                         $RsvArr['BankName'] = strtoupper($MidtransResponse['bank']);
    //                         $RsvArr['PaymentType'] = "Credit Card";
    //                     }
    //                     else if ($MidtransResponse['payment_type'] == "bca_klikpay") {
    //                         $RsvArr['BankName'] = 'BCA';
    //                         $RsvArr['PaymentType'] = "BCA Klikpay";
    //                     }
    //                 }
    //                 // echo "<pre>";
    //                 // print_r($MidtransResponse);
    //                 // die();
    //             }

    //             $TotalPrice = round($Reservation['Response']->Confirmation->TotalPrice);
    //             // --- Check Discount --- //
    //             $TotalDiscount = 0;
    //             if ($value->DiscountId) {
    //               if ($value->DiscountType == 1) {
    //                   $TotalDiscount = $value->DiscountNominal;
    //               }
    //               elseif ($value->DiscountType == 2) {
    //                   $TotalDiscount = ($value->DiscountNominal/100*$TotalPrice);
    //               }
    //               $TotalPrice -= $TotalDiscount;
    //             }
    //             $RsvArr['TotalPrice'] = number_format($TotalPrice, 0, '', ',');
    //             $data['List'][] = $RsvArr;
    //         }
    //     }

    //     echo json_encode($data['List']);
    //     // echo "<pre>";
    //     // print_r($data['List']);
    //     // die();
    // }

    // public function airlines() {
    //     $data['HeaderBar'] = [
    //         'FaName'            => 'fa-edit',
    //         'LeftMenuTitle'     => 'Airline',
    //         'RightMenuTitle'    => [
    //             ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'manages/airline'],
    //             ['isUrl' => FALSE,'Name' => 'Airline'],
    //         ]
    //     ];
    //     $data = $this->globalFunction($data);
    //     $data['Airlines'] = [];
    //     $Airlines = $this->m_manages->getListAirline();
    //     foreach ($Airlines as $key => $value) {
    //         $Airline = array_merge( [], (Array) $value );
    //         $Airline['AirlineStatus'] = $value->AirlineStatus == 1 ? true : false;
    //         $data['Airlines'][] = $Airline;
    //     }
    //     // $data['Airlines'] = $Airlines;

    //     // echo "<pre>";
    //     // print_r($data['Airlines']);
    //     // die();
    //     $this->load->view('adminpanel/manages/airline/edit', $data);
    // }

    protected function globalFunction($data)
    {
        $data['MasterGeneral']         = $this->m_get->getRowDynamic([
            'select'    => 'favicon, logo',
            'from'      => 'v2_master_landingpage',
            'where'     => [
                'id' => 1
            ]
        ]);

    	$data['ViewHead'] 			= $this->load->view('adminpanel/template/head', $data, TRUE);
    	$data['ViewPreLoader'] 		= $this->load->view('adminpanel/template/preloader', [], TRUE);
    	$data['ViewFooter'] 		= $this->load->view('adminpanel/template/footer', [], TRUE);
    	$data['ViewLeftPanel'] 		= $this->load->view('adminpanel/template/left_panel', $data, TRUE);
    	$data['ViewHeaderBar'] 		= $this->load->view('adminpanel/template/header_bar', $data['HeaderBar'], TRUE);
    	$data['ViewCopyRight'] 		= $this->load->view('adminpanel/template/copyright', [], TRUE);
    	return $data;
    }


    public function contactUs()
    {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Contact Us',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/contactUs'],
                ['isUrl' => FALSE,'Name' => 'Contact Us'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['ContactUsData'] = [];
        $ContactUs = $this->m_manages->getContactUs();
        if ($ContactUs) {
            $data['ContactUsData'] = array_merge( [], (Array) $ContactUs );
            $data['ContactUsData']['ContactCenter'] = json_decode($ContactUs->ContactCenter,true);
            $data['ContactUsData']['ContactCenter2'] = json_decode($ContactUs->TourInquiries,true);
            $data['ContactUsData']['ContactCenter3'] = json_decode($ContactUs->ComplainCompliment, true);
        }
        $this->load->view('adminpanel/manages/contactus/edit', $data);
    }

}

?>