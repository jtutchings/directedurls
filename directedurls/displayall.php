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

/**
 *
 *
 * @package   moodlecore
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');

require_once(dirname(__FILE__).'/lib.php');

require_login();
$baseurl = new moodle_url('/blocks/directedurls/displayall.php');
$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));
$PAGE->set_url($baseurl);
$PAGE->requires->js('/blocks/directedurls/displayall.js', true);


$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_config('directedurls', 'Display_All_Title'));
$PAGE->set_heading(get_config('directedurls', 'Display_All_Heading'));
$PAGE->navbar->add(get_config('directedurls', 'Display_All_Heading'));

echo $OUTPUT->header();
/*
 * First work out the personal and module links
 */

$courses = enrol_get_my_courses();

// Get a list of the modules that need to be linked.
$modulestolink = array();
foreach ($courses as $course) {
    if (directedurls_is_cohort($course)) {
        $modulestolink[$course->shortname] = $course->fullname;
    }

}
$userdetails = new object();
$userdetails->username = directedurls_get_username();
$userdetails->studid = directedurls_get_studid();
$username = directedurls_get_username();
$studid = directedurls_get_studid();
$links = $DB->get_records('block_directedurls', array('visible' => 1), 'sortorder');

$personlinks = array();
$courselinks = array();
foreach ($links as $link) {
    if (preg_match('/#MODULE#|#COHORT#/', $link->url)) {
        // It is a module or cohort link so.
        $courselinks[] = $link;
    } else {
        $personlinks[] = $link;
    }
}

$tabbedcontent = array();

if ($personlinks) {

    $plinks = array();
    foreach ($personlinks as $plink) {

        $newlink = directedurls_create_url($plink, $userdetails);
        if ($plink->iframe) {
            $tabbedcontent['tab' . $plink->id]['title'] = $plink->displaytext;
            $tabbedcontent['tab' . $plink->id]['content'] = html_writer::tag('iframe', '', array('src' => $newlink,
                                                                                                  'width' => '100%',
                                                                                                  'height' => '100%', ));
        } else {
            $plinks[] = html_writer::tag('a',
                                    $plink->displaytext,
                                    array('href' => $newlink, 'target' => '_blank'));
        }
    }
    if ($plinks) {
        $tabbedcontent['tabp']['title'] = 'Other personal links';
        $tabbedcontent['tabp']['content'] = html_writer::alist($plinks);
    }

}

/*
 * Now the module links
 */
$tabbedcontent['tabm']['title'] = 'Module Related Links';
if ($modulestolink && $courselinks) {

    $table = new html_table();

    // We need to seperate out links that are not module or cohort links.
    // These will be displayed once at the top of the page.

    $colheadings = array();
    $colheadings[] = get_string('modules', 'block_directedurls');
    foreach ($courselinks as $link) {
        $colheadings[] = $link->displaytext;
    }
    $table->head = $colheadings;

    // Now to populate the table.

    foreach ($modulestolink as $shortname => $fullname) {

        $rowdata = array();

        $rowdata[] = $shortname . ' - ' . $fullname;
        $module = $shortname;

        foreach ($courselinks as $link) {

            $newlink = directedurls_create_url($link, $userdetails, $module);
            $rowdata[] = html_writer::tag('a',
                                          get_string('view', 'block_directedurls'),
                                          array('href' => $newlink));

        }
        $table->data[] = $rowdata;


    }
    $tabbedcontent['tabm']['content'] = html_writer::table($table);

} else {
    echo get_string('nomodulelinkstodisplay', 'block_directedurls');
}

echo get_config('directedurls', 'Frontpage_Top_Text');
$tabheaders = array();
$tabtext = '';
foreach ($tabbedcontent as $tab => $tabdetails) {
    $tabheaders[] = html_writer::tag('a', $tabdetails['title'], array('href' => '#' . $tab, ));

    $tabtext .= html_writer::start_tag('div', array('id' => $tab, 'style' => 'height:50%'));
    if (isset($tabdetails['content'])) {
        $tabtext .= $tabdetails['content'];
    } else {
        $tabtext .= 'Nothing to display';
    }

    $tabtext .= html_writer::end_tag('div');

}

    echo html_writer::start_tag('div', array('id' => "tabContainer"));

    echo html_writer::alist($tabheaders);
    echo html_writer::start_tag('div');

    echo $tabtext;

    echo html_writer::end_tag('div');
    echo html_writer::end_tag('div');

echo get_config('directedurls', 'Frontpage_Footer_Text');
echo $OUTPUT->footer();