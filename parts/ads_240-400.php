<?php
/* 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Небоскреб_240-400-Минимал -->
<ins class="adsbygoogle" style="display:inline-block;width:240px;height:400px" data-ad-client="ca-pub-8478000055723752" data-ad-slot="2207537325"></ins>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({});
</script>
*/

// Array of banners
$banners = array(
    array("type" => "deposit", "size" => "240x400", "erid" => "LjN8KFjFk"),
    array("type" => "mortgage", "size" => "240x400", "erid" => "LjN8KG4jg"),
    array("type" => "osago", "size" => "240x400", "erid" => "LjN8KGQDc")
);

// Select a random banner
$randomBanner = $banners[rand(0, count($banners) - 1)];

// Display the selected banner
?>
<!-- <?php echo $randomBanner['type']; ?> -->
<br class="visible-xs">
<div class="finuslugi-banner" data-type="<?php echo $randomBanner['type']; ?>" data-size="<?php echo $randomBanner['size']; ?>" data-erid="<?php echo $randomBanner['erid']; ?>" onclick="ym(23378290,'reachGoal','ads_target'); return true;"></div>
<script async type="text/javascript" charset="utf-8" src="https://agents.finuslugi.ru/js/banners/banner/main.min.js"></script>