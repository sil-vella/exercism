<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Game
{
    private array $rolls = [];
    private array $currentFrameRolls = [];
    private int $currentFrame = 1;
    private bool $gameComplete = false;

    public function roll(int $pins): void
    {
        if ($pins < 0 || $pins > 10) {
            throw new InvalidArgumentException(
                'A roll must be between 0 and 10 pins'
            );
        }

        if ($this->gameComplete) {
            throw new LogicException('The game is already complete');
        }

        if ($this->currentFrame < 10) {
            $this->rollNormalFrame($pins);
        } else {
            $this->rollTenthFrame($pins);
        }

        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        if (!$this->gameComplete) {
            throw new LogicException('The game is not complete');
        }

        $score = 0;
        $rollIndex = 0;

        // Score frames 1 through 9.
        for ($frame = 1; $frame <= 9; $frame++) {
            if ($this->rolls[$rollIndex] === 10) {
                // Strike: current roll plus the next two rolls.
                $score += 10
                    + $this->rolls[$rollIndex + 1]
                    + $this->rolls[$rollIndex + 2];

                $rollIndex++;
            } elseif (
                $this->rolls[$rollIndex]
                + $this->rolls[$rollIndex + 1] === 10
            ) {
                // Spare: two current rolls plus the next roll.
                $score += 10 + $this->rolls[$rollIndex + 2];
                $rollIndex += 2;
            } else {
                // Open frame.
                $score += $this->rolls[$rollIndex]
                    + $this->rolls[$rollIndex + 1];

                $rollIndex += 2;
            }
        }

        // All remaining rolls belong to the tenth frame.
        while ($rollIndex < count($this->rolls)) {
            $score += $this->rolls[$rollIndex];
            $rollIndex++;
        }

        return $score;
    }

    private function rollNormalFrame(int $pins): void
    {
        // First roll of a frame.
        if ($this->currentFrameRolls === []) {
            if ($pins === 10) {
                // A strike completes the frame immediately.
                $this->currentFrame++;
                return;
            }

            $this->currentFrameRolls[] = $pins;
            return;
        }

        // Second roll of a frame.
        $firstRoll = $this->currentFrameRolls[0];

        if ($firstRoll + $pins > 10) {
            throw new InvalidArgumentException(
                'Two rolls in a frame cannot exceed 10 pins'
            );
        }

        $this->currentFrameRolls = [];
        $this->currentFrame++;
    }

    private function rollTenthFrame(int $pins): void
    {
        $rollNumber = count($this->currentFrameRolls);

        // First roll.
        if ($rollNumber === 0) {
            $this->currentFrameRolls[] = $pins;
            return;
        }

        $firstRoll = $this->currentFrameRolls[0];

        // Second roll.
        if ($rollNumber === 1) {
            if ($firstRoll < 10 && $firstRoll + $pins > 10) {
                throw new InvalidArgumentException(
                    'Two rolls in a frame cannot exceed 10 pins'
                );
            }

            $this->currentFrameRolls[] = $pins;

            // An open tenth frame finishes after two rolls.
            if ($firstRoll < 10 && $firstRoll + $pins < 10) {
                $this->gameComplete = true;
            }

            return;
        }

        // Third roll: only available after a strike or spare.
        $secondRoll = $this->currentFrameRolls[1];

        if (
            $firstRoll === 10
            && $secondRoll < 10
            && $secondRoll + $pins > 10
        ) {
            throw new InvalidArgumentException(
                'Fill-ball rolls cannot exceed 10 pins'
            );
        }

        $this->currentFrameRolls[] = $pins;
        $this->gameComplete = true;
    }
}