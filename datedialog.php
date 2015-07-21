<?php
/**
 * Name: Date dialog picker
 * Author: Denis Kuschenko
 * Email : ziffyweb@gmail.com
 * Date: 21.07.15
 */

function createOptionYear($yearType){
    $res = '';
    $date = getdate();
    $date = $date['year'];
    if ($yearType=='from') {
        for ($i = 1990; $i <= $date; $i++) {
            $res.=  '<option value="'.$i.'">' .$i.' </option>';
        }
    } else {
        for ($i = $date; $i >= 1900; $i--) {
            $res.=  '<option value="'.$i.'">' .$i.' </option>';
        }
    }
    return $res;
}
function createOptionMonth(){
    $res = '';
    for ($i = 1; $i <= 12; $i++) {
        if ($i<10) {
            $res.= '<option value="0'.$i.'">0' .$i.' </option>';
        } else {
            $res.= '<option value="'.$i.'">' .$i.' </option>';
        }
    }
    return $res;
}
function createOptionDay(){
    $res='';
    for ($i = 1; $i <= 31; $i++) {
        if ($i<10) {
            $res.= '<option value="0'.$i.'">0' .$i.' </option>';
        } else {
            $res.='<option value="'.$i.'">' .$i.' </option>';
        }
    }
    return $res;
}

function createDateDialog($yearType) {
    if ($yearType=='from') {
        $year = createOptionYear($yearType);
    } else {
        $year = createOptionYear($yearType);
    }
    $month = createOptionMonth();
    $day = createOptionDay();

    echo '    <select name="date3">
                    '.$year.'
                </select>
                <select  name="date2" >
                    '.$month.'
                </select>
                <select  name="date1" >
                    '.$day.'
                </select>';
}