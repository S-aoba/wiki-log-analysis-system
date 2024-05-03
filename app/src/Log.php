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

  /**
   * Display top page views along with domain codes, page titles, and view counts.
   *
   * @param array $res           Database data containing page views.
   * @param array $domainCodeArr User input array containing domain codes.
   */
  public static function displayPopularPages(array $res, array $domainCodeArr)
  {
    foreach ($res as $popularPage) {
      $domain_code = '"' . $popularPage['domain_code'] . '"';
      $total_views = $popularPage['total_views'];

      echo "{$domain_code} {$total_views}" . PHP_EOL;
    }

    $existingDomainCodes = array_column($res, 'domain_code');
    $missingDomainCodes = array_diff($domainCodeArr, $existingDomainCodes);

    foreach ($missingDomainCodes as $missingDomainCode) {
      echo "該当するドメインコードは存在しませんでした: {$missingDomainCode}" . PHP_EOL;
    }
  }
}
