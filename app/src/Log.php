<?php

class Log
{
  public static function displayTopPageViews(array $topPageViews)
  {

    foreach ($topPageViews as $topPageView) {
      $domain_code = '"' . $topPageView['domain_code'] . '"';
      $page_title = '"' . $topPageView['page_title'] . '"';
      $count_views = $topPageView['count_views'];

      echo "{$domain_code} {$page_title} {$count_views}" . PHP_EOL;
    }
  }

  public static function displayPopularPages(array $popularPages)
  {
    foreach ($popularPages as $popularPage) {
      $domain_code = '"' . $popularPage['domain_code'] . '"';
      $total_views = $popularPage['total_views'];

      echo "{$domain_code} {$total_views}" . PHP_EOL;
    }
  }
}
