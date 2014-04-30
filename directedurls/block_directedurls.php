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
 * Directedurls Block code.
 *
 * @package    local
 * @subpackage directedurls
 * @copyright  2012 Coventry University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(__FILE__).'/lib.php');

class block_directedurls extends block_base {

    public function init() {
        $this->title = get_string('blocktitle', 'block_directedurls');
        $this->version = 2009042104;
    }

    public function instance_allow_config() {
        return false;
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function has_config() {
        return true;
    }

    public function get_content() {

        global $CFG;
        global $DB;
        global $COURSE;

        // First find out it we are in a course that wants the links displayed.

        $iscohort = directedurls_is_cohort();
        $this->content = new stdClass();

        if (!$iscohort) {
            if ($COURSE->id == 1) {
                $displayallurl = new moodle_url('/blocks/directedurls/displayall.php');
                $this->content->text = html_writer::tag('a',
                                            get_string('linktoall',
                                                'block_directedurls'),
                                            array('href' => $displayallurl));
            } else {
                $this->content->text = '';
            }

            return $this->content;
        }

        /*
         * We are going to substitute several values in the set of urls
         * this values will be:
         * USERNAME
         * STUDENT ID
         * MODULE
         * MODULE COHORT
         *
         * to allow for different uses of the course fields the extracting of the
         * fields to use is given over to the functions in ./directedurlslib.php
         *
         */
        $username = directedurls_get_username();
        $studid = directedurls_get_studid();
        $modulecode = directedurls_get_module_code();
        $cohort = directedurls_get_cohort();

        if (! empty($this->config->blocktitle)) {
            $this->title = $this->config->blocktitle;
        }

        $this->content = new stdClass;

        // Set any text that needs to go at the top of the block.
        $blocktoptext = get_config('directedurls', 'Block_Top_Text');
        $this->content->text = isset($blocktoptext)?$blocktoptext :'';

        $links = $DB->get_records('block_directedurls', array('visible' => 1), 'sortorder ASC');
        $urlstring = '';
        foreach ($links as $link) {

            $newlink = $link->url;
            $newlink = preg_replace('/#USERNAME#/', $username, $newlink );
            $newlink = preg_replace('/#STUDID#/', $studid, $newlink );
            $newlink = preg_replace('/#MODULE#/', $modulecode, $newlink );
            $newlink = preg_replace('/#COHORT#/', $cohort, $newlink );

            $this->content->text .= $this->directedurls_format_url($link->displaytext, $newlink) . '<br />';
        }

        $this->content->text .= $urlstring;

        // Finally the footer.
        $footertext = get_config('directedurls', 'Block_Footer_Text');
        $this->content->footer = isset($footertext)?$footertext:'';

        return $this->content;
    }

    private function directedurls_format_url($text, $url) {
        return '<a href="' . $url . '" target="_blank">' . $text . '</a>';
    }

    public function specialization() {
        global $CFG;

        if (! empty($this->config->blocktitle)) {
            $this->title = $this->config->blocktitle;
        }
    }

}