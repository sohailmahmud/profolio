<?php
header("Content-Type:text/css");
$color = $_GET['color']; // Change your Color Here

if (isset($_GET['color']) and $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

?>
.section-title-one span.span{
color: <?php echo htmlspecialchars($color); ?>;
}
.section-title-one span.span:before{
background: <?php echo htmlspecialchars($color); ?>;
}
.section-title-one span.span:after{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-features .features-item i{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-blog .blog-item .entry-content a.read-btn{
color: <?php echo htmlspecialchars($color); ?>;
}
.back-to-top{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-footer .footer-widget .widget.newsletter-widget form .form_gorup .newsletter-btn {
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-blog .blog-item .entry-content .entry-meta ul li span i {
color: <?php echo htmlspecialchars($color); ?>;
}
.main-btn{
background: <?php echo htmlspecialchars($color); ?>;
}
.main-btn:hover, .main-btn:focus{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-pricing .pricing-item .title h2.price{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-pricing .pricing-tabs .nav-tabs .nav-link.active{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-featured-users .user-item .user-button ul li .main-btn:hover{
border-color: <?php echo htmlspecialchars($color); ?>;
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-footer .footer-widget .widget.newsletter-widget .social-link li a{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-footer .footer-widget .widget.useful-link-widget ul.widget-link li a:hover{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-footer .footer-widget .widget.about-widget p.info a:hover{
 color: <?php echo htmlspecialchars($color); ?>;
}
.contacts-section .contact-form form .form_group .form_control:focus{
border-color: <?php echo htmlspecialchars($color); ?>;
}
.contacts-section .contact-information .info-box ul.info-box-list li .contact-info-title{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-blog .blog-item .entry-content a.read-btn{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-blog .blog-item .entry-content h3:hover, .saas-blog .blog-item .entry-content h3:focus{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-blog .blog-item .entry-content .entry-meta ul li span i{
color: <?php echo htmlspecialchars($color); ?>;
}
.single_input_check:after {
background: <?php echo htmlspecialchars($color); ?>;
}
.single_radio .single_input:checked + .single_input_label:before, .single_checkbox .single_input:checked + .single_input_label:before{
border-color: <?php echo htmlspecialchars($color); ?>;
}
.saas-pagination ul li a:hover, .saas-pagination ul li a:focus, .saas-pagination ul li a.active{
background: <?php echo htmlspecialchars($color); ?>;
}
.user-form-section .user-form form .form_group .main-btn{
background: <?php echo htmlspecialchars($color); ?>;
}
.user-form-section .user-form form .form_group p a{
color: <?php echo htmlspecialchars($color); ?>;
}
<!--.user-form-section .user-form form .form_group .form_control{-->
<!--border: --><?php //echo htmlspecialchars($color); ?><!--;-->
<!--}-->
.faqs-section .faq-sidebar .widget.contact-widget form .main-btn{
background: <?php echo htmlspecialchars($color); ?>;
}
.faqs-section .faq-sidebar .widget.contact-widget form .form_group i {
color: <?php echo htmlspecialchars($color); ?>;
}
.faqs-section .faq-sidebar .widget.contact-widget form .form_group .form_control {
border: <?php echo htmlspecialchars($color); ?>;
}
.faqs-section .faq-wrapper .faq-title p{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-pricing .pricing-item .title h2.price{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-pricing .pricing-tabs .nav-tabs .nav-link.active{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-featured-users .user-item .user-button ul li .main-btn:hover {
border-color: <?php echo htmlspecialchars($color); ?>;
}
.saas-project .work-item .work-img a.count{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-features .features-item i{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-analysis .choose-content-box ul.list li:before{
color: <?php echo htmlspecialchars($color); ?>;
}
.breadcrumbs-section .breadcrumbs-content ul.breadcrumbs-link li a{
color: <?php echo htmlspecialchars($color); ?>;
}
.saas-banner .hero-content ul li .video-popup{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-banner .hero-content span.span:after{
background: <?php echo htmlspecialchars($color); ?>;
}
.saas-banner .hero-content span.span{
color: <?php echo htmlspecialchars($color); ?>;
}
.header-navigation .navbar-close{
background: <?php echo htmlspecialchars($color); ?>;
}
.header-navigation .navbar-toggler span{
background-color:<?php echo htmlspecialchars($color); ?>;
}
.header-navigation .nav-container .main-menu ul li:hover > a {
color: <?php echo htmlspecialchars($color); ?>;
}
.header-navigation .nav-container .main-menu ul li .sub-menu li a:hover{
background-color:<?php echo htmlspecialchars($color); ?>;
}
.header-navigation .nav-container .nav-push-item .navbar-btn .main-btn.active-btn{
background: <?php echo htmlspecialchars($color); ?>;
}
.lds-ellipsis span{
background: <?php echo htmlspecialchars($color); ?>;
}
.page-item.active .page-link{
background: <?php echo htmlspecialchars($color) ?>;
border: <?php echo htmlspecialchars($color) ?>;
}
.page-link{
color: <?php echo htmlspecialchars($color); ?>;    
}
.page-link:hover{
color: <?php echo htmlspecialchars($color); ?>;
}
.payment_header {
    background: <?php echo htmlspecialchars($color); ?>;
}
.content a {
    background: <?php echo htmlspecialchars($color); ?>;
}
.content a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.saas-featured-users .user-item .social-box ul.social-link li a.facebook {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
    color: <?php echo htmlspecialchars($color) ?>;
}
.blog-cat-list li.active {
    color: <?php echo htmlspecialchars($color) ?>;
}
.saas-banner .hero-content ul li .video-popup:after {
    background: <?php echo htmlspecialchars($color) . '8a' ?>;
}
.base-color {
    color: <?php echo htmlspecialchars($color) ?>;
}
.saas-footer .footer-widget .widget.newsletter-widget .social-link li a.facebook {
    background: <?php echo htmlspecialchars($color) ?>;
}
.error-txt a {
    background-color: <?php echo htmlspecialchars($color) ?>;
    border: 1px solid <?php echo htmlspecialchars($color) ?>;
}
.error-txt a:hover {
    color: <?php echo htmlspecialchars($color) ?>;
}