<script async src="https://yastatic.net/share2/share.js"></script>
<script src="/js/jquery.1.8.0.min.js"></script>
<!-- JavaScript -->
<script async src="./gzip-js/default.js"></script>
<script>
  (function() {
    var script = document.createElement('script');
    script.src = 'https://unpkg.com/web-vitals@5.1.0/dist/web-vitals.attribution.iife.js';
    script.async = true;
    script.onerror = function() { console.error('Failed to load web-vitals@5.1.0 script'); };
    script.onload = function() {
      if (typeof webVitals === 'undefined') {
        console.error('webVitals not defined');
        return;
      }
      webVitals.onCLS(function(metric) { sendToGoogleAnalytics(metric); }, { reportAllChanges: true });
      webVitals.onLCP(function(metric) { sendToGoogleAnalytics(metric); }, { reportAllChanges: true });
      webVitals.onINP(function(metric) { sendToGoogleAnalytics(metric); }, { reportAllChanges: true });
      webVitals.onFCP(function(metric) { sendToGoogleAnalytics(metric); });
      webVitals.onTTFB(function(metric) { sendToGoogleAnalytics(metric); });
    };
    document.head.appendChild(script);

    function sendToGoogleAnalytics({name, value, delta, id, attribution}) {
      var roundedValue = Math.round(name === 'CLS' ? value * 1000 : value);
      var eventParams = {
        event: 'web_vitals',
        event_category: 'Web Vitals',
        event_action: name,
        event_value: roundedValue,
        event_label: name,
        metric_id: id,
        non_interaction: true
      };
      // Add attribution data for debugging
      if (attribution) {
        if (name === 'CLS') eventParams.debug_target = attribution.largestShiftTarget;
        if (name === 'INP') eventParams.debug_target = attribution.interactionTarget;
        if (name === 'LCP') eventParams.debug_target = attribution.element;
      }
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push(eventParams);
    }
  })();
</script>