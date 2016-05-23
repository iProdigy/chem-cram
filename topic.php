<?php
# Usage: topic.php?unit=kinetics&id=0

if (!array_key_exists('unit', $_GET)) {
    echo 'No unit specified';
    return;
}

if (!array_key_exists('id', $_GET)) {
    echo 'No topic specified';
    return;
}

$name = $_GET['unit'];
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

$id = $_GET['id'];
$id = basename($id);
$topic = null;

foreach ($unit->topics as $t) {
    if ($t->id == $id) {
        $topic = $t;
        break;
    }
}

if (!isset($topic)) {
    echo 'Topic not found.';
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
    <title><?php echo $topic->name . " - Chem Cram"; ?></title>

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
<div class="demo-blog demo-blog--blogpost mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">
        <div class="demo-back">
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="unit.php?name=kinetics"
               title="go back" role="button">
                <i class="material-icons" role="presentation">arrow_back</i>
            </a>
        </div>
        <div class="demo-blog__posts mdl-grid">
            <div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
                <div class="mdl-card__media mdl-color-text--grey-50">
                    <h3>
                        <?php
                        echo $topic->name;
                        ?>
                    </h3>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                    <div class="minilogo"></div>
                    <div>
                        <strong>Chem Cram</strong>
                    </div>
                    <div class="section-spacer"></div>
                    <div class="meta__favorites">
                        <?php
                        echo rand(100, 1337);
                        ?>
                        <i class="material-icons" role="presentation">favorite</i>
                        <span class="visuallyhidden">favorites</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">bookmark</i>
                        <span class="visuallyhidden">bookmark</span>
                    </div>
                    <div>
                        <i class="material-icons" role="presentation">share</i>
                        <span class="visuallyhidden">share</span>
                    </div>
                </div>
                <div class="mdl-color-text--grey-700 mdl-card__supporting-text">
                    <h5>Notes</h5>
                    <p>
                        <?php
                        echo $topic->notes;
                        ?>
                    </p>

                    <h5>Videos</h5>
                    <p>
                        <?php
                        foreach ($topic->videos as $video) {
                            echo "<iframe src=\"$video\" frameborder=\"0\" allowfullscreen></iframe>";
                            echo "<br/>";
                        }
                        ?>
                    </p>

                    <h5>Questions</h5>
                    <form>
                        <?php
                        $qId = 0;
                        foreach ($topic->questions as $question) {
                            echo "<p>$question->prompt</p>";

                            $options = $question->choices;
                            array_push($options, $question->answer);
                            shuffle($options);

                            $cId = 0;
                            foreach ($options as $option) {
                                $right = $option === $question->answer;
                                echo "<label for=\"$qId-$cId\" class=\"mdl-radio mdl-js-radio\">";
                                echo "<input type=\"radio\" id=\"$qId-$cId\" class=\"mdl-radio__button\" name=\"$qId\" value=\"$option\"" . ($right ? "correct=\"true\"" : "") . ">";
                                echo "<span class=\"mdl-radio__label\">$option</span>";
                                echo "</label>";
                                echo "<br/>";
                                $cId++;
                            }

                            echo "<br/><br/>";
                            $qId++;
                        }
                        ?>

                        <button type="button"
                                class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored"
                                onclick="check()">Check answers
                        </button>
                    </form>
                </div>
                <div class="mdl-color-text--primary-contrast mdl-card__supporting-text comments">
                    <form>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea rows=1 class="mdl-textfield__input" id="comment"></textarea>
                            <label for="comment" class="mdl-textfield__label">Join the discussion</label>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                        </button>
                    </form>
                    <div class="comment mdl-color-text--grey-700">
                        <header class="comment__header">
                            <img src="resources/images/co1.jpg" class="comment__avatar">
                            <div class="comment__author">
                                <strong>Jane Doe</strong>
                                <span>3 days ago</span>
                            </div>
                        </header>
                        <div class="comment__text">
                            Great resource! Please add more units to your website, it really helps me learn.
                        </div>
                        <nav class="comment__actions">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_up</i><span class="visuallyhidden">like comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">thumb_down</i><span
                                    class="visuallyhidden">dislike comment</span>
                            </button>
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                <i class="material-icons" role="presentation">share</i><span class="visuallyhidden">share comment</span>
                            </button>
                        </nav>
                        <div class="comment__answers">
                            <div class="comment">
                                <header class="comment__header">
                                    <img src="resources/images/co2.jpg" class="comment__avatar">
                                    <div class="comment__author">
                                        <strong>John Dufry</strong>
                                        <span>2 days ago</span>
                                    </div>
                                </header>
                                <div class="comment__text">
                                    same
                                </div>
                                <nav class="comment__actions">
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">thumb_up</i><span
                                            class="visuallyhidden">like comment</span>
                                    </button>
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">thumb_down</i><span
                                            class="visuallyhidden">dislike comment</span>
                                    </button>
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                                        <i class="material-icons" role="presentation">share</i><span
                                            class="visuallyhidden">share comment</span>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="demo-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
                <?php
                $backLink = ($id == 0) ? ("unit.php?name=" . $name) : ("topic.php?unit=$name&id=" . ($id - 1));
                echo "<a href=\"$backLink\" class=\"demo-nav__button\"><button class=\"mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900\" role=\"presentation\"><i class=\"material-icons\">arrow_back</i></button>Previous</a>";
                ?>

                <div class="section-spacer"></div>

                <?php
                $last = ($id == count($unit->topics) - 1);
                if (!$last) {
                    $nextLink = "topic.php?unit=$name&id=" . ($id + 1);
                    echo "<a href=\"$nextLink\" class=\"demo-nav__button\">Next<button class=\"mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900\" role=\"presentation\"><i class=\"material-icons\">arrow_forward</i></button></a>";
                }
                ?>
            </nav>
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

    // This should be done server-side but I don't care about users cheating, they're only cheating themselves
    function check() {
        var inputs = document.getElementsByTagName('input');
        var wrong = 0;
        for (var i = 0; i < inputs.length; i++) {
            var input = inputs[i];

            if (input.type === 'radio' && input.checked && !input.hasAttribute('correct')) {
                wrong++;
            }
        }

        if (wrong === 0) {
            alert("You got all problems right!");
        } else {
            alert("You missed " + wrong + " problem" + ((wrong > 1) ? "s" : "") + ". Please try again.");
        }
    }
</script>
</html>
