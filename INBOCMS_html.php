<?php
/* ----------------------------------------------------------------------
 * app/widgets/INBOCMS/views/main_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2010-2018 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 
 	$po_request			= $this->getVar('request');
?>

<div class="dashboardWidgetContentContainer">
	<ul>
		<li><a href="https://sites.google.com/inbo.be/intranet-sep2021/ondersteuning/inzamelingen-en-collecties?authuser=0"><?php print _t("INBO-intranet page on collections"); ?></a></li>
		<li><a href="https://docs.google.com/document/d/1yv603lGSjKlOGxLrVpMP1ovnkRuM5DwV8u-m8kgRzcw/edit#heading=h.boezipx4hu2w"><?php print _t("INBO-CMS documentation"); ?></a></li>
		<li><a href="https://github.com/inbo/collective-access"><?php print _t("INBO-CMS Github page"); ?></a></li>
		<li><?php print _t("Contact: collectiebeheer@inbo.be"); ?></li>
	</ul>
</div>
