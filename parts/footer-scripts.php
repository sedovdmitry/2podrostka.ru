<script async src="https://yastatic.net/share2/share.js"></script>
<script src="/js/jquery.1.8.0.min.js"></script>
<!-- JavaScript -->
<script async src="./gzip-js/default.js"></script>

<script type="module">
  import {getLCP, getINP, getCLS, getFCP, getTTFB} from 'https://unpkg.com/web-vitals?module';

  function sendToGoogleAnalytics({name, value, delta}) {
    const roundedValue = Math.round(name === 'CLS' ? value * 1000 : value);  // CLS в миллисекундах
    gtag('event', name, {
      event_category: 'Web Vitals',
      value: roundedValue,
      event_label: name,
      non_interaction: true
    });
  }

  getLCP(sendToGoogleAnalytics);
  getINP(sendToGoogleAnalytics);
  getCLS(sendToGoogleAnalytics);
  getFCP(sendToGoogleAnalytics);  // Опционально
  getTTFB(sendToGoogleAnalytics);  // Опционально
</script>
