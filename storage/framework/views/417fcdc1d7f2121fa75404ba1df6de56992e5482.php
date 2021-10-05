<?php $__env->startSection('tittle','About Us'); ?>
<?php $__env->startSection('container'); ?>

<section class="container-fluid mt-5 mb-3">
    
    <div class="p-3 bg-white row">
      <h1>My First Google Map</h1>
      <div class="embed-responsive embed-responsive-16by9">
        <iframe scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?hl=en&amp;q=%20yogyakarta+(testing%20maps)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0"></iframe>  
        <a href='https://add-map.org/'>embed google maps in website</a>
        <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=5f7e1a8574e2746cef9643b60342eb22ad13f79c'></script>
      </div>
    </div>
</section>
<section class="container">
	<div class="row">
		<div class="col col-lg-5 shadow">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/php74/tes/resources/views/site/about.blade.php ENDPATH**/ ?>