<?php

use Illuminate\Support\Facades\DB; // Ensure you're using the correct namespace

function addLogs($activity, $userId)
{
    try {
        $result = DB::table('logs')->insert([
            'activity' => $activity,
            'user_id' => $userId,
        ]);

        if (!$result) {
            throw new Exception("Failed to insert log entry.");
        }

        return $result; // true on success
    } catch (Exception $e) {
        // Handle exceptions or log the error message
        error_log($e->getMessage());
        return false; // false on failure
    }
}
