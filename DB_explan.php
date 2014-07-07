<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="About_site.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to About Site</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
			&nbsp;
		</td>
		<td id="page">
			<h2>The MBX-U Matchbox Models Database</h2>
			<p>The Matchbox companies, Lesney through Mattel, have consistently been inconsistent in their organization of the miniature models and attendant numbering schemes. This became more apparent with the advent of MAN or FAB#&#39;s and re-issue of some older models by Mattel. In some cases the same numbering has been used to identify multiple models, and conversely the same model may have multiple numbers. There is further inconsistency in whether models with different attachments (e.g. a light bar) are grouped together or given separate numbers.</p>
			<p>Perhaps of even more concern is that Mattel historically has not been a fan of assigning individual model numbers,. And as we approach the endpoint of the 3-digit MAN# there&#39;s the possibility that another change in numbering scheme may occur.</p>
			<p>As I began organizing my collection models into a relational database, the difficulties posed by these factors became evident. I felt it necessary to institute my own organizational scheme, which is used on this web-site and explained below.</p>
		<p>The database is organized using the following hierarchy, with a database table for each of these levels:</p>
		<ol type="I">
			<li>Models</li>		
			<li>&#160;&#160;&#160;Versions</li>
			<li>&#160;&#160;&#160;&#160;&#160;&#160;Variations</li>
			<li>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Releases</li>
		</ol>
		<p>A feature of the web site is the ability for each user to their own collection. Collection records are at the level of the variation, althoguh release info can also be included in a user's collection.</p>
		<p>In addition the database includes several reference tables (i.e. Wheel Types and Packages Types), and a number of lookup value lists for pre-determined selections to some field values (i.e. window color, country of manufacture). There is also a table of 'microvariations' that includes very small differences in variations that might not easily be detected and so aren't used as criteria to create a new variation.</p>
		<p>Let's go through each level of the database hierarchy and understand what they mean.</p>
		<h4>MODEL</h4>
		<h6>What is a Model ?</h6>
		<p>All cars (note: I use 'cars' in a broad sense to mean miniature vehicle) with same characteristics, as listed below, are a single model; if any of these characteristics differ, they are listed as separate models</p>
		<ol>
			<li>Basic body casting: Early models may have fairly small casting differences, but have historically been listed as separate models. I;ve maintained that here.</li>
			<li>Scale</li>
			<li>Regular vs Superfast wheels</li>
		</ol>
		<p>It is often the case that Matchbox released two items that were the same in all above characteristics, but were created with and have maintained separate model identities, i.e. Ford Galaxie Fire Chief and Ford Galaxie Police Car, or Big Banger and Cosmic Blues. For this database, those are considered the same model and combined herein. The different instances are listed as separate versions under one model.</p>
		<p>Matchbox and catalogers have been inconsistent over the years regarding differences movable body parts (opening doors, hoods, piston popper, steering lever etc.), body accessories (canopy, roofrack, light bar, gun) and interior casting (whether it has an interior or not, whether the interior casting includes other body parts). I debated whether to separate vehicles into different models based on each of those characteristics, but found that the number of variations posed difficulties. Although there are exceptions in both directions, it seems like for the preponderance of models variations in those characteristics are not considered to cause a vehicle to be listed as a separate model. In those instance where they have been searated(i.e. ford transit ambulance vs ford transit), they will be combined into one model in this scheme. </p>
		<h6>Characteristics of a Model in This Database</h6>
		<p>Each record in the Models table has the following attributes:</p>
		<ul>
			<li>Unique Model ID (UMID)</li>
			<li>Master Model Name: the most "accepted" name for the model. I wasn;t able to base this on the first package name or base name, as they were often very generic. This is an selected from the name used by most Matchbox references. If there are more than one traditional models that ar eincluded in a single database model, the name of the first of those released is used.</li>
			<li>First Year of Release (not the copyright or base date but the year of actual release for sale)</li>
			<li>Base Casting Date</li>
			<li>Scale of the Model</li>
			<li>Type of Vehicle : car, tow truck, taxi, dump truck, etc. SInce models may have, for instance, both an ambulance versionand a military vehicle version, there are 2 Type fields. All searches based on type cover both of these fields.</li>
			<li>Make and Country of model: For instance, Ford and USA. 'Generic' vehicles that do not have a real make are designated as 'Matchbox' with USA as the country. Fnastastic odels, such as the Rhino Rod are listed as 'Fantasy' type with USA as the country.</li>
			<li>Similar Models: Other models in the database that are similar. There are three Chevy Lumina models that have distinct differences so are listed as separate models, but are similar and cross-index to each other.</li>
		</ul>
		<p></p>
		<h6>The Unique Model ID (UMID)</h6>
		<p>As a result of the change in companies and organization of models across the decades, every current numbering scheme based on existing identities have some exceptions and duplications. These schemes are also dependent on the manufacturer’s identification methods, which could change at some point. In addition, the rules used to differentiate whether two items are the same or different models differ across these numbering schemes.</p>
		<p>To avoid those challenges, this database uses a generic model ID scheme as described below. Recognizing the value of current numbering schemes, and the extent to which Matchbox collectors are invested in them, The models and their UMID are however, all records here are cross-indexed to the traditional identities at the appropriate tables of the database. So, those who prefer to continue to use the MAN/FAB#, Mack No., or others, for searches can do so.</p>
		<p>Models were given UMID's in order based on year of initial release of that model and then the MAN# or place in the series numbering for pre-MAN# models. The earliest version of a model was used to assign the UMID to all versions of that model. For instance, the Chevy Highway Maint Truck was first released in 1990 under MAN# 222, and has the UMID SF0361. The later release in the 2007, under MAN# 652 also falls under that UMID.</p>
		
		<h4>VERSION</h4>
		<h6>What is a Version?</h6>
		<p>Within a particular model there are typically many versions. Details that define different versions are: </p>
		<ol>
			<li>Color Scheme: significant or easily noticed color variations (i.e. red, blue, olive green vs bright green)</li>
			<li>Tampo design: Data is recorded for both the graphic design  (i.e. blue stripes or a Ferrari logo) and tampo text (i.e. the text 'Ferrari' on the car</li>
			<li>Release as separate models: some colors may seem very similar, but if they were released as separate versions by Matchbox (i.e. one several years later than the other or in a dfferent series), then they are listed as separate versions of a model</li>
			<li>Major Attachments: this applies to attachments that comprise the identity of the model, ie shovel on tractor shovel, boom and crane color on Crane Truck. The presence/absence of an attachment define different versions.</li>
			<li>Detail Level: premier detail level of trim/wheels vs regular models</li>
			<li>For racecars: Different #'s on the car create different versions (i.e. Catepillar Luminas #95 and #96 are separate versions though they look similar).</li>
		</ol>
		<p>Each version of a model has these characteristics:</p>
		<ul>
			<li>Unique Version ID (VerID) made up of the UMID + Version number (i.e. the third version of model SF700 would have version number SF0700-003)</li>
			<li>Other ID numbers: Mack no., MAN/FAB#</li>
			<li>Version name: Since there may be multiple traditional models under one UMID, different versions may have different version names (i.e. Under the 'Big Banger' model, there is that version, the Cosmic Blues version and others.</li>
			<li>Year the Version was First released</li>
			<li>The color(s), tampo deisng and tampo text on the version</li>
			<li>Version attachments, when appropriate</li>
			<li>Version Type: wherther the version is a premier model ('Premiere') or regular level of detail ('MB')</li>
			<li>Code Level and Secondary Manufacturer when appropriate: Code 1, made by Mattel (or LEsney etc), Code 2 design applied by an approved secondary company (i.e. CCI). I have not included code 3 (custom models made without approval of Mattel)</li>
		</ul>
		
		
		
		
		
		
		
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>