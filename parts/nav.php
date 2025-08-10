<?php
// Function to check if the current URI matches a given link
function isCurrentPage($link)
{
    $currentPage = $_SERVER['REQUEST_URI'];
    return ($currentPage == $link);
}

// Array of menu items with their corresponding links
$menuItems = array(
    '/' => '12+ Половое воспитание',
    '/infografika-podrostki-i-seks-v-rossii-2014-statistika-issledovaniya.html' => 'Инфографика',
    '/mify-o-sekse-kak-vstrechatsya-s-devushkoy-psihologiya-parnei-podrostkov.html' => 'Парню',
    '/pravilnoe-ispolzovanie-prezervativa-kak-pravilno-nadevat-prezervativ-ippp-zppp-vich-infekciya-spid.html' => 'Влюблённым',
    '/polovoe-vospitanie-devushki-podrostka-seksualnoe-obrazovanie-podrostkov.html' => 'Девушке',
    '/kontrol-rozhdaemosti-metody-kontracepcii.html' => 'Контрацепция',
    '/polovoye-vospitaniye-mladshikh-shkolnikov-polovoye-vospitaniye-v-semye.html' => 'Детям',
);

?>

<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-toggle"
        data-toggle="collapse" 
        data-target=".navbar-ex1-collapse"
      >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php foreach ($menuItems as $link => $label) : ?>
          <li <?php echo (isCurrentPage($link) ? 'class="active"' : ''); ?>>
            <a href="<?php echo $link; ?>"><?php echo $label; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>