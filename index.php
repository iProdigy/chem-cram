<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A streamlined platform to review AP Chemistry concepts and do practice problems.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Chem Cram</title>

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
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="icon" sizes="16x16" href="resources/images/favicon-16x16.png">
    <link rel="icon" sizes="32x32" href="resources/images/favicon-32x32.png">
    <link rel="icon" sizes="64x64" href="resources/images/favicon-64x64.png">
    <link rel="icon" sizes="72x72" href="resources/images/favicon-72x72.png">
    <link rel="icon" sizes="96x96" href="resources/images/favicon-96x96.png">
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
            <h3>Chem Cram</h3>
            <h6 style="margin-left: 25px; color: lightgray;">by Nids & Sidd</h6>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
            <a href="#overview" class="mdl-layout__tab is-active">Overview</a>
            <a href="#units" class="mdl-layout__tab">Units</a>
        </div>
    </header>

    <main class="mdl-layout__content">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                <div class="mdl-card mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__supporting-text">
                        <h4>A New Way to Learn</h4>

                        ChemCram present a new and innovative way to learn that is proven to result in better retention
                        of information. We offer several ways to accrete information that appeal to a variety of
                        learning styles. Students can read notes of topics, watch videos that explain concepts to
                        further detail, and solve problems to test their knowledge while receiving points for learning!
                    </div>
                </div>
            </section>

            <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                <div class="mdl-card mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                        <h4 class="mdl-cell mdl-cell--12-col">Recently Added Content</h4>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <?php
                        $units = include 'getUnits.php';
                        $unit = $units[0];
                        $topics = $unit->topics;

                        for ($i = 0, $max = min(3, count($topics)); $i < $max; $i++) {
                            $topic = $topics[$i];
                            echo "<div class=\"section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone\">";
                            echo "<h5>$topic->name</h5>";
                            echo $topic->desc;
                            echo "<a href=\"topic.php?unit=kinetics&id=$topic->id\">View topic</a>.";
                            echo "</div>";

                            if ($i != $max - 1) {
                                echo "<div class=\"section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone\"><div class=\"section__circle-container__circle mdl-color--primary\"></div></div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <div class="mdl-layout__tab-panel" id="units">
            <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                <div class="mdl-card mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                        <h4 class="mdl-cell mdl-cell--12-col">Units</h4>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <!-- TODO: Export to unit json files -->
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Basics of Matter</h5>
                            Classifying matter, recognizing properties, making measurements, significant figures,
                            dimensional analysis, atoms, atomic theory, the periodic table, molecules, formulas,
                            nomenclature. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Chemical Equations, Stoichiometry, and Solution Chemistry</h5>
                            Equations, balancing, fmu, the mole, mass relations, types of reactions, solution
                            stoichiometry, solution reactions in quantitative analysis. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Gases</h5>
                            Characteristics, laws, formulas, application of equations, mixtures, Kinetic-Molecular
                            theory, diffusion, effusion, real gases. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Kinetics</h5>
                            Reaction rates, change in concentration, factors that affect rates, mechanisms,
                            intermediates, activation energy, and catalysts. <a href="unit.php?name=kinetics">View the
                                Unit.</a>
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Chemical Equilibrium</h5>
                            Equilibrium, Equilibrium constant, Heterogeneous Equilibria, calculating constants,
                            application, shifts in equilibrium. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Aqueous Equilibria</h5>
                            Definition of an acid and a base, self-ionization, pH, strong and weak acids/bases,
                            hydrolysis, common-ion effect, buffers, titrations, solubility equilibria, precipitation,
                            separation of ions. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Thermochemistry</h5>
                            Energy, Laws of Thermodynamics, Enthalpy, Calorimetry, Hess's Law, Enthalpy of Formation,
                            Spontaneous processes, Entropy, Gibb's Free energy, Temperature, Equilibrium constant. View
                            the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Electrochemistry</h5>
                            Redox, balancing, voltaic cells, EMF, sponaneity, factors affecting emf, batteries,
                            corrosion, electrolysis. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Electronic Structure of Atoms</h5>
                            Line spectra, Bohr model, quantum numbers, orbitas, configurations, periodic table,
                            effective nuclear charge, size, ionization energy, electron affinities, metals, nonmetals,
                            metalloids, trends. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Bonding</h5>
                            Types of bonds, Lewis structures, octet rule, polarity, electronegativity, resonance, formal
                            charges, strength, VSEPR, orbital overlap, hybrid orbitals, multiple bonds, diatomic
                            molecules. View the unit.
                        </div>
                        <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                            <div class="section__circle-container__circle mdl-color--primary"></div>
                        </div>
                        <div
                            class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Intermolecular Forces</h5>
                            IMFs, which ones are found in what types of matter, phase changes, vapor pressure, phase
                            diagrams, atomic structure, bonding, solubility, concentration. View the unit.
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="section--footer mdl-color--white mdl-grid" style="margin-top: 50px;">
            <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                <div class="section__circle-container__circle mdl-color--accent section__circle--big"></div>
            </div>
            <div
                class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                <h4>View the AP Chemistry Curriculum</h4>
                Click <a href="https://drive.google.com/file/d/0B2I9Gsfgk0gcWGt2bjVuNUJEZVE/view?usp=sharing"
                         target="_blank">here</a>
                to view the list of topics that are found on the AP Chemistry exam.
            </div>
            <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                <div class="section__circle-container__circle mdl-color--accent section__circle--big"></div>
            </div>
            <div
                class="section__text mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                <h4>View your Progress</h4>
                Click <a href="#">here</a> to view the concepts and problems you have completed.
            </div>
        </section>

        <footer class="mdl-mega-footer">
            <div class="mdl-mega-footer--bottom-section">
                <div class="mdl-logo">
                    © Nids & Sidd
                </div>
                <ul class="mdl-mega-footer--link-list">
                    <li><a href="https://github.com/iProdigy/chem-cram">Source Code</a></li>
                    <li><a href="http://www.micds.org/page">MICDS</a></li>
                    <li><a href="unit.php?name=kinetics">Kinetics</a></li>
                </ul>
            </div>
        </footer>
    </main>
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
