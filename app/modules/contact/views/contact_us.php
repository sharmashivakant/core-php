 <section class="contact-page cta-sec">
            <div class="inner-sec">
               <div class="left-sec">
                  <img src="<?= _SITEDIR_; ?>public/images/map.png" alt="map">
               </div>
               <div data-wow-delay=".3s" class="right-sec wow fadeInUp">
                  <div class="right-inner">
                     <h2 class="main-title">
                        let’s <span>talk </span>   
                     </h2>  
                     <h5>Get in touch today</h5>
                    <form id="contact_form_page" class="contact-form-page">      
                        <div class="row">
                           <div class="col-lg-6 form-group">
                              <input class="form-control" type="text" name="name" placeholder="Name *" onKeyPress="return nameonly(event)">
                           </div>
                           <div class="col-lg-6 form-group">
                              <input class="form-control" type="email" name="email" placeholder="Email *" onKeyPress="return emailonly(event)">
                           </div>
                           <div class="col-lg-6 form-group">
                              <input class="form-control" type="tel" name="phone" minlength="8" maxlength="12" placeholder="Phone *" onKeyPress="return contactonly(event)">
                           </div>
                           <div class="col-lg-12 form-group">
                              <textarea class="form-control" placeholder="Message *" name="message" ></textarea>   
                               <input  type="hidden" name="contact_type" value="contact_form_page">
                           </div>
                           <div class="col-lg-12 form-group">   
                              <button class="cust-btn" type="submit" value="submit" onclick="load('contact/contact_us', 'form:#contact_form_page'); return false;">submit</button>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <div></div>
                     </form>
                     <div class="btm-sec">
                         <div class="social-icon">
                           <a href="javascript:void(0)"><i class="fab fa-twitter"></i></a>
                           <a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a>
                           <a href="javascript:void(0)"><i class="fab fa-instagram"></i></a>
                           </div>
                        <div class="adress-sec">
                           <div class="adress-left">
                              <p>50 Featherstone St,<br> London, EC1Y 8RT</p>
                           </div>
                           <div class="add-right">
                              <p><a href="mailto:ready@cititectalent.com">ready@cititectalent.com</a></p>
                              <p><a href="tel:0207 608 5858">0207 608 5858</a></p>
                              
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>