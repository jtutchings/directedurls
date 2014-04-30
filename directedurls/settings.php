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

$settings->add(new admin_setting_heading('block_directedurls_block',
                                         get_string('blockbehaviourheading', 'block_directedurls'),
                                         get_string('blockbehaviourtext', 'block_directedurls')));
$settings->add(new admin_setting_confightmleditor(
            'directedurls/Block_Top_Text',
            get_string('labelblocktoptext', 'block_directedurls'),
            get_string('descblocktoptext', 'block_directedurls'),
            ''
        ));
$settings->add(new admin_setting_confightmleditor(
            'directedurls/Block_Footer_Text',
            get_string('labelblockfootertext', 'block_directedurls'),
            get_string('descblockfootertext', 'block_directedurls'),
            ''
        ));


$link = '<a href="'.$CFG->wwwroot.'/blocks/directedurls/manageurls.php">' .
            get_string('manageurls', 'block_directedurls') . '</a>';

$settings->add(new admin_setting_heading('block_directedurls', '', $link));

//
// Front Page Settings.
//
$settings->add(new admin_setting_heading('block_directedurls_frontpage',
                                         get_string('frontpagebehaviourheading', 'block_directedurls'),
                                         get_string('frontpagebehaviourtext', 'block_directedurls')));


$settings->add(new admin_setting_configtext(
            'directedurls/Frontpage_Link_Text',
            get_string('labelfrontpagelinktext', 'block_directedurls'),
            get_string('descfrontpagelinktext', 'block_directedurls'),
            ''
        ));

$settings->add(new admin_setting_confightmleditor(
            'directedurls/Frontpage_Top_Text',
            get_string('labelfrontpagetoptext', 'block_directedurls'),
            get_string('descfrontpagetoptext', 'block_directedurls'),
            ''
        ));
$settings->add(new admin_setting_confightmleditor(
            'directedurls/Frontpage_Footer_Text',
            get_string('labelfrontpagefootertext', 'block_directedurls'),
            get_string('descfrontpagefootertext', 'block_directedurls'),
            ''
        ));

