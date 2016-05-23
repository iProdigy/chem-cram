<?php
# Usage: unit.php?name=kinetics

if (!array_key_exists('name', $_GET)) {
    echo 'No unit specified';
    return;
}

$name = $_GET['name'];
$name = basename($name);

$units = include 'getUnits.php';
$unit = null;

foreach ($units as $u) {
    if ($u instanceof Unit && $u->name === $name) {
        $unit = $u;
        break;
    }
}

if (!isset($unit)) {
    echo 'Unit not found.';
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A streamlined platform to review AP Chemistry concepts and do practice problems.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title><?php echo $unit->name . " - Chem Cram";?></title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="resources/images/favicon-192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="resources/images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#F39943">

    <link rel="shortcut icon" href="resources/images/favicon.png">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="resources/css/topicstyle.css">
    <link rel="icon" sizes="16x16" href="resources/images/favicon-16x16.png">
    <link rel="icon" sizes="32x32" href="resources/images/favicon-32x32.png">
    <link rel="icon" sizes="64x64" href="resources/images/favicon-64x64.png">
    <link rel="icon" sizes="72x72" href="resources/images/favicon-72x72.png">
    <link rel="icon" sizes="96x96" href="resources/images/favicon-96x96.png">
</head>
<body>
<div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">
    <div class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
            <h2>
                <?php
                echo $unit->title;
                ?>
            </h2>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
    </div>

    <main class="mdl-layout__content" style="padding-top: 100px !important;">
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card amazing mdl-cell mdl-cell--12-col">
                <div class="mdl-card__title mdl-color-text--grey-50">
                    <h3><a href="https://www.youtube.com/watch?v=xTWU2AotFvM">Unit Overview</a></h3>
                </div>
                <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                    <!-- TODO: Export to unit json -->
                    To gain a general understanding of this unit, please see this video made by Nidhi and Sidd:
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/xTWU2AotFvM" frameborder="0"
                            allowfullscreen></iframe>
                </div>
                <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                    <div class="minilogo"></div>
                    <div>
                        <strong>Chem Cram</strong>
                        <span>Make Chemistry Great Again</span>
                    </div>
                </div>
            </div>

            <?php
            foreach ($unit->topics as $topic) {
                if (!($topic instanceof Topic))
                    continue;

                echo "<div class=\"mdl-card mdl-cell mdl-cell--12-col\">";

                echo "<div class=\"mdl-card__media mdl-color-text--grey-50\">";
                echo "<h3><a href='topic.php?unit=$name&id=$topic->id'>$topic->name</a></h3>";
                echo "</div>";

                echo "<div class=\"mdl-color-text--grey-600 mdl-card__supporting-text\">";
                echo $topic->desc;
                echo "</div>";

                echo <<<TAG
                <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                    <div class="minilogo"></div>
                    <div>
                        <strong>Chem Cram</strong>
                        <span>Make Chemistry Great Again</span>
                    </div>
                </div>
TAG;

                echo "</div>";
            }
            ?>
        </div>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                <button class="mdl-mini-footer--social-btn social-btn social-btn__twitter">
                    <span class="visuallyhidden">Twitter</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__blogger">
                    <span class="visuallyhidden">Facebook</span>
                </button>
                <button class="mdl-mini-footer--social-btn social-btn social-btn__gplus">
                    <span class="visuallyhidden">Google Plus</span>
                </button>
            </div>
            <div class="mdl-mini-footer--right-section">
                <button class="mdl-mini-footer--social-btn social-btn__share">
                    <i class="material-icons" role="presentation">share</i>
                    <span class="visuallyhidden">share</span>
                </button>
            </div>
        </footer>
    </main>
    <div class="mdl-layout__obfuscator"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</body>
<script>
    Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function (el) {
        var link = el.querySelector('a');
        if (!link) {
            return;
        }
        var target = link.getAttribute('href');
        if (!target) {
            return;
        }
        el.addEventListener('click', function () {
            location.href = target;
        });
    });
</script>
</html>
