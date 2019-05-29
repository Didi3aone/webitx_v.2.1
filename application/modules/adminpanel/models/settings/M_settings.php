<?php

class m_settings extends CI_Model
{
    function getGeneralData()
    {
        $q = "
            SELECT
            LandingPage.title AS Title,
            LandingPage.meta_keyword AS MetaKeyword,
            LandingPage.meta_description AS MetaDescription,
            LandingPage.favicon AS Favicon,
            LandingPage.logo AS Logo,
            LandingPage.color AS Color,
            LandingPage.tagline AS Tagline,
            LandingPage.background_image AS BackgroundImage,
            LandingPage.use_old_website AS UseOldWebsite
            FROM v2_master_landingpage AS LandingPage
            WHERE LandingPage.id = 1
        ";
        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // function getSettingBooking()
    // {
    //     $q = "
    //         SELECT
    //         SettingBooking.expired_time AS ExpiredTime,
    //         SettingBooking.email AS Email,
    //         SettingBooking.issue_ticket AS IssueTicket,
    //         SettingBooking.choosen_formula AS ChoosenFormula
    //         FROM v2_master_setting_booking AS SettingBooking
    //         WHERE SettingBooking.id = 1
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->row();
    //     }
    //     return FALSE;
    // }

    // function getSettingFaspay()
    // {
    //     $q = "
    //         SELECT
    //         SettingFaspay.cc_merchant_id AS CCMerchantId,
    //         SettingFaspay.cc_password AS CCPassword,
    //         SettingFaspay.cc_url_inquiry AS CCUrlInquiry,
    //         SettingFaspay.deb_merchant_name AS DebMerchantName,
    //         SettingFaspay.deb_merchant_id AS DebMerchantId,
    //         SettingFaspay.deb_user_id AS DebUserId,
    //         SettingFaspay.deb_password AS DebPassword,
    //         SettingFaspay.deb_url_inquiry AS DebUrlInquiry,
    //         SettingFaspay.deb_url_status_inquiry AS DebUrlStatusInquiry,
    //         SettingFaspay.deb_url_post AS DebUrlPost

    //         FROM v2_master_setting_faspay AS SettingFaspay
    //         WHERE SettingFaspay.id = 1
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->row();
    //     }
    //     return FALSE;
    // }

    // function getSettingMidtrans()
    // {
    //     $q = "
    //         SELECT
    //         SettingMidtrans.msd_is_production AS IsProduction,
    //         SettingMidtrans.msd_payment_method AS PaymentMethod,
    //         SettingMidtrans.msd_merchant_id AS MerchantId,
    //         SettingMidtrans.msd_client_key AS ClientKey,
    //         SettingMidtrans.msd_server_key AS ServerKey,
    //         SettingMidtrans.msd_notification_url AS NotificationUrl,
    //         SettingMidtrans.msd_finish_url AS FinishUrl,
    //         SettingMidtrans.msd_unfinish_url AS UnFinishUrl,
    //         SettingMidtrans.msd_error_url AS ErrorUrl,
    //         SettingMidtrans.msd_is_auto_payment_link AS IsAutoPaymentLink

    //         FROM v2_master_setting_midtrans AS SettingMidtrans
    //         WHERE SettingMidtrans.msd_id = 1
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->row();
    //     }
    //     return FALSE;
    // }

    // function getSettingEmail()
    // {
    //     $q = "
    //         SELECT
    //         SettingEmail.email_from AS EmailFrom,
    //         SettingEmail.email_from_title AS EmailTitle
    //         FROM v2_master_setting_email AS SettingEmail
    //         WHERE SettingEmail.id = 1
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->row();
    //     }
    //     return FALSE;
    // }

    // function getOpsitoolsListApi(){
    //     $q = "
    //         SELECT
    //         ListApi.id AS ListId,
    //         ListApi.name AS ListName,
    //         ListApi.url AS ListUrl
    //         FROM v2_master_list_api AS ListApi
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->result_array();
    //     }
    //     return FALSE;
    // }

    // function getOpsitoolsAuth(){
    //     $q = "
    //         SELECT
    //         AuthApi.grant_type AS GrantType,
    //         AuthApi.client_id AS ClientId,
    //         AuthApi.client_secret AS ClientSecret,
    //         AuthApi.scope AS Scope
    //         FROM v2_master_auth_api AS AuthApi
    //     ";
    //     $list = $this->db->query($q);
    //     if ($list->num_rows() > 0) {
    //         return $list->row();
    //     }
    //     return FALSE;
    // }

}