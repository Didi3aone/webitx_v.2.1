<div class="container">
    <div class="row">
        <div class="col">
            <section class="card card-admin" style="box-shadow:0px 20px 20px -5px #9c9c9c">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>
                    <h2 class="card-title"><?= $title_form; ?></h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal" id="forms" method="POST" action="<?php echo site_url('member/submit_register') ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">First name <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" name="first_name" id="first_name" type="text" placeholder="First name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Last name <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" name="last_name" id="last_name"type="text" placeholder="Last name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Username <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" name="username" id="username" type="text" placeholder="Username">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">NIK <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control"  name="nik" id="nik" type="text" placeholder="NIK">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Gender <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <select id="user_time_zone" name="gender" id="gender" class="form-control">
                                    <option value="">-- choose --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Birth Date <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control datepicker" id="birth_date" name="birth_date" type="text" placeholder="Birth Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Email <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" id="email" name="email" type="email" value="" placeholder="email@gmail.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Phone <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" id="phone" name="phone" type="text" value="" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Password <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" name="password" data-msg-required="Please enter your password." id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" passwordCheck="passwordCheck" type="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Confirm password <span class="wajib">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" equalTo="#password"  name="repassword" id="repassword" type="password">
                            </div>
                        </div>
                        <p style="margin-top: 20px;">
                            <b>Privacy Policy</b>
                        </p>
                        <div class="card-body pre-scrollable" style="height: 200px; width: 100%;">
                            <p>
                                Applicability
                                By accessing and using this site, your use indicates your agreement with the terms of this Policy. If you do not agree with this Policy, please do not use this site.
                                This Policy is applicable to this and certain other ITX web/mobile sites, but not necessarily, for which special terms and conditions may apply as indicated. All ITX sites to which this Policy is applicable are collectively referred to as this "site". Note that special use terms, or site or page specific terms (referred to as "special terms"), may apply to certain pages/services on this site, but the applicability of any such special terms will be expressly indicated. In the event of any inconsistency between any special terms and this Policy, the applicable special terms will prevail over the terms of this Policy.

                                Anonymous Use
                                In general, most of this site's pages are provided for informational purposes and you will be able to use this site without telling ITX who you are or providing ITX with any personal data about yourself. There are times, however, when in connection with your use of this site ITX may need information about you.

                                Personal Data Provided by You
                                To respond to your questions, fulfill your requests or manage interactive customer programs, it may be necessary to ask for or obtain personal data. If you provide us with any personal data, we may use it to respond to your requests, customize your user experience with us, determine your satisfaction with ITX products and/or services or contact you via mail, e-mail, mobile message or phone, or, in accordance with local law, contact you via the aforementioned channels to inform you of new products, services or promotions we may offer. By providing information to ITX through this site, you acknowledge and consent to the collection, use and disclosure of personally identifying information of the type and for the limited purposes described in this Policy.
                                You expressly accept and give your consent that your personal data obtained in connection with your use of this site may be transferred, if permitted by applicable local legislation, across international borders to server locations supporting this site (including but not limited to transfers from those locations back to the country of your location) for operating and developing this site and ITX services, including transfers to ITX subcontractors or agents, as mentioned below, who perform tasks related to this site, or ITX services, or for the purposes of storing the data in relevant databases, which may be located in Finland or in any other country where ITX has operations. If you place an order for a product, request a service or submit content to this site, we may need to contact you for additional information required to process or fulfill your order and/or request. Unless compelled by applicable law or administrative or judicial order, we will not provide this information to a third party without your permission, except as necessary to process your order, fulfill your requests, manage interactive customer programs or, if you are a corporate user, enable administration of access and usage of this site by authorized personnel in your organization. If allowed by applicable local legislation, ITX may also exchange information between ITX's affiliated (related) companies for the purposes mentioned in this Policy.
                                Because ITX is committed to protecting your privacy, ITX does not engage in the practice of selling or trading personal data to other companies for promotional purposes.

                                Usage of Subcontractors
                                We may use subcontractors to provide some products or services to you. We also may need to share your personal data with these subcontractors so that they can provide services to us. Our subcontractors are not permitted to use such personal data for any other purposes and we impose confidentiality requirements on their services.

                                Visitor Identification - Usage of "Cookies"
                                From time to time, information may be placed on your computer to improve this site and ITX's services for you. This information is commonly referred to as a "cookie", which many web sites use. Cookies are pieces of data stored on your computer's hard drive or browser, and not on this site. They typically enable collection of certain information about your computer, including your internet protocol address, your computer's operating system, your browser type and the address of any referring sites.
                                The use of cookies provides benefits to you, such as eliminating the need for you to enter your password frequently during a session, or, where applicable, re-enter items you place in a shopping cart from visit to visit if you do not finish a transaction on an earlier visit. By showing how and when our visitors use this site or other ITX sites, the use of cookies allows ITX to continue to improve the sites. If you do not wish to receive cookies, or want to be notified of when they are placed, you may set your web browser to do so, if your browser so permits. Please understand that if cookies are turned off, you may not be able to view certain parts of this site that may enhance your visit. Some of our business partners whose content is linked to or from this site may also use cookies. However, we have no access to or control over these cookies. This site also makes use of cookies for website traffic analysis and anonymous demographic profiling.

                                Security

                                ITX has endeavored to take commercially reasonable measures to prevent unauthorized access to and improper use of your personal data submitted to ITX via your use of this site. For example, ITX uses encryption technology when collecting financial personal data such as credit card information. If this site supports on-line transactions, it will use an industry standard security measure, such as the one available through "Secure Sockets Layer" ("SSL"), to protect the confidentiality and security of online transactions. If used, industry standard security measures like SSL authentication ensure that credit card information, as well as other personal data submitted as part of the buying process, is reasonably safe from third party interception.
                                While there are always risks associated with providing personal data, whether in person, by phone or via the internet or other technologies, and no system of technology is completely safe or "tamper"/"hacker" proof, ITX has endeavored to take reasonable precautions which are appropriate to the nature of the information to prevent and minimize such risks in connection with your use of this site.

                                Accuracy of Collected Data
                                ITX will on its own initiative, or at your request, free of charge, replenish, rectify or erase any incomplete, inaccurate or outdated personal data retained by ITX in connection with the operation of this site. Please consult the contact information posted below on this page, if any, or elsewhere on this site to determine how best to contact ITX to update and/or review your personal data and/or opt out of receiving marketing communications from ITX.

                                Minors
                                ITX's policy is to request that "Minors" (the age of Minors is determined by local law where you reside) do not make purchases or engage in other legal acts on this site without the consent of a parent or legal guardian, unless permitted by applicable local law.

                                External Links
                                This site may contain links to other sites. Please note that ITX is not responsible for the privacy practices or contents of any other sites. We recommend that you read the privacy policies of such sites.

                                Changes to this Policy
                                ITX may from time to time change this Policy or change, modify or withdraw access to this site at any time with or without notice. However, if this Policy is changed in a material, adverse way, ITX will post a notice advising of such change at the beginning of this Policy and on this site's home page for 30 days. We recommend that you re-visit this Policy from time to time to learn of any such changes to this Policy.
                                <br>
                                Copyright © ITX, 2019. All rights reserved.
                            </p>
                        </div>
                        <p style="margin-top: 20px;">
                            <b>Disclaimer</b>
                        </p>
                        <br>
                        <div class="card-body pre-scrollable" style="height: 200px; width: 100%;">
                            <p>
                                Acceptance of terms through use 
                                This web site is an electronic news and information service of ITX. You may print and keep a copy of this Agreement. By using this site, you signify your agreement to all terms, conditions, and notices contained or referenced herein (the "Terms of Use"). It is your responsibility to access this document whenever you visit this web site to determine if there have been any changes to the terms of the Terms of Use. If you do not agree to these Terms of Use please do not access or use this site. We reserve the right, at our discretion, to update or revise these Terms and Conditions of Use at any time. Please check the Terms periodically for changes. Your continued use of this site following the posting of any changes to the Terms of Use constitutes acceptance of those changes. 
                                <br>
                                Copyright 
                                All content included on this site, such as text, graphics, logos, button icons, images, and audio clips, digital downloads, data compilations, and software, is the property of ITX or its content suppliers and protected by Indonesia and international copyright laws. The compilation of all content on this site is the exclusive property of ITX and protected by Indonesia and international copyright laws. All software used on this site is the property of ITX or its software suppliers and protected by Indonesia and international copyright laws. 
                                <br>
                                Trademark 
                                ITX is a registered trademark of ITX in Indonesia and other countries. ITX trademark and trade dress may not be used in connection with any product or service that is likely to cause confusion among customers, or in any manner that disparages or discredits ITX. All other trademarks not owned by ITX or its subsidiaries that appear on this site are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by ITX or its subsidiaries. 
                                <br>
                                Proprietary rights 
                                You acknowledge and agree that all content and materials available on this site are protected by copyrights, trademarks, service marks, patents, trade secrets, or other proprietary rights and laws. Except as expressly authorized by ITX, you agree not to sell, license, rent, modify, distribute, copy, reproduce, transmit, publicly display, publicly perform, publish, adapt, edit, or create derivative works from such materials or content. Notwithstanding the above, you may print or download one copy of the materials or content on this site on any single computer for your personal, non-commercial use, provided you keep intact all copyright and other proprietary notices. Systematic retrieval of data or other content from this site to create or compile, directly or indirectly, a collection, compilation, database or directory without written permission from ITX is prohibited. In addition, use of the content or materials for any purpose not expressly permitted in these Terms of Use is prohibited. 
                                As noted above, reproduction, copying, or redistribution for commercial purposes of any materials or design elements on this site is strictly prohibited without the express written permission of ITX. 
                                <br>
                                User’s grant of limited license 
                                By posting or submitting content to this site, you: a) ITX and its affiliates and licensees the right to use (in whole or part), reproduce, display, perform, edit, publish, translate, create derivative works from, adapt, modify, distribute, have distributed, and promote the content in any form, anywhere and for any purpose; and b) warrant and represent that you own or otherwise control all of the rights to the content and that public posting and use of your content by ITX will not infringe or violate the rights of any third party. You also warrant that any «moral rights» in your material have been waived. 
                                <br>
                                Disclaimer of warranties 
                                ALL MATERIALS, INFORMATION, SOFTWARE, PRODUCTS, AND SERVICES INCLUDED IN OR AVAILABLE THROUGH THIS SITE (THE "CONTENT") ARE PROVIDED "AS IS" AND "AS AVAILABLE" FOR YOUR USE. THE SITE, INCLUDING, WITHOUT LIMITATION, ALL CONTENT, FUNCTIONS AND MATERIALS THEREON, IS PROVIDED "AS IS," WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, WITHOUT LIMITATION, ANY WARRANTY FOR INFORMATION, DATA, DATA PROCESSING SERVICES, OR UNINTERRUPTED ACCESS, ANY WARRANTIES CONCERNING THE AVAILABILITY, ACCURACY, USEFULNESS, OR CONTENT OF INFORMATION, AND ANY WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE. ITX DOES NOT WARRANT THAT THE SITE OR THE FUNCTIONS, FEATURES OR CONTENT CONTAINED THEREIN WILL BE TIMELY, SECURE, UNINTERRUPTED OR ERROR FREE, OR THAT DEFECTS WILL BE CORRECTED. ITX MAKES NO WARRANTY THAT THE SITE WILL MEET USERS' REQUIREMENTS. NO ADVICE, RESULTS OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM ITX OR THROUGH THE SITE SHALL CREATE ANY WARRANTY NOT EXPRESSLY MADE HEREIN. IF YOU ARE DISSATISFIED WITH THE SITE OR ANY CONTENT OR FUNCTION THEREON, YOUR SOLE REMEDY IS TO DISCONTINUE USING THE SITE. 
                                <br>
                                Limitation of liabilities 
                                UNDER NO CIRCUMSTANCES SHALL ITX OR ANY OF ITS DIRECTORS, OFFICERS, EMPLOYEES, AGENTS, AFFILIATES, SUBSIDIARIES OR ITS LICENSORS BE LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL, OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF OR INABILITY TO USE, THIS SITE. THIS LIMITATION APPLIES WHETHER THE ALLEGED LIABILITY IS BASED ON CONTRACT, TORT, NEGLIGENCE AND STRICT LIABILITY, INCLUDING, WITHOUT LIMITATION, LOSS OF REVENUE, OR ANTICIPATED PROFITS OR LOST BUSINESS OR LOST SALES, EVEN IF ITX HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. BECAUSE SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES, ITX’S LIABILITY IN SUCH JURISDICTIONS SHALL BE LIMITED TO THE EXTENT PERMITTED BY LAW. 
                                <br>
                                Indemnification 
                                Upon a request by ITX, you agree to defend, indemnify, and hold harmless ITX and its subsidiary and other affiliated companies, and their employees, contractors, officers, and directors from all liabilities, claims, and expenses, including attorney's fees that arise from your use or misuse of this site. ITX reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, in which event you will cooperate with ITX in asserting any available defenses. 
                                <br>
                                International use 
                                ITX makes no representation that materials on this site are appropriate or available for use in locations outside Indonesia, and accessing them from territories where their contents are illegal is prohibited. Those who choose to access this site from other locations do so on their own initiative and are responsible for compliance with local laws. 
                                <br>
                                Internet access 
                                You acknowledge and agree that in connection with your use of the Site you must: (a) provide for your own access to the World Wide Web and pay any service fees associated with such access, and (b) provide all equipment necessary for you to make such access and connection to the World Wide Web, including a computer, software, a modem and a means of connecting to or accessing the Internet. ITX shall not be responsible for any malfunctions, errors, crashes or other adverse events that may occur from your use of the Site. 
                                <br>
                                Third party sites 
                                This site may produce automated search results or otherwise link you to other sites on the Internet. These sites may contain information or material that some people may find inappropriate or offensive. These other sites are not under the control of ITX, and you acknowledge that ITX is not responsible or liable directly or indirectly for the accuracy, copyright compliance, legality, decency, or any other aspect of the content of such sites. The inclusion of such a link does not imply endorsement of the site by ITX or any association with its operators. 
                                Unsolicited Material 
                                Unless specifically requested, ITX does not solicit nor does it wish to receive any confidential, secret or proprietary information or other material from you through the Site, any of its services, by e-mail, or in any other way. 
                                <br>
                                Choice of law 
                                We control and operate this Site from our offices in Indonesia. Your use of this web site and all related rights and obligations, shall be governed by the Indonesia laws. Any legal action or proceeding with respect to this web site, related to these Terms and Conditions of use or any matter related thereto may be brought exclusively in the courts of Jakarta, Indonesia. By using this web site, you expressly agree and accept generally and unconditionally the jurisdiction of the aforesaid courts and irrevocably waive any objection to such jurisdiction. 
                                <br>
                                Termination 
                                ITX reserves the right, in its sole discretion, to terminate your access to all or part of this site, with or without notice. 
                                <br>
                                © Copyright by ITX 2019 - All rights reserved.
                            </p>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="form-group col-lg-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="terms">
                                    <label class="custom-control-label text-2" for="terms">I have read and agree to the <b> privacy policy </b> and <b>disclaimer</b> </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row col-lg-3">
                            <button type="submit" class="btn btn-primary btn-submit btn-modern pull-left" data-loading-text="Loading..."> Register </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
