<?php
header("Content-type: text/css; charset: UTF-8");

if(isset($_GET['color']))
{
  $color = '#'.$_GET['color'];
}
else {
  $color = "'" . $color . "'";
}
?>

.main-btn {
    background: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-aside .menu-wrapper .primary-menu .main-menu li.active a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.nav-toggole {
    background: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-aside .menu-wrapper::-webkit-scrollbar-thumb {
    background: <?php echo htmlspecialchars($color); ?>;
}
.section-title span.span {
    color: <?php echo htmlspecialchars($color); ?>;
    background: <?php echo htmlspecialchars($color) . '1a'; ?>;
}
.vaughn-experience .box ul.list li i {
    color: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-work .work-filter .work-btn.active-btn {
    background: <?php echo htmlspecialchars($color); ?>;
}
.back-to-top {
    background: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-blog .blog-item .entry-content .entry-meta ul li span i {
    color: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-blog .blog-item .entry-content .entry-meta ul li span:hover, .vaughn-blog .blog-item .entry-content .entry-meta ul li span:focus {
    color: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-blog .blog-item .entry-content h3.title:hover, .vaughn-blog .blog-item .entry-content h3.title:focus {
    color: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-contact .contact-wrapper form.contact-form .main-btn:hover, .vaughn-contact .contact-wrapper form.contact-form .main-btn:focus,.vaughn-contact .contact-wrapper form.contact-form .main-btn, .vaughn-contact .contact-wrapper form.contact-form .main-btn {
    background: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-experience .box .title .icon {
    background: <?php echo htmlspecialchars($color) . '1a'; ?>;
    color: <?php echo htmlspecialchars($color); ?>;
}
.hero-section .hero-wrapper .hero-content ul.social-link li a:hover, .hero-section .hero-wrapper .hero-content ul.social-link li a:focus {
    background: <?php echo htmlspecialchars($color); ?>;
}
.vaughn-footer .footer-content .social-link li a {
    background: <?php echo htmlspecialchars($color); ?>;
}
.single-page-details .single-page-wrapper .post-item .post-gallery-slider .slick-arrow {
    background: <?php echo htmlspecialchars($color); ?>;
}
.sidebar-widget-area .widget.categories-widget ul.widget-link li.active a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.page-item.active .page-link {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.page-link {
    color: <?php echo htmlspecialchars($color); ?>;
}
.breadcrumbs-area .breadcrumbs-wrapper .bredcumbs-link ul li.active {
    color: <?php echo htmlspecialchars($color); ?>;
}
.hero-section .hero-wrapper .hero-content .main-btn {
    background: <?php echo htmlspecialchars($color); ?>;
}