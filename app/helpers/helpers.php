<?php

function timeZoneformatDate($value)
{
    $timezone = 'Asia/Dhaka';
    $today = new DateTime($value, new DateTimeZone($timezone));
    $today->setTimezone(new DateTimeZone($timezone));
    $value = $today->format('Y-m-d h:m:s');

    $date_format_type = 'dd-M-yyyy';
    $separator = '-' == ',' ? ' ' : '-';
    $data = str_replace(['/', '.', ' ', '-', ','], $separator, $date_format_type);

    $data = explode($separator, $data);
    $first = $data[0];
    $second = $data[1];
    $third = $data[2];

    if ($first == 'yyyy' && $second == 'mm' && $third == 'dd') {
        $dateInfo = str_replace(['/', '.', ' ', '-', ','], $separator, $value);
        $datas = explode($separator, $dateInfo);
        $year = $datas[0];
        $month = $datas[1];
        $day = $datas[2];
        $value = $year . $separator . $month . $separator . $day;
    } elseif ($first == 'dd' && $second == 'mm' && $third == 'yyyy') {
        $dateInfo = str_replace(['/', '.', ' ', '-', ','], $separator, $value);
        $datas = explode($separator, $dateInfo);
        $year = $datas[0];
        $month = $datas[1];
        $day = $datas[2];
        $value = $day . $separator . $month . $separator . $year;
    } elseif ($first == 'mm' && $second == 'dd' && $third == 'yyyy') {
        $dateInfo = str_replace(['/', '.', ' ', '-', ','], $separator, $value);
        $datas = explode($separator, $dateInfo);
        $year = $datas[0];
        $month = $datas[1];
        $day = $datas[2];
        $value = $month . $separator . $day . $separator . $year;
    } elseif ($first == 'dd' && $second == 'M' && $third == 'yyyy') {
        $dateInfo = str_replace(['/', '.', ' ', '-', ','], $separator, $value);
        $datas = explode($separator, $dateInfo);
        $year = $datas[0];
        $month = $datas[1];
        $day = $datas[2];

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('M');

        $value = $day . $separator . $monthName . $separator . $year;
    } elseif ($first == 'yyyy' && $second == 'M' && $third == 'dd') {
        $dateInfo = str_replace(['/', '.', ' ', '-', ','], $separator, $value);
        $datas = explode($separator, $dateInfo);
        $year = $datas[0];
        $month = $datas[1];
        $day = $datas[2];

        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('M');
        $value = $year . $separator . $monthName . $separator . $day;
    }
    return $value;
}

function timeZonegetTime($date)
{
    $timezone = 'Asia/Dhaka';

    $userTimezone = new DateTimeZone($timezone);
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime($date, $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    $myInterval = DateInterval::createFromDateString((string)$offset . 'seconds');
    $myDateTime->add($myInterval);
    $time = $myDateTime->format('h:i A');
    return $time;
}

function actionMessage($data='success', $custom = '')
{
    $message = [
        'success' => $custom.' Created Successfully.',
        'delete' => $custom.' Deleted Successfully.',
        'failCustom' => $custom.' Can not be deleted. It has been records.',
        'error' => 'Something went wrong!Try again.',
        'notFound' => $custom.' Not found.',
        'update' => $custom.' Updated Successfully.',
    ];

    return $message[$data];
}
