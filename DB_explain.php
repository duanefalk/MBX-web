<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
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
		<p>As a result of the change in companies and organization of models across the decades, every current numbering scheme based on existing identities have some exceptions and duplications. These schemes are also dependent on the manufacturer's identification methods, which could change at some point. In addition, the rules used to differentiate whether two items are the same or different models differ across these numbering schemes.</p>
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
			<li>Version Type: Regular wheel, Lesney Superfast, MB (post Lesney), Premiere level (extra detail and/or premiere wheels) or economy (i.e. plastic, no interior, black windows such as Burger King models)</li>
			<li>For racecars: Different #'s on the car create different versions (i.e. Catepillar Luminas #95 and #96 are separate versions though they look similar).</li>
		</ol>
		<p>Each version of a model has these characteristics:</p>
		<ul>
			<li>Unique Version ID (VerID) made up of the UMID + Version number (i.e. the third version of model SF700 would have version number SF0700-003)</li>
			<li>Other ID numbers: Mack no., MAN/FAB#</li>
			<li>Version name: Since there may be multiple traditional models under one UMID, different versions may have different version names (i.e. Under the 'Big Banger' model, there is that version, the Cosmic Blues version and others.</li>
			<li>Year the Version was First released</li>
			<li>The color(s), tampo deisgn and tampo text on the version</li>
			<li>Version attachments, when appropriate</li>
			<li>Code Level and Secondary Manufacturer when appropriate: Code 1, made by Mattel (or LEsney etc), Code 2 design applied by an approved secondary company (i.e. CCI). I have not included code 3 (custom models made without approval of Mattel)</li>
		<p></p>
		<h4>VARIATION</h4>
		<h6>What is a Variation?</h6>
		<p>Within a version there may be smaller differences that form variations of that version. Details such as:</p>
		<ol>
			<li>Wheel style: often Matchbox used different wheels for the same model, perhaps using up what was lying around the shop. Each different wheel style or combination is a variation. Note- both front wheel and rear wheels are considered. CHaracteristics include design of the hub, color of tire and hub, rubber or plastic tires.</li>
			<li>Windows: There are often different colors of windows used for the same model. There is a separate page- <a href="Window_Colors.php" class="button dark">WINDOW COLORS</a> -that shows the most common vaiations</li>
			<li>Base Details: Plastic or Metal, color, details on the base etc. A model can have more than one base- an inset, a trailer base etc. and both are described.</li>
			<li>Color or Tampo variations: small variations in color may occur for the same version. SImilarly, some models aare obviously of the same tampo design, but have a differece- ie. inclusion or lack of the MB2000, 50 or Hero City logos on models form 2000-2004.</li>
			<li>Accessory differences: Whether or not the model has a tow hook, color of a driver etc.</li>
		</ol>
		<p>Each variation in the database has these characteristics:</p>
		<ul>
			<li>Unique Variation ID (VARID) made up of the UMID + VerID + a letter for the variation, i.e. SF550-001-a and SF550-001-b are 2 variations of the same model.</li>
			<li>Specific Mack# from C. Mack's latest catalog versions</li>
			<li>Model name on the base- this often differs among versions and even sometimes among variations</li>
			<li>Manufactourer location: Where the model was made- England, China etc.</li>
			<li>Wheel styles- front and back</li>
			<li>Base Type: plastic or metal</li>
			<li>Base color</li>
			<li>Window color</li>
			<li>Interior color</li>
			<li>Color or tampo variations</li>
			<li>Miscellaneous details: knowing that I couldn;t predict every possible way 2 cars could differ, I left 5 generic fields for additional details.Includes the detail type (i.e. what aspect of the vehicle is different) and the detail variation (the specific of that detail); for example- 
			<p>DetTyp1: 	kayak color    	DetVar1: Yellow</p>
			<p>Note: with some models, especially older ones, there are small structural details that collectores have identified. Some of these require the model to be dismantled to see! If I couldn't easily tell the differences between two identified variations, I listed these separately as 'microvariations'. a link on the search result spage show you all microvariations identified for a model.</p>
		</ul>

		<h4>RELEASE</h4>
		<h6>What is a Release?</h6>
		<p>A release is the way that a given model was sold- its series, packaging etc. Many collectors eschew this level of detail (they don;t collect 'cardboard', as the saying goes), but it is often useful for identifying a model or to help you search for one on ebay, to know how the model was packaged. Each variation then has one or more releases. The release includes both the series that a model as sold under (i.e. 1-75, Playset, Promotion), the market it was sold in (USA, Rrest of world or 'ROW' or perhaps specific countries) and the year is was offered. So a model offered as #50 in the 1-75 series in the USA in 1984 and also in EUrope, it would have 2 releases.</p>
		<p>Each release in the database has these characteristics:</p>
		<ul>
			<li>Unique release ID (RelID) made up of the variation ID + a 2 difit number for the release.</li>
			<li>Release Year</li>
			<li>Country of sale: If sold in a particular country it can be listed as such (i.e. promos only sold in Belgium). USA is the biggest example of this. Aggregations of markets include ROW- rest of world (anywhere but USA), LA- Latin America, and if generally available, CORE- offered in all major markets.</li>
			<li>Line: Miniatures, SKybusters, King/Superking, COnoys etc. The highest level distinction of releases. This site focuses on miniatures, but many miniature models are offered under SKybusters etc, and those are included.</li>
			<li>Theme: Matchbox has sometimes used a particular theme for its packaging and sales across different series and years. Examples include the Tyco 'Fast Lane' theme, the much-loved 'Hero City' theme, and starting in 2014, 'On a Mission'. Check them out at <a href="Theme_List.php" class="button dark">RELEASE THEMES</a></li>	
			<li>Series: 1-75, Multi-packs, Gift Sets, Premiere models etc. A list can be found in <a href="Series_List.php" class="button dark">RELEASE SERIES LIST</a></li>
			<li>Series ID: if a series is numbered, such as the 1-75 models, that number.</li>
			<li>Subseries and subseries ID: In recent years Mattel has dividede the 1-7 set into various subsets, Emergency, Construction etc. Other example sinclude the various 'World Class Series' under Premiere models</li>
			<li>Package ID & Code: Mattel, and to some extent Tyco, include package ID#'s on their packages. These are typically 5 digit numbers or letter-number combos. The pkg ID often differs for the same model in the USA and other countries. The package code is a general style of the package. For 1-75 these are based on the common Box or BLister types (i.e. Box F)</li>
			<li>Package name: What the package is called, if it is unqieuly identified. Not to be confused with the series or subseries name listed on the package, For instance, 'Exotic Rides' on a 5-pack is a package name, whereas Premiere and World Class Series 5 are series and subseries names on a premiere model.</li>
			<li>Model Name on Package: What the model is called on the specific package, This often differs by country and differs from the nam on the car itself.</li	
		</ul>
		<p></p>
		<h4>COLLECTIONS</h4>
		<p>Every model you enter into your collection uses the UMID, VerID, VarID and optionally the RelID. In addition you can enter info on the purchase, value, storage location, date of purchase etc.</p>
		
		<h4>IDENTIFICATION SUMMARY</h4>
		<p>Each specific model has a unique identifier that covers all of the info listed above. An example is:</p>
		<ul>
			<li>SF149-003-a-01: </li>
			<p>This is model SF233 (Lesney Dodge Challenger, 3rd version of this (the blue one), first variation (chrome interior) and the 1st (and only) release of that variation- offered in Brazil in 1979.</p>
			
		</ul>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="About_site.php">About the Site</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>