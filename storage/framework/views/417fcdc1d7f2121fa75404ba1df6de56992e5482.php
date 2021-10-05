<?php $__env->startSection('tittle','About Us'); ?>
<?php $__env->startSection('container'); ?>
<script>
    // Initialize and add the map
function initMap() {
// The location of Uluru
const uluru = { lat: -25.344, lng: 131.036 };
// The map, centered at Uluru
const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
});
// The marker, positioned at Uluru
const marker = new google.maps.Marker({
    position: uluru,
    map: map,
});
}
</script>

<section class="container-fluid mt-5 mb-3">
    <div class="p-3 bg-white">
        About us
        <h1>My First Google Map</h1>

<div id="map" style="width:100%;height:400px;"></div>


    </div>
</section>
<section class="container mt-5 mb-3">
	<div class="row">
		<div class="col col-lg-4 bg-success shadow">
      <?php if($dataAbout) { ?>
	      <h1><?php echo $dataAbout['title']; ?></h1>
        <p><?php echo $dataAbout['description']; ?></p>
      <?php } ?>
	  </div>
		<div class="col">
	      	<iframe
		        id="JotFormIFrame-203209074848054"
		        title="Form survei complete report"
		        onload="window.parent.scrollTo(0,0)"
		        allowtransparency="true"
		        allowfullscreen="true"
		        allow="geolocation; microphone; camera"
		        src="https://form.jotform.com/203209074848054"
		        frameborder="0"
		        style="
		        min-width: 100%;
		        height:539px;
		        border:none;"
		        scrolling="no"
		        >
		    </iframe>
	    </div>
	    
	</div>
</section>


<script type="text/javascript">
      var ifr = document.getElementById("JotFormIFrame-203209074848054");
      if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split('&'));
        }
        if (src && src.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
          src = src.substr(0, src.indexOf("?"))
        }
        iframeParams.push("isIframeEmbed=1");
        ifr.src = src + "?" + iframeParams.join('&');
      }
      window.handleIFrameMessage = function(e) {
        if (typeof e.data === 'object') { return; }
        var args = e.data.split(":");
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
        if (!iframe) { return; }
        switch (args[0]) {
          case "scrollIntoView":
            iframe.scrollIntoView();
            break;
          case "setHeight":
            iframe.style.height = args[1] + "px";
            break;
          case "collapseErrorPage":
            if (iframe.clientHeight > window.innerHeight) {
              iframe.style.height = window.innerHeight + "px";
            }
            break;
          case "reloadPage":
            window.location.reload();
            break;
          case "loadScript":
            var src = args[1];
            if (args.length > 3) {
                src = args[1] + ':' + args[2];
            }
            var script = document.createElement('script');
            script.src = src;
            script.type = 'text/javascript';
            document.body.appendChild(script);
            break;
          case "exitFullscreen":
            if      (window.document.exitFullscreen)        window.document.exitFullscreen();
            else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
            else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
            else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
            else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
            break;
        }
        var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
        if(isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
          var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
          iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
        }
      };
      if (window.addEventListener) {
        window.addEventListener("message", handleIFrameMessage, false);
      } else if (window.attachEvent) {
        window.attachEvent("onmessage", handleIFrameMessage);
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAw9_7WWE1crCIjBUA9h1FoV8aM3A8llSU&callback=initMap&libraries=&v=weekly"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/php74/tes/resources/views/site/about.blade.php ENDPATH**/ ?>