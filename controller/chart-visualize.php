<?php


require_once '../lib/utils/visualizations.php';
require_once '../lib/utils/themes.php';

/*
 * VISUALIZE STEP
 */
$app->get('/chart/:id/visualize', function ($id) use ($app) {
    disable_cache($app);

    check_chart_writable($id, function($user, $chart) use ($app) {
        $page = array(
            'chartData' => $chart->loadData(),
            'chart' => $chart,
            'visualizations' => get_visualizations_meta('', true),
            'vis' => get_visualization_meta($chart->getType()),
            'themes' => get_themes_meta(),
            'theme' => get_theme_meta($chart->getTheme())
        );
        add_header_vars($page, 'chart');
        add_editor_nav($page, 3);

        $app->render('chart-visualize.twig', $page);
    });
});

