<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function directedurls_get_username() {
    global $USER;
    return $USER->username;
}

function directedurls_get_studid() {

    global $USER;

    return $USER->idnumber;
}

function directedurls_get_module_code($shortname = null) {
    if ($shortname == null) {
        global $COURSE;
        list($modulecode) = explode('_', $COURSE->shortname);
        return $modulecode;
    } else {
        list($modulecode) = explode('_', $shortname);
        return $modulecode;
    }

}

function directedurls_get_cohort($shortname = null) {
    if ($shortname == null) {
        global $COURSE;

        return $COURSE->shortname;
    } else {
        return $shortname;
    }

}

function directedurls_is_cohort($course = null) {
    if ($course == null) {
        global $COURSE;

        return preg_match('/_/', $COURSE->shortname) > 0;
    } else {
        return preg_match('/_/', $course->shortname) > 0;
    }

}

function directedurls_create_url($link, $userdetails, $module = '') {

    $newurl = preg_replace('/#USERNAME#/', $userdetails->username, $link->url );
    $newurl = preg_replace('/#STUDID#/', $userdetails->studid, $newurl );
    if ($module) {
        $modulecode = directedurls_get_module_code($module);
        $cohort = directedurls_get_cohort($module);
        $newurl = preg_replace('/#MODULE#/', $modulecode, $newurl );
        $newurl = preg_replace('/#COHORT#/', $cohort, $newurl );
    }

    $timestamp = time();
    $newurl = preg_replace('/#TIMESTAMP#/', $timestamp, $newurl );

    if ($link->md5) {
        $newurl = preg_replace('#&#', '&amp;', $newurl, -1);
        $xml = simplexml_load_string( '<text> ' . $newurl . '</text>');

        $fieldstohash = array();
        foreach ($xml as $k => $v) {
            $fieldstohash[] = $v;
        }

        $newurl = preg_replace('/#MD5#/',
                                directedurls_create_hash($fieldstohash,
                                                         $link->sharedsecret ),
                                $newurl );
        $newurl = preg_replace('/<MD5>/', '', $newurl );
        $newurl = preg_replace('/<\/MD5>/', '', $newurl );
        $newurl = preg_replace('#&amp;#', '&', $newurl, -1);
    }

    return $newurl;
}

function directedurls_create_hash($values, $secret) {
    // Get ascii of all param values.
    $data = implode('', $values);
    $asciivalue = 0;
    $size = strlen($data);
    for ($i = 0; $i < $size; $i++) {
        $asciivalue += ord(substr($data, $i, 1));
    }
    // Get md5 of ascii value and secret.
    $mac = md5($asciivalue . $secret);
    return $mac;
}