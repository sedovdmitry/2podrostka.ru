<?php
// Базовые константы приложения
define('BASE_URL', 'http://2podrostka'); // Основной домен
define('SITE_NAME', '2Подростка');
define('DEBUG_MODE', true); // Режим отладки

// Пути к API
define('API_BASE_URL', BASE_URL . '/api');
define('NEWS_API_URL', API_BASE_URL . '/get_news.php');

// Пути к ресурсам
define('CSS_PATH', BASE_URL . '/widgets/news/styles.css');
define('JS_PATH', BASE_URL . '/js');
define('IMG_PATH', BASE_URL . '/images');

// Настройки базы данных (опционально)
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'news_db');
define('DB_USER', 'news_user');
define('DB_PASS', '123');

// Временные ограничения
define('API_TIMEOUT', 8);
define('CACHE_DURATION', 3600); // 1 час
?>