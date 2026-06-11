@extends('frontend.layouts.app')

@section('content')
<!-- START homeclassicmain REVOLUTION SLIDER 6.0.1 -->
       
            <div class="home-slider">

              
            </div>
        <!-- END REVOLUTION SLIDER -->
       

        <!--site-main start-->
        <div class="site-main">

           
<link rel="stylesheet" type="text/css" href="https://shehala.com/public/frontend/css/visualization-responsive.css"/>
<script src="https://shehala.com/public/frontend/js/webcomponents-loader.js"></script>
<script src="https://shehala.com/public/frontend/js/intersection-observer.js"></script>
<script src="https://shehala.com/public/frontend/js/ResizeObserver.js"></script>
 

   <!-- page-title -->
   <div class="webdesign-bg">
   <div class="ttm-page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-box text-center">
                            <div class="page-title-heading">
                                <h1 class="title"> 3D & AR/VR Model Visualization</h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="https://shehala.com"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                                <span>Services</span>
                            </div>
                        </div>
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div></div><!-- page-title end-->
          <!--site-main start-->
    <div class="site-main">
     <div class="container">
         <div class="row">
             <div class="model-visualization">
            <div class="section-title with-desc clearfix">
                    <div class="title-header">
                        <h2 class="title">Check Out Our 3D Visualization & AR/VR, Model Work</h2>
                    </div>
                </div><!-- section title end -->


             <div class="grid-container">
    <model-viewer class="a"
                  src="https://shehala.com/public/frontend/images/glb/5036581052263_02i.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#FF6F59"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
    <model-viewer class="b"
                  src="https://shehala.com/public/frontend/images/glb/5059340100937_01i.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#254441"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
    <model-viewer class="c"
                  src="https://shehala.com/public/frontend/images/glb/5059340101118_02i.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#9FB8AD"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
  </div>

  <div class="visualization-margin-top"></div>

  <div class="grid-container">
    <model-viewer class="a"
                  src="https://shehala.com/public/frontend/images/glb/5059340102351_01i.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#9FB8AD"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
    <model-viewer class="b"
                  src="https://shehala.com/public/frontend/images/glb/5059340101194.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#FF6F59"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
    <model-viewer class="c"
                  src="https://shehala.com/public/frontend/images/glb/5059340101811_02i.glb"
                  alt="A 3D model of an astronaut"
                  background-color="#254441"
                  shadow-intensity="1"
                  camera-controls
                  auto-rotate></model-viewer>
  </div>

             </div>
         </div>
     </div>
    </div><!--site-main end-->

<script src="https://shehala.com/public/frontend/js/model-viewer.js"></script> 
<script src="https://shehala.com/public/frontend/js/model-viewer-legacy.js"></script>


        </div><!--site-main end-->
        <div style="clear: both;"></div>
        <!--footer start-->
@endsection
