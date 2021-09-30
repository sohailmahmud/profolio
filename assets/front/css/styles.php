<?php
header("Content-type: text/css; charset: UTF-8");

if(isset($_GET['color']))
{
  $color = '#'.htmlspecialchars($_GET['color']);
}
else {
  $color = "'" . htmlspecialchars($color) . "'";
}
?>

.main-btn.main-btn-2 {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.navigation .navbar .navbar-btns .header-times i {
    color:<?php echo htmlspecialchars($color); ?>;
}

.navigation .navbar .navbar-nav .nav-item a:hover {
    color:<?php echo htmlspecialchars($color); ?>;
}

.navigation .navbar .navbar-nav .nav-item .sub-menu > li:hover > a {
    background-color: <?php echo htmlspecialchars($color); ?>;
}

.infos span i {
    color:<?php echo htmlspecialchars($color); ?>;
}

.links a:hover {
    color:<?php echo htmlspecialchars($color); ?>;
}

ul.language-dropdown li a::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.main-btn:hover {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.fress-area .single-fress:hover a {
    color:<?php echo htmlspecialchars($color); ?>;
}

.fress-area .single-fress::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.section-title span {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area .tabs-btn ul li a.active p {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn span {
    color:<?php echo htmlspecialchars($color); ?>;
}

.menu-price-btn del {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn a::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.food-menu-area .food-menu-items .single-menu-item .menu-price-btn a::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}

.client-area .client-items .single-client .client-info .item-1 span {
    color:<?php echo htmlspecialchars($color); ?>;
}
.client-area .client-items .single-client .text p::before {
    color:<?php echo htmlspecialchars($color); ?>;
}

.client-area .client-items .single-client .text p::after {
    color:<?php echo htmlspecialchars($color); ?>;
}

.client-area .client-items .single-client .client-info .item-2 ul li {
    color:<?php echo htmlspecialchars($color); ?>;
}

.blog-area .blog-content a .title:hover {
    color:<?php echo htmlspecialchars($color); ?>;
}

.blog-area .blog-content .blog-comments a::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.blog-area .blog-content .blog-comments a::before {
    background: <?php echo htmlspecialchars($color); ?>;
}
.blog-area .blog-content .blog-comments a::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}
.reservation-area .reservation-item .book-table .input-box button {
    background: <?php echo htmlspecialchars($color); ?>;
}

.footer-area.footer-area-2 .footer-widget-1 .header-times i {
    color:<?php echo htmlspecialchars($color); ?>;
}

.go-top-area .go-top::before {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.go-top-btn::after {
    background: <?php echo htmlspecialchars($color); ?>;
}

.go-top-area .go-top {
    background-color: <?php echo htmlspecialchars($color); ?>;
}

.page-title-area .page-title-item nav ol li {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area.food-menu-3-area .tabs-btn .nav li a.active p {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a {
    color:<?php echo htmlspecialchars($color); ?>;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::after {
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.shop-search i {
    color: <?php echo htmlspecialchars($color); ?>;
}

.shop-sidebar .shop-box .sidebar-title .title::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

.shop-sidebar .shop-box .sidebar-title .title::after {
    background: <?php echo htmlspecialchars($color); ?>;
}

li.active-search a {
    color: <?php echo htmlspecialchars($color); ?> !important;
}

.pricing-area .single-pricing span {
    color: <?php echo htmlspecialchars($color); ?>;
}

.pricing-area .single-pricing a.main-btn:hover {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.ui-slider-horizontal .ui-slider-range {
    background: <?php echo htmlspecialchars($color); ?>;
}

button.filter-button {
    background-color: <?php echo htmlspecialchars($color); ?>;
}

.gallery-area .single-gallery .gallery-overlay a {
    background: <?php echo htmlspecialchars($color); ?>;
}

.blog-details-area .blog-sidebar .blog-box .blog-cat-list ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}

.single-form button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}

.single-form button:hover::before {
    background: <?php echo htmlspecialchars($color); ?>;
}

button:hover::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}

.single-form button:hover::after {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}

.menu-contents .menu-tabs .nav li a.active {
    background: <?php echo htmlspecialchars($color); ?>;
}

.shop-details-area .shop-content .shop-btns a {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color:  <?php echo htmlspecialchars($color); ?>;
}
.cart-area .cart-table tbody .available-info .icon {
    background: <?php echo htmlspecialchars($color); ?>;
}
.cart-middle .update-cart button {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
    background: <?php echo htmlspecialchars($color); ?>;
}

.cart-area .cart-table tbody tr td .remove span:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}

.login-area .login-content .input-btn button {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.login-area .login-content .input-btn button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}

.login-area .login-content .input-btn a {
    color: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .user-sidebar .links li a.active {
    color: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .main-table .dataTables_wrapper td a.btn {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}
.user-dashbord .main-table .dataTables_wrapper td a.btn:hover {
    background: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .user-profile-details .order-details .progress-area-step .progress-steps li.active .icon {
    background: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .view-order-page .order-info-area .prinit .btn {
    background: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .user-sidebar .links li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.user-dashbord .user-profile-details .edit-info-area .file-upload-area span {
    background: <?php echo htmlspecialchars($color); ?>;
}

.user-dashbord .user-profile-details .edit-info-area .btn {
    background: <?php echo htmlspecialchars($color); ?>;
}

.placeorder-button .main-btn {
    border-color: <?php echo htmlspecialchars($color); ?>;
}

.revolve .round {

    background-color: <?php echo htmlspecialchars($color); ?>;
    border-top-color: <?php echo htmlspecialchars($color); ?>;
    border-right-color: <?php echo htmlspecialchars($color); ?>;
}

.banner-slide-3 .slick-arrow, .banner-slide-2 .slick-arrow, .banner-slide .slick-arrow {
    border: 2px solid <?php echo htmlspecialchars($color); ?>;
}
.banner-slide-3 .slick-arrow:hover, .banner-slide-2 .slick-arrow:hover, .banner-slide .slick-arrow:hover {
    background: <?php echo htmlspecialchars($color); ?>;
}
.experience-area .experience-contact {
    background: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .good-food-item a.title {
    color: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .good-food-item a {
    background: <?php echo htmlspecialchars($color); ?>;
}
.good-food-area .special-items .slick-arrow {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-1 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.navigation .cart span {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.navigation .cart a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.links ul.social-links li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-2 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.footer-area .footer-widget-3 ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.pagination-part nav .pagination li a:hover {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.page-item.active .page-link {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-box ul li a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-btn button {
    background: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.menu-contents .menu-tabs .tab-content .tab-pane .shop-review-area .shop-review-form .input-btn button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.main-btn.main-btn-2.proceed-checkout-btn:hover {
    color: <?php echo htmlspecialchars($color); ?>;
    border: 2px solid <?php echo htmlspecialchars($color); ?>;
}
.cart-middle .update-cart button:hover {
    color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}
form.subscribe-form button {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
h3.subscribe-title::before {
    background: <?php echo htmlspecialchars($color); ?>;
}
h3.subscribe-title::after {
    background: <?php echo htmlspecialchars($color); ?>;
}
.faq-section .accordion .card .card-header .btn:hover {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.faq-section .accordion .card .card-header .btn[aria-expanded="true"] {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
.single-job a.title {
    color: <?php echo htmlspecialchars($color); ?>;
}

.single-job strong i {
    color: <?php echo htmlspecialchars($color); ?>;
}
.job-details h3 {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li a::after {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li a:hover {
    color: <?php echo htmlspecialchars($color); ?>;
}
.category-lists ul li.active a {
    color: <?php echo htmlspecialchars($color); ?>;
}
#variationModal .btn-primary {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .form-check span {
    color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .modal-title small {
    color: <?php echo htmlspecialchars($color); ?>;
}
.modal-quantity span {
    color: <?php echo htmlspecialchars($color); ?>;
}
button.cookie-consent__agree {
    background-color: <?php echo htmlspecialchars($color); ?>;
}