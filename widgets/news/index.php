<?php
require_once './config/constants.php';
?>
<link href="/widgets/news/styles.css" rel="stylesheet">

<?php
function getNews($category = 'ru') {
    $url = NEWS_API_URL . "?category=" . urlencode($category);
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => API_TIMEOUT,
        CURLOPT_FAILONERROR => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if (DEBUG_MODE) {
        error_log("API Request to: $url, HTTP Code: $httpCode");
    }
    
    if ($response && $httpCode === 200) {
        $data = json_decode($response, true);
        return $data['status'] === 'success' ? $data['data'] : [];
    }
    
    return [];
}

// Функции рендеринга остаются без изменений
function renderNewsItems($news, $isMobile = false) {
    if (empty($news)) {
        return '<p style="text-align: center; color: #999; padding: 40px 0;">Новости временно недоступны</p>';
    }
    
    if ($isMobile) {
        return renderMobileNews($news);
    } else {
        return renderDesktopNews($news);
    }
}

function renderDesktopNews($news) {
    $html = '';
    foreach ($news as $item) {
        $html .= '
        <div class="news-item">
            ' . ($item['image_url'] ? '
            <img src="' . htmlspecialchars(IMG_PATH . $item['image_url']) . '" 
                 alt="' . htmlspecialchars($item['title']) . '" 
                 class="news-image" loading="lazy">' : '') . '
            <div class="news-content">
                <div class="news-publisher">
                    ' . ($item['publisher_icon_url'] ? '
                    <img src="' . htmlspecialchars(IMG_PATH . $item['publisher_icon_url']) . '" 
                         alt="' . htmlspecialchars($item['publisher_name']) . '" 
                         class="publisher-icon">' : '') . '
                    <span class="publisher-name">' . htmlspecialchars($item['publisher_name'] ?? 'Источник') . '</span>
                </div>
                <h4 class="news-title">
                    <a href="' . htmlspecialchars($item['original_url']) . '" 
                       target="_blank" rel="noopener">
                        ' . htmlspecialchars($item['title']) . '
                    </a>
                </h4>
                ' . ($item['description'] ? '
                <p class="news-description">' . 
                    htmlspecialchars(mb_substr($item['description'], 0, 150)) . '...
                </p>' : '') . '
                <div class="news-time">' . htmlspecialchars($item['time_ago']) . '</div>
            </div>
        </div>';
    }
    return $html;
}

function renderMobileNews($news) {
    $html = '<div class="news-horizontal-scroll">';
    foreach ($news as $item) {
        $html .= '
        <div class="news-card-mobile">
            ' . ($item['image_url'] ? '
            <img src="' . htmlspecialchars($item['image_url']) . '" 
                 alt="' . htmlspecialchars($item['title']) . '" 
                 class="news-image-mobile" loading="lazy">' : '') . '
            <div class="news-publisher">
                ' . ($item['publisher_icon_url'] ? '
                <img src="' . htmlspecialchars($item['publisher_icon_url']) . '" 
                     alt="' . htmlspecialchars($item['publisher_name']) . '" 
                     class="publisher-icon">' : '') . '
                <span class="publisher-name-mobile">' . htmlspecialchars($item['publisher_name'] ?? 'Источник') . '</span>
            </div>
            <h5 class="news-title-mobile">
                <a href="' . htmlspecialchars($item['original_url']) . '" 
                   target="_blank" rel="noopener">
                    ' . htmlspecialchars(mb_substr($item['title'], 0, 60)) . '...
                </a>
            </h5>
            <div class="news-time-mobile">' . htmlspecialchars($item['time_ago']) . '</div>
        </div>';
    }
    $html .= '</div>';
    return $html;
}

// Используем реальные категории из БД
$categories = [
    'ru' => 'В России',
    'int' => 'В мире', 
    'editorial' => 'Наша редакция'
];

$news_data = [];
foreach (array_keys($categories) as $category) {
    $news_data[$category] = getNews($category);
}
?>
<div class="news-widget">
    <div class="news-tabs">
        <h2 class="widget-title">Последние новости о половом воспитании</h2>
        
        <ul class="nav nav-tabs" role="tablist">
            <?php $first = true; ?>
            <?php foreach ($categories as $key => $title): ?>
                <li role="presentation" class="<?= $first ? 'active' : '' ?>">
                    <a href="#<?= $key ?>" aria-controls="<?= $key ?>" role="tab" data-toggle="tab">
                        <?= $title ?>
                    </a>
                </li>
                <?php $first = false; ?>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content">
            <?php $first = true; ?>
            <?php foreach ($categories as $key => $title): ?>
                <div role="tabpanel" class="tab-pane <?= $first ? 'active' : '' ?>" id="<?= $key ?>">
                    <?php if ($key === 'editorial'): ?>
                        <p class="no-news-message">Раздел в разработке. Здесь будут публиковаться материалы нашей редакции.</p>
                    <?php else: ?>
                        <!-- Десктоп версия -->
                        <div class="news-desktop">
                            <?= renderNewsItems($news_data[$key], false) ?>
                        </div>
                        
                        <!-- Мобильная версия -->
                        <div class="news-mobile">
                            <?= renderNewsItems($news_data[$key], true) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $first = false; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
// Активация табов
document.addEventListener('DOMContentLoaded', function() {
    var tabLinks = document.querySelectorAll('.news-tabs a[data-toggle="tab"]');
    
    tabLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.nav-tabs li').forEach(function(li) {
                li.classList.remove('active');
            });
            
            document.querySelectorAll('.tab-pane').forEach(function(pane) {
                pane.classList.remove('active');
            });
            
            this.parentElement.classList.add('active');
            var targetPane = document.querySelector(this.getAttribute('href'));
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });
});
</script>