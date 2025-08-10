<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        // include class
        include 'SitemapGenerator.php';

        // create object
        $sitemap = new SitemapGenerator("http://2podrostka.ru/");

        // add urls
        $sitemap->addUrl("http://2podrostka.ru",                date('c'),  'daily',    '1');
        $sitemap->addUrl("http://2podrostka.ru/infografika-podrostki-i-seks-v-rossii-2014-statistika-issledovaniya.php",          date('c'),  'daily',    '0.5');
        $sitemap->addUrl("http://2podrostka.ru/kontrol-rozhdaemosti-metody-kontracepcii.php",          date('c'),  'daily');
        $sitemap->addUrl("http://2podrostka.ru/mify-o-sekse-kak-vstrechatsya-s-devushkoy-psihologiya-parnei-podrostkov.php",          date('c'));
        $sitemap->addUrl("http://2podrostka.ru/polovoe-vospitanie-devushki-podrostka-seksualnoe-obrazovanie-podrostkov.php");
        $sitemap->addUrl("http://2podrostka.ru/polovoye-vospitaniye-mladshikh-shkolnikov-polovoye-vospitaniye-v-semye.php",  date('c'),  'daily',    '0.4');
        $sitemap->addUrl("http://2podrostka.ru/pravilnoe-ispolzovanie-prezervativa-kak-pravilno-nadevat-prezervativ-ippp-zppp-vich-infekciya-spid.php",  date('c'),  'daily');

        // create sitemap
        $sitemap->createSitemap();

        // write sitemap as file
        $sitemap->writeSitemap();

        // update robots.txt file
        $sitemap->updateRobots();

        // submit sitemaps to search engines
        $sitemap->submitSitemap();
        ?>
    </body>
</html>
