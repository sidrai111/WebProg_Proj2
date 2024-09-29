<?php
session_start();

$scores_file = './scores.txt';

//all potential questions for game in easy, medium, and hard categories
$questionsEasy = [
    [
        'question' => 'What is the capital of France?',
        'answers' => ['Berlin', 'Paris', 'Rome', 'Madrid'],
        'correct' => 'Paris'
    ],
    [
        'question' => 'Who wrote the play "Romeo and Juliet"?',
        'answers' => ['William Shakespeare', 'Charles Dickens', 'Jane Austen', 'Mark Twain'],
        'correct' => 'William Shakespeare'
    ],
    [
        'question' => 'Which planet is known as the "Red Planet"?',
        'answers' => ['Venus', 'Mars', 'Jupiter', 'Saturn'],
        'correct' => 'Mars'
    ],
    [
        'question' => 'What is the largest ocean on Earth?',
        'answers' => ['Indian Ocean', 'Atlantic Ocean', 'Pacific Ocean', 'Arctic Ocean'],
        'correct' => 'Pacific Ocean'
    ],
    [
        'question' => 'In what year did the first manned moon landing occur?',
        'answers' => ['1965', '1969', '1975', '1981'],
        'correct' => '1969'
    ],
    [
        'question' => 'What is the capital of Japan?',
        'answers' => ['Seoul', 'Tokyo', 'Beijing', 'Bangkok'],
        'correct' => 'Tokyo'
    ],
    [
        'question' => 'Which element has the chemical symbol "O"?',
        'answers' => ['Oxygen', 'Gold', 'Iron', 'Sodium'],
        'correct' => 'Oxygen'
    ],
    [
        'question' => 'Who is known as the "Father of Computer Science"?',
        'answers' => ['Alan Turing', 'Bill Gates', 'Steve Jobs', 'Tim Berners-Lee'],
        'correct' => 'Alan Turing'
    ],
    [
        'question' => 'What is the currency of the United Kingdom?',
        'answers' => ['Euro', 'Dollar', 'Pound', 'Yen'],
        'correct' => 'Pound'
    ],
    [
        'question' => 'Which Disney character is known for leaving a glass slipper at a royal ball?',
        'answers' => ['Cinderella', 'Ariel', 'Belle', 'Mulan'],
        'correct' => 'Cinderella'
    ],
];

$questionsMedium = [
    [
        'question' => 'Which novel begins with the line, "It was the best of times, it was the worst of times"?',
        'answers' => ['Pride and Prejudice', ' A Tale of Two Cities', '1984', 'The Great Gatsby'],
        'correct' => 'A Tale of Two Cities'
    ],
    [
        'question' => 'What is the largest mammal in the world?',
        'answers' => ['Elephant', 'Blue Whale', 'Giraffe', 'Gorilla'],
        'correct' => 'Blue Whale'
    ],
    [
        'question' => 'Who painted the Mona Lisa?',
        'answers' => ['Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Michelangelo'],
        'correct' => 'Leonardo da Vinci'
    ],
    [
        'question' => 'What is the chemical symbol for gold?',
        'answers' => ['Gd', 'Au', 'Ag', 'Fe'],
        'correct' => 'Au'
    ],
    [
        'question' => 'Which planet is known as the "Morning Star" or "Evening Star"?',
        'answers' => ['Mars', 'Venus', 'Mercury', 'Jupiter'],
        'correct' => 'Venus'
    ],
    [
        'question' => 'In what year did World War II end?',
        'answers' => ['1943', '1945', '1947', '1950'],
        'correct' => '1945'
    ],
    [
        'question' => 'Who wrote the play "Hamlet"?',
        'answers' => ['William Wordsworth', 'William Faulkner', 'William Shakespeare', 'William Blake'],
        'correct' => 'William Shakespeare'
    ],
    [
        'question' => 'What is the largest organ in the human body?',
        'answers' => ['Heart', 'Liver', 'Skin', 'Brain'],
        'correct' => 'Skin'
    ],
    [
        'question' => 'Which gas is most abundant in the Earth\'s atmosphere?',
        'answers' => ['Nitrogen', 'Oxygen', 'Carbon Dioxide', 'Hydrogen'],
        'correct' => 'Nitrogen'
    ],
    [
        'question' => 'Which famous scientist developed the theory of general relativity?',
        'answers' => ['Isaac Newton', 'Albert Einstein', 'Galileo Galilei', 'Stephen Hawking'],
        'correct' => 'Albert Einstein'
    ],
];

$questionsHard = [
    [
        'question' => 'What is the speed of light in a vacuum, approximately?',
        'answers' => ['300,000 kilometers per second', '150,000 miles per second', '186,282 miles per second', '500,000 kilometers per second'],
        'correct' => '186,282 miles per second'
    ],
    [
        'question' => 'Which element has the highest melting point?',
        'answers' => ['Tungsten', 'Titanium', 'Platinum', 'Rhenium'],
        'correct' => 'Tungsten'
    ],
    [
        'question' => 'Who was the first woman to win a Nobel Prize?',
        'answers' => ['Marie Curie', 'Rosalind Franklin', 'Dorothy Crowfoot Hodgkin', 'Barbara McClintock'],
        'correct' => 'Marie Curie'
    ],
    [
        'question' => 'In what year did the Chernobyl nuclear disaster occur?',
        'answers' => ['1980', '1986', '1991', '1975'],
        'correct' => '1986'
    ],
    [
        'question' => 'What is the smallest prime number?',
        'answers' => ['0', '1', '2', '3'],
        'correct' => '2'
    ],
    [
        'question' => 'Who wrote the epic poem "Paradise Lost"?',
        'answers' => ['John Keats', 'Samuel Taylor Coleridge', 'John Milton', 'Geoffrey Chaucer'],
        'correct' => 'John Milton'
    ],
    [
        'question' => 'What is the molecular formula of water?',
        'answers' => ['H2O2', 'CO2', 'H2O', 'CH4'],
        'correct' => 'H2O'
    ],
    [
        'question' => 'Which planet is known as the "Ice Giant"?',
        'answers' => ['Uranus', 'Neptune', 'Saturn', 'Jupiter'],
        'correct' => 'Neptune'
    ],
    [
        'question' => 'What is the largest desert in the world by area?',
        'answers' => ['Sahara Desert', 'Antarctic Desert', 'Arabian Desert', 'Gobi Desert'],
        'correct' => 'Antarctic Desert'
    ],
    [
        'question' => 'Who is credited with the discovery of penicillin?',
        'answers' => ['Alexander Fleming', 'Louis Pasteur', 'Joseph Lister', 'Marie Curie'],
        'correct' => 'Alexander Fleming'
    ],
];

//Compiling a random set of 5 easy, 5 medium, and 5 hard questions at beginning of session
if (!isset($_SESSION['shuffledQuestions'])) {
    
    $shuffledQuestionsEasy = $questionsEasy;
    $shuffledQuestionsMedium = $questionsMedium;
    $shuffledQuestionsHard = $questionsHard;

    //Shuffling each of the question arrays at the beginning of the session
    shuffle($shuffledQuestionsEasy);
    shuffle($shuffledQuestionsMedium);
    shuffle($shuffledQuestionsHard);

    //Function to shuffle answers order for a single given question
    function shuffleAnswers($question) {
        $answers = $question['answers'];
        shuffle($answers);
        return $answers;
    }

    //Shuffling answers order for each question using the shuffleAnswers function
    //Same process for each array
    foreach ($shuffledQuestionsEasy as $key => $question) {
        $shuffledQuestionsEasy[$key]['answers'] = shuffleAnswers($question);
    }
    foreach ($shuffledQuestionsMedium as $key => $question) {
        $shuffledQuestionsMedium[$key]['answers'] = shuffleAnswers($question);
    }
    foreach ($shuffledQuestionsHard as $key => $question) {
        $shuffledQuestionsHard[$key]['answers'] = shuffleAnswers($question);
    }

    //Taking the first five questions from each shuffled array
    $selectedEasy = array_slice($shuffledQuestionsEasy, 0, 5);
    $selectedMedium = array_slice($shuffledQuestionsMedium, 0, 5);
    $selectedHard = array_slice($shuffledQuestionsHard, 0, 5);

    //Compiling the selected questions into one final array
    $_SESSION['shuffledQuestions'] = array_merge($selectedEasy, $selectedMedium, $selectedHard);

}




// Function to get the top 5 high scores
function get_high_scores($scores_file) {
    if (!file_exists($scores_file)) {
        return [];
    }
    $scores = file($scores_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $high_scores = [];
    foreach ($scores as $score_line) {
        list($score, $name) = explode('|', $score_line);
        $high_scores[$name] = (int)$score;
    }
    arsort($high_scores);
    return array_slice($high_scores, 0, 5);
}

// Function to save the score
function save_score($name, $score, $scores_file) {
    $scores = get_high_scores($scores_file);
    $scores[$name] = $score;
    arsort($scores);
    $scores_data = [];
    foreach ($scores as $name => $score) {
        $scores_data[] = $score . '|' . $name;
    }
    file_put_contents($scores_file, implode("\n", $scores_data));
}




// Check if a new game is starting with a player's name
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['player_name'])) {
    $_SESSION['player_name'] = filter_var(trim($_POST['player_name']), FILTER_SANITIZE_STRING);
    $_SESSION['score'] = 0;
    $_SESSION['current_question_index'] = 0;
    $_SESSION['used_lifelines'] = [];


     // Redirect to start the game with a clean URL
     header('Location: index.php');
    exit;
}

// Process the lifeline
function use_lifeline($lifeline) {
    global $questions;

    if ($lifeline === 'fifty_fifty' && !in_array('fifty_fifty', $_SESSION['used_lifelines'])) {
        $_SESSION['used_lifelines'][] = 'fifty_fifty';
        $current_question =  $_SESSION['shuffledQuestions'][$_SESSION['current_question_index']];
        $incorrectAnswers = array_keys(array_diff($current_question['answers'], [$current_question['answers'][$current_question['correct']]]));
        shuffle($incorrectAnswers);
        array_splice($incorrectAnswers, 2);
        $_SESSION['fifty_fifty_options'] = array_diff_key($current_question['answers'], array_flip($incorrectAnswers));
    }
}

// Check if a lifeline was used
if (isset($_POST['lifeline'])) {
    use_lifeline($_POST['lifeline']);
}

// Check if an answer was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $selection = $_POST['answer'];

    $current_question =  $_SESSION['shuffledQuestions'][$_SESSION['current_question_index']];
    $correct = $current_question['correct'];

    //debugging
    print("Chosen answer: " . $selection . "<br>");
    print("Array Correct:" . $correct . "<br>");
    //end debugging

    if ( $selection == $correct) {
        $_SESSION['score'] += 1; // Increase score for correct answer
        $_SESSION['current_question_index'] += 1; // Move to next question
        unset($_SESSION['fifty_fifty_options']); // Reset the 50:50 lifeline options
    } else {
        // Wrong answer, reset the game
        $game_over = true;
        session_destroy();
    }
}



// Get the current question or end the game
if (isset($_SESSION['shuffledQuestions'][$_SESSION['current_question_index']])) {
    $current_question =  $_SESSION['shuffledQuestions'][$_SESSION['current_question_index']];
    // Apply the 50:50 lifeline if it has been used for this question
    if (isset($_SESSION['fifty_fifty_options'])) {
        $current_question['answers'] = $_SESSION['fifty_fifty_options'];
    }
} else {
    $game_over = true;
    if (isset($_SESSION['player_name'])) {
        save_score($_SESSION['player_name'], $_SESSION['score'], $scores_file);
    }
    session_destroy();
}

// Get the top 5 high scores to display
$high_scores = get_high_scores($scores_file);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Who Wants to Be a Millionaire</title>
    <link rel="stylesheet" href="./teststyles.css">
</head>
<body>
    <div class="leaderboard">
        <h3>Leaderboard</h3>
        <ol>
            <?php foreach ($high_scores as $name => $score): ?>
                <li><?php echo htmlspecialchars($name) . ' - ' . $score; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
    
    <?php if (!isset($_SESSION['player_name'])): ?>
        <form action="index.php" method="post">
            <label for="player_name">Enter your name:</label>
            <input type="text" id="player_name" name="player_name" required>
            <button type="submit">Start Game</button>
        </form>
    <?php elseif (!isset($game_over)): ?>

        <!--debugging-->
        <?php
        foreach ($_SESSION['shuffledQuestions'] as $key => $question) {
            echo "Question: " . $question['question'] . "<br>";
            echo "Answers: " . implode(", ", $question['answers']) . "<br>";
            echo "Correct Answer: " . $question['correct'] . "<br><br>";
        }
        ?>
        <!--end debugging-->


        <div class="game">
            <div class="question">
                <p><?php echo htmlspecialchars($current_question['question']); ?></p>
            </div>
            <div class="answers">
                <form action="index.php" method="post">
                    <?php foreach ($current_question['answers'] as $answer): ?>
                        <button type="submit" name="answer" value="<?php echo $answer; ?>">
                            <?php echo htmlspecialchars($answer); ?>
                        </button>
                    <?php endforeach; ?>
                    <?php if (!in_array('fifty_fifty', $_SESSION['used_lifelines'])): ?>
                        <button type="submit" name="lifeline" value="fifty_fifty">Use 50:50</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p>Game over! Your final score was: <?php echo $_SESSION['score']; ?></p>
        <a href="index.php">Play again</a>
    <?php endif; ?>
</body>
</html>