<?php
// Copyright 2017 Peter Beverloo. All rights reserved.
// Use of this source code is governed by the MIT license, a copy of which can
// be found in the LICENSE file.

require_once __DIR__ . '/../common/parsedown.php';
require_once __DIR__ . '/aanmelding.php';

setlocale(LC_ALL, 'nl_NL.utf8');

$page  = 'index';
$pages = [
  'aanmelding'     => 'aanmelding.md',
  'aanmelding2'    => 'aanmelding-gedaan.md',
  'dataverwerking' => 'dataverwerking.md',
  'index'          => 'introductie.md',
  'hotel'          => 'hotel.md',
  'rooster'        => 'rooster.md',
  'registratie'    => 'registratie.md',
  'registratie2'   => 'registratie-gedaan.md',
  'training'       => 'training.md',
  'updates'        => 'updates.md',
];

if (isset ($_GET['page']) && array_key_exists($_GET['page'], $pages))
  $page = $_GET['page'];

$lastUpdated = strftime('%A %e %B', filemtime(__DIR__ . '/' . $pages[$page]));
$content = file_get_contents(__DIR__ . '/' . $pages[$page]);

if ($page == 'aanmelding' && array_key_exists('slug', $_GET))
  $content = replaceRegistrationPlaceholders($content, $_GET['slug']);

?>
<!doctype html>
<html lang="nl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no" />
    <title>Anime 2019: Steward registratieformulier</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" href="/tools/common/layout.css" />
    <link rel="stylesheet" href="/tools/common/desktop.css" media="screen and (min-device-width: 768px)" />
    <link rel="stylesheet" href="/tools/common/mobile.css" media="screen and (max-device-width: 767px)" />
    <link rel="stylesheet" href="/tools/registration/registration.css" />
  </head>
  <body>
    <header>
      <img src="/tools/common/logo-2019b.png" alt="Anime 2019 in Rotterdam Ahoy" />
    </header>
    <section>
<?php echo Parsedown::instance()->text($content); ?>
    </section>
    <footer>
      <p>
        Laatste wijziging op <?php echo $lastUpdated; ?>. <a href="https://github.com/AnimeNL/anime-2017/tree/master/tools/registration/">Broncode.</a>
      </p>
    </footer>
  </body>
</html>
