<?php

/**
 * Get the list of quiz difficulty levels.

 * Each difficulty contains:
 * - difficulty_id : Unique numeric identifier
 * - difficulty    : Human-readable difficulty name
 *
 * @return array<int, array{difficulty_id:int, difficulty:string}>
 */
function get_difficulties()
{
    return [
        ['difficulty_id' => 1, 'difficulty' => 'Easy'],
        ['difficulty_id' => 2, 'difficulty' => 'Medium'],
        ['difficulty_id' => 3, 'difficulty' => 'Hard'],
    ];
}
