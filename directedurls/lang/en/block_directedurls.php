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

$string['pluginname'] = 'Directed URLS';
$string['headerconfig'] = 'Directed URLS Configuration';
$string['descconfig'] = 'Create the set of urls that need to be displayed';
$string['blockname'] = 'Directed URLS';
$string['blocktitle'] = 'Directed URLS';
$string['modulename'] = 'Directed URLS';
$string['modulenameplural'] = 'Directed URLS';
$string['configtitle'] = 'The title you would like to for the block.';
$string['configtext'] = 'Any variables found within the url text will be substituted with the appropiate value.<br/>
                        Valid variable names are:
                        <ul>
                            <li>#USERNAME#</li>
                            <li>#STUDID# (if set)</li>
                            <li>#MODULE# (the first part of the Short Name, split on an underscore)</li>
                            <li>#COHORT# (the Short Name of the course)</li>
                        </ul>
                        <p>
                        e.g. http://youruni.co.uk/moduleInfo.php?search=#MODULE#<br/>
                        would produce http://youruni.co.uk/moduleInfo.php?search=123ABC
                        </p>
                        <p>
                        <b>Cohort Only:</b> Currently a cohort is any course that has an underscore in the short name so setting
                         this to yes will mean that link will only appear in those courses.
                        </p>
                        <p>
                        <b>Visible:</b> If set to No the link will not be displayed in any course.
                        </p>
                        <p>
                        The way the module code and cohort are derieved along with what makes a course a cohort
                        can be altered by editting the functions supplied in the source code.
                        </p>';
$string['configgatewaytext'] = 'If you would like the link to take people to a particular gateway please put the gateway\'s url here.';
$string['url_text_label'] = 'The text that should appear as the link';
$string['url_label'] = 'The url for the link';
$string['url_visible_label'] = 'Visible';
$string['url_cohortonly_label'] = 'Cohort Only';
$string['labelblocktitle'] = 'Block Title';
$string['descblocktitle'] = 'The title of the block as it will be displayed.';

/*
 * Configuration page text
 */
$string['blockbehaviourheading'] = 'Block Behaviour';
$string['blockbehaviourtext'] = 'Settings for how the block will behave on course pages.';
$string['labelblocktoptext'] = 'Text to display before links';
$string['descblocktoptext'] = 'You can place any text above the series of links.';

$string['labelblockfootertext'] = 'Text to appear in the block footer';
$string['descblockfootertext'] = 'You can place any text below the series of links.';

$string['configtableheaderdisplaytext'] = 'Link Text';
$string['configtableheaderurl'] = 'url';
$string['configtableheadervisible'] = 'Visible';
$string['configtableheaderedit'] = 'Edit';

/*
 * Manage URLS
 */
$string['manageurls'] = 'Manage URLs';
$string['deleteurlconfirm'] = 'Are you sure you want to delete this url?';

/*
 * Edit URL
 */
$string['addnewurl'] = 'Add New URL';
$string['editaurl'] = 'Edit URL';
$string['editurlheader'] = 'Add New URL';
$string['displaytextlabel'] = 'Link text';
$string['urllabel'] = 'URL';
$string['visiblelabel'] = 'Visible';
$string['md5'] = 'MD5';
$string['md5_help'] = 'The parameters of the url can be MD5 encryted to allow for the url to be used as a Single Sign On (SSO) link.
If used a Shared Secret must be provided.';
$string['md5label'] = 'Encryt parameters';
$string['sharedsecret'] = 'Share Secret';
$string['sharedsecret_help'] = 'You must provide a shared secret if you are using encryted parameters.';
$string['sharedsecretlabel'] = 'Share Secret';
$string['iframe'] = 'Display in iFrame';
$string['iframe_help'] = 'If the link only contains substitutions that are either STUDID or USERNAME then the link can be displayed in iFrame on its own tab when viewed from the front page.';
$string['iframelabel'] = 'Display in iFrame';
$string['visiblelabel'] = 'Visible';
$string['url'] = 'URL';
$string['url_help'] = 'Any variables found within the url text will be substituted with the appropiate value.<br/>
                        Valid variable names are:
                        <ul>
                            <li>#USERNAME#</li>
                            <li>#STUDID# (if set)</li>
                            <li>#MODULE# (the first part of the Short Name, split on an underscore)</li>
                            <li>#COHORT# (the Short Name of the course)</li>
                        </ul>
                        <p>
                        e.g. http://youruni.co.uk/moduleInfo.php?search=#MODULE#<br/>
                        would produce http://youruni.co.uk/moduleInfo.php?search=123ABC
                        </p>
                        <p>
                        <b>Cohort Only:</b> Currently a cohort is any course that has an underscore in the short name so setting
                         this to yes will mean that link will only appear in those courses.
                        </p>
                        <p>
                        <b>Visible:</b> If set to No the link will not be displayed in any course.
                        </p>
                        <p>
                        The way the module code and cohort are derieved along with what makes a course a cohort
                        can be altered by editting the functions supplied in the source code.
                        </p>';

/*
 * Diaplay page
 */
$string['linktoall'] = 'Display All';
$string['nomodulelinkstodisplay'] = 'There are no modules that have links';
$string['modules'] = 'Modules';
$string['view'] = 'View';

/*
 * Front Page Behaviour
 */
$string['frontpagebehaviourheading'] = 'Front Page Behaviour';
$string['frontpagebehaviourtext'] = 'Settings for how the block will behave on the front page.';
$string['labelfrontpagelinktext'] = 'Link display text';
$string['descfrontpagelinktext'] = 'The text to use for the front page link to the list of all directed urls.';
$string['labelfrontpagetoptext'] = 'Text to display before links.';
$string['descfrontpagetoptext'] = 'You can place any text above the series of links.';
$string['labelfrontpagefootertext'] = 'Text to display after links.';
$string['descfrontpagefootertext'] = 'You can place any text below the series of links.';