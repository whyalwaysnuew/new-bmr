<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }
    // $query = "";
    // $urlcrud
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <base href=""/>
		<title>Dashboard | BMR Calculator</title>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="BMR Calculator" />
		<meta property="og:url" content="index.php" />
		<meta property="og:site_name" content="BMR Calculator" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<!-- <link href="public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" /> -->
		<link href="public/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="public/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="public/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-tablet-and-mobile-fixed">
		
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header bg-dark">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-stack">
							<!--begin::Brand-->
							<div class="d-flex align-items-center me-5">
								<!--begin::Aside toggle-->
								<div class="d-lg-none btn btn-icon btn-active-color-white w-30px h-30px ms-n2 me-3" id="kt_aside_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
								<!--end::Aside  toggle-->
							</div>
							<!--end::Brand-->
							<!--begin::Topbar-->
							<div class="d-flex align-items-center flex-shrink-0">

								<!--begin::User-->
								<div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
									<!--begin::User info-->
									<div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<!--begin::Name-->
										<div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
											<span class="text-white fs-5 fw-semibold lh-1 mb-1"><?= $_SESSION['name'] ?></span>
											<span class="text-white fs-5 fw-bold lh-1"></span>
										</div>
										<!--end::Name-->
										<!--begin::Symbol-->
										<div class="symbol symbol-30px symbol-md-40px">
											<img src="public/assets/img/user-blank.png" alt="image" />
										</div>
										<!--end::Symbol-->
									</div>
									<!--end::User info-->
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="public/assets/img/user-blank.png" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">Velove Vexia</div>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="logout.php" class="menu-link fw-bold px-5 text-danger">
											<span class="svg-icon svg-icon-danger svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="currentColor"/>
												<path d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z" fill="currentColor"/>
												<path opacity="0.5" d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z" fill="currentColor"/>
												</svg>
											</span>&nbsp;&nbsp;Sign Out</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
								</div>
								<!--end::User -->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content wrapper-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Aside-->
						<div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
							<!--begin::Aside menu-->
							<div class="aside-menu flex-column-fluid px-4">
								<!--begin::Aside Menu-->
								<div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_footer', lg: '#kt_header, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{default: '5px', lg: '75px'}">
									<!--begin::Menu-->
									<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_aside_menu" data-kt-menu="true">
                                        <!--begin:Menu item-->
                                        <div class="menu-item pt-5">
                                            <!--begin:Menu content-->
                                            <div class="menu-content">
                                                <span class="menu-heading fw-bold text-uppercase fs-7">Main</span>
                                            </div>
                                            <!--end:Menu content-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="<?= base_url('/'); ?>">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.5 11C8.98528 11 11 8.98528 11 6.5C11 4.01472 8.98528 2 6.5 2C4.01472 2 2 4.01472 2 6.5C2 8.98528 4.01472 11 6.5 11Z" fill="currentColor"/>
                                                            <path opacity="0.3" d="M13 6.5C13 4 15 2 17.5 2C20 2 22 4 22 6.5C22 9 20 11 17.5 11C15 11 13 9 13 6.5ZM6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22ZM17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22Z" fill="currentColor"/>
                                                        </svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Dashboard</span>
											</a>
										</div>

										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="bmi.php">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="currentColor"/>
															<path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="currentColor"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Basal Metabolic Rate</span>
											</a>
										</div>

										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="calorie-consumption.php">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="currentColor"/>
															<path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="currentColor"/>
															<path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="currentColor"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Calorie Consumption</span>
											</a>
										</div>

										
										<div class="menu-item pt-5">
											<!--begin:Menu content-->
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">Data Master</span>
											</div>
											<!--end:Menu content-->
										</div>

										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="physical-activity.php">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
															<path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Physical Activity</span>
											</a>
										</div>

										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="activity-level.php">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M8.4 14L15.6 8.79999L20 9.90002V6L16 4L9 11L5 12V14H8.4Z" fill="currentColor"/>
															<path d="M21 18H20V12L16 11L9 16H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z" fill="currentColor"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Activity Level</span>
											</a>
										</div>

										<div class="menu-item">
											<a class="menu-link text-hover-dark" href="consumption.php">
												<span class="menu-icon">
													<!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
													<span class="svg-icon svg-icon-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M15.0082 5.05202C15.5082 4.45202 15.9082 3.65207 16.0082 2.85207C16.1082 2.25207 15.5082 1.85202 15.0082 2.05202C14.2082 2.35202 13.5082 2.85205 12.9082 3.45205C12.4082 4.05205 12.0082 4.8521 11.9082 5.7521C11.9082 6.2521 12.4082 6.65205 12.8082 6.45205C13.7082 6.35205 14.5082 5.75202 15.0082 5.05202Z" fill="currentColor"/>
															<path opacity="0.3" d="M18.4082 10.0519C18.8082 9.65195 18.8082 8.95195 18.3082 8.55195C17.6082 8.05195 16.8082 7.65195 15.9082 7.55195C14.6082 7.45195 13.5082 8.35199 12.2082 8.35199C11.0082 8.35199 10.1082 7.55195 8.70818 7.55195C7.30818 7.55195 5.80818 8.45197 4.80818 9.95197C3.50818 12.052 3.70818 15.952 5.90818 19.352C6.70818 20.552 7.70818 21.852 9.10818 21.952C10.3082 21.952 10.7082 21.152 12.3082 21.152C13.9082 21.152 14.3082 21.952 15.5082 21.952C16.9082 21.952 18.0082 20.452 18.7082 19.252C19.1082 18.652 19.3082 18.352 19.5082 17.852C19.7082 17.452 19.5082 16.852 19.1082 16.652C16.8082 15.052 16.5082 11.8519 18.4082 10.0519Z" fill="currentColor"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
												<span class="menu-title fw-bold">Consumption</span>
											</a>
										</div>

						
									</div>
									<!--end::Menu-->
								</div>
							</div>
							<!--end::Aside menu-->
						</div>
						<!--end::Aside-->

                        <!--begin::Container-->
                        <div class="d-flex flex-column flex-column-fluid container-fluid">
                            <!--begin::Toolbar-->
                            <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column me-3">
                                    <!--begin::Title-->
                                    <h1 class="d-flex text-dark fw-bold my-1 fs-1">Dashboard</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Page title-->

                            </div>
                            <!--end::Toolbar-->

                            <?php if(isset($_GET['page'])){
                                $page = $_GET['page'] ?? 'dashboard';

                                switch ($page) {
                                    case 'dashboard':
                                        include "dashboard.php";
                                        break;
                                    case 'bmr':
                                        include "bmr.php";
                                        break;
                                    case 'consumption':
                                        include "consumption.php";
                                        break;
                                    case 'activity-level':
                                        include "activity-level.php";
                                    break;
                                }
                            } else {
                                include "dashboard.php";
                            }?>

                            <!--begin::Footer-->
							<div class="footer py-4 d-flex flex-column flex-md-row flex-stack" id="kt_footer">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-bold me-1">2024&copy;</span>
									<a href="#" target="_blank" class="text-gray-800 fw-bold text-hover-primary">Gian Pranata - BMI Calculator</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-800 menu-hover-primary fw-semibold order-1">
									<li class="menu-item">
										<!-- <span class="fw-bold menu-link px-2">Handcrafted and made with ❤️</span> -->
									</li>
								</ul>
								<!--end::Menu-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end::Container-->
                    </div>
					<!--end::Content wrapper-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>
            var hostUrl = "public/assets/";
        </script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="public/assets/plugins/global/plugins.bundle.js"></script>
		<script src="public/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="public/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="public/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<script src="public/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>

		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
        <script>var base_url = 'localhost/bmr-calculator';</script>

		<script src="public/assets/canvasjs/jquery.canvasjs.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		
		<?php if(@$ajax) { ?>
			<script src="public/assets/js/own-script/ajax/<?= @$ajax . '.js'; ?>"></script>
		<?php } ?>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>