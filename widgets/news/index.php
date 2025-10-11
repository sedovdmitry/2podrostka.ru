<?php
require_once './config/constants.php';

// Inline critical CSS
echo '<style>
    .news-widget { max-width: 1200px; margin: 0 auto; }
    .news-tabs { padding: 20px; }
    .widget-title { font-size: 24px; margin-bottom: 20px; }
    .nav-tabs { display: flex; list-style: none; padding: 0; }
    .nav-tabs li { margin-right: 10px; }
    .nav-tabs a { text-decoration: none; color: #333; padding: 10px; }
    .nav-tabs .active a { font-weight: bold; border-bottom: 2px solid #007bff; }
    .news-item, .news-card-mobile { display: flex; flex-direction: column; margin-bottom: 20px; }
    .news-image, .news-image-mobile { width: 100%; max-width: 300px; height: auto; }
    .publisher-icon { width: 20px; height: 20px; vertical-align: middle; }
    .news-title, .news-title-mobile { font-size: 18px; margin: 10px 0; }
    .news-time, .news-time-mobile { color: #333; font-size: 14px; } /* Улучшен контраст */
    .news-horizontal-scroll { display: flex; overflow-x: auto; }
    @media (max-width: 600px) { .news-desktop { display: none; } .news-mobile { display: block; } }
    @media (min-width: 601px) { .news-mobile { display: none; } .news-desktop { display: block; } }
</style>';

function getNews($category = 'ru') {
    $url = NEWS_API_URL . "?category=" . urlencode($category) . "&limit=10"; // Ограничиваем 10 записями
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5, // Уменьшен таймаут
        CURLOPT_FAILONERROR => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);  # Новый: Захват ошибки curl
    curl_close($ch);
    
    if (DEBUG_MODE) {
        error_log("API Request to: $url, HTTP Code: $httpCode, Error: $curlError");  # Новый: Логирование ошибки
    }
    
    if ($response && $httpCode === 200) {
        $data = json_decode($response, true);
        return $data['status'] === 'success' ? array_slice($data['data'], 0, 10) : []; // Ограничиваем 10
    }
    
    # Новый: Возврат пустого массива с логом
    error_log("API failed: HTTP $httpCode, Error: $curlError");
    return [];
}

function renderNewsItems($news, $isMobile = false) {
    if (empty($news)) {
        return '<p style="text-align: center; color: #333; padding: 40px 0;" aria-live="polite">Новости временно недоступны</p>';
    }
    
    return $isMobile ? renderMobileNews($news) : renderDesktopNews($news);
}

function renderDesktopNews($news) {
    $html = '';
    foreach ($news as $item) {
        $html .= '
        <article class="news-item" aria-labelledby="news-' . htmlspecialchars($item['id']) . '">
            ' . ($item['image_url'] ? '
            <img src="' . getImageUrl(IMG_PATH . $item['image_url']) . '" 
                 srcset="' . getImageUrl(IMG_PATH . $item['image_url'], true) . ' 300w, ' . getImageUrl(IMG_PATH . $item['image_url']) . ' 600w"
                 sizes="(max-width: 600px) 300px, 600px"
                 alt="' . htmlspecialchars($item['title']) . '" 
                 class="news-image" width="300" height="200" loading="lazy" fetchpriority="low">' : '') . '
            <div class="news-content">
                <div class="news-publisher">
                    ' . ($item['publisher_icon_url'] ? '
                    <img src="' . getImageUrl(IMG_PATH . $item['publisher_icon_url']) . '" 
                         alt="' . htmlspecialchars($item['publisher_name']) . '" 
                         class="publisher-icon" width="20" height="20" loading="lazy">' : '') . '
                    <span class="publisher-name">' . htmlspecialchars($item['publisher_name'] ?? 'Источник') . '</span>
                </div>
                <h3 id="news-' . htmlspecialchars($item['id']) . '" class="news-title">
                    <a href="' . htmlspecialchars($item['original_url']) . '" 
                       target="_blank" rel="noopener nofollow">
                        ' . htmlspecialchars($item['title']) . '
                    </a>
                </h3>
                ' . ($item['description'] ? '
                <p class="news-description">' . 
                    htmlspecialchars(mb_substr($item['description'], 0, 150)) . '...
                </p>' : '') . '
                <time class="news-time" datetime="' . htmlspecialchars($item['published_at']) . '">' . htmlspecialchars($item['time_ago']) . '</time>
            </div>
        </article>';
    }
    return $html;
}

function renderMobileNews($news) {
    $html = '<div class="news-horizontal-scroll" role="region" aria-label="Новости">';
    foreach ($news as $item) {
        $html .= '
        <article class="news-card-mobile" aria-labelledby="news-mobile-' . htmlspecialchars($item['id']) . '">
            ' . ($item['image_url'] ? '
            <img src="' . getImageUrl(IMG_PATH . $item['image_url']) . '" 
                 srcset="' . getImageUrl(IMG_PATH . $item['image_url'], true) . ' 300w, ' . getImageUrl(IMG_PATH . $item['image_url']) . ' 600w"
                 sizes="(max-width: 600px) 300px, 600px"
                 alt="' . htmlspecialchars($item['title']) . '" 
                 class="news-image-mobile" width="300" height="200" loading="lazy" fetchpriority="low">' : '') . '
            <div class="news-publisher">
                ' . ($item['publisher_icon_url'] ? '
                <img src="' . getImageUrl(IMG_PATH . $item['publisher_icon_url']) . '" 
                     alt="' . htmlspecialchars($item['publisher_name']) . '" 
                     class="publisher-icon" width="20" height="20" loading="lazy">' : '') . '
                <span class="publisher-name-mobile">' . htmlspecialchars($item['publisher_name'] ?? 'Источник') . '</span>
            </div>
            <h3 id="news-mobile-' . htmlspecialchars($item['id']) . '" class="news-title-mobile">
                <a href="' . htmlspecialchars($item['original_url']) . '" 
                   target="_blank" rel="noopener nofollow">
                    ' . htmlspecialchars($item['title']) . '
                </a>
            </h3>
            <time class="news-time-mobile" datetime="' . htmlspecialchars($item['published_at']) . '">' . htmlspecialchars($item['time_ago']) . '</time>
        </article>';
    }
    $html .= '</div>';
    return $html;
}

$categories = [
    'ru' => 'В России и СНГ',
    'int' => 'В мире', 
    'editorial' => 'Избранные'
];

$news_data = [];
foreach (array_keys($categories) as $category) {
    $news_data[$category] = getNews($category);
}
?>
<div class="news-widget">
    <div class="news-tabs">
        <h2 class="widget-title">Свежие новости о половом воспитании в России и мире</h2>
        
        <ul class="nav nav-tabs" role="tablist">
            <?php $first = true; ?>
            <?php foreach ($categories as $key => $title): ?>
                <li role="presentation" class="<?= $first ? 'active' : '' ?>">
                    <a href="#<?= $key ?>" aria-controls="<?= $key ?>" role="tab" data-toggle="tab">
                        <?= htmlspecialchars($title) ?>
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
                        <p class="no-news-message" aria-live="polite">Раздел в разработке. Здесь будут публиковаться избранные материалы центра.</p>
                    <?php else: ?>
                        <div class="news-desktop">
                            <?= renderNewsItems($news_data[$key], false) ?>
                        </div>
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

<script defer>
// Активация табов без document.write
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('.news-tabs a[data-toggle="tab"]');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            
            document.querySelectorAll('.nav-tabs li').forEach(li => li.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
            
            e.target.parentElement.classList.add('active');
            const targetPane = document.querySelector(e.target.getAttribute('href'));
            if (targetPane) {
                targetPane.classList.add('active');
            }
        }, { passive: true });
    });
});
</script>

<link rel="stylesheet" href="/widgets/news/styles.css" media="print" onload="this.media='all'">
<link rel="preconnect" href="https://yastatic.net">
<link rel="preconnect" href="https://mc.yandex.ru">