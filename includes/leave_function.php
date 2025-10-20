<?php
// includes/leave_functions.php

function calculateLeaveDays($start_date, $end_date) {
    // Calculate business days (excluding weekends)
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $end->modify('+1 day'); // Include end date
    
    $interval = new DateInterval('P1D');
    $period = new DatePeriod($start, $interval, $end);
    
    $days = 0;
    foreach ($period as $date) {
        $dayOfWeek = $date->format('N'); // 1-7 (Mon-Sun)
        if ($dayOfWeek < 6) { // Monday to Friday (1-5)
            $days++;
        }
    }
    return $days;
}

function getLeaveBalance($user_id, $leave_type, $year_month) {
    global $conn;
    
    $sql = "SELECT * FROM leave_balances 
            WHERE user_id = ? AND leave_type = ? AND year_month = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $leave_type, $year_month);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        // Create new balance record with default values
        $default_allowed = getDefaultLeaveLimit($leave_type);
        $sql = "INSERT INTO leave_balances (user_id, leave_type, year_month, allowed_days) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $user_id, $leave_type, $year_month, $default_allowed);
        
        if ($stmt->execute()) {
            return [
                'user_id' => $user_id,
                'leave_type' => $leave_type,
                'year_month' => $year_month,
                'allowed_days' => $default_allowed,
                'taken_days' => 0
            ];
        } else {
            // Return default structure even if insert fails
            return [
                'user_id' => $user_id,
                'leave_type' => $leave_type,
                'year_month' => $year_month,
                'allowed_days' => $default_allowed,
                'taken_days' => 0
            ];
        }
    }
}

function getDefaultLeaveLimit($leave_type) {
    $limits = [
        'Casual Leave' => 5,
        'Sick Leave' => 10,
        'Earned Leave' => 12,
        'Vacation' => 15
    ];
    return $limits[$leave_type] ?? 5; // Default to 5 if not found
}

function updateLeaveBalance($user_id, $leave_type, $year_month, $days, $operation = 'add') {
    global $conn;
    
    $balance = getLeaveBalance($user_id, $leave_type, $year_month);
    $new_taken = ($operation === 'add') 
        ? $balance['taken_days'] + $days 
        : max(0, $balance['taken_days'] - $days); // Prevent negative values
    
    $sql = "UPDATE leave_balances SET taken_days = ? 
            WHERE user_id = ? AND leave_type = ? AND year_month = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $new_taken, $user_id, $leave_type, $year_month);
    return $stmt->execute();
}
?>