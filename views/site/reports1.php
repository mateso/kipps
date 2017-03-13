<?php
$this->title = 'Reports';
$this->params['breadcrumbs'][] = "Reports";
$this->params['reports_page'] =  true;
?>
<script>
   function getReport(report)
   {
       window.open("http://192.168.43.30:90/Default.aspx?field1="+report,'1426141837057','width=1200,height=700,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0')
   }
</script>
<link rel="stylesheet" type="text/css" href="css_tree/_styles.css" media="screen">
	<ol class="tree">
		<li>
			<label for="folder1">Core LGA Printouts</label> <input type="checkbox"  id="folder1" /> 
			<ol>
                            <li class="file"><a href="#" onclick="getReport('rpt')">Budgets</a></li>
                            <li class="file"><a href="#" onclick="getReport('test')">Funds Received</a></li>
                            <li class="file"><a href="#" onclick="getReport()">Physical Implementation</a></li>
                            <li class="file"><a href="#" onclick="getReport()">Expenditure</a></li>
                            <li class="file"><a href="#" onclick="getReport()">MKUKUTA printouts</a></li>
				<li>
					<label for="subfolder1">Subfolder 1</label> <input type="checkbox" id="subfolder1" /> 
					<ol>
						<li class="file"><a href="">Filey 1</a></li>
						<li>
							<label for="subsubfolder1">Subfolder 1</label> <input type="checkbox" id="subsubfolder1" /> 
							<ol>
								<li class="file"><a href="">File 1</a></li>
								<li>
									<label for="subsubfolder2">Subfolder 1</label> <input type="checkbox" id="subsubfolder2" /> 
									<ol>
										<li class="file"><a href="">Subfile 1</a></li>
										<li class="file"><a href="">Subfile 2</a></li>
										<li class="file"><a href="">Subfile 3</a></li>
										<li class="file"><a href="">Subfile 4</a></li>
										<li class="file"><a href="">Subfile 5</a></li>
										<li class="file"><a href="">Subfile 6</a></li>
									</ol>
								</li>
							</ol>
						</li>
						<li class="file"><a href="">File 3</a></li>
						<li class="file"><a href="">File 4</a></li>
						<li class="file"><a href="">File 5</a></li>
						<li class="file"><a href="">File 6</a></li>
					</ol>
				</li>
			</ol>
		</li>
		<li>
			<label for="folder2">Core Ward Printouts</label> <input type="checkbox" id="folder2" /> 
			<ol>
				<li class="file"><a href="">File 1</a></li>
				<li>
					<label for="subfolder2">Subfolder 1</label> <input type="checkbox" id="subfolder2" /> 
					<ol>
						<li class="file"><a href="">Subfile 1</a></li>
						<li class="file"><a href="">Subfile 2</a></li>
						<li class="file"><a href="">Subfile 3</a></li>
						<li class="file"><a href="">Subfile 4</a></li>
						<li class="file"><a href="">Subfile 5</a></li>
						<li class="file"><a href="">Subfile 6</a></li>
					</ol>
				</li>
			</ol>
		</li>
		<li>
			<label for="folder3">Core Village Printouts</label> <input type="checkbox" id="folder3" /> 
			<ol>
				<li class="file"><a href="">File 1</a></li>
				<li>
					<label for="subfolder3">Subfolder 1</label> <input type="checkbox" id="subfolder3" /> 
					<ol>
						<li class="file"><a href="">Subfile 1</a></li>
						<li class="file"><a href="">Subfile 2</a></li>
						<li class="file"><a href="">Subfile 3</a></li>
						<li class="file"><a href="">Subfile 4</a></li>
						<li class="file"><a href="">Subfile 5</a></li>
						<li class="file"><a href="">Subfile 6</a></li>
					</ol>
				</li>
			</ol>
		</li>
		<li>
			<label for="folder4">Supplementary LGA Printouts</label> <input type="checkbox" id="folder4" /> 
			<ol>
				<li class="file"><a href="">File 1</a></li>
				<li>
					<label for="subfolder4">Subfolder 1</label> <input type="checkbox" id="subfolder4" /> 
					<ol>
						<li class="file"><a href="">Subfile 1</a></li>
						<li class="file"><a href="">Subfile 2</a></li>
						<li class="file"><a href="">Subfile 3</a></li>
						<li class="file"><a href="">Subfile 4</a></li>
						<li class="file"><a href="">Subfile 5</a></li>
						<li class="file"><a href="">Subfile 6</a></li>
					</ol>
				</li>
			</ol>
		</li>
		<li>
			<label for="folder5">Budget Submission Forms</label> <input type="checkbox" id="folder5" /> 
			<ol>
				<li class="file"><a href="">File 1</a></li>
				<li>
					<label for="subfolder5">Subfolder 1</label> <input type="checkbox" id="subfolder5" /> 
					<ol>
						<li class="file"><a href="">Subfile 1</a></li>
						<li class="file"><a href="">Subfile 2</a></li>
						<li class="file"><a href="">Subfile 3</a></li>
						<li class="file"><a href="">Subfile 4</a></li>
						<li class="file"><a href="">Subfile 5</a></li>
						<li class="file"><a href="">Subfile 6</a></li>
					</ol>
				</li>
			</ol>
		</li>
	</ol>
	

