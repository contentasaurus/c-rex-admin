<button class="btn btn-link show-data-modal" data-toggle="modal" data-target="#data-modal" type="button"><i class="fa fa-question-circle"></i></button>

<div id="data-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Data available for use in components and pages:</h4>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Key</th>
							<th>Type</th>
							<th>Example</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Cookie</td>
							<td>$_COOKIE data</td>
							<td>{{ Cookie.sugar }}</td>
						</tr>
						<tr>
							<td>Get</td>
							<td>$_GET data</td>
							<td>{{ Get.name }}</td>
						</tr>
						<tr>
							<td>Page</td>
							<td>CMS data objects relevant only to a specific page</td>
							<td>{{ Page.name }}</td>
						</tr>
						<tr>
							<td>Post</td>
							<td>$_POST data</td>
							<td>{{ Post.name }}</td>
						</tr>
						<tr>
							<td>Session</td>
							<td>$_SESSION data</td>
							<td>{{ Session.name }}</td>
						</tr>
						<tr>
							<td>Server</td>
							<td>$_SERVER data</td>
							<td>{{ Server.SERVER_NAME }}</td>
						</tr>
						<tr>
							<td>Site</td>
							<td>Global CMS data objects</td>
							<td>{{ Site.name }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
