<script async src="https://yastatic.net/share2/share.js"></script>
<script src="/js/jquery.1.8.0.min.js"></script>
<!-- JavaScript -->
<script async src="./gzip-js/default.js"></script>
<script>
  (function() {
    var script = document.createElement('script');
    script.src = 'https://unpkg.com/web-vitals@3/dist/web-vitals.iife.js';
    script.async = true;
    script.onload = function() {
      webVitals.onCLS(function(metric) { sendToGoogleAnalytics(metric); });
      webVitals.onLCP(function(metric) { sendToGoogleAnalytics(metric); });
      webVitals.onINP(function(metric) { sendToGoogleAnalytics(metric); });
      webVitals.onFCP(function(metric) { sendToGoogleAnalytics(metric); });
      webVitals.onTTFB(function(metric) { sendToGoogleAnalytics(metric); });
    };
    document.head.appendChild(script);

    function sendToGoogleAnalytics({name, value, delta}) {
      var roundedValue = Math.round(name === 'CLS' ? value * 1000 : value);
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({
        event: 'web_vitals',
        event_category: 'Web Vitals',
        event_action: name,
        event_value: roundedValue,
        event_label: name,
        non_interaction: true
      });
    }
  })();
</script>
