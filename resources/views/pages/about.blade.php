@extends('main')

@section('title', '| About')

@section('content')

<div class="row" >
    <div class="col-md-12" >
        <section class="row" style="width: 1200px; height: 280px;">
           <div class="w3-content w3-section" >
            <img class="mySlides"  src="http://www.nanium.com/_upl/about1.png" style="width: 1200px; height: 300px;" >
            <img class="mySlides" src="http://www.nanium.com/_upl/about2.png" style="width: 1200px; height: 300px;">
            <img class="mySlides"   src="http://www.nanium.com/_upl/about3.png" style="width: 1200px; height: 300px;">
            <img class="mySlides"    src="http://www.nanium.com/_upl/design-simulation-characterization2111.jpg" style="width: 1200px; height: 300px;">
        </div>
        <script>
            var myIndex = 0;
            carousel();
            
             function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                 x[i].style.display = "none";  
             }
             myIndex++;
             if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
</section>
<br/>


<div class="about">
  <h1 >About NANIUM</h1>
<p ><span>For over 20 years, NANIUM has provided advanced assembly and test services to a global customer base of semiconductor companies serving the consumer, communication, automotive, medical and computer industries.</span></p>

<p>We deliver creative, reliable and cost-efficient solutions, ranging from package design to prototyping, wafer-level packaging (WLP), wafer probe, assembly and test, supply-chain management and drop shipping.
    With state-of-the-art equipment, including 300mm wafer-level packaging capabilities, we offer the industry’s most advanced fan-out/fan-in WLP, system-in-package (SiP) solutions and advanced 3D packaging, producing miniaturization and electrical performance at the lowest cost and fastest cycle times.</p>

    <p>Though apparently young, we have more of twenty years of expertise in the semiconductor industry since its inception in 1996 as Siemens Semiconductors. Initially focusing on leadframe-based and laminated-based packages like BGA and LGA, in 2010 the company became a service-provider in the 300mm Wafer-Level Packaging market. Nowadays, NANIUM stands as a leader in Fan-Out WLP/ eWLB, a technology that combines minimal form-factor with high integration density, superior electrical/thermal performance and maximum reliability.</p>

    <P>Based in Portugal, NANIUM’s facilities include over 20,000 m2 of cleanroom area, making it the largest OSAT in Europe. The company offers in-house capabilities for the entire development chain, from design to the flexibility to tailor and test solutions that respond to the most demanding customer requirements. NANIUM is based in Vila do Conde, greater Porto area, and has sales offices in Dresden, Germany, and Boston, USA.</p>
    </div>
    </div>
</div>

@endsection
