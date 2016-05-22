<?php
include("Unit.class.php");
include("Topic.class.php");
include("Question.class.php");

$ran = false;
$units = [];

if (!$ran) {
    # read from json file and put into units
    $unitFiles = glob('resources/*.unit.json', GLOB_BRACE);
    foreach ($unitFiles as $unitFile) {
        $unitStr = file_get_contents($unitFile);
        $json = json_decode($unitStr, true);

        $unit = new Unit();

        foreach ($json as $key => $value) {
            switch ($key) {
                case "id":
                    $unit->id = $value;
                    break;

                case "name":
                    $unit->name = $value;
                    break;

                case "topics":
                    $topics = [];

                    # convert topic json file names into references to the corresponding Topic object
                    foreach ($value as $topicFileStr) {
                        $topic = new Topic();
                        $topicStr = file_get_contents("resources/" . $topicFileStr);
                        $topicJson = json_decode($topicStr);

                        foreach ($topicJson as $topicKey => $topicValue) {
                            switch ($topicKey) {
                                case "id":
                                    $topic->id = $topicValue;
                                    break;

                                case "name":
                                    $topic->name = $topicValue;
                                    break;

                                case "notes":
                                    $topic->notes = $topicValue;
                                    break;

                                case "videos":
                                    $topic->videos = $topicValue;
                                    break;

                                case "questions":
                                    $questions = [];

                                    # convert json objects into question objects
                                    foreach ($topicValue as $questionObj) {
                                        $question = new Question();

                                        foreach ($questionObj as $questionKey => $questionValue) {
                                            switch ($questionKey) {
                                                case "prompt":
                                                    $question->prompt = $questionValue;
                                                    break;

                                                case "answer":
                                                    $question->answer = $questionValue;
                                                    break;

                                                case "choices":
                                                    $question->choices = $questionValue;
                                                    break;

                                                default:
                                                    break;
                                            }
                                        }

                                        array_push($questions, $question);
                                    }

                                    $topic->questions = $questions;
                                    break;

                                default:
                                    break;
                            }
                        }

                        array_push($topics, $topic);
                    }

                    $unit->topics = $topics;
                    break;

                default:
                    break;
            }
        }

        array_push($units, $unit);
    }

    $ran = true;
}

return $units;
