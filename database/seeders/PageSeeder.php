<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutUsContent = <<<'HTML'
<div class="about-bg" style="background-image: url('/uploads/settings/aboutbg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="title-box text-center">
                        <div class="page-title-heading">
                            <h1 class="title">About Us</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="/"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span>About Us</span>
                        </div>  
                    </div>
                </div>  
            </div>  
        </div>                      
    </div>
</div>

<div class="site-main">
    <section class="ttm-row aboutus-section clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title with-desc clearfix">
                        <div class="title-header">
                            <h5>About us</h5>
                            <h2 class="title">We are here to Web Solution with 19 years of <span>experience</span></h2>
                        </div>
                        <div class="title-desc">
                            <p>Shehala IT is one of the fastest growing and forward thinking IT solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Denmark, Norway, Germeny, Sweden), North America and Japan since 2006. We have a successful track record in serving our customers across the globe with vast experience in technical domain such as ASP .Net, C#, Java, PHP, iOS, Android. We have global presence in different time zones. We use latest technology and software for Web, e-commerce, Mobile Technology and Print Media.</p>
                        </div>
                    </div>
                    <p class="mb-0"><b>Shehala IT grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering client satisfaction.</b></p>
                    <a href="/portfolio" class="ttm-btn ttm-btn-bgcolor-skincolor ttm-btn-size-md mt-35">PORTFOLIO</a>
                </div>
            </div>
        </div>
    </section>

    <section class="ttm-row zero-padding-section ttm-bgcolor-white clearfix">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="ttm-bgcolor-grey ttm-bg ttm-col-bgcolor-yes ttm-left-span spacing-7 position-relative z-1">
                        <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                            <div class="ttm-bg-layer-inner"></div>
                        </div>
                        <div class="layer-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ttm_single_image-wrapper">
                                        <iframe width="100%" height="675px" src="https://www.youtube.com/embed/9fidoaaOn_4" frameborder="0" allowfullscreen=""></iframe>
                                    </div>
                                    <div class="about-overlay-02">
                                        <h3>19 Years of</h3>
                                        <p>Web Business Experience</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="res-991-mt-30">
                                        <div class="section-title with-desc clearfix">
                                            <div class="title-header">
                                                <h5>About Shehala IT</h5>
                                                <h2 class="title">Shehala IT grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering <span>client satisfaction.</span></h2>
                                            </div>
                                            <div class="title-desc">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="mt-30">
                                            <div class="ttm-progress-bar" data-percent="95%">
                                                <div class="progress-bar-title">UI/UX Design</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="95">95%</div>
                                            </div>
                                            <div class="ttm-progress-bar" data-percent="95%">
                                                <div class="progress-bar-title">Web/CMS Design</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="95">95%</div>
                                            </div>
                                            <div class="ttm-progress-bar" data-percent="90%">
                                                <div class="progress-bar-title">Web Application Development</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="90">90%</div>
                                            </div>
                                            <div class="ttm-progress-bar" data-percent="95%">
                                                <div class="progress-bar-title">Banner Production</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="95">95%</div>
                                            </div>
                                            <div class="ttm-progress-bar" data-percent="98%">
                                                <div class="progress-bar-title">Image Production</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="98">98%</div>
                                            </div>
                                            <div class="ttm-progress-bar" data-percent="95%">
                                                <div class="progress-bar-title">Page Production</div>
                                                <div class="progress-bar-inner">
                                                    <div class="progress-bar progress-bar-color-bar_skincolor"></div>
                                                </div>
                                                <div class="progress-bar-percent" data-percentage="95">95%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ttm-row fid-section ttm-bgcolor-darkgrey ttm-bg ttm-bgimage-yes bg-img10 mt_225 res-991-mt-0 clearfix">
        <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="ttm-fid inside ttm-fid-view-topicon">
                        <div class="ttm-fid-icon-wrapper">
                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-lg">
                                <i class="flaticon flaticon-online-library"></i>
                            </div>
                        </div>
                        <div class="ttm-fid-contents">
                            <h4><span data-appear-animation="animateDigits" data-from="0" data-to="25" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">458</span></h4>
                            <h3 class="ttm-fid-title">Markets</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="ttm-fid inside ttm-fid-view-topicon">
                        <div class="ttm-fid-icon-wrapper">
                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-lg">
                                <i class="flaticon flaticon-developer"></i>
                            </div>
                        </div>
                        <div class="ttm-fid-contents">
                            <h4><span data-appear-animation="animateDigits" data-from="0" data-to="90" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">954</span></h4>
                            <h3 class="ttm-fid-title">FTE</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="ttm-fid inside ttm-fid-view-topicon">
                        <div class="ttm-fid-icon-wrapper">
                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-lg">
                                <i class="flaticon flaticon-24h"></i>
                            </div>
                        </div>
                        <div class="ttm-fid-contents">
                            <h4><span data-appear-animation="animateDigits" data-from="0" data-to="13214" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">897</span></h4>
                            <h3 class="ttm-fid-title">Jobs Completed</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="ttm-fid inside ttm-fid-view-topicon">
                        <div class="ttm-fid-icon-wrapper">
                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-lg">
                                <i class="flaticon flaticon-report"></i>
                            </div>
                        </div>
                        <div class="ttm-fid-contents">
                            <h4><span data-appear-animation="animateDigits" data-from="0" data-to="323510" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">785</span></h4>
                            <h3 class="ttm-fid-title">Deliverables</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
HTML;

        $privacyContent = <<<'HTML'
<div class="about-bg" style="background-image: url('/uploads/settings/aboutbg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="title-box text-center">
                        <div class="page-title-heading">
                            <h1 class="title">Privacy Policy</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="/"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span>Privacy Policy</span>
                        </div>  
                    </div>
                </div>  
            </div>  
        </div>                      
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">Privacy Policy</h2>
            <p class="text-muted">Last updated: June 15, 2026</p>
            <hr class="mb-4">
            <p>Your privacy is important to us. It is our policy to respect your privacy regarding any information we may collect from you across our website. We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent.</p>
            <p>We only retain collected information for as long as necessary to provide you with your requested service. What data we store, we'll protect within commercially acceptable means to prevent loss and theft, as well as unauthorized access, disclosure, copying, use or modification.</p>
            <p>We don't share any personally identifying information publicly or with third-parties, except when required to by law.</p>
            <p>Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot accept responsibility or liability for their respective privacy policies.</p>
            <p>You are free to refuse our request for your personal information, with the understanding that we may be unable to provide you with some of your desired services.</p>
            <p>Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information. If you have any questions about how we handle user data and personal information, feel free to contact us.</p>
        </div>
    </div>
</div>
HTML;

        $termsContent = <<<'HTML'
<div class="about-bg" style="background-image: url('/uploads/settings/aboutbg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="title-box text-center">
                        <div class="page-title-heading">
                            <h1 class="title">Terms & Conditions</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="/"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span>Terms & Conditions</span>
                        </div>  
                    </div>
                </div>  
            </div>  
        </div>                      
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">Terms & Conditions</h2>
            <p class="text-muted">Last updated: June 15, 2026</p>
            <hr class="mb-4">
            <h4>1. Agreement to Terms</h4>
            <p>By accessing our website, you agree to be bound by these terms and conditions, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site.</p>
            
            <h4 class="mt-4">2. Use License</h4>
            <p>Permission is granted to temporarily download one copy of the materials (information or software) on our website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.</p>
            
            <h4 class="mt-4">3. Disclaimer</h4>
            <p>The materials on our website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
            
            <h4 class="mt-4">4. Limitations</h4>
            <p>In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on our website.</p>
        </div>
    </div>
</div>
HTML;

        // Seed or Update the dynamic pages
        Page::updateOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us',
                'content' => $aboutUsContent,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'privacy-policy'],
            [
                'title' => 'Privacy Policy',
                'content' => $privacyContent,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'terms-and-conditions'],
            [
                'title' => 'Terms & Conditions',
                'content' => $termsContent,
            ]
        );
    }
}
