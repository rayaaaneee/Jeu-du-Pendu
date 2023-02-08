<?php require_once 'header.php';
require_once PATH_DTO . 'GameDTO.php';

$game = unserialize($_SESSION['game']);

if (isset($_POST['word'])) {

    $word = $_POST['word'];
    $_SESSION['word'] = $word;

    $game->setWord($word);
} else if (isset($_POST['letter'])) {
    $letter = $_POST['letter'];
    $game->setAllLetters();
    $game->tryLetter($letter);
} else {
    header('Location: ./');
}

$game->saveInSession();

?>
<div class="main-container-game-page">
    <div class="game-container">
        <div class="word">
            <p>Mot :</p>
            <?= $game->printWord(); ?>
        </div>
        <div class="form-img-container">
            <form action="./gamePage.php" class="form-letter" method="post">
                <input type="text" name="letter" class="input-letter" maxlength="1" placeholder="Votre lettre" required>
                <input type="submit" class="submit-letter" value="Envoyer">
            </form>
            <?= $game->printImage(); ?>
        </div>
        <?= $game->printFalseLetters(); ?>
        <div class="nb-tries-container">
            <?= $game->printErrors(); ?>
        </div>
    </div>
    <?php require_once 'footer.php'; ?>