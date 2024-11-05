<?php
function convertBSToAD($bsYear, $bsMonth, $bsDay) {
    $bs_month_days = [
        2070 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2071 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2072 => [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2073 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2074 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2075 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2076 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2077 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2078 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2079 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2080 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2081 => [30, 32, 31, 32, 31, 30, 29, 30, 29, 30, 29, 31],
        2082 => [31, 31, 31, 32, 31, 30, 30, 29, 29, 30, 29, 31],
        2083 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2084 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2085 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2086 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2087 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2088 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2089 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2090 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2091 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2092 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2093 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2094 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2095 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2096 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2097 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2098 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2099 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2100 => [31, 31, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
    ];

    $bs_to_ad_start = [
        2070 => '2013-04-14',
        2071 => '2014-04-14',
        2072 => '2015-04-14',
        2073 => '2016-04-13',
        2074 => '2017-04-14',
        2075 => '2018-04-14',
        2076 => '2019-04-14',
        2077 => '2020-04-13',
        2078 => '2021-04-14',
        2079 => '2022-04-14',
        2080 => '2023-04-14',
        2081 => '2024-04-14',
        2082 => '2025-04-14',
        2083 => '2026-04-14',
        2084 => '2027-04-14',
        2085 => '2028-04-14',
        2086 => '2029-04-14',
        2087 => '2030-04-14',
        2088 => '2031-04-14',
        2089 => '2032-04-14',
        2090 => '2033-04-14',
        2091 => '2034-04-14',
        2092 => '2035-04-14',
        2093 => '2036-04-14',
        2094 => '2037-04-14',
        2095 => '2038-04-14',
        2096 => '2039-04-14',
        2097 => '2040-04-14',
        2098 => '2041-04-14',
        2099 => '2042-04-14',
        2100 => '2043-04-14',
    ];

    if (!isset($bs_month_days[$bsYear]) || !isset($bs_to_ad_start[$bsYear])) {
        throw new Exception('Year data not available for conversion.');
    }

    // Calculate total days from the start of the BS year to the given BS date
    $total_days = 0;
    for ($m = 1; $m < $bsMonth; $m++) {
        $total_days += $bs_month_days[$bsYear][$m - 1];
    }
    $total_days += $bsDay;

    // Get the start date of the corresponding AD year
    $adStartDate = new DateTime($bs_to_ad_start[$bsYear]);

    // Add total days to the start date
    $adStartDate->modify("+".($total_days - 1)." days");

    // Return the converted AD date
    return $adStartDate->format('Y-m-d');
}

function calculateSemester($intakeYearBS, $intakeMonthBS=1, $intakeDayBS=1) {
    // Convert intake date from BS to AD
    $intakeDateAD = new DateTime(convertBSToAD($intakeYearBS, $intakeMonthBS, $intakeDayBS));

    // Get the current date
    $currentDate = new DateTime();
    
    // // Set the date to 2024-10-10 (Year, Month, Day)
    // $currentDate->setDate(2024, 10,13 ); 

    // Calculate the number of days since the intake date
    $daysSinceIntake = $intakeDateAD->diff($currentDate)->days;

    // Adjust days since intake based on the intake year condition
    if ($intakeYearBS < 2080) {
        $adjustmentDays = 182; // 6 months = 182 days
    } else {
        $adjustmentDays = 365; // 1 year = 365 days
    }

    // Calculate total days since intake
    $totalDaysSinceIntake = $daysSinceIntake + $adjustmentDays;

    // Calculate the total number of semesters completed since the intake
    $totalSemestersCompleted = floor($totalDaysSinceIntake / 182.5); // 6 months = 180 days

    // The current semester is the next one after the completed semesters
    $currentSemester = $totalSemestersCompleted-2;

    return $currentSemester;
}


?>
