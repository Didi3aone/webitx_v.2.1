<?php

class M_general extends CI_Model
{

    // @Params : OrderId
    // Get Flight Price and Discount
    public function GetPrice($params)
    {
        $Now = date('Y-m-d H:i:s');

        // --- Calculate Total Price --- //
        $this->load->model('m_get');
        $Reservation = $this->m_get->getReservation($params['OrderId']);

        $TotalPrice = 0;
        foreach ($Reservation as $key => $value) {                    
            $GetPaymentDetail         = $this->m_get->getRsvPaymentDetail($value->rsv_id);
            if ($GetPaymentDetail) {
                foreach ($GetPaymentDetail as $keyPaymentDetail => $valuePaymentDetail) {
                   $TotalPrice += $valuePaymentDetail->rpd_amount;
                }
            }
        }
        // --- End Calculate Total Price --- //

        // --- Check Discount --- //
        $TotalDiscount = 0;
        $CheckDiscount         = $this->m_get->CheckDiscount($params['OrderId']);
        if ($CheckDiscount) {
            $data['TotalDiscount'] = $CheckDiscount->disc_nominal;
            $data['DiscountType'] = $CheckDiscount->disc_type;
            if ($data['DiscountType'] == 1) {
                $TotalDiscount = $data['TotalDiscount'];
            }
            elseif ($data['DiscountType'] == 2) {
                $TotalDiscount = ($data['TotalDiscount']/100*$TotalPrice);
            }
            $TotalPrice -= $TotalDiscount;

            // $this->load->model('m_update');
            // $this->m_update->updateDynamic([
            //     'data'  => [
            //         'disc_total'          => $TotalDiscount,
            //     ],
            //     'table' => 'v2_rsv_payment_discount',
            //     'where' => ['disc_order_id' => $params['OrderId']]
            // ]);
        }
        // --- End Check Discount --- //

        return ['TotalPrice' => $TotalPrice, 'TotalDiscount' => $TotalDiscount];
    }

    // @Params : OrderId
    // Get Hotel Price and Discount
    public function GetPriceHotel($params)
    {
      $Now = date('Y-m-d H:i:s');

      // --- Calculate Total Price --- //
      $this->load->model('hotel/m_hotel');
      $GetReservation = $this->m_hotel->getHotelReservation($params['OrderId']);
      if (!$GetReservation) {
        return false;
      }
      $Reservation = [
          'Guest'                 => json_decode($GetReservation->hr_guest),
          'Booker'                => json_decode($GetReservation->hr_contact),
          'PaymentTimeout'        => $GetReservation->hr_payment_timeout,
          'PaymentTimeoutView'    => date('D, d M Y - H:i', strtotime($GetReservation->hr_payment_timeout)),
          'Response'              => json_decode($GetReservation->lhc_response),
          'HotelResponse'         => json_decode($GetReservation->lha_response),
          'IsSendMail'            => $GetReservation->hr_is_send_mail,
          'CreatedDate'           => $GetReservation->lha_created_at
      ];

      $Reservation['Response']->Confirmation->CheckInDateView = date('Y-m-d', strtotime($Reservation['Response']->Confirmation->CheckInDate));
      $Reservation['Response']->Confirmation->CheckOutDateView = date('Y-m-d', strtotime($Reservation['Response']->Confirmation->CheckOutDate));

      $TotalPrice = $Reservation['Response']->Confirmation->TotalPrice;

      // --- Check Discount --- //
      $TotalDiscount = 0;
      $CheckDiscount         = $this->m_get->CheckDiscount($params['OrderId']);
      if ($CheckDiscount) {
          $data['TotalDiscount'] = $CheckDiscount->disc_nominal;
          $data['DiscountType'] = $CheckDiscount->disc_type;
          if ($data['DiscountType'] == 1) {
              $TotalDiscount = $data['TotalDiscount'];
          }
          elseif ($data['DiscountType'] == 2) {
              $TotalDiscount = ($data['TotalDiscount']/100*$TotalPrice);
          }
          $TotalPrice -= $TotalDiscount;
      }
      // --- End Check Discount --- //

      return ['TotalPrice' => $TotalPrice, 'TotalDiscount' => $TotalDiscount, 'Reservation' => $Reservation];
    }

    // Load General Data (ex: header, footer)
    public function loadGeneralData()
    {
        $data['masterLandingPage']  = $this->m_landingpage->getMasterLandingpage();
        $data['masterSetting']      = $this->m_landingpage->getMasterSetting();
        $data['footerPage']         = $this->m_landingpage->getFooterPage();
        $data['navPage']            = $this->m_landingpage->getNavPage();
        return $data;
    }

}