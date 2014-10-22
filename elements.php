<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
	
		<div class="section">
		
			<h2>This is an "All Elements" page, don't push to live.</h2>
			<p>View the page source of the elements below in order to learn how to use them. Also, if there are new things you'd like to see here then use Basecamp to create a task for me!</p>
			
			<hr />
			
			<h4>Headings</h4>	
			
			<h1>This is an &lt;h1&gt; element</h1>
			<h2>This is an &lt;h2&gt; element</h2>
			<h3>This is an &lt;h3&gt; element</h3>
			<h4>This is an &lt;h4&gt; element</h4>
			<h5>This is an &lt;h5&gt; element</h5>
			<h6>This is an &lt;h6&gt; element</h6>
			
			<hr />
			
			<h4>Text Elements</h4>
				
			<p>This is a &lt;p&gt; element, intended for any and all paragraphs. Paragraphs can be just one line or sentence also.</p>
				
			<p>The following is an unordered list, or &lt;ul&gt; element. Always use &lt;li&gt; elements within to define each <strong>list element</strong>.</p>
			<ul>
				<li>apple</li>
				<li>orange</li>
				<li>banana</li>
			</ul>
			
			<p>The following is an ordered list, or &lt;ol&gt; element. Always use &lt;li&gt; elements within to define each <strong>list element</strong>.</p>
			<ul>
				<li>first place</li>
				<li>second place</li>
				<li>third place</li>
			</ul>
			
			<hr />
			
			<h4>Buttons</h4>
			
			<a href="#" class="button">.button</a>
			<a href="#" class="button dark">.button .dark</a>
			<a href="#" class="button dark block">.button .block</a>
			
			<hr />
			
			<h4>Action Buttons</h4>						
			<div class="row actionButtons">
				<div class="large-4 columns">
					<a href="#" class="button dark">3 column button</a>
				</div>
				<div class="large-4 columns">
			        <a href="#" class="button dark">3 column button</a>
			    </div>
			    <div class="large-4 columns">   
			        <a href="#" class="button dark">3 column button</a>
			    </div>
			</div>
						
			<hr />
			
			<h4>Submenu Navigation</h4>
			<div class="row" id="subNav">
				<div class="large-12 columns">
					<p class="tip">related pages:</p>
					<a href="#">Related Page</a>
					<a href="#">Related Page</a>
					<a href="#">Related Page</a>
					<a href="#">Related Page</a>
				</div>
			</div>
			
			<hr />
			
			<h4>Tables</h4>
			
			<table>
				<tr>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
				</tr>
				<tr>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
				</tr>
				<tr>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
					<td>data</td>
				</tr>
			</table>
			
			<hr />
			
			<h4>Icon</h4>
			<img class="icon inline" src="images/iconCheck.png" width="40" />
			<img class="icon inline" src="images/iconCross.png" width="40" />
			
			<hr />
			
			<h4>Accordion</h4>
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel1">Accordion label</a>
					<div id="panel1" class="content">
						<p>Put whatever you want inside this hidden accordion section</p>
					</div>
				</dd>
			</dl>
			
			<hr />
			
			<h4>Car Grid</h4>
			<p>Put car information / results inside a &lt;ul class="large-block-grid-3"&gt;, each car should be within a &lt;li class="carGrid"&gt; to align it into a uniform block layout. Example below:</p>
			
			<ul class="large-block-grid-3">
				<li class="carGrid">car information here</li>
				<li class="carGrid">car information here</li>
				<li class="carGrid">car information here</li>
				<li class="carGrid">car information here</li>
				<li class="carGrid">car information here</li>
			</ul>
			
			
		</div>
				
	</div>
</div>


<?php include("includes/footer.php"); ?>
