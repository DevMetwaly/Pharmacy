<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Application Settings</h1>
				</div>
				<div>
					<h3>Themes</h3>
					<div class="row">
						<div class="themePreview col-lg-3 col-sm-6 col-xs-12">
							<img src="dist/css/preview/theme1.png" onclick="changeTheme('style1.css')">
							<p>Blue Theme (Main)</p>
						</div>
						<div class="themePreview col-lg-3 col-sm-6 col-xs-12" onclick="changeTheme('style2.css')">
							<img src="dist/css/preview/theme2.png">
							<p>Silver Theme</p>
						</div>	
						<div class="themePreview col-lg-3 col-sm-6 col-xs-12" onclick="changeTheme('style3.css')">
							<img src="dist/css/preview/theme3.png">
							<p>Lime Theme</p>
						</div>	
						<div class="themePreview col-lg-3 col-sm-6 col-xs-12" onclick="changeTheme('style4.css')">
							<img src="dist/css/preview/theme4.png">
							<p>Dark Theme</p>
						</div>	
					</div>
					<span class="btn btn-success" onclick="popUp(1)">Successful Popup</span>
					<span class="btn btn-danger" onclick="popUp(0)">Error Popup</span>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
</div>