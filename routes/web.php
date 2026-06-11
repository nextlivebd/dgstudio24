<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/contact-us', [\App\Http\Controllers\Frontend\ContactController::class, 'submit'])->name('contact.submit');

// Pages
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about_us');
Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contact_us');

// Web Development
Route::get('/web-application-development', [FrontendController::class, 'webApplicationDevelopment'])->name('web_application_development');
Route::get('/digital-catalog-system', [FrontendController::class, 'digitalCatalogSystem'])->name('digital_catalog_system');
Route::get('/cms-banner-system', [FrontendController::class, 'cmsBannerSystem'])->name('cms_banner_system');
Route::get('/content-management-system', [FrontendController::class, 'contentManagementSystem'])->name('content_management_system');
Route::get('/website-maintenance', [FrontendController::class, 'websiteMaintenance'])->name('website_maintenance');
Route::get('/banner-order-system', [FrontendController::class, 'bannerOrderSystem'])->name('banner_order_system');

// Website Design
Route::get('/responsive-web-design', [FrontendController::class, 'responsiveWebDesign'])->name('responsive_web_design');
Route::get('/logo-design', [FrontendController::class, 'logoDesign'])->name('logo_design');
Route::get('/psdto-html5', [FrontendController::class, 'psdtoHtml5'])->name('psdto_html5');
Route::get('/psd-design', [FrontendController::class, 'psdDesign'])->name('psd_design');

// Ecommerce Development
Route::get('/wordpress-woocommerce', [FrontendController::class, 'wordpressWoocommerce'])->name('wordpress_woocommerce');
Route::get('/joomla-virtueMart', [FrontendController::class, 'joomlaVirtuemart'])->name('joomla_virtuemart');
Route::get('/magento-ecommerce', [FrontendController::class, 'magentoEcommerce'])->name('magento_ecommerce');
Route::get('/opencart-ecommerce', [FrontendController::class, 'opencartEcommerce'])->name('opencart_ecommerce');

// Payment Gateway Solutions
Route::get('/paypal-integration', [FrontendController::class, 'paypalIntegration'])->name('paypal_integration');
Route::get('/DIBS-integration', [FrontendController::class, 'dibsIntegration'])->name('dibs_integration');
Route::get('/local-payment-getway-integration', [FrontendController::class, 'localPaymentGetwayIntegration'])->name('local_payment_getway_integration');

// CMS Extensions
Route::get('/wordpress-plugin-development', [FrontendController::class, 'wordpressPluginDevelopment'])->name('wordpress_plugin_development');
Route::get('/joomla-module-development', [FrontendController::class, 'joomlaModuleDevelopment'])->name('joomla_module_development');
Route::get('/joomla-plugin-development', [FrontendController::class, 'joomlaPluginDevelopment'])->name('joomla_plugin_development');
Route::get('/joomla-component-development', [FrontendController::class, 'joomlaComponentDevelopment'])->name('joomla_component_development');

// Banner Production
Route::get('/banner-design', [FrontendController::class, 'bannerDesign'])->name('banner_design');
Route::get('/html5-banner-development', [FrontendController::class, 'html5BannerDevelopment'])->name('html5_banner_development');
Route::get('/cms-banner-development', [FrontendController::class, 'cmsBannerDevelopment'])->name('cms_banner_development');
Route::get('/flash-banner-development', [FrontendController::class, 'flashBannerDevelopment'])->name('flash_banner_development');
Route::get('/gif-banner-development', [FrontendController::class, 'gifBannerDevelopment'])->name('gif_banner_development');
Route::get('/static-banner-development', [FrontendController::class, 'staticBannerDevelopment'])->name('static_banner_development');

// 3D Production
Route::get('/3D-production', [FrontendController::class, 'threeDProduction'])->name('3d_production');
Route::get('/3d-model', [FrontendController::class, 'threeDModel'])->name('3d_model');
Route::get('/ar-model-visualization', [FrontendController::class, 'arModelVisualization'])->name('ar_model_visualization');

// Image Production
Route::get('/clipping-path', [FrontendController::class, 'clippingPath'])->name('clipping_path');
Route::get('/multi-layer-clipping-element-masking', [FrontendController::class, 'multiLayerClippingElementMasking'])->name('multi_layer_clipping_element_masking');
Route::get('/image-manipulation', [FrontendController::class, 'imageManipulation'])->name('image_manipulation');
Route::get('/background-removal', [FrontendController::class, 'backgroundRemoval'])->name('background_removal');
Route::get('/shadows', [FrontendController::class, 'shadows'])->name('shadows');
Route::get('/vectorizing-raster-to-vector-conversion', [FrontendController::class, 'vectorizingRasterToVectorConversion'])->name('vectorizing_raster_to_vector_conversion');

// Page Production
Route::get('/newspaper-advertisement', [FrontendController::class, 'newspaperAdvertisement'])->name('newspaper_advertisement');
Route::get('/magazine-design-language-conversion', [FrontendController::class, 'magazineDesignLanguageConversion'])->name('magazine_design_language_conversion');

// Quick Links
Route::get('/why-shehala-it-limited', [FrontendController::class, 'whyShehalaItLimited'])->name('why_shehala_it_limited');
Route::get('/code-of-conduct', [FrontendController::class, 'codeOfConduct'])->name('code_of_conduct');
Route::get('/our-mission', [FrontendController::class, 'ourMission'])->name('our_mission');
Route::get('/hse-policy', [FrontendController::class, 'hsePolicy'])->name('hse_policy');
Route::get('/development-life-cycle', [FrontendController::class, 'developmentLifeCycle'])->name('development_life_cycle');
Route::get('/offshore-development-centre', [FrontendController::class, 'offshoreDevelopmentCentre'])->name('offshore_development_centre');
Route::get('/technology-expertise', [FrontendController::class, 'technologyExpertise'])->name('technology_expertise');
