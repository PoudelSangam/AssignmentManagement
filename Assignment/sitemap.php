<?php
header('Content-type: application/xml');

$urls = [
    [
        'loc' => 'https://poudelsangam.com.np/',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '1.0',
    ],
    [
        'loc' => 'https://poudelsangam.com.np/Assignment/index.php',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '0.8',
    ],
    [
        'loc' => 'https://poudelsangam.com.np/Assignment/admin',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '0.8',
    ],
    [
        'loc' => 'https://poudelsangam.com.np/Assignment/sendmail/sendmail.php',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '0.5',
    ],
    [
        'loc' => 'https://poudelsangam.com.np/Assignment/sendmail/logout.php',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '0.5',
    ],
    [
        'loc' => 'https://poudelsangam.com.np/gmail/',
        'lastmod' => '2024-07-02',
        'changefreq' => 'monthly',
        'priority' => '0.8',
    ],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($urls as $url) {
    echo '<url>';
    echo '<loc>' . $url['loc'] . '</loc>';
    echo '<lastmod>' . $url['lastmod'] . '</lastmod>';
    echo '<changefreq>' . $url['changefreq'] . '</changefreq>';
    echo '<priority>' . $url['priority'] . '</priority>';
    echo '</url>';
}

echo '</urlset>';
?>
