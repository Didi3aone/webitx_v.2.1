<?php

class M_manages extends CI_Model
{
    function getRowDynamic($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $this->db->limit(1);
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getDynamic($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getDynamicOrderBy($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $this->db->order_by($data['orderby'], "ASC");
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }
    
    function getPageById($PageId)
    {
        $q = "
            SELECT
            Pages.id AS PageId,
            Pages.nav_name AS NavName,
            Pages.name AS TitleName,
            Pages.seourl AS SeoUrl,
            Pages.status AS PageStatus,
            Pages.parentid AS ParentId,
            Pages.redirect_url AS RedirectUrl,
            Pages.subtitle AS SubTitle,
            Pages.imgcover AS ImageCover,
            Pages.description AS Description,
            Pages.subcontent AS SubContent,
            Pages.metakeyword AS MetaKeyword,
            Pages.metadescription AS MetaDescription,
            CASE
                WHEN (Pages.type_page = 'footer') 
                    THEN 'Bottom'
                WHEN (Pages.type_page = 'nav' || Pages.type_page = 'navmore1' || Pages.type_page = 'navmore2') 
                    THEN 'Top'
                ELSE '' 
            END AS PageLocation,
            (SELECT SeoUrl FROM v2_master_page AS a WHERE a.id = Pages.parentid ) AS ParentName
            FROM v2_master_page AS Pages
            WHERE Pages.status != 2 AND is_parent = 0 AND Pages.id = $PageId
            ORDER BY PageStatus ASC, ParentName ASC, PageLocation DESC, NavName ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->row_array();
        }
        return FALSE;
    }

    function getListAirline()
    {
        $q = "
            SELECT
            Airlines.id AS AirlineId,
            Airlines.code AS AirlineCode,
            Airlines.name AS AirlineName,
            Airlines.status AS AirlineStatus
            FROM v2_master_airline AS Airlines
            ORDER BY AirlineCode ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getListUsers()
    {
        $q = "
            SELECT
            Users.id AS UserId,
            Users.username AS UserName,
            Users.email AS Email,
            Users.first_name AS FirstName,
            Users.last_name AS LastName
            FROM users AS Users
            ORDER BY FirstName ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getListPages()
    {
        $q = "
            SELECT
            Pages.id AS PageId,
            Pages.nav_name AS NavName,
            Pages.name AS TitleName,
            Pages.seourl AS SeoUrl,
            Pages.status AS PageStatus,
            Pages.parentid AS ParentId,
            Pages.redirect_url AS RedirectUrl,
            CASE
                WHEN (Pages.type_page = 'footer') 
                    THEN 'Bottom'
                WHEN (Pages.type_page = 'nav' || Pages.type_page = 'navmore1' || Pages.type_page = 'navmore2') 
                    THEN 'Top'
                ELSE '' 
            END AS PageLocation,
            (SELECT SeoUrl FROM v2_master_page AS a WHERE a.id = Pages.parentid ) AS ParentName
            FROM v2_master_page AS Pages
            WHERE Pages.status != 2 AND is_parent = 0
            ORDER BY PageStatus ASC, ParentName ASC, PageLocation DESC, NavName ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getListBanks()
    {
        $q = "
            SELECT
            Bank.id AS BankId,
            Bank.name AS BankName,
            Bank.rekening AS RekeningNo,
            Bank.rekening_name AS RekeningName,
            Bank.imgor AS ImageUrl
            FROM v2_master_bank AS Bank
            WHERE Bank.status != 2
            ORDER BY Bank.id DESC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getContactUs()
    {
        $q = "
            SELECT
            ContactUs.company_name AS CompanyName,
            ContactUs.company_address AS CompanyAddress,
            ContactUs.contactus_contact_center AS ContactCenter,
            ContactUs.contactus_tour_inquiries AS TourInquiries,
            ContactUs.contactus_complain_compliment AS ComplainCompliment,
            ContactUs.copyright AS CopyRight
            FROM v2_master_landingpage AS ContactUs
            WHERE ContactUs.id = 1
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getBankById($BankId)
    {
        $q = "
            SELECT
            Bank.id AS BankId,
            Bank.name AS BankName,
            Bank.rekening AS RekeningNo,
            Bank.rekening_name AS RekeningName,
            Bank.imgor AS ImageUrl
            FROM v2_master_bank AS Bank
            WHERE Bank.status = 1 AND Bank.id = $BankId
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getDiscountById($DiscountId)
    {
        $q = "
            SELECT
            Discount.mdisc_id AS DiscountId,
            Discount.mdisc_type AS DiscountType,
            Discount.mdisc_is_publish AS IsPublish,
            CASE
                WHEN (Discount.mdisc_type = 1) 
                    THEN Discount.mdisc_nominal
                ELSE 0
            END AS Nominal,
            CASE
                WHEN (Discount.mdisc_type = 2) 
                    THEN Discount.mdisc_nominal
                ELSE 0
            END AS Percent,
            CASE
                WHEN (Discount.mdisc_type = 1) 
                    THEN Discount.mdisc_nominal
                WHEN (Discount.mdisc_type = 2) 
                    THEN Discount.mdisc_nominal
                ELSE '' 
            END AS TotalDiscount,
            Discount.mdisc_qty AS Quantity,
            Discount.mdisc_stock AS Stock,
            Discount.mdisc_start_date AS StartDate,
            Discount.mdisc_end_date AS EndDate,
            Discount.mdisc_flight_arr AS FlightArr,
            Discount.mdisc_code AS VoucherCode,
            Discount.mdisc_name AS DiscountName

            FROM v2_master_discount AS Discount
            WHERE Discount.mdisc_status = 1 AND Discount.mdisc_id = $DiscountId
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getListDiscounts()
    {
        $q = "
            SELECT
            Discount.mdisc_id AS DiscountId,
            Discount.mdisc_type AS DiscountType,
            Discount.mdisc_nominal AS Nominal,
            CASE
                WHEN (Discount.mdisc_type = 1) 
                    THEN Discount.mdisc_nominal
                WHEN (Discount.mdisc_type = 2) 
                    THEN Discount.mdisc_nominal
                ELSE '' 
            END AS TotalDiscount,
            Discount.mdisc_qty AS Qty,
            Discount.mdisc_stock AS Stock,
            Discount.mdisc_start_date AS StartDate,
            Discount.mdisc_end_date AS EndDate,
            Discount.mdisc_flight_arr AS FlightArr,
            Discount.mdisc_code AS VoucherCode,
            Discount.mdisc_name AS DiscountName

            FROM v2_master_discount AS Discount
            WHERE Discount.mdisc_status = 1
            ORDER BY Discount.mdisc_id DESC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getReservationByOrderId($OrderId) {
        $q = "
            SELECT  
            LogRsv.lfr_order_id AS OrderId,
            Rsv.rsv_id AS RsvId,
            Rsv.rsv_is_read AS IsRead,
            Rsv.rsv_response AS RsvResponse,
            Rsv.rsv_time_limit AS RsvTimeLimit,
            Rsv.rsv_pnr_id AS PnrId,
            Rsv.rsv_is_ticketed AS IsTicketed,
            (SELECT COUNT(rsv_id) FROM v2_reservation WHERE rsv_order_id= Rsv.rsv_order_id) AS OrderCount

            FROM v2_log_flight_rsv LogRsv 
            
            INNER JOIN v2_reservation Rsv ON LogRsv.lfr_order_id = Rsv.rsv_order_id AND LogRsv.lfr_pnr_id = Rsv.rsv_pnr_id

            WHERE LogRsv.lfr_order_id = $OrderId
            ORDER BY LogRsv.lfr_id ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getTransactionByOrderId($OrderId) {
        $q = "
            SELECT  
            LogRsv.lfr_order_id AS OrderId,
            LogRsv.lfr_request AS LfrRequest,
            Rsv.rsv_id AS RsvId,
            Rsv.rsv_is_read AS IsRead,
            Rsv.rsv_status_payment AS RsvStatusPayment,
            Rsv.rsv_response AS RsvResponse,
            Rsv.rsv_time_limit AS RsvTimeLimit,
            Rsv.rsv_pnr_id AS PnrId,
            Rsv.rsv_is_ticketed AS IsTicketed,
            RsvPayment.pay_reff_id AS ReffId,
            RsvPayment.pay_bank_name AS BankName,
            RsvPayment.pay_total_pay AS TotalPrice,
            RsvPayment.pay_is_read AS PayIsRead,
            RsvPayment.pay_payment_status AS PaymentStatusId,
            RsvPayment.pay_type AS PaymentTypeOri,
            RsvPaymentDiscount.disc_id AS DiscountId,
            MasterDiscount.mdisc_code AS DiscountCode,
            MasterDiscount.mdisc_type AS DiscountType,
            MasterDiscount.mdisc_nominal AS DiscountNominal,
            (SELECT COUNT(rsv_id) FROM v2_reservation WHERE rsv_order_id= Rsv.rsv_order_id) AS OrderCount,
            CASE
                WHEN (RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL)
                    THEN 'Waiting Payment' 
                WHEN (RsvPayment.pay_payment_status = 2) 
                    THEN 'Waiting Validation'
                WHEN (RsvPayment.pay_payment_status = 3) 
                    THEN 'Payment Complete' 
                ELSE '' 
            END AS PaymentStatus,

            CASE
                WHEN (RsvPayment.pay_type = 1) 
                    THEN 'Bank Transfer' 
                WHEN (RsvPayment.pay_type = 2) 
                    THEN 'Debit'
                WHEN (RsvPayment.pay_type = 3) 
                    THEN 'Credit Card' 
                ELSE '' 
            END AS PaymentType

            FROM v2_log_flight_rsv LogRsv 
            
            INNER JOIN v2_reservation Rsv ON LogRsv.lfr_order_id = Rsv.rsv_order_id AND LogRsv.lfr_pnr_id = Rsv.rsv_pnr_id
            
            LEFT JOIN v2_rsv_payment_discount AS RsvPaymentDiscount ON RsvPaymentDiscount.disc_order_id=Rsv.rsv_order_id
            LEFT JOIN v2_master_discount AS MasterDiscount ON MasterDiscount.mdisc_id=RsvPaymentDiscount.disc_mdisc_id
            LEFT JOIN v2_rsv_payment RsvPayment ON LogRsv.lfr_order_id = RsvPayment.pay_order_id
            LEFT JOIN
            (
                SELECT pay_order_id, MAX(pay_id) maxId
                FROM v2_rsv_payment
                WHERE pay_order_id = $OrderId
                GROUP BY pay_order_id
            ) c ON RsvPayment.pay_order_id = c.pay_order_id AND RsvPayment.pay_id = c.maxId

            WHERE LogRsv.lfr_order_id = $OrderId
            ORDER BY LogRsv.lfr_id ASC
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getListTransactions($Filter=FALSE)
    {
        if ($Filter['UseDiscount'] != 'yes') {
            $Filter['DiscountCode'] == '';
        }
        $AddWhere = '(';
        switch ($Filter['PaymentStatus']) {
            case 'all':
                $AddWhere .= '1 = 1';
                break;
            case 'waiting_payment':
                $AddWhere .= '(RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL) AND Rsv.rsv_time_limit AND Rsv.rsv_time_limit >= NOW()';
                break;
            case 'waiting_validation':
                $AddWhere .= 'RsvPayment.pay_payment_status = 2 AND Rsv.rsv_time_limit AND Rsv.rsv_time_limit >= NOW()';
                break;
            case 'payment_completed':
                $AddWhere .= 'RsvPayment.pay_payment_status = 3';
                break;
            case 'expired':
                $AddWhere .= 'RsvPayment.pay_payment_status != 3 AND Rsv.rsv_time_limit AND Rsv.rsv_time_limit < NOW()';
                break;
            default:
                $AddWhere .= '1 = 1';
                break;
        }
        $AddWhere.= ') AND (';
        switch ($Filter['UseDiscount']) {
            case 'all':
                $AddWhere .= '1 = 1';
                break;
            case 'yes':
                $AddWhere .= 'RsvPaymentDiscount.disc_id IS NOT NULL';
                break;
            case 'no':
                $AddWhere .= 'RsvPaymentDiscount.disc_id IS NULL';
                break;
            default:
                $AddWhere .= '1 = 1';
                break;
        }
        $AddWhere.= ') AND ';
        if ($Filter['DiscountCode'] != '') {
            $AddWhere .= "MasterDiscount.mdisc_code = '".$Filter['DiscountCode']."'";
        }
        else {
            $AddWhere .= '1=1';
        }
        


        $q = "  SELECT 
                LogRsv.lfr_order_id AS OrderId,
                Rsv.rsv_id AS RsvId,
                Rsv.rsv_is_read AS IsRead,
                Rsv.rsv_status_payment AS RsvStatusPayment,
                Rsv.rsv_response AS RsvResponse,
                Rsv.rsv_time_limit AS RsvTimeLimit,
                (SELECT COUNT(rsv_id) FROM v2_reservation WHERE rsv_order_id= Rsv.rsv_order_id) AS OrderCount,
                RsvPayment.pay_bank_name AS BankName,
                RsvPayment.pay_total_pay AS TotalPrice,
                RsvPayment.pay_is_read AS PayIsRead,
                RsvPayment.pay_payment_status AS PaymentStatusId,
                RsvPayment.pay_type AS PayType,
                RsvPayment.pay_response_status AS PayResponseStatus,
                RsvPaymentDiscount.disc_id AS DiscountId,
                CASE
                    -- WHEN (
                    --     RsvPayment.pay_payment_status = 4 OR 
                    --     Rsv.rsv_time_limit IS NULL OR
                    --     Rsv.rsv_time_limit < NOW()
                    --     )
                    --     THEN 'Expired'
                    WHEN (RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL)
                        THEN 'Waiting Payment' 
                    WHEN (RsvPayment.pay_payment_status = 2) 
                        THEN 'Waiting Validation'
                    WHEN (RsvPayment.pay_payment_status = 3) 
                        THEN 'Payment Complete' 
                    ELSE '' 
                END AS PaymentStatus,
                CASE
                    WHEN (RsvPayment.pay_type = 1) 
                        THEN 'Bank Transfer' 
                    WHEN (RsvPayment.pay_type = 2) 
                        THEN 'Debit'
                    WHEN (RsvPayment.pay_type = 3) 
                        THEN 'Credit Card'
                    ELSE '' 
                END AS PaymentType
                FROM v2_log_flight_rsv AS LogRsv
                INNER JOIN v2_reservation AS Rsv ON Rsv.rsv_order_id=LogRsv.lfr_order_id
                LEFT JOIN v2_rsv_payment AS RsvPayment ON Rsv.rsv_order_id=RsvPayment.pay_order_id
                LEFT JOIN v2_rsv_payment_discount AS RsvPaymentDiscount ON RsvPaymentDiscount.disc_order_id=Rsv.rsv_order_id
                LEFT JOIN v2_master_discount AS MasterDiscount ON MasterDiscount.mdisc_id=RsvPaymentDiscount.disc_mdisc_id
                WHERE $AddWhere
                GROUP BY LogRsv.lfr_order_id
                ORDER BY LogRsv.lfr_id DESC, Rsv.rsv_id DESC
                ";

        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }


    function getHotelReservation($Filter=FALSE)
    {
        if ($Filter['UseDiscount'] != 'yes') {
            $Filter['DiscountCode'] == '';
        }
        $AddWhere = '(';
        switch ($Filter['PaymentStatus']) {
            case 'all':
                $AddWhere .= '1 = 1';
                break;
            case 'waiting_payment':
                $AddWhere .= '(RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL) AND HotRsv.hr_payment_timeout AND HotRsv.hr_payment_timeout >= NOW()';
                break;
            case 'waiting_validation':
                $AddWhere .= 'RsvPayment.pay_payment_status = 2 AND HotRsv.hr_payment_timeout AND HotRsv.hr_payment_timeout >= NOW()';
                break;
            case 'payment_completed':
                $AddWhere .= 'RsvPayment.pay_payment_status = 3';
                break;
            case 'expired':
                $AddWhere .= 'RsvPayment.pay_payment_status != 3 AND HotRsv.hr_payment_timeout AND HotRsv.hr_payment_timeout < NOW()';
                break;
            default:
                $AddWhere .= '1 = 1';
                break;
        }
        $AddWhere.= ') AND (';
        switch ($Filter['UseDiscount']) {
            case 'all':
                $AddWhere .= '1 = 1';
                break;
            case 'yes':
                $AddWhere .= 'RsvPaymentDiscount.disc_id IS NOT NULL';
                break;
            case 'no':
                $AddWhere .= 'RsvPaymentDiscount.disc_id IS NULL';
                break;
            default:
                $AddWhere .= '1 = 1';
                break;
        }
        $AddWhere.= ') AND ';
        if ($Filter['DiscountCode'] != '') {
            $AddWhere .= "MasterDiscount.mdisc_code = '".$Filter['DiscountCode']."'";
        }
        else {
            $AddWhere .= '1=1';
        }

        $qCheck = "
            SELECT 
            HotRsv.hr_id AS RsvId,
            HotRsv.hr_guest AS Guest,
            HotRsv.hr_contact AS Booker,
            HotRsv.hr_payment_timeout AS PaymentTimeout,
            HotRsv.hr_is_send_mail AS IsSendMail,
            HotRsv.hr_order_id AS OrderId,
            HotRsv.hr_created_at AS CreatedDate,
            HotConf.lhc_response AS Response,
            HotAvail.lha_response AS HotelResponse,
            RsvPayment.pay_bank_name AS BankName,
            RsvPayment.pay_total_pay AS TotalPrice,
            RsvPayment.pay_is_read AS PayIsRead,
            RsvPayment.pay_payment_status AS PaymentStatusId,
            RsvPayment.pay_type AS PayType,
            RsvPayment.pay_response_status AS PayResponseStatus,
            RsvPaymentDiscount.disc_id AS DiscountId,
            RsvPaymentDiscount.disc_nominal AS DiscountNominal,
            RsvPaymentDiscount.disc_type AS DiscountType,
            CASE
                WHEN (RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL)
                    THEN 'Waiting Payment' 
                WHEN (RsvPayment.pay_payment_status = 2) 
                    THEN 'Waiting Validation'
                WHEN (RsvPayment.pay_payment_status = 3) 
                    THEN 'Payment Complete' 
                ELSE '' 
            END AS PaymentStatus,
            CASE
                WHEN (RsvPayment.pay_type = 1) 
                    THEN 'Bank Transfer' 
                WHEN (RsvPayment.pay_type = 2) 
                    THEN 'Debit'
                WHEN (RsvPayment.pay_type = 3) 
                    THEN 'Credit Card'
                ELSE '' 
            END AS PaymentType

            FROM `v2_hotel_reservation` AS HotRsv 
            JOIN `v2_log_hotel_confirmation` AS HotConf ON HotRsv.`hr_confirmation_id` = HotConf.`lhc_confirmation_id`
            JOIN `v2_log_hotel_availability` AS HotAvail ON HotAvail.`lha_hotel_key` = HotConf.`lhc_hotel_key`

            LEFT JOIN v2_rsv_payment AS RsvPayment ON HotRsv.hr_order_id = RsvPayment.pay_order_id
            LEFT JOIN v2_rsv_payment_discount AS RsvPaymentDiscount ON RsvPaymentDiscount.disc_order_id = HotRsv.hr_order_id
            LEFT JOIN v2_master_discount AS MasterDiscount ON MasterDiscount.mdisc_id = RsvPaymentDiscount.disc_mdisc_id
            
            WHERE $AddWhere
            ORDER BY HotRsv.hr_created_at DESC
        ";

        $listCheck = $this->db->query($qCheck);
        if ($listCheck->num_rows() > 0) {
            return $listCheck->result();
        }
        return false;
    }

    public function getHotelReservationByOrderId($OrderId)
    {
        $qCheck = "
            SELECT 
            HotRsv.hr_id AS RsvId,
            HotRsv.hr_guest AS Guest,
            HotRsv.hr_contact AS Booker,
            HotRsv.hr_payment_timeout AS PaymentTimeout,
            HotRsv.hr_is_send_mail AS IsSendMail,
            HotRsv.hr_order_id AS OrderId,
            HotRsv.hr_created_at AS CreatedDate,            
            HotRsv.hr_status_booked AS StatusBooking,
            HotConf.lhc_response AS Response,
            HotAvail.lha_response AS HotelResponse,
            RsvPayment.pay_bank_name AS BankName,
            RsvPayment.pay_total_pay AS TotalPrice,
            RsvPayment.pay_is_read AS PayIsRead,
            RsvPayment.pay_payment_status AS PaymentStatusId,
            RsvPayment.pay_type AS PayType,
            RsvPayment.pay_response_status AS PayResponseStatus,
            RsvPaymentDiscount.disc_id AS DiscountId,
            RsvPaymentDiscount.disc_nominal AS DiscountNominal,
            RsvPaymentDiscount.disc_type AS DiscountType,
            MasterDiscount.mdisc_code AS DiscountCode,
            HotBook.hb_pnr_id AS PnrId,
            HotBook.hb_response AS BookingResponse,
            CASE
                WHEN (RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL)
                    THEN 'Waiting Payment' 
                WHEN (RsvPayment.pay_payment_status = 2) 
                    THEN 'Waiting Validation'
                WHEN (RsvPayment.pay_payment_status = 3) 
                    THEN 'Payment Complete' 
                ELSE '' 
            END AS PaymentStatus,
            CASE
                WHEN (RsvPayment.pay_type = 1) 
                    THEN 'Bank Transfer' 
                WHEN (RsvPayment.pay_type = 2) 
                    THEN 'Debit'
                WHEN (RsvPayment.pay_type = 3) 
                    THEN 'Credit Card'
                ELSE '' 
            END AS PaymentType

            FROM `v2_hotel_reservation` AS HotRsv 
            JOIN `v2_log_hotel_confirmation` AS HotConf ON HotRsv.`hr_confirmation_id` = HotConf.`lhc_confirmation_id`
            JOIN `v2_log_hotel_availability` AS HotAvail ON HotAvail.`lha_hotel_key` = HotConf.`lhc_hotel_key`

            LEFT JOIN v2_hotel_booking AS HotBook ON HotRsv.hr_order_id = HotBook.hb_order_id

            LEFT JOIN v2_rsv_payment AS RsvPayment ON HotRsv.hr_order_id = RsvPayment.pay_order_id
            LEFT JOIN v2_rsv_payment_discount AS RsvPaymentDiscount ON RsvPaymentDiscount.disc_order_id = HotRsv.hr_order_id
            LEFT JOIN v2_master_discount AS MasterDiscount ON MasterDiscount.mdisc_id = RsvPaymentDiscount.disc_mdisc_id
            WHERE HotRsv.hr_order_id = '".$OrderId."'";

        $listCheck = $this->db->query($qCheck);
        if ($listCheck->num_rows() > 0) {
            return $listCheck->row();
        }
        return false;
    }

}