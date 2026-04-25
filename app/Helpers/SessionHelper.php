<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class SessionHelper
{
    /**
     * Check if session has expired due to inactivity
     */
    public static function isSessionExpired()
    {
        $lastActivity = Session::get('last_activity');
        $timeout = 600; // 10 minutes in seconds
        
        if ($lastActivity && (time() - $lastActivity) > $timeout) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Update last activity timestamp
     */
    public static function updateActivity()
    {
        Session::put('last_activity', time());
    }
    
    /**
     * Get remaining session time in seconds
     */
    public static function getRemainingTime()
    {
        $lastActivity = Session::get('last_activity');
        $timeout = 600; // 10 minutes in seconds
        
        if ($lastActivity) {
            $elapsed = time() - $lastActivity;
            return max(0, $timeout - $elapsed);
        }
        
        return $timeout;
    }
    
    /**
     * Format remaining time for display
     */
    public static function formatRemainingTime()
    {
        $seconds = self::getRemainingTime();
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        
        return sprintf("%02d:%02d", $minutes, $remainingSeconds);
    }
}