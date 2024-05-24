<?php

class Rpsls
{
    private array $choices = ["rock", "paper", "scissors", "lizard", "spock"];
    private bool $gameActive = true;
    private array $gameRules = [
        "rock" => ["scissors", "lizard"],
        "paper" => ["rock", "spock"],
        "scissors" => ["paper", "lizard"],
        "lizard" => ["spock", "paper"],
        "spock" => ["rock", "scissors"],
    ];

    private function setGameActive(bool $gameActive): void
    {
        $this->gameActive = $gameActive;
    }

    private function getGameActive(): bool
    {
        return $this->gameActive;
    }

    private function getPlayerChoice(): string
    {
        while (true) {
            $playerChoice = strtolower(readline('Choose rock, paper, scissors, lizard, or spock: '));

            if (in_array($playerChoice, $this->choices)) {
                return $playerChoice;
            }

            echo "Please enter a valid choice" . PHP_EOL;
        }
    }

    private function determineWinner(string $playerChoice, string $computerChoice): string
    {
        if ($playerChoice === $computerChoice) {
            $this->setGameActive(false);
            return "its a tie!";
        } else if (in_array($computerChoice, $this->gameRules[$playerChoice])) {
            $this->setGameActive(false);
            return "You win!";
        } else {
            $this->setGameActive(false);
            return "You lose!";
        }
    }

    public function startGame(): void
    {
        while ($this->getGameActive()) {
            $playerChoice = $this->getPlayerChoice();

            $computerChoice = $this->choices[array_rand($this->choices, 1)];
            echo "Computer chose $computerChoice " . PHP_EOL;

            $roundOutput = $this->determineWinner($playerChoice, $computerChoice);

            echo $roundOutput . PHP_EOL;
        }
    }
}

$game = new Rpsls();
$game->startGame();